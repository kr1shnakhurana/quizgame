<?php
// Start the session
session_start();

// Include the database connection file
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to fetch user data
    $query = "SELECT uid, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user data
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
        $uid = $row['uid'];

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Store UID in the session
            $_SESSION['uid'] = $uid;

            // Redirect to the dashboard
            header("Location: ../dashboard.php");
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
