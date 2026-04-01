<?php
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php?redirect=pro.php');
    exit;
}

$usersFile = __DIR__ . '/users.json';
$orders = [];

if (file_exists($usersFile)) {
    $users = json_decode(file_get_contents($usersFile), true);
    foreach ($users as $u) {
        if ($u['email'] === $_SESSION['user_email']) {
            $orders = $u['orders'] ?? [];
            break;
        }
    }
}

// Simulate shipping progress based on time
function getShippingStatus($orderDate) {
    $placed = strtotime($orderDate);
    $now = time();
    $hoursElapsed = ($now - $placed) / 3600;

    if ($hoursElapsed < 0.5) return ['status' => 'Processing', 'icon' => 'fa-box', 'color' => '#ff9800', 'progress' => 15];
    if ($hoursElapsed < 2) return ['status' => 'Packed', 'icon' => 'fa-box-open', 'color' => '#2196F3', 'progress' => 35];
    if ($hoursElapsed < 6) return ['status' => 'Shipped', 'icon' => 'fa-truck', 'color' => '#9c27b0', 'progress' => 55];
    if ($hoursElapsed < 24) return ['status' => 'Out for Delivery', 'icon' => 'fa-truck-fast', 'color' => '#ff5722', 'progress' => 80];
    return ['status' => 'Delivered', 'icon' => 'fa-circle-check', 'color' => '#4CAF50', 'progress' => 100];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Orders - Trendy Threads</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    min-height: 100vh;
}

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

.container {
    max-width: 900px;
    margin: 30px auto;
    padding: 0 20px;
}

/* Empty state */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.empty-state i {
    font-size: 60px;
    color: #ddd;
    margin-bottom: 15px;
}

.empty-state p {
    font-size: 1.1em;
    color: #888;
    margin-bottom: 20px;
}

.empty-state a {
    display: inline-block;
    padding: 12px 30px;
    background: linear-gradient(135deg, #ff7e5f, #feb47b);
    color: white;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 600;
    transition: 0.3s;
}

.empty-state a:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(255,126,95,0.3); }

/* Order card */
.order-card {
    background: white;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: 0.3s;
}

.order-card:hover {
    box-shadow: 0 6px 25px rgba(0,0,0,0.12);
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 20px;
    background: #fafafa;
    border-bottom: 1px solid #f0f0f0;
    flex-wrap: wrap;
    gap: 10px;
}

.order-id {
    font-weight: 700;
    color: #333;
    font-size: 15px;
}

.order-date {
    color: #999;
    font-size: 13px;
}

.order-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 16px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 13px;
    color: white;
}

/* Progress bar */
.progress-bar-container {
    padding: 15px 20px;
    background: #fafafa;
}

.progress-bar {
    height: 6px;
    background: #e8e8e8;
    border-radius: 3px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    border-radius: 3px;
    transition: width 1s ease;
}

.progress-steps {
    display: flex;
    justify-content: space-between;
    margin-top: 8px;
    font-size: 11px;
    color: #bbb;
}

.progress-steps span.active {
    color: #ff7e5f;
    font-weight: 600;
}

/* Order items */
.order-items {
    padding: 15px 20px;
}

.order-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 0;
    border-bottom: 1px solid #f5f5f5;
}

.order-item:last-child { border-bottom: none; }

.order-item img {
    width: 55px;
    height: 55px;
    border-radius: 8px;
    object-fit: cover;
}

.order-item-name {
    flex: 1;
    font-weight: 500;
    color: #333;
    font-size: 14px;
}

.order-item-price {
    font-weight: 700;
    color: #ff7e5f;
    font-size: 14px;
}

/* Order footer */
.order-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background: #fafafa;
    border-top: 1px solid #f0f0f0;
    flex-wrap: wrap;
    gap: 8px;
}

.order-payment {
    font-size: 13px;
    color: #888;
}

.order-payment i { margin-right: 5px; }

