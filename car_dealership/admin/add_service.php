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

    $query = "INSERT INTO services (title, description)
              VALUES ('$title', '$desc')";
    mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container">

                   <?php include("admin_navbar.php"); ?>

        <a href="../logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>
  <form method="post">
            <input type="text" name="title" class="form-control mb-3" placeholder="Service Title" required>
            <textarea name="description" class="form-control mb-3" placeholder="Service Description" required></textarea>
            <button name="add" class="btn btn-dark w-100">Add Service</button>
        </form>
    </div>
</div>

</body>
</html>
