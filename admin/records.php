<?php
require_once '../config.php';
requireAdmin();

$user = getCurrentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Records & Reports - CanteenPro</title>
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
                <a href="/admin/records.php" class="nav-link active">Records</a>
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
                <h1 class="page-title">Records & Reports</h1>
                <p class="page-subtitle">Generate and export transaction records and detailed reports</p>
            </div>

            <!-- Report Types -->
            <div class="grid grid-cols-3" style="margin-bottom: 2rem;">
                <div class="card">
                    <h3 style="margin: 0 0 1rem 0;">📅 Daily Report</h3>
                    <p style="color: var(--text-light); margin: 0 0 1rem 0; font-size: 0.9rem;">Complete transaction summary for a single day</p>
                    <button class="btn btn-primary btn-sm btn-block">Generate</button>
                </div>
                <div class="card">
                    <h3 style="margin: 0 0 1rem 0;">📊 Weekly Report</h3>
                    <p style="color: var(--text-light); margin: 0 0 1rem 0; font-size: 0.9rem;">Sales trends and statistics for the week</p>
                    <button class="btn btn-primary btn-sm btn-block">Generate</button>
                </div>
                <div class="card">
                    <h3 style="margin: 0 0 1rem 0;">📈 Monthly Report</h3>
                    <p style="color: var(--text-light); margin: 0 0 1rem 0; font-size: 0.9rem;">Comprehensive monthly performance analysis</p>
                    <button class="btn btn-primary btn-sm btn-block">Generate</button>
                </div>
                <div class="card">
                    <h3 style="margin: 0 0 1rem 0;">🍽️ Item-wise Report</h3>
                    <p style="color: var(--text-light); margin: 0 0 1rem 0; font-size: 0.9rem;">Detailed sales data for each menu item</p>
                    <button class="btn btn-primary btn-sm btn-block">Generate</button>
                </div>
                <div class="card">
                    <h3 style="margin: 0 0 1rem 0;">👥 Staff Report</h3>
                    <p style="color: var(--text-light); margin: 0 0 1rem 0; font-size: 0.9rem;">Staff performance and sales tracking</p>
                    <button class="btn btn-primary btn-sm btn-block">Generate</button>
                </div>
                <div class="card">
                    <h3 style="margin: 0 0 1rem 0;">💰 Tax Report</h3>
                    <p style="color: var(--text-light); margin: 0 0 1rem 0; font-size: 0.9rem;">Tax summary for accounting and audits</p>
                    <button class="btn btn-primary btn-sm btn-block">Generate</button>
                </div>
            </div>

            <!-- Export Options -->
            <div class="card" style="margin-bottom: 2rem;">
                <div class="card-header">
                    <h2>Advanced Export Options</h2>
                </div>
                <div class="card-body grid" style="grid-template-columns: 1fr 1fr;">
                    <div style="display: flex; gap: 1rem; padding: 1rem; border-radius: var(--radius); background: var(--gray-light);">
                        <div style="font-size: 1.5rem;">📄</div>
                        <div>
                            <p style="font-weight: 500; margin: 0;">Export as PDF</p>
                            <p style="font-size: 0.875rem; color: var(--text-light); margin: 0;">Professional PDF format for printing</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 1rem; padding: 1rem; border-radius: var(--radius); background: var(--gray-light);">
                        <div style="font-size: 1.5rem;">📥</div>
                        <div>
                            <p style="font-weight: 500; margin: 0;">Export as Excel</p>
                            <p style="font-size: 0.875rem; color: var(--text-light); margin: 0;">Editable Excel format for analysis</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Date Range Selector -->
            <div class="card">
                <div class="card-header">
                    <h2>Custom Report Period</h2>
                </div>
                <div class="card-body">
                    <form style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 1rem; align-items: flex-end;">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label>From Date</label>
                            <input type="date" />
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label>To Date</label>
                            <input type="date" />
                        </div>
                        <button type="submit" class="btn btn-primary">🗓️ Generate</button>
                    </form>
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
