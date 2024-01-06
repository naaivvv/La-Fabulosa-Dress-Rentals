<!DOCTYPE html>
<html>
<?php 
session_start(); 
require 'connection.php';
$conn = Connect();
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Fabulosa Dress Rentals</title>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
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
    <div class="bgimg-1">
        <header class="intro">
            <div class="intro-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h1 class="brand-heading" style="color: black; font-family: Brush Script MT, Brush Script Std, cursive;">La Fabulosa</h1>
                            <p class="intro-text">
                                Online Dress Rental Service
                            </p>
                            <a href="#sec2" class="btn btn-circle page-scroll blink">
                                <i class="fa fa-angle-double-down animated"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <div id="sec2" style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
    <h3 style="text-align:center;">Available Dresses</h3>
    <br>
    <section class="menu-content">
        <?php   
        $sql1 = "SELECT * FROM dresses WHERE dress_availability='yes'";
        $result1 = mysqli_query($conn, $sql1);

        if (mysqli_num_rows($result1) > 0) {
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $dress_id = $row1["dress_id"];
                $dress_name = $row1["dress_name"];
                $dress_type = $row1["dress_type"];
                $dress_color = $row1["dress_color"];
                $dress_size = $row1["dress_size"];
                $dress_price = $row1["dress_price"];
                $dress_img = $row1["dress_img"];
            ?>
                <a href="booking.php?id=<?php echo ($dress_id) ?>">
                    <div class="sub-menu">

                        <img class="card-img-top" src="<?php echo $dress_img; ?>" alt="Dress Image">
                        <h5><b> <?php echo $dress_name; ?> </b></h5>
                        <p class="submenu-details">Type: <?php echo $dress_type; ?></p>
                        <p class="submenu-details">Color: <?php echo $dress_color; ?></p>
                        <p class="submenu-details">Size: <?php echo $dress_size; ?></p>
                        <p class="submenu-details">Price: <?php echo ("PHP. " . $dress_price . "/day"); ?></p>

                    </div>
                </a>
        <?php
            }
        } else {
        ?>
            <h1> No dresses available :( </h1>
        <?php
        }
        ?>
    </section>

</div>
<div class="aboutpage">
    <div class="text-container">
        <h1>About La Fabulosa</h1>
        <p>
            La Fabulosa is your go-to destination for elegant and stylish dress rentals. 
            We offer a wide range of beautiful dresses for various occasions, ensuring that you 
            look and feel fabulous at every event. Our collection includes the latest trends 
            and timeless classics, curated to suit your unique style.
        </p>
        <p>
            At La Fabulosa, we believe in making every moment special. Whether it's a formal 
            evening, a wedding, or a cocktail party, our dresses are designed to make you stand 
            out. Explore our collection and find the perfect dress for your next memorable event.
        </p>
    </div>
    <div class="slideshow-container">
        <div class="slide">
            <img src="assets/img/dresses/peach.jpg" alt="Peach">
        </div>
        <div class="slide">
            <img src="assets/img/dresses/pinkdress.jpg" alt="Pink">
        </div>
        <div class="slide">
            <img src="assets/img/dresses/violet.jpg" alt="Violet">
        </div>
        <!-- Add more slides as needed -->

        <!-- Navigation dots for the slideshow -->
        <div style="text-align: center; margin-top: 20px;">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <!-- Add more dots for additional slides -->
        </div>
    </div>
</div>

<script>
    // JavaScript for slideshow functionality
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');

    function showSlide(index) {
        slides.forEach((slide) => (slide.style.display = 'none'));
        dots.forEach((dot) => dot.classList.remove('active'));

        slides[index].style.display = 'block';
        dots[index].classList.add('active');
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    // Automatically advance slides every 3 seconds
    setInterval(nextSlide, 3000);

    // Event listeners for navigation dots
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            showSlide(currentSlide);
        });
    });

    // Show the first slide initially
    showSlide(currentSlide);
</script>
    <style>
        .contactpage {
            background-color: #f9f9f9;
            height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .contact-container {
            width: 80%;
            margin: auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: left;
        }

        .details-container {
            padding: 30px;
            text-align: right;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            width:100%;
        }
        .form-container {
            width:100%;
        }

        #map {
            height: 550px;
            width: 100%;
            border-radius: 8px;
            margin-top: 20px;
        }
    </style>
     <div class="contactpage">
        <div class="details-container">
            <!-- Embed Google Maps link -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125433.89550467531!2d122.8932327037109!3d10.749180883561635!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33aed7519f275591%3A0x51ea08c41ac43f46!2sLa%20Fabulosa%20Gowns%20and%20Rentals!5e0!3m2!1sen!2sph!4v1704459488885!5m2!1sen!2sph" width="100%" height="550px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="contact-container">
            <h1 class="text-center">Contact Us</h1>
            <p class="text-center text-success"><?php echo (isset($_SESSION['feedback_success'])) ? $_SESSION['feedback_success'] : '';?></p>
            <p class="text-center text-danger"><?php echo (isset($_SESSION['feedback_fail'])) ? $_SESSION['feedback_fail'] : '';?></p>
            <?php
            // Clear the session messages after displaying theme
            unset($_SESSION['feedback_success']);
            unset($_SESSION['feedback_fail']);
            ?>
            <form class="form-container" action="feedbacksubmit.php" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Your message" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    <div class="bgimg-2">
        <div class="caption">
            <span class="border" style="background-color:transparent;font-size:25px;color: #f7f7f7;"></span>
        </div>
    </div>
    
    <!-- Container (Contact Section) -->
    <!-- -->
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
    <script>
        function myMap() {
            myCenter = new google.maps.LatLng(25.614744, 85.128489);
            var mapOptions = {
                center: myCenter,
                zoom: 12,
                scrollwheel: true,
                draggable: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);

            var marker = new google.maps.Marker({
                position: myCenter,
            });
            marker.setMap(map);
        }
    </script>
    <script>
        function sendGaEvent(category, action, label) {
            ga('send', {
                hitType: 'event',
                eventCategory: category,
                eventAction: action,
                eventLabel: label
            });
        };
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCuoe93lQkgRaC7FB8fMOr_g1dmMRwKng&callback=myMap" type="text/javascript"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="assets/js/jquery.easing.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="assets/js/theme.js"></script>
</body>

</html>