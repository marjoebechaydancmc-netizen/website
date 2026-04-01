<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php?redirect=prof.php');
    exit;
}

$usersFile = __DIR__ . '/users.json';
$uploadsDir = __DIR__ . '/uploads/';
$message = '';
$msgType = '';

// Create uploads dir if needed
if (!is_dir($uploadsDir)) {
    mkdir($uploadsDir, 0755, true);
}

// Load users
function loadUsers() {
    global $usersFile;
    if (!file_exists($usersFile)) return [];
    return json_decode(file_get_contents($usersFile), true);
}

function saveUsers($users) {
    global $usersFile;
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
}

// Get current user
function getCurrentUser() {
    $users = loadUsers();
    foreach ($users as $u) {
        if ($u['email'] === $_SESSION['user_email']) {
            return $u;
        }
    }
    return null;
}

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $users = loadUsers();
    foreach ($users as &$u) {
        if ($u['email'] === $_SESSION['user_email']) {
            $u['name'] = trim($_POST['name'] ?? $u['name']);
            $u['phone'] = trim($_POST['phone'] ?? $u['phone'] ?? '');
            $u['region'] = trim($_POST['region'] ?? $u['region'] ?? '');
            $u['province'] = trim($_POST['province'] ?? $u['province'] ?? '');
            $u['city'] = trim($_POST['city'] ?? $u['city'] ?? '');
            $u['barangay'] = trim($_POST['barangay'] ?? $u['barangay'] ?? '');
            $u['street'] = trim($_POST['street'] ?? $u['street'] ?? '');

            // Handle profile picture upload
            if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $ext = strtolower(pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION));
                if (in_array($ext, $allowed)) {
                    $filename = 'profile_' . md5($u['email']) . '.' . $ext;
                    $dest = $GLOBALS['uploadsDir'] . $filename;
                    if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $dest)) {
                        $u['profile_pic'] = 'uploads/' . $filename;
                        $_SESSION['user_profile_pic'] = $u['profile_pic'];
                    }
                } else {
                    $message = 'Invalid image format. Use JPG, PNG, GIF, or WEBP.';
                    $msgType = 'error';
                }
            }

            $_SESSION['user_name'] = $u['name'];
            $_SESSION['user_phone'] = $u['phone'];
            break;
        }
    }
    unset($u);
    saveUsers($users);
    if (!$message) {
        $message = 'Profile updated successfully!';
        $msgType = 'success';
    }
}

$user = getCurrentUser();
if (!$user) {
    header('Location: login.php');
    exit;
}

$profilePic = !empty($user['profile_pic']) ? $user['profile_pic'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Profile - Trendy Threads</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    min-height: 100vh;
}

