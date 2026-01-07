<?php
session_start();
include("../includes/db.php");

/* USER MUST BE LOGGED IN */
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

/* CAR ID MUST COME FROM cars.php */
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Car ID not received");
}

$car_id = (int)$_GET['id'];
$user_email = $_SESSION['user'];

/* FETCH CAR DETAILS */
$car_query = "SELECT * FROM cars WHERE id = $car_id";
$car_result = mysqli_query($conn, $car_query);

if (mysqli_num_rows($car_result) == 0) {
    die("Car not found");
}

$car = mysqli_fetch_assoc($car_result);

/* CONFIRM BUTTON CLICKED */
if (isset($_POST['confirm'])) {

    // Ensure user agreed to Terms & Conditions
    if (!isset($_POST['agree']) || $_POST['agree'] != '1') {
        $error = "You must agree to the Terms & Conditions before booking.";
    } else {

    /* GET USER ID */
    $user_query = "SELECT id FROM users WHERE email='$user_email'";
    $user_result = mysqli_query($conn, $user_query);
    $user = mysqli_fetch_assoc($user_result);
    $user_id = $user['id'];

        /* INSERT BOOKING */
        mysqli_query(
            $conn,
            "INSERT INTO bookings (user_id, car_id, booking_date)
             VALUES ($user_id, $car_id, CURDATE())"
        );

    /* SAVE CAR ID FOR PAYMENT */
    $_SESSION['car_id'] = $car_id;

        /* GO TO PAYMENT */
        header("Location: ../payment/payment.php");
        exit;
    }
}

// initialize error variable for display
$error = isset($error) ? $error : "";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Car</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        /* Dark theme for booking page */
        body { background-color: #000; color: #fff; -webkit-font-smoothing:antialiased; }
        .navbar { background-color: #17171aff !important; }
        .card { background-color: #17171aff; border: 1px solid rgba(255,255,255,0.06); color: #fff; border-radius:12px; }
            .card-header { background-color: #0b0d0e !important; border-bottom:1px solid rgba(255,255,255,0.04); }
         .list-group-item { background: #080719ff; color:#e6e6e6; border: 1px solid rgba(255,255,255,0.03); }
           .btn-success { background-color: #454148ff; border: none; color: #071014; font-weight:700; }
           .btn-secondary { background-color: #141414; border: 1px solid rgba(255,255,255,0.04); color:#fff; }
        .alert-danger { background-color:#4a1212; color:#fff; border:none; }
    </style>
</head>

<body>

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

                <div class="card-header text-white text-center">
                    <h4>Confirm Booking</h4>
                </div>

                <div class="card-body">

                    <h5 class="text-center mb-3">
                        <?php echo $car['car_name']; ?>
                    </h5>

                    <ul class="list-group mb-3">
                        <li class="list-group-item">
                            <strong>Price:</strong>
                            ₹<?php echo number_format($car['price']); ?>
                        </li>
                        <li class="list-group-item">
                            <strong>Booking Date:</strong>
                            <?php echo date("Y-m-d"); ?>
                        </li>
                    </ul>

                    <form method="post">
                        <?php if (!empty($error)) { ?>
                            <div class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
                        <?php } ?>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="agree" value="1" id="agreeCheck" required>
                            <label class="form-check-label" for="agreeCheck">
                                I agree to the <a href="terms.php" target="_blank">Terms & Conditions</a>
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
