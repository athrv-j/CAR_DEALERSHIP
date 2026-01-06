<?php
session_start();
include("../includes/db.php");

$error = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['user'] = $email;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body {
            height: 100vh;
            background: linear-gradient(135deg, #02030c, #010002);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border-radius: 1rem;
            background-color: #141432ff;
            color: #ffffff;
        }
        .btn-custom {
            background-color: #838185;
            border: none;
        }
        .btn-custom:hover {
            background-color: #667eea;
        }
        .login-footer {
            text-align: center;
            margin-top: 1rem;
            color: white;
        }
        .login-footer a {
            color: #ffd700;
            text-decoration: none;
        }
        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">

            <div class="card p-4 shadow-lg">
                <h3 class="text-center mb-4">Customer Login</h3>

                <?php if ($error != "") { ?>
                    <div class="alert alert-danger text-center">
                        <?php echo $error; ?>
                    </div>
                <?php } ?>

                <form method="post">
                    <div class="mb-3">
                        <input type="email" name="email"
                               class="form-control"
                               placeholder="Email" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password"
                               class="form-control"
                               placeholder="Password" required>
                    </div>

                    <button type="submit" name="login"
                            class="btn btn-custom w-100 mb-3">
                        Login
                    </button>

                    <div class="text-center">
                        <a href="forgot_password.php">Forgot Password?</a>
                    </div>
                </form>
            </div>

            <div class="login-footer mt-3">
                Don't have an account?
                <a href="register.php">Sign Up</a>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
