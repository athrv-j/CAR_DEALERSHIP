<?php
session_start();
include("../includes/db.php");

/* HARD DEBUG – NO REDIRECTS */
if (!isset($_SESSION['user'])) {
    die("User session missing");
}

if (!isset($_SESSION['car_id'])) {
    die("Car ID not received in payment");
}

$car_id = $_SESSION['car_id'];

/* FETCH CAR DETAILS */
$query = "SELECT car_name, price FROM cars WHERE id = $car_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    die("Car not found");
}

$car = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card p-4 shadow text-center">

        <h3>Payment Page</h3>

        <p><strong>Car:</strong> <?php echo $car['car_name']; ?></p>
        <p><strong>Amount:</strong> ₹<?php echo number_format($car['price']); ?></p>

        <button class="btn btn-success w-100">
            Pay Now (Demo)
        </button>

    </div>
</div>

</body>
</html>
