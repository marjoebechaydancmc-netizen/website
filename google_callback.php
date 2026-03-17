<?php
session_start();
require_once __DIR__ . '/oauth_config.php';

$usersFile = __DIR__ . '/users.json';

// Step 1: If no code, redirect to Google authorization
if (!isset($_GET['code'])) {
    $params = http_build_query([
        'client_id'     => GOOGLE_CLIENT_ID,
        'redirect_uri'  => GOOGLE_REDIRECT_URI,
        'response_type' => 'code',
        'scope'         => 'email profile',
        'access_type'   => 'online',
        'prompt'        => 'select_account'
    ]);
    header('Location: https://accounts.google.com/o/oauth2/v2/auth?' . $params);
    exit;
}

// Step 2: Exchange authorization code for access token
$code = $_GET['code'];

$tokenData = [
    'code'          => $code,
    'client_id'     => GOOGLE_CLIENT_ID,
    'client_secret' => GOOGLE_CLIENT_SECRET,
    'redirect_uri'  => GOOGLE_REDIRECT_URI,
    'grant_type'    => 'authorization_code'
];

$ch = curl_init('https://oauth2.googleapis.com/token');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($tokenData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$tokenResponse = curl_exec($ch);
curl_close($ch);

$token = json_decode($tokenResponse, true);

if (!isset($token['access_token'])) {
    // Token exchange failed
    header('Location: login.php?error=google_failed');
    exit;
}

// Step 3: Fetch user info from Google
$ch = curl_init('https://www.googleapis.com/oauth2/v2/userinfo');
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $token['access_token']]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$userResponse = curl_exec($ch);
curl_close($ch);

$googleUser = json_decode($userResponse, true);

if (!isset($googleUser['email'])) {
    header('Location: login.php?error=google_no_email');
    exit;
}

$email = $googleUser['email'];
$name = $googleUser['name'] ?? explode('@', $email)[0];

// Step 4: Find or create user in users.json
$users = [];
if (file_exists($usersFile)) {
    $users = json_decode(file_get_contents($usersFile), true) ?? [];
}

$found = false;
foreach ($users as $u) {
    if ($u['email'] === $email) {
        // Existing user - log them in
        $_SESSION['user_name'] = $u['name'];
        $_SESSION['user_email'] = $u['email'];
        $_SESSION['user_phone'] = $u['phone'] ?? '';
        $_SESSION['user_profile_pic'] = $u['profile_pic'] ?? '';
        $_SESSION['logged_in'] = true;
        $found = true;
        break;
    }
}

if (!$found) {
    // New user - create account
    $newUser = [
        'name'         => $name,
        'email'        => $email,
        'password'     => '',
        'phone'        => '',
        'region'       => '',
        'province'     => '',
        'city'         => '',
        'barangay'     => '',
        'street'       => '',
        'profile_pic'  => '',
        'login_method' => 'google'
    ];
    $users[] = $newUser;
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

    $_SESSION['user_name'] = $name;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_phone'] = '';
    $_SESSION['logged_in'] = true;
}

// Step 5: Redirect to home page
header('Location: front.php');
exit;
