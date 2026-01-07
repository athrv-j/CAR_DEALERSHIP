<?php
session_start();
include("../includes/db.php");

/* ADMIN AUTH CHECK */
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

/* FETCH BOOKINGS WITH USER & CAR DETAILS */
$query = "
SELECT 
    bookings.id AS booking_id,
    users.email AS customer_email,
    cars.car_name,
    cars.price,
    bookings.booking_date
FROM bookings
JOIN users ON bookings.user_id = users.id
JOIN cars ON bookings.car_id = cars.id
ORDER BY bookings.id DESC
";

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Dark admin table styles */
        body { background-color: #000000ff;}
        .container { padding-top: 3.5rem; }
        h3 { color: #544c52ff; }
        .card { background: #0f0845ff; border: 1px solid }
           .table thead th { background: #111217; color: #fff; border-bottom:1px solid rgba(255,255,255,0.04); }
            </style>
</head>
<body>
<!-- ADMIN NAVBAR -->
<?php include("admin_navbar.php"); ?>
<div class="container mt-2">
    <h3 class="text-center mb-4">All Bookings</h3>
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Email</th>
                        <th>Car</th>
                        <th>Price (₹)</th>
                        <th>Booking Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo htmlspecialchars($row['customer_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['car_name']); ?></td>
                        <td><?php echo number_format($row['price']); ?></td>
                        <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                    </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No bookings found</td></tr>";
                }
                ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>