<?php
session_start();
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $size = $_POST['size'];
}


if (!isset($_SESSION['shopping_cart']) ) {
    $_SESSION['shopping_cart'] = array();
}
if (!isset($_SESSION['quantity']) ) {
    $_SESSION['quantity'] = array();
}
if (!isset($_SESSION['size']) ) {
    $_SESSION['size'] = array();
}

$check = true;
for ($i = 0; $i < sizeof($_SESSION['shopping_cart']); $i++) {
    if ($_SESSION['shopping_cart'][$i] == $id) {
        $check = false;
    }
}

if ($check) {
    array_push($_SESSION['shopping_cart'], $id);
    
}

if ($check) {
    array_push($_SESSION['quantity'], $quantity);

}

if ($check) {
    array_push($_SESSION['size'], $size);

}

    header("Location:product.php?id=$id");
?>
