<?php
session_start();
include 'config.php';

// Ensure user is logged in
if (!isset($_SESSION['uid'])) {
    header("Location: ../user_auth.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the form
    $quiz_name = $_POST['quiz_name'];
    $quiz_id = $_POST['quiz_id'];
    $uid = $_SESSION['uid']; // Logged-in user ID
    $questions = $_POST['questions']; // All questions and their data

    // Start database transaction
    $conn->begin_transaction();

    try {
        // Insert into quiz_table
        $quiz_query = "INSERT INTO quiz_table (quiz_id, quiz_name, created_by) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($quiz_query);
        $stmt->bind_param("sss", $quiz_id, $quiz_name, $uid);
        $stmt->execute();

        // Insert each question into the answer_table
        $answer_query = "INSERT INTO answer_table (quiz_id, question, option_1, option_2, option_3, option_4, correct_answer) 
                         VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($answer_query);

        foreach ($questions as $q) {
            $stmt->bind_param(
                "sssssss",
                $quiz_id,
                $q['question'],
                $q['options'][0],
                $q['options'][1],
                $q['options'][2],
                $q['options'][3],
                $q['correct']
            );
            $stmt->execute();
        }

        // Commit the transaction
        $conn->commit();

        // Redirect to dashboard with success message
        $_SESSION['success'] = "Quiz created successfully!";
        header("Location: dashboard.php");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction on error
        $conn->rollback();
        $_SESSION['error'] = "Error creating quiz: " . $e->getMessage();
        header("Location: ../create_quiz.php");
        exit();
    }
} else {
    // Redirect to create_quiz.php if not POST
    header("Location: create_quiz.php");
    exit();
}
?>
