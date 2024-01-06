<?php
include('session_client.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $dress_id = $_GET['id'];

    // Delete dress data based on dress_id
    $deleteQuery = "DELETE FROM dresses WHERE dress_id = $dress_id";
    $deleteResult = $conn->query($deleteQuery);

    if ($deleteResult) {
        $_SESSION['manage_success'] = "Dress deleted successfully.";
    } else {
        $_SESSION['manage_fail'] = "Error deleting dress. Please try again.";
    }
} else {
    $_SESSION['manage_fail'] = "Invalid dress ID. Please try again.";
}

header("Location: managedress.php");
exit();
?>
