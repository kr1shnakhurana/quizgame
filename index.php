<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Maker - Landing Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <!-- Navbar -->
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
                <li class="nav-item"><a class="nav-link" href="#create-take">Get Started</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
            </ul>
           <center><a href="user_auth.php" class="btn btn-warning ms-3 rounded-pill">Login</a></center>
        </div>
    </div>
</nav>
    <!-- Hero Section -->
    <header class="hero-section d-flex align-items-center">
        <div class="container text-center text-white">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">Create, Take, and Share Quizzes</h1>
            <p class="lead animate__animated animate__fadeInUp animate__delay-1s">
                The ultimate platform for learning and fun. Whether you're a teacher, student, or enthusiast, QuizMaker has you covered.
            </p>
            <a href="create_quiz.php" class="btn btn-warning btn-lg me-3 shadow-lg animate__animated animate__zoomIn"><i class="bi bi-pencil-square"></i> Create Quiz</a>
            <a href="take_quiz.php" class="btn btn-success btn-lg shadow-lg animate__animated animate__zoomIn animate__delay-1s"><i class="bi bi-question-circle"></i> Take Quiz</a>
        </div>
    </header>

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

    <!-- Get Started Section -->
    <section id="create-take" class="bg-light py-5">
        <div class="container text-center">
            <h2 class="fw-bold">Get Started in Minutes</h2>
            <div class="row mt-4">
                <div class="col-md-6">
                    <h3>Create Quizzes</h3>
                    <p>Sign up and start creating quizzes for any topic in minutes.</p>
                    <a href="create_quiz.php" class="btn btn-primary"><i class="bi bi-pencil"></i> Create Now</a>
                </div>
                <div class="col-md-6">
                    <h3>Take Quizzes</h3>
                    <p>Explore a wide range of quizzes and test your knowledge.</p>
                    <a href="quiz_list.php" class="btn btn-success"><i class="bi bi-play-circle"></i> Start Quiz</a>
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
