<?php
session_start();
include("../includes/db.php");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['user'] = $email;
        header("Location: cars.php");
    } else {
        echo "Invalid Login";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Customer Login</h2>

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h3 class="text-center">Customer Login</h3>

        <form method="post">
            <input type="email" name="email" class="form-control mb-3" placeholder="Email">
            <input type="password" name="password" class="form-control mb-3" placeholder="Password">

            <button name="login" class="btn btn-success w-100">
                Login
            </button>
        </form>
    </div>
</div>


</body>
</html>
