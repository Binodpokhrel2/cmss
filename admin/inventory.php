<?php
require_once '../config.php';
requireAdmin();

$user = getCurrentUser();

// Get inventory items
$inventory = getFromDB("SELECT * FROM inventory ORDER BY item_name");

// Count stats
$in_stock = getFromDB("SELECT COUNT(*) as count FROM inventory WHERE quantity > reorder_level")->fetch_assoc();
$low_stock = getFromDB("SELECT COUNT(*) as count FROM inventory WHERE quantity <= reorder_level AND quantity > 0")->fetch_assoc();
$critical = getFromDB("SELECT COUNT(*) as count FROM inventory WHERE quantity = 0")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management - CanteenPro</title>
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
                <a href="/admin/inventory.php" class="nav-link active">Inventory</a>
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
                    <h1 class="page-title">Inventory Management</h1>
                    <p class="page-subtitle">Track stock levels and manage reorders</p>
                </div>
                <button class="btn btn-primary">+ Add Item</button>
            </div>

            <!-- Alert for critical items -->
            <?php if ($critical['count'] > 0): ?>
                <div class="alert alert-danger" style="margin-bottom: 2rem;">
                    <span>⚠️</span>
                    <div>
                        <p><strong>Low Stock Alert</strong></p>
                        <p><?php echo $critical['count']; ?> items are at critical stock levels. Please place reorders immediately.</p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Inventory Stats -->
            <div class="grid grid-cols-4" style="margin-bottom: 2rem;">
                <div class="stat-card">
                    <div class="stat-icon stat-icon-primary">📦</div>
                    <div class="stat-content">
                        <h3>Total Items</h3>
                        <div class="stat-value"><?php echo getFromDB("SELECT COUNT(*) as count FROM inventory")->fetch_assoc()['count']; ?></div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-success">✓</div>
                    <div class="stat-content">
                        <h3>In Stock</h3>
                        <div class="stat-value"><?php echo $in_stock['count']; ?></div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-warning">⚠️</div>
                    <div class="stat-content">
                        <h3>Low Stock</h3>
                        <div class="stat-value"><?php echo $low_stock['count']; ?></div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-primary">🔴</div>
                    <div class="stat-content">
                        <h3>Critical</h3>
                        <div class="stat-value"><?php echo $critical['count']; ?></div>
                    </div>
                </div>
            </div>

            <!-- Inventory Table -->
            <div class="card">
                <div class="card-header">
                    <h2>Inventory Items</h2>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Current Stock</th>
                                <th>Reorder Level</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if ($inventory->num_rows > 0) {
                                while ($item = $inventory->fetch_assoc()):
                                    $status_class = '';
                                    $status_text = '';
                                    if ($item['quantity'] == 0) {
                                        $status_class = 'badge-danger';
                                        $status_text = 'Critical';
                                    } elseif ($item['quantity'] <= $item['reorder_level']) {
                                        $status_class = 'badge-warning';
                                        $status_text = 'Low Stock';
                                    } else {
                                        $status_class = 'badge-success';
                                        $status_text = 'In Stock';
                                    }
                            ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($item['item_name']); ?></strong></td>
                                    <td><?php echo number_format($item['quantity'], 1); ?> <?php echo htmlspecialchars($item['unit']); ?></td>
                                    <td><?php echo number_format($item['reorder_level'], 1); ?> <?php echo htmlspecialchars($item['unit']); ?></td>
                                    <td>
                                        <span class="badge <?php echo $status_class; ?>">
                                            <?php echo $status_text; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm" style="background: none; color: var(--primary); padding: 0;">✏️ Edit</a>
                                    </td>
                                </tr>
                            <?php 
                                endwhile;
                            } else {
                            ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 2rem; color: var(--text-light);">No inventory items found</td>
                                </tr>
                            <?php } ?>
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
