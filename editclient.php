<?php
include('session_client.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_username = mysqli_real_escape_string($conn, $_POST['client_username']);
    $client_name = mysqli_real_escape_string($conn, $_POST['client_name']);
    $client_phone = mysqli_real_escape_string($conn, $_POST['client_phone']);
    $client_email = mysqli_real_escape_string($conn, $_POST['client_email']);
    $client_address = mysqli_real_escape_string($conn, $_POST['client_address']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);

    // Perform the update query
    $update_query = "UPDATE clients SET 
        client_name = '$client_name', 
        client_phone = '$client_phone', 
        client_email = '$client_email', 
        client_address = '$client_address', 
        client_password = '$new_password' 
        WHERE client_username = '$client_username'";
    
    $update_result = $conn->query($update_query);

    if ($update_result) {
        // Update successful, redirect to clientprofile.php
        $_SESSION['manage_success'] = "Client information updated successfully.";
        header("Location: clientprofile.php");
        exit();
    } else {
        // Update failed, stay on editclient.php
        $_SESSION['manage_fail'] = "Error updating client information. Please try again.";
        header("Location: editclient.php");
        exit();
    }
}
?>
