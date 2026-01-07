<?php
session_start();
include("../includes/db.php");

$error = "";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin 
              WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid Admin Username or Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Clean high-contrast dark theme (no gradients) */
        body.dark-theme {
            background-color: #050506; /* near-black */
            color: #f7f7f7;
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        }

        /* Navbar */
        .navbar-dark .navbar-brand {
            color: #ffffff;
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        /* Centering container */
        .login-container { min-height: calc(100vh - 100px); display:flex; align-items:center; }

        /* Card */
        .card.login-card {
            background-color: #0b0d0e; /* deep charcoal */
            color: #ffffff;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.06);
            box-shadow: 0 12px 40px rgba(2,6,23,0.7);
        }

        .card.login-card .card-body { padding: 2rem; }

        .login-title { font-size: 1.4rem; font-weight:700; margin-bottom:0.25rem; }
        .login-subtitle { color: #bfc7cb; margin-bottom:1rem; font-size:0.9rem; }

        /* Inputs */
        .form-label { color: #e6edef; font-weight:600; }
        .form-control {
            background-color: #081013; /* slightly different to card */
            color: #ffffff;
            border: 1px solid #22282b;
            border-radius: 8px;
            padding: 0.65rem 0.75rem;
            box-shadow: none;
        }
        .form-control::placeholder { color: #7f8b90; }
        .form-control:focus {
            background-color: #081013;
            border-color: #17a2b8;
            box-shadow: 0 6px 20px rgba(23,162,184,0.12);
            color: #fff;
        }

        /* Primary action (no gradient) */
        .btn-primary {
            background-color: #303435ff; /* teal */
            border: none;
            color: #ffffff;
            font-weight: 700;
            padding: 0.6rem 0.85rem;
            border-radius: 8px;
        }
        .btn-primary:hover { background-color: #313434ff; }

        /* Alert */
        .alert-danger {
            background-color: #4a1212; /* deep muted red */
            color: #fff;
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,0.03);
        }

        @media (max-width:576px) {
            .card.login-card { margin: 0 1rem; }
        }
    </style>
 </head>
<body class="dark-theme">

<!-- SIMPLE NAVBAR -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand mb-0 h1">Car Dealership - Admin</span>
    </div>
</nav>

<!-- LOGIN CARD -->
<div class="container login-container">
    <div class="card login-card p-4 shadow mx-auto" style="max-width: 420px;">
        <h3 class="login-title text-center">Admin Login</h3>
        <p class="login-subtitle text-center">Sign in to manage cars, bookings and site content.</p>

        <?php if ($error != "") { ?>
            <div class="alert alert-danger text-center">
                <?php echo $error; ?>
            </div>
        <?php } ?>

    <!-- IMPORTANT: method="post" -->
        <form method="post">

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text"
                       name="username"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       required>
            </div>

            <!-- IMPORTANT: name="login" -->
            <button type="submit"
                    name="login"
                    class="btn btn-primary w-100">
                Login
            </button>
        </form>

    </div>
</div>

</body>
</html>
