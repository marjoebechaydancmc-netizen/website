<?php
  session_start();
  
  $usersFile = __DIR__ . '/users.json';
  
  // Handle saving buyer info via AJAX
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['saveBuyerInfo'])) {
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && file_exists($usersFile)) {
      $users = json_decode(file_get_contents($usersFile), true);
      foreach ($users as &$u) {
        if ($u['email'] === $_SESSION['user_email']) {
          $u['name'] = $_POST['buyer_name'] ?? $u['name'];
          $u['phone'] = $_POST['buyer_phone'] ?? $u['phone'] ?? '';
          $u['region'] = $_POST['buyer_region'] ?? $u['region'] ?? '';
          $u['province'] = $_POST['buyer_province'] ?? $u['province'] ?? '';
          $u['city'] = $_POST['buyer_city'] ?? $u['city'] ?? '';
          $u['barangay'] = $_POST['buyer_barangay'] ?? $u['barangay'] ?? '';
          $u['street'] = $_POST['buyer_street'] ?? $u['street'] ?? '';
          $_SESSION['user_name'] = $u['name'];
          $_SESSION['user_phone'] = $u['phone'];
          
          // Save the order
          if (isset($_POST['orderItems'])) {
            $orderItems = json_decode($_POST['orderItems'], true);
            if (!isset($u['orders'])) $u['orders'] = [];
            $order = [
              'id' => 'ORD-' . strtoupper(substr(md5(time() . rand()), 0, 8)),
              'date' => date('Y-m-d H:i:s'),
              'items' => $orderItems,
              'shipping_fee' => floatval($_POST['shipping_fee'] ?? 50),
              'payment_method' => $_POST['payment_method'] ?? 'Cash on Delivery',
              'status' => 'Processing'
            ];
            $subtotal = 0;
            foreach ($orderItems as $oi) $subtotal += floatval($oi['price']);
            $order['subtotal'] = $subtotal;
            $order['total'] = $subtotal + $order['shipping_fee'];
            array_unshift($u['orders'], $order);

            // Deduct from products.json
            $productsFile = __DIR__ . '/products.json';
            if (file_exists($productsFile)) {
                $productsData = json_decode(file_get_contents($productsFile), true);
                if (is_array($productsData)) {
                    foreach ($orderItems as $oi) {
                        foreach ($productsData as &$p) {
                            if ($p['name'] === $oi['name']) {
                                if (!isset($p['stock'])) $p['stock'] = 100;
                                $p['stock'] = max(0, $p['stock'] - 1);
                                break;
                            }
                        }
                    }
                    unset($p);
                    file_put_contents($productsFile, json_encode($productsData, JSON_PRETTY_PRINT));
                }
            }
          }
          break;
        }
      }
      unset($u);
      file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
    }
    echo 'ok';
    exit;
  }
  
  // Load user profile data
  $userProfile = [];
  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && file_exists($usersFile)) {
    $users = json_decode(file_get_contents($usersFile), true);
    foreach ($users as $u) {
      if ($u['email'] === $_SESSION['user_email']) {
        $userProfile = $u;
        break;
      }
    }
  }

  $orderItems = [];
  $cartAction = 'none';
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['orderData'])) {
    $orderItems = json_decode($_POST['orderData'], true);
    if (isset($_POST['cartAction'])) {
        $cartAction = $_POST['cartAction'];
    }
  }
  $subtotal = 0;
  foreach ($orderItems as $item) {
    $subtotal += floatval($item['price']);
  }
  $shipping = 50;
  $total = $subtotal + $shipping;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout - Purchase Product</title>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
body{
    margin:0;
    font-family: Arial, sans-serif;
    background:#f5f5f5;
}

/* HEADER */
.header{
    background:#ff5722;
    color:white;
    padding:15px;
    text-align:center;
    font-size:20px;
    font-weight:bold;
    position: relative;
}

.header .back-link{
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: white;
    text-decoration: none;
    font-size: 14px;
    background: rgba(255,255,255,0.2);
    padding: 8px 16px;
    border-radius: 50px;
    transition: 0.3s;
}

.header .back-link:hover{
    background: rgba(255,255,255,0.4);
}

/* CONTAINER */
.container{
    max-width:900px;
    margin:20px auto;
    padding:15px;
}

/* CARD STYLE */
.card{
    background:white;
    padding:20px;
    border-radius:8px;
    margin-bottom:20px;
    box-shadow:0 2px 8px rgba(0,0,0,0.05);
}

/* PRODUCT ITEM IN ORDER */
.order-item{
    display:flex;
    gap:15px;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #eee;
}

.order-item:last-child{
    border-bottom: none;
}

