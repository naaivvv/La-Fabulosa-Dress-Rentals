<?php
include('session_customer.php');

// Retrieve customer details from session
$customer_username = $_SESSION['login_customer'];

// Retrieve customer details based on customer_username
$sql = "SELECT * FROM customers WHERE customer_username = '$customer_username'";
$result = $conn->query($sql);

if(mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    // Pre-fill form fields with customer details
    $customer_name = $row['customer_name'];
    $customer_phone = $row['customer_phone'];
    $customer_email = $row['customer_email'];
    $customer_address = $row['customer_address'];
    // Add more fields if necessary
} else {
    // Handle the case where no customer is found with the given customer_username
    // Redirect or display an error message
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>La Fabulosa Dress Rentals</title>
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
<link rel="stylesheet" href="assets/w3css/w3.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="index.php">La Fabulosa Dress Rentals </a>
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
            <form role="form" action="editcustomer.php" method="POST">
                <!-- Add hidden input field for customer_username -->
                <input type="hidden" name="customer_username" value="<?php echo $customer_username; ?>">
                <br style="clear: both">
                <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Edit Your Profile. </h3>
                <p class="text-center text-success"><?php echo (isset($_SESSION['manage_success'])) ? $_SESSION['manage_success'] : '';?></p>
            <p class="text-center text-danger"><?php echo (isset($_SESSION['manage_fail'])) ? $_SESSION['manage_fail'] : '';?></p>
            <?php
            // Clear the session messages after displaying theme
            unset($_SESSION['manage_success']);
            unset($_SESSION['manage_fail']);
            ?>

                <div class="form-group">
                    <label for="customer_name">Full Name</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Full Name" required value="<?php echo $customer_name; ?>">
                </div>

                <div class="form-group">
                    <label for="customer_phone">Phone Number</label>
                    <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Phone Number" required value="<?php echo $customer_phone; ?>">
                </div>

                <div class="form-group">
                    <label for="customer_email">Email Address</label>
                    <input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="Email Address" required value="<?php echo $customer_email; ?>">
                </div>

                <div class="form-group">
                    <label for="customer_address">Address</label>
                    <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Address" required value="<?php echo $customer_address; ?>">
                </div>

                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required>
                </div>

                <button type="submit" id="submit" name="submit" class="btn btn-success pull-right"> Update Profile</button>
            </form>
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
