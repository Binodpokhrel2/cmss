<?php
require_once '../config.php';
requireStaff();

$user = getCurrentUser();

// Get menu items grouped by category
$categories = getFromDB("SELECT DISTINCT category FROM menu_items WHERE status = 'active' ORDER BY category");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - CanteenPro</title>
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
                <a href="/staff/menu.php" class="nav-link active">Menu</a>
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
                <h1 class="page-title">Menu</h1>
                <p class="page-subtitle">Browse available items and add to order</p>
            </div>

            <!-- Search -->
            <div class="card" style="margin-bottom: 2rem;">
                <input type="text" id="search" placeholder="Search menu items..." style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: var(--radius);">
            </div>

            <!-- Categories -->
            <?php 
            while ($cat = $categories->fetch_assoc()):
                $items = getFromDB("SELECT * FROM menu_items WHERE category = '".escapeStr($cat['category'])."' AND status = 'active'");
            ?>
                <div style="margin-bottom: 3rem;">
                    <h2 style="margin-bottom: 1.5rem;"><?php echo htmlspecialchars($cat['category']); ?></h2>
                    <div class="grid grid-cols-3">
                        <?php 
                        while ($item = $items->fetch_assoc()): 
                        ?>
                            <div class="card">
                                <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 1rem;">
                                    <h3 style="margin: 0; font-size: 1.1rem;"><?php echo htmlspecialchars($item['name']); ?></h3>
                                    <span style="background: rgba(67, 56, 202, 0.1); color: var(--primary); padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 600; white-space: nowrap;">₹<?php echo number_format($item['price'], 0); ?></span>
                                </div>
                                <?php if ($item['description']): ?>
                                    <p style="color: var(--text-light); font-size: 0.875rem; margin: 0 0 1rem 0;"><?php echo htmlspecialchars($item['description']); ?></p>
                                <?php endif; ?>
                                <button class="btn btn-primary btn-block" onclick="addToOrder(<?php echo $item['id']; ?>, '<?php echo htmlspecialchars($item['name']); ?>', <?php echo $item['price']; ?>)">Add to Order</button>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endwhile; ?>

            <!-- Today's Special -->
            <div style="border: 2px solid var(--success); background: rgba(34, 197, 94, 0.05); border-radius: var(--radius); padding: 2rem; margin-top: 2rem;">
                <h2 style="margin-top: 0;">🌟 Today's Special</h2>
                <div style="display: flex; gap: 2rem; align-items: center;">
                    <div>
                        <h3 style="margin-top: 0;">Butter Garlic Naan</h3>
                        <p style="color: var(--text-light);">Freshly made naan with butter and garlic</p>
                    </div>
                    <div style="text-align: right;">
                        <p style="font-size: 2rem; font-weight: bold; color: var(--success); margin: 0;">₹80</p>
                        <p style="color: var(--text-light); margin: 0.5rem 0 1rem 0;">Available</p>
                        <button class="btn btn-success" onclick="addToOrder(999, 'Butter Garlic Naan', 80)">Add to Order</button>
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
    <script>
        function addToOrder(itemId, itemName, price) {
            // This would typically redirect to billing page with item added
            // Or use localStorage to store cart data
            alert('Added ' + itemName + ' to order');
        }
    </script>
</body>
</html>
