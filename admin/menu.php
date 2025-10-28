<?php
require_once '../config.php';
requireAdmin();

$user = getCurrentUser();
$search = isset($_GET['search']) ? escapeStr($_GET['search']) : '';
$category_filter = isset($_GET['category']) ? escapeStr($_GET['category']) : '';

// Build query
$query = "SELECT * FROM menu_items WHERE 1=1";
if ($search) {
    $query .= " AND name LIKE '%$search%'";
}
if ($category_filter) {
    $query .= " AND category = '$category_filter'";
}
$query .= " ORDER BY created_at DESC";

$menu_items = getFromDB($query);

// Get categories
$categories = getFromDB("SELECT DISTINCT category FROM menu_items ORDER BY category");

// Get category stats
$category_stats = getFromDB("SELECT category, COUNT(*) as count FROM menu_items GROUP BY category");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Management - CanteenPro</title>
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
                <a href="/admin/menu.php" class="nav-link active">Menu</a>
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
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
                <div>
                    <h1 class="page-title">Menu Management</h1>
                    <p class="page-subtitle">Add, edit, or remove menu items</p>
                </div>
                <a href="#add-item" class="btn btn-primary">+ Add Menu Item</a>
            </div>

            <!-- Filters -->
            <div class="card" style="margin-bottom: 2rem;">
                <form method="GET" style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 1rem;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <input type="text" name="search" placeholder="Search menu items..." value="<?php echo htmlspecialchars($search); ?>">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <select name="category">
                            <option value="">All Categories</option>
                            <?php 
                            $categories = getFromDB("SELECT DISTINCT category FROM menu_items");
                            while ($cat = $categories->fetch_assoc()): 
                            ?>
                                <option value="<?php echo htmlspecialchars($cat['category']); ?>" <?php echo $category_filter === $cat['category'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cat['category']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-secondary">Filter</button>
                </form>
            </div>

            <!-- Menu Items Table -->
            <div class="card">
                <div class="card-header">
                    <h2>Menu Items</h2>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if ($menu_items->num_rows > 0) {
                                while ($item = $menu_items->fetch_assoc()): 
                            ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($item['name']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($item['category']); ?></td>
                                    <td><strong>₹<?php echo number_format($item['price'], 2); ?></strong></td>
                                    <td>
                                        <span class="badge <?php echo $item['status'] === 'active' ? 'badge-success' : 'badge-warning'; ?>">
                                            <?php echo ucfirst(str_replace('_', ' ', $item['status'])); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm" style="background: none; color: var(--primary); padding: 0;">✏️ Edit</a>
                                        <a href="#" class="btn btn-sm" style="background: none; color: var(--danger); padding: 0; margin-left: 0.5rem;">🗑️ Delete</a>
                                    </td>
                                </tr>
                            <?php 
                                endwhile;
                            } else {
                            ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 2rem; color: var(--text-light);">No menu items found</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Category Stats -->
            <div style="margin-top: 2rem;">
                <h3 style="margin-bottom: 1rem;">Category Overview</h3>
                <div class="grid grid-cols-4">
                    <?php 
                    $category_stats = getFromDB("SELECT category, COUNT(*) as count FROM menu_items GROUP BY category");
                    while ($stat = $category_stats->fetch_assoc()): 
                    ?>
                        <div class="card">
                            <h4 style="margin: 0 0 1rem 0;"><?php echo htmlspecialchars($stat['category']); ?></h4>
                            <div style="font-size: 2rem; font-weight: bold; color: var(--primary);"><?php echo $stat['count']; ?></div>
                            <p style="color: var(--text-light); margin: 0; font-size: 0.875rem;">items</p>
                        </div>
                    <?php endwhile; ?>
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
