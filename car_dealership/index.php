<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Dealership</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .btn-custom {
            background-color: rgb(120, 120, 120);
            border-color: rgb(120, 120, 120);
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: rgb(90, 90, 90);
            border-color: rgb(90, 90, 90);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(120, 120, 120, 0.4);
        }
        .hero-card {
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
            border: 1px solid rgb(120, 120, 120);
            border-radius: 15px;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
        }
        .hero-card h1 {
            font-size: 2.5rem;
            letter-spacing: -0.5px;
            margin-bottom: 1rem;
        }
        .feature-card {
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
            border: 1px solid rgb(120, 120, 120);
            border-radius: 12px;
            transition: all 0.3s ease;
            height: 100%;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            border-color: rgb(145, 145, 145);
            box-shadow: 0 10px 25px rgba(120, 120, 120, 0.3);
        }
        .action-card {
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
            border: 1px solid rgb(120, 120, 120);
            border-radius: 12px;
            padding: 2rem;
            transition: all 0.3s ease;
        }
        .action-card:hover {
            border-color: rgb(145, 145, 145);
            box-shadow: 0 10px 25px rgba(120, 120, 120, 0.3);
        }
        .section-title {
            font-size: 2rem;
            margin: 3rem 0 2rem 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            display: inline-block;
            width: 100%;
            text-align: center;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: rgb(120, 120, 120);
            border-radius: 2px;
        }
        .container {
            max-width: 1200px;
        }
        h5 {
            font-size: 1.2rem;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body class="text-white">

<!-- HOME CONTENT -->
<div class="container mt-5 mb-5">
    <!-- Hero Card -->
    <div class="hero-card shadow-lg">
        <h1 class="fw-bold text-center">Welcome to Car Dealership</h1>
        <p class="text-center text-secondary fs-5 mt-3">
            Discover premium cars, trusted service, and unbeatable deals — all in one place.
        </p>
    </div>

    <!-- Main Action Cards -->
    <div class="row mb-5 g-4">
        <div class="col-md-6 mb-3">
            <div class="action-card shadow">
                <div class="card-body text-center">
                    <i class="fas fa-user-plus fs-3 mb-3" style="color: rgb(120, 120, 120);"></i>
                    <h5 class="card-title fw-bold text-white mb-2">New Customer?</h5>
                    <p class="card-text text-secondary mb-3">Create an account to explore our wide range of cars and manage your bookings.</p>
                    <a href="customer/register.php" class="btn btn-custom w-100 py-2">Register Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="action-card shadow">
                <div class="card-body text-center">
                    <i class="fas fa-sign-in-alt fs-3 mb-3" style="color: rgb(120, 120, 120);"></i>
                    <h5 class="card-title fw-bold text-white mb-2">Existing Customer?</h5>
                    <p class="card-text text-secondary mb-3">Log in to your account and explore our collection of premium vehicles.</p>
                    <a href="customer/login.php" class="btn btn-custom w-100 py-2">Login</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-5 g-4">
        <div class="col-md-6 mb-3">
            <a href="customer/cars.php" class="btn btn-custom btn-lg w-100 py-3 shadow d-flex align-items-center justify-content-center">
                <i class="fas fa-car me-2"></i> Browse All Cars
            </a>
        </div>
        <div class="col-md-6 mb-3">
            <a href="admin/admin_login.php" class="btn btn-custom btn-lg w-100 py-3 shadow d-flex align-items-center justify-content-center">
                <i class="fas fa-cog me-2"></i> Admin Login
            </a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="section-title">Why Choose Us?</div>
    
    <div class="row text-center g-4 mt-4">
        <div class="col-md-4 mb-4">
            <div class="feature-card shadow">
                <div class="card-body">
                    <i class="fas fa-star fs-2 mb-3" style="color: rgb(120, 120, 120);"></i>
                    <h5 class="card-title fw-bold text-white mb-3">Wide Range</h5>
                    <p class="card-text text-secondary">
                        Choose from luxury, sports, and family cars from top brands.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="feature-card shadow">
                <div class="card-body">
                    <i class="fas fa-dollar-sign fs-2 mb-3" style="color: rgb(120, 120, 120);"></i>
                    <h5 class="card-title fw-bold text-white mb-3">Best Prices</h5>
                    <p class="card-text text-secondary">
                        Competitive pricing with exciting offers and discounts.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="feature-card shadow">
                <div class="card-body">
                    <i class="fas fa-headset fs-2 mb-3" style="color: rgb(120, 120, 120);"></i>
                    <h5 class="card-title fw-bold text-white mb-3">Trusted Service</h5>
                    <p class="card-text text-secondary">
                        Professional support and excellent customer service.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

</body>
</html>