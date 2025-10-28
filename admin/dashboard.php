<?php
require_once '../config.php';
requireAdmin();

$user = getCurrentUser();

// Get statistics
$today = date('Y-m-d');
$bills_result = getFromDB("SELECT COUNT(*) as total_orders, SUM(total_amount) as total_revenue FROM bills WHERE DATE(created_at) = '$today'");
$bills_stat = $bills_result->fetch_assoc();

$users_result = getFromDB("SELECT COUNT(*) as count FROM users WHERE role = 'staff'");
$users_stat = $users_result->fetch_assoc();

$menu_result = getFromDB("SELECT COUNT(*) as count FROM menu_items");
$menu_stat = $menu_result->fetch_assoc();

// Get recent bills
$recent_bills = getFromDB("SELECT b.*, u.full_name FROM bills b JOIN users u ON b.created_by = u.id ORDER BY b.created_at DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CanteenPro</title>
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
                <a href="/admin/dashboard.php" class="nav-link active">Dashboard</a>
                <a href="/admin/menu.php" class="nav-link">Menu</a>
                <a href="/admin/billing.php" class="nav-link">Billing</a>
                <a href="/admin/records.php" class="nav-link">Records</a>
                <a href="/admin/inventory.php" class="nav-link">Inventory</a>
                <a href="/admin/analytics.php" class="nav-link">Analytics</a>
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
                <h1 class="page-title">Admin Dashboard</h1>
                <p class="page-subtitle">Overview of your canteen operations</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-4">
                <div class="stat-card">
                    <div class="stat-icon stat-icon-primary">📊</div>
                    <div class="stat-content">
                        <h3>Orders Today</h3>
                        <div class="stat-value"><?php echo $bills_stat['total_orders'] ?? 0; ?></div>
                        <div class="stat-change">+12.5%</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-success">💰</div>
                    <div class="stat-content">
                        <h3>Revenue</h3>
                        <div class="stat-value">₹<?php echo number_format($bills_stat['total_revenue'] ?? 0, 0); ?></div>
                        <div class="stat-change">+8.2%</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-warning">👥</div>
                    <div class="stat-content">
                        <h3>Active Staff</h3>
                        <div class="stat-value"><?php echo $users_stat['count']; ?></div>
                        <div class="stat-change">+4.3%</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-primary">🍽️</div>
                    <div class="stat-content">
                        <h3>Menu Items</h3>
                        <div class="stat-value"><?php echo $menu_stat['count']; ?></div>
                        <div class="stat-change">5 new</div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid" style="grid-template-columns: 2fr 1fr; margin-top: 2rem;">
                <!-- Recent Orders -->
                <div class="card">
                    <div class="card-header">
                        <h2>Recent Orders</h2>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Bill ID</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($bill = $recent_bills->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($bill['bill_number']); ?></td>
                                        <td><?php echo date('M d, Y H:i', strtotime($bill['created_at'])); ?></td>
                                        <td><strong>₹<?php echo number_format($bill['total_amount'], 2); ?></strong></td>
                                        <td>
                                            <span class="badge <?php echo $bill['status'] === 'paid' ? 'badge-success' : 'badge-warning'; ?>">
                                                <?php echo ucfirst($bill['status']); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card">
                    <div class="card-header">
                        <h2>Quick Actions</h2>
                    </div>
                    <div class="card-body">
                        <a href="/admin/menu.php" class="btn btn-primary btn-block" style="margin-bottom: 1rem;">🍽️ Manage Menu</a>
                        <a href="/admin/inventory.php" class="btn btn-secondary btn-block" style="margin-bottom: 1rem;">📦 Check Inventory</a>
                        <a href="/admin/analytics.php" class="btn btn-secondary btn-block" style="margin-bottom: 1rem;">📊 View Analytics</a>
                        <a href="/admin/records.php" class="btn btn-secondary btn-block">📋 Export Reports</a>
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
