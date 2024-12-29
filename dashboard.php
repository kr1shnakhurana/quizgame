<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['uid'])) {
    header("Location: user_auth.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .hero {
            background-image: url('assets/css/images/dashboard-bg.webp');
            background-size: cover;
            background-position: center;
            height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.8);
        }
        
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .dashboard-options {
            display: flex;
            justify-content: center;
            margin-top: -50px;
        }
        .btn{
            border-radius:20px;
        }
        /* Transparent Navbar */
.transparent-navbar {
    background: transparent !important;
    transition: background 0.3s ease-in-out;
    z-index: 10;
}

.transparent-navbar.sticky-top.scrolled {
    background: rgba(0, 0, 0, 0.8); /* Adds a slight background when scrolling */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Navbar Links Styling */
.transparent-navbar .nav-link {
    font-size: 1rem;
    transition: color 0.3s ease-in-out;
}

.transparent-navbar .nav-link:hover {
    color: #f9c74f; /* Highlight color for links */
}
.btn:hover{
    background-color: transparent;
    border-color:#FFC107;

}
        .option-card {
            width: 300px;
            margin: 10px;
            padding: 20px;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background: white;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .option-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }
        .option-card i {
            font-size: 50px;
            color: #007bff;
            margin-bottom: 15px;
        }
        .option-card a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .option-card a:hover {
            text-decoration: underline;
        }
        
/* Features Section */
#features .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
#features .card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

/* Footer */
footer {
    background-color: #343a40;
    color: #ddd;
}

/* Animations */
.animate__fadeInDown, 
.animate__fadeInUp, 
.animate__zoomIn {
    animation-duration: 1s;
    animation-fill-mode: both;
}
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg transparent-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
            <i class="bi bi-lightbulb-fill text-warning me-2"></i> QuizMaker
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
            </ul>
           <center><a href="user_auth.php" class="btn btn-warning ms-3 rounded-pill">Log-out</a></center>
        </div>
    </div>
</nav>

    <!-- Hero Section -->
    <div class="hero">
        <h1>Welcome to Your Quiz Dashboard</h1>
    </div>

    <!-- Dashboard Options -->
    <div class="container">
        <div class="dashboard-options">
            <!-- Create Quiz -->
            <div class="option-card">
                <i class="bi bi-pencil-square"></i>
                <h3>Create Quiz</h3>
                <p>Create engaging quizzes to challenge your knowledge.</p>
                <a href="create_quiz.php"><button class="btn btn-warning">Create Quiz</button></a>
            </div>

            <!-- Take Quiz -->
            <div class="option-card">
                <i class="bi bi-check-circle"></i>
                <h3>Take Quiz</h3>
                <p>Browse and take quizzes to test your skills.</p>
                <a href="take_quiz.php"><button class="btn btn-warning" >Take Quiz</button></a>
            </div>
        </div>
    </div>
     <!-- Features Section -->
     <section id="features" class="py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Why Choose QuizMaker?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-lg h-100">
                        <div class="card-body">
                            <i class="bi bi-layout-text-sidebar-reverse display-4 text-primary"></i>
                            <h4 class="mt-3">Easy Quiz Creation</h4>
                            <p>Create quizzes with just a few clicks using our intuitive interface.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-lg h-100">
                        <div class="card-body">
                            <i class="bi bi-people-fill display-4 text-success"></i>
                            <h4 class="mt-3">Engage Learners</h4>
                            <p>Interactive quizzes to test knowledge and improve skills.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-lg h-100">
                        <div class="card-body">
                            <i class="bi bi-bar-chart-line-fill display-4 text-warning"></i>
                            <h4 class="mt-3">Instant Feedback</h4>
                            <p>Get detailed results and feedback immediately after quizzes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    <!-- Contact Section -->
    <footer id="contact" class="bg-dark text-white py-4">
        <div class="container text-center">
            <h4>Contact Us</h4>
            <p>Email: support@quizmaker.com | Phone: +1 234 567 890</p>
            <p>&copy; 2024 QuizMaker. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>


    <!-- Bootstrap Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
