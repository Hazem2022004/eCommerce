<?php
// $product = GetRow('products', 'categories', $_GET['id']);
// if ($_POST["product-quanity"]) {
//     $cart_item = [
//         'title' => $product['title'],
//         'name' => $product['name'],
//         'price' => $product['price'],
//         'image' => $product['image'],
//         'qty' => $_POST["product-quanity"],
//         'total' => $product['price'],
//         'rating' => $product['rating']
//     ];
// } else {
//     $cart_item = [
//         'title' => $product['title'],
//         'name' => $product['name'],
//         'price' => $product['price'],
//         'image' => $product['image'],
//         'qty' => 1,
//         'total' => $product['price'],
//         'rating' => $product['rating']
//     ];
// }

// $_SESSION['cart'][$product['id']] = $cart_item;
// $_SESSION['added-to-cart'] = "Added To Cart Succesfully";
// redirect("shop");

$user_id = check_login();
if (isset($_GET['index']) && isset($_GET['id'])) {
    $page = $_GET['index'];
    $id = $_GET['id'];
    $user_id = $_SESSION['auth']['id'];
    $sql = "SELECT * FROM `cart` WHERE `product_id` =  $id && `user_id` = $user_id";
    if ($page == "shop" || $page == "wishlist") {
        if (checkid($sql)) {
            $sql = "UPDATE `cart` SET `quantity` = `quantity` + 1 WHERE `product_id` = $id && `user_id` = $user_id";
            mysqli_query($conn, $sql);
        } else {
            add_to_cart($id, 1, $user_id);
        }
        redirect($page);
    } elseif ($page == "single-shop") {
        if (isset($_POST['product-quanity'])) {
            $quantity = $_POST['product-quanity'];
            if (checkid($sql)) {
                $sql = "UPDATE `cart` SET `quantity` = `quantity` + $quantity WHERE `product_id` = $id && `user_id` = $user_id";
                mysqli_query($conn, $sql);
                redirect("single-shop&id=" . $id);
            } else {
                add_to_cart($id, $quantity, $user_id);
                redirect("single-shop&id=" . $id);
            }
        }
    } else {
        redirect("404");
    }
} else {
    redirect("404");
}
