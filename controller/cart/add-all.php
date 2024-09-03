<?php
$result = getAll('wishlist');
$user_id = check_login();
while ($product = mysqli_fetch_assoc($result)) {
    $product_id = $product['product_id'];
    $sql = "SELECT * FROM `cart` WHERE `product_id` = $product_id && `user_id` = $user_id";
    if (checkid($sql)) {
        $sql = "UPDATE `cart` SET `quantity` = `quantity` + 1 WHERE `product_id` = $product_id && `user_id` = $user_id";
        mysqli_query($conn, $sql);
    } else {
        add_to_cart($product['product_id'], 1, $user_id);
    }
}
redirect("wishlist");
