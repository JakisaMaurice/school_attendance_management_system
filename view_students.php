<?php
include 'connect.php';
$query = "SELECT * FROM students";
$result = $conn->query($query);
?>
<?php require 'partials/head.php'?>
<style>
    body {
        font-family: Arial, sans-serif;
        margin-top: 60px; /* Adjust for fixed nav */

        /* padding-top: 20px; */
        background-color: #f4f4f4;
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
<h2>Registered Students</h2>
<a href="export_attendance.php" style="display:inline-block; margin:10px; padding:10px; background:#4CAF50; color:white; text-decoration:none;">📥 Download Attendance Report (CSV)</a>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Registration Number</th>
        <th>Course</th>
        <th>Year</th>
        <th>Attendance</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['reg_no']; ?></td>
        <td><?php echo $row['course']; ?></td>
        <td><?php echo $row['year']; ?></td>
        <td><?php echo $row['attendance']; ?></td>
    </tr>
    <?php } ?>
</table>

<?php
include 'connect.php';

$query = "SELECT students.name, students.reg_no, attendance_records.course_unit, attendance_records.attendance_date
          FROM attendance_records
          JOIN students ON CONVERT(students.reg_no USING utf8mb4) = CONVERT(attendance_records.reg_no USING utf8mb4)
          ORDER BY attendance_records.attendance_date DESC";

$result = $conn->query($query);
?>

<h2>Attendance Records</h2>
<table border="1">
    <tr>
        <th>Student Name</th>
        <th>Registration Number</th>
        <th>Course Unit</th>
        <th>Date</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['reg_no']; ?></td>
        <td><?php echo $row['course_unit']; ?></td>
        <td><?php echo $row['attendance_date']; ?></td>
    </tr>
    <?php } ?>
</table>