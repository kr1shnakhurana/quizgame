<?php
// Start the session
session_start();

// Include the database connection file
include 'config.php';

// Function to generate a random unique ID
function generateUID($conn) {
    do {
        // Generate a random 36-character UID
        $uid = bin2hex(random_bytes(16));
        
        // Check if the UID already exists in the database
        $query = "SELECT uid FROM users WHERE uid = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $result = $stmt->get_result();

    } while ($result->num_rows > 0); // Regenerate UID if it already exists

    return $uid; // Return the unique UID
}

// Process registration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security

    // Generate a unique UID
    $uid = generateUID($conn);

    // Insert the user into the database
    $query = "INSERT INTO users (uid, name, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $uid, $name, $email, $password);

    if ($stmt->execute()) {
        // Store UID in the session
        $_SESSION['uid'] = $uid;

        // Redirect to the dashboard
        header("Location: ../dashboard.php");
        exit(); // Stop further script execution after redirect
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
