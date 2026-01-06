<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['user'];

$user = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT id FROM users WHERE email='$email'")
);

$query = "
SELECT cars.car_name, cars.price, bookings.booking_date
FROM bookings
JOIN cars ON bookings.car_id = cars.id
WHERE bookings.user_id = {$user['id']}
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h3 class="text-center mb-4">My Booking History</h3>

    <table class="table table-bordered text-center">
        <tr>
            <th>Car</th>
            <th>Price</th>
            <th>Date</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['car_name']; ?></td>
            <td>₹<?php echo $row['price']; ?></td>
            <td><?php echo $row['booking_date']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
