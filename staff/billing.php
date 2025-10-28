<?php
require_once '../config.php';
requireStaff();

$user = getCurrentUser();

// Get menu items for quick add
$menu_items = getFromDB("SELECT * FROM menu_items WHERE status = 'active' ORDER BY category, name");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Billing - CanteenPro</title>
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
                <a href="/staff/billing.php" class="nav-link active">Billing</a>
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
                <h1 class="page-title">Smart Billing</h1>
                <p class="page-subtitle">Process orders and generate receipts</p>
            </div>

            <div class="grid" style="grid-template-columns: 2fr 1fr; gap: 2rem;">
                <!-- Left Side - Quick Add Items -->
                <div>
                    <div class="card" style="margin-bottom: 2rem;">
                        <h2 style="margin-top: 0;">Quick Add Items</h2>
                        <div class="grid grid-cols-3">
                            <?php 
                            $quick_items = getFromDB("SELECT * FROM menu_items WHERE status = 'active' LIMIT 6");
                            while ($item = $quick_items->fetch_assoc()): 
                            ?>
                                <button onclick="addItemToBill(<?php echo $item['id']; ?>, '<?php echo addslashes($item['name']); ?>', <?php echo $item['price']; ?>)" style="padding: 1rem; border: 1px solid var(--border); border-radius: var(--radius); background: white; cursor: pointer; transition: all 0.2s; text-align: center;">
                                    <p style="font-weight: 600; margin: 0 0 0.5rem 0; font-size: 0.9rem;"><?php echo htmlspecialchars($item['name']); ?></p>
                                    <p style="color: var(--text-light); margin: 0; font-size: 0.8rem;">₹<?php echo number_format($item['price'], 0); ?></p>
                                </button>
                            <?php endwhile; ?>
                        </div>
                    </div>

                    <!-- Order Options -->
                    <div class="card">
                        <h2 style="margin-top: 0;">Order Options</h2>
                        <div class="form-group">
                            <label>Customer Name (Optional)</label>
                            <input type="text" id="customer-name" placeholder="Enter customer name">
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label style="display: flex; align-items: center; gap: 0.5rem;">
                                <input type="checkbox" id="discount-check" style="width: auto;">
                                <span>Apply Discount</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Bill Summary -->
                <div class="card" style="border: 2px solid var(--primary); position: sticky; top: 100px;">
                    <h2 style="margin-top: 0; margin-bottom: 1rem;">Order Summary</h2>

                    <!-- Items List -->
                    <div id="bill-items" style="space-y: 1rem; max-height: 300px; overflow-y: auto; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border);">
                        <p style="text-align: center; color: var(--text-light);">No items added yet</p>
                    </div>

                    <!-- Totals -->
                    <div style="space-y: 1rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span style="color: var(--text-light);">Subtotal</span>
                            <span id="subtotal" style="font-weight: 600;">₹0.00</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                            <span style="color: var(--text-light);">Tax (5%)</span>
                            <span id="tax" style="font-weight: 600;">₹0.00</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; border-top: 1px solid var(--border); padding-top: 1rem; margin-bottom: 1.5rem; font-weight: bold; font-size: 1.1rem;">
                            <span>Total</span>
                            <span id="total" style="color: var(--primary);">₹0.00</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <button onclick="completeBill()" class="btn btn-primary btn-block" style="margin-bottom: 0.5rem;">🖨️ Complete & Print</button>
                    <button onclick="clearBill()" class="btn btn-secondary btn-block" style="margin-bottom: 1rem;">✕ Clear Bill</button>

                    <!-- Payment Methods -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 0.5rem;">
                        <button class="btn btn-secondary btn-sm btn-block">💵 Cash</button>
                        <button class="btn btn-secondary btn-sm btn-block">💳 Card</button>
                        <button class="btn btn-secondary btn-sm btn-block">📱 UPI</button>
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
        let billItems = {};

        function addItemToBill(itemId, itemName, price) {
            if (!billItems[itemId]) {
                billItems[itemId] = { name: itemName, price: price, quantity: 0 };
            }
            billItems[itemId].quantity++;
            updateBillDisplay();
        }

        function updateBillDisplay() {
            const container = document.getElementById('bill-items');
            let html = '';
            let subtotal = 0;

            for (let id in billItems) {
                const item = billItems[id];
                const total = item.price * item.quantity;
                subtotal += total;
                html += `
                    <div style="padding: 0.75rem; background: var(--gray-light); border-radius: var(--radius); margin-bottom: 0.75rem; display: flex; justify-content: space-between; align-items: center;">
                        <div style="flex: 1;">
                            <p style="margin: 0; font-weight: 600; font-size: 0.9rem;">${item.name}</p>
                            <div style="margin-top: 0.5rem; display: flex; gap: 0.25rem;">
                                <button onclick="decreaseQty(${id})" style="padding: 0.25rem 0.5rem; background: var(--border); border: none; border-radius: 3px; cursor: pointer;">−</button>
                                <span style="width: 1.5rem; text-align: center; font-weight: 600;">${item.quantity}</span>
                                <button onclick="increaseQty(${id})" style="padding: 0.25rem 0.5rem; background: var(--border); border: none; border-radius: 3px; cursor: pointer;">+</button>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <p style="margin: 0; font-weight: 600;">₹${total.toFixed(2)}</p>
                            <button onclick="removeItem(${id})" style="color: var(--danger); background: none; border: none; padding: 0; cursor: pointer; font-size: 0.75rem; margin-top: 0.25rem;">Remove</button>
                        </div>
                    </div>
                `;
            }

            if (html === '') {
                html = '<p style="text-align: center; color: var(--text-light);">No items added yet</p>';
            }

            container.innerHTML = html;

            const tax = subtotal * 0.05;
            const total = subtotal + tax;

            document.getElementById('subtotal').textContent = '₹' + subtotal.toFixed(2);
            document.getElementById('tax').textContent = '₹' + tax.toFixed(2);
            document.getElementById('total').textContent = '₹' + total.toFixed(2);
        }

        function increaseQty(itemId) {
            billItems[itemId].quantity++;
            updateBillDisplay();
        }

        function decreaseQty(itemId) {
            if (billItems[itemId].quantity > 1) {
                billItems[itemId].quantity--;
            }
            updateBillDisplay();
        }

        function removeItem(itemId) {
            delete billItems[itemId];
            updateBillDisplay();
        }

        function completeBill() {
            alert('Order completed! Receipt will be printed.');
        }

        function clearBill() {
            billItems = {};
            updateBillDisplay();
        }
    </script>
</body>
</html>