.order-item img{
    width:80px;
    height:80px;
    object-fit: cover;
    border-radius:6px;
}

.order-item-details{
    flex:1;
}

.order-item-details .item-name{
    font-weight: bold;
    font-size: 16px;
    color: #333;
    margin-bottom: 4px;
}

.order-item-details .item-price{
    color:#ff5722;
    font-weight:bold;
    font-size:16px;
}

.no-items{
    text-align: center;
    padding: 40px;
    color: #888;
}

.no-items a{
    display: inline-block;
    margin-top: 15px;
    padding: 10px 25px;
    background: #ff5722;
    color: white;
    text-decoration: none;
    border-radius: 50px;
}

/* INPUT STYLE */
input, select{
    width:100%;
    padding:10px;
    margin-top:8px;
    margin-bottom:15px;
    border-radius:5px;
    border:1px solid #ccc;
    box-sizing: border-box;
}

label{
    font-weight:bold;
    font-size:14px;
}

/* RADIO */
.radio-group{
    margin-bottom:15px;
    cursor: pointer;
}

.radio-group input{
    width:auto;
    margin-right:8px;
}

/* SUMMARY */
.summary-row{
    display:flex;
    justify-content:space-between;
    margin-bottom:10px;
    font-size: 16px;
}

.total-row{
    font-size:20px;
    font-weight:bold;
    color:#ff5722;
    border-top: 2px solid #eee;
    padding-top: 12px;
    margin-top: 8px;
}

/* BUTTON */
.checkout-btn{
    width:100%;
    padding:15px;
    background:#ff5722;
    color:white;
    border:none;
    border-radius:8px;
    font-size:18px;
    cursor:pointer;
    transition:0.3s;
}

.checkout-btn:hover{
    background:#e64a19;
}

/* SUCCESS OVERLAY */
.overlay{
    display: none;
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.6);
    z-index: 999;
    justify-content: center;
    align-items: center;
}

.overlay.active{
    display: flex;
}

.success-popup{
    background: white;
    padding: 40px 50px;
    border-radius: 16px;
    text-align: center;
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    animation: popIn 0.4s ease;
    max-width: 450px;
}

@keyframes popIn{
    0%{ transform: scale(0.5); opacity: 0; }
    100%{ transform: scale(1); opacity: 1; }
}

.success-popup .check-icon{
    font-size: 60px;
    color: #4CAF50;
    margin-bottom: 15px;
}

.success-popup h2{
    color: #333;
    margin-bottom: 10px;
}

.success-popup p{
    color: #666;
    margin-bottom: 25px;
    font-size: 16px;
}

.success-popup .home-btn{
    display: inline-block;
    padding: 12px 30px;
    background: #ff5722;
    color: white;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 600;
    transition: 0.3s;
    border: none;
    font-size: 16px;
    cursor: pointer;
}

.success-popup .home-btn:hover{
    background: #e64a19;
}

footer{
    text-align: center;
    padding: 20px;
    background: #333;
    color: white;
    margin-top: 40px;
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
    .header .back-link {
        position: static;
        transform: none;
        align-self: flex-start;
    }
    .order-item {
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
    }
    .order-item img {
        width: 100%;
        height: 150px;
        margin-bottom: 10px;
    }
    .success-popup {
        width: 90%;
        padding: 30px 20px;
    }
    .success-popup .home-btn {
        width: 100%;
        margin-bottom: 10px;
    }
}
</style>
</head>
<body>

<div class="header">
    <a class="back-link" href="sales.php"><i class="fa-solid fa-arrow-left"></i> Back to Shop</a>
    <i class="fa-solid fa-shield-halved"></i> Checkout
</div>

<div class="container">

<?php if (empty($orderItems)): ?>
    <div class="card no-items">
        <i class="fa-solid fa-box-open" style="font-size:50px; color:#ccc;"></i>
        <p>No items to checkout.</p>
        <a href="sales.php">Go Shopping</a>
    </div>
