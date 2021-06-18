<?php
session_start();
include('db.php');

if(!isset($_SESSION['loggedin'])){
    header ('Location: adminLogin.php');
}

$upload_dir = 'uploads/';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "select * from products where id = " . $id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $image = $row['image'];
        unlink($upload_dir . $image);
        $sql = "delete from products where id=" . $id;
        if (mysqli_query($conn, $sql)) {
            header('location:admin.php');
        }
    }
}
if (isset($_GET['delete_user'])) {
    $id = $_GET['delete_user'];
    $sql = "select * from users where uid = " . $id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $sql = "delete from users where uid=" . $id;
        if (mysqli_query($conn, $sql)) {
            header('location:admin.php');
        }
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/adminStyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/0fe497d812.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="validation.js"></script>
    <title>Lifestyle | Admin</title>
</head>



<body>
    <!-- Navbar -->
    <header>
        <nav id="nav" class="container-fluid">
            <div class="row">
                <div class="col-md-7 col-10">
                    <h2 class="mt-3 ml-md-0 ml-5 d-flex justify-content-md-end justify-content-start pl-md-0 pl-3"><a href="main.php">Lifestyle</a></h2>
                </div>
                <div class="col-md-5 col-2 d-flex justify-content-end mt-4">
                    <p class="mr-3"><a href="logout_admin.php"><span class="d-none d-md-block">LOG OUT</span><i class="far fa-user mt-1 d-block d-md-none"></i></a></p>
                </div>
            </div>
        </nav>
    </header>


    <div class="container bootstrap snippet">
        <div class="row">
            <div class="col-sm-10 mb-5">
                <h1>Admin Panel</h1>
            </div>
        </div>
        <div class="form-group">
		<input type="text" name="search" id="search" placeholder="Search.." onkeyup="search_data()">
	</div>
        <div class="mt-5 ">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#items">Items</a></li>
                <li><a data-toggle="tab" href="#users">Users</a></li>
                <li><a data-toggle="tab" href="#orders">Orders</a></li>

            </ul>


            <div class="tab-content">
                <div class="tab-pane active" id="items">
                    <div class="table-responsive">
                        <table id="example" class="mt-5 table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Color</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql = "select * from products";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result)) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><img src="<?php echo $upload_dir . $row['image'] ?>" height="40"></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['type'] ?></td>
                                            <td><?php echo $row['category'] ?></td>
                                            <td><?php echo $row['description'] ?></td>
                                            <td><?php echo $row['color'] ?></td>
                                            <td><?php echo $row['price'] ?></td>
                                            <td class="text-center">
                                                <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</i></a>
                                                <a href="admin.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Remove</i></a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <a class="btn btn-primary" href="create.php">ADD NEW ITEM</a>
                    </div>
                </div>

                <div class="tab-pane" id="users">
                    <div class="table-responsive">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Name</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Address</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Email Address</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Contact No.</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Remove</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "select * from users";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result)) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['firstname'] . " " . $row['lastname'] ?></td>
                                            <td><?php echo $row['address'] ?></td>
                                            <td><?php echo $row['email'] ?></td>
                                            <td><?php echo $row['phone'] ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-danger" href="admin.php?delete_user=<?php echo $row['uid'] ?>" onclick="return confirm('Are you sure you want to delete this record?')">Remove</i></a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane" id="orders">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Order ID</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Name</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Address</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Email Address</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Items</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Total</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Remove</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-0 align-middle">#1</td>
                                    <td class="border-0 align-middle">XYZ</td>
                                    <td class="border-0 align-middle">43 NW. Rockaway Lane
                                        South Plainfield, NJ 07080</td>
                                    <td class="border-0 align-middle">zimzalabim@rocketmail.com</td>
                                    <td class="border-0 align-middle">Sports Jacket, Wristwtch</td>
                                    <td class="border-0 align-middle">$599.00</td>

                                    <td class="border-0 align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    </div>

    <br>
    <div style="height: 260px;"></div>

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

    function search_data(){
        var search=jQuery('#search').val();
        jQuery.ajax({
            method:'post',
            url:'getData.php',
            data:'search='+search,
            success:function(data){
                jQuery('#example').html(data);
            }
        });	
    }


    // $(document).ready(function() {

    //     var readURL = function(input) {
    //         if (input.files && input.files[0]) {
    //             var reader = new FileReader();

    //             reader.onload = function(e) {
    //                 $('.avatar').attr('src', e.target.result);
    //             }

    //             reader.readAsDataURL(input.files[0]);
    //         }
    //     }

    //     $(".file-upload").on('change', function() {
    //         readURL(this);
    //     });
    // });
</script>

</html>