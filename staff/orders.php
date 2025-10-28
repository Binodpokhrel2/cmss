<?php
require_once '../config.php';
requireStaff();

$user = getCurrentUser();

// Get orders created by this staff member
$orders = getFromDB("SELECT o.*, b.customer_name, b.total_amount FROM orders o JOIN bills b ON o.bill_id = b.id WHERE b.created_by = {$user['id']} ORDER BY o.created_at DESC");

// Get status counts
$pending = getFromDB("SELECT COUNT(*) as count FROM orders WHERE status = 'pending' AND bill_id IN (SELECT id FROM bills WHERE created_by = {$user['id']})")->fetch_assoc();
$preparing = getFromDB("SELECT COUNT(*) as count FROM orders WHERE status = 'preparing' AND bill_id IN (SELECT id FROM bills WHERE created_by = {$user['id']})")->fetch_assoc();
$ready = getFromDB("SELECT COUNT(*) as count FROM orders WHERE status = 'ready' AND bill_id IN (SELECT id FROM bills WHERE created_by = {$user['id']})")->fetch_assoc();
$total = getFromDB("SELECT COUNT(*) as count FROM orders WHERE bill_id IN (SELECT id FROM bills WHERE created_by = {$user['id']})")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - CanteenPro</title>
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
                <a href="/staff/dashboard.php" class="nav-link">Dashboard</a>
                <a href="/staff/menu.php" class="nav-link">Menu</a>
                <a href="/staff/billing.php" class="nav-link">Billing</a>
                <a href="/staff/orders.php" class="nav-link active">Orders</a>
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
                <h1 class="page-title">Orders</h1>
                <p class="page-subtitle">Track and manage customer orders</p>
            </div>

            <!-- Status Overview -->
            <div class="grid grid-cols-4" style="margin-bottom: 2rem;">
                <div class="stat-card">
                    <div class="stat-icon stat-icon-warning">⏳</div>
                    <div class="stat-content">
                        <h3>Pending</h3>
                        <div class="stat-value"><?php echo $pending['count']; ?></div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-primary">👨‍🍳</div>
                    <div class="stat-content">
                        <h3>Preparing</h3>
                        <div class="stat-value"><?php echo $preparing['count']; ?></div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-success">✓</div>
                    <div class="stat-content">
                        <h3>Ready</h3>
                        <div class="stat-value"><?php echo $ready['count']; ?></div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-primary">📦</div>
                    <div class="stat-content">
                        <h3>Total Today</h3>
                        <div class="stat-value"><?php echo $total['count']; ?></div>
                    </div>
                </div>
            </div>

            <!-- Orders List -->
            <div style="space-y: 1rem;">
                <?php 
                if ($orders->num_rows > 0) {
                    while ($order = $orders->fetch_assoc()):
                        $border_color = '';
                        $status_color = '';
                        if ($order['status'] === 'completed') {
                            $border_color = 'rgba(34, 197, 94, 0.2)';
                            $status_color = 'var(--success)';
                        } elseif ($order['status'] === 'ready') {
                            $border_color = 'rgba(34, 197, 94, 0.2)';
                            $status_color = 'var(--success)';
                        } else {
                            $border_color = 'rgba(67, 56, 202, 0.1)';
                            $status_color = 'var(--primary)';
                        }
                ?>
                    <div style="padding: 1.5rem; border: 2px solid <?php echo $border_color; ?>; border-radius: var(--radius); margin-bottom: 1rem; background: <?php echo $border_color; ?>;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                            <div>
                                <h3 style="margin: 0; font-size: 1.1rem;">ORD-<?php echo str_pad($order['id'], 3, '0', STR_PAD_LEFT); ?></h3>
                                <span style="display: inline-block; background: <?php echo $status_color; ?>; color: white; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; margin-top: 0.5rem;">
                                    <?php echo ucfirst($order['status']); ?>
                                </span>
                            </div>
                            <div style="text-align: right;">
                                <p style="margin: 0; font-size: 1.5rem; font-weight: bold;">₹<?php echo number_format($order['total_amount'], 2); ?></p>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; gap: 1rem;">
                                <span style="color: var(--text-light); font-size: 0.875rem;">Customer: <?php echo htmlspecialchars($order['customer_name'] ?? 'Walk-in'); ?></span>
                            </div>
                            <div style="display: flex; gap: 0.5rem;">
                                <?php if ($order['status'] !== 'completed'): ?>
                                    <?php if ($order['status'] === 'pending'): ?>
                                        <button class="btn btn-primary btn-sm">👨‍🍳 Mark Preparing</button>
                                    <?php elseif ($order['status'] === 'preparing'): ?>
                                        <button class="btn btn-success btn-sm">✓ Mark Ready</button>
                                    <?php elseif ($order['status'] === 'ready'): ?>
                                        <button class="btn btn-success btn-sm">✓ Mark Completed</button>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <button class="btn btn-secondary btn-sm">👁️ View</button>
                            </div>
                        </div>
                    </div>
                <?php 
                    endwhile;
                } else {
                ?>
                    <div class="card">
                        <p style="text-align: center; color: var(--text-light); padding: 2rem;">No orders found</p>
                    </div>
                <?php } ?>
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
