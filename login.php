<?php
require_once 'config.php';

if (isLoggedIn()) {
    if (hasRole('admin')) {
        header("Location: /admin/dashboard.php");
    } else {
        header("Location: /staff/dashboard.php");
    }
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = escapeStr($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    if (empty($username) || empty($password) || empty($role)) {
        $error = 'Please fill all fields';
    } else {
        $result = getFromDB("SELECT * FROM users WHERE username = '$username' AND role = '$role'");
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['full_name'] = $user['full_name'];

            if ($user['role'] === 'admin') {
                header("Location: /admin/dashboard.php");
            } else {
                header("Location: /staff/dashboard.php");
            }
            exit();
        } else {
            $error = 'Invalid credentials';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CanteenPro - Login</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-box">
            <!-- Logo -->
            <div class="login-logo">
                <div class="logo-icon">🍽️</div>
                <h1>CanteenPro</h1>
                <p>Canteen Management System</p>
            </div>

            <!-- Login Form -->
            <form method="POST" class="login-form">
                <?php if ($error): ?>
                    <div class="alert alert-error">
                        <span>❌</span>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    </div>
                <?php endif; ?>

                <!-- Role Selection -->
                <div class="form-group">
                    <label>Select Your Role</label>
                    <div class="role-selector">
                        <label class="role-option">
                            <input type="radio" name="role" value="admin" required>
                            <span>👨‍💼 Admin</span>
                        </label>
                        <label class="role-option">
                            <input type="radio" name="role" value="staff" required>
                            <span>👤 Staff</span>
                        </label>
                    </div>
                </div>

                <!-- Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter username" required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter password" required>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>

                <!-- Demo Info -->
                <div class="demo-info">
                    <p>📝 Demo Mode: Use any email and password</p>
                </div>
            </form>

            <!-- Demo Accounts -->
            <div class="demo-accounts">
                <h3>Demo Accounts</h3>
                <p><strong>Admin:</strong> admin / admin123</p>
                <p><strong>Staff:</strong> staff / staff123</p>
            </div>

            <!-- Footer Links -->
            <div class="login-footer">
                <p>First time here? <a href="/">Go to Home Page</a></p>
            </div>
        </div>
    </div>
</body>
</html>