/* Header */
.header {
    background: linear-gradient(135deg, #ff7e5f, #feb47b);
    color: white;
    padding: 20px;
    text-align: center;
    position: relative;
}

.header h1 { font-size: 1.8em; }

.back-btn {
    position: absolute;
    top: 50%;
    left: 20px;
    transform: translateY(-50%);
    padding: 8px 20px;
    background: rgba(255,255,255,0.2);
    color: white;
    border: 2px solid rgba(255,255,255,0.5);
    border-radius: 50px;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: 0.3s;
}

.back-btn:hover {
    background: white;
    color: #ff7e5f;
    border-color: white;
}

/* Profile Banner */
.profile-banner {
    background: linear-gradient(135deg, #ff7e5f, #feb47b);
    padding: 0 0 60px 0;
    text-align: center;
    position: relative;
}

.profile-pic-wrapper {
    position: relative;
    display: inline-block;
    margin-top: -30px;
}

.profile-pic {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    border: 5px solid white;
    object-fit: cover;
    background: #eee;
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    cursor: pointer;
    transition: 0.3s;
}

.profile-pic:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 30px rgba(0,0,0,0.3);
}

.profile-pic-placeholder {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    border: 5px solid white;
    background: linear-gradient(135deg, #e0e0e0, #ccc);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 50px;
    color: #999;
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    cursor: pointer;
    transition: 0.3s;
}

.profile-pic-placeholder:hover {
    transform: scale(1.05);
}

.upload-badge {
    position: absolute;
    bottom: 5px;
    right: 5px;
    width: 36px;
    height: 36px;
    background: #ff7e5f;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
    border: 3px solid white;
    cursor: pointer;
    transition: 0.3s;
}

.upload-badge:hover { background: #e66050; transform: scale(1.1); }

.profile-name {
    color: white;
    font-size: 1.6em;
    margin-top: 15px;
    font-weight: 700;
}

.profile-email {
    color: rgba(255,255,255,0.85);
    font-size: 0.95em;
    margin-top: 5px;
}

/* Container */
.container {
    max-width: 800px;
    margin: -30px auto 30px;
    padding: 0 20px;
    position: relative;
    z-index: 1;
}

/* Cards */
.card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.card h3 {
    color: #ff7e5f;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f5f5f5;
    font-size: 1.1em;
}

.card h3 i {
    margin-right: 8px;
}

/* Info display */
.info-row {
    display: flex;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f5f5f5;
}

.info-row:last-child { border-bottom: none; }

.info-row .info-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(135deg, #fff0ed, #ffe5e0);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ff7e5f;
    margin-right: 15px;
    flex-shrink: 0;
}

.info-row .info-label {
    font-size: 12px;
    color: #999;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-row .info-value {
    font-size: 15px;
    color: #333;
    font-weight: 500;
    margin-top: 2px;
}

.info-row .info-empty {
    font-size: 14px;
    color: #ccc;
    font-style: italic;
}

/* Edit Form */
.edit-section {
    display: none;
}

.edit-section.active {
    display: block;
}

.form-group {
    margin-bottom: 16px;
}

.form-group label {
    display: block;
    font-weight: 600;
    font-size: 13px;
    color: #666;
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-group input {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e8e8e8;
    border-radius: 8px;
    font-size: 15px;
    transition: 0.3s;
    box-sizing: border-box;
}

.form-group input:focus {
    border-color: #ff7e5f;
    outline: none;
    box-shadow: 0 0 0 3px rgba(255, 126, 95, 0.12);
}

/* Buttons */
.btn-group {
    display: flex;
    gap: 12px;
    margin-top: 10px;
}

.edit-btn, .save-btn, .cancel-btn {
    padding: 12px 28px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: 0.3s;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.edit-btn {
    background: linear-gradient(135deg, #ff7e5f, #feb47b);
    color: white;
}

.edit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 126, 95, 0.3);
}

.save-btn {
    background: #4CAF50;
    color: white;
}

.save-btn:hover { background: #45a049; }

.cancel-btn {
    background: #eee;
    color: #666;
}

.cancel-btn:hover { background: #ddd; }

/* Message */
.message {
    padding: 12px 18px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 14px;
    text-align: center;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    0% { transform: translateY(-10px); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
}

.message.success {
    background: #e8f5e9;
    color: #2e7d32;
    border: 1px solid #c8e6c9;
}

.message.error {
    background: #ffebee;
    color: #d32f2f;
    border: 1px solid #ffcdd2;
}

footer {
    text-align: center;
    padding: 20px;
    background: #333;
    color: white;
    margin-top: 40px;
    font-size: 0.85em;
}

#profilePicInput { display: none; }

/* Responsive Design */
@media (max-width: 768px) {
    .header {
        padding: 20px 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }
    .back-btn {
        position: static;
        transform: none;
        align-self: flex-start;
    }
    
    .info-row {
        flex-direction: column;
        align-items: flex-start;
    }
    .info-row .info-icon {
        margin-bottom: 10px;
    }
    
    .btn-group {
        flex-direction: column;
    }
    .btn-group button {
        width: 100%;
        justify-content: center;
    }
    .edit-btn {
        width: 100%;
        justify-content: center;
    }
}
</style>
</head>
<body>

<!-- Header -->
<div class="header">
    <a href="front.php" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Home</a>
    <h1><i class="fa-solid fa-user-circle"></i> My Profile</h1>
</div>

<!-- Profile Banner -->
<div class="profile-banner">
    <div class="profile-pic-wrapper" onclick="document.getElementById('profilePicInput').click()">
        <?php if ($profilePic): ?>
            <img src="<?= htmlspecialchars($profilePic) ?>" alt="Profile" class="profile-pic" id="profilePicPreview">
        <?php else: ?>
            <div class="profile-pic-placeholder" id="profilePicPreview">
                <i class="fa-solid fa-user"></i>
            </div>
        <?php endif; ?>
        <div class="upload-badge"><i class="fa-solid fa-camera"></i></div>
    </div>
    <div class="profile-name"><?= htmlspecialchars($user['name']) ?></div>
    <div class="profile-email"><i class="fa-solid fa-envelope"></i> <?= htmlspecialchars($user['email']) ?></div>
</div>

<div class="container">

    <?php if ($message): ?>
        <div class="message <?= $msgType ?>"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <!-- VIEW MODE -->
    <div id="viewMode">
        <!-- Personal Info Card -->
        <div class="card">
            <h3><i class="fa-solid fa-id-card"></i> Personal Information</h3>
            <div class="info-row">
                <div class="info-icon"><i class="fa-solid fa-user"></i></div>
                <div>
                    <div class="info-label">Full Name</div>
                    <div class="info-value"><?= htmlspecialchars($user['name']) ?></div>
                </div>
            </div>
            <div class="info-row">
                <div class="info-icon"><i class="fa-solid fa-envelope"></i></div>
                <div>
                    <div class="info-label">Email Address</div>
                    <div class="info-value"><?= htmlspecialchars($user['email']) ?></div>
                </div>
            </div>
            <div class="info-row">
                <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
                <div>
                    <div class="info-label">Phone Number</div>
                    <?php if (!empty($user['phone'])): ?>
                        <div class="info-value"><?= htmlspecialchars($user['phone']) ?></div>
                    <?php else: ?>
                        <div class="info-empty">Not set</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Address Card -->
        <div class="card">
            <h3><i class="fa-solid fa-location-dot"></i> Shipping Address</h3>
            <?php
            $addressFields = [
                ['icon' => 'fa-map', 'label' => 'Region', 'key' => 'region'],
                ['icon' => 'fa-map-pin', 'label' => 'Province', 'key' => 'province'],
                ['icon' => 'fa-city', 'label' => 'City / Municipality', 'key' => 'city'],
                ['icon' => 'fa-signs-post', 'label' => 'Barangay', 'key' => 'barangay'],
                ['icon' => 'fa-house', 'label' => 'Street / House No.', 'key' => 'street'],
            ];
            foreach ($addressFields as $f):
            ?>
            <div class="info-row">
                <div class="info-icon"><i class="fa-solid <?= $f['icon'] ?>"></i></div>
                <div>
                    <div class="info-label"><?= $f['label'] ?></div>
                    <?php if (!empty($user[$f['key']])): ?>
                        <div class="info-value"><?= htmlspecialchars($user[$f['key']]) ?></div>
                    <?php else: ?>
                        <div class="info-empty">Not set</div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <button class="edit-btn" onclick="toggleEdit()">
            <i class="fa-solid fa-pen-to-square"></i> Edit Profile
        </button>
    </div>

    <!-- EDIT MODE -->
    <div id="editMode" class="edit-section">
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="update_profile" value="1">
            <input type="file" name="profile_pic" id="profilePicInput" accept="image/*" onchange="previewPic(this)">

            <div class="card">
                <h3><i class="fa-solid fa-id-card"></i> Personal Information</h3>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Email (cannot be changed)</label>
                    <input type="email" value="<?= htmlspecialchars($user['email']) ?>" disabled style="background:#f5f5f5;">
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" placeholder="09XXXXXXXXX">
                </div>
            </div>

            <div class="card">
                <h3><i class="fa-solid fa-location-dot"></i> Shipping Address</h3>
                <div class="form-group">
                    <label>Region</label>
                    <input type="text" name="region" value="<?= htmlspecialchars($user['region'] ?? '') ?>" placeholder="Region">
                </div>
                <div class="form-group">
                    <label>Province</label>
                    <input type="text" name="province" value="<?= htmlspecialchars($user['province'] ?? '') ?>" placeholder="Province">
                </div>
                <div class="form-group">
                    <label>City / Municipality</label>
                    <input type="text" name="city" value="<?= htmlspecialchars($user['city'] ?? '') ?>" placeholder="City">
                </div>
                <div class="form-group">
                    <label>Barangay</label>
                    <input type="text" name="barangay" value="<?= htmlspecialchars($user['barangay'] ?? '') ?>" placeholder="Barangay">
                </div>
                <div class="form-group">
                    <label>Street / House No.</label>
                    <input type="text" name="street" value="<?= htmlspecialchars($user['street'] ?? '') ?>" placeholder="Street / House Number">
                </div>
            </div>

            <div class="btn-group">
                <button type="submit" class="save-btn"><i class="fa-solid fa-check"></i> Save Changes</button>
                <button type="button" class="cancel-btn" onclick="toggleEdit()"><i class="fa-solid fa-xmark"></i> Cancel</button>
            </div>
        </form>
    </div>

</div>

<footer>
    &copy; 2026 Trendy Threads. All rights reserved.
</footer>

<script>
function toggleEdit() {
    var view = document.getElementById('viewMode');
    var edit = document.getElementById('editMode');
    if (edit.classList.contains('active')) {
        edit.classList.remove('active');
        view.style.display = 'block';
    } else {
        edit.classList.add('active');
        view.style.display = 'none';
    }
}

function previewPic(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var preview = document.getElementById('profilePicPreview');
            // Replace placeholder div with an img if needed
            if (preview.tagName !== 'IMG') {
                var img = document.createElement('img');
                img.id = 'profilePicPreview';
                img.className = 'profile-pic';
                img.alt = 'Profile';
                preview.parentNode.replaceChild(img, preview);
                preview = img;
            }
            preview.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</body>
</html>