<?php include 'assets/includes/header.php'; ?>

<!-- Order Page Styles -->
<style>
:root {
    --primary: #1A3C40;
    --secondary: #3b82f6;
    --text-primary: #333;
    --text-secondary: #666;
    --background: #f8f9fa;
    --common-radius: 1.2rem;
    --btn-radius: 2rem;
    --underline-height: 0.35em;
}

.order-section {
    padding: 6rem 0 4rem;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    min-height: 100vh;
}

.order-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

.section-heading {
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    color: var(--primary);
    text-decoration: underline;
    text-decoration-color: var(--primary);
    text-underline-offset: var(--underline-height);
    margin-bottom: 1rem;
}

.section-subtitle {
    font-size: 1.2rem;
    color: var(--text-secondary);
    text-align: center;
    margin-bottom: 3rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.order-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    margin-top: 2rem;
}

.product-summary {
    background: white;
    border-radius: var(--common-radius);
    padding: 2rem;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    height: fit-content;
}

.product-summary h3 {
    color: var(--primary);
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    text-align: center;
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 0.5rem;
}

.product-display {
    text-align: center;
    margin-bottom: 2rem;
}

.product-image {
    width: 100%;
    max-width: 200px;
    height: 200px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 1rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.product-name {
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--primary);
    margin-bottom: 0.5rem;
}

.product-price {
    font-size: 1.8rem;
    font-weight: 700;
    color: #2d6a4f;
    margin-bottom: 1rem;
}

.product-description {
    font-size: 1rem;
    color: var(--text-secondary);
    line-height: 1.6;
    text-align: left;
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
}

.quantity-section {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
}

