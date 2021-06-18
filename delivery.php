<?php
session_start();
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
    <link rel="stylesheet" href="css/deliveryStyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/0fe497d812.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Lifestyle | Delivery</title>
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
        <h1 class="font-weight-bold">Delivery Questions</h1>
        <hr>

        <div>
            <h4 class="font-weight-bold">How can I track my order?</h4>
            <p>As soon as your order has been dispatched, you will receive an email to confirm. This email will contain a 'Track My Parcel' link which you can use to track your order.
                <br>
                If your order has been split into more than one parcel, you will receive a seperate dispatch confirmation and tracking link for each parcel sent.
                <br>
                It can take the carrier between 24-48 hours to update the tracking information in their system after you have received the shipping confirmation email. If there is no information displayed in your tracking link, please check again later.
                <br>
                It's a busy time of year and we are noticing that parcels are taking slightly longer to arrive than normal. We therefore ask you to allow 7 days for your order to be delivered from the date that it was placed.
            </p>
            <hr>
            <h4 class="font-weight-bold">How long will my delivery take?</h4>
            <p>We aim to deliver your order as soon as possible. Delivery times are provided at the time of your order on the checkout page, it usually takes 2-3 working days for the parcel to arrive.</p>
            <hr>
            <h4 class="font-weight-bold">Why has my order not been dispatched?</h4>
            <p>This could be because we are currently replenishing our stock. If the item becomes available it will be dispatched as soon as possible and you will receive a confirmation email. If stock is no longer available your order will be cancelled.</p>
            <hr>
            <h4 class="font-weight-bold">What can I do if I have not received a calling card?</h4>
            <p>Please check the tracking information you received by email to see if there are any further details about your parcel.
                <br>
                If your parcel has been left in a secured location, please check your outbuildings, porch, back garden, and with any other residents of your property. It is possible that a neighbour has taken delivery of your parcel and this should be stated on your tracking information.
                <br>
                If you still cannot locate the parcel 24 hours after the tracking shows it has been delivered, please <a href="mailto:care@lifestyle.com"> contact us.</a>
            </p>
            <hr>
            <h4 class="font-weight-bold">Why haven't I received any confirmation emails?</h4>
            <p>All notification emails are sent to the email address that has been used to place the order, if the email address was entered incorrectly you will not receive the email. Please also make sure to check your spam folders of the email address.
                <br>
                If you still have not received any emails please <a href="mailto:care@lifestyle.com"> contact us.</a>
            </p>
            <hr>
            <h4 class="font-weight-bold">Why have I received an item with a different price tag?</h4>
            <p>We run promotions and offers throughout the year on our website and in store, which does mean that the prices of our products can fluctuate. It may be the case that the product has previously been sold at a greater discount as part of a different promotion or sale and the price ticket has not been updated to reflect the current retail price.
                <br>
                We can confirm that the price advertised on the website at the point of sale is the correct price and we do apologise if the price tag states differently. Should this be the case, please email images of the tag and your order number to <a href="mailto:care@lifestyle.com">care@lifestlye.com</a> so that we can take a further look.
            </p>
            <hr>
            <h4 class="font-weight-bold">Why have I received an item without price tags?</h4>
            <p>Items ordered online are often sent without tags, this will not affect your rights to return them within 28 days of delivery.</p>
            <hr>

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