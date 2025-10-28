# CanteenPro - Canteen Management System
## PHP/MySQL Version

A professional, full-featured canteen management system built with HTML, CSS, JavaScript, PHP, and MySQL.

---

## 📋 Features

### Core Features
- ✅ **Digital Menu Display** - Interactive menu with categories and prices
- ✅ **Smart Billing System** - Quick billing interface with automatic calculations
- ✅ **Record Management** - Transaction history and reporting
- ✅ **Analytics & Reports** - Sales insights and trends
- ✅ **Inventory Management** - Stock tracking and alerts
- ✅ **User Roles** - Admin and Staff dashboards
- ✅ **Order Tracking** - Real-time order status management

### Tech Stack
- **Frontend**: HTML5, CSS3, Vanilla JavaScript
- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Server**: Apache with mod_rewrite

---

## 🚀 Installation & Setup

### Step 1: Download and Extract Files
1. Download all project files to your local machine or web server
2. Extract to your web root directory (e.g., `public_html`, `www`, or `htdocs`)

### Step 2: Create Database
1. Open **phpMyAdmin** or your database management tool
2. Create a new database named `canteen_management`
3. Import the SQL schema:
   - Go to the "Import" tab
   - Select the provided `database.sql` file
   - Click "Import"

Alternatively, run SQL commands:
```bash
mysql -u root -p < database.sql
```

### Step 3: Configure Database Connection
1. Open `config.php` in your project root
2. Update database credentials:
```php
define('DB_HOST', 'localhost');    // Your database host
define('DB_USER', 'root');         // Your database username
define('DB_PASS', '');             // Your database password
define('DB_NAME', 'canteen_management');
```

### Step 4: Set File Permissions (Linux/Mac)
```bash
chmod 755 .
chmod 644 *.php
chmod 755 admin staff css js
```

### Step 5: Access the Application
- **Homepage**: `http://your-domain.com/`
- **Login**: `http://your-domain.com/login.php`

---

## 🔐 Default Login Credentials

### Admin Account
- **Username**: `admin`
- **Password**: `admin123`
- **Role**: Administrator

### Staff Account
- **Username**: `staff`
- **Password**: `staff123`
- **Role**: Staff Member

> **Important**: Change these credentials in production!

---

## 📁 Project Structure

```
canteen-management/
├── index.php                 # Homepage
├── login.php                 # Login page
├── logout.php                # Logout script
├── config.php                # Database configuration
├── database.sql              # Database schema
├── css/
│   └── style.css            # Main stylesheet
├── js/
│   └── script.js            # JavaScript utilities
├── admin/
│   ├── dashboard.php         # Admin dashboard
│   ├── menu.php              # Menu management
│   ├── billing.php           # Billing management
│   ├── inventory.php         # Inventory management
│   ├── analytics.php         # Analytics & reports
│   └── records.php           # Records & exports
└── staff/
    ├── dashboard.php         # Staff dashboard
    ├── menu.php              # Menu browsing
    ├── billing.php           # Smart billing
    └── orders.php            # Order tracking
```

---

## 🎯 User Roles & Access

### Admin Dashboard Features
- Manage menu items (add, edit, delete, categories)
- View billing and transaction history
- Monitor inventory and stock levels
- Generate reports and analytics
- View sales trends and best-selling items
- Manage staff accounts

### Staff Dashboard Features
- Quick order processing with smart billing
- Browse and search menu items
- Track orders in real-time
- Generate receipts
- View daily sales statistics
- Process payments (cash, card, UPI)

---

## 📊 Admin Pages Guide

### Dashboard
- Overview of daily metrics
- Recent orders list
- Quick action buttons
- Performance statistics

### Menu Management
- View all menu items
- Add new items
- Edit prices and descriptions
- Manage categories
- Filter by status

### Billing Management
- View all transactions
- Revenue statistics (daily, weekly, monthly)
- Transaction history
- Export billing records

### Inventory Management
- Track stock levels
- Set reorder levels
- Low-stock alerts
- Consumption tracking

### Analytics & Reports
- Sales trends (7-day chart)
- Top-selling items
- Peak hours analysis
- Revenue metrics

### Records & Reports
- Generate daily/weekly/monthly reports
- Export to PDF or Excel
- Item-wise sales data
- Staff performance tracking

---

## 💼 Staff Pages Guide

### Dashboard
- Quick statistics for the day
- Recent orders
- Quick action buttons
- Tips and reminders

### Menu
- Browse all available items by category
- Search functionality
- Today's special items
- Add items to order

### Smart Billing
- Quick-add buttons for common items
- Real-time calculation of totals
- Automatic tax calculation
- Multiple payment methods
- Print receipts

### Orders
- View all placed orders
- Track order status (pending, preparing, ready, completed)
- Customer information
- Order amount

---

