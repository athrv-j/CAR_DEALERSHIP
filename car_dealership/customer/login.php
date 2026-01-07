<?php
session_start();
include("../includes/db.php");

$error = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check = mysqli_query(
        $conn,
        "SELECT id FROM users WHERE email='$email' AND password='$password'"
    );

    if (mysqli_num_rows($check) == 1) {
        $_SESSION['user'] = $email;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Customer Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#02030c,#010002);
}
.card{background:#141432;color:white;border-radius:1rem}
.btn-custom{background:#838185;border:none}
.btn-custom:hover{background:#667eea}
.login-footer{color:white;text-align:center;margin-top:1rem}
.login-footer a{color:#ffd700;text-decoration:none}
</style>
</head>

<body>

<div class="card p-4 shadow" style="width:350px">

    <h4 class="text-center mb-3">Customer Login</h4>

    <?php if ($error) { ?>
        <div class="alert alert-danger text-center">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form method="post">
        <input type="email" name="email"
               class="form-control mb-2"
               placeholder="Email" required>

        <input type="password" name="password"
               class="form-control mb-3"
               placeholder="Password" required>

        <button name="login" class="btn btn-custom w-100">
            Login
        </button>
    </form>

    <div class="text-center mt-2">
        <a href="forgot_password.php">Forgot Password?</a>
    </div>

    <div class="login-footer">
        Don't have an account?
        <a href="register.php">Sign Up</a>
    </div>

</div>

</body>
</html>
