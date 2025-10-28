<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'canteen_management');

// Create database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8");

// Session configuration
session_start();

// Helper function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Helper function to check user role
function hasRole($role) {
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

// Helper function to redirect to login if not authenticated
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: /login.php");
        exit();
    }
}

// Helper function to redirect if not admin
function requireAdmin() {
    requireLogin();
    if (!hasRole('admin')) {
        header("Location: /");
        exit();
    }
}

// Helper function to redirect if not staff
function requireStaff() {
    requireLogin();
    if (!hasRole('staff') && !hasRole('admin')) {
        header("Location: /");
        exit();
    }
}

// Helper function for safe database queries
function getFromDB($query) {
    global $conn;
    $result = $conn->query($query);
    if (!$result) {
        die("Query Error: " . $conn->error);
    }
    return $result;
}

// Helper function to escape strings
function escapeStr($string) {
    global $conn;
    return $conn->real_escape_string($string);
}

// Helper function to get current user
function getCurrentUser() {
    global $conn;
    if (!isLoggedIn()) {
        return null;
    }
    
    $user_id = $_SESSION['user_id'];
    $result = getFromDB("SELECT * FROM users WHERE id = $user_id");
    return $result->fetch_assoc();
}

// Helper function to generate unique bill number
function generateBillNumber() {
    return 'BILL-' . date('Y-m-d-') . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT);
}

// Helper function to generate unique order number
function generateOrderNumber() {
    return 'ORD-' . date('Y-m-d-') . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT);
}
?>
