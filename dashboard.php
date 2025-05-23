<?php include 'session.php'; ?>

<?php
// session_start();
include 'connect.php';

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

// Fetch total students
$total_students_query = "SELECT COUNT(*) AS total_students FROM students";
$total_students_result = $conn->query($total_students_query);
$total_students = $total_students_result->fetch_assoc()['total_students'];

/// Fetch total classes from the new 'classes' table
$total_classes_query = "SELECT COUNT(*) AS total_classes FROM classes";
$total_classes_result = $conn->query($total_classes_query);
$total_classes = $total_classes_result->fetch_assoc()['total_classes'];


// Calculate average attendance percentage
$attendance_query = "
    SELECT AVG((attendance / (SELECT COUNT(*) FROM classes)) * 100) AS avg_attendance 
    FROM students 
    WHERE attendance > 0
";
$attendance_result = $conn->query($attendance_query);
$avg_attendance = $attendance_result->fetch_assoc()['avg_attendance'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff;
        }

        header {
            background-color: #0073e6;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        .dashboard-container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
            text-align: center;
        }

        .dashboard-container h2 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #333;
        }

        .stats {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
            margin: 20px 0;
        }

        .card {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            width: 30%;
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .card h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #0073e6;
        }

        .card p {
            font-size: 1.2em;
            color: #555;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 20px 0;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        ul li {
            margin: 0;
        }

        ul li a {
            text-decoration: none;
            color: white;
            background-color: #0073e6;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        ul li a:hover {
            background-color: #005bb5;
        }
    </style>
</head>
<body>
    <header>
        <h1>Student Attendance Management System</h1>
    </header>

    <div class="dashboard-container">
        <h2>Welcome to the Admin Dashboard</h2>

        <div class="stats">
            <div class="card">
                <h3>Total Students</h3>
                <p><?php echo $total_students; ?></p>
            </div>
            <div class="card">
                <h3>Total Classes Held</h3>
                <p><?php echo $total_classes ?: 0; ?></p>
            </div>
            <div class="card">
                <h3>Average Attendance</h3>
                <p><?php echo $avg_attendance ? number_format($avg_attendance, 2) . '%' : '0%'; ?></p>
            </div>
        </div>

        <ul>
            <li><a href="register.php">Register Student</a></li>
            <li><a href="attendance.php">Mark Attendance</a></li>
            <li><a href="view_students.php">View Students</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <script>
        let logoutTimer;

        function resetTimer() {
            clearTimeout(logoutTimer);
            logoutTimer = setTimeout(() => {
                window.location.href = "logout.php"; // Redirect to logout page
            }, 900000); // 15 minutes
        }

        // Reset timer on any user interaction
        document.addEventListener("mousemove", resetTimer);
        document.addEventListener("keydown", resetTimer);
        document.addEventListener("click", resetTimer);
        document.addEventListener("scroll", resetTimer);

        resetTimer();
    </script>
</body>
</html>
