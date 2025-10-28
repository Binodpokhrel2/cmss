<?php
require_once '../config.php';
requireStaff();

$user = getCurrentUser();

// Get staff statistics
$today = date('Y-m-d');
$today_orders = getFromDB("SELECT COUNT(*) as count FROM orders WHERE DATE(created_at) = '$today' AND id IN (SELECT id FROM orders WHERE bill_id IN (SELECT id FROM bills WHERE created_by = {$user['id']}))")->fetch_assoc();
$today_revenue = getFromDB("SELECT SUM(total_amount) as revenue FROM bills WHERE DATE(created_at) = '$today' AND created_by = {$user['id']}")->fetch_assoc();

// Get recent orders
$recent_orders = getFromDB("SELECT o.*, b.customer_name, b.total_amount FROM orders o JOIN bills b ON o.bill_id = b.id WHERE b.created_by = {$user['id']} ORDER BY o.created_at DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - CanteenPro</title>
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
                <a href="/staff/dashboard.php" class="nav-link active">Dashboard</a>
                <a href="/staff/menu.php" class="nav-link">Menu</a>
                <a href="/staff/billing.php" class="nav-link">Billing</a>
                <a href="/staff/orders.php" class="nav-link">Orders</a>
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
                <h1 class="page-title">Welcome, <?php echo htmlspecialchars($user['full_name']); ?></h1>
                <p class="page-subtitle">Process orders and manage billing efficiently</p>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-4" style="margin-bottom: 2rem;">
                <div class="stat-card">
                    <div class="stat-icon stat-icon-primary">📊</div>
                    <div class="stat-content">
                        <h3>Orders Today</h3>
                        <div class="stat-value"><?php echo $today_orders['count'] ?? 0; ?></div>
                        <div class="stat-change">+12.5%</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-success">💰</div>
                    <div class="stat-content">
                        <h3>Sales Today</h3>
                        <div class="stat-value">₹<?php echo number_format($today_revenue['revenue'] ?? 0, 0); ?></div>
                        <div class="stat-change">+8.2%</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-warning">⏱️</div>
                    <div class="stat-content">
                        <h3>Avg. Time</h3>
                        <div class="stat-value">2.5 min</div>
                        <div class="stat-change">+4.3%</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-primary">⚡</div>
                    <div class="stat-content">
                        <h3>Efficiency</h3>
                        <div class="stat-value">94%</div>
                        <div class="stat-change">improving</div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid" style="grid-template-columns: 2fr 1fr; gap: 2rem;">
                <!-- Recent Orders -->
                <div class="card">
                    <div class="card-header">
                        <h2>Recent Orders</h2>
                    </div>
                    <div class="card-body">
                        <?php 
                        if ($recent_orders->num_rows > 0) {
                            while ($order = $recent_orders->fetch_assoc()): 
                        ?>
                            <div style="padding: 1rem; border: 1px solid var(--border); border-radius: var(--radius); margin-bottom: 1rem; display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <p style="font-weight: 600; margin: 0;">ORD-<?php echo str_pad($order['id'], 3, '0', STR_PAD_LEFT); ?></p>
                                    <p style="font-size: 0.875rem; color: var(--text-light); margin: 0.5rem 0 0 0;"><?php echo htmlspecialchars($order['customer_name'] ?? 'Walk-in'); ?></p>
                                </div>
                                <div style="text-align: right;">
                                    <p style="font-weight: 600; margin: 0;">₹<?php echo number_format($order['total_amount'], 2); ?></p>
                                    <p style="font-size: 0.75rem; color: var(--success); margin: 0.25rem 0 0 0;"><?php echo ucfirst($order['status']); ?></p>
                                </div>
                            </div>
                        <?php 
                            endwhile;
                        } else {
                        ?>
                            <p style="text-align: center; color: var(--text-light);">No orders yet today</p>
                        <?php } ?>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card">
                    <div class="card-header">
                        <h2>Quick Actions</h2>
                    </div>
                    <div class="card-body">
                        <a href="/staff/billing.php" class="btn btn-primary btn-block" style="margin-bottom: 1rem;">🛒 New Order</a>
                        <a href="/staff/menu.php" class="btn btn-secondary btn-block" style="margin-bottom: 1rem;">📋 View Menu</a>
                        <a href="/staff/orders.php" class="btn btn-secondary btn-block">✓ Orders</a>
                    </div>
                </div>
            </div>

            <!-- Info Boxes -->
            <div class="grid grid-cols-2" style="margin-top: 2rem;">
                <div class="card" style="border-left: 4px solid var(--primary);">
                    <h3 style="margin-top: 0;">💡 Pro Tip</h3>
                    <p style="color: var(--text-light); margin: 0;">Use quick add buttons to speed up order entry. Press 'B' for new bill.</p>
                </div>
                <div class="card" style="border-left: 4px solid var(--success);">
                    <h3 style="margin-top: 0;">🔔 Reminder</h3>
                    <p style="color: var(--text-light); margin: 0;">Always confirm payment before marking orders as complete.</p>
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
                        <li><a href="/staff/menu.php">Digital Menu</a></li>
                        <li><a href="/staff/billing.php">Smart Billing</a></li>
                        <li><a href="/staff/orders.php">Orders</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="#">Documentation</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
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
