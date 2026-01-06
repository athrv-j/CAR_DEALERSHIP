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
    <style>
    /* High-contrast dark theme (copied from cars.php) */
    body {
        background-color: #000000; /* pure black */
        color: #ffffff;
        -webkit-font-smoothing:antialiased;
    }
    .card {
        border-radius: 1rem;
        transition: 0.22s ease;
        background-color: #0f1112;
        border: 1px solid rgba(255,255,255,0.06);
        color: inherit;
    }
    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(2,6,23,0.8);
    }
    .card-img-top {
        height: 220px;
        object-fit: cover;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
        filter: brightness(0.82) contrast(1.02);
    }
    .card-title { color: #ffffff; font-weight:700; }
    .card-text { color: #e6e6e6; }
    .btn-primary {
        background: #383840ff;
        border: none;
        color: #fafafbff;
        font-weight:700;
        box-shadow: 0 8px 22px rgba(23, 0, 230, 0.18);
    }
    .btn-primary:hover { opacity: 0.96; transform: translateY(-1px); }
    a { color: #8fd6ff; }
    .text-secondary { color: #cfcfcf !important; }
    footer { background-color: #020203; color: #cfcfcf; }
    h1, h2 { color: #ffffff; }
    @media (max-width: 576px) {
        .card { border-radius: 0.75rem; }
    }
    </style>
</head>
<body>

<!-- WEBSITE TITLE ABOVE NAVBAR -->
<div class="text-center py-3" style="background-color:#07070a;">
    <h2 class="fw-bold m-0 text-white">CarDealership</h2>
</div>

<!-- HEADER / NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top"
    style="background:linear-gradient(90deg,#1a0f23,#23253b);">
    <div class="container justify-content-center">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="dashboard.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="cars.php">Cars</a></li>
            
                <li class="nav-item">
    <a class="nav-link" href="my_bookings.php">My Bookings</a>
</li>

                <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
            </ul>
        </div>

    </div>
</nav>

<!-- HOME CONTENT -->
<section class="container my-5">

    <!-- Hero Section -->
    <div class="text-center mb-5">
        <h1 class="fw-bold text-white">Welcome to CarDealership</h1>
        <p class="text-secondary mt-3">
            Discover premium cars, trusted service, and unbeatable deals — all in one place.
        </p>

        <!-- DB CONNECTED BUTTON -->
        <a href="cars.php" class="btn btn-primary mt-3">
            Explore Cars (<?php echo $car_count; ?> Available)
        </a>
    </div>

    <!-- Features -->
    <div class="row text-center">

        <div class="col-md-4 mb-4">
            <img src="wide_range.jpeg"
                 class="img-fluid rounded mb-3"
                 style="width: 350px; height: 195px; filter: brightness(0.9);">
            <h4 class="fw-bold text-white">Wide Range of Cars</h4>
            <p class="text-secondary">
                Choose from luxury, sports, and family cars from top brands.
            </p>
        </div>


        <div class="col-md-4 mb-4">
            <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70"
                 class="img-fluid rounded mb-3"
                 style="width: 300px; height: 195px; filter: brightness(0.9);">
            <h4 class="fw-bold text-white">Best Prices</h4>
            <p class="text-secondary">
                Competitive pricing with exciting offers and discounts.
            </p>
        </div>

                    <div class="col-md-4 mb-4">
                        <img src="service.jpeg"
                                 class="img-fluid rounded mb-3"
                                 style="width: 370px; height: 195px; filter: brightness(0.9);">
                        <h4 class="fw-bold text-white">Trusted Services</h4>
                        <p class="text-secondary">
                                We provide servicing, insurance, and financing support.
                        </p>
                </div>
</div>

</section>
 
<!-- SERVICES SECTION -->
<section class="container my-5">
    <h2 class="mb-4 text-center text-white">Our Services</h2>
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


