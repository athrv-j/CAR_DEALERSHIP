<?php
session_start();
include("../includes/db.php");

$car_id = $_GET['id'];
$user_email = $_SESSION['user'];

$user_query = "SELECT id FROM users WHERE email='$user_email'";
$user_result = mysqli_query($conn, $user_query);
$user = mysqli_fetch_assoc($user_result);

$user_id = $user['id'];

$booking_query = "INSERT INTO bookings (user_id, car_id, booking_date)
                  VALUES ($user_id, $car_id, CURDATE())";

mysqli_query($conn, $booking_query);

header("Location: ../payment/payment.php");
?>
