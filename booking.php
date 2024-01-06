<!DOCTYPE html>
<html>
<?php 
    include('session_customer.php');
    if(!isset($_SESSION['login_customer'])){
        session_destroy();
        header("location: customerlogin.php");
    } 
?>
<title>Book Dress</title>
<head>
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/custom.js"></script>
    <script type="text/javascript" src="assets/ajs/angular.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>
<body ng-app=""> 
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
    
    <div class="container" style="margin-top: 65px;">
        <div class="col-md-7" style="float: none; margin: 0 auto;">
            <div class="form-area">
                <form role="form" action="bookingconfirm.php" method="POST">
                    <br style="clear: both">
                    <br>

                    <?php
                    $dress_id = $_GET["id"];
                    $sql1 = "SELECT * FROM dresses WHERE dress_id = '$dress_id'";
                    $result1 = mysqli_query($conn, $sql1);

                    if(mysqli_num_rows($result1)){
                        while($row1 = mysqli_fetch_assoc($result1)){
                            $dress_name = $row1["dress_name"];
                            $dress_type = $row1["dress_type"];
                            $dress_color = $row1["dress_color"];
                            $dress_size = $row1["dress_size"];
                            $dress_price = $row1["dress_price"];
                            $dress_img = $row1["dress_img"];
                        }
                    }
                    ?>

                    <h5>Selected Dress: <b><?php echo $dress_name; ?></b></h5>
                    <h5>Dress Type: <b><?php echo $dress_type; ?></b></h5>
                    <h5>Dress Color: <b><?php echo $dress_color; ?></b></h5>
                    <h5>Dress Size: <b><?php echo $dress_size; ?></b></h5>
                    <h5>Dress Price: PHP <b><?php echo $dress_price; ?></b></h5>

                    <input type="hidden" name="dress_id" value="<?php echo $dress_id; ?>">
                    <input type="hidden" name="dress_name" value="<?php echo $dress_name; ?>">
                    <input type="hidden" name="dress_type" value="<?php echo $dress_type; ?>">

                    <label><h5>Start Date:</h5></label>
                    <input type="date" name="rent_start_date" min="<?php echo date('Y-m-d'); ?>" required="">
                    &nbsp; 
                    <label><h5>End Date:</h5></label>
                    <input type="date" name="rent_end_date" min="<?php echo date('Y-m-d'); ?>" required="">

                    <div class="form-group">
                        <label><h5>Choose your charge type:</h5></label>
                        <select name="charge_type" required="">
                            <option value="days">Per Day</option>
                            <option value="occasions">Per Occasion</option>
                        </select>
                    </div>

                    <div class="form-group text-center">
                        <input type="submit" name="submit" value="Rent Now" class="btn btn-warning">
                    </div>
                </form>

                <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
                    <h6><strong>Note:</strong> You will be charged with extra <span class="text-danger">PHP 500</span> for each day after the due date ends.</h6>
                </div>
            </div>
        </div>
    </div>

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
</body>
</html>