<?php else: ?>

    <!-- ORDER ITEMS -->
    <div class="card">
        <h3><i class="fa-solid fa-box"></i> Order Items (<?= count($orderItems) ?>)</h3>
        <?php foreach ($orderItems as $item):
            $name = htmlspecialchars($item['name']);
            $price = floatval($item['price']);
            $img = htmlspecialchars($item['img'] ?? 'placeholder.jpg');
        ?>
        <div class="order-item">
            <img src="<?= $img ?>" alt="<?= $name ?>">
            <div class="order-item-details">
                <div class="item-name"><?= $name ?></div>
                <div class="item-price">$<?= number_format($price, 2) ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- BUYER INFO -->
    <div class="card">
        <h3><i class="fa-solid fa-user"></i> Buyer Information</h3>
        <label>Full Name</label>
        <input type="text" id="buyer_name" placeholder="Enter your full name" value="<?= htmlspecialchars($userProfile['name'] ?? '') ?>">

        <label>Email Address</label>
        <input type="email" id="buyer_email" placeholder="Enter your email" value="<?= htmlspecialchars($userProfile['email'] ?? '') ?>">

        <label>Contact Number</label>
        <input type="tel" id="buyer_phone" placeholder="09XXXXXXXXX" value="<?= htmlspecialchars($userProfile['phone'] ?? '') ?>">
    </div>

    <!-- SHIPPING ADDRESS -->
    <div class="card">
        <h3><i class="fa-solid fa-location-dot"></i> Shipping Address</h3>
        <label>Region</label>
        <input type="text" id="buyer_region" placeholder="Region" value="<?= htmlspecialchars($userProfile['region'] ?? '') ?>">

        <label>Province</label>
        <input type="text" id="buyer_province" placeholder="Province" value="<?= htmlspecialchars($userProfile['province'] ?? '') ?>">

        <label>City/Municipality</label>
        <input type="text" id="buyer_city" placeholder="City" value="<?= htmlspecialchars($userProfile['city'] ?? '') ?>">

        <label>Barangay</label>
        <input type="text" id="buyer_barangay" placeholder="Barangay" value="<?= htmlspecialchars($userProfile['barangay'] ?? '') ?>">

        <label>Street / House No.</label>
        <input type="text" id="buyer_street" placeholder="Street / House Number" value="<?= htmlspecialchars($userProfile['street'] ?? '') ?>">
    </div>

    <!-- SHIPPING METHOD -->
    <div class="card">
        <h3><i class="fa-solid fa-truck"></i> Shipping Method</h3>
        <div class="radio-group">
            <input type="radio" name="shipping" value="50" id="standard" checked onchange="updateShipping()"> 
            <label for="standard">Standard Delivery ($50.00)</label>
        </div>
        <div class="radio-group">
            <input type="radio" name="shipping" value="120" id="express" onchange="updateShipping()"> 
            <label for="express">Express Delivery ($120.00)</label>
        </div>
    </div>

    <!-- PAYMENT METHOD -->
    <div class="card">
        <h3><i class="fa-solid fa-credit-card"></i> Payment Method</h3>
        <div class="radio-group">
            <input type="radio" name="payment" id="cod" checked> 
            <label for="cod">Cash on Delivery</label>
        </div>
        <div class="radio-group">
            <input type="radio" name="payment" id="gcash"> 
            <label for="gcash">GCash</label>
        </div>
        <div class="radio-group">
            <input type="radio" name="payment" id="card"> 
            <label for="card">Credit/Debit Card</label>
        </div>
    </div>

    <!-- ORDER SUMMARY -->
    <div class="card">
        <h3><i class="fa-solid fa-receipt"></i> Order Summary</h3>
        <div class="summary-row">
            <span>Subtotal (<?= count($orderItems) ?> item<?= count($orderItems) > 1 ? 's' : '' ?>)</span>
            <span id="subtotal">$<?= number_format($subtotal, 2) ?></span>
        </div>
        <div class="summary-row">
            <span>Shipping Fee</span>
            <span id="shipping-fee">$<?= number_format($shipping, 2) ?></span>
        </div>
        <div class="summary-row total-row">
            <span>Total</span>
            <span id="total">$<?= number_format($total, 2) ?></span>
        </div>
    </div>

    <button class="checkout-btn" onclick="placeOrder()">
        <i class="fas fa-shopping-bag"></i> Place Order
    </button>

<?php endif; ?>
</div>

<!-- SUCCESS POPUP OVERLAY -->
<div class="overlay" id="successOverlay">
    <div class="success-popup">
        <div class="check-icon"><i class="fa-solid fa-circle-check"></i></div>
        <h2>Order Placed Successfully!</h2>
        <p>🚚 Your order is shipped now! Thank you for shopping with us.</p>
        <div style="display:flex; gap:12px; justify-content:center; flex-wrap:wrap;">
          <a href="pro.php" class="home-btn"><i class="fa-solid fa-truck"></i> Track My Orders</a>
          <a href="sales.php" class="home-btn" style="background:#666;"><i class="fa-solid fa-bag-shopping"></i> Continue Shopping</a>
        </div>
    </div>
</div>

<footer>
&copy; 2026 My Online Store
</footer>

<script>
var subtotal = <?= $subtotal ?>;
var orderItemsData = <?= json_encode($orderItems) ?>;
var cartAction = '<?= htmlspecialchars($cartAction) ?>';

