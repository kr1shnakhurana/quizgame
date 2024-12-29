<?php
session_start();
include __DIR__ . '/config/config.php';

// Ensure user is logged in
if (!isset($_SESSION['uid'])) {
    header("Location: user_auth.php");
    exit();
}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $uid = $_SESSION['uid'];
        $action = $_POST['action'] ?? '';

        if ($action === 'create_quiz') {
            // Quiz Creation Logic
            $quiz_title = htmlspecialchars($_POST['quiz_name']);
            $quiz_id = htmlspecialchars($_POST['quiz_id']);
            $questions = $_POST['questions'] ?? [];

            // Validate input
            if (empty($quiz_title) || empty($quiz_id) || empty($questions)) {
                throw new Exception('Quiz ID, title, and questions are required.');
            }

            // Prepare query
            $query = "
                INSERT INTO quizzes 
                (uid, quiz_id, quiz_title, question_1, question_2, question_3, question_4, question_5, question_6, question_7, question_8, question_9, question_10) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);

            // Fill questions up to 10
            $quizData = array_fill(0, 10, null);
            foreach ($questions as $index => $q) {
                $quizData[$index] = htmlspecialchars($q['question']);
            }

            $quizParams = array_merge([$uid, $quiz_id, $quiz_title], $quizData);
            if ($stmt->execute($quizParams)) {
                echo "Quiz created successfully!";
            } else {
                throw new Exception('Failed to create quiz.');
            }
        } elseif ($action === 'submit_answers') {
            // Answer Submission Logic
            $quiz_id = htmlspecialchars($_POST['quiz_id']);
            $answers = $_POST['answers'] ?? [];

            // Validate input
            if (empty($quiz_id) || empty($answers)) {
                throw new Exception('Quiz ID and answers are required.');
            }

            // Prepare query
            $query = "
                INSERT INTO answers 
                (uid, quiz_id, answer_1, answer_2, answer_3, answer_4, answer_5, answer_6, answer_7, answer_8, answer_9, answer_10) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);

            // Fill answers up to 10
            $answerData = array_fill(0, 10, null);
            foreach ($answers as $index => $ans) {
                $answerData[$index] = htmlspecialchars($ans);
            }

            $answerParams = array_merge([$uid, $quiz_id], $answerData);
            if ($stmt->execute($answerParams)) {
                echo "Answers submitted successfully!";
            } else {
                throw new Exception('Failed to submit answers.');
            }
        }
        exit();
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .hero quiz-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-secondary, .btn-primary {
            margin-top: 10px;
        }
        
    </style>
</head>
<body>
<div class="container">
    <div class=" hero">
        <div class="quiz-header">
        <h1>Create or Submit a Quiz</h1>
    </div>
    </div>


    <!-- Quiz Creation Form -->
    <form id="quizForm" method="POST">
        <input type="hidden" name="action" value="create_quiz">

        <div class="form-group">
            <label for="quizId">Quiz ID</label>
            <input type="text" name="quiz_id" id="quizId" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="quizName">Quiz Name</label>
            <input type="text" name="quiz_name" id="quizName" class="form-control" required>
        </div>

        <div id="questionsContainer">
            <!-- Question 1 -->
            <div class="question">
                <label>Question 1</label>
                <input type="text" name="questions[0][question]" class="form-control" required>
            </div>
        </div>

        <button type="button" id="addQuestion" class="btn btn-secondary">Add Question</button>
        <button type="submit" class="btn btn-primary">Submit Quiz</button>
    </form>

    <hr>

    <!-- Answer Submission Form -->
    <form id="answerForm" method="POST">
        <input type="hidden" name="action" value="submit_answers">
        <div class="form-group">
            <label for="quizIdAnswer">Quiz ID</label>
            <input type="text" name="quiz_id" id="quizIdAnswer" class="form-control" required>
        </div>

        <div id="answersContainer">
            <!-- Answer 1 -->
            <div class="form-group">
                <label>Answer 1</label>
                <input type="text" name="answers[0]" class="form-control" required>
            </div>
        </div>

        <button type="button" id="addAnswer" class="btn btn-secondary">Add Answer</button>
        <button type="submit" class="btn btn-primary">Submit Answers</button>
    </form>
</div>

<script>
    // Add questions dynamically
    let questionCount = 1;
    document.getElementById('addQuestion').addEventListener('click', () => {
        if (questionCount >= 10) {
            alert('Maximum 10 questions allowed.');
            return;
        }

        const questionTemplate = `
            <div class="question">
                <label>Question ${questionCount + 1}</label>
                <input type="text" name="questions[${questionCount}][question]" class="form-control" required>
            </div>`;
        document.getElementById('questionsContainer').insertAdjacentHTML('beforeend', questionTemplate);
        questionCount++;
    });

    // Add answers dynamically
    let answerCount = 1;
    document.getElementById('addAnswer').addEventListener('click', () => {
        if (answerCount >= 10) {
            alert('Maximum 10 answers allowed.');
            return;
        }

        const answerTemplate = `
            <div class="form-group">
                <label>Answer ${answerCount + 1}</label>
                <input type="text" name="answers[${answerCount}]" class="form-control" required>
            </div>`;
        document.getElementById('answersContainer').insertAdjacentHTML('beforeend', answerTemplate);
        answerCount++;
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
