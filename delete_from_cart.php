<?php
session_start();
$connection = mysqli_connect('localhost', 'root', '', 'project');
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['index'])) {
    $index=$_GET['index'];
    $a=$_SESSION['shopping_cart'][$index];
    $b=$_SESSION['quantity'][$index];
    $c=$_SESSION['size'][$index];


    $arr1 = $_SESSION['shopping_cart'];
    $arr2 = $_SESSION['quantity'];
    $arr3 = $_SESSION['size'];
    $_SESSION['shopping_cart'] = array();
    $_SESSION['quantity'] = array();
    $_SESSION['size'] = array();


    for($i =0; $i < sizeof($arr1); $i++){
        if($i!=$index){
            $_SESSION['shopping_cart'][$i]=$arr1[$i];
            $_SESSION['quantity'][$i]= $arr2[$i];
            $_SESSION['size'][$i] = $arr3[$i];
        }
    }

    header("Location: cart.php");
}

?>