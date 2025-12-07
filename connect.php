<?php
$conn = mysqli_connect(
    "centerbeam.proxy.rlwy.net:19912",
    "root",
    "OZQBoaKdOtjHINeYzgnyIZhZSvtHXPmQ",
    "railway",
    3306
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

