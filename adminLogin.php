<?php
session_start();
$validation = array();

if(isset($_SESSION['loggedin'])){
    header ('Location: admin.php');
}

$connection = mysqli_connect('localhost', 'root', '', 'project');
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    if (count($validation) == 0) {
        $query = "SELECT * FROM admins WHERE adminUsername='$username' AND adminPassword='$password'";
        $results = mysqli_query($connection, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['loggedin']= "Admin logged in";
            header('Location: admin.php');
        } else {
            array_push($validation, "Wrong username/password combination");
        }
    }

}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/adminLoginStyle.css">
    <script type="text/javascript" src="validation.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/0fe497d812.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Lifestyle | Admin Login</title>
</head>


<body>

    <!-- Navbar -->
    <header>
        <nav id="nav" class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 class="mt-3 ml-md-0 ml-5 d-flex justify-content-center pl-md-0 pl-3"><a href="main.php">Lifestyle</a></h2>
                </div>
            </div>
        </nav>
    </header>

    <section id="form" class="mt-5">
        <div class="container h-100">
            <div class="row">
                <div class="col-md-4 offset-md-4 bg-light form-central">
                    <h3 class="mt-5">ADMINISTRATOR</h3>
                    <?php foreach ($validation as $value) {
                            echo "<p style='font-weight: bold;color: rgb(230, 44, 44); font-size: 1.5rem; font-family: sans-serif; text-align: center'>" . $value . "</p>";
                        }
                    ?>
                    <form method="POST">                            
                        <div class="form-group mt-4 pt-2">
                            <label for="name">Username</label>
                            <input type="name" class="form-control" id="name" aria-describedby="name"
                                placeholder="Admin Username" name="username">
                            <p class="error">Username incorrect</p>
                        </div>
                        <div class="form-group mt-4">
                            <label for="password">Password</label>
                            <input type="password" name="password" required class="form-control" id="password"
                                placeholder="Password">
                            <a href="#">PASSWORD RECOVERY</a>
                        </div>
                        <button type="submit" class="btn-login">LOGIN</button>
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
                    <p><a href="https://www.instagram.com" target="_blank"><i
                                class="fab fa-instagram mr-2"></i>Instagram</a></p>
                    <p><a href="https://www.facebook.com" target="_blank"><i
                                class="fab fa-facebook-square mr-2"></i>Facebook</a></p>
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
        $(document).ready(function () {
            $(".menu-icon").on("click", function () {
                $("nav ul").toggleClass("showing");
            });
        });

        // Navbar Scrolling Effect
        $(window).on("scroll", function () {
            if ($(window).scrollTop()) {
                $('nav').removeClass('transparent');
            }

            else {
                $('nav').addClass('transparent');
            }
        })
    }

    // Hides navbar when scrolling down  and shows when scrolling up
    var prevScrollpos = window.pageYOffset;

    window.onscroll = function () {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("nav").style.top = "0";
        } else {
            document.getElementById("nav").style.top = "-100px";
        }
        prevScrollpos = currentScrollPos;
    }

    // Transforms hamburger into cross
    function transformMenu(x) {
        x.classList.toggle("change");
    }

    function openNav() {
        document.getElementById("myNav").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("myNav").style.width = "0%";
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

</script>

</html>