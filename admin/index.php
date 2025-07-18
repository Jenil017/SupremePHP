<?php
$page_title = 'Dashboard';
include 'header.php';
require_once '../database.php';

// --- Fetch KPIs ---

// 1. Total Revenue (from delivered orders)
$total_revenue_result = $conn->query("SELECT SUM(total_price) AS total_revenue FROM orders WHERE status = 'Delivered'");
$total_revenue = $total_revenue_result->fetch_assoc()['total_revenue'] ?? 0;

// 2. Total Orders
$total_orders_result = $conn->query("SELECT COUNT(id) AS total_orders FROM orders");
$total_orders = $total_orders_result->fetch_assoc()['total_orders'] ?? 0;

// 3. Total Customers
$total_users_result = $conn->query("SELECT COUNT(id) AS total_users FROM users");
$total_users = $total_users_result->fetch_assoc()['total_users'] ?? 0;

// 4. Pending Orders
$pending_orders_result = $conn->query("SELECT COUNT(id) AS pending_orders FROM orders WHERE status = 'Pending'");
$pending_orders = $pending_orders_result->fetch_assoc()['pending_orders'] ?? 0;


// --- Fetch Chart Data ---

// 1. Sales Over Time (Last 30 days)
$sales_over_time_result = $conn->query("
    SELECT 
        DATE(created_at) AS sale_date, 
        SUM(total_price) AS daily_revenue
    FROM orders 
    WHERE status = 'Delivered' AND created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
    GROUP BY DATE(created_at) 
    ORDER BY sale_date ASC
");
$sales_labels = [];
$sales_data = [];
while ($row = $sales_over_time_result->fetch_assoc()) {
    $sales_labels[] = date('M d', strtotime($row['sale_date']));
    $sales_data[] = $row['daily_revenue'];
}

// 2. Order Status Distribution
$order_status_result = $conn->query("SELECT status, COUNT(id) AS count FROM orders GROUP BY status");
$status_labels = [];
$status_data = [];
while ($row = $order_status_result->fetch_assoc()) {
    $status_labels[] = $row['status'];
    $status_data[] = $row['count'];
}

// 3. Top 5 Selling Products
$top_products_result = $conn->query("
    SELECT product_name, SUM(quantity) AS total_sold 
    FROM orders 
    GROUP BY product_name 
    ORDER BY total_sold DESC 
    LIMIT 5
");
$product_labels = [];
$product_data = [];
while ($row = $top_products_result->fetch_assoc()) {
    $product_labels[] = $row['product_name'];
    $product_data[] = $row['total_sold'];
}

?>

<style>
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .kpi-card {
        background: #fff;
        padding: 1.5rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        border-left: 5px solid var(--primary, #1e40af);
    }
    .kpi-card h3 {
        margin: 0 0 0.5rem 0;
        font-size: 1rem;
        color: #4b5563;
        font-weight: 600;
    }
    .kpi-card .value {
        font-size: 2rem;
        font-weight: 700;
        color: #111827;
    }
    .chart-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .chart-container {
        background: #fff;
        padding: 1.5rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .chart-container.full-width {
        grid-column: 1 / -1;
    }
    @media (max-width: 992px) {
        .chart-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<h2 style="margin-top: 0; margin-bottom: 1.5rem;">Dashboard</h2>

<!-- KPI Cards -->
<div class="kpi-grid">
    <div class="kpi-card">
        <h3>Total Revenue</h3>
        <p class="value">₹<?= htmlspecialchars(number_format($total_revenue, 2)) ?></p>
    </div>
    <div class="kpi-card">
        <h3>Total Orders</h3>
        <p class="value"><?= htmlspecialchars((string)$total_orders) ?></p>
    </div>
    <div class="kpi-card">
        <h3>Total Customers</h3>
        <p class="value"><?= htmlspecialchars((string)$total_users) ?></p>
    </div>
    <div class="kpi-card">
        <h3>Pending Orders</h3>
        <p class="value"><?= htmlspecialchars((string)$pending_orders) ?></p>
    </div>
</div>

<!-- Charts -->
<div class="chart-grid">
    <div class="chart-container full-width">
        <h3>Sales Over Time (Last 30 Days)</h3>
        <canvas id="salesChart"></canvas>
    </div>
    <div class="chart-container">
        <h3>Order Status</h3>
        <canvas id="statusChart"></canvas>
    </div>
    <div class="chart-container">
        <h3>Top 5 Selling Products</h3>
        <canvas id="productsChart"></canvas>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Sales Chart (Line)
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: <?= json_encode($sales_labels) ?>,
                datasets: [{
                    label: 'Daily Revenue',
                    data: <?= json_encode($sales_data) ?>,
                    borderColor: 'rgba(30, 64, 175, 1)',
                    backgroundColor: 'rgba(30, 64, 175, 0.1)',
                    fill: true,
                    tension: 0.3
                }]
            }
        });

        // 2. Status Chart (Doughnut)
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($status_labels) ?>,
                datasets: [{
                    label: 'Order Status',
                    data: <?= json_encode($status_data) ?>,
                    backgroundColor: [
                        'rgba(255, 159, 64, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(153, 102, 255, 0.8)'
                    ],
                    hoverOffset: 4
                }]
            }
        });

        // 3. Top Products Chart (Bar)
        const productsCtx = document.getElementById('productsChart').getContext('2d');
        new Chart(productsCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($product_labels) ?>,
                datasets: [{
                    label: 'Total Units Sold',
                    data: <?= json_encode($product_data) ?>,
                    backgroundColor: 'rgba(21, 128, 61, 0.7)',
                    borderColor: 'rgba(21, 128, 61, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>

<?php include 'footer.php'; ?>
