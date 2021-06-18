<?php
session_start();
try{
	$con=new PDO("mysql:host=localhost;dbname=project","root","");
}catch(PDOException $e){
	echo $e->getMessage();
}
$sql="select name from products";
$stmt=$con->prepare($sql);
$stmt->execute();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);

if (!isset($_SESSION['shopping_cart']) ) {
    $_SESSION['shopping_cart'] = array();
}
if (!isset($_SESSION['quantity']) ) {
    $_SESSION['quantity'] = array();
}
if (!isset($_SESSION['size']) ) {
    $_SESSION['size'] = array();
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="m.css">
    <script src="https://kit.fontawesome.com/0fe497d812.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <title>Lifestyle | Home</title>
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
        <a href="shop.php">Men's Clothing</a>
        <a href="shop.php">Women's Clothing</a>
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
                        <a href="shop.php">SHOP FW 20-21</a>
                    </p>
                    <p class="ml-3 d-none d-md-block">
                        <a href="shop.php">SALES</a>
                    </p>
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

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->


        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="https://sana.superdry.com/COM/fld-2/1605527399/xoa4i3/static/sdx-lp-img-01.jpg" style="width:100%;">
            </div>

            <div class="item">
                <img src="https://sana.superdry.com/COM/homepage/1608116831/zqo0tw/static/hp1-promo-2for.jpg" style="width:100%;">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    


    <section id=shop class="mt-5 mb-5">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="men col-sm-5 col-12 overflow-none">
                    <figure>
                        <img src="./images/men1.jpg" class="img-responsive" alt="mens shopping">
                    </figure>
                    <div class="btn-wrapper"><a href="shop.php?cat=men" class="btn-shop">SHOP MENS</a></div>
                </div>
                <div class="women col-sm-5 col-12 mt-5 mt-sm-0">
                    <figure>
                        <img src="./images/women1.jpg" class="img-responsive" alt="womens shopping">
                    </figure>
                    <div class="btn-wrapper"><a href="shop.php?cat=women" class="btn-shop">SHOP WOMENS</a></div>
                </div>
            </div>
        </div>
    </section>

    <section id="showcase-categories" class="mb-5">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center pb-5">
                <div class="col-md-2 col-6">
                    <figure>
                        <a href="shop.php">
                            <img src="https://sana.superdry.com/COM/homepage/1607426555/75weet/static/mens-knits_1.jpg" class="img-responsive" alt="mens knitwear">
                        </a>
                    </figure>
                    <a href="shop.php">
                        <h4 class="text-center" style="font-weight: 600;">MENS KNITWEAR</h4>
                    </a>
                </div>
                <div class="col-md-2 col-6">
                    <figure>
                        <a href="shop.php"><img src="https://sana.superdry.com/COM/homepage/1607426555/75weet/static/womens-knits_2.jpg" class="img-responsive" alt="womens knitwear"></a>
                    </figure>
                    <a href="shop.php">
                        <h4 class="text-center" style="font-weight: 600;">WOMENS KNITWEAR</h4>
                    </a>
                </div>
                <div class="col-md-2 col-6">
                    <figure>
                        <a href="shop.php">
                            <img src="https://sana.superdry.com/COM/homepage/1607426555/75weet/static/womens-dresses_4.jpg" class="img-responsive" alt="dress">
                        </a>
                    </figure>
                    <a href="shop.php">
                        <h4 class="text-center" style="font-weight: 600;">DRESSES</h4>
                    </a>
                </div>
                <div class="col-md-2 col-6">
                    <figure>
                        <a href="shop.php">
                            <img src="https://sana.superdry.com/COM/homepage/1607426555/75weet/static/mens-jeans_2.jpg" class="img-responsive" alt="mens jeans">
                        </a>
                    </figure>
                    <a href="shop.php">
                        <h4 class="text-center" style="font-weight: 600;">MENS JEANS</h4>
                    </a>
                </div>
                <div class="col-md-2 col-6">
                    <figure>
                        <a href="shop.php">
                            <img src="https://sana.superdry.com/COM/homepage/1607426555/75weet/static/womens-joggers.jpg" class="img-responsive" alt="womens joggers">
                        </a>
                    </figure>
                    <a href="shop.php">
                        <h4 class="text-center" style="font-weight: 600;">WOMENS JOGGERS</h4>
                    </a>
                </div>
                <div class="col-md-2 col-6">
                    <figure>
                        <a href="shop.php">
                            <img src="https://sana.superdry.com/COM/homepage/1607426555/75weet/static/mens-tees_5.jpg" class="img-responsive" alt="mens tees">
                        </a>
                    </figure>
                    <a href="shop.php">
                        <h4 class="text-center" style="font-weight: 600;">MENS TEES</h4>
                    </a>
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
                    <p><a href="mailto:press@lifestlye.com">Contact Our Press Team</a></p>
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