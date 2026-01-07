<?php
include("../includes/db.php");

$message = "";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check duplicate email
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");

    if (mysqli_num_rows($check) > 0) {
        $message = "Email already registered. Please login.";
    } else {
        mysqli_query(
            $conn,
            "INSERT INTO users (name, email, password)
             VALUES ('$name','$email','$password')"
        );
        $message = "Registration successful. You can login now.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#02030c,#010002);
}
.card{background:#090916;color:white;border-radius:1rem}
.btn-custom{background:#838185;border:none}
.btn-custom:hover{background:#667eea}
</style>
</head>

<body>

<div class="card p-4 shadow" style="width:350px">
    <h4 class="text-center mb-3">Customer Registration</h4>

    <?php if ($message) { ?>
        <div class="alert alert-warning text-center">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <form method="post">
        <input name="name" class="form-control mb-2" placeholder="Full Name" required>
        <input name="email" type="email" class="form-control mb-2" placeholder="Email" required>
        <input name="password" type="password" class="form-control mb-3" placeholder="Password" required>

        <button name="register" class="btn btn-custom w-100">
            Register
        </button>
    </form>

    <a href="login.php" class="text-center mt-3 d-block">
        Already have an account? Login
    </a>
</div>

</body>
</html>
