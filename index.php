<?php
require_once "autoloader.php";

$db = DB::getInstance();

$action = $_GET['action'] ?? '';

if(!$action && $_SERVER['REQUEST_URI'] == '/') {
    $action = 'index';
}
if($action == 'index') {
    require_once "views/main_page.php";
}
if($action == 'addproduct') {
    require_once "views/add_product.php";
}
elseif ($action == 'submit') {
    $product = new ProductController();
    $product->create();
    require_once "views/main_page.php";
    echo "Product successfully added.";
} elseif ($action == 'order') {
    require_once "views/order_page.php";
    session_start();
    $_SESSION = $_POST;
}
 elseif ($action == 'confirm') {
        $order = new OrderController();
        $order->create();
        session_unset();
        require_once "views/main_page.php";
        echo "Thank you for shopping!!!";
}




