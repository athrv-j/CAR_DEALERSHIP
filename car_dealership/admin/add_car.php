<?php
include("../includes/db.php");

if (isset($_POST['add'])) {
    $name = $_POST['car_name'];
    $price = $_POST['price'];

    $query = "INSERT INTO cars (car_name, price)
              VALUES ('$name', '$price')";

$image = $_FILES['image']['name'];
$temp  = $_FILES['image']['tmp_name'];
move_uploaded_file($temp, "../assets/images/$image");

$query = "INSERT INTO cars (car_name, price, image)
          VALUES ('$car_name', '$price', '$image')";


    mysqli_query($conn, $query);
    echo "Car Added Successfully";
}
?>

<form method="post" enctype="multipart/form-data">
    <input type="text" name="car_name" class="form-control mb-3" placeholder="Car Name" required>
    <input type="number" name="price" class="form-control mb-3" placeholder="Price" required>
    <input type="file" name="image" class="form-control mb-3" required>
    <button name="add" class="btn btn-dark w-100">Add Car</button>
</form>
