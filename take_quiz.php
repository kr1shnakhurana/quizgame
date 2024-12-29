<?php
session_start();

// Ensure user is logged in
if (!isset($_SESSION['uid'])) {
    header("Location: user_auth.php");
    exit();
}

// Database Connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "root"; // Replace with your database password
$dbname = "quiz_platform"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch quizzes from the database
function getQuizzes($conn, $search = null) {
    $query = "SELECT quiz_id, quiz_title FROM quizzes";
    if ($search) {
        $query .= " WHERE quiz_id LIKE '%" . $conn->real_escape_string($search) . "%'";
    }
    $result = $conn->query($query);

    $quizzes = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $quizzes[] = $row;
        }
    }
    return $quizzes;
}

// Handle Search Query
$searchQuery = isset($_POST['search']) ? $_POST['search'] : null;
$quizzes = getQuizzes($conn, $searchQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Quizzes</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
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
            align-items: center;
            justify-content: center;
            display: flex;
            color: white;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.8);
        }
        .hero h1 {
            font-size: 70px;
            font-weight: 40px;
        }
        .search {
            margin-top: 10vh;
            height: 70px;
            background-color: #fff;
            border-radius: 40px;
            padding: 10px;
        }
        .search_input {
            width: calc(100% - 100px);
            padding: 10px;
            border: none;
            outline: none;
            font-size: 16px;
        }
        .search_icon {
            width: 80px;
            height: 40px;
            text-align: center;
            line-height: 40px;
            background-color: #000;
            color: #FFC107;
            border: none;
            cursor: pointer;
        }
        a:link {
            text-decoration: none;
        }
        .quiz-card {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="hero">
       <center> <h1>Available Quizzes</h1></center>
    </div>
    <div class="container">
       
        <!-- Quizzes List -->
        <div class="mt-4" id="quizList">
            <?php if (empty($quizzes)): ?>
                <p class="text-center">No quizzes available.</p>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($quizzes as $quiz): ?>
                        <div class="col-md-4">
                            <div class="card quiz-card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($quiz['quiz_title']); ?></h5>
                                    <p class="card-text"><strong>Quiz ID:</strong> <?php echo htmlspecialchars($quiz['quiz_id']); ?></p>
                                    <a href="start_quiz.php?quiz_id=<?php echo $quiz['quiz_id']; ?>" class="btn btn-primary">Start Quiz</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
