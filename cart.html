
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Your Cart</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

body {
  font-family: Arial, sans-serif;
  background-color: #f5f5f5;
}

/* Header */
header {
  background-color: #ff6f61;
  color: white;
  padding: 20px;
  text-align: center;
  position: relative;
}

header h1 { margin: 0; font-size: 2em; }

.back-btn {
  position: absolute;
  top: 20px;
  left: 20px;
  padding: 10px 20px;
  background: linear-gradient(135deg, #ffffff, #f8f8f8);
  color: #333;
  border: 1px solid rgba(0,0,0,0.08);
  border-radius: 50px;
  font-weight: 600;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  transition: all 0.3s ease;
  text-decoration: none;
}

.back-btn:hover {
  background: #ff6f61;
  color: #fff;
  transform: translateY(-3px);
  box-shadow: 0 8px 18px rgba(0,0,0,0.15);
}

/* Cart container */
main {
  padding: 40px 20px;
  max-width: 900px;
  margin: auto;
}

.cart-empty {
  text-align: center;
  padding: 60px 20px;
  background: white;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.cart-empty i {
  font-size: 60px;
  color: #ccc;
  margin-bottom: 15px;
}

.cart-empty p {
  font-size: 1.2em;
  color: #888;
  margin-bottom: 20px;
}

.cart-empty a {
  display: inline-block;
  padding: 12px 30px;
  background: #ff6f61;
  color: white;
  text-decoration: none;
  border-radius: 50px;
  font-weight: 600;
  transition: background 0.3s;
}

.cart-empty a:hover { background: #e55b50; }

/* Cart items */
.cart-item {
  display: flex;
  align-items: center;
  background: white;
  padding: 15px;
  margin-bottom: 12px;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  transition: transform 0.2s;
}

.cart-item:hover {
  transform: translateX(4px);
}

.cart-item img {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 8px;
  margin-right: 20px;
}

.cart-item-info {
  flex: 1;
}

.cart-item-info h3 {
  margin: 0 0 5px 0;
  color: #333;
  font-size: 1.1em;
}

.cart-item-info .price {
  color: #ff6f61;
  font-weight: bold;
  font-size: 1.1em;
}

.cart-item .remove-btn {
  padding: 8px 16px;
  background: #f44336;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 600;
  font-size: 0.9em;
  transition: background 0.3s;
}

.cart-item .remove-btn:hover { background: #d32f2f; }

.cart-item .checkout-item-btn {
  padding: 8px 16px;
  background: #4CAF50;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 600;
  font-size: 0.9em;
  transition: background 0.3s;
  margin-right: 10px;
}

.cart-item .checkout-item-btn:hover { background: #45a049; }

/* Summary */
.cart-summary {
  background: white;
  padding: 20px;
  border-radius: 10px;
  margin-top: 20px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.cart-summary .total {
  font-size: 1.3em;
  font-weight: bold;
  color: #333;
}

.cart-summary .total span {
  color: #ff6f61;
}

.checkout-btn {
  padding: 12px 30px;
  background: #4CAF50;
  color: white;
  border: none;
  border-radius: 50px;
  font-weight: 600;
  font-size: 1em;
  cursor: pointer;
  transition: background 0.3s;
}

.checkout-btn:hover { background: #45a049; }

footer {
  text-align: center;
  padding: 20px;
  background-color: #333;
  color: white;
  margin-top: 40px;
}

/* Responsive Design */
@media (max-width: 768px) {
  header {
    padding: 20px 15px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
  }
  .back-btn {
    position: static;
  }
  
  .cart-item {
    flex-direction: column;
    text-align: center;
    position: relative;
    padding: 20px 15px;
  }
  .cart-item img {
    margin: 0 0 15px 0;
    width: 120px;
    height: 120px;
  }
  .cart-item-info {
    margin-bottom: 20px;
  }
  .cart-item button {
    width: 100%;
    margin: 5px 0;
  }
  .cart-item .checkout-item-btn {
    margin-right: 0;
  }
  
  .cart-summary {
    flex-direction: column;
    gap: 15px;
    text-align: center;
  }
  .checkout-btn {
    width: 100%;
  }
}
</style>
</head>
<body>

<header>
  <a class="back-btn" href="sales.php"><i class="fa-solid fa-arrow-left"></i> Back to Shop</a>
  <h1><i class="fa-solid fa-cart-shopping"></i> Your Cart</h1>
</header>

<main id="cart-main">
  <!-- Cart content will be rendered by JavaScript from localStorage -->
</main>

<footer>
&copy; 2026 My Online Store
</footer>

<script>
// Load cart from localStorage
let cart = JSON.parse(localStorage.getItem('cart') || '[]');

function saveCart() {
  localStorage.setItem('cart', JSON.stringify(cart));
}

function renderCart() {
  const main = document.getElementById('cart-main');

  if (cart.length === 0) {
    main.innerHTML = `
      <div class="cart-empty">
        <i class="fa-solid fa-cart-shopping"></i>
        <p>Your cart is empty!</p>
        <a href="sales.php">Continue Shopping</a>
      </div>
    `;
    return;
  }

  let total = 0;
  let itemsHtml = '<div id="cart-list">';

  cart.forEach(function(item, index) {
    const price = parseFloat(item.price);
    total += price;
    itemsHtml += `
      <div class="cart-item" data-index="${index}">
        <img src="${item.img || 'placeholder.jpg'}" alt="${item.name}">
        <div class="cart-item-info">
          <h3>${item.name}</h3>
          <div class="price">$${price.toFixed(2)}</div>
        </div>
        <button class="checkout-item-btn" onclick="checkoutItem(${index})"><i class="fa-solid fa-credit-card"></i> Checkout</button>
        <button class="remove-btn" onclick="removeItem(${index})"><i class="fa-solid fa-trash"></i> Remove</button>
      </div>
    `;
  });

  itemsHtml += '</div>';

  itemsHtml += `
    <div class="cart-summary">
      <div class="total">Total: <span>$${total.toFixed(2)}</span> (${cart.length} item${cart.length > 1 ? 's' : ''})</div>
      <button class="checkout-btn" onclick="goToCheckout()"><i class="fa-solid fa-credit-card"></i> Checkout</button>
    </div>
  `;

  main.innerHTML = itemsHtml;
}

function removeItem(index) {
  const itemEl = document.querySelector(`.cart-item[data-index="${index}"]`);
  if (itemEl) {
    itemEl.style.transition = 'all 0.3s ease';
    itemEl.style.opacity = '0';
    itemEl.style.transform = 'translateX(50px)';
  }
  setTimeout(function() {
    cart.splice(index, 1);
    saveCart();
    renderCart();
  }, 300);
}

function goToCheckout() {
  if (cart.length === 0) {
    alert('Your cart is empty!');
    return;
  }
  const form = document.createElement('form');
  form.method = 'POST';
  form.action = 'auth.php';
  
  const input = document.createElement('input');
  input.type = 'hidden';
  input.name = 'orderData';
  input.value = JSON.stringify(cart);
  form.appendChild(input);
  
  const actionInput = document.createElement('input');
  actionInput.type = 'hidden';
  actionInput.name = 'cartAction';
  actionInput.value = 'all';
  form.appendChild(actionInput);

  document.body.appendChild(form);
  form.submit();
}

function checkoutItem(index) {
  const item = cart[index];
  if (!item) return;
  
  const form = document.createElement('form');
  form.method = 'POST';
  form.action = 'auth.php';
  
  const input = document.createElement('input');
  input.type = 'hidden';
  input.name = 'orderData';
  input.value = JSON.stringify([item]);
  form.appendChild(input);

  const actionInput = document.createElement('input');
  actionInput.type = 'hidden';
  actionInput.name = 'cartAction';
  actionInput.value = index.toString();
  form.appendChild(actionInput);

  document.body.appendChild(form);
  form.submit();
}

// Initial render
renderCart();
</script>

</body>
</html>