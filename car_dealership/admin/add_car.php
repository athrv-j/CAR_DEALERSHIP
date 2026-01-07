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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<style>
body{
    background:#121212;
    color:#fff;
    min-height:100vh;
    padding-top:56px;
}

nav.navbar{
    position:absolute;
    top:0;left:0;right:0;
}

.card{
    background:#1f1f1f;
    color:#fff;
    border:1px solid #333;
    border-radius:10px;
}

.form-control{
    background:#121212;
    color:#fff;
    border:1px solid #333;
}

.form-control::placeholder{
    color:#aaa;
}

.form-control:focus{
    background:#121212;
    color:#fff;
    border-color:#fff;
    box-shadow:none;
}

.btn-custom{
    background:#fff;
    color:#000;
    border:none;
}

.btn-custom:hover{
    background:#ddd;
}

.main-wrapper{
    min-height:calc(100vh - 56px);
    display:flex;
    align-items:center;
}
</style>
</head>
<body> 

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container">

                   <?php include("admin_navbar.php"); ?>

        <a href="../logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<div class="main-wrapper">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card p-4 shadow-lg">
          <h3 class="text-center mb-4">Add Car</h3>
          <form method="post" enctype="multipart/form-data">

     <select name="car_name" class="form-control mb-3" required>
                <option value="">Select Car</option>
                <option>XUV700</option>
                <option>Defender</option>
                <option>Fortuner</option>
                <option>Lamborghini Huracán EVO</option>
                <option>BMW X5</option>
                <option>Range Rover</option>
                <option>Mercedes-Benz GLE</option>
                <option>Porsche 911 Turbo S</option>
            </select>

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

            <button name="add" class="btn btn-custom w-100">
                Add Car
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>