<!DOCTYPE html>
<html>

<?php
include('session_customer.php');
if (!isset($_SESSION['login_customer'])) {
    session_destroy();
    header("location: customerlogin.php");
}
?>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bookingconfirm.css" />
</head>

<body>
<?php
$dress_name = $_POST["dress_name"];
$dress_type = $_POST["dress_type"];
$charge_type = $_POST['charge_type'];
$customer_username = $_SESSION["login_customer"];
$dress_id = $conn->real_escape_string($_POST['dress_id']);
$rent_start_date = date('Y-m-d', strtotime($_POST['rent_start_date']));
$rent_end_date = date('Y-m-d', strtotime($_POST['rent_end_date']));
$return_status = "NR"; // not returned
$dress_price = "NA";

function dateDiff($start, $end)
{
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}
$err_date = dateDiff("$rent_start_date", "$rent_end_date");

$sql0 = "SELECT * FROM dresses WHERE dress_id = '$dress_id'";
$result0 = $conn->query($sql0);

if (mysqli_num_rows($result0) > 0) {
    while ($row0 = mysqli_fetch_assoc($result0)) {

        if ($charge_type == "days") {
            $dress_price = $row0["dress_price_per_day"];
        } else {
            $dress_price = $row0["dress_price_per_rent"];
        }
    }
}

if ($err_date >= 0) {
    // Calculate no_of_days
    $no_of_days = dateDiff($rent_start_date, $rent_end_date);

    // Calculate total_amount
    if ($no_of_days == 0) {
        $total_amount = $dress_price;
    } else {
        $total_amount = $dress_price * $no_of_days;
    }

    $sql1 = "INSERT into renteddresses(customer_username,dress_id,booking_date,rent_start_date,rent_end_date,dress_price,charge_type,no_of_days,total_amount,return_status) 
    VALUES('" . $customer_username . "','" . $dress_id . "','" . date("Y-m-d") . "','" . $rent_start_date . "','" . $rent_end_date . "','" . $dress_price . "','" . $charge_type . "','" . $no_of_days . "','" . $total_amount . "','" . $return_status . "')";
    $result1 = $conn->query($sql1);
    // Get the last inserted ID
    $booking_id = $conn->insert_id;

    $sql2 = "UPDATE dresses SET dress_availability = 'no' WHERE dress_id = '$dress_id'";
    $result2 = $conn->query($sql2);

    if (!$result1 || !$result2) {
        die("Couldn't enter data: " . $conn->error);
    }
?>
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
                                <a href="#"> FAQ </a>
                            </li>
                        </ul>
                    </div>
                <?php   }
                ?>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <div class="container">
            <div class="jumbotron">
                <h1 class="text-center" style="color: Orange;"><span class="glyphicon glyphicon-ok-circle"></span> Booking Submitted.</h1>
            </div>
        </div>
        <br>

        <h2 class="text-center"> Thank you for using La Fabulosa Dress Rentals! Please give us a moment to confirm your dress rent booking. We wish you a fabulous event. </h2>

        <h3 class="text-center"> <strong>Your Order Number:</strong> <span style="color: blue;"><?php echo "$booking_id"; ?></span> </h3>

        <div class="container">
            <h5 class="text-center">Please read the following information about your order.</h5>
            <div class="box">
                <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
                    <h3 style="color: orange;">Your booking has been received and placed into our order processing system.</h3>
                    <br>
                    <h4>Please make a note of your <strong>order number</strong> now and keep it in the event you need to communicate with us about your order.</h4>
                    <br>
                    <h3 style="color: orange;">Invoice</h3>
                    <br>
                </div>
                <div class="col-md-10" style="float: none; margin: 0 auto; ">
                    <h4> <strong>Dress Name: </strong> <?php echo $dress_name; ?></h4>
                    <br>
                    <h4> <strong>Dress Type: </strong> <?php echo $dress_type; ?></h4>
                    <br>
                    <?php
                    if ($charge_type == "days") {
                    ?>
                        <h4> <strong>Rental Fee:</strong> PHP<?php echo $dress_price; ?>/day</h4>
                        <br>
                        <h4> <strong>Number of days: </strong> <?php echo $no_of_days; ?></h4>
                    <?php } else { ?>
                        <h4> <strong>Rental Fee:</strong> PHP<?php echo $dress_price; ?>/rent</h4>
                    <?php } ?>
                    <br>
                    <h4> <strong>Total amount: </strong>PHP<?php echo $total_amount; ?></h4>
                    <br>
                    <h4> <strong>Booking Date: </strong> <?php echo date("Y-m-d"); ?> </h4>
                    <br>
                    <h4> <strong>Start Date: </strong> <?php echo $rent_start_date; ?></h4>
                    <br>
                    <h4> <strong>Return Date: </strong> <?php echo $rent_end_date; ?></h4>
                    <br>
                </div>
            </div>
            <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
                <h6>Warning! <strong style="color:red">Do not reload this page</strong> or the above display will be lost. If you want a hardcopy of this page, please print it now.</h6>
            </div>
        </div>
    <?php } else { ?>
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
                                <a href="#"> FAQ </a>
                            </li>
                        </ul>
                    </div>
                <?php   }
                ?>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <div class="container">
            <div class="jumbotron" style="text-align: center;">
                You have selected an incorrect date.
                <br><br>
            </div>
    <?php } ?>
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
