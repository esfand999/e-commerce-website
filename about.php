<?php
session_start();
if (!isset($_SESSION['shopping_cart'])) {
    $_SESSION['shopping_cart'] = array();
}
if (!isset($_SESSION['quantity'])) {
    $_SESSION['quantity'] = array();
}
if (!isset($_SESSION['size'])) {
    $_SESSION['size'] = array();
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoZg2Es_GrQHZf_52j2-xZ3cTfBCR0HII&callback=initMap" async defer></script>
    <script type="text/javascript" src="map.js"></script>

    <title>Lifestyle | About Us</title>

    <style>
        #map {
            height: 100%;
        }
    </style>
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
    </header>

    <section id="main" class="container mt-5 mb-5">
        <div class="row">
            <h2 class="col-12 col-md-7 font-weight-bold">About Us</h2>
            <h4 class="col-12 mt-md-5 col-md-5 font-weight-bold">Dedicated Website Helpline: <span style="color: coral;">+92 348 2222 222</span></h4>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <p>
                    Superdry is an exciting contemporary brand which focuses on high-quality products that fuse vintage Americana and Japanese-inspired graphics with a British style. They are characterised by quality fabrics, authentic vintage washes, unique detailing, world leading hand-drawn graphics and tailored fits with diverse styling. Such distinctiveness has gained the brand exclusive appeal as well as an international celebrity following.
                    <br> <br>
                    Superdry has a significant and growing presence around the world, operating through 768 Superdry branded locations in 65 countries. There are 245 owned stores across the UK and mainland Europe, 497 franchised and licensed stores and 26 concessions.
                    <br> <br>
                    Superdry.com sells safely and securely to over 100 countries worldwide, operating from 21 international websites. The Superdry delivery promise is one of the best in the marketplace offering great customer service and a hassle-free returns policy.
                </p>
            </div>
        </div>
    </section>

    <!-- Google Maps -->
    <div id="map"></div>


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

    $(document).ready(function() {
        $('.search-box input[type="text"]').on("keyup input", function() {
            /* Get input value on change */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if (inputVal.length) {
                $.get("backend-search.php", {
                    term: inputVal
                }).done(function(data) {
                    // Display the returned data in browser
                    resultDropdown.html(data);
                });
            } else {
                resultDropdown.empty();
            }
        });

        // Set search input value on click of result item
        $(document).on("click", ".result p", function() {
            $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
            $(this).parent(".result").empty();
        });
    });
</script>

</html>