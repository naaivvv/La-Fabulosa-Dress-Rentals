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

    <div class="container" style="margin-top: 65px;" >
        <div class="col-md-7" style="float: none; margin: 0 auto;">
          <div class="form-area">
              <form role="form" action="enterdress-submit.php" enctype="multipart/form-data" method="POST">
                  <br style="clear: both">
                  <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Provide Dress Details. </h3>
                  <p class="text-center text-success"><?php echo (isset($_SESSION['dress_success'])) ? $_SESSION['dress_success'] : '';?></p>
                  <?php
            unset($_SESSION['dress_success']);
            ?>
                  <div class="form-group">
                      <input type="text" class="form-control" id="dress_name" name="dress_name" placeholder="Dress Name" required autofocus="">
                  </div>

                  <div class="form-group">
                      <input type="text" class="form-control" id="dress_type" name="dress_type" placeholder="Dress Type" required>
                  </div>

                  <div class="form-group">
                      <input type="text" class="form-control" id="dress_color" name="dress_color" placeholder="Dress Color" required>
                  </div>

                  <div class="form-group">
                      <input type="text" class="form-control" id="dress_size" name="dress_size" placeholder="Dress Size" required>
                  </div>

                  <div class="form-group">
                      <input type="text" class="form-control" id="dress_price" name="dress_price" placeholder="Dress Price (PHP)" required>
                  </div>

                  <div class="form-group">
                      <input type="text" class="form-control" id="dress_price" name="dress_price_per_day" placeholder="Dress Price Per Day (PHP)" required>
                  </div>

                  <div class="form-group">
                      <input type="text" class="form-control" id="dress_price" name="dress_price_per_rent" placeholder="Dress Price Per Rent (PHP)" required>
                  </div>

                  <div class="form-group">
                      <input name="uploadedimage" type="file">
                  </div>
                  <button type="submit" id="submit" name="submit" class="btn btn-success pull-right"> Submit for Rental</button>
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