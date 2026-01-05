<?php
session_start();
include("../includes/db.php");

/* SAFETY CHECK */
if (!isset($_GET['id'])) {
    die("Car ID not received");
}

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$car_id = $_GET['id'];
$user_email = $_SESSION['user'];

/* GET USER ID */
$user_query = "SELECT id FROM users WHERE email='$user_email'";
$user_result = mysqli_query($conn, $user_query);

if (!$user_result || mysqli_num_rows($user_result) == 0) {
    die("User not found");
}

$user = mysqli_fetch_assoc($user_result);
$user_id = $user['id'];

/* INSERT BOOKING */
$booking_query = "INSERT INTO bookings (user_id, car_id, booking_date)
                  VALUES ('$user_id', '$car_id', CURDATE())";

mysqli_query($conn, $booking_query);

/* REDIRECT TO PAYMENT */
header("Location: ../payment/payment.php");
exit;
?>
