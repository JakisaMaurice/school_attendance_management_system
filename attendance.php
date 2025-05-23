<?php include 'session.php'; ?>

<!-- <?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reg_no = $_POST['reg_no'];
    $course_unit = $_POST['course_unit'];

    // Check if student exists
    $check_query = "SELECT * FROM students WHERE reg_no='$reg_no'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        // Insert attendance record
        $insert_query = "INSERT INTO attendance_records (reg_no, course_unit) VALUES ('$reg_no', '$course_unit')";
        if ($conn->query($insert_query) === TRUE) {
            echo "Attendance Marked for $course_unit";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Wrong Registration Number!";
    }
}
?>

<?php require 'partials/head.php'; ?>
<form method="POST">
    <input type="text" name="reg_no" placeholder="Enter Registration Number" required>
    <select name="course_unit" required>
        <option value="">Select Course Unit</option>
        <option value="Mathematics">Mathematics</option>
        <option value="Programming">Programming</option>
        <option value="Networking">Networking</option>
        <!-- Add more course units 
    </select>
    <button type="submit">Mark Attendance</button>
</form>
 -->

<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reg_no = $_POST['reg_no'];

    // Check if student exists
    $check_query = "SELECT * FROM students WHERE reg_no='$reg_no'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {

        // Only insert a class session ONCE PER DAY or with a toggle button
        // You can use a session check or create a button like "Start Class Session"

        // Step 1: Insert into classes table
        $insert_class = "INSERT INTO classes () VALUES ()";
        $conn->query($insert_class); // Creates one row = 1 class

        // Step 2: Mark attendance for the current student
        $update_attendance = "UPDATE students SET attendance = attendance + 1 WHERE reg_no='$reg_no'";
        if ($conn->query($update_attendance) === TRUE) {
            echo "<div class='popup success'>Attendance marked successfully.</div>";
        } else {
            echo "<div class='popup error'>Error updating attendance: " . $conn->error . "</div>";
        }

    } else {
        echo "<div class='popup error'>Student not found.</div>";
    }
}
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background: url('images/attendance_background.png');
        background-repeat: no-repeat;
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
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        background-color: #007bff;
        color: white;
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
        z-index: 1000;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        animation: fadeInOut 4s ease-in-out;
    }

    .popup.success {
        background-color: #28a745;
    }

    .popup.error {
        background-color: #dc3545;
    }

    @keyframes fadeInOut {
        0% {
            opacity: 0;
            transform: translateX(-50%) translateY(-20px);
        }
        10%, 90% {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
        100% {
            opacity: 0;
            transform: translateX(-50%) translateY(-20px);
        }
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

<form method="POST" style="background:rgba(255, 255, 255, 0.5); padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); width: 350px; text-align: center; margin: auto;">
    <h2 style="color: #333; font-family: Arial, sans-serif; margin-bottom: 20px;">Mark Attendance</h2>
    <input type="text" name="reg_no" placeholder="Enter Registration Number" required style="width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;">
    <select name="course_unit" required style="width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;">
        <option value="" disabled selected>Select Course Unit</option>
        <option value="Web Programming">Web Programming</option>
        <option value="Data Communication">Data Communication</option>
        <option value="Mobile App Development">Mobile App Development</option>
        <option value="Computer Security and Ethics">Computer Security and Ethics</option>
        <option value="Multimedia Technologies">Multimedia Technologies</option>
        <!-- Add more course units as needed -->
    </select>
    <button type="submit" style="background-color: #28a745; color: white; border: none; padding: 12px 20px; border-radius: 5px; cursor: pointer; font-size: 16px; width: 100%; transition: background-color 0.3s;">
        Mark Attendance
    </button>
    <button type="reset" style="background-color: #dc3545; color: white; border: none; padding: 12px 20px; border-radius: 5px; cursor: pointer; font-size: 16px; width: 100%; margin-top: 10px; transition: background-color 0.3s;">
        Reset All Attendances
    </button>
</form></form>