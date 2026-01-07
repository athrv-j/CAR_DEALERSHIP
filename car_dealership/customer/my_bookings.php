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
    <style>
        /* Dark theme for My Bookings */
        body { background-color: #000; color: #fff; -webkit-font-smoothing:antialiased; }
        .container { padding-top: 3.5rem; }
        h3 { color: #fff; }
        .card { background: #0d0427ff; border:1px solid rgba(65, 36, 196, 0.06); }
        .card-body { padding:1rem; }
        .table { color:#e6e6e6; background: transparent; }
        .table thead th { background:#111217; color:#fff; border-bottom:1px solid rgba(255,255,255,0.04); }
        .table tbody tr { background: #0b0c0d; }
        .table tbody tr:nth-child(odd) { background: #0d0e0f; }
        .table td, .table th { border-color: rgba(255,255,255,0.03); vertical-align: middle; }
        .text-center a { color: #8fd6ff; }
    </style>
</head>
<body>

<div class="container mt-4">
    <h3 class="text-center mb-4">My Booking History</h3>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                <tr>
                    <th>Car</th>
                    <th>Price</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>

                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['car_name']); ?></td>
                    <td>₹<?php echo number_format($row['price']); ?></td>
                    <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                </tr>
                <?php } ?>

                </tbody>
            </table>
            </div>
        </div>
    </div>

</div>

</body>
</html>
