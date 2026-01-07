<?php
session_start();
include("../includes/db.php");

/* SAFETY CHECK */
if (!isset($_SESSION['user'])) {
    die("User session missing");
}

if (!isset($_SESSION['car_id'])) {
    die("Car ID not received in payment");
}

$car_id = $_SESSION['car_id'];

/* FETCH CAR DETAILS */
$query = "SELECT car_name, price, fuel_type, transmission FROM cars WHERE id = $car_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    die("Car not found");
}

$car = mysqli_fetch_assoc($result);
$price = (int)$car['price'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Payment | Car Dealership</title>
<meta charset="UTF-8">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

[09:23, 07/01/2026] Ninad Anwane:   <style>
        body {
    background-color: #0a0a0a;
    color: #e6e6e6;
    font-family: "Segoe UI", Arial, sans-serif;
    padding: 30px;
}

h1, h2, h3 {
    color: #ffffff;
    letter-spacing: 1px;
    text-transform: uppercase;
}

hr {
    border: 0;
    height: 1px;
    background: linear-gradient(to right, transparent, cyan, transparent);
    margin: 30px 0;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #111;
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.05);
}

th, td {
    border: 1px solid #2a2a…
[13:48, 07/01/2026] Ninad Anwane: <!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment | Car Dealership</title>
    <meta charset="UTF-8">

    <style>
/* ==== SAME CSS YOU PROVIDED — UNCHANGED ==== */
body {
    background-color: #0a0a0a;
    color: #e6e6e6;
    font-family: "Segoe UI", Arial, sans-serif;
    padding: 30px;
}

h1, h2, h3 {
    color: #ffffff;
    letter-spacing: 1px;
    text-transform: uppercase;
}

hr {
    border: 0;
    height: 1px;
    background: linear-gradient(to right, transparent, cyan, transparent);
    margin: 30px 0;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #111;
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.05);
}

th, td {
    border: 1px solid #2a2a2a;
    padding: 12px;
}

th {
    background-color: #000;
    color: #ffffff;
    text-transform: uppercase;
    font-size: 0.9rem;
    letter-spacing: 1px;
}

td {
    color: #d0d0d0;
}

label {
    color: #bfbfbf;
}

input {
    width: 100%;
    background-color: #000;
    color: #ffffff;
    border: 1px solid #333;
    padding: 10px;
}

input[type="radio"] {
    width: auto;
    margin-right: 6px;
}

input:focus {
    border-color: #ffffff;
    box-shadow: 0 0 8px rgba(255, 255, 255, 0.3);
}

input[type="button"] {
    background-color: #000;
    color: #ffffff;
    border: 1px solid #ffffff;
    padding: 14px;
    cursor: pointer;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: 0.3s;
}

input[type="button"]:hover {
    background-color: #ffffff;
    color: #000;
    box-shadow: 0 0 20px rgb(0, 213, 241);
}

.payment-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-top: 30px;
}

.card-details,
.price-summary {
    border: 1px solid #2a2a2a;
    padding: 20px;
    background: linear-gradient(145deg, #0b0b0b, #000);
}

.checkout-container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 40px;
    background: radial-gradient(circle at top, #111, #000);
    border: 1px solid #2a2a2a;
}
    </style></head>

<body>

<div class="checkout-container container my-5">

<h1>Checkout & Payment</h1>
<hr>

<!-- ORDER SUMMARY -->
<h2>Order Summary</h2>

<table class="table table-dark table-bordered">
<tr>
    <th>Car Model</th>
    <td><?php echo $car['car_name']; ?></td>
</tr>
<tr>
    <th>Fuel Type</th>
    <td><?php echo $car['fuel_type']; ?></td>
</tr>
<tr>
    <th>Transmission</th>
    <td><?php echo $car['transmission']; ?></td>
</tr>
<tr>
    <th>Base Price</th>
    <td>₹<?php echo number_format($price); ?></td>
</tr>
</table>

<hr>

<!-- PAYMENT METHOD -->
<h2>Payment Method</h2>

<div class="mb-4">
        <input type="radio" name="payment_method" checked>
        Credit / Debit Card
    <br>
        <input type="radio" name="payment_method">
        UPI
    <br>
        <input type="radio" name="payment_method">
        Net Banking
    <br>
        <input type="radio" name="payment_method">
        EMI
    <br>
</div>
<div class="row">

<!-- CARD DETAILS -->
<div class="col-md-6">
    <h3>Card Details</h3>
    <input class="form-control mb-3" placeholder="Card Number">
    <input class="form-control mb-3" placeholder="Card Holder Name">
    <input class="form-control mb-3" type="month">
    <input class="form-control mb-3" placeholder="CVV">
</div>

<!-- PRICE BREAKDOWN -->
<div class="col-md-6">
    <h3>Price Breakdown</h3>

    <table class="table table-dark table-bordered">
        <tr>
            <td>Base Price</td>
            <td id="basePrice">₹<?php echo number_format($price); ?></td>
        </tr>
        <tr>
            <td>GST (18%)</td>
            <td id="taxAmount"></td>
        </tr>
        <tr class="font-weight-bold">
            <td>Total Payable</td>
            <td id="finalAmount"></td>
        </tr>
    </table>
</div>

</div>

<hr>

<!-- CONFIRM -->
<h2>Confirm Payment</h2>
<p>This is a demo payment gateway.</p>

<a href="payment_success.php"
   class="btn btn-outline-light btn-lg btn-block">
   Pay Now
</a>

</div>

<script>
function calculateTotal() {
    var basePrice = <?php echo $price; ?>;
    var tax = basePrice * 0.18;
    var total = basePrice + tax;

    document.getElementById("taxAmount").innerText =
        "₹" + tax.toLocaleString("en-IN");

    document.getElementById("finalAmount").innerText =
        "₹" + total.toLocaleString("en-IN");
}
calculateTotal();
</script>

</body>
</html>
