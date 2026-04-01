<?php
session_start();

$usersFile = __DIR__ . '/users.json';
$message = '';
$msgType = '';

// Load users
function loadUsers() {
    global $usersFile;
    if (!file_exists($usersFile)) {
        file_put_contents($usersFile, json_encode([]));
    }
    return json_decode(file_get_contents($usersFile), true);
}

// Save users
function saveUsers($users) {
    global $usersFile;
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
}

// Handle Logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: index.html');
    exit;
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $role = $_POST['role'] ?? 'sales';

    $users = loadUsers();

    if ($action === 'signup') {
        if (empty($email) || empty($password) || empty($name)) {
            $message = 'Please fill in all fields.';
            $msgType = 'error';
        } else {
            // Check if email already exists
            $exists = false;
            foreach ($users as $u) {
                if ($u['email'] === $email) {
                    $exists = true;
                    break;
                }
            }
            if ($exists) {
                $message = 'Email already registered. Please log in.';
                $msgType = 'error';
            } else {
                $users[] = [
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'phone' => $phone,
                    'role' => $role,
                    'region' => '',
                    'province' => '',
                    'city' => '',
                    'barangay' => '',
                    'street' => '',
                    'profile_pic' => ''
                ];
                saveUsers($users);
                $_SESSION['user_name'] = $name;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_phone'] = $phone;
                $_SESSION['logged_in'] = true;
                $_SESSION['user_role'] = $role;

                // Redirect based on role
                if ($role === 'admin') {
                    header('Location: admin.php');
                } else {
                    $redirect = $_POST['redirect'] ?? 'index.html';
                    header('Location: ' . $redirect);
                }
                exit;
            }
        }
    } elseif ($action === 'login') {
        if (empty($email) || empty($password)) {
            $message = 'Please enter email and password.';
            $msgType = 'error';
        } else {
            $login_method = $_POST['login_method'] ?? 'standard';
            $found = false;
            $user_to_login = null;

            foreach ($users as $u) {
                if ($u['email'] === $email) {
                    if ($login_method !== 'standard' || $password === $u['password']) {
                        $user_to_login = $u;
                        $found = true;
                    }
                    break;
                }
            }

            if ($found) {
                $_SESSION['user_name'] = $user_to_login['name'];
                $_SESSION['user_email'] = $user_to_login['email'];
                $_SESSION['user_phone'] = $user_to_login['phone'] ?? '';
                $_SESSION['user_profile_pic'] = $user_to_login['profile_pic'] ?? '';
                $_SESSION['logged_in'] = true;
                $_SESSION['user_role'] = $user_to_login['role'] ?? 'sales';
                
                $user_role = $user_to_login['role'] ?? 'sales';
                if ($user_role === 'admin') {
                    header('Location: admin.php');
                } else {
                    $redirect = $_POST['redirect'] ?? 'index.html';
                    header('Location: ' . $redirect);
                }
                exit;
            } else {
                if ($login_method !== 'standard') {
                    // Save new social user
                    $newUser = [
                        'name' => explode('@', $email)[0],
                        'email' => $email,
                        'password' => $password,
                        'phone' => '',
                        'region' => '',
                        'province' => '',
                        'city' => '',
                        'barangay' => '',
                        'street' => '',
                        'profile_pic' => '',
                        'role' => 'sales',
                        'login_method' => $login_method
                    ];
                    $users[] = $newUser;
                    saveUsers($users);

                    $_SESSION['user_name'] = $newUser['name'];
                    $_SESSION['user_email'] = $newUser['email'];
                    $_SESSION['user_role'] = 'sales';
                    $_SESSION['logged_in'] = true;

                    $redirect = $_POST['redirect'] ?? 'index.html';
                    header('Location: ' . $redirect);
                    exit;
                } else {
                    $message = 'Invalid email or password.';
                    $msgType = 'error';
                }
            }
        }
    }
}

$redirect = $_GET['redirect'] ?? $_POST['redirect'] ?? 'index.html';
$tab = $_GET['tab'] ?? 'login';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login / Sign Up - Trendy Threads</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #ff7e5f, #feb47b);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-container {
    background: white;
    border-radius: 16px;
    box-shadow: 0 15px 50px rgba(0,0,0,0.2);
    width: 420px;
    max-width: 95%;
    overflow: hidden;
    animation: popIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

