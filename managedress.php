<!DOCTYPE html>
<html>
<?php 
session_start();
require 'connection.php';
$conn = Connect();
?>
<head>
<title>La Fabulosa Dress Rentals</title>
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

$sql1 = "SELECT * FROM dresses";
$result1 = $conn->query($sql1);

if (mysqli_num_rows($result1) > 0) {
?>
    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center">Manage your dresses here</h1>
            <p class="text-center"> Hope you enjoyed our service </p>
            <p class="text-center text-success"><?php echo (isset($_SESSION['manage_success'])) ? $_SESSION['manage_success'] : '';?></p>
            <p class="text-center text-danger"><?php echo (isset($_SESSION['manage_fail'])) ? $_SESSION['manage_fail'] : '';?></p>
            <?php
            // Clear the session messages after displaying theme
            unset($_SESSION['manage_success']);
            unset($_SESSION['manage_fail']);
            ?>
        </div>
    </div>

    <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th width="20%">Dress</th>
                    <th width="10%">Dress Type</th>
                    <th width="5%">Color</th>
                    <th width="5%">Size</th>
                    <th width="7%">Price</th>
                    <th width="7%">Price Per Day</th>
                    <th width="7%">Price Per Rent</th>
                    <th width="12%">Image</th>
                    <th width="5%">Availability</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <?php
            while ($row = mysqli_fetch_assoc($result1)) {
            ?>
                <tr>
                    <td><?php echo $row["dress_name"]; ?></td>
                    <td><?php echo $row["dress_type"]; ?></td>
                    <td><?php echo $row["dress_color"]; ?></td>
                    <td><?php echo $row["dress_size"]; ?></td>
                    <td>PHP <?php echo $row["dress_price"]; ?></td>
                    <td>PHP <?php echo $row["dress_price_per_day"]; ?></td>
                    <td>PHP <?php echo $row["dress_price_per_rent"]; ?></td>
                    <td>
                    <img src="<?php echo $row["dress_img"]; ?>" alt="Dress Image" width="200" height="300">
                    </td>
                    <td><?php echo $row["dress_availability"]; ?></td>
                    <td><a href="editdress.php?id=<?php echo $row["dress_id"]; ?>"> Edit </a> | <a href="#" data-toggle="modal" data-target="#deleteModal<?php echo $row["dress_id"]; ?>"> Delete </a>
                    <div class="modal fade" id="deleteModal<?php echo $row["dress_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this dress?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="deletedress.php?id=<?php echo $row["dress_id"]; ?>" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </td>
                </tr>
            <?php        } ?>
        </table>
    </div>
<?php } else {
?>
    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center">No dresses to manage.</h1>
            <p class="text-center"> Hope you enjoyed our service </p>
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