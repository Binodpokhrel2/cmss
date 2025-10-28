-- Canteen Management System Database Schema

CREATE DATABASE IF NOT EXISTS canteen_management;
USE canteen_management;

-- Users Table
CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(100) UNIQUE NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin', 'staff') NOT NULL DEFAULT 'staff',
  full_name VARCHAR(100) NOT NULL,
  is_active TINYINT(1) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Menu Items Table
CREATE TABLE menu_items (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(150) NOT NULL,
  category VARCHAR(50) NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  description TEXT,
  image_url VARCHAR(255),
  status ENUM('active', 'inactive', 'limited_stock') DEFAULT 'active',
  created_by INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Bills Table
CREATE TABLE bills (
  id INT PRIMARY KEY AUTO_INCREMENT,
  bill_number VARCHAR(50) UNIQUE NOT NULL,
  bill_date DATETIME NOT NULL,
  customer_name VARCHAR(100),
  subtotal DECIMAL(12, 2) NOT NULL,
  tax_amount DECIMAL(10, 2) DEFAULT 0,
  discount_amount DECIMAL(10, 2) DEFAULT 0,
  total_amount DECIMAL(12, 2) NOT NULL,
  payment_method ENUM('cash', 'card', 'upi') NOT NULL,
  status ENUM('paid', 'pending') DEFAULT 'paid',
  created_by INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Bill Items Table
CREATE TABLE bill_items (
  id INT PRIMARY KEY AUTO_INCREMENT,
  bill_id INT NOT NULL,
  menu_item_id INT NOT NULL,
  quantity INT NOT NULL,
  unit_price DECIMAL(10, 2) NOT NULL,
  total_price DECIMAL(12, 2) NOT NULL,
  FOREIGN KEY (bill_id) REFERENCES bills(id) ON DELETE CASCADE,
  FOREIGN KEY (menu_item_id) REFERENCES menu_items(id)
);

-- Orders Table
CREATE TABLE orders (
  id INT PRIMARY KEY AUTO_INCREMENT,
  order_number VARCHAR(50) UNIQUE NOT NULL,
  bill_id INT NOT NULL,
  status ENUM('pending', 'preparing', 'ready', 'completed') DEFAULT 'pending',
  total_items INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (bill_id) REFERENCES bills(id) ON DELETE CASCADE
);

-- Inventory Table
CREATE TABLE inventory (
  id INT PRIMARY KEY AUTO_INCREMENT,
  item_name VARCHAR(150) NOT NULL,
  quantity DECIMAL(10, 2) NOT NULL,
  unit VARCHAR(50) NOT NULL,
  reorder_level DECIMAL(10, 2) NOT NULL,
  last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  updated_by INT NOT NULL,
  FOREIGN KEY (updated_by) REFERENCES users(id)
);

-- Daily Sales Table (for analytics)
CREATE TABLE daily_sales (
  id INT PRIMARY KEY AUTO_INCREMENT,
  sale_date DATE NOT NULL UNIQUE,
  total_orders INT DEFAULT 0,
  total_revenue DECIMAL(12, 2) DEFAULT 0,
  total_items_sold INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Menu Category Table
CREATE TABLE menu_categories (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) UNIQUE NOT NULL,
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default categories
INSERT INTO menu_categories (name, description) VALUES
('Main Course', 'Main course dishes'),
('Snacks', 'Light snacks and appetizers'),
('Beverages', 'Drinks and beverages'),
('Desserts', 'Desserts and sweets');

-- Insert demo admin user (password: admin123)
INSERT INTO users (username, email, password, role, full_name) VALUES
('admin', 'admin@canteen.com', '$2y$10$YIjlrjyUVVkwvLmrpv8EIuK8xvK8L9M8K8L9M8K8L9M8K8L9M8K8K', 'admin', 'Admin User');

-- Insert demo staff user (password: staff123)
INSERT INTO users (username, email, password, role, full_name) VALUES
('staff', 'staff@canteen.com', '$2y$10$ZJjlrjyUVVkwvLmrpv8EIuK8xvK8L9M8K8L9M8K8L9M8K8L9M8K8K', 'staff', 'Staff Member');

-- Insert demo menu items
INSERT INTO menu_items (name, category, price, description, status, created_by) VALUES
('Paneer Butter Masala', 'Main Course', 280.00, 'Creamy paneer curry', 'active', 1),
('Biryani', 'Main Course', 200.00, 'Fragrant basmati rice', 'active', 1),
('Chole Bhature', 'Main Course', 150.00, 'Chickpeas with fried bread', 'active', 1),
('Samosa', 'Snacks', 30.00, 'Crispy stuffed pastry', 'active', 1),
('Pakora', 'Snacks', 50.00, 'Fried vegetable fritters', 'active', 1),
('Spring Rolls', 'Snacks', 80.00, 'Crispy spring rolls', 'active', 1),
('Coffee', 'Beverages', 40.00, 'Hot coffee', 'active', 1),
('Fresh Orange Juice', 'Beverages', 60.00, 'Freshly squeezed juice', 'active', 1),
('Lassi', 'Beverages', 50.00, 'Yogurt drink', 'active', 1),
('Butter Garlic Naan', 'Main Course', 80.00, 'Freshly made naan', 'active', 1);

-- Insert demo inventory
INSERT INTO inventory (item_name, quantity, unit, reorder_level, updated_by) VALUES
('Chicken Breast', 45, 'kg', 20, 1),
('Tomato Sauce', 8, 'liters', 10, 1),
('Paneer', 12, 'kg', 5, 1),
('Cooking Oil', 3, 'liters', 5, 1),
('Rice', 120, 'kg', 50, 1),
('Spice Mix', 2, 'kg', 5, 1);