@keyframes popIn {
    0% { transform: scale(0.8) translateY(30px); opacity: 0; }
    100% { transform: scale(1) translateY(0); opacity: 1; }
}

.login-header {
    background: linear-gradient(135deg, #ff7e5f, #feb47b);
    color: white;
    padding: 30px 20px;
    text-align: center;
}

.login-header h1 {
    font-size: 1.8em;
    margin-bottom: 5px;
}

.login-header p {
    font-size: 0.95em;
    opacity: 0.9;
}

/* Tabs */
.tabs {
    display: flex;
    border-bottom: 2px solid #f0f0f0;
}

.tabs button {
    flex: 1;
    padding: 14px;
    background: none;
    border: none;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    color: #aaa;
    transition: 0.3s;
    border-bottom: 3px solid transparent;
}

.tabs button.active {
    color: #ff7e5f;
    border-bottom-color: #ff7e5f;
}

.tabs button:hover {
    color: #ff7e5f;
}

/* Form */
.form-section {
    display: none;
    padding: 30px 25px;
}

.form-section.active {
    display: block;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 6px;
    color: #555;
}

.form-group .input-wrap {
    position: relative;
}

.form-group .input-wrap i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #bbb;
}

.form-group input {
    width: 100%;
    padding: 12px 12px 12px 40px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 16px; /* Prevents text zoom on mobile */
    transition: all 0.3s ease;
    box-sizing: border-box;
}

.form-group input:focus {
    border-color: #ff7e5f;
    outline: none;
    box-shadow: 0 4px 15px rgba(255, 126, 95, 0.2);
    transform: translateY(-1px);
}

.submit-btn {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #ff7e5f, #feb47b);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
    margin-top: 5px;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 126, 95, 0.4);
}

.message {
    padding: 10px 15px;
    border-radius: 8px;
    margin-bottom: 15px;
    font-size: 14px;
    text-align: center;
}

.message.error {
    background: #ffe0e0;
    color: #d32f2f;
}

.message.success {
    background: #e0ffe0;
    color: #2e7d32;
}

.back-home {
    display: block;
    text-align: center;
    padding: 15px;
    color: #888;
    text-decoration: none;
    font-size: 14px;
    transition: 0.3s;
}

.back-home:hover {
    color: #ff7e5f;
}

/* Social Validation */
.divider {
    display: flex;
    align-items: center;
    margin: 22px 0 18px;
    gap: 12px;
}

.divider::before,
.divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #ddd;
}

.divider span {
    font-size: 13px;
    color: #999;
    white-space: nowrap;
}

.social-buttons {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.social-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    padding: 12px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
    text-decoration: none;
    box-sizing: border-box;
    background: none;
}

.social-btn img {
    width: 20px;
    height: 20px;
}

.social-btn.google {
    background: white;
    color: #444;
}

.social-btn.google:hover {
    background: #f7f7f7;
    border-color: #4285F4;
    box-shadow: 0 2px 8px rgba(66, 133, 244, 0.2);
}

.social-btn.facebook {
    background: #1877F2;
    color: white;
    border-color: #1877F2;
}

.social-btn.facebook:hover {
    background: #166FE5;
    box-shadow: 0 2px 8px rgba(24, 119, 242, 0.4);
}

/* Validation Badge */
.social-btn .validated-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: #4CAF50;
    color: white;
    font-size: 11px;
    padding: 2px 8px;
    border-radius: 12px;
    margin-left: 6px;
    animation: badgePop 0.3s ease;
}

