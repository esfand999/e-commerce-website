<?php
session_start();
$validation = array();

if (isset($_SESSION['email'])) {
    header('Location: main.php');
}

// Establish connection to the database
$connection = mysqli_connect('localhost', 'root', '', 'project');
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Inputs from form
    $firstname = mysqli_real_escape_string($connection, $_POST['fname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['lname']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $password2 = mysqli_real_escape_string($connection, $_POST['password_2']);

    // Checking the database if email has been used before 
    $user_data = "SELECT * FROM `project`.`users` WHERE email='$email'";
    $row = mysqli_query($connection, $user_data);
    $user = mysqli_fetch_assoc($row);

    if ($user['email'] === $email) {
        array_push($validation, "This email already exists");
    }

    if (count($validation) == 0) {
        // Encrypting Password
        $password = md5($password);
        // Storing form data in Session
        $_SESSION['email'] = $email;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['password'] = $password;
        // Moving onto the next page
        $_SESSION['register'] = "Sign up";
        header('Location: completeRegistration.php');
    }
}

?>




<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registerStyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/0fe497d812.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="validation.js"></script>
    <title>Lifestyle | Register</title>

</head>

<body>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="search-box ml-5">
            <input type="text" autocomplete="off" placeholder="Search" />
            <div class="result"></div>
        </div>
        <br><br><br><br><br><br>
        <a href="shop.php">New Arrivals</a>
        <a href="shop.php?cat=men">Men's Clothing</a>
        <a href="shop.php?cat=women">Women's Clothing</a>
        <a href="shop.php">Accessories</a>
        <a href="shop.php">Sale</a>
    </div>

    <!-- Navbar -->
    <header>
        <nav id="nav" class="container-fluid">
            <div class="row">
                <div class="col-md-2 col-2 order-md-2 order-1">
                    <h2 class="mt-3 ml-md-0 ml-5 d-flex justify-content-center pl-md-0 pl-3"><a href="main.php">Lifestyle</a>
                    </h2>
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
                    
                    <p class="mr-3">
                        <a href="#">
                            <span class="d-none d-md-block">
                                LOGIN/REGISTRATION
                            </span>
                            <i class="far fa-user mt-1 d-block d-md-none"></i>
                        </a>
                    </p>
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
    </header>

    <section id="form" class="mt-5">
        <div class="container h-100">
            <div class="row">
                <div class="col-md-4 offset-md-4 bg-light form-central">

                    <form method="post">

                        <h3 class="mt-5">REGISTER</h3>
                        <?php foreach ($validation as $value) {
                            echo "<p style='font-weight: bold; color: rgb(230, 44, 44);'>" . $value . "</p>";
                        }
                        ?>
                        <div class="form-group mt-4 pt-2">
                            <label for="fname">First Name</label>
                            <input name="fname" required type="text" class="form-control" id="fname" placeholder="First Name">
                        </div>
                        <div class="form-group mt-4 pt-2">
                            <label for="lname">Last Name</label>
                            <input name="lname" required type="text" class="form-control" id="lname" placeholder="Last Name">
                        </div>

                        <div class="form-group mt-4 pt-2">
                            <label for="email">Email address</label>
                            <input type="email" required name="email" class="form-control" id="email" placeholder="Email" onkeyup="validate(this)">
                            <p class="error">Email must be a valid address e.g. me@mydomain.com</p>
                        </div>

                        <div class="form-group mt-4">
                            <label for="password_1">Password</label>
                            <input type="password" name="password" class="form-control" id="password_1" placeholder="Password" required onkeyup="validate(this); validatePassword()">
                            <p class="error">Password must be alphanumeric and 8 - 20 characters long</p>
                        </div>
                        <div class="form-group mt-4">
                            <label for="password_2">Confirm Password</label>
                            <input type="password" name="password_2" class="form-control" id="password_2" placeholder="Confirm Password" required onkeyup="validatePassword()">
                            <p class="error">Passwords do not match</p>
                        </div>
                        <button class="btn-register" id="submit" type="submit" name="submit">REGISTER</button>

                        <h5 class="mt-5">ALREADY HAVE AN ACCOUNT?</h5>
                        <a href="login.php" class="btn-login mb-5">LOGIN</a>
                    </form>

                </div>
            </div>
        </div>
    </section>


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

<script>
    if ($(window).width() >= 768) {
        $(document).ready(function() {
            $(".menu-icon").on("click", function() {
                $("nav ul").toggleClass("showing");
            });
        });

        // Navbar Scrolling Effect
        $(window).on("scroll", function() {
            if ($(window).scrollTop()) {
                $('nav').removeClass('transparent');
            } else {
                $('nav').addClass('transparent');
            }
        })
    }

    // Hides navbar when scrolling down  and shows when scrolling up
    var prevScrollpos = window.pageYOffset;

    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("nav").style.top = "0";
        } else {
            document.getElementById("nav").style.top = "-100px";
        }
        prevScrollpos = currentScrollPos;
    }


    //sidemenu
    function openNav() {
        document.getElementById("mySidenav").style.width = "100%";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.body.style.backgroundColor = "white";
    }

    $(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>

</html>