.order-total {
    font-weight: 700;
    font-size: 16px;
    color: #333;
}

.order-total span {
    color: #ff7e5f;
}

footer {
    text-align: center;
    padding: 20px;
    background: #333;
    color: white;
    margin-top: 40px;
    font-size: 0.85em;
}

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
    
    .order-header {
        flex-direction: column;
        align-items: flex-start;
    }
    .order-status {
        margin-top: 10px;
    }
    
    .progress-steps span {
        font-size: 9px;
        text-align: center;
    }
    
    .order-item {
        flex-direction: column;
        align-items: flex-start;
    }
    .order-item img {
        width: 100%;
        height: 120px;
        margin-bottom: 10px;
    }
    
    .order-footer {
        flex-direction: column;
        align-items: flex-start;
    }
    .order-total {
        margin-top: 10px;
        align-self: flex-end;
    }
}
</style>
</head>
<body>

<div class="header">
    <a href="sales.php" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Shop</a>
    <h1><i class="fa-solid fa-truck"></i> My Orders</h1>
</div>

<div class="container">

<?php if (empty($orders)): ?>
    <div class="empty-state">
        <i class="fa-solid fa-receipt"></i>
        <p>You haven't placed any orders yet.</p>
        <a href="sales.php"><i class="fa-solid fa-bag-shopping"></i> Start Shopping</a>
    </div>
<?php else: ?>
    <?php foreach ($orders as $order):
        $status = getShippingStatus($order['date']);
        $progress = $status['progress'];
    ?>
    <div class="order-card">
        <!-- Order Header -->
        <div class="order-header">
            <div>
                <div class="order-id"><i class="fa-solid fa-receipt"></i> <?= htmlspecialchars($order['id']) ?></div>
                <div class="order-date"><i class="fa-regular fa-calendar"></i> <?= date('M d, Y - h:i A', strtotime($order['date'])) ?></div>
            </div>
            <div class="order-status" style="background: <?= $status['color'] ?>;">
                <i class="fa-solid <?= $status['icon'] ?>"></i> <?= $status['status'] ?>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="progress-bar-container">
            <div class="progress-bar">
                <div class="progress-fill" style="width: <?= $progress ?>%; background: linear-gradient(90deg, <?= $status['color'] ?>, <?= $status['color'] ?>aa);"></div>
            </div>
            <div class="progress-steps">
                <span class="<?= $progress >= 15 ? 'active' : '' ?>">Processing</span>
                <span class="<?= $progress >= 35 ? 'active' : '' ?>">Packed</span>
                <span class="<?= $progress >= 55 ? 'active' : '' ?>">Shipped</span>
                <span class="<?= $progress >= 80 ? 'active' : '' ?>">Out for Delivery</span>
                <span class="<?= $progress >= 100 ? 'active' : '' ?>">Delivered</span>
            </div>
        </div>

        <!-- Order Items -->
        <div class="order-items">
            <?php foreach ($order['items'] as $item): ?>
            <div class="order-item">
                <img src="<?= htmlspecialchars($item['img'] ?? 'placeholder.jpg') ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                <div class="order-item-name"><?= htmlspecialchars($item['name']) ?></div>
                <div class="order-item-price">$<?= number_format(floatval($item['price']), 2) ?></div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Order Footer -->
        <div class="order-footer">
            <div class="order-payment">
                <i class="fa-solid fa-credit-card"></i> <?= htmlspecialchars($order['payment_method'] ?? 'Cash on Delivery') ?>
                &nbsp;|&nbsp;
                <i class="fa-solid fa-truck"></i> Shipping: $<?= number_format(floatval($order['shipping_fee'] ?? 50), 2) ?>
            </div>
            <div class="order-total">Total: <span>$<?= number_format(floatval($order['total'] ?? 0), 2) ?></span></div>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>

</div>

<footer>
    &copy; 2026 Trendy Threads. All rights reserved.
</footer>

</body>
</html>