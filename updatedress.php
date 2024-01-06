<?php
include('session_client.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve data from the form
    $dress_id = $_POST['dress_id'];
    $dress_name = $_POST['dress_name'];
    $dress_type = $_POST['dress_type'];
    $dress_color = $_POST['dress_color'];
    $dress_size = $_POST['dress_size'];
    $dress_price = $_POST['dress_price'];
    $dress_price_per_day = $_POST['dress_price_per_day'];
    $dress_price_per_rent = $_POST['dress_price_per_rent'];
    $dress_availability = $_POST['dress_availability'];

    // File upload handling (similar to the add dress code)
    if (!empty($_FILES["uploadedimage"]["name"])) {
        $file_name = $_FILES["uploadedimage"]["name"];
        $temp_name = $_FILES["uploadedimage"]["tmp_name"];
        $imgtype = $_FILES["uploadedimage"]["type"];
        $ext = GetImageExtension($imgtype);
        $imagename = $_FILES["uploadedimage"]["name"];
        $target_path = "assets/img/dresses/" . $imagename;

        if (move_uploaded_file($temp_name, $target_path)) {
            // Update dress details including image path
            $sql = "UPDATE dresses SET 
                    dress_name = '$dress_name',
                    dress_type = '$dress_type',
                    dress_color = '$dress_color',
                    dress_size = '$dress_size',
                    dress_price = '$dress_price',
                    dress_price_per_day = '$dress_price_per_day',
                    dress_price_per_rent = '$dress_price_per_rent',
                    dress_availability = '$dress_availability',
                    dress_img = '$target_path'
                    WHERE dress_id = $dress_id";

            if ($conn->query($sql) === TRUE) {
                // Dress details updated successfully
                header("Location: managedress.php");
                exit();
            } else {
                // Error updating dress details
                echo "Error: " . $conn->error;
            }
        }
    } else {
        // If no new image is uploaded, update dress details without modifying the image
        $sql = "UPDATE dresses SET 
                dress_name = '$dress_name',
                dress_type = '$dress_type',
                dress_color = '$dress_color',
                dress_size = '$dress_size',
                dress_price = '$dress_price',
                dress_price_per_day = '$dress_price_per_day',
                dress_price_per_rent = '$dress_price_per_rent',
                dress_availability = '$dress_availability'
                WHERE dress_id = $dress_id";

        if ($conn->query($sql) === TRUE) {
            // Dress details updated successfully
            $_SESSION['manage_success'] = "Dress details updated successfully.";
            header("Location: managedress.php");
            exit();
        } else {
            // Error updating dress details
            $_SESSION['manage_fail'] = "Error updating dress details: " . $conn->error;
            header("Location: managedress.php");
            exit();
        }
    }
}

// If not a POST request or no 'submit' parameter, redirect to managedress.php
header("Location: managedress.php");
exit();

function GetImageExtension($imagetype) {
    if(empty($imagetype)) return false;
    switch($imagetype) {
        case 'image/bmp': return '.bmp';
        case 'image/gif': return '.gif';
        case 'image/jpeg': return '.jpg';
        case 'image/png': return '.png';
        default: return false;
    }
}
?>
