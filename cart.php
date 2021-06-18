<?php
session_start();
$connection = mysqli_connect('localhost', 'root', '', 'project');
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
$upload_dir = 'uploads/';

if(!isset($_SESSION['shopping_cart'])){
    header("Location: main.php");
}

if(isset($_POST['proceed_checkout'])){
    $size = sizeof($_SESSION['shopping_cart']);
    for($i=0; $i<$size; $i++){
        $_SESSION['quantity'][$i]=$_POST["quantity$i"];
    }
    header("Location: checkout.php");
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cartStyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/0fe497d812.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Lifestyle | Cart</title>
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

    <div class="mt-5 container">
        <div class="row">
            <div class="col-12">
                <table id="cart" class="table table-responsive table-hover table-condensed">
                    <thead>
                        <tr>
                            <th style="width:25%">Picture</th>
                            <th style="width:25%">Product</th>
                            <th style="width:10%">Price</th>
                            <th style="width:8%">Quantity</th>
                            <th style="width:22%" class="text-center">Subtotal</th>
                            <th style="width:10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        $check = false;
                        for ($i = 0; $i < sizeof($_SESSION['shopping_cart']); $i++) {
                            $id = $_SESSION["shopping_cart"][$i];
                            $sql = "select * from products where id = '$id'";
                            $result = mysqli_query($connection, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $check = true;
                            }

                        ?>
                            <form method="POST">
                                <tr>
                                    <td><img src="<?php echo $upload_dir . $row['image'] ?>" height="40"></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td>$<span id="price<?php echo $i ?>"><?php echo $row['price'] ?></span></td>
                                    <td>
                                        <input type="number" id="quantity<?php echo $i ?>" name="quantity<?php echo $i ?>" class="form-control text-center" min="1" max="20" value="<?php echo $_SESSION['quantity'][$i] ?>" oninput="setPrice(<?php echo $row['price']; ?>,<?php echo $i; ?>,<?php echo sizeof($_SESSION['shopping_cart']) ?>)">
                                    </td>
                                    <td class="text-center" id="subtotal<?php echo $i; ?>"><?php echo $_SESSION['quantity'][$i] * $row['price']; ?></td>
                                    <td class="actions">
                                        <a href="delete_from_cart.php?index=<?php echo $i; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php
                            $total += $_SESSION['quantity'][$i] * $row['price'];
                        }
                            ?>
                            <?php if (!$check) {
                                echo "<tr><td style='width:100%'><h2>NO PRODUCTS IN CART</h2></td></tr>";
                            } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><a href="shop.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                            <td colspan="2" class="hidden-xs"></td>
                            <?php
                            if ($check) {
                                ?>
                            <td class="hidden-xs text-center" id="total"><strong>$<?php echo $total ?></strong></td>
                        
                                <td><button type="submit" name="proceed_checkout" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></button></td>
                            <?php } ?>
                        </tr>

                    </tfoot>
                </table>
                </form>
            </div>
        </div>
    </div>



    <div class="mb-3 mt-5 container">
        <div class="pt-4">
            <h3 class="mb-4">Expected shipping delivery</h5>
                <h4 class="mb-0 font-weight-bold"> 4-5 Days</h4>
        </div>
    </div>
    <div class="mb-3 container">
        <div class="pt-4">
            <h4 class="mb-4 font-weight-bold">We accept</h4>
            <img class="mr-2" width="45px" src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg" alt="Visa">
            <img class="mr-2" width="45px" src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg" alt="American Express">
            <img class="mr-2" width="45px" src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg" alt="Mastercard">
            <img class="mr-2" width="45px" src="https://mdbootstrap.com/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.png" alt="PayPal acceptance mark">
        </div>
    </div>

    <div class="col h-25"></div>

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

    function setPrice(price, index, size) {
        var quan = document.getElementById("quantity" + index).value;
        var subtotal = quan * price;
        document.getElementById("subtotal" + index).innerText = subtotal;
        var total = 0;
        for (var i = 0; i < size; i++) {
            var quantity = document.getElementById("quantity" + i).value;
            var price = document.getElementById("price" + i).innerText;
            total += quantity * price;
        }
        total = "$" + total;
        document.getElementById("total").innerText = total;
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