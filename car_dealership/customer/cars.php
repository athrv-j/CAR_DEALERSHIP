<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM cars ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Premium First-Hand Luxury Cars</title>

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>
/* High-contrast dark theme */
body {
    background-color: #000000; /* pure black for max contrast */
    color: #ffffff; /* bright white text */
    -webkit-font-smoothing:antialiased;
}
.card {
    border-radius: 1rem;
    transition: 0.22s ease;
    background-color: #0f1112; /* slightly lighter than black */
    border: 1px solid rgba(255,255,255,0.06); /* crisp border */
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
    /* add a subtle dark overlay via filter for better text contrast */
    filter: brightness(0.82) contrast(1.02);
}
.card-title { color: #ffffff; font-weight:700; }
.card-text { color: #e6e6e6; }
.btn-primary {
    /* vivid green accent for high contrast */
    background: #383840ff;
    border: none;
    color: #fafafbff; /* dark text for strong contrast on green */
    font-weight:700;
    box-shadow: 0 8px 22px rgba(23, 0, 230, 0.18);
}
.btn-primary:hover { opacity: 0.96; transform: translateY(-1px); }
    .btn-primary:hover { opacity: 0.98; transform: translateY(-1px); }
/* Links and muted text: make them high contrast */
a { color: #8fd6ff; }
.text-secondary { color: #cfcfcf !important; }
footer { background-color: #020203; color: #cfcfcf; }

/* Make headings stand out */
h2 { color: #ffffff; }

/* Responsive tweak: make cards more prominent on small screens */
@media (max-width: 576px) {
    .card { border-radius: 0.75rem; }
}
</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top"
    style="background:linear-gradient(90deg,#1a0f23,#23253b);">
<div class="container">
    <a class="navbar-brand text-white fw-bold" href="dashboard.php">
        Go To Home
    </a>
</div>
</nav>

<div class="container mt-5">
<h2 class="text-center mb-5 text-white">Premium First-Hand Luxury Cars</h2>

<div class="row g-4">

<?php while ($car = mysqli_fetch_assoc($result)) { ?>

<div class="col-lg-4 col-md-6">
<div class="card shadow-sm h-100">

<img src="../assets/car_images/<?php echo $car['image']; ?>"
     class="card-img-top">

<div class="card-body">
<h5 class="card-title"><?php echo $car['car_name']; ?></h5>

<p class="card-text">
<strong>Price:</strong> ₹<?php echo number_format($car['price']); ?><br>
<strong>Kms Driven:</strong> <?php echo $car['kms_driven']; ?> km<br>
<strong>Fuel:</strong> <?php echo $car['fuel_type']; ?><br>
<strong>Transmission:</strong> <?php echo $car['transmission']; ?>
</p>

<a href="book_car.php?id=<?php echo $car['id']; ?>"
   class="btn btn-primary w-100">
   Book / Contact Dealer
</a>

</div>
</div>
</div>

<?php } ?>

</div>
</div>

<footer class="text-center p-4 mt-5 text-white">
© 2026 Premium Cars Portal
</footer>

</body>
</html>
