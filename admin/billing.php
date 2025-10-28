<?php
require_once '../config.php';
requireAdmin();

$user = getCurrentUser();

// Get billing statistics
$today = date('Y-m-d');
$today_revenue = getFromDB("SELECT SUM(total_amount) as revenue FROM bills WHERE DATE(created_at) = '$today'")->fetch_assoc();
$week_revenue = getFromDB("SELECT SUM(total_amount) as revenue FROM bills WHERE DATE(created_at) >= DATE_SUB('$today', INTERVAL 7 DAY)")->fetch_assoc();
$month_revenue = getFromDB("SELECT SUM(total_amount) as revenue FROM bills WHERE MONTH(created_at) = MONTH(NOW())")->fetch_assoc();

// Get recent bills
$bills = getFromDB("SELECT b.*, u.full_name FROM bills b JOIN users u ON b.created_by = u.id ORDER BY b.created_at DESC LIMIT 10");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Management - CanteenPro</title>
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
                <a href="/admin/billing.php" class="nav-link active">Billing</a>
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
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
                <div>
                    <h1 class="page-title">Billing Management</h1>
                    <p class="page-subtitle">View and manage all bills and transactions</p>
                </div>
                <button class="btn btn-primary">📥 Export Bills</button>
            </div>

            <!-- Revenue Stats -->
            <div class="grid grid-cols-3" style="margin-bottom: 2rem;">
                <div class="stat-card">
                    <div class="stat-icon stat-icon-primary">📅</div>
                    <div class="stat-content">
                        <h3>Today's Revenue</h3>
                        <div class="stat-value">₹<?php echo number_format($today_revenue['revenue'] ?? 0, 0); ?></div>
                        <div class="stat-change">+12.5%</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-success">📊</div>
                    <div class="stat-content">
                        <h3>Weekly Revenue</h3>
                        <div class="stat-value">₹<?php echo number_format($week_revenue['revenue'] ?? 0, 0); ?></div>
                        <div class="stat-change">+8.2%</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-warning">📈</div>
                    <div class="stat-content">
                        <h3>Monthly Revenue</h3>
                        <div class="stat-value">₹<?php echo number_format($month_revenue['revenue'] ?? 0, 0); ?></div>
                        <div class="stat-change">+5.3%</div>
                    </div>
                </div>
            </div>

            <!-- Bills Table -->
            <div class="card">
                <div class="card-header">
                    <h2>Recent Bills</h2>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Bill ID</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($bill = $bills->fetch_assoc()): ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($bill['bill_number']); ?></strong></td>
                                    <td><?php echo date('M d, Y H:i', strtotime($bill['created_at'])); ?></td>
                                    <td><?php echo htmlspecialchars($bill['customer_name'] ?? 'N/A'); ?></td>
                                    <td><strong>₹<?php echo number_format($bill['total_amount'], 2); ?></strong></td>
                                    <td>
                                        <span class="badge <?php echo $bill['status'] === 'paid' ? 'badge-success' : 'badge-warning'; ?>">
                                            <?php echo ucfirst($bill['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm" style="background: none; color: var(--primary); padding: 0;">👁️ View</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
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
