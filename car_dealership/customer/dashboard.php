<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$services_result = mysqli_query($conn, "SELECT * FROM services");
$car_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM cars"))['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Dealership</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body{background:#000;color:#fff;-webkit-font-smoothing:antialiased}
    .card{border-radius:1rem;transition:.22s;background:#0f1112;border:1px solid rgba(255,255,255,.06)}
    .card:hover{transform:translateY(-6px);box-shadow:0 18px 40px rgba(2,6,23,.8)}
    .card-img-top{height:220px;object-fit:cover;border-radius:1rem 1rem 0 0;filter:brightness(.82) contrast(1.02)}
    .btn-primary{background:#383840;border:none;color:#fafafb;font-weight:700;box-shadow:0 8px 22px rgba(23,0,230,.18)}
       a{color:#8fd6ff}
    footer{background:#020203;color:#cfcfcf}
    </style>
</head>
<body>

<div class="text-center py-3" style="background:#07070a">
    <h2 class="fw-bold m-0">CarDealership</h2>
    <div class="text-end"><span><?php echo $_SESSION['user']; ?></span></div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background:linear-gradient(90deg,#1a0f23,#23253b)">
    <div class="container justify-content-center">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="dashboard.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="cars.php">Cars</a></li>
                <li class="nav-item"><a class="nav-link" href="my_bookings.php">My Bookings</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<section class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Welcome to CarDealership</h1>
        <p class="text-secondary mt-3">Discover premium cars, trusted service, and unbeatable deals — all in one place.</p>
        <a href="cars.php" class="btn btn-primary mt-3">Explore Cars (<?php echo $car_count; ?> Available)</a>
    </div>

    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <img src="wide_range.jpeg" class="img-fluid rounded mb-3" style="width:350px;height:195px;filter:brightness(.9)">
            <h4 class="fw-bold">Wide Range of Cars</h4>
            <p class="text-secondary">Choose from luxury, sports, and family cars from top brands.</p>
        </div>
        <div class="col-md-4 mb-4">
            <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70" class="img-fluid rounded mb-3" style="width:300px;height:195px;filter:brightness(.9)">
            <h4 class="fw-bold">Best Prices</h4>
            <p class="text-secondary">Competitive pricing with exciting offers and discounts.</p>
        </div>
        <div class="col-md-4 mb-4">
            <img src="service.jpeg" class="img-fluid rounded mb-3" style="width:370px;height:195px;filter:brightness(.9)">
            <h4 class="fw-bold">Trusted Services</h4>
            <p class="text-secondary">We provide servicing, insurance, and financing support.</p>
        </div>
    </div>
</section>

<section class="container my-5">
    <h2 class="mb-4 text-center">Our Services</h2>
    <div class="row">
        <?php while ($service = mysqli_fetch_assoc($services_result)) { ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="fw-bold"><?php echo htmlspecialchars($service['title']); ?></h5>
                        <p class="text-secondary"><?php echo htmlspecialchars($service['description']); ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<footer class="bg-dark text-light pt-4 mt-5">
    <div class="container">
        <div class="row text-center text-md-start">
            <div class="col-md-4 mb-3">
                <h5>CarDealership</h5>
                <p class="text-secondary">Your trusted car dealership offering premium vehicles and excellent service.</p>
            </div>
            <div class="col-md-4 text-center mb-3">
                <img src="ferrari.jpeg" style="max-height:120px">
            </div>
            <div class="col-md-4 mb-3">
                <h5>Contact</h5>
                <p class="text-secondary mb-1">📍 Pune, India</p>
                <p class="text-secondary mb-1">📞 +91 98765 43210</p>
                <p class="text-secondary">✉ support@cardealership.com</p>
            </div>
        </div>
        <hr class="border-secondary">
        <p class="text-center text-secondary mb-0 pb-3">© 2026 Car Dealership. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>