@keyframes badgePop {
    0% { transform: scale(0); }
    70% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

/* Social Validation Overlay */
.social-validate-overlay {
    display: none;
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1000;
    justify-content: center;
    align-items: center;
    animation: fadeIn 0.2s ease;
}

.social-validate-overlay.show {
    display: flex;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.social-validate-modal {
    background: white;
    border-radius: 16px;
    padding: 30px;
    width: 380px;
    max-width: 90%;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    animation: modalSlide 0.3s ease;
    text-align: center;
}

@keyframes modalSlide {
    from { transform: translateY(-20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.social-validate-modal .modal-icon {
    font-size: 48px;
    margin-bottom: 15px;
}

.social-validate-modal .modal-icon.google-icon {
    color: #4285F4;
}

.social-validate-modal .modal-icon.fb-icon {
    color: #1877F2;
}

.social-validate-modal h3 {
    font-size: 18px;
    margin-bottom: 8px;
    color: #333;
}

.social-validate-modal p {
    font-size: 13px;
    color: #888;
    margin-bottom: 20px;
}

.social-validate-modal input {
    width: 100%;
    padding: 12px 14px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 15px;
    margin-bottom: 10px;
    transition: 0.3s;
    box-sizing: border-box;
}

.social-validate-modal input:focus {
    border-color: #ff7e5f;
    outline: none;
    box-shadow: 0 0 0 3px rgba(255,126,95,0.15);
}

.social-validate-modal .validate-msg {
    font-size: 13px;
    margin-bottom: 12px;
    min-height: 20px;
    transition: 0.3s;
}

.social-validate-modal .validate-msg.valid {
    color: #4CAF50;
}

.social-validate-modal .validate-msg.invalid {
    color: #d32f2f;
}

.social-validate-modal .modal-actions {
    display: flex;
    gap: 10px;
}

.social-validate-modal .modal-actions button {
    flex: 1;
    padding: 11px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.social-validate-modal .btn-cancel {
    background: #f0f0f0;
    color: #666;
}

.social-validate-modal .btn-cancel:hover {
    background: #e0e0e0;
}

.social-validate-modal .btn-validate {
    background: linear-gradient(135deg, #ff7e5f, #feb47b);
    color: white;
}

.social-validate-modal .btn-validate:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(255,126,95,0.4);
}

.social-validate-modal .btn-validate:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

/* Responsive Design */
@media (max-width: 480px) {
    body { padding: 15px; }
    
    .login-container {
        width: 100%;
        border-radius: 12px;
        min-height: auto;
        display: block;
    }
    .form-section {
        padding: 20px 15px;
    }
    .login-header {
        padding: 30px 15px;
    }
    .social-validate-modal {
        width: 95%;
        padding: 20px;
    }
}
    .social-validate-modal {
        width: 95%;
        padding: 20px;
    }
}
</style>
</head>
<body>

<div class="login-container">
    <div class="login-header">
        <h1><i class="fa-solid fa-shirt"></i> Trendy Threads</h1>
        <p>Please log in or sign up to continue</p>
    </div>

    <div class="tabs">
        <button id="tab-login" class="<?= $tab === 'login' ? 'active' : '' ?>" onclick="switchTab('login')">
            <i class="fa-solid fa-right-to-bracket"></i> Log In
        </button>
        <button id="tab-signup" class="<?= $tab === 'signup' ? 'active' : '' ?>" onclick="switchTab('signup')">
            <i class="fa-solid fa-user-plus"></i> Sign Up
        </button>
    </div>

    <!-- LOGIN FORM -->
    <div id="form-login" class="form-section <?= $tab === 'login' ? 'active' : '' ?>">
        <?php if ($message && $tab !== 'signup'): ?>
            <div class="message <?= $msgType ?>"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <!-- Social Choice Selection -->
        <div id="social-choice-login">
            <p style="text-align: center; margin-bottom: 20px; color: #666; font-size: 14px;">Select your login method:</p>
            <div class="social-buttons" style="margin-bottom: 20px;">
                <button type="button" class="social-btn google" onclick="selectProvider('google')">
                    <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google">
                    Login with Google
                </button>
                <button type="button" class="social-btn facebook" onclick="selectProvider('facebook')">
                    <i class="fa-brands fa-facebook-f"></i>
                    Login with Facebook
                </button>
            </div>
            <div class="divider"><span>or use</span></div>
            <button type="button" class="social-btn" style="border-style: dashed;" onclick="selectProvider('standard')">
                <i class="fa-solid fa-envelope"></i> Regular Email Login
            </button>
        </div>

        <!-- Hidden Credential Form -->
        <form id="login-cred-form" method="POST" action="login.php" style="display: none;">
            <input type="hidden" name="action" value="login">
            <input type="hidden" name="login_method" id="login_method" value="standard">
            <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect) ?>">
            
            <div id="provider-badge" style="margin-bottom: 15px; text-align: center; display: none;">
                <span id="badge-text" style="padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; display: inline-flex; align-items: center; gap: 5px;"></span>
            </div>

            <div class="form-group">
                <label id="email-label">Email Address</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" id="login-email" placeholder="Enter your email" required>
                </div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
            </div>
            <button type="submit" class="submit-btn" id="login-submit-btn"><i class="fa-solid fa-right-to-bracket"></i> Log In</button>
            <button type="button" class="back-home" style="width: 100%; border: none; background: none; margin-top: 10px;" onclick="resetSelection()">
                <i class="fa-solid fa-rotate-left"></i> Change Login Method
            </button>
        </form>
    </div>

    <!-- SIGNUP FORM -->
    <div id="form-signup" class="form-section <?= $tab === 'signup' ? 'active' : '' ?>">
        <?php if ($message && $tab === 'signup'): ?>
            <div class="message <?= $msgType ?>"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <form method="POST" action="login.php?tab=signup">
            <input type="hidden" name="action" value="signup">
            <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect) ?>">
            <div class="form-group">
                <label>Full Name</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="name" placeholder="Enter your full name" required>
                </div>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-phone"></i>
                    <input type="tel" name="phone" placeholder="09XXXXXXXXX">
                </div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Create a password" required>
                </div>
            </div>
            <button type="submit" class="submit-btn"><i class="fa-solid fa-user-plus"></i> Create Account</button>
        </form>
    </div>

    <a href="index.html" class="back-home"><i class="fa-solid fa-arrow-left"></i> Back to Home</a>
</div>

<script>
function switchTab(tab) {
    document.getElementById('form-login').classList.remove('active');
    document.getElementById('form-signup').classList.remove('active');
    document.getElementById('tab-login').classList.remove('active');
    document.getElementById('tab-signup').classList.remove('active');

    document.getElementById('form-' + tab).classList.add('active');
    document.getElementById('tab-' + tab).classList.add('active');
    
    if (tab === 'login') resetSelection();
}

function selectProvider(provider) {
    const choiceDiv = document.getElementById('social-choice-login');
    const form = document.getElementById('login-cred-form');
    const methodInput = document.getElementById('login_method');
    const badge = document.getElementById('provider-badge');
    const badgeText = document.getElementById('badge-text');
    const emailLabel = document.getElementById('email-label');
    const submitBtn = document.getElementById('login-submit-btn');

    methodInput.value = provider;
    choiceDiv.style.display = 'none';
    form.style.display = 'block';

    if (provider === 'google') {
        badge.style.display = 'block';
        badgeText.style.background = '#f1f3f4';
        badgeText.style.color = '#3c4043';
        badgeText.innerHTML = '<img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" style="width:16px;"> Google Login';
        emailLabel.textContent = 'Google Email Address';
        submitBtn.innerHTML = '<i class="fa-brands fa-google"></i> Login with Google';
    } else if (provider === 'facebook') {
        badge.style.display = 'block';
        badgeText.style.background = '#e7f3ff';
        badgeText.style.color = '#1877f2';
        badgeText.innerHTML = '<i class="fa-brands fa-facebook"></i> Facebook Login';
        emailLabel.textContent = 'Facebook Email Address';
        submitBtn.innerHTML = '<i class="fa-brands fa-facebook-f"></i> Login with Facebook';
    } else {
        badge.style.display = 'none';
        emailLabel.textContent = 'Email Address';
        submitBtn.innerHTML = '<i class="fa-solid fa-right-to-bracket"></i> Log In';
    }
}

function resetSelection() {
    document.getElementById('social-choice-login').style.display = 'block';
    document.getElementById('login-cred-form').style.display = 'none';
}
</script>

</body>
</html>
