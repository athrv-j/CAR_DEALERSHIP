<?php
include("../includes/db.php");

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (name, email, password)
              VALUES ('$name', '$email', '$password')";

    mysqli_query($conn, $query);
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
            background-color: #090916; /* near-black shade */
            color: #ffffff;
        }

        .card h3 {
            margin-bottom: 1.5rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(118, 75, 162, 0.25);
            border-color: #764ba2;
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
                <h3 class="text-center mb-4">Customer Registration</h3>

                <form method="POST">
                    <input type="text" id="name" name="name" class="form-control mb-3" placeholder="Full Name" required>
                    <input type="email" id="email" name="email" class="form-control mb-3" placeholder="Email Address" required>
                    <input type="password" id="password" name="password" class="form-control mb-4" placeholder="Password" required>

                    <button name="register" class="btn btn-custom w-100 py-2 mb-3" onclick="showRegistrationSuccess()">
                        Register
                    </button>
                </form> 
            </div>  
        </div>
    </div>
</div>



<script>
  function showRegistrationSuccess() {
    let a = document.getElementById('name').value;
    let b = document.getElementById('email').value; 
    let c = document.getElementById('password').value;

    if ( a=="" || b=="" || c=="") {
      alert('Please fill in all fields.');
      return false;
        
    }
    // event.preventDefault();
   else {
      alert('Registration Successful!');
  }
  }
  
</script>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>