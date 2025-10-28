# CanteenPro - Quick Start Guide

Get your canteen management system up and running in 5 minutes!

---

## ⚡ 5-Minute Setup

### 1. Upload Files to Your Server (2 minutes)
- Upload all files to your web hosting server
- Ensure you're in the public/web root directory

### 2. Create Database (1 minute)
```sql
CREATE DATABASE canteen_management;
USE canteen_management;
(Paste contents of database.sql and execute)
```

### 3. Configure Database (1 minute)
Edit `config.php`:
```php
define('DB_HOST', 'localhost');    // Usually localhost
define('DB_USER', 'root');         // Your database username
define('DB_PASS', '');             // Your database password
```

### 4. Access Application (1 minute)
- Open `http://yoursite.com/` in your browser
- Click "Get Started" and login

---

## 🔑 Default Credentials

**Admin**
- Username: `admin`
- Password: `admin123`

**Staff**  
- Username: `staff`
- Password: `staff123`

> ⚠️ **CHANGE THESE IMMEDIATELY IN PRODUCTION**

---

## 🎯 First 10 Steps

1. **Login as Admin**
   - Go to /login.php
   - Select "Admin" role
   - Enter admin credentials

2. **Review Dashboard**
   - See overview statistics
   - Check recent orders (will be empty initially)

3. **Explore Menu Management**
   - Go to Menu Management
   - See demo menu items already added
   - Add your own items as needed

4. **Check Inventory**
   - Go to Inventory
   - See stock tracking system
   - Update quantities as needed

5. **View Analytics**
   - Go to Analytics
   - See how reports will look once you have data

6. **Create Staff Account** (Optional)
   - Add new staff members through admin panel
   - Or use demo staff account

7. **Login as Staff**
   - Logout from admin account
   - Login with staff credentials

8. **Process an Order**
   - Go to Staff Dashboard
   - Click "New Order"
   - Add items using quick-add buttons
   - Complete the billing

9. **View Orders**
   - Go to Orders page
   - See the order you just created

10. **Explore Reports**
    - Go back to Admin
    - Check Analytics to see your order reflected
    - Try Billing and Records sections

---

## 📱 Main URLs

| Page | URL |
|------|-----|
| Home | `/index.php` |
| Login | `/login.php` |
| **Admin** | |
| Dashboard | `/admin/dashboard.php` |
| Menu | `/admin/menu.php` |
| Billing | `/admin/billing.php` |
| Inventory | `/admin/inventory.php` |
| Analytics | `/admin/analytics.php` |
| Records | `/admin/records.php` |
| **Staff** | |
| Dashboard | `/staff/dashboard.php` |
| Menu | `/staff/menu.php` |
| Billing | `/staff/billing.php` |
| Orders | `/staff/orders.php` |

---

## 🛠️ Common Tasks

### Add Menu Item
1. Login as Admin
2. Go to Menu Management
3. Click "Add Menu Item"
4. Fill in name, category, price
5. Save

### Create Staff Account
1. Login as Admin
2. Database → INSERT (or use admin panel if you build it)
3. Add new user with role='staff'

### View Sales Reports
1. Login as Admin
2. Go to Analytics
3. View charts and statistics
4. Click "Generate Report" for specific periods

### Process Order as Staff
1. Login as Staff
2. Go to Smart Billing
3. Click items to add to bill
4. Calculate totals
5. Click "Complete & Print"

### Check Inventory
1. Login as Admin
2. Go to Inventory
3. View stock levels
4. Edit quantities as needed

---

## 🚨 If Something Goes Wrong

### "Connection failed" error?
- Check if MySQL is running
- Verify credentials in `config.php`
- Check database exists: `canteen_management`

### Login not working?
- Clear browser cookies
- Make sure you selected the correct role (Admin/Staff)
- Check caps lock on password

### Files not displaying?
- Check all files are uploaded
- Verify file permissions (chmod 755 for folders, 644 for files)
- Clear browser cache

### CSS/Images broken?
- Check file paths are correct
- Clear browser cache
- Check if all CSS files are in `/css` folder

---

## 📋 Pre-Deployment Checklist

- [ ] Database created and imported
- [ ] `config.php` updated with correct credentials
- [ ] File permissions set correctly
- [ ] Admin and staff passwords changed
- [ ] Test login works
- [ ] Test staff can process orders
- [ ] Test admin can view analytics
- [ ] Backup system set up

---

## 💡 Quick Tips

**For Faster Billing:**
- Use keyboard shortcut: Press 'B' to go to billing
- Click quick-add buttons instead of searching
- Use arrow keys to navigate

**For Better Organization:**
- Organize menu items by category
- Set reorder levels for inventory
- Review analytics weekly

**For Security:**
- Change default passwords
- Use strong passwords
- Regular backups

---

## 📞 Need Help?

1. **Check README.md** - Full documentation
2. **Review database.sql** - See data structure
3. **Check config.php** - Verify settings
4. **Test one feature at a time** - Process > Debug > Fix

---

## 🎓 Understanding the Flow

```
User visits index.php (Home)
         ↓
    Click Login
         ↓
    Select Role (Admin/Staff)
         ↓
    Enter Credentials
         ↓
    ├─ If Admin → /admin/dashboard.php
    └─ If Staff → /staff/dashboard.php
         ↓
    Access Features
         ↓
    Click Logout → /login.php
```

---

## 📊 Demo Data Included

The system comes with:
- 10 sample menu items
- 2 demo user accounts
- 6 inventory items
- Demo categories

Feel free to modify, delete, or add to this data!

---

## 🔄 Regular Tasks

**Daily:**
- Check pending orders
- Process customer payments

**Weekly:**
- Review sales analytics
- Check inventory levels
- Export reports

**Monthly:**
- Back up database
- Review trends
- Update menu if needed

---

## 🎉 You're All Set!

Your CanteenPro system is ready to use. Start by:
1. Logging in as admin
2. Customizing the menu
3. Creating staff accounts
4. Training staff on the billing system

Then start processing orders and track your sales!

---

**Enjoy using CanteenPro!** 🍽️

For detailed information, see `README.md`
