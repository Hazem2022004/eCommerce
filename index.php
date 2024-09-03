<?php
if (isset($_SESSION['auth'])) {
    unset($_SESSION['auth']);
}
session_start();
$config = require_once("src/config.php");
require_once ROOT_PATH . "src/db.php";
require_once(ROOT_PATH . "src/functions.php");
// check_login();
if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case "home":
            require_once("view/home.php");
            break;
        case "about":
            require_once("view/about.php");
            break;
        case "contact":
            require_once("view/contact.php");
            break;
        case "login":
            require_once("view/login.php");
            break;
        case "logout":
            require_once("controller/log/logout.php");
            break;
        case "register":
            require_once("view/register.php");
            break;
        case "Do-Login":
            require_once("controller/log/Do-Login.php");
            break;
        case "single-shop":
            require_once("view/single-shop.php");
            break;
        case "shop":
            require_once("view/shop.php");
            break;
        case "send-message":
            require_once("controller/send-message.php");
            break;
        case "add-to-cart":
            require_once("controller/cart/add.php");
            break;
        case "order":
            require_once("model/order.php");
            break;
        case "clear-cart":
            require_once("controller/cart/clear.php");
            break;
        case "store-user":
            require_once("controller/log/store-user.php");
            break;
        case "profile":
            require_once("view/profile.php");
            break;
        case "cart":
            require_once("model/cart.php");
            break;
        case "cart-remove":
            require_once("controller/cart/remove.php");
            break;
        case "update-profile":
            require_once("controller/update/update-profile.php");
            break;
        case "change-password":
            require_once("view/change-password.php");
            break;
        case "update-password":
            require_once("controller/update/update-password.php");
            break;
        case "wishlist":
            require_once("model/wishlist.php");
            break;
        case "wishlist-remove":
            require_once("controller/wishlist/remove.php");
            break;
        case "wishlist-add":
            require_once("controller/wishlist/add.php");
            break;
        case "clear-wishlist":
            require_once("controller/wishlist/clear.php");
            break;
        case "add-order":
            require_once("controller/order/add.php");
            break;
        case "save-order":
            require_once("controller/order/save.php");
            break;
        case "clear-order":
            require_once("controller/order/clear.php");
            break;
        case "checkout":
            require_once("view/checkout.php");
            break;
        case "add-all-to-cart":
            require_once("controller/cart/add-all.php");
            break;
        case "order-details":
            require_once("model/order-details.php");
            break;
        case "newsletter":
            require_once("controller/newsletter.php");
            break;
        case "admin":
            require_once("admin/dashboard.php");
            break;
        case "admin-users":
            require_once("admin/users.php");
            break;
        case "admin-products":
            require_once("admin/products.php");
            break;
        case "admin-orders":
            require_once("admin/orders.php");
            break;
        case "admin-add-product":
            require_once("admin/add-product.php");
            break;
        case "admin-add-category":
            require_once("admin/add-category.php");
            break;
        case "add-category":
            require_once("admin/controller/category/add.php");
            break;
        case "add-product":
            require_once("admin/controller/product/add.php");
            break;
        case "admin-categories":
            require_once("admin/categories.php");
            break;
        case "admin-profile":
            require_once("admin/profile.php");
            break;
        case "admin-edit-product":
            require_once("admin/edit-product.php");
            break;
        case "edit-product":
            require_once("admin/controller/product/edit.php");
            break;
        case "delete-product":
            require_once("admin/controller/product/delete.php");
            break;
        case "search-product":
            require_once("controller/search-product.php");
            break;
        case "search":
            require_once("view/search.php");
            break;
        default:
            require_once("view/404.php");
            break;
    }
} else {
    require_once "view/home.php";
}