## 🔧 Customization Guide

### Add New Menu Item (Database)
```php
INSERT INTO menu_items (name, category, price, description, status, created_by) 
VALUES ('Item Name', 'Category', 100.00, 'Description', 'active', 1);
```

### Change Theme Colors
Edit `css/style.css` and modify CSS variables:
```css
:root {
    --primary: #4338ca;
    --success: #22c55e;
    --warning: #eab308;
    --danger: #ef4444;
}
```

### Add New Staff Member
```php
INSERT INTO users (username, email, password, role, full_name) 
VALUES ('username', 'email@example.com', PASSWORD('password'), 'staff', 'Full Name');
```

---

## 🐛 Troubleshooting

### Issue: "Connection failed: Connection refused"
**Solution**: 
- Check if MySQL is running
- Verify database credentials in `config.php`
- Ensure database host is correct

### Issue: "Database does not exist"
**Solution**:
- Create database using phpMyAdmin
- Import the `database.sql` file
- Verify database name matches in `config.php`

### Issue: "Cannot modify header information"
**Solution**:
- Ensure no whitespace before `<?php` tag
- Check for BOM (Byte Order Mark) in files
- Remove any `?>` at end of PHP files

### Issue: Login not working
**Solution**:
- Clear browser cache
- Check if session is enabled in php.ini
- Verify database has user data
- Check password hashing

### Issue: CSS/JS not loading
**Solution**:
- Check file paths are correct
- Verify file permissions (644 for files)
- Clear browser cache
- Check if files exist in correct directories

---

## 📝 Database Schema

### Users Table
- Stores admin and staff accounts
- Hashed password field
- Role-based access control

### Menu Items Table
- Product catalog
- Price and category management
- Status tracking (active, inactive, limited_stock)

### Bills Table
- Transaction records
- Payment details
- Tax and discount tracking

### Orders Table
- Order status tracking
- Linked to bills
- Real-time updates

### Inventory Table
- Stock level tracking
- Reorder level management
- Last updated timestamps

---

## 🔒 Security Recommendations

1. **Change Default Credentials**
   - Update admin and staff passwords immediately
   - Use strong passwords (min 8 characters, mixed case, numbers, symbols)

2. **Set up HTTPS**
   - Use SSL certificate
   - Redirect HTTP to HTTPS

3. **Database Security**
   - Use strong database passwords
   - Restrict database user privileges
   - Regular backups

4. **File Permissions**
   - Set proper file permissions (644 for files, 755 for directories)
   - Keep sensitive files outside web root if possible

5. **Regular Updates**
   - Keep PHP and MySQL updated
   - Monitor and patch security vulnerabilities

---

## 📞 Support & Maintenance

### Regular Maintenance Tasks
- **Daily**: Backup database
- **Weekly**: Review logs and transactions
- **Monthly**: Audit inventory and stock levels
- **Quarterly**: Clean up old records

### Backup Instructions
```bash
# MySQL backup
mysqldump -u root -p canteen_management > backup_$(date +%Y%m%d).sql

# File backup
tar -czf canteen_backup_$(date +%Y%m%d).tar.gz /path/to/project
```

---

## 📱 Browser Support

- Chrome/Chromium (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Edge (latest 2 versions)

---

## 📄 File Overview

| File | Purpose |
|------|---------|
| `index.php` | Homepage and feature showcase |
| `login.php` | User authentication |
| `config.php` | Database and app configuration |
| `css/style.css` | Complete styling |
| `js/script.js` | Utility functions and helpers |
| `database.sql` | MySQL schema and demo data |

---

## 🎓 Getting Started

1. **First Login**: Use admin credentials to explore admin features
2. **Add Menu Items**: Customize menu with your items
3. **Set Up Inventory**: Add stock items and reorder levels
4. **Invite Staff**: Create staff accounts for team members
5. **Start Processing Orders**: Use staff billing interface

---

## 📊 Analytics & Reporting

The system tracks:
- Daily orders and revenue
- Top-selling items
- Peak hours
- Staff performance
- Inventory consumption
- Customer trends

All data can be exported for further analysis.

---

## 💡 Tips for Best Results

1. **Regular Updates**: Keep inventory current
2. **Staff Training**: Ensure staff understands the billing interface
3. **Menu Management**: Update menu regularly with new items
4. **Monitoring**: Check analytics to identify trends
5. **Maintenance**: Regular database backups

---

## 📝 License

This software is provided as-is for use in canteen and food service operations.

---

## 🚀 Next Steps

1. Configure database connection
2. Create menu items
3. Set up staff accounts
4. Train staff on billing process
5. Monitor and optimize operations

For questions or support, refer to the built-in documentation or contact your system administrator.

---

**Version**: 1.0  
**Last Updated**: 2024  
**Compatibility**: PHP 7.4+, MySQL 5.7+
