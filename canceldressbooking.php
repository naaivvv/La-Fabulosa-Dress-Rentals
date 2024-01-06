<?php
session_start();
require 'connection.php';
$conn = Connect();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $dress_id = $_GET['id'];

    // Fetch dress details before deletion
    $sql = "SELECT * FROM renteddresses WHERE dress_id = '$dress_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Check if the dress is already returned
        if ($row['return_status'] != 'Returned') {
            // Update dress_availability to 'yes' in dresses table
            $updateSql = "UPDATE dresses SET dress_availability = 'yes' WHERE dress_id = '$dress_id'";
            $updateResult = $conn->query($updateSql);

            if ($updateResult) {
                // Dress availability updated successfully
                // Now, delete the entry from renteddresses table
                $deleteSql = "DELETE FROM renteddresses WHERE dress_id = '$dress_id'";
                $deleteResult = $conn->query($deleteSql);

                if ($deleteResult) {
                    // Dress booking canceled successfully
                    $_SESSION['success'] = 'Dress booking canceled successfully.';
                } else {
                    // Error in cancellation
                    $_SESSION['error'] = 'Error canceling dress booking: ' . $conn->error;
                }
            } else {
                // Error in updating dress_availability
                $_SESSION['error'] = 'Error updating dress availability: ' . $conn->error;
            }
        } else {
            // Dress is already returned, cannot be canceled
            $_SESSION['error'] = 'Cannot cancel dress booking. Dress is already returned.';
        }
    } else {
        // Dress not found
        $_SESSION['error'] = 'Dress not found.';
    }
} else {
    // Invalid dress id
    $_SESSION['error'] = 'Invalid dress id.';
}

// Redirect back to mybookings.php
header("Location: mybookings.php");
exit();
?>
