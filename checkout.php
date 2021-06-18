<?php
session_start();
$connection = mysqli_connect('localhost', 'root', '', 'project');
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (sizeof($_SESSION['shopping_cart']) == 0) {
    header("Location: shop.php");
}

if (isset($_SESSION['email'])) {

    $curr_email = $_SESSION['email'];
    $user_data = "SELECT * FROM `project`.`users` WHERE email='$curr_email'";
    $row = mysqli_query($connection, $user_data);
    $user = mysqli_fetch_assoc($row);
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/detailsStyle.css">
    <script src="https://kit.fontawesome.com/0fe497d812.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="validation.js"></script>

    <title>Lifestyle | Checkout</title>

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

    <!--Main layout-->
    <main class="mt-5 pt-4">
        <div class="container wow fadeIn">

            <h2 class="my-5 h2 text-center">Checkout</h2>

            <div class="row">

                <div class="col-md-8 mb-4">

                    <div class="card">
                        <form class="card-body" action="ordercomplete.php" method="POST">

                            <div class="row">

                                <div class="col-md-6 mb-2">
                                   

                                    <div class="md-form ">
                                        <label for="firstName">First name</label>
                                        <?php if (isset($_SESSION['email'])) {
                                        ?>
                                            <input type="text" class="form-control" name="fname" id="first_name" required value="<?php echo $user['firstname']; ?>">
                                        <?php } else {
                                        ?>
                                            <input type="text" class="form-control" name="fname" id="first_name" placeholder="First Name" required placeholder="First Name">
                                        <?php } ?>
                                    </div>

                                </div>

                                <div class="col-md-6 mb-2">

                                    <div class="md-form">
                                        <label for="lastName">Last name</label>
                                        <?php if (isset($_SESSION['email'])) {
                                        ?>
                                            <input type="text" class="form-control" name="lname" id="last_name" required value="<?php echo $user['lastname']; ?>">
                                        <?php } else {
                                        ?>
                                            <input type="text" class="form-control" name="lname" id="last_name" placeholder="Last Name" required placeholder="First Name">
                                        <?php } ?>
                                    </div>

                                </div>
                            </div>

                            <div class="md-form mb-5">
                                <label for="email">Email</label>
                                <?php if (isset($_SESSION['email'])) {
                                ?>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" onkeyup="validate(this)" required value="<?php echo $user['email']; ?>">
                                <?php
                                } else {
                                ?>
                                    <input type="email" name="email" class="form-control" required id="email" aria-describedby="email" placeholder="Email">
                                <?php
                                }
                                ?>
                            </div>

                            <div class="md-form mb-5">
                                <label for="address" >Address</label>
                                <?php if (isset($_SESSION['email'])) {
                                ?>
                                    <input type="text" class="form-control" name="address" id="address" required value="<?php echo $user['address']; ?>">
                                <?php } else {
                                ?>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>
                                <?php } ?>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-4 col-md-6 mb-4">
                                    <?php if (isset($_SESSION['email'])) {
                                    ?>
                                        <input type="text" class="form-control" name="city" id="city" required aria-describedby="city" value="<?php echo $user['city']; ?>">
                                    <?php } else {
                                    ?>
                                        <input type="text" class="form-control" name="city" id="city" required aria-describedby="city" placeholder="City">
                                    <?php } ?>
                                </div>
                                <div class="form-group col-lg-4 col-md-6 mb-4">
                                    <select id="inputState" name="state" class="form-control form-style" required>
                                        <option value="" selected>State</option>
                                        <option value="Federal">Federal</option>
                                        <option value="Punjab">Punjab</option>
                                        <option value="Sindh">Sindh</option>
                                        <option value="KPK">KPK</option>
                                        <option value="Balochistan">Balochistan</option>
                                        <option value="GB">GB</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-4 col-md-6 mb-4">
                                    <?php if (isset($_SESSION['email'])) {
                                    ?>
                                        <input type="text" class="form-control" id="postalcode" name="postalcode" placeholder="Postal Code" onkeyup="validate(this)" required value="<?php echo $user['postalcode']; ?>">

                                    <?php } else {
                                    ?>
                                        <input type="text" class="form-control" id="postalcode" name="postalcode" placeholder="Postal Code" onkeyup="validate(this)" required>

                                    <?php } ?>
                                    <p class="error">Postal code must be a number</p>
                                </div>
                            </div>

                            <div class="md-form mb-5">
                                <label for="telephone">Phone</label>
                                <?php if (isset($_SESSION['email'])) {
                                ?>
                                    <input type="text" class="form-control" name="telephone" id="contact" placeholder="Contact No." onkeyup="validate(this)" required value="<?php echo $user['phone']; ?>">
                                <?php } else {
                                ?>

                                    <input type="text" class="form-control" name="telephone" id="contact" placeholder="Contact No." onkeyup="validate(this)" required>
                                <?php } ?>
                                <p class="error">Contact number must be a valid Pakistani 11 digit cell number e.g 03xx xxxxxxx</p>
                            </div>
                            <hr>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Confirm Order</button>

                    </form>


                </div>

                <div class="col-md-4 mb-4">

                    <!-- Heading -->
                    <h3 class="d-flex justify-content-between align-items-center mb-3">
                        <span>Your cart</span>
                        <span class="badge badge-danger badge-pill"><?php echo sizeof($_SESSION['shopping_cart']); ?></span>
                    </h3>

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
                        $total += $_SESSION['quantity'][$i] * $row['price'];
                    ?>
                        <!-- Cart -->
                        <ul class="list-group mb-3 z-depth-1">
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h5 class="my-0"><?php echo $row['name'] ?></h5>
                                    <small class="text-muted">
                                        <?php echo $row['category']; ?>-<?php echo $row['type']; ?>
                                    </small>
                                </div>
                                <span>$<?php echo $_SESSION['quantity'][$i] * $row['price']; ?></span>
                            </li>
                        <?php
                    }
                        ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>Total</strong></span>
                            <strong>$<?php echo $total; ?></strong>
                        </li>
                        </ul>

                </div>
            </div>

        </div>
    </main>

    <!--FOOTER -->
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
</body>

</html>