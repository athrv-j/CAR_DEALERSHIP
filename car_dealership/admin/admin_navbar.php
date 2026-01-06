<?php
// This file is included in all admin pages
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand fw-bold" href="admin_dashboard.php">
            Car Dealership - Admin
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="admin_dashboard.php">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="add_car.php">
                        Add Car
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="add_service.php">
                        Add Service
                    </a>
                </li>
            </ul>

           

    </div>
</nav>
