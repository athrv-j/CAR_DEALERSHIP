<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
}
?>

<h2>Admin Dashboard</h2>

<a href="add_car.php">Add New Car</a><br><br>
<a href="../logout.php">Logout</a>
