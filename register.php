<?php include 'session.php'; ?>

<?php
include 'connect.php';
$message = '';
$messageType = ''; // 'success' or 'error'

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $reg_no = $_POST['reg_no'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $query = "INSERT INTO students (name, reg_no, course, year) VALUES ('$name', '$reg_no', '$course', '$year')";
    if ($conn->query($query) === TRUE) {
        $message = "Student Registered Successfully";
        $messageType = 'success';
    } else {
        $message = "Error: " . $conn->error;
        $messageType = 'error';
    }
}
?>
<?php require 'partials/head.php'?>
<style>
    body {
        font-family: Arial, sans-serif;
        background: url('images/registration_page.png') no-repeat center center fixed;
        background-size: cover;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    nav {
        position: fixed;
        top: 0;
        width: 100%;
        background-color: #333;
        padding: 10px 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
    }

    nav ul li {
        margin: 0 15px;
    }

    nav ul li a {
        color: white;
        text-decoration: none;
        font-size: 16px;
        font-weight: bold;
        transition: color 0.3s;
    }

    nav ul li a:hover {
        color: #28a745;
    }
    form {
        background: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
        width: 300px;
        text-align: center;
    }
    h1 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
    }
    input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }
    button:hover {
        background-color: #0056b3;
    }
    .popup {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        padding: 15px 20px;
        border-radius: 5px;
        font-size: 16px;
        color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        display: none;
    }
    .popup.success {
        background-color: #28a745;
    }
    .popup.error {
        background-color: #dc3545;
    }
</style>
<nav>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="attendance.php">Mark Attendance</a></li>
        <li><a href="view_students.php">Students</a></li>
        <!-- <li><a href="reports.php">Reports</a></li> -->
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>
<?php if ($message): ?>
    <div class="popup <?php echo $messageType; ?>" id="popup">
        <?php echo $message; ?>
    </div>
    <script>
        const popup = document.getElementById('popup');
        popup.style.display = 'block';
        setTimeout(() => {
            popup.style.display = 'none';
        }, 3000); // Hide after 3 seconds
    </script>
<?php endif; ?>
<form method="POST">
    <h1>Register Student</h1>
    <input type="text" name="name" placeholder="Student Name" required>
    <input type="text" name="reg_no" placeholder="Registration Number" required>
    <input type="text" name="course" placeholder="Course" required>
    <input type="text" name="year" placeholder="Year of Study" required>
    <button type="submit">Register</button>
</form>
