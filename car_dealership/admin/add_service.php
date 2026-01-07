<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $desc  = $_POST['description'];
    mysqli_query($conn,
        "INSERT INTO services (title, description)
         VALUES ('$title','$desc')"
    );
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#121212;
            color:#fff;
        }
        .navbar{
            background:#1f1f1f!important;
        }
        .form-control{
            background:#1f1f1f;
            color:#fff;
            border:1px solid #333;
        }
        .form-control::placeholder{
            color:#aaa;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark">
    <div class="container">
        <?php include("admin_navbar.php"); ?>
        <a href="../logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-5" style="max-width:600px">
    <h4 class="mb-4 text-center">Add Service</h4>

    <form method="post">
        <input type="text" name="title" class="form-control mb-3"
               placeholder="Service Title" required>

        <textarea name="description" class="form-control mb-3"
                  placeholder="Service Description" required></textarea>

        <button name="add" class="btn btn-light w-100">
            Add Service
        </button>
    </form>
</div>

</body>
</html>
