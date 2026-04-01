<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || ($_SESSION['user_role'] ?? '') !== 'admin') {
    header('Location: admin_login.php');
    exit;
}

$usersFile = __DIR__ . '/users.json';
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

$income = 0;
$salesCount = 0;
$salesHistory = []; 
$currentAdminData = [];

if (is_array($users)) {
    foreach ($users as $u) {
        if (($u['email'] ?? '') === ($_SESSION['user_email'] ?? '')) {
            $currentAdminData = $u;
        }
        if (isset($u['orders']) && is_array($u['orders'])) {
            foreach ($u['orders'] as $order) {
                $income += (float)($order['total'] ?? 0);
                if (isset($order['items']) && is_array($order['items'])) {
                    $salesCount += count($order['items']);
                }
                
                $salesHistory[] = [
                    'id' => $order['id'] ?? 'N/A',
                    'date' => $order['date'] ?? 'Unknown Date',
                    'buyer' => htmlspecialchars($u['name'] ?? 'Unknown'),
                    'items' => isset($order['items']) ? count($order['items']) : 0,
                    'total' => number_format((float)($order['total'] ?? 0), 2),
                    'method' => $order['payment_method'] ?? 'N/A',
                    'status' => $order['status'] ?? 'Completed'
                ];
            }
        }
    }
}

