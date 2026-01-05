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
    <title>Add Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h3 class="text-center mb-3">Add Service</h3>

        <form method="post">
            <input type="text" name="title" class="form-control mb-3" placeholder="Service Title" required>
            <textarea name="description" class="form-control mb-3" placeholder="Service Description" required></textarea>
            <button name="add" class="btn btn-dark w-100">Add Service</button>
        </form>
    </div>
</div>

</body>
</html>
