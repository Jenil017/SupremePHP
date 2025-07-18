<?php include 'assets/includes/header.php'; ?>

<!-- New, Visually Enhanced Product Page -->

<style>
/* New styles for the redesigned product page. 
   For best practice, you can move these styles to a dedicated CSS file. */
.products-v2-section {
    padding: 5rem 0;
    background: #f8f9fa;
}
.products-v2-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}
.products-v2-header {
    text-align: center;
    margin-bottom: 3.5rem;
}
.products-v2-title {
    font-size: 2.8rem;
    font-weight: 700;
    color: var(--primary, #1A3C40);
    margin-bottom: 0.5rem;
}
.products-v2-subtitle {
    font-size: 1.15rem;
    color: var(--text-secondary, #666);
    max-width: 650px;
    margin: 0 auto;
    line-height: 1.6;
}
.products-v2-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
}
.product-card-v2 {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.07);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.product-card-v2:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.12);
}
.product-v2-image-wrapper {
    width: 100%;
    height: 220px;
    overflow: hidden;
}
.product-v2-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}
.product-card-v2:hover .product-v2-image-wrapper img {
    transform: scale(1.08);
}
.product-v2-content {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}
.product-v2-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--primary, #1A3C40);
    margin-bottom: 0.75rem;
}
.product-v2-description {
    font-size: 0.95rem;
    color: var(--text-secondary, #666);
    line-height: 1.5;
    margin-bottom: 1rem;
    flex-grow: 1;
}
.product-v2-features {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1.25rem;
}
.product-v2-tag {
    background-color: #eef2f9;
    color: #3b82f6;
    font-size: 0.8rem;
    font-weight: 600;
    padding: 0.3rem 0.7rem;
    border-radius: 20px;
}
.product-v2-footer {
    margin-top: auto;
    padding-top: 1rem;
    border-top: 1px solid #f0f0f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.product-v2-price {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2d6a4f;
}
.product-v2-buy-btn {
    background: linear-gradient(135deg, var(--primary, #1A3C40) 0%, #2d6a4f 100%);
    color: white;
    border: none;
    padding: 0.7rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
}
.product-v2-buy-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 15px rgba(26, 60, 64, 0.3);
}
</style>

<section class="products-v2-section">
    <div class="products-v2-container">
        <div class="products-v2-header">
            <h2 class="products-v2-title">Our Premium Thread Collection</h2>
            <p class="products-v2-subtitle">
                Explore our meticulously crafted threads, designed for superior performance and durability. Select any product to purchase directly with Cash on Delivery.
            </p>
        </div>

        <div class="products-v2-grid">
            
            <?php 
            // --- Database Fetch ---
            // 1. Include the database connection
            require_once 'database.php';

            // 2. Fetch all products from the database
            $products = [];
            $sql = "SELECT id, name, price, image, description FROM products ORDER BY id ASC";
            if ($result = $conn->query($sql)) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $products[] = $row;
                    }
                }
                $result->free();
            }
            $conn->close();

            // 3. Loop through the products and display them
            foreach ($products as $product):
            ?>
            <div class="product-card-v2" data-id="<?= htmlspecialchars($product['id']) ?>">
                <div class="product-v2-image-wrapper">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                </div>
                <div class="product-v2-content">
                    <h3 class="product-v2-title"><?= htmlspecialchars($product['name']) ?></h3>
                    <p class="product-v2-description"><?= htmlspecialchars($product['description']) ?></p>
                    
                    <div class="product-v2-footer">
                        <span class="product-v2-price">
                            <?php 
                                // Ensure price is a clean number before formatting to prevent errors.
                                $price = preg_replace('/[^0-9.]/', '', $product['price']);
                                echo '₹' . htmlspecialchars(number_format((float)$price, 2));
                            ?>
                        </span>
                        <button class="product-v2-buy-btn">Buy Now</button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<!-- JavaScript to handle "Buy Now" and redirect -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const buyNowButtons = document.querySelectorAll('.product-v2-buy-btn');
    
    buyNowButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Check if user is logged in using PHP session status
            <?php if (!isset($_SESSION['user_id'])): ?>
                // If not logged in, show an alert and redirect to the login page
                alert('Please log in to purchase products.');
                window.location.href = 'login.php';
                return; // Stop further execution
            <?php endif; ?>

            // If logged in, get the product ID and redirect
            const productCard = this.closest('.product-card-v2');
            const productId = productCard.dataset.id;
            
            if (productId) {
                // Redirect to the order page with the product ID as a URL parameter
                window.location.href = `order.php?product_id=${productId}`;
            } else {
                alert('Could not find product details. Please try again.');
            }
        });
    });
});
</script>

<?php include 'assets/includes/footer.php'; ?>
