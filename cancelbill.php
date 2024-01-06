<!DOCTYPE html>
<html>
<?php 
session_start();
require 'connection.php';
$conn = Connect();
?>
<head>
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
<link rel="stylesheet" href="assets/w3css/w3.css">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/bookingconfirm.css" />
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
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
                if(isset($_SESSION['login_client'])){
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
                }
                else if (isset($_SESSION['login_customer'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="customerprofile.php"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Rentals <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="mybookings.php"> My Bookings</a></li>
            </ul>
            </li>
          </ul>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>

            <?php
            }
                else {
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
    <body>

   
    <?php
        $id = $_GET["id"];
        $dress_price = $conn->real_escape_string($_POST['hid_dress_price']);
        $dress_return_date = date('Y-m-d');
        $return_status = "R";
        $login_customer = $_SESSION['login_customer'];

        $sql0 = "SELECT rd.id, rd.rent_end_date, rd.charge_type, rd.rent_start_date, d.dress_name, rd.no_of_days
                FROM renteddresses rd, dresses d
                WHERE id = '$id' AND d.dress_id = rd.dress_id";
        $result0 = $conn->query($sql0);

        if (mysqli_num_rows($result0) > 0) {
            while ($row0 = mysqli_fetch_assoc($result0)) {
                $rent_end_date = $row0["rent_end_date"];
                $rent_start_date = $row0["rent_start_date"];
                $dress_name = $row0["dress_name"];
                $charge_type = $row0["charge_type"];
                $no_of_days = $row0["no_of_days"];
            }
        }
        $total_amount = $no_of_days * $dress_price;

        function dateDiff($start, $end)
        {
            $start_ts = strtotime($start);
            $end_ts = strtotime($end);
            $diff = $end_ts - $start_ts;
            return round($diff / 86400);
        }

        $extra_days = dateDiff("$rent_end_date", "$dress_return_date");
        $total_fine = $extra_days * 200;

        $duration = dateDiff("$rent_start_date", "$rent_end_date");

        if ($extra_days > 0) {
            $total_amount = $total_amount + $total_fine;
        }

        if ($charge_type == "days") {
            $sql1 = "UPDATE renteddresses SET dress_return_date='$dress_return_date', no_of_days='$no_of_days', total_amount='$total_amount', return_status='$return_status' WHERE id = '$id' ";
        } else {
            $sql1 = "UPDATE renteddresses SET dress_return_date='$dress_return_date', no_of_days='$duration', total_amount='$total_amount', return_status='$return_status' WHERE id = '$id' ";
        }

        $result1 = $conn->query($sql1);

        if ($result1) {
            // Assuming you have a dress_availability field in your 'dresses' table
            $sql2 = "UPDATE dresses d, renteddresses rd SET d.dress_availability='yes' WHERE rd.dress_id=d.dress_id AND rd.customer_username = '$login_customer' AND rd.id = '$id'";
            $result2 = $conn->query($sql2);
        } else {
            echo $conn->error;
        }
        ?>

        <div class="container">
            <div class="jumbotron">
                <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Dress Cancelled</h1>
            </div>
        </div>
        <br>

        <h2 class="text-center"> Thank you for renting from La Fabulosa Dress Rentals! We hope you enjoyed your dress.</h2>

        <h3 class="text-center"> <strong>Your Order Number:</strong> <span style="color: blue;"><?php echo "$id"; ?></span> </h3>


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