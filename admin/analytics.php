<?php
require_once '../config.php';
requireAdmin();

$user = getCurrentUser();

// Get top selling items
$top_items = getFromDB("
    SELECT mi.name, SUM(bi.quantity) as total_sales, SUM(bi.total_price) as revenue
    FROM bill_items bi
    JOIN menu_items mi ON bi.menu_item_id = mi.id
    GROUP BY mi.id
    ORDER BY total_sales DESC
    LIMIT 5
");

// Get 7-day sales data
$daily_sales = [];
for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $result = getFromDB("SELECT COUNT(*) as orders, SUM(total_amount) as revenue FROM bills WHERE DATE(created_at) = '$date'")->fetch_assoc();
    $daily_sales[] = [
        'date' => date('D', strtotime($date)),
        'orders' => $result['orders'] ?? 0,
        'revenue' => $result['revenue'] ?? 0
    ];
}

// Get stats
$total_orders = getFromDB("SELECT COUNT(*) as count FROM bills")->fetch_assoc();
$total_revenue = getFromDB("SELECT SUM(total_amount) as total FROM bills")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - CanteenPro</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="dashboard-layout">
    <!-- Header -->
    <header>
        <div class="header-container">
            <a href="/" class="logo">
                <div class="logo-icon">🍽️</div>
                <span>CanteenPro</span>
            </a>
            <nav class="nav-menu">
                <a href="/admin/dashboard.php" class="nav-link">Dashboard</a>
                <a href="/admin/menu.php" class="nav-link">Menu</a>
                <a href="/admin/billing.php" class="nav-link">Billing</a>
                <a href="/admin/records.php" class="nav-link">Records</a>
                <a href="/admin/inventory.php" class="nav-link">Inventory</a>
                <a href="/admin/analytics.php" class="nav-link active">Analytics</a>
            </nav>
            <div class="user-menu">
                <span style="color: var(--text-light); font-size: 0.875rem;">Welcome, <?php echo htmlspecialchars($user['full_name']); ?></span>
                <a href="/logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
    </header>

    <main class="dashboard-content">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">Analytics & Reports</h1>
                <p class="page-subtitle">Real-time sales insights and performance metrics</p>
            </div>

            <!-- Key Metrics -->
            <div class="grid grid-cols-4" style="margin-bottom: 2rem;">
                <div class="stat-card">
                    <div class="stat-icon stat-icon-primary">📊</div>
                    <div class="stat-content">
                        <h3>Total Orders</h3>
                        <div class="stat-value"><?php echo number_format($total_orders['count'] ?? 0); ?></div>
                        <div class="stat-change">+12.5%</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-success">💰</div>
                    <div class="stat-content">
                        <h3>Total Revenue</h3>
                        <div class="stat-value">₹<?php echo number_format($total_revenue['total'] ?? 0, 0); ?></div>
                        <div class="stat-change">+8.2%</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-warning">📈</div>
                    <div class="stat-content">
                        <h3>Avg Order Value</h3>
                        <div class="stat-value">₹<?php echo $total_orders['count'] > 0 ? number_format($total_revenue['total'] / $total_orders['count'], 0) : '0'; ?></div>
                        <div class="stat-change">+3.1%</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-primary">⏰</div>
                    <div class="stat-content">
                        <h3>Peak Hour</h3>
                        <div class="stat-value">12:00-13:00</div>
                        <div class="stat-change">245 orders</div>
                    </div>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid" style="grid-template-columns: 1fr 1fr; margin-bottom: 2rem;">
                <!-- Top Items -->
                <div class="card">
                    <div class="card-header">
                        <h2>Top Selling Items</h2>
                    </div>
                    <div class="card-body">
                        <?php 
                        $rank = 1;
                        while ($item = $top_items->fetch_assoc()): 
                        ?>
                            <div style="margin-bottom: 1.5rem;">
                                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
                                    <span style="font-weight: 500;"><?php echo $rank; ?>. <?php echo htmlspecialchars($item['name']); ?></span>
                                </div>
                                <div style="background: var(--gray-light); border-radius: var(--radius); height: 0.5rem; overflow: hidden;">
                                    <div style="background: var(--primary); height: 100%; width: <?php echo ($item['total_sales'] / 100) * 100; ?>%;"></div>
                                </div>
                                <div style="display: flex; justify-content: space-between; margin-top: 0.5rem; font-size: 0.875rem; color: var(--text-light);">
                                    <span><?php echo $item['total_sales']; ?> sales</span>
                                    <span>₹<?php echo number_format($item['revenue'], 0); ?></span>
                                </div>
                            </div>
                        <?php 
                            $rank++;
                        endwhile; 
                        ?>
                    </div>
                </div>

                <!-- Daily Trend -->
                <div class="card">
                    <div class="card-header">
                        <h2>7-Day Sales Trend</h2>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; align-items: flex-end; justify-content: space-between; height: 200px; gap: 0.5rem;">
                            <?php 
                            $max_revenue = max(array_column($daily_sales, 'revenue')) ?: 1;
                            foreach ($daily_sales as $day): 
                            ?>
                                <div style="flex: 1; display: flex; flex-direction: column; align-items: center;">
                                    <div style="background: var(--primary); border-radius: var(--radius) var(--radius) 0 0; width: 100%; height: <?php echo ($day['revenue'] / $max_revenue) * 100; ?>%; min-height: 20px;"></div>
                                    <span style="font-size: 0.75rem; color: var(--text-light); margin-top: 0.5rem;"><?php echo $day['date']; ?></span>
                                    <span style="font-size: 0.75rem; font-weight: 600;">₹<?php echo number_format($day['revenue'] / 100, 0); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3>CanteenPro</h3>
                    <p>Professional canteen management system</p>
                </div>
                <div class="footer-section">
                    <h3>Features</h3>
                    <ul>
                        <li><a href="/admin/menu.php">Digital Menu</a></li>
                        <li><a href="/admin/billing.php">Smart Billing</a></li>
                        <li><a href="/admin/analytics.php">Analytics</a></li>
                        <li><a href="/admin/inventory.php">Inventory</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="#">Documentation</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 CanteenPro. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="/js/script.js"></script>
</body>
</html>
