<?php
ob_start();
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
    } else {
        echo "<div style='color: white; background-color: red; padding: 10px; border-radius: 5px; text-align: center; margin: 10px auto; width: 50%;'>Invalid login credentials</div>";
    }
}
?>
<?php
if (isset($_GET['message'])) {
    echo "<p style='color: red;'>" . htmlspecialchars($_GET['message']) . "</p>";
}
?>

<?php require 'partials/head.php' ?>
<html>
<body style="background: url(images/landing_page_background.png); background-repeat: no-repeat; background-position: cover; background-size: cover;">
    <h2 style="text-align: center;">Student Attendance System</h2>
    <h3 style="text-align: center;">Welcome to the Student Attendance System</h3>
    <p style="text-align: center;">Please login to access the system.</p>
    <h2 style="text-align: center;">Admin Login</h2>
    <form method="POST" style="background: rgba(211, 211, 211, 0.5); border-radius: 8px;">
        <input class="" type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p style="text-align: center;">Default username: DEFAULT, Default password: DEFAULT</p>
    <p style="text-align: center;">Don't have an account? <a href="register.php">Register</a></p>
    <p style="text-align: center;">Forgot   ` your password? <a href="reset_password.php">Reset Password</a></p>
    <p style="text-align: center;">Need help? <a href="help.php">Contact Support</a></p>
</body>
</html>


