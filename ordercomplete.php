<?php
session_start();
$connection = mysqli_connect('localhost', 'root', '', 'project');
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (sizeof($_SESSION['shopping_cart']) == 0) {
    header("Location: shop.php");
}


if (isset($_POST['submit'])) {
    $firstname = mysqli_real_escape_string($connection, $_POST['fname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['lname']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $city = mysqli_real_escape_string($connection, $_POST['city']);
    $state = mysqli_real_escape_string($connection, $_POST['state']);
    $postalcode = mysqli_real_escape_string($connection, $_POST['postalcode']);
    $phone = mysqli_real_escape_string($connection, $_POST['telephone']);

    $query = "INSERT INTO `project`.`orders` (`id`, `email`) VALUES (NULL, '$email')";
    if (mysqli_query($connection, $query)) {
        $user_data = "SELECT * FROM `project`.`orders` WHERE email='$email'";
        $row = mysqli_query($connection, $user_data);
        $order = mysqli_fetch_assoc($row);
        $oid = (int) $order['id'];
        for ($i = 0; $i < sizeof($_SESSION['shopping_cart']); $i++) {
            $pid = (int) $_SESSION["shopping_cart"][$i];
            $quantity = (int) $_SESSION["quantity"][$i];
            $size = $_SESSION["size"][$i];
            $query2 = "INSERT INTO `project`.`order_details` (`id`,`oid`,`pid`,`address`, `email`,`quantity`,`size`) VALUES (NULL,'$oid','$pid','$address ,'$email','$quantity','$size')";
            if (mysqli_query($connection, $query2)) {
            }
        }
    }
    unset($_SESSION['quantity']);
    unset($_SESSION['shopping_cart']);
    unset($_SESSION['size']);
}
?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/aboutStyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/0fe497d812.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title>Lifestyle</title>
</head>

<body>

    <!-- Navbar -->
    <nav id="nav" class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-2 order-md-2 order-1">
                <h2 class="mt-3 ml-md-0 ml-5 d-flex justify-content-center pl-md-0 pl-3"><a href="main.php">Lifestyle</a></h2>
            </div>
            <div class="col-md-5 col-2 d-flex justify-content-md-start justify-content-end order-md-1 order-3 mt-4">
                <div class="hb-cont mt-2 mr-md-0 mr-1" onclick="openNav()" onclick="transformMenu(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                </div>
                <p class="ml-4 d-none d-md-block">
                    <a href="shop.php">
                        SHOP FW 20-21
                    </a>
                <p>
                <p class="ml-3 d-none d-md-block">
                    <a href="shop.php">
                        SALES
                </p>
                </a>
            </div>
            <div class="col-md-5 col-8 d-flex justify-content-md-end justify-content-end order-md-3 order-2 mt-4">

                <?php
                if (isset($_SESSION['email'])) {
                    echo '<p class="mr-3"><a href="user_management.php"><span class="d-none d-md-block">MY ACCOUNT</span><i class="far fa-user mt-1 d-block d-md-none"></i></a></p>';
                    echo '<p class="mr-3"><a href="logout.php"><span class="d-none d-md-block">LOG OUT</span><i class="fas fa-sign-out-alt mt-1 d-block d-md-none"></i></a></p>';
                } else {
                    echo '<p class="mr-3"><a href="login.php"><span class="d-none d-md-block">LOGIN/REGISTRATION</span><i class="far fa-user mt-1 d-block d-md-none"></i></a></p>';
                }
                ?>
                <p>
                    <a href="#">
                        <i class="fas fa-heart mt-1 mr-3"></i>
                    </a>
                </p>
                <p>
                    <a href="cart.php">
                        <i class="fas fa-shopping-cart mt-1 d-md-none d-block"></i>
                        <span class="d-md-block d-none">BAG</span>
                    </a>
                </p>
            </div>
        </div>
    </nav>

    <div id="main">
        <div class="container h-75">
            <div class="d-flex-column justify-content-center my-auto align-items-center mt-5">
                <h1 class="text-center">ORDER COMPLETE</h1>
                <p class="text-center"><i class="fas fa-check-circle text-center" style="font-size: 5rem; color:green;"></i></p>
                <p class="text-center"><a href="main.php" class="btn btn-primary">Continue Shopping</a></p>
            </div>
        </div>
    </div>

    <footer id="footer mt-5">
        <div class="container">
            <div class="row d-flex justify-content-between pt-5">
                <div class="customer-service col-md-3 col-6">
                    <h4 class="font-weight-bold">Customer Services</h4>
                    <p><a href="help.php">Help & FAQ's</a></p>
                    <p><a href="delivery.php">Delivery</a></p>
                    <p><a href="help.php#return">Returns</a></p>
                </div>
                <div class="brand col-md-3 col-6">
                    <h4 class="font-weight-bold">Lifestyle The Brand</h4>
                    <p><a href="about.php">About Us</a></p>
                    <p><a href="#">Corporate</a></p>
                    <p><a href="mailto:press@lifestyle.com">Contact Our Press Team</a></p>
                </div>
                <div class="social col-md-3 col-12">
                    <h4 class="font-weight-bold">Social</h4>
                    <p><a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram mr-2"></i>Instagram</a></p>
                    <p><a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-square mr-2"></i>Facebook</a></p>
                    <p><a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter mr-2"></i>Twitter</a>
                    </p>
                    <p><a href="https://www.youtube.com" target="_blank"><i class="fab fa-youtube mr-2"></i>Youtube</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-5">
            <div class="copyright row d-flex justify-content-end">
                <div class="col-md-6 col-sm-12">
                    <p class="text-md-right text-center pt-3 pb-2">&copy; LIFESTYLE 2020 &#8231; All rights reserved</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>