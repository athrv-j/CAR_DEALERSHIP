<?php
session_start();
include("../includes/db.php");

// Check login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Get car ID
if (!isset($_GET['id'])) {
    header("Location: cars.php");
    exit();
}

$car_id = $_GET['id'];

// Fetch car details
$car_query = "SELECT * FROM cars WHERE id = $car_id";
$car_result = mysqli_query($conn, $car_query);
$car = mysqli_fetch_assoc($car_result);

// Handle booking confirmation
if (isset($_POST['confirm'])) {

    $user_email = $_SESSION['user'];

    $user_query = "SELECT id FROM users WHERE email='$user_email'";
    $user_result = mysqli_query($conn, $user_query);
    $user = mysqli_fetch_assoc($user_result);

    $user_id = $user['id'];

    $booking_query = "INSERT INTO bookings (user_id, car_id, booking_date)
                      VALUES ($user_id, $car_id, CURDATE())";

    mysqli_query($conn, $booking_query);

    header("Location: ../payment/payment.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Car</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">Car Dealership</span>
        <span class="text-white"><?php echo $_SESSION['user']; ?></span>
    </div>
</nav>

<!-- Booking Card -->
<div class="container mt-5">
    <div class="row justify-content-center">

        <div class="col-md-6">
            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center">
                    <h4>Confirm Booking</h4>
                </div>

                <div class="card-body">

                    <h5 class="text-center mb-3">
                        <?php echo $car['car_name']; ?>
                    </h5>

                    <ul class="list-group mb-3">
                        <li class="list-group-item">
                            <strong>Price:</strong> ₹<?php echo $car['price']; ?>
                        </li>
                        <li class="list-group-item">
                            <strong>Booking Date:</strong> <?php echo date("Y-m-d"); ?>
                        </li>
                    </ul>

                    <form method="post">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" required>
                            <label class="form-check-label">
                                I agree to the terms and conditions
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button name="confirm" class="btn btn-success">
                                Confirm & Proceed to Payment
                            </button>

                            <a href="cars.php" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </div>
</div>

</body>
</html>
