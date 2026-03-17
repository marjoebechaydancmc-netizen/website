<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GCash Payment</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<style>
body { font-family: Arial, sans-serif; background: #f5f5f5; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
.payment-card { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); text-align: center; max-width: 450px; width: 100%; box-sizing: border-box;}
.payment-card img { max-width: 250px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
.btn { display: inline-block; padding: 14px 25px; background: #005ce6; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: 0.3s; margin-top: 20px; text-decoration: none; width: 100%; box-sizing: border-box;}
.btn:hover { background: #004bb5; }
.file-input-container { margin-top: 25px; text-align: left; }
.file-input-container label { font-weight: bold; font-size: 14px; display: block; margin-bottom: 8px; color: #333; }
.file-input-container input { width: 100%; padding: 12px; border: 2px dashed #005ce6; border-radius: 8px; background: #eef2ff; color: #333; box-sizing: border-box; cursor: pointer;}
.header-text { margin-bottom: 5px; color: #005ce6; font-size: 28px; font-weight: 800; }
.sub-text { color: #666; margin-bottom: 25px; font-size: 15px; }

/* OVERLAY */
.overlay{ display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.6); z-index: 999; justify-content: center; align-items: center; }
.overlay.active{ display: flex; }
.success-popup{ background: white; padding: 40px 50px; border-radius: 16px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.3); animation: popIn 0.4s ease; max-width: 450px; }
@keyframes popIn{ 0%{ transform: scale(0.5); opacity: 0; } 100%{ transform: scale(1); opacity: 1; } }
.success-popup .check-icon{ font-size: 60px; color: #4CAF50; margin-bottom: 15px; }
.success-popup h2{ color: #333; margin-bottom: 10px; }
.success-popup p{ color: #666; margin-bottom: 25px; font-size: 16px; }
.success-popup .home-btn{ display: inline-block; padding: 12px 30px; background: #ff5722; color: white; text-decoration: none; border-radius: 50px; font-weight: 600; transition: 0.3s; margin: 5px;}
.success-popup .home-btn:hover{ background: #e64a19; }

/* Responsive Design */
@media (max-width: 768px) {
    .payment-card {
        padding: 30px 20px;
        width: 95%;
        margin: 20px auto;
    }
    .header-text {
        font-size: 24px;
    }
    .payment-card img {
        width: 100%;
        height: auto;
    }
    .success-popup {
        width: 90%;
        padding: 30px 20px;
    }
}
</style>
</head>
<body>

<?php
$paymentSuccess = false;
$amountToPay = isset($_GET['amount']) ? htmlspecialchars($_GET['amount']) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_payment'])) {
    if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $filename = time() . '_' . basename($_FILES['receipt']['name']);
        move_uploaded_file($_FILES['receipt']['tmp_name'], $uploadDir . $filename);
        $paymentSuccess = true;
    }
}
?>

<div class="payment-card">
    <h2 class="header-text">GCash Payment</h2>
    <?php if ($amountToPay): ?>
        <p class="sub-text" style="font-size: 18px; margin-bottom: 10px;">Total Amount to Pay: <strong style="color: #ff5722; font-size: 24px;">$<?= $amountToPay ?></strong></p>
    <?php endif; ?>
    <p class="sub-text">Scan the QR code below or send your payment to <strong>09556004191</strong></p>
    
    <img src="gcash.jpg" alt="GCash QR Code" onerror="this.onerror=null; this.src='https://via.placeholder.com/250x250.png?text=GCash+QR';">
    
    <form action="payment.php" method="POST" enctype="multipart/form-data">
        <div class="file-input-container">
            <label for="receipt"><i class="fa-solid fa-file-invoice-dollar"></i> Upload Payment Receipt:</label>
            <input type="file" name="receipt" id="receipt" accept="image/*" required>
        </div>
        
        <button type="submit" name="submit_payment" class="btn"><i class="fa-solid fa-paper-plane"></i> Submit Payment</button>
    </form>
    
    <a href="auth.php" style="display:block; margin-top: 15px; color: #888; text-decoration: none; font-size: 14px;">Cancel Payment</a>
</div>

<!-- SUCCESS POPUP OVERLAY -->
<div class="overlay" id="successOverlay">
    <div class="success-popup">
        <div class="check-icon"><i class="fa-solid fa-circle-check"></i></div>
        <h2>Payment Received!</h2>
        <p>🧾 Your receipt has been uploaded and your order is processing successfully!</p>
        <div style="display:flex; justify-content:center; flex-wrap:wrap;">
          <a href="pro.php" class="home-btn"><i class="fa-solid fa-truck"></i> Continue</a>
        </div>
    </div>
</div>

<script>
<?php if ($paymentSuccess): ?>
    document.getElementById('successOverlay').classList.add('active');
<?php endif; ?>
</script>

</body>
</html>