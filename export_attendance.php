<?php
include 'connect.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="attendance_report.csv"');

// Output stream
$output = fopen('php://output', 'w');

// Output column headers
fputcsv($output, ['Name', 'Registration Number', 'Course', 'Year', 'Attendance (%)']);

// Fetch data from DB
$query = "SELECT *, (attendance / total_classes) * 100 AS attendance_percentage FROM students";
$result = $conn->query($query);

// Output each row
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row['name'],
        $row['reg_no'],
        $row['course'],
        $row['year'],
        number_format($row['attendance_percentage'], 2) . '%'
    ]);
}

fclose($output);
exit();
?>
