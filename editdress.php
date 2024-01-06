
<!DOCTYPE html>
<html>

<?php 
include('session_client.php'); ?> 
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
                    <li>
                        <a href="#">History</a>
                    </li>
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
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $dress_id = $_GET['id'];

    // Retrieve dress details based on dress_id
    $sql = "SELECT * FROM dresses WHERE dress_id = $dress_id";
    $result = $conn->query($sql);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Pre-fill form fields with dress details
        $dress_name = $row['dress_name'];
        $dress_type = $row['dress_type'];
        $dress_color = $row['dress_color'];
        $dress_size = $row['dress_size'];
        $dress_price = $row['dress_price'];
        $dress_price_per_day = $row['dress_price_per_day'];
        $dress_price_per_rent = $row['dress_price_per_rent'];
        $dress_availability = $row['dress_availability'];
        // Add more fields if necessary
    } else {
        // Handle the case where no dress is found with the given dress_id
        // Redirect or display an error message
        header("Location: managedress.php");
        exit();
    }
} else {
    // Handle the case where no dress_id is provided in the URL
    // Redirect or display an error message
    header("Location: managedress.php");
    exit();
}
?>
    <div class="container" style="margin-top: 65px;">
    <div class="col-md-7" style="float: none; margin: 0 auto;">
        <div class="form-area">
        <form role="form" action="updatedress.php" enctype="multipart/form-data" method="POST">
            <!-- Add hidden input field for dress_id -->
            <input type="hidden" name="dress_id" value="<?php echo $dress_id; ?>">
            <br style="clear: both">
            <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Update Dress Details. </h3>

            <div class="form-group">
                <label for="dress_name">Dress Name</label>
                <input type="text" class="form-control" id="dress_name" name="dress_name" placeholder="Dress Name" required autofocus="" value="<?php echo $dress_name; ?>">
            </div>

            <div class="form-group">
                <label for="dress_type">Dress Type</label>
                <input type="text" class="form-control" id="dress_type" name="dress_type" placeholder="Dress Type" required value="<?php echo $dress_type; ?>">
            </div>

            <div class="form-group">
                <label for="dress_color">Dress Color</label>
                <input type="text" class="form-control" id="dress_color" name="dress_color" placeholder="Dress Color" required value="<?php echo $dress_color; ?>">
            </div>

            <div class="form-group">
                <label for="dress_size">Dress Size</label>
                <input type="text" class="form-control" id="dress_size" name="dress_size" placeholder="Dress Size" required value="<?php echo $dress_size; ?>">
            </div>

            <div class="form-group">
                <label for="dress_price">Dress Price (PHP)</label>
                <input type="text" class="form-control" id="dress_price" name="dress_price" placeholder="Dress Price (PHP)" required value="<?php echo $dress_price; ?>">
            </div>

            <div class="form-group">
                <label for="dress_price_per_day">Dress Price Per Day (PHP)</label>
                <input type="text" class="form-control" id="dress_price_per_day" name="dress_price_per_day" placeholder="Dress Price Per Day (PHP)" required value="<?php echo $dress_price_per_day; ?>">
            </div>

            <div class="form-group">
                <label for="dress_price_per_rent">Dress Price Per Rent (PHP)</label>
                <input type="text" class="form-control" id="dress_price_per_rent" name="dress_price_per_rent" placeholder="Dress Price Per Rent (PHP)" required value="<?php echo $dress_price_per_rent; ?>">
            </div>

            <div class="form-group">
                <label for="uploadedimage">Upload Image</label>
                <input name="uploadedimage" type="file">
            </div>

            <div class="form-group">
                <label for="dress_availability">Dress Availability</label>
                <select class="form-control" id="dress_availability" name="dress_availability" required>
                    <option value="yes" <?php echo ($dress_availability == 'yes') ? 'selected' : ''; ?>>Yes</option>
                    <option value="no" <?php echo ($dress_availability == 'no') ? 'selected' : ''; ?>>No</option>
                </select>
            </div>

            <button type="submit" id="submit" name="submit" class="btn btn-success pull-right"> Update Dress Details</button>
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