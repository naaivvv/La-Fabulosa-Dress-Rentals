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

$sql1 = "SELECT d.dress_name, c.customer_name, c.customer_phone, c.customer_email, rd.id, rd.rent_start_date, rd.rent_end_date, rd.charge_type, rd.dress_price, rd.no_of_days, rd.total_amount, rd.return_status, rd.decision
         FROM renteddresses rd
         JOIN customers c ON rd.customer_username = c.customer_username
         JOIN dresses d ON d.dress_id = rd.dress_id
         ORDER BY rd.rent_end_date ASC";
$result1 = $conn->query($sql1);

if ($result1) {
    if ($result1->num_rows > 0) {
?>
        <div class="container">
            <div class="jumbotron">
                <h1 class="text-center">Dress Bookings</h1>
                <p class="text-center">Hope you enjoyed our service</p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-12 offset-md-3">
                <form class="form-inline my-2 my-lg-0" onsubmit="return searchClients()">
                    <input class="form-control mr-sm-2" type="text" id="clientSearch" placeholder="Search by client name">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </div>
        <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th width="10%">Order Number</th>
                        <th width="10%">Customer Name</th>
                        <th width="10%">Phone</th>
                        <th width="10%">Email</th>
                        <th width="20%">Dress</th>
                        <th width="10%">Rent Start Date</th>
                        <th width="10%">Rent End Date</th>
                        <th width="15%">Dress Price</th>
                        <th width="10%">Number of Days</th>
                        <th width="15%">Total Amount</th>
                        <th width="10%">Return Status</th>
                        <th width="10%">Decision</th>
                    </tr>
                </thead>
                <?php
                while ($row = $result1->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["customer_name"]; ?></td>
                        <td><?php echo $row["customer_phone"]; ?></td>
                        <td><?php echo $row["customer_email"]; ?></td>
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
    <?php
    } else {
    ?>
        <div class="container">
            <div class="jumbotron">
                <h1>No booked dresses</h1>
                <p>Invite customers now</p>
            </div>
        </div>
<?php
    }
} else {
    echo "Error: " . $conn->error;
}
?>

<script>
    function searchClients() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("clientSearch");
        filter = input.value.toUpperCase();
        table = document.querySelector(".table");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those that don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Change index if you want to search in a different column
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        return false; // Prevent the form from submitting
    }
</script>


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