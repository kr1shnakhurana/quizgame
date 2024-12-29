<?php
include 'config.php';

header('Content-Type: application/json');

$query = "SELECT quiz_id, quiz_name FROM quizzes";
$result = $conn->query($query);

if (!$result) {
    echo json_encode(['status' => 'error', 'message' => $conn->error]);
    exit;
}

$quizzes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $quizzes[] = $row;
    }
}

echo json_encode($quizzes);
?>
