<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

include("../includes/db.php");
/* TOTAL BOOKINGS */
$total_bookings = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM bookings")
)['total'];

/* TOTAL SERVICES */
$total_services = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM services")
)['total'];

/* TOTAL CARS */
$total_cars = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM cars")
)['total'];

/* FETCH ALL CARS */
$all_cars = mysqli_query($conn, "SELECT car_name, price FROM cars");

/* PREPARE CHART DATA */
$car_names = [];
$car_prices = [];

/* PRICE RANGE COUNTS */
$low_range = 0;      // < 20L
$medium_range = 0;   // 20L – 50L
$high_range = 0;     // > 50L

while ($car = mysqli_fetch_assoc($all_cars)) {
    $car_names[] = $car['car_name'];
    $car_prices[] = (float)$car['price'];

    if ($car['price'] < 2000000) {
        $low_range++;
    } elseif ($car['price'] <= 5000000) {
        $medium_range++;
    } else {
        $high_range++;
    }
}

/* LATEST CARS */
$latest_cars = mysqli_query(
    $conn,
    "SELECT car_name, price FROM cars ORDER BY id DESC LIMIT 10"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<style>

:root {
    --bg-main: #0b0c10;
    --bg-card: #16171b;
    --bg-card-hover: #1d1f24;
    --border-soft: #2a2b30;
    --text-main: #e6e6eb;
    --text-muted: #9a9aa1;
    --accent: #0a84ff;
    --accent-soft: rgba(10,132,255,0.25);
}
body {
    background:
        radial-gradient(circle at top, #12131a, #0b0c10 70%);
    color: var(--text-main);
    font-family: -apple-system, BlinkMacSystemFont,
                 "SF Pro Text", "Segoe UI", Roboto, sans-serif;
    letter-spacing: 0.2px;
}
.navbar {
    background: rgba(22, 23, 27, 0.85) !important;
    backdrop-filter: blur(12px);
    border-bottom: 1px solid var(--border-soft);
}

.navbar-brand {
    font-weight: 600;
    color: #ffffff !important;
}

.navbar-nav .nav-link {
    color: var(--text-muted) !important;
    font-weight: 500;
}

.navbar-nav .nav-link:hover {
    color: var(--accent) !important;
}

.navbar-text {
    color: var(--text-muted) !important;
}
.card {
    background: linear-gradient(
        180deg,
        var(--bg-card),
        #121318
    );
    border: 1px solid var(--border-soft);
    border-radius: 18px;
    box-shadow:
        0 12px 40px rgba(0,0,0,0.55),
        inset 0 1px 0 rgba(255,255,255,0.03);
    transition: 0.35s ease;
}

.card:hover {
    background: var(--bg-card-hover);
    box-shadow:
        0 20px 60px rgba(0,0,0,0.75),
        0 0 0 1px var(--accent-soft);
}

.stat-card {
    padding: 1.4rem;
    border-left: 5px solid var(--accent);
}

.stat-card div:first-child {
    font-size: 0.9rem;
    color: var(--text-muted);
    letter-spacing: 0.5px;
}

.stat-value {
    font-size: 2.4rem;
    font-weight: 600;
    color: #ffffff;
    margin-top: 4px;
}

/* ===== HEADINGS ===== */
h5 {
    font-weight: 600;
    color: #ffffff;
    margin-bottom: 1rem;
}

/* ===== TABLE ===== */
.table {
    color: var(--text-main);
    border-color: var(--border-soft);
}

.table thead th {
    background: #1f2126;
    color: #ffffff;
    border-bottom: 1px solid var(--border-soft);
    font-weight: 500;
}

.table tbody tr {
    background: transparent;
    transition: 0.25s ease;
}

.table tbody tr:hover {
    background: rgba(10,132,255,0.08);
}

.table-striped tbody tr:nth-of-type(odd) {
    background: rgba(255,255,255,0.02);
}

/* ===== BUTTON ===== */
.btn-outline-light {
    border-color: var(--border-soft);
    color: var(--text-main);
    border-radius: 10px;
    padding: 6px 14px;
}

.btn-outline-light:hover {
    background: var(--accent);
    border-color: var(--accent);
    color: #ffffff;
}

/* ===== CHART AREA ===== */
.chart-container {
    height: 380px;
}

/* ===== SCROLLBAR ===== */
::-webkit-scrollbar {
    width: 8px;
}
::-webkit-scrollbar-track {
    background: var(--bg-main);
}
::-webkit-scrollbar-thumb {
    background: #2e2f35;
    border-radius: 4px;
}
::-webkit-scrollbar-thumb:hover {
    background: #3a3b42;
}
</style>
</head>

<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="admin_dashboard.php">Car Dealership</a>

        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="add_car.php">Add Car</a></li>
            <li class="nav-item"><a class="nav-link" href="add_service.php">Add Service</a></li>
            <li class="nav-item"><a class="nav-link" href="view_bookings.php">View Bookings</a></li>
        </ul>

        <span class="navbar-text text-light me-3">
            Admin: <?php echo $_SESSION['admin']; ?>
        </span>

        <a href="../logout.php" class="btn btn-outline-light btn-sm">
            Logout
        </a>
    </div>
</nav>

<div class="container mt-4">

<div class="row mb-4">

    <!-- TOTAL CARS -->
    <div class="col-md-4">
        <div class="card stat-card p-3">
            <div>Total Cars</div>
            <div class="stat-value"><?php echo $total_cars; ?></div>
        </div>
    </div>

    <!-- TOTAL BOOKINGS -->
    <div class="col-md-4">
        <div class="card stat-card p-3">
            <div>Total Bookings</div>
            <div class="stat-value"><?php echo $total_bookings; ?></div>
        </div>
    </div>

    <!-- TOTAL SERVICES -->
    <div class="col-md-4">
        <div class="card stat-card p-3">
            <div>Total Services</div>
            <div class="stat-value"><?php echo $total_services; ?></div>
        </div>
    </div>

</div>
<!-- CHARTS -->
<div class="row mb-5">
    <div class="col-md-8">
        <div class="card p-3">
            <h5>Car Prices</h5>
            <div class="chart-container">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3">
            <h5>Price Distribution</h5>
            <div class="chart-container">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- LATEST CARS -->
<div class="card p-3">
    <h5>Latest Added Cars</h5>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Car Name</th>
                <th>Price (₹)</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($latest_cars)) { ?>
            <tr>
                <td><?php echo $row['car_name']; ?></td>
                <td><?php echo number_format($row['price']); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</div>

<script>
const carNames = <?php echo json_encode($car_names); ?>;
const carPrices = <?php echo json_encode($car_prices); ?>;

/* BAR CHART */
new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: carNames,
        datasets: [{
            data: carPrices,
            backgroundColor: '#0d6efd'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

/* PIE CHART */
new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
        labels: ['Low', 'Medium', 'High'],
        datasets: [{
            data: [
                <?php echo $low_range; ?>,
                <?php echo $medium_range; ?>,
                <?php echo $high_range; ?>
            ],
            backgroundColor: ['#198754', '#ffc107', '#dc3545']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>

</body>
</html>
