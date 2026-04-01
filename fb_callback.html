<?php
session_start();
require_once __DIR__ . '/oauth_config.php';

$usersFile = __DIR__ . '/users.json';

// Step 1: If no code, redirect to Facebook authorization
if (!isset($_GET['code'])) {
    $params = http_build_query([
        'client_id'    => FACEBOOK_APP_ID,
        'redirect_uri' => FACEBOOK_REDIRECT_URI,
        'scope'        => 'email,public_profile',
        'response_type'=> 'code'
    ]);
    header('Location: https://www.facebook.com/v18.0/dialog/oauth?' . $params);
    exit;
}

// Step 2: Exchange authorization code for access token
$code = $_GET['code'];

$tokenUrl = 'https://graph.facebook.com/v18.0/oauth/access_token?' . http_build_query([
    'client_id'     => FACEBOOK_APP_ID,
    'client_secret' => FACEBOOK_APP_SECRET,
    'redirect_uri'  => FACEBOOK_REDIRECT_URI,
    'code'          => $code
]);

$ch = curl_init($tokenUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$tokenResponse = curl_exec($ch);
curl_close($ch);

$token = json_decode($tokenResponse, true);

if (!isset($token['access_token'])) {
    header('Location: login.php?error=facebook_failed');
    exit;
}

// Step 3: Fetch user info from Facebook
$userUrl = 'https://graph.facebook.com/v18.0/me?' . http_build_query([
    'fields'       => 'id,name,email',
    'access_token' => $token['access_token']
]);

$ch = curl_init($userUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$userResponse = curl_exec($ch);
curl_close($ch);

$fbUser = json_decode($userResponse, true);

if (!isset($fbUser['email'])) {
    // Facebook might not return email if not granted
    // Use Facebook ID as fallback
    $email = ($fbUser['id'] ?? 'unknown') . '@facebook.com';
} else {
    $email = $fbUser['email'];
}

$name = $fbUser['name'] ?? explode('@', $email)[0];

// Step 4: Find or create user in users.json
$users = [];
if (file_exists($usersFile)) {
    $users = json_decode(file_get_contents($usersFile), true) ?? [];
}

$found = false;
foreach ($users as $u) {
    if ($u['email'] === $email) {
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
        'login_method' => 'facebook'
    ];
    $users[] = $newUser;
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

    $_SESSION['user_name'] = $name;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_phone'] = '';
    $_SESSION['logged_in'] = true;
}

// Step 5: Redirect to home page
header('Location: index.html');
exit;
