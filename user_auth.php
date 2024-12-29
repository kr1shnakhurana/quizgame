







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/userauth.css">
    
</head>
<body>
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <div class="form-container">
            
            <!-- Login Form -->
            <div class="form-box login-box">
                <div class="image-box">
                    <img src="assets/css/images/login.jpg" alt="Login Image">
                </div>
                <div class="form-content">
                    <h2 class="text-center">Login</h2>
                    <form action="config/login.php" method="POST">
                        <div class="mb-3">
                            <label for="login-email" class="form-label">Email</label>
                            <input type="email" name="email" id="login-email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="login-password" class="form-label">Password</label>
                            <input type="password" name="password" id="login-password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Login</button>
                        <p class="text-center mt-3">
                            No account? <a href="#" id="switch-to-register">Register here</a>
                        </p>
                    </form>
                </div>
            </div>

            <!-- Register Form -->
            <div class="form-box register-box">
                <div class="form-content">
                    <h2 class="text-center">Register</h2>
                    <form action="config/register.php" method="POST">
                        <div class="mb-3">
                            <label for="register-name" class="form-label">Name</label>
                            <input type="text" name="name" id="register-name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="register-email" class="form-label">Email</label>
                            <input type="email" name="email" id="register-email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="register-password" class="form-label">Password</label>
                            <input type="password" name="password" id="register-password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Register</button>
                        <p class="text-center mt-3">
                            Already have an account? <a href="#" id="switch-to-login">Login here</a>
                        </p>
                    </form>
                </div>
                <div class="image-box">
                    <img src="assets/css/images/R.png" style="height:100%; width:70%;"alt="Register Image">
                </div>
            </div>
        </div>
    </div>
</body>
<script src="assets/js/userauth.js"></script>
</html>
