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

// Get quiz_id from URL
if (!isset($_GET['quiz_id'])) {
    die("Quiz ID not provided. Please go back and select a quiz.");
}
$quiz_id = $_GET['quiz_id'];

// Fetch quiz questions dynamically
$query = "SELECT * FROM quizzes WHERE quiz_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $quiz_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Quiz not found.");
}
$quiz = $result->fetch_assoc();

// Extract questions dynamically
$questions = [];
for ($i = 1; $i <= 10; $i++) {
    if (!empty($quiz["question_$i"])) {
        $questions[] = $quiz["question_$i"];
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
    <title>Start Quiz</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Solve Quiz</h2>
    <form action="result.php" method="POST">
        <?php foreach ($questions as $index => $question): ?>
            <div class="mb-3">
                <label for="answer_<?php echo $index; ?>" class="form-label">
                    <?php echo ($index + 1) . ". " . htmlspecialchars($question); ?>
                </label>
                <input type="text" class="form-control" name="answers[<?php echo $index; ?>]" id="answer_<?php echo $index; ?>" placeholder="Type your answer here" required>
            </div>
        <?php endforeach; ?>
        <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
        <button type="submit" class="btn btn-primary">Submit Quiz</button>
    </form>
</div>
</body>
</html>
