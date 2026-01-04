<?php
include("../includes/db.php");

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (name, email, password)
              VALUES ('$name', '$email', '$password')";

    mysqli_query($conn, $query);
    echo "Registration Successful";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Customer Registration</h2>

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h3 class="text-center mb-3">Customer Registration</h3>

        <form method="post">
            <input type="text" name="name" class="form-control mb-3" placeholder="Name" required>
            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

            <button name="register" class="btn btn-primary w-100">
                Register
            </button>
        </form>
    </div>
</div>

</body>
