<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Cars</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Available Cars</h2>
    <div class="row">

<?php
$query = "SELECT * FROM cars";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
?>

    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-body text-center">
                <h5 class="card-title"><?php echo $row['car_name']; ?></h5>
                <p class="card-text">Price: ₹<?php echo $row['price']; ?></p>
<a href="book_car.php?id=<?php echo $row['id']; ?>" 
   class="btn btn-primary">
   Book Now
</a>


            </div>
        </div>
    </div>

<?php
}
?>

    </div>
</div>



</body>
</html>
