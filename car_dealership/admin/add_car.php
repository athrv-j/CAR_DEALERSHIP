<?php
include("../includes/db.php");

if (isset($_POST['add'])) {
    $name = $_POST['car_name'];
    $price = $_POST['price'];

    $query = "INSERT INTO cars (car_name, price)
              VALUES ('$name', '$price')";

    mysqli_query($conn, $query);
    echo "Car Added Successfully";
}
?>

<form method="post">
    Car Name: <input type="text" name="car_name"><br><br>
    Price: <input type="number" name="price"><br><br>
    <button name="add">Add Car</button>
</form>
