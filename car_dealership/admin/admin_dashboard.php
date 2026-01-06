<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

/* DASHBOARD COUNTS */
$car_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM cars")
)['total'];

$service_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM services")
)['total'];

$booking_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM bookings")
)['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container">

                   <?php include("admin_navbar.php"); ?>

                    <a class="nav-link" href="add_car copy.html">Add Car</a>
                    <a class="nav-link" href="add_service copy.html">Add Service</a>
            
        <a href="../logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<!-- DASHBOARD CONTENT -->
<div class="container mt-5">

    <h3 class="text-center mb-4">Admin Dashboard</h3>

    <!-- STATS ROW -->
    <div class="row text-center mb-4">

        <div class="col-md-4 mb-3">
            <div class="card shadow p-3">
                <h5>Total Cars</h5>
                <h2><?php echo $car_count; ?></h2>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow p-3">
                <h5>Total Services</h5>
                <h2><?php echo $service_count; ?></h2>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow p-3">
                <h5>Total Bookings</h5>
                <h2><?php echo $booking_count; ?></h2>
            </div>
        </div>

    </div>

    <!-- ACTION BUTTONS -->
    <div class="card shadow p-4 text-center">
        <h5 class="mb-3">Admin Actions</h5>

        <a href="add_car.php" class="btn btn-primary mb-2 w-100">
            Add New Car
        </a>

        <a href="add_service.php" class="btn btn-dark mb-2 w-100">
            Add Service
        </a>

        <a href="manage_services.php" class="btn btn-secondary mb-2 w-100">
            Manage Services
        </a>

        <a href="view_bookings.php" class="btn btn-success w-100">
            View Bookings
        </a>
    </div>

</div>

</body>
</html>
