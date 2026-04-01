<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Our Products</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
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

h1 { margin: 0; font-size: 2em; }

/* Back button */
.back-btn {
  position: absolute;
  top: 20px;
  left: 20px;
  padding: 10px 20px;
  background: linear-gradient(135deg, #ffffff, #f8f8f8);
  color: #333;
  border: 1px solid rgba(0, 0, 0, 0.08);
  border-radius: 50px;
  font-weight: 600;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  transition: all 0.3s ease;
}

.back-btn:hover {
  background: #ff6f61;
  color: #fff;
  transform: translateY(-3px);
  box-shadow: 0 8px 18px rgba(0,0,0,0.15);
}

/* Cart button */
.cart-btn {
  padding: 10px 20px;
  background: linear-gradient(135deg, #ffffff, #f8f8f8);
  color: #333;
  border: 1px solid rgba(0,0,0,0.08);
  border-radius: 50px;
  font-weight: 600;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 5px;
  transition: all 0.3s ease;
}

.cart-btn:hover {
  background: linear-gradient(135deg, #ff3d2e, #e63323);
  color: #fff;
}

/* Profile button */
.profile-btn {
  padding: 10px 20px;
  background: linear-gradient(135deg, #ffffff, #f8f8f8);
  color: #333;
  border: 1px solid rgba(0,0,0,0.08);
  border-radius: 50px;
  font-weight: 600;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 5px;
  transition: all 0.3s ease;
  text-decoration: none;
  font-size: 14px;
}

.profile-btn:hover {
  background: linear-gradient(135deg, #ff7e5f, #feb47b);
  color: #fff;
}

/* Orders button */
.orders-btn {
  padding: 10px 20px;
  background: linear-gradient(135deg, #ffffff, #f8f8f8);
  color: #333;
  border: 1px solid rgba(0,0,0,0.08);
  border-radius: 50px;
  font-weight: 600;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 5px;
  transition: all 0.3s ease;
  text-decoration: none;
  font-size: 14px;
}

.orders-btn:hover {
  background: linear-gradient(135deg, #4CAF50, #66BB6A);
  color: #fff;
}

/* Cart count bubble */
.cart-count {
  background: #ff6f61;
  color: white;
  font-size: 12px;
  padding: 2px 6px;
  border-radius: 50%;
}

/* Product grid */
main {
  padding: 40px 20px;
  max-width: 1200px;
  margin: auto;
}

.search-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

.search-wrapper i {
  position: absolute;
  left: 15px;
  color: #777;
  font-size: 14px;
}

.search-input {
  box-sizing: border-box;
  padding: 10px 15px 10px 38px;
  font-size: 14px;
  border: none;
  border-radius: 50px;
  outline: none;
  width: 150px;
  transition: width 0.4s ease, box-shadow 0.3s ease;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  background: white;
  color: #333;
}

.search-input::placeholder {
  color: #999;
}

.search-input:focus {
  width: 250px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 20px;
}

.product-card {
  background-color: white;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  transition: transform 0.3s, box-shadow 0.3s;
  height: 100%; /* Keep cards from stretching too much visually */
  display: flex;
  flex-direction: column;
  animation: fadeInUp 0.6s ease backwards;
}

@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

.product-card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.product-content {
  padding: 15px;
  display: flex;
  flex-direction: column;
  flex-grow: 1; /* Pushes buttons to the bottom */
}

.product-content h2 { font-size: 1.2em; margin: 0 0 10px 0; color: #333; }

.product-content p { font-size: 0.95em; color: #666; margin-bottom: 10px; flex-grow: 1; }

.product-content .price { font-weight: bold; color: #ff6f61; font-size: 1.1em; margin-bottom: 15px; }

.product-buttons {
  display: flex;
  gap: 10px;
}

.product-buttons button {
  flex: 1;
  padding: 10px 0;
  border-radius: 5px;
  border: none;
  cursor: pointer;
  font-weight: 600;
}

.add-cart-btn {
  background: white;
  color: #ff6f61;
  border: 1px solid #ff6f61;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 5px;
}

.add-cart-btn:hover {
  background: #ffe5e2;
}

.buy-btn {
  background: #ff6f61;
  color: white;
}

.buy-btn:hover {
  background: #e55b50;
}

/* Footer */
footer { 
  background: #333; 
  color: white; 
  padding: 60px 20px 20px; 
  margin-top: 40px;
}
.footer-content {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  flex-wrap: wrap;
  gap: 40px;
  margin-bottom: 40px;
  text-align: left;
}
.footer-section {
  flex: 1;
  min-width: 250px;
}
.footer-section h3 {
  color: #ff7e5f;
  margin-bottom: 20px;
  font-size: 1.5em;
}
.footer-section p {
  line-height: 1.6;
  font-size: 0.95em;
  color: #ccc;
}
.footer-section ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.footer-section ul li {
  margin-bottom: 10px;
}
.footer-section ul li a {
  color: #ccc;
  text-decoration: none;
  transition: color 0.3s;
}
.footer-section ul li a:hover {
  color: #ff7e5f;
}
.footer-section i {
  margin-right: 10px;
  color: #ff7e5f;
}
.footer-section .social-links a {
  color: #ccc;
  transition: color 0.3s;
}
.footer-section .social-links a:hover {
  color: #ff7e5f;
}
.footer-bottom {
  text-align: center;
  padding-top: 20px;
  border-top: 1px solid #555;
  font-size: 0.85em;
  color: #aaa;
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
    transform: none;
    align-self: flex-start;
  }
  header h1 {
    font-size: 1.8em;
  }
  .header-controls {
    position: static !important;
    width: 100%;
    justify-content: center;
    flex-wrap: wrap;
    gap: 10px;
  }
  .search-wrapper {
    width: 100%;
    order: -1; /* Place above other buttons on mobile */
    margin-bottom: 5px;
  }
  .search-input {
    width: 100%;
    padding: 12px 15px 12px 40px;
    font-size: 16px; /* Prevents iOS zoom */
  }
  .search-input:focus {
    width: 100%;
  }
  .product-grid {
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 15px;
  }
  .product-card img {
    height: 150px;
  }
  .product-content h2 {
    font-size: 1em;
  }
  .product-content p {
    font-size: 0.85em;
  }
  .product-buttons {
    flex-direction: column;
  }
}


/* Login Popup Overlay */
.login-overlay {
  display: none;
  position: fixed;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(0,0,0,0.6);
  z-index: 999;
  justify-content: center;
  align-items: center;
}
.login-overlay.active { display: flex; }

.login-popup {
  background: white;
  padding: 40px 45px;
  border-radius: 16px;
  text-align: center;
  box-shadow: 0 10px 40px rgba(0,0,0,0.3);
  animation: popIn 0.4s ease;
  max-width: 420px;
  width: 90%;
}

@keyframes popIn {
  0% { transform: scale(0.5); opacity: 0; }
  100% { transform: scale(1); opacity: 1; }
}

.login-popup .lock-icon {
  font-size: 50px;
  color: #ff6f61;
  margin-bottom: 15px;
}

.login-popup h2 {
  color: #333;
  margin-bottom: 10px;
}

.login-popup p {
  color: #666;
  margin-bottom: 25px;
  font-size: 15px;
}

.login-popup .popup-btns {
  display: flex;
  gap: 12px;
  justify-content: center;
}

.login-popup .popup-btns a {
  padding: 12px 28px;
  border-radius: 50px;
  font-weight: 600;
  font-size: 15px;
  text-decoration: none;
  transition: 0.3s;
}

.popup-login-btn {
  background: #ff6f61;
  color: white;
}
.popup-login-btn:hover { background: #e55b50; }

.popup-signup-btn {
  background: white;
  color: #ff6f61;
  border: 2px solid #ff6f61;
}
.popup-signup-btn:hover { background: #fff0ee; }

.popup-close {
  position: absolute;
  top: 12px;
  right: 16px;
  font-size: 22px;
  color: #aaa;
  cursor: pointer;
  background: none;
  border: none;
}
.popup-close:hover { color: #333; }

.login-popup { position: relative; }

/* Product Rating */
.product-rating {
  color: #ffb400;
  font-size: 0.9em;
  margin-bottom: 10px;
}
.product-rating span {
  color: #666;
  font-size: 0.9em;
  margin-left: 5px;
}

/* Product Modal */
.product-modal-overlay {
  display: none;
  position: fixed;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(0,0,0,0.7);
  z-index: 1000;
  justify-content: center;
  align-items: center;
  padding: 20px;
  backdrop-filter: blur(5px);
}
.product-modal-overlay.active { display: flex; }

.product-modal {
  background: white;
  border-radius: 16px;
  max-width: 850px;
  width: 95%;
  max-height: 90vh;
  overflow-y: auto;
  position: relative;
  display: flex;
  flex-direction: row;
  animation: popIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  box-shadow: 0 15px 50px rgba(0,0,0,0.3);
}

@keyframes popIn {
  0% { transform: scale(0.8) translateY(20px); opacity: 0; }
  100% { transform: scale(1) translateY(0); opacity: 1; }
}

@media(max-width: 768px) {
  .product-modal { flex-direction: column; border-radius: 12px; }
}

.modal-close {
  position: absolute;
  top: 15px; right: 20px;
  font-size: 28px;
  background: none; border: none;
  color: #aaa; cursor: pointer;
  z-index: 10;
}
.modal-close:hover { color: #333; }

.modal-img-container {
  flex: 1;
  background: #f9f9f9;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 16px 0 0 16px;
  padding: 20px;
}
@media(max-width: 768px) {
  .modal-img-container { border-radius: 16px 16px 0 0; }
}
.modal-img-container img {
  max-width: 100%;
  max-height: 400px;
  object-fit: contain;
  border-radius: 8px;
}

.modal-info {
  flex: 1;
  padding: 30px;
}
.modal-info h2 { margin-top: 0; color: #333; font-size: 1.8em; margin-bottom: 10px; }
.modal-info .modal-price { font-size: 1.5em; color: #ff6f61; font-weight: bold; margin-bottom: 15px; }
.modal-info .modal-desc { color: #555; line-height: 1.6; margin-bottom: 25px; }

.modal-reviews {
  background: #fdfdfd;
  padding: 15px;
  border-radius: 8px;
  border: 1px solid #eee;
  margin-bottom: 25px;
}
.modal-reviews h3 { font-size: 1.1em; color: #333; margin-top: 0; margin-bottom: 10px; }
.review-text { font-style: italic; color: #666; margin-bottom: 5px; }
.review-author { font-size: 0.85em; color: #999; font-weight: bold; }

.modal-info .product-buttons { margin-top: 20px; }
</style>
</head>

<body>

<header>
<button class="back-btn" onclick="window.location.href='index.html'">Home</button>
<h1>Our Products</h1>
<div class="header-controls" style="position:absolute; top:20px; right:20px; display:flex; gap:10px; align-items:center; z-index: 10;">
  <div class="search-wrapper">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" id="searchInput" class="search-input" placeholder="Search products...">
  </div>
  <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
    <a href="pro.php" class="orders-btn"><i class="fa-solid fa-truck"></i> My Orders</a>
    <a href="prof.php" class="profile-btn"><i class="fa-solid fa-user"></i> Profile</a>
  <?php endif; ?>
  <button class="cart-btn" onclick="goToCart()">
    <i class="fa-solid fa-cart-shopping"></i> Cart <span class="cart-count" id="cart-count">0</span>
  </button>
</div>
</header>

<main>
<div class="product-grid">

<!-- Dynamically loaded products -->
<script>
const products = <?= file_exists(__DIR__ . '/products.json') ? file_get_contents(__DIR__ . '/products.json') : '[]' ?>;

const grid = document.querySelector('.product-grid');

const reviewOptions = [
  "Absolutely love this! The quality is amazing for the price.",
  "Very comfortable and looks exactly like the pictures. Superb!",
  "Highly recommended! Shipped fast and exceeded my expectations.",
  "Great purchase. I've gotten so many compliments wearing this.",
  "Perfect fit and material. Will definitely buy from this brand again.",
  "The texture feels really premium. A must-buy!",
  "Fits true to size. I'm very satisfied.",
  "Bought this as a gift, and they loved it. Looks fantastic.",
  "Sleek and stylish. Just what I was looking for.",
  "Color was exactly as shown on the website. Good quality.",
  "Five stars! Excellent value for money.",
  "Arrived early and packaged beautifully. The item feels very durable.",
  "Can't complain at all. Looks great and wears well.",
  "The design is very modern and chic. Really happy with it.",
  "Exceeded my expectations entirely. Will be returning for more."
];

products.forEach((p, i) => {
  if (p.stock !== undefined && p.stock <= 0) return; // skip if out of stock
  
  const stars = (Math.random() * (5.0 - 4.0) + 4.0).toFixed(1);
  const reviewCount = Math.floor(Math.random() * 41) + 10;
  
  const productReviews = [];
  const numReviews = Math.floor(Math.random() * 2) + 2; 
  const authors = ["Alex M.", "Jamie S.", "Sam L.", "Jordan K.", "Taylor R.", "Morgan B."];
  
  for(let j=0; j<numReviews; j++) {
    const randomOption = reviewOptions[Math.floor(Math.random() * reviewOptions.length)];
    const randomAuthor = authors[Math.floor(Math.random() * authors.length)];
    productReviews.push({
      text: randomOption,
      author: "- " + randomAuthor,
      rating: Math.floor(Math.random() * 2) + 4 
    });
  }

  const card = document.createElement('div');
  const delay = (i % 10) * 0.1; // Stagger animation
  card.className = 'product-card';
  card.style.animationDelay = `${delay}s`;
  card.dataset.name = p.name;
  card.dataset.price = p.price;
  card.dataset.img = p.img;
  card.dataset.stars = stars;
  card.dataset.reviews = reviewCount;
  card.dataset.productReviews = JSON.stringify(productReviews);
  card.dataset.desc = p.desc;
  
  let starHtml = '';
  for(let i=1; i<=5; i++) {
    if(i <= Math.floor(stars)) starHtml += '<i class="fa-solid fa-star"></i>';
    else if(i === Math.ceil(stars) && stars % 1 !== 0) starHtml += '<i class="fa-solid fa-star-half-stroke"></i>';
    else starHtml += '<i class="fa-regular fa-star"></i>';
  }

  card.innerHTML = `
    <img src="${p.img}" alt="${p.name}" style="cursor: pointer;" onclick="openProductModal(this.closest('.product-card'))">
    <div class="product-content">
      <h2 style="cursor: pointer;" onclick="openProductModal(this.closest('.product-card'))">${p.name}</h2>
      <div class="product-rating">${starHtml} <span>${stars} (${reviewCount} reviews)</span></div>
      <p>${p.desc.length > 50 ? p.desc.substring(0, 50) + '...' : p.desc}</p>
      <div class="price">$${p.price}</div>
      <div class="product-buttons">
        <button class="add-cart-btn"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</button>
        <button class="buy-btn">Buy Now</button>
      </div>
    </div>
  `;
  grid.appendChild(card);
});
</script>

</div>
</main>

<!-- Product Modal Overlay -->
<div class="product-modal-overlay" id="productModalOverlay">
  <div class="product-modal">
    <button class="modal-close" onclick="closeProductModal()">&times;</button>
    <div class="modal-img-container">
      <img id="modalImg" src="" alt="Product Title">
    </div>
    <div class="modal-info">
      <h2 id="modalTitle">Product Title</h2>
      <div class="product-rating" id="modalRating" style="font-size: 1.1em;"></div>
      <div class="modal-price" id="modalPrice">$0.00</div>
      <p class="modal-desc" id="modalDesc">Product description here.</p>
      
      <div class="modal-reviews">
        <h3>Customer Reviews</h3>
        
        <div id="modalReviewsList" style="max-height: 250px; overflow-y: auto; padding-right: 10px; margin-bottom: 15px;">
          <!-- Random reviews will go here dynamically -->
        </div>

        <div class="add-review-section" style="margin-top: 20px; border-top: 1px solid #eee; padding-top: 15px;">
          <h4 style="margin: 0 0 10px 0; color: #333;">Leave a Review</h4>
          <textarea id="userReviewText" rows="3" placeholder="Tell us what you think about this product..." style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; font-family: inherit; resize: vertical; box-sizing: border-box; margin-bottom: 10px;"></textarea>
          <div style="display: flex; gap: 10px; align-items: center; margin-bottom: 10px;">
             <span style="font-size: 0.9em; color:#555;">Rating:</span>
             <select id="userReviewRating" style="padding: 5px; border-radius: 4px; border: 1px solid #ccc;">
               <option value="5">5 Stars</option>
               <option value="4">4 Stars</option>
               <option value="3">3 Stars</option>
               <option value="2">2 Stars</option>
               <option value="1">1 Star</option>
             </select>
          </div>
          <button id="submitReviewBtn" style="background: #333; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; font-weight: bold;">Submit Review</button>
          <p id="reviewSuccessMsg" style="display: none; color: green; font-size: 0.9em; margin-top: 10px;">Thank you for your review!</p>
        </div>
      </div>

      <div class="product-buttons">
        <button class="add-cart-btn" id="modalAddCartBtn"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</button>
        <button class="buy-btn" id="modalBuyBtn">Buy Now</button>
      </div>
    </div>
  </div>
</div>

<!-- Login Required Popup -->
<div class="login-overlay" id="loginOverlay">
  <div class="login-popup">
    <button class="popup-close" onclick="closeLoginPopup()">&times;</button>
    <div class="lock-icon"><i class="fa-solid fa-lock"></i></div>
    <h2>Login Required</h2>
    <p>You need to log in first before you can add items to your cart or buy products.</p>
    <div class="popup-btns">
      <a href="login.php?tab=login&redirect=sales.php" class="popup-login-btn"><i class="fa-solid fa-right-to-bracket"></i> Log In</a>
      <a href="login.php?tab=signup&redirect=sales.php" class="popup-signup-btn"><i class="fa-solid fa-user-plus"></i> Sign Up</a>
    </div>
  </div>
</div>

<footer>
  <div class="footer-content">
    <div class="footer-section">
      <h3>Trendy Threads</h3>
      <p>Your ultimate destination for premium, casual, and elegant fashion. Founded in 2026, we belong to the heart of the modern fashion district, bringing you the best threads from top global designers directly to your wardrobe. We believe everyone deserves to look and feel their best.</p>
    </div>
    <div class="footer-section">
      <h3>Find Our Threads</h3>
      <ul>
        <li><a href="sales.php">Shop Men's Wear</a></li>
        <li><a href="sales.php">Shop Women's Wear</a></li>
        <li><a href="sales.php">New Arrivals 2026</a></li>
        <li><a href="sales.php">Exclusive Collections</a></li>
      </ul>
    </div>
    <div class="footer-section">
      <h3>Know The Shop</h3>
      <p><i class="fa-solid fa-location-dot"></i> 123 Fashion Avenue, Metro Style City, 1000</p>
       <p><i class="fa-solid fa-phone"></i> +63 9556004191</p>
        <p><i class="fa-solid fa-envelope"></i> mjrbechayda@gmail.com</p>
        <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer" style="margin-right: 10px; font-size: 1.5em; text-decoration: none;"><i class="fa-brands fa-facebook"></i></a>
        <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" style="margin-right: 10px; font-size: 1.5em; text-decoration: none;"><i class="fa-brands fa-instagram"></i></a>
        <a href="https://www.twitter.com/" target="_blank" rel="noopener noreferrer" style="font-size: 1.5em; text-decoration: none;"><i class="fa-brands fa-twitter"></i></a>
      </p>
    </div>
  </div>
  <div class="footer-bottom">
    &copy; 2026 Trendy Threads. All rights reserved.
  </div>
</footer>

<script>
var isLoggedIn = <?= isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ? 'true' : 'false' ?>;

// Load cart from localStorage
let cart = JSON.parse(localStorage.getItem('cart') || '[]');

if (!isLoggedIn) {
  cart = [];
  localStorage.removeItem('cart');
}

function saveCart() {
  localStorage.setItem('cart', JSON.stringify(cart));
  updateCartCount();
}

function updateCartCount() {
  document.getElementById('cart-count').innerText = cart.length;
}

function showLoginPopup() {
  document.getElementById('loginOverlay').classList.add('active');
}

function closeLoginPopup() {
  document.getElementById('loginOverlay').classList.remove('active');
}

// Close popup when clicking outside
document.getElementById('loginOverlay').addEventListener('click', function(e) {
  if (e.target === this) closeLoginPopup();
});

// Product Modal Logic
let currentProductCard = null;

function openProductModal(card) {
  currentProductCard = card;
  const name = card.dataset.name;
  const price = card.dataset.price;
  const img = card.dataset.img;
  const desc = card.dataset.desc;
  const stars = card.dataset.stars;
  const reviews = card.dataset.reviews;
  const productReviews = JSON.parse(card.dataset.productReviews || '[]');

  document.getElementById('modalImg').src = img;
  document.getElementById('modalTitle').innerText = name;
  document.getElementById('modalPrice').innerText = '$' + price;
  document.getElementById('modalDesc').innerText = desc;
  
  // Populate the reviews list dynamically
  const list = document.getElementById('modalReviewsList');
  list.innerHTML = ''; // clear out old reviews
  
  const fetchId = name;
  fetch('api_reviews.php?product=' + encodeURIComponent(name))
    .then(response => response.json())
    .then(data => {
      // Prevent race condition: only update if we are still looking at the same product
      if (currentProductCard && currentProductCard.dataset.name === fetchId) {
        if (data.success && data.reviews) {
          data.reviews.forEach(rev => {
            let reviewStarHtml = '';
            for(let i=1; i<=5; i++) {
                if(i <= rev.rating) reviewStarHtml += '<i class="fa-solid fa-star"></i>';
                else reviewStarHtml += '<i class="fa-regular fa-star"></i>';
            }
            const revHtml = `
              <div class="review-item user-submitted-review" style="margin-bottom: 15px; border-bottom: 1px dotted #eee; padding-bottom: 10px;">
                <div class="product-rating" style="margin-bottom: 5px;">${reviewStarHtml}</div>
                <p class="review-text">"${rev.text}"</p>
                <span class="review-author">${rev.author}</span>
              </div>
            `;
            list.insertAdjacentHTML('beforeend', revHtml);
          });
        }
        
        // 2. Load the Random Default Reviews AFTER fetching the server reviews
        productReviews.forEach(rev => {
          let reviewStarHtml = '';
          for(let i=1; i<=5; i++) {
            if(i <= rev.rating) reviewStarHtml += '<i class="fa-solid fa-star"></i>';
            else reviewStarHtml += '<i class="fa-regular fa-star"></i>';
          }
          
          const revHtml = `
            <div class="review-item auto-generated-review" style="margin-bottom: 15px; border-bottom: 1px dotted #eee; padding-bottom: 10px;">
              <div class="product-rating" style="margin-bottom: 5px;">${reviewStarHtml}</div>
              <p class="review-text">"${rev.text}"</p>
              <span class="review-author">${rev.author}</span>
            </div>
          `;
          list.insertAdjacentHTML('beforeend', revHtml);
        });
      }
    })
    .catch(err => {
      console.error("Error fetching reviews:", err);
    });

  // Reset user review form
  document.getElementById('userReviewText').value = '';
  document.getElementById('userReviewRating').value = '5';
  document.getElementById('reviewSuccessMsg').style.display = 'none';
  
  let starHtml = '';
  for(let i=1; i<=5; i++) {
    if(i <= Math.floor(stars)) starHtml += '<i class="fa-solid fa-star"></i>';
    else if(i === Math.ceil(stars) && stars % 1 !== 0) starHtml += '<i class="fa-solid fa-star-half-stroke"></i>';
    else starHtml += '<i class="fa-regular fa-star"></i>';
  }
  document.getElementById('modalRating').innerHTML = starHtml + ` <span>${stars} (${reviews} reviews)</span>`;

  document.getElementById('productModalOverlay').classList.add('active');
}

function closeProductModal() {
  document.getElementById('productModalOverlay').classList.remove('active');
}

document.getElementById('productModalOverlay').addEventListener('click', function(e) {
  if (e.target === this) closeProductModal();
});

document.getElementById('submitReviewBtn').addEventListener('click', function() {
  if (!isLoggedIn) {
    showLoginPopup();
    return;
  }
  
  const text = document.getElementById('userReviewText').value.trim();
  const rating = parseInt(document.getElementById('userReviewRating').value);
  
  if (text === '') {
    alert("Please write a review before submitting.");
    return;
  }
  
  // Create star rating HTML
  let starHtml = '';
  for(let i=1; i<=5; i++) {
    if(i <= rating) starHtml += '<i class="fa-solid fa-star"></i>';
    else starHtml += '<i class="fa-regular fa-star"></i>';
  }
  
  const profileBtn = document.querySelector('.profile-btn');
  const userIdentifier = isLoggedIn ? (profileBtn ? profileBtn.innerText.trim() : "You") : "You";

  // Add review to the UI immediately for responsiveness
  const reviewHtml = `
    <div class="review-item user-submitted-review" style="margin-bottom: 15px; border-bottom: 1px dotted #eee; padding-bottom: 10px;">
      <div class="product-rating" style="margin-bottom: 5px;">${starHtml}</div>
      <p class="review-text">"${text}"</p>
      <span class="review-author">- ${userIdentifier}</span>
    </div>
  `;
  document.getElementById('modalReviewsList').insertAdjacentHTML('afterbegin', reviewHtml);
  
  // Disable button to prevent multi-submit
  const submitBtn = document.getElementById('submitReviewBtn');
  submitBtn.disabled = true;
  submitBtn.innerText = "Submitting...";

  // Save to Server API so other users can see it
  if (currentProductCard) {
    const pName = currentProductCard.dataset.name;
    
    fetch('api_reviews.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        productName: pName,
        rating: rating,
        text: text
      })
    })
    .then(response => response.json())
    .then(data => {
      submitBtn.disabled = false;
      submitBtn.innerText = "Submit Review";
      
      if(data.success) {
        // Show success message and clear textarea
        document.getElementById('userReviewText').value = '';
        document.getElementById('reviewSuccessMsg').style.display = 'block';
        
        // Hide success message after 3 seconds
        setTimeout(() => {
          document.getElementById('reviewSuccessMsg').style.display = 'none';
        }, 3000);
      } else {
        alert(data.message || "Failed to submit review.");
      }
    })
    .catch(err => {
      console.error(err);
      submitBtn.disabled = false;
      submitBtn.innerText = "Submit Review";
      alert("Error submitting review");
    });
  }
  
  // Update internal comment count (visual only for this session, not saved to DB)
  if(currentProductCard) {
    let reviewsCount = parseInt(currentProductCard.dataset.reviews) || 0;
    currentProductCard.dataset.reviews = reviewsCount + 1;

    // Update card UI in the grid
    const reviewsSpan = currentProductCard.querySelector('.product-rating span');
    if (reviewsSpan) {
       const starsText = currentProductCard.dataset.stars;
       reviewsSpan.innerText = `${starsText} (${reviewsCount + 1} reviews)`;
    }
    
    // Update modal header as well
    const modalRating = document.getElementById('modalRating');
    if (modalRating) {
       const starsText = currentProductCard.dataset.stars;
       modalRating.innerHTML = starHtmlForCurrent(starsText) + ` <span>${starsText} (${reviewsCount + 1} reviews)</span>`;
    }
  }
});

function starHtmlForCurrent(stars) {
  let starHtml = '';
  for(let i=1; i<=5; i++) {
    if(i <= Math.floor(stars)) starHtml += '<i class="fa-solid fa-star"></i>';
    else if(i === Math.ceil(stars) && stars % 1 !== 0) starHtml += '<i class="fa-solid fa-star-half-stroke"></i>';
    else starHtml += '<i class="fa-regular fa-star"></i>';
  }
  return starHtml;
}

document.getElementById('modalAddCartBtn').addEventListener('click', function() {
  if (!isLoggedIn) { 
    closeProductModal();
    showLoginPopup(); 
    return; 
  }
  if(currentProductCard) {
    cart.unshift({
      name: currentProductCard.dataset.name, 
      price: currentProductCard.dataset.price, 
      img: currentProductCard.dataset.img
    });
    saveCart();
    alert(currentProductCard.dataset.name + ' added to cart!');
  }
});

document.getElementById('modalBuyBtn').addEventListener('click', function() {
  if (!isLoggedIn) { 
    closeProductModal();
    showLoginPopup(); 
    return; 
  }
  if(currentProductCard) {
    const item = [{
      name: currentProductCard.dataset.name, 
      price: currentProductCard.dataset.price, 
      img: currentProductCard.dataset.img
    }];
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'auth.php';
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'orderData';
    input.value = JSON.stringify(item);
    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
  }
});

// Go to cart page
function goToCart() {
  if (!isLoggedIn) { showLoginPopup(); return; }
  if(cart.length === 0){
    alert("Your cart is empty!");
    return;
  }
  window.location.href = 'cart.php';
}

// Update count on page load
updateCartCount();

// Search Functionality
document.getElementById('searchInput').addEventListener('input', function(e) {
  const searchTerm = e.target.value.toLowerCase();
  const productCards = document.querySelectorAll('.product-card');
  
  productCards.forEach(card => {
    const productName = card.dataset.name.toLowerCase();
    const productDesc = card.dataset.desc.toLowerCase();
    
    if (productName.includes(searchTerm) || productDesc.includes(searchTerm)) {
      card.style.display = 'block';
    } else {
      card.style.display = 'none';
    }
  });
});

document.addEventListener('click', function(e){
  const card = e.target.closest('.product-card');
  if(!card) return; // Exit if not clicking a card button (e.g. inside modal)

  if(e.target && e.target.classList.contains('add-cart-btn')){
    if (!isLoggedIn) { showLoginPopup(); return; }
    cart.unshift({name: card.dataset.name, price: card.dataset.price, img: card.dataset.img});
    saveCart();
    alert(card.dataset.name + ' added to cart!');
  }

  if(e.target && e.target.classList.contains('buy-btn')){
    if (!isLoggedIn) { showLoginPopup(); return; }
    const item = [{name: card.dataset.name, price: card.dataset.price, img: card.dataset.img}];
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'auth.php';
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'orderData';
    input.value = JSON.stringify(item);
    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
  }
});
</script>

</body>
</html>