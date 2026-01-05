<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card p-4 shadow text-center">
        <h3 class="mb-4">Admin Dashboard</h3>

        <a href="add_car.php" class="btn btn-primary mb-2">Add Car</a>
        <a href="add_service.php" class="btn btn-dark mb-2">Add Service</a>
    
        <a href="../logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>

</body>
</html>
