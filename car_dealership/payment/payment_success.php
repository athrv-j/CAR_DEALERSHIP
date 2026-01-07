<?php
session_start();
unset($_SESSION['car_id']);
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment Successful</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light text-center">

<div class="container mt-5">
    <h1>Payment Successful 🎉</h1>
    <p>Your booking has been confirmed.</p>

    <a href="../customer/my_bookings.php" class="btn btn-success mt-3">
        View My Bookings
    </a>
</div>

</body>
</html>
