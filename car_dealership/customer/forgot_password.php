<?php
include("../includes/db.php");
$message = "";

if (isset($_POST['reset'])) {

    $email = $_POST['email'];
    $new_password = $_POST['password'];

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($check) == 1) {
        mysqli_query(
            $conn,
            "UPDATE users SET password='$new_password' WHERE email='$email'"
        );
        $message = "Password updated successfully. You can login now.";
    } else {
        $message = "Email not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Dark theme for forgot password */
        body.dark-theme {
            background-color: #000000;
            color: #ffffff;
            -webkit-font-smoothing:antialiased;
        }
        .card {
            background-color: #0f1112;
            border: 1px solid rgba(255,255,255,0.06);
            color: #ffffff;
            border-radius: 12px;
        }
        .form-control {
            background-color: #081013;
            color: #ffffff;
            border: 1px solid #22282b;
            border-radius: 8px;
            padding: 0.6rem 0.75rem;
        }


        
        .btn-primary {
            background-color: #140c3aff;
            border: none;
            color: #ffffff;
            font-weight: 700;
            border-radius: 8px;
            padding: 0.6rem 0.8rem;
        }
        
        .alert-info {
            background-color: #1f2b2d;
            color: #e6f7f8;
            border: 1px solid rgba(23,162,184,0.08);
        }
        a { color: #8fd6ff; }
    </style>
</head>
<body class="dark-theme">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card p-4 shadow mx-auto" style="max-width:420px;">
                <h4 class="text-center mb-1">Reset Password</h4>
                <p class="text-center text-secondary mb-3">Enter your registered email and new password.</p>

                <?php if ($message != "") { ?>
                    <div class="alert alert-info text-center">
                        <?php echo $message; ?>
                    </div>
                <?php } ?>

                <form method="post">
                    <input type="email" name="email"
                           class="form-control mb-3"
                           placeholder="Registered Email" required>

                    <input type="password" name="password"
                           class="form-control mb-3"
                           placeholder="New Password" required>

                    <button name="reset"
                            class="btn btn-primary w-100">
                        Update Password
                    </button>
                </form>

                <div class="text-center mt-3">
                    <a href="login.php">Back to Login</a>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
