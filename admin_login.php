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

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $name = trim($_POST['name'] ?? '');
    $admin_code = trim($_POST['admin_code'] ?? ''); // Optional security
    $role = 'admin'; // Hardcoded

    $users = loadUsers();

    if ($action === 'signup') {
        if (empty($email) || empty($password) || empty($name)) {
            $message = 'Please fill in all fields.';
            $msgType = 'error';
        } else if ($admin_code !== 'ADMIN123') { // Simple hardcoded passcode for basic security
            $message = 'Invalid Admin Security Code.';
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
                    'phone' => '', // optional for admin
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
                $_SESSION['user_role'] = $role;
                $_SESSION['logged_in'] = true;

                header('Location: admin.php');
                exit;
            }
        }
    } elseif ($action === 'login') {
        if (empty($email) || empty($password)) {
            $message = 'Please enter email and password.';
            $msgType = 'error';
        } else {
            $found = false;
            $user_to_login = null;

            foreach ($users as $u) {
                if ($u['email'] === $email && $u['password'] === $password) {
                    $user_to_login = $u;
                    $found = true;
                    break;
                }
            }

            if ($found) {
                if (($user_to_login['role'] ?? 'sales') !== 'admin') {
                    $message = 'Access Denied: This account is not an Admin account.';
                    $msgType = 'error';
                } else {
                    $_SESSION['user_name'] = $user_to_login['name'];
                    $_SESSION['user_email'] = $user_to_login['email'];
                    $_SESSION['user_role'] = 'admin';
                    $_SESSION['logged_in'] = true;
                    
                    header('Location: admin.php');
                    exit;
                }
            } else {
                $message = 'Invalid email or password.';
                $msgType = 'error';
            }
        }
    }
}

$tab = $_GET['tab'] ?? 'login';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login - Trendy Threads</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #111827, #374151); /* Dark theme for admin */
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.login-container {
    background: white;
    border-radius: 16px;
    box-shadow: 0 15px 50px rgba(0,0,0,0.5);
    width: 420px;
    max-width: 95%;
    overflow: hidden;
}
.login-header {
    background: #1f2937;
    color: white;
    padding: 30px 20px;
    text-align: center;
}
.login-header h1 { font-size: 1.8em; margin-bottom: 5px; }
.login-header p { font-size: 0.95em; opacity: 0.9; }
.tabs { display: flex; border-bottom: 2px solid #f0f0f0; }
.tabs button {
    flex: 1; padding: 14px; background: none; border: none; font-size: 16px;
    font-weight: 600; cursor: pointer; color: #aaa; transition: 0.3s;
    border-bottom: 3px solid transparent;
}
.tabs button.active { color: #2563eb; border-bottom-color: #2563eb; }
.form-section { display: none; padding: 30px 25px; }
.form-section.active { display: block; }
.form-group { margin-bottom: 18px; }
.form-group label { display: block; font-weight: 600; font-size: 14px; margin-bottom: 6px; color: #555; }
.form-group .input-wrap { position: relative; }
.form-group .input-wrap i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #bbb; }
.form-group input { width: 100%; padding: 12px 12px 12px 40px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 16px; box-sizing: border-box; }
.form-group input:focus { border-color: #2563eb; outline: none; }
.submit-btn {
    width: 100%; padding: 14px; background: #2563eb; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: 0.3s;
}
.submit-btn:hover { background: #1d4ed8; }
.message { padding: 10px 15px; border-radius: 8px; margin-bottom: 15px; font-size: 14px; text-align: center; }
.message.error { background: #ffe0e0; color: #d32f2f; }
.message.success { background: #e0ffe0; color: #2e7d32; }

/* Home Link */
.back-home {
    display: block;
    text-align: center;
    padding: 15px;
    color: #888;
    text-decoration: none;
    font-size: 14px;
    transition: 0.3s;
    background: #f8f9fa;
}
.back-home:hover {
    color: #2563eb;
    background: #e2e8f0;
}
</style>
</head>
<body>

<div class="login-container">
    <div class="login-header">
        <h1><i class="fa-solid fa-user-shield"></i> Admin Portal</h1>
        <p>Login or Register as Administrator</p>
    </div>

    <div class="tabs">
        <button id="tab-login" class="<?= $tab === 'login' ? 'active' : '' ?>" onclick="switchTab('login')">
            <i class="fa-solid fa-right-to-bracket"></i> Log In
        </button>
        <button id="tab-signup" class="<?= $tab === 'signup' ? 'active' : '' ?>" onclick="switchTab('signup')">
            <i class="fa-solid fa-user-plus"></i> Register
        </button>
    </div>

    <!-- LOGIN FORM -->
    <div id="form-login" class="form-section <?= $tab === 'login' ? 'active' : '' ?>">
        <?php if ($message && $tab !== 'signup'): ?>
            <div class="message <?= $msgType ?>"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <form method="POST" action="admin_login.php">
            <input type="hidden" name="action" value="login">
            <div class="form-group">
                <label>Admin Email</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" placeholder="Enter admin email" required>
                </div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Enter password" required>
                </div>
            </div>
            <button type="submit" class="submit-btn"><i class="fa-solid fa-right-to-bracket"></i> Log In</button>
        </form>
    </div>

    <!-- SIGNUP FORM -->
    <div id="form-signup" class="form-section <?= $tab === 'signup' ? 'active' : '' ?>">
        <?php if ($message && $tab === 'signup'): ?>
            <div class="message <?= $msgType ?>"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <form method="POST" action="admin_login.php?tab=signup">
            <input type="hidden" name="action" value="signup">
            <div class="form-group">
                <label>Full Name</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="name" placeholder="Enter your name" required>
                </div>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" placeholder="Enter email" required>
                </div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Create a password" required>
                </div>
            </div>
            <div class="form-group">
                <label>Admin Security Code <small>(default: ADMIN123)</small></label>
                <div class="input-wrap">
                    <i class="fa-solid fa-key"></i>
                    <input type="text" name="admin_code" placeholder="Enter security code" required>
                </div>
            </div>
            <button type="submit" class="submit-btn"><i class="fa-solid fa-user-shield"></i> Register Admin</button>
        </form>
    </div>
    
    <a href="index.html" class="back-home"><i class="fa-solid fa-house"></i> Return to Main Website</a>
</div>

<script>
function switchTab(tab) {
    document.getElementById('form-login').classList.remove('active');
    document.getElementById('form-signup').classList.remove('active');
    document.getElementById('tab-login').classList.remove('active');
    document.getElementById('tab-signup').classList.remove('active');

    document.getElementById('form-' + tab).classList.add('active');
    document.getElementById('tab-' + tab).classList.add('active');
}
</script>

</body>
</html>
