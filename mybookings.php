<!DOCTYPE html>
<html>
<?php 
session_start();
require 'connection.php';
$conn = Connect();
?>
<head>
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
<title>La Fabulosa Dress Rentals</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
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
 
    <?php
$login_customer = $_SESSION['login_customer'];

$sql1 = "SELECT d.dress_name, rd.id, rd.rent_start_date, rd.rent_end_date, rd.charge_type, rd.dress_price, rd.no_of_days, rd.total_amount, rd.return_status, rd.decision FROM renteddresses rd, dresses d
    WHERE rd.customer_username='$login_customer' AND d.dress_id=rd.dress_id";
$result1 = $conn->query($sql1);

if (mysqli_num_rows($result1) > 0) {
?>
<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">Your Dress Booking History</h1>
        <p class="text-center"> Hope you enjoyed our service </p>
    </div>
</div>

<div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
<table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th width="10%">Order Number</th>
                    <th width="30%">Dress</th>
                    <th width="10%">Rent Start Date</th>
                    <th width="10%">Rent End Date</th>
                    <th width="15%">Dress Price</th>
                    <th width="10%">Number of Days</th>
                    <th width="15%">Total Amount</th>
                    <th width="7%">Status</th>
                    <th width="10%">Decision</th>
                </tr>
            </thead>
            <?php
            while ($row = mysqli_fetch_assoc($result1)) {
            ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["dress_name"]; ?></td>
                    <td><?php echo $row["rent_start_date"] ?></td>
                    <td><?php echo $row["rent_end_date"]; ?></td>
                    <td>PHP <?php
                            if ($row["charge_type"] == "days") {
                                echo ($row["dress_price"] . "/day");
                            } else {
                                echo ($row["dress_price"] . "/rent");
                            }
                            ?></td>
                    <td><?php echo $row["no_of_days"]; ?></td>
                    <td>PHP <?php echo ($row["total_amount"]); ?></td>
                    <td><?php echo ($row["return_status"]); ?></td>
                    <td><?php echo ($row["decision"]); ?></td>
                </tr>
            <?php        } ?>
        </table>
</div>
<?php } else {
?>
    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center">You have not rented any dresses till now!</h1>
            <p class="text-center"> Please rent dresses in order to view your data here. </p>
        </div>
    </div>
<?php
} ?>

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