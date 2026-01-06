<?php
include("../includes/db.php");

if (isset($_POST['add'])) {

    $car_name = $_POST['car_name'];
    $price = $_POST['price'];
    $kms = $_POST['kms_driven'];
    $fuel = $_POST['fuel_type'];
    $trans = $_POST['transmission'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "../assets/car_images/$image");

    $query = "INSERT INTO cars 
    (car_name, price, kms_driven, fuel_type, transmission, image)
    VALUES 
    ('$car_name', '$price', '$kms', '$fuel', '$trans', '$image')";

    mysqli_query($conn, $query);
    echo "Car Added Successfully";
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Add Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container">

                   <?php include("admin_navbar.php"); ?>

        <a href="../logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<form method="post" enctype="multipart/form-data">

    <input type="text" name="car_name" class="form-control mb-3"
           placeholder="Car Name" required>

    <input type="number" name="price" class="form-control mb-3"
           placeholder="Price (INR)" required>

    <input type="number" name="kms_driven" class="form-control mb-3"
           placeholder="Kms Driven" required>

    <select name="fuel_type" class="form-control mb-3" required>
        <option value="">Select Fuel Type</option>
        <option>Petrol</option>
        <option>Diesel</option>
        <option>Electric</option>
    </select>

    <select name="transmission" class="form-control mb-3" required>
        <option value="">Select Transmission</option>
        <option>Automatic</option>
        <option>Manual</option>
    </select>

    <input type="file" name="image" class="form-control mb-3" required>

    <button name="add" class="btn btn-dark w-100">
        Add Car
    </button>
</form>
