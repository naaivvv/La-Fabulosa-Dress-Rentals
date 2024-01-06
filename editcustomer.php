<?php
include('session_customer.php');


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_username = mysqli_real_escape_string($conn, $_POST['customer_username']);
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $customer_phone = mysqli_real_escape_string($conn, $_POST['customer_phone']);
    $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
    $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);

    // Perform the update query
    $update_query = "UPDATE customers SET 
        customer_name = '$customer_name', 
        customer_phone = '$customer_phone', 
        customer_email = '$customer_email', 
        customer_address = '$customer_address', 
        customer_password = '$new_password' 
        WHERE customer_username = '$customer_username'";
    
    $update_result = $conn->query($update_query);

    if ($update_result) {
        // Update successful, redirect to customerprofile.php
        $_SESSION['manage_success'] = "Customer information updated successfully.";
        header("Location: customerprofile.php");
        exit();
    } else {
        // Update failed, stay on editcustomer.php
        $_SESSION['manage_fail'] = "Error updating customer information. Please try again.";
        header("Location: editcustomer.php");
        exit();
    }
}
?>
