<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
}


$validation = array();
$success = "";

$connection = mysqli_connect('localhost', 'root', '', 'project');
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$curr_email = $_SESSION['email'];
$user_data = "SELECT * FROM `project`.`users` WHERE email='$curr_email'";
$row = mysqli_query($connection, $user_data);
$user = mysqli_fetch_assoc($row);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = mysqli_real_escape_string($connection, $_POST['fname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['lname']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password1 = mysqli_real_escape_string($connection, $_POST['password']);
    $password2 = mysqli_real_escape_string($connection, $_POST['password_2']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $city = mysqli_real_escape_string($connection, $_POST['city']);
    $state = mysqli_real_escape_string($connection, $_POST['state']);
    $postalcode = mysqli_real_escape_string($connection, $_POST['postalcode']);
    $phone = mysqli_real_escape_string($connection, $_POST['telephone']);

    if ($email === $user['email'] && $email != $curr_email) {
        array_push($validation, "This email has already been used.");
    }

    if (count($validation) == 0) {
        $password = md5($password1);
        $query = "UPDATE `project`.`users` SET `firstname`='$firstname', `lastname`= '$lastname',`email`= '$email', `password`='$password',`address`= '$address',`city`= '$city',`state`= '$state',`postalcode`= '$postalcode',`phone`= '$phone' WHERE `email`='$curr_email'";
        if (mysqli_query($connection, $query)) {
            $_SESSION['email'] = $email;
            $success = "Changes saved successfully!";
        }
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/userStyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/0fe497d812.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="validation.js"></script>

    <title>Lifestyle | Account Management</title>
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
                                    SALES</p>
                            </a>
                </div>

                <div class="col-md-5 col-8 d-flex justify-content-md-end justify-content-end order-md-3 order-2 mt-4">
                    

                    <?php
                    if (isset($_SESSION['loggedin'])) {
                        echo '<p class="mr-3"><a href="user.php"><span class="d-none d-md-block">MY ACCOUNT</span><i class="far fa-user mt-1 d-block d-md-none"></i></a></p>';
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


    <hr>


    <div class="container bootstrap snippet">
        <div class="row">
            <div class="col mb-5">
                <h1>Profile</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#changeDetails">Change Details</a></li>
                    <li><a data-toggle="tab" href="#info">Info</a></li>
                </ul>
            </div>
        </div>

        <div class="tab-content">
            <div class="tab-pane active" id="changeDetails">
                <hr>

                <?php
                echo "<p style='font-weight: bold;color: #008a37; font-size: 2.2rem; font-family: sans-serif;'>$success</p>";
                foreach ($validation as $value) {
                    echo "<p style='font-weight: bold; color: rgb(230, 44, 44);font-size: 2.2rem;font-family: sans-serif;''>" . $value . "</p>";
                }
                ?>
                <form class="form" method="post" id="myForm">
                    <div class="form-group">

                        <div class="col-md-6 col-12">
                            <label for="first_name">
                                <h4>First Name</h4>
                            </label>
                            <input type="text" class="form-control" name="fname" id="first_name" placeholder="First Name" required value="<?php echo $user['firstname']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-12">
                            <label for="last_name">
                                <h4>Last name</h4>
                            </label>
                            <input type="text" class="form-control" name="lname" id="last_name" placeholder="Last Name" required value="<?php echo $user['lastname']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-12">
                            <label for="contact">
                                <h4>Contact</h4>
                            </label>
                            <input type="text" class="form-control" name="telephone" id="contact" placeholder="Contact No." onkeyup="validate(this)" required value="<?php echo $user['phone']; ?>">
                            <p class="error">Contact number must be a valid Pakistani 11 digit cell number e.g 03xx xxxxxxx</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-12">
                            <label for="email">
                                <h4>Email</h4>
                            </label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" onkeyup="validate(this)" required value="<?php echo $user['email']; ?>">
                            <p class="error">Email must be a valid address e.g. me@mydomain.com</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-12">
                            <label for="address">
                                <h4>Address</h4>
                            </label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" required value="<?php echo $user['address']; ?>">

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-12">
                            <label for="city">
                                <h4>City</h4>
                            </label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="City" required value="<?php echo $user['city']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-12">
                            <label for="state">
                                <h4>State</h4>
                            </label>
                            <select id="inputState" name="state" class="form-control form-style" required>
                                <option value="<?php echo $user['state']; ?>" selected><?php echo $user['state']; ?></option>
                                <option value="Federal">Federal</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Sindh">Sindh</option>
                                <option value="KPK">KPK</option>
                                <option value="Balochistan">Balochistan</option>
                                <option value="GB">GB</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-12">
                            <label for="zip">
                                <h4>Postal Code</h4>
                            </label>
                            <input type="text" class="form-control" id="postalcode" name="postalcode" placeholder="Postal Code" onkeyup="validate(this)" required value="<?php echo $user['postalcode']; ?>">
                            <p class="error">Postal code must be a number</p>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-12">
                            <label for="password_1">
                                <h4>Password</h4>
                            </label>
                            <input type="password" class="form-control" name="password" id="password_1" placeholder="Password" onkeyup="validate(this); validatePassword()" required>
                            <p class="error mb-5">Password must contain alpha-numeric and be 8 - 20 characters long</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-12">
                            <label for="password_2">
                                <h4>Re-enter Password</h4>
                            </label>
                            <input type="password" name="password_2" class="form-control" id="password_2" placeholder="Re-enter Password" required onkeyup="validatePassword()">
                            <p class="error mb-5">Passwords do not match</p>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col">
                            <button id="submit" type="submit" name="submit" class="btn btn-primary mb-5 mx-4">Save</button>
                            <a href="main.php" class="btn btn-primary mb-5" role="button" aria-pressed="true">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>


            <div class="tab-pane mb-5 h-50" id="info">
                <hr>

                <div class="col-md-6 col-12">
                    <h4 class="font-weight-bold">First Name</h4>
                    <h4><?php echo $user['firstname']; ?></h4>

                </div>


                <div class="col-md-6 col-12">
                    <h4 class="font-weight-bold">Last name</h4>
                    <h4><?php echo $user['lastname']; ?></h4>
                </div>



                <div class="col-md-6 col-12">

                    <h4 class="font-weight-bold">Contact</h4>
                    <h4><?php echo $user['phone']; ?></h4>
                </div>



                <div class="col-md-6 col-12">
                    <h4 class="font-weight-bold">Email</h4>
                    <h4><?php echo $user['email']; ?></h4>
                </div>


                <div class="col-md-6 col-12">
                    <h4 class="font-weight-bold">Address</h4>
                    <h4><?php echo $user['address']; ?></h4>
                </div>

                <div class="col-md-6 col-12">
                    <h4 class="font-weight-bold">City</h4>
                    <h4><?php echo $user['city']; ?></h4>
                </div>

                <div class="col-md-6 col-12 mb-5">
                    <h4 class="font-weight-bold">State</h4>
                    <h4><?php echo $user['state']; ?></h4>
                </div>


                <div class="col-md-6 col-12 mb-5">
                    <h4 class="font-weight-bold">Postal Code</h4>
                    <h4><?php echo $user['postalcode']; ?></h4>
                </div>
                <hr>
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


        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(".file-upload").on('change', function() {
            readURL(this);
        });
    });

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