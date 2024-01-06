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
function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}

$id = $_GET["id"];
$sql1 = "SELECT d.dress_name, rd.rent_start_date, rd.rent_end_date, rd.dress_price, rd.charge_type, rd.total_amount
FROM renteddresses rd, dresses d
WHERE id = '$id' AND d.dress_id=rd.dress_id";
$result1 = $conn->query($sql1);

if (mysqli_num_rows($result1) > 0) {
    while ($row = mysqli_fetch_assoc($result1)) {
        $dress_name = $row["dress_name"];
        $rent_start_date = $row["rent_start_date"];
        $rent_end_date = $row["rent_end_date"];
        $dress_price = $row["dress_price"];
        $charge_type = $row["charge_type"];
        $total_amount = $row["total_amount"];
        $no_of_days = dateDiff("$rent_start_date", "$rent_end_date");
    }
}
?>

<div class="container" style="margin-top: 65px;">
    <div class="col-md-7" style="float: none; margin: 0 auto;">
        <div class="form-area">
            <form role="form" action="cancelbill.php?id=<?php echo $id ?>" method="POST">
                <br style="clear: both">
                <h3 style="margin-bottom: 5px; text-align: center; font-size: 30px;"> Dress Details </h3>
                <h6 style="margin-bottom: 25px; text-align: center; font-size: 12px;"> Are you sure you want to cancel this dress booking? </h6>

                <h5> Dress:&nbsp; <?php echo ($dress_name); ?></h5>

                <h5> Rent date:&nbsp; <?php echo ($rent_start_date); ?></h5>

                <h5> End Date:&nbsp; <?php echo ($rent_end_date); ?></h5>

                <h5> Dress Price:&nbsp; PHP <?php
                                        if ($charge_type == "days") {
                                            echo ($dress_price . "/day");
                                        } else {
                                            echo ($dress_price . "/rental");
                                        }
                                        ?>
                </h5>

                <?php if ($charge_type == "rental") { ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="distance_or_days" name="distance_or_days" placeholder="Enter the number of days rented" required="" autofocus>
                    </div>
                <?php } else { ?>
                    <h5> Number of Day(s):&nbsp; <?php echo ($no_of_days); ?></h5>
                    <h5><strong> Total Amount: PHP <?php echo $total_amount; ?> </strong></h5>
                    <input type="hidden" name="distance_or_days" value="<?php echo $no_of_days; ?>">
                <?php } ?>
                <input type="hidden" name="hid_dress_price" value="<?php echo $dress_price; ?>">

                <input type="submit" name="submit" value="cancel" class="btn btn-warning pull-right">
            </form>
        </div>
    </div>
</div>
    </div>

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