.quantity-label {
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--primary);
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.quantity-btn {
    background: var(--primary);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    font-size: 1.2rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.quantity-btn:hover {
    background: #2d6a4f;
    transform: scale(1.1);
}

.quantity-input {
    width: 80px;
    text-align: center;
    padding: 0.5rem;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 600;
}

.total-price {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--primary);
    text-align: center;
    padding: 1rem;
    background: linear-gradient(135deg, #e8f5e8 0%, #f0f8f0 100%);
    border-radius: 8px;
    border: 2px solid #2d6a4f;
}

.order-form {
    background: white;
    border-radius: var(--common-radius);
    padding: 2rem;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
}

.order-form h3 {
    color: var(--primary);
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    text-align: center;
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 0.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-size: 1rem;
    color: var(--primary);
    font-weight: 600;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 0.8rem 1rem;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(26, 60, 64, 0.1);
    outline: none;
}

.payment-method {
    background: #e8f5e8;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 2rem;
    border: 2px solid #2d6a4f;
}

.payment-method h4 {
    color: var(--primary);
    margin-bottom: 0.5rem;
}

.payment-method p {
    color: var(--text-secondary);
    margin-bottom: 0;
}

.cod-icon {
    font-size: 2rem;
    color: #2d6a4f;
    margin-right: 0.5rem;
}

.order-btn {
    background: linear-gradient(135deg, var(--primary) 0%, #2d6a4f 100%);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 8px;
    font-size: 1.2rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    margin-top: 1rem;
}

.order-btn:hover {
    background: linear-gradient(135deg, #2d6a4f 0%, var(--primary) 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(26, 60, 64, 0.3);
}

.order-btn:active {
    transform: translateY(0);
}

@media (max-width: 768px) {
    .order-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .order-section {
        padding: 4rem 0 2rem;
    }
    
    .section-heading {
        font-size: 2rem;
    }
    
    .order-container {
        padding: 0 1rem;
    }
}

@media (max-width: 480px) {
    .product-summary,
    .order-form {
        padding: 1.5rem;
    }
    
    .quantity-controls {
        justify-content: center;
    }
}
</style>

<!-- Order Page Content -->
<section class="order-section">
    <div class="order-container">
        <h2 class="section-heading">Complete Your Order</h2>
        <p class="section-subtitle">Fill in your details below to place your order with Cash on Delivery</p>
        
        <div class="order-content">
            <!-- Product Summary -->
            <div class="product-summary">
                <h3>Order Summary</h3>
                <div class="product-display">
                    <img id="product-image" src="" alt="Product Image" class="product-image">
                    <div id="product-name" class="product-name">Product Name</div>
                    <div id="product-price" class="product-price">₹0</div>
                </div>
                <div id="product-description" class="product-description">
                    Product description will appear here.
                </div>
                
                <div class="quantity-section">
                    <div class="quantity-label">Quantity:</div>
                    <div class="quantity-controls">
                        <button type="button" class="quantity-btn" onclick="changeQuantity(-1)">-</button>
                        <input type="number" id="quantity" class="quantity-input" value="1" min="1" max="99" readonly>
                        <button type="button" class="quantity-btn" onclick="changeQuantity(1)">+</button>
                    </div>
                    <div id="total-price" class="total-price">
                        Total: ₹0
                    </div>
                </div>
            </div>
            
            <!-- Order Form -->
            <div class="order-form">
                <h3>Shipping Information</h3>
                <form id="orderForm" action="process_order.php" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName">First Name *</label>
                            <input type="text" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name *</label>
                            <input type="text" id="lastName" name="lastName" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Street Address *</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="city">City *</label>
                            <input type="text" id="city" name="city" required>
                        </div>
                        <div class="form-group">
                            <label for="state">State *</label>
                            <input type="text" id="state" name="state" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="pincode">PIN Code *</label>
                            <input type="text" id="pincode" name="pincode" required>
                        </div>
                        <div class="form-group">
                            <label for="country">Country *</label>
                            <input type="text" id="country" name="country" value="India" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="notes">Additional Notes (Optional)</label>
                        <textarea id="notes" name="notes" rows="3" placeholder="Any special instructions for delivery..."></textarea>
                    </div>
                    
                    <div class="payment-method">
                        <h4><span class="cod-icon">💰</span>Payment Method</h4>
                        <p><strong>Cash on Delivery (COD)</strong> - Pay when you receive your order at your doorstep.</p>
                    </div>
                    
                    <!-- Hidden fields for product data -->
                    <input type="hidden" id="productName" name="productName">
                    <input type="hidden" id="productPrice" name="productPrice">
                    <input type="hidden" id="productImage" name="productImage">
                    <input type="hidden" id="productDescription" name="productDescription">
                    <input type="hidden" id="orderQuantity" name="orderQuantity">
                    <input type="hidden" id="totalAmount" name="totalAmount">
                    
                    <button type="submit" class="order-btn">
                        <i class="fas fa-shopping-cart"></i> Confirm Order (Cash on Delivery)
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Order Page JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get product data from localStorage
    const productData = JSON.parse(localStorage.getItem('selectedProduct'));
    
    if (!productData) {
        alert('No product selected. Redirecting to products page.');
        window.location.href = 'products_new.php';
        return;
    }
    
    // Populate product information
    document.getElementById('product-image').src = productData.image;
    document.getElementById('product-image').alt = productData.name;
    document.getElementById('product-name').textContent = productData.name;
    document.getElementById('product-price').textContent = productData.price;
    document.getElementById('product-description').textContent = productData.description;
    
    // Set hidden form fields
    document.getElementById('productName').value = productData.name;
    document.getElementById('productPrice').value = productData.price;
    document.getElementById('productImage').value = productData.image;
    document.getElementById('productDescription').value = productData.description;
    
    // Calculate initial total
    updateTotal();
    
    // Form submission handling
    document.getElementById('orderForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Update hidden fields with current values
        document.getElementById('orderQuantity').value = document.getElementById('quantity').value;
        document.getElementById('totalAmount').value = document.getElementById('total-price').textContent;
        
        // Submit form
        this.submit();
    });
});

function changeQuantity(change) {
    const quantityInput = document.getElementById('quantity');
    let currentQuantity = parseInt(quantityInput.value);
    let newQuantity = currentQuantity + change;
    
    if (newQuantity < 1) newQuantity = 1;
    if (newQuantity > 99) newQuantity = 99;
    
    quantityInput.value = newQuantity;
    updateTotal();
}

function updateTotal() {
    const quantity = parseInt(document.getElementById('quantity').value);
    const priceText = document.getElementById('product-price').textContent;
    const price = parseInt(priceText.replace('₹', '').replace(',', ''));
    
    const total = price * quantity;
    document.getElementById('total-price').textContent = `Total: ₹${total.toLocaleString()}`;
}

// Update total when quantity is changed manually
document.getElementById('quantity').addEventListener('input', updateTotal);
</script>

<?php include 'assets/includes/footer.php'; ?>