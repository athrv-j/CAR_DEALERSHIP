<?php
session_start();
include("../includes/db.php");
/* FETCH SERVICES FROM DATABASE */
$services_query = "SELECT * FROM services";
$services_result = mysqli_query($conn, $services_query);


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

/* Example DB usage: count total cars */
$car_count_query = "SELECT COUNT(*) AS total FROM cars";
$car_count_result = mysqli_query($conn, $car_count_query);
$car_count = mysqli_fetch_assoc($car_count_result)['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Dealership</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- WEBSITE TITLE ABOVE NAVBAR -->
<div class="bg-dark text-white text-center py-3">
    <h2 class="fw-bold m-0">CarDealership</h2>
</div>

<!-- HEADER / NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-top">
    <div class="container justify-content-center">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="dashboard.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="cars.php">Cars</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
            </ul>
        </div>

    </div>
</nav>

<!-- HOME CONTENT -->
<section class="container my-5">

    <!-- Hero Section -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">Welcome to CarDealership</h1>
        <p class="text-secondary mt-3">
            Discover premium cars, trusted service, and unbeatable deals — all in one place.
        </p>

        <!-- DB CONNECTED BUTTON -->
        <a href="cars.php" class="btn btn-dark mt-3">
            Explore Cars (<?php echo $car_count; ?> Available)
        </a>
    </div>

    <!-- Features -->
    <div class="row text-center">

        <div class="col-md-4 mb-4">
            <img src="wide_range.jpeg"
                 class="img-fluid rounded mb-3"
                 style="width: 350px; height: 195px;">
            <h4 class="fw-bold">Wide Range of Cars</h4>
            <p class="text-secondary">
                Choose from luxury, sports, and family cars from top brands.
            </p>
        </div>


        <div class="col-md-4 mb-4">
            <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70"
                 class="img-fluid rounded mb-3"
                 style="width: 300px; height: 195px;">
            <h4 class="fw-bold">Best Prices</h4>
            <p class="text-secondary">
                Competitive pricing with exciting offers and discounts.
            </p>
        </div>

          <div class="col-md-4 mb-4">
            <img src="service.jpeg"
                 class="img-fluid rounded mb-3"
                 style="width: 370px; height: 195px;">
            <h4 class="fw-bold">Trusted Services</h4>
            <p class="text-secondary">
                We provide servicing, insurance, and financing support.
            </p>
        </div>
</div>

</section>
 
<!-- SERVICES SECTION -->
<section class="container my-5">
    <h2 class="mb-4 text-center">Our Services</h2>
    <div class="row">
        <?php while ($service = mysqli_fetch_assoc($services_result)) { ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="fw-bold">
                            <?php echo htmlspecialchars($service['title']); ?>
                        </h5>
                        <p class="text-secondary">
                            <?php echo htmlspecialchars($service['description']); ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-dark text-light pt-4 mt-5">
    <div class="container">
        <p class="text-center text-secondary mb-0 pb-3">
            © 2026 Car Dealership. All rights reserved.
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


