<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Update as needed
$password = "root"; // Update as needed
$dbname = "quiz_platform";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$quiz_id = $_POST['quiz_id'];
$user_answers = $_POST['answers'];

// Fetch correct answers
$query = "SELECT * FROM answers WHERE quiz_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $quiz_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No answers found for this quiz.");
}
$correct_answers = $result->fetch_assoc();

// Calculate score
$score = 0;
foreach ($user_answers as $index => $user_answer) {
    $correct_answer = $correct_answers["answer_" . ($index + 1)];
    if (strcasecmp(trim($user_answer), trim($correct_answer)) === 0) { // Case-insensitive comparison
        $score++;
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
    </style>
</head>
<body>
    <div class="hero">
        <h1>Quiz Result</h1>
    </div>
<div class="container mt-5">
    <h2 class="mb-4">Quiz Results</h2>
    <p>Your Score: <?php echo $score; ?> out of <?php echo count($user_answers); ?></p>
    <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
</div>
</body>
</html>
