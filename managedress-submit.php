<html>

<head>
    <title> Dress Rental Submission | La Fabulosa Dress Rentals </title>
</head>
<?php session_start(); ?>
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">

<link rel="stylesheet" href="assets/w3css/w3.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">
                    La Fabulosa Dress Rentals </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
            if (isset($_SESSION['login_client'])) {
            ?>
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="clientprofile.php"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_client']; ?></a>
                        </li>
                        <li>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Control Panel <span class="caret"></span> </a>
                                    <ul class="dropdown-menu">
                                        <li> <a href="enterdress.php">Add Dress</a></li>
                                        <li> <a href="managedress.php">Manage Dress</a></li>
                                        <li> <a href="prereturndress.php">Confirm Returning Dress</a></li>
                                        <li> <a href="pendingrentals.php">Pending Rentals</a></li>
                                        <li> <a href="clientview.php">View</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                        </li>
                    </ul>
                </div>

            <?php
            } else if (isset($_SESSION['login_customer'])) {
            ?>
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="customerprofile.php"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_customer']; ?></a>
                        </li>
                        <li>
                            <a href="#">History</a>
                        </li>
                        <li>
                            <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                        </li>
                    </ul>
                </div>

            <?php
            } else {
            ?>

                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="clientlogin.php">Employee</a>
                        </li>
                        <li>
                            <a href="customerlogin.php">Customer</a>
                        </li>
                        <li>
                        <a href="faq/index.php"> FAQ </a>
                        </li>
                    </ul>
                </div>
            <?php   }
            ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <?php

    require 'connection.php';
    $conn = Connect();

    function GetImageExtension($imagetype)
    {
        if (empty($imagetype)) return false;

        switch ($imagetype) {
            case 'image/bmp':
                return '.bmp';
            case 'image/gif':
                return '.gif';
            case 'image/jpeg':
                return '.jpg';
            case 'image/png':
                return '.png';
            default:
                return false;
        }
    }

    $dress_name = $conn->real_escape_string($_POST['dress_name']);
    $dress_type = $conn->real_escape_string($_POST['dress_type']);
    $dress_color = $conn->real_escape_string($_POST['dress_color']);
    $dress_size = $conn->real_escape_string($_POST['dress_size']);
    $dress_price = $conn->real_escape_string($_POST['dress_price']);
    $dress_availability = "yes";

    if (!empty($_FILES["uploadedimage"]["name"])) {
        $file_name = $_FILES["uploadedimage"]["name"];
        $temp_name = $_FILES["uploadedimage"]["tmp_name"];
        $imgtype = $_FILES["uploadedimage"]["type"];
        $ext = GetImageExtension($imgtype);
        $imagename = $_FILES["uploadedimage"]["name"];
        $target_path = "assets/img/dresses/" . $imagename;

        if (move_uploaded_file($temp_name, $target_path)) {
            $query = "INSERT into dresses(dress_name, dress_type, dress_color, dress_size, dress_price, dress_img, dress_availability) VALUES('" . $dress_name . "','" . $dress_type . "','" . $dress_color . "','" . $dress_size . "','" . $dress_price . "','" . $target_path . "','" . $dress_availability . "')";
            $success = $conn->query($query);
        }
    }

    if (!$success) { ?>
        <div class="container">
            <div class="jumbotron" style="text-align: center;">
                Dress with the same details already exists!
                <?php echo $conn->error; ?>
                <br><br>
                <a href="enterdress.php" class="btn btn-default"> Go Back </a>
            </div>
        <?php
    } else {
        header("location: enterdress.php"); // Redirecting
    }

    $conn->close();

        ?>

        </body>
        <footer class="site-footer">
    <div class="container d-flex justify-content-center align-items-center flex-column">
        <hr>
        <div class="row">
            <div class="col-md-12 text-center">
                <p>&copy; <?php echo date("Y"); ?> La Fabulosa Dress Rentals</p>
                <p>Address: Your Address, City, Country</p>
                <p>Email: info@lafabulosadressrentals.com</p>
                <p>Phone: +1 (123) 456-7890</p>
            </div>
        </div>
    </div>
</footer>

</html>
