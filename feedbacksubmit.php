<?php
require 'connection.php';
$conn = Connect();
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert into feedback table
    $insert_query = "INSERT INTO feedback (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    $insert_result = $conn->query($insert_query);

    if ($insert_result) {
        // Insert successful, set session confirmation
        $_SESSION['feedback_success'] = "Feedback submitted successfully!";
    } else {
        // Insert failed, set session confirmation
        $_SESSION['feedback_fail'] = "Error submitting feedback. Please try again.";
    }

    // Redirect back to index.php
    header("Location: index.php");
    exit();
} else {
    // If someone tries to access feedbacksubmit.php directly
    header("Location: index.php");
    exit();
}
?>
