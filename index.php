<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CanteenPro - Canteen Management System</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <a href="/" class="logo">
                <div class="logo-icon">🍽️</div>
                <span>CanteenPro</span>
            </a>
            <nav class="nav-menu">
                <a href="/" class="nav-link active">Home</a>
                <a href="/login.php" class="nav-link">Login</a>
            </nav>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <div class="hero-badge">🚀 The Future of Canteen Management</div>
                <h1>Streamline Your Canteen Operations</h1>
                <p>CanteenPro is a comprehensive, user-friendly canteen management system designed to simplify billing, record management, and digital menu operations. Transform your canteen with modern technology.</p>
                <div class="hero-buttons">
                    <a href="/login.php" class="btn btn-primary btn-lg">Get Started</a>
                    <a href="#features" class="btn btn-secondary btn-lg">Learn More</a>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="features-section">
            <div class="container">
                <div class="section-header">
                    <h2>Powerful Features Built for You</h2>
                    <p>Everything you need to manage your canteen efficiently and effectively</p>
                </div>

                <div class="grid grid-cols-3">
                    <div class="feature-card">
                        <div class="feature-icon">🍽️</div>
                        <h3>Digital Menu Display</h3>
                        <p>Interactive digital menu with item names, prices, and images. Easily categorize food items and manage daily specials.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🛒</div>
                        <h3>Smart Billing System</h3>
                        <p>Automatic calculation of totals, taxes, and discounts. Generate receipts and track orders in real-time.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">📋</div>
                        <h3>Record Management</h3>
                        <p>Maintain detailed transaction records. Export data to Excel or PDF for accounting and audits.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">📊</div>
                        <h3>Analytics & Reports</h3>
                        <p>Real-time sales analytics with graphical reports. Identify best-sellers and peak hours easily.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">👥</div>
                        <h3>User Roles & Access</h3>
                        <p>Separate Admin and Staff dashboards with different access levels and secure authentication.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⚡</div>
                        <h3>Inventory Management</h3>
                        <p>Track stock levels, get low-stock alerts, and generate consumption reports.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- User Roles Section -->
        <section style="padding: 6rem 2rem; background: var(--gray-light);">
            <div class="container">
                <div class="section-header">
                    <h2>Designed for Different User Roles</h2>
                    <p>Tailored dashboards and access controls for administrators and staff</p>
                </div>

                <div class="grid grid-cols-2">
                    <div class="card">
                        <div style="margin-bottom: 1.5rem;">
                            <div style="width: 3rem; height: 3rem; background: rgba(67, 56, 202, 0.1); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">👨‍💼</div>
                        </div>
                        <h3>Admin Dashboard</h3>
                        <ul style="list-style: none; margin: 1.5rem 0; color: var(--text-light);">
                            <li style="margin-bottom: 1rem;">✓ Manage menu items, prices, and categories</li>
                            <li style="margin-bottom: 1rem;">✓ Monitor inventory and stock levels</li>
                            <li style="margin-bottom: 1rem;">✓ View comprehensive analytics and reports</li>
                            <li style="margin-bottom: 1rem;">✓ Manage staff accounts and access levels</li>
                        </ul>
                        <a href="/login.php" class="btn btn-primary btn-block">Admin Login</a>
                    </div>

                    <div class="card">
                        <div style="margin-bottom: 1.5rem;">
                            <div style="width: 3rem; height: 3rem; background: rgba(34, 197, 94, 0.1); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">🛒</div>
                        </div>
                        <h3>Staff Dashboard</h3>
                        <ul style="list-style: none; margin: 1.5rem 0; color: var(--text-light);">
                            <li style="margin-bottom: 1rem;">✓ Process orders with quick billing interface</li>
                            <li style="margin-bottom: 1rem;">✓ View digital menu and manage orders</li>
                            <li style="margin-bottom: 1rem;">✓ Generate and print receipts instantly</li>
                            <li style="margin-bottom: 1rem;">✓ Track daily sales and order statistics</li>
                        </ul>
                        <a href="/login.php" class="btn btn-secondary btn-block">Staff Login</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Benefits Section -->
        <section style="padding: 6rem 2rem;">
            <div class="container">
                <div class="section-header">
                    <h2>Why Choose CanteenPro?</h2>
                </div>

                <div class="grid grid-cols-2">
                    <div style="display: flex; gap: 1rem;">
                        <div>
                            <div style="width: 3rem; height: 3rem; background: var(--primary); color: white; border-radius: var(--radius); display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 1.25rem;">⚡</div>
                        </div>
                        <div>
                            <h3 style="margin-top: 0;">Increased Efficiency</h3>
                            <p style="color: var(--text-light); margin: 0;">Reduce manual work and speed up billing processes with automated calculations and real-time order tracking.</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        <div>
                            <div style="width: 3rem; height: 3rem; background: var(--primary); color: white; border-radius: var(--radius); display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 1.25rem;">🔒</div>
                        </div>
                        <div>
                            <h3 style="margin-top: 0;">Secure & Reliable</h3>
                            <p style="color: var(--text-light); margin: 0;">Secure login systems and encrypted data storage ensure your information is always protected.</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        <div>
                            <div style="width: 3rem; height: 3rem; background: var(--primary); color: white; border-radius: var(--radius); display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 1.25rem;">🕐</div>
                        </div>
                        <div>
                            <h3 style="margin-top: 0;">Real-Time Insights</h3>
                            <p style="color: var(--text-light); margin: 0;">Access real-time sales data and analytics to make informed business decisions.</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        <div>
                            <div style="width: 3rem; height: 3rem; background: var(--primary); color: white; border-radius: var(--radius); display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 1.25rem;">📊</div>
                        </div>
                        <div>
                            <h3 style="margin-top: 0;">Easy Reporting</h3>
                            <p style="color: var(--text-light); margin: 0;">Export transaction records and reports to Excel or PDF for auditing and accounting purposes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section style="background: var(--primary); color: white; padding: 6rem 2rem; text-align: center;">
            <div class="container" style="max-width: 600px;">
                <h2>Ready to Transform Your Canteen?</h2>
                <p>Join canteens around the world that are using CanteenPro to streamline their operations and improve customer satisfaction.</p>
                <a href="/login.php" class="btn btn-secondary btn-lg">Get Started Now</a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3>CanteenPro</h3>
                    <p>Professional canteen management system for efficient operations</p>
                </div>
                <div class="footer-section">
                    <h3>Features</h3>
                    <ul>
                        <li><a href="#features">Digital Menu</a></li>
                        <li><a href="#features">Smart Billing</a></li>
                        <li><a href="#features">Analytics</a></li>
                        <li><a href="#features">Inventory</a></li>
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