// Sort sales history by date descending (newest first)
usort($salesHistory, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

$productsFile = __DIR__ . '/products.json';
$productsData = file_exists($productsFile) ? file_get_contents($productsFile) : '[]';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_profile') {
    $newName = $_POST['name'] ?? '';
    $newPass = $_POST['password'] ?? '';
    $newPic  = $_POST['profile_pic'] ?? '';
    
    if ($newName && $newPass) {
        if (is_array($users)) {
            foreach ($users as &$u) {
                if (($u['email'] ?? '') === ($_SESSION['user_email'] ?? '')) {
                    $u['name'] = $newName;
                    $u['password'] = $newPass;
                    $u['profile_pic'] = $newPic;
                    $_SESSION['user_name'] = $newName; 
                    break;
                }
            }
            unset($u);
            file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
        }
        header("Location: admin.php?tab=profile&updated=1"); 
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_product') {
    $pname = $_POST['name'] ?? '';
    $pprice = floatval($_POST['price'] ?? 0);
    $pstock = intval($_POST['stock'] ?? 0);
    
    if ($pname && $pprice > 0 && $pstock > 0) {
        $prods = json_decode($productsData, true);
        if (!is_array($prods)) $prods = [];
        $prods[] = [
            'name' => $pname,
            'price' => $pprice,
            'stock' => $pstock,
            'img' => 'placeholder.jpg',
            'desc' => 'Newly added product.'
        ];
        file_put_contents($productsFile, json_encode($prods, JSON_PRETTY_PRINT));
        header("Location: admin.php?tab=stocks"); 
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #f1f5f9;
}

/* SIDEBAR */
.sidebar {
    width: 220px;
    height: 100vh;
    background: #111827;
    color: white;
    position: fixed;
    padding: 20px;
}

.sidebar h2 {
    text-align: center;
}

.sidebar a {
    display: block;
    color: #cbd5e1;
    padding: 12px;
    margin: 10px 0;
    border-radius: 6px;
    cursor: pointer;
    text-decoration: none;
}

.sidebar a:hover {
    background: #1f2937;
    color: white;
}

/* MAIN */
.main {
    margin-left: 240px;
    padding: 20px;
}

.page {
    display: none;
}

.active {
    display: block;
}

/* CARDS */
.cards {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.card {
    flex: 1;
    background: white;
    padding: 20px;
    border-radius: 12px;
}

/* TABLE */
table {
    width: 100%;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    text-align: left;
}

th, td {
    padding: 10px;
}

th {
    background: #111827;
    color: white;
}

tr:nth-child(even) {
    background: #f3f4f6;
}

button {
    padding: 6px 10px;
    border: none;
    background: #2563eb;
    color: white;
    border-radius: 5px;
    cursor: pointer;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="profile-widget" onclick="showPage('profile')" style="text-align: center; cursor: pointer; margin-bottom: 20px; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'" title="Edit Profile">
        <img src="<?= htmlspecialchars(!empty($currentAdminData['profile_pic']) ? $currentAdminData['profile_pic'] : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png') ?>" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 10px; border: 2px solid #2563eb; background: white;">
        <h3 style="margin: 0; color: white; font-size: 16px;"><?= htmlspecialchars($currentAdminData['name'] ?? 'Administrator') ?></h3>
        <p style="margin: 5px 0 0 0; color: #cbd5e1; font-size: 12px;"><?= htmlspecialchars($currentAdminData['email'] ?? '') ?></p>
    </div>
    <hr style="border: 0; border-top: 1px solid #374151; margin-bottom: 20px;">
    
    <a onclick="showPage('dashboard')">📊 Dashboard</a>
    <a onclick="showPage('sales')">💰 Sales</a>
    <a onclick="showPage('stocks')">📦 Stocks</a>
    <a onclick="showPage('profile')">⚙️ Account Settings</a>
    <a href="login.php?action=logout" style="color: #ef4444; margin-top: 30px;">🚪 Logout</a>
</div>

<!-- MAIN -->
<div class="main">

    <!-- DASHBOARD -->
    <div id="dashboard" class="page active">
        <div class="cards">
            <div class="card">
                <h3>Total Income</h3>
                <p id="income">$0</p>
            </div>
            <div class="card">
                <h3>Total Items Sold</h3>
                <p id="salesCount">0</p>
            </div>
            <div class="card">
                <h3>Products</h3>
                <p id="productCount">0</p>
            </div>
        </div>

        <div class="card">
            <h3>Cumulative Income Growth</h3>
            <canvas id="chart"></canvas>
        </div>
    </div>

    <!-- SALES PAGE -->
    <div id="sales" class="page">
        <h2 style="margin-bottom: 20px;">Sales & Order History</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date & Time</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Payment</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="salesList"></tbody>
        </table>
    </div>

    <!-- STOCKS PAGE -->
    <div id="stocks" class="page">
        <h2>Product Stocks</h2>

        <form method="POST" action="admin.php" style="margin-bottom: 20px;">
            <input type="hidden" name="action" value="add_product">
            <input name="name" id="name" placeholder="Product name" required style="padding: 8px; margin-right: 5px; border: 1px solid #ccc; border-radius: 4px;">
            <input name="price" id="price" type="number" step="0.01" placeholder="Price" required style="padding: 8px; margin-right: 5px; border: 1px solid #ccc; border-radius: 4px;">
            <input name="stock" id="stock" type="number" placeholder="Stock" required style="padding: 8px; margin-right: 5px; border: 1px solid #ccc; border-radius: 4px;">
            <button type="submit" style="padding: 8px 15px;">Add Product</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock Remaining</th>
                    <th>Sales Source</th>
                </tr>
            </thead>
            <tbody id="list"></tbody>
        </table>
    </div>

    <!-- PROFILE PAGE -->
    <div id="profile" class="page">
        <h2>Admin Profile</h2>
        <?php if (isset($_GET['updated'])): ?>
            <p style="color: #155724; background: #d4edda; padding: 10px; border-radius: 4px; border: 1px solid #c3e6cb; margin-bottom: 20px;">Profile updated successfully!</p>
        <?php endif; ?>
        <div class="card" style="max-width: 500px;">
            <form method="POST" action="admin.php">
                <input type="hidden" name="action" value="update_profile">
                
                <label style="display:block; margin-bottom: 5px; font-weight: bold; color: #333;">Email Address <span style="font-weight:normal; color:#888;">(Read-only)</span></label>
                <input type="email" value="<?= htmlspecialchars($currentAdminData['email'] ?? '') ?>" readonly style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; background: #e9ecef; box-sizing: border-box; color: #555; outline: none;">
                
                <label style="display:block; margin-bottom: 5px; font-weight: bold; color: #333;">Full Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($currentAdminData['name'] ?? '') ?>" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
                
                <label style="display:block; margin-bottom: 5px; font-weight: bold; color: #333;">Password</label>
                <input type="text" name="password" value="<?= htmlspecialchars($currentAdminData['password'] ?? '') ?>" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
                
                <label style="display:block; margin-bottom: 5px; font-weight: bold; color: #333;">Profile Picture URL</label>
                <input type="text" name="profile_pic" value="<?= htmlspecialchars($currentAdminData['profile_pic'] ?? '') ?>" placeholder="http://example.com/image.jpg" style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
                
                <button type="submit" style="padding: 12px 20px; font-size: 16px; width: 100%; background: #2563eb; color: white; border: none; border-radius: 5px; cursor: pointer;">Save Changes</button>
            </form>
        </div>
    </div>

</div>

<script>
let products = <?= $productsData ?>;
let income = <?= $income ?>;
let sales = <?= json_encode($salesHistory) ?>;
let chart;

// NAVIGATION
function showPage(page) {
    document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
    document.getElementById(page).classList.add('active');
}

// UPDATE UI
function update() {
    document.getElementById("income").innerText = "$" + income.toFixed(2);
    document.getElementById("salesCount").innerText = sales.length; // Items sold
    document.getElementById("productCount").innerText = products.length;

    // PRODUCTS
    let list = document.getElementById("list");
    list.innerHTML = "";
    products.forEach((p, i) => {
        let stock = p.stock !== undefined ? p.stock : 0;
        let pName = p.name ? p.name : 'Unknown Product';
        let pPrice = p.price !== undefined ? parseFloat(p.price).toFixed(2) : '0.00';
        list.innerHTML += `
        <tr>
            <td>${pName}</td>
            <td>$${pPrice}</td>
            <td><strong>${stock}</strong></td>
            <td><span style="color:#666; font-size:12px;">Purchases via Website</span></td>
        </tr>`;
    });

    // SALES LIST
    let salesList = document.getElementById("salesList");
    salesList.innerHTML = "";
    if(sales.length === 0) {
        salesList.innerHTML = "<tr><td colspan='7' style='text-align:center; padding: 20px;'>No sales recorded yet.</td></tr>";
    } else {
        sales.forEach(s => {
            let statusColor = s.status === 'Processing' ? 'color: #d97706; background: #fef3c7;' : 'color: #059669; background: #d1fae5;';
            salesList.innerHTML += `
            <tr style="border-bottom: 1px solid #f1f5f9;">
                <td style="font-family: monospace; font-weight: bold; color: #2563eb;">${s.id}</td>
                <td><i class="fa-regular fa-clock" style="color: #64748b; margin-right:4px;"></i> ${s.date}</td>
                <td style="font-weight: bold; color: #334155;">${s.buyer}</td>
                <td>${s.items} item(s)</td>
                <td><span style="font-size: 11px; font-weight: bold; background: #e2e8f0; padding: 4px 8px; border-radius: 4px; color: #475569;">${s.method}</span></td>
                <td style="font-weight: bold; color: #059669;">$${s.total}</td>
                <td><span style="font-size: 11px; padding: 4px 8px; border-radius: 4px; font-weight: bold; ${statusColor}">${s.status}</span></td>
            </tr>`;
        });
    }

    drawChart();
}

// CHART
function drawChart() {
    let ctx = document.getElementById("chart");

    if (chart) chart.destroy();

    let cumulative = 0;
    // Map chronological order
    let reversedSales = [...sales].reverse(); 
    let growthData = reversedSales.map(s => {
        cumulative += parseFloat(s.total.replace(/,/g, ''));
        return cumulative;
    });

    chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: reversedSales.map(s => s.id),
            datasets: [{
                label: 'Cumulative Income ($)',
                data: growthData,
                borderWidth: 2,
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.2)',
                fill: true,
                tension: 0.3
            }]
        }
    });
}

// Initialize UI
window.onload = function() {
    update();
    let urlParams = new URLSearchParams(window.location.search);
    let tabParam = urlParams.get('tab');
    if (tabParam && document.getElementById(tabParam)) {
        showPage(tabParam);
    }
};
</script>

</body>
</html>