function updateShipping() {
    var shippingRadios = document.querySelectorAll('input[name="shipping"]');
    var shippingFee = 50;
    shippingRadios.forEach(function(r) {
        if (r.checked) shippingFee = parseFloat(r.value);
    });
    var total = subtotal + shippingFee;
    document.getElementById('shipping-fee').innerText = '$' + shippingFee.toFixed(2);
    document.getElementById('total').innerText = '$' + total.toFixed(2);
}

function placeOrder() {
    // Validate all required fields
    var fields = [
      { id: 'buyer_name', label: 'Full Name' },
      { id: 'buyer_email', label: 'Email Address' },
      { id: 'buyer_phone', label: 'Contact Number' },
      { id: 'buyer_region', label: 'Region' },
      { id: 'buyer_province', label: 'Province' },
      { id: 'buyer_city', label: 'City/Municipality' },
      { id: 'buyer_barangay', label: 'Barangay' },
      { id: 'buyer_street', label: 'Street / House No.' }
    ];

    var missing = [];

    // Reset all field borders
    fields.forEach(function(f) {
      var el = document.getElementById(f.id);
      el.style.border = '1px solid #ccc';
    });

    // Check each field
    fields.forEach(function(f) {
      var el = document.getElementById(f.id);
      if (!el.value.trim()) {
        missing.push(f.label);
        el.style.border = '2px solid #f44336';
        el.style.background = '#fff5f5';
      }
    });

    if (missing.length > 0) {
      alert('⚠️ Please fill in all required fields:\n\n• ' + missing.join('\n• '));
      // Scroll to the first empty field
      var firstEmpty = document.getElementById(fields.find(f => !document.getElementById(f.id).value.trim()).id);
      firstEmpty.scrollIntoView({ behavior: 'smooth', block: 'center' });
      firstEmpty.focus();
      return;
    }

    // Save buyer info + order to profile
    var formData = new FormData();
    formData.append('saveBuyerInfo', '1');
    formData.append('buyer_name', document.getElementById('buyer_name').value);
    formData.append('buyer_phone', document.getElementById('buyer_phone').value);
    formData.append('buyer_region', document.getElementById('buyer_region').value);
    formData.append('buyer_province', document.getElementById('buyer_province').value);
    formData.append('buyer_city', document.getElementById('buyer_city').value);
    formData.append('buyer_barangay', document.getElementById('buyer_barangay').value);
    formData.append('buyer_street', document.getElementById('buyer_street').value);
    formData.append('orderItems', JSON.stringify(orderItemsData));
    
    // Get selected shipping fee
    var shippingRadios = document.querySelectorAll('input[name="shipping"]');
    var shipFee = 50;
    shippingRadios.forEach(function(r) { if (r.checked) shipFee = parseFloat(r.value); });
    formData.append('shipping_fee', shipFee);
    
    // Get selected payment method
    var paymentRadios = document.querySelectorAll('input[name="payment"]');
    var payMethod = 'Cash on Delivery';
    paymentRadios.forEach(function(r) { if (r.checked) payMethod = r.nextElementSibling.textContent.trim(); });
    formData.append('payment_method', payMethod);
    
    fetch('auth.php', { method: 'POST', body: formData })
      .then(() => {
        if (cartAction === 'all') {
            localStorage.removeItem('cart');
        } else if (cartAction !== 'none') {
            let currentCart = JSON.parse(localStorage.getItem('cart') || '[]');
            let i = parseInt(cartAction);
            if (!isNaN(i) && i >= 0 && i < currentCart.length) {
                currentCart.splice(i, 1);
                localStorage.setItem('cart', JSON.stringify(currentCart));
            }
        }

        if (payMethod === 'GCash') {
           var totalAmount = subtotal + shipFee;
           window.location.href = 'payment.php?amount=' + totalAmount;
        } else {
           document.getElementById('successOverlay').classList.add('active');
        }
      })
      .catch(() => {
        if (cartAction === 'all') {
            localStorage.removeItem('cart');
        } else if (cartAction !== 'none') {
            let currentCart = JSON.parse(localStorage.getItem('cart') || '[]');
            let i = parseInt(cartAction);
            if (!isNaN(i) && i >= 0 && i < currentCart.length) {
                currentCart.splice(i, 1);
                localStorage.setItem('cart', JSON.stringify(currentCart));
            }
        }

        if (payMethod === 'GCash') {
           var totalAmount = subtotal + shipFee;
           window.location.href = 'payment.php?amount=' + totalAmount;
        } else {
           document.getElementById('successOverlay').classList.add('active');
        }
      });
}
</script>

</body>
</html>