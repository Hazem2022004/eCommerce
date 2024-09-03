<?php
require_once(ROOT_PATH . "src/validations.php");
$conn = mysqli_connect("localhost", "root", "", "zay-store");
$my_sql = "SELECT * FROM `products` WHERE `rating` = 5";
$my_result = mysqli_query($conn, $my_sql);
$sql_1 = "SELECT * FROM `Brands` WHERE `category_id` = 1";
$result_1 = mysqli_query($conn, $sql_1);
$sql_2 = "SELECT * FROM `Brands` WHERE `category_id` = 2";
$result_2 = mysqli_query($conn, $sql_2);
$sql_3 = "SELECT * FROM `Brands` WHERE `category_id` = 3";
$result_3 = mysqli_query($conn, $sql_3);
function getAll($table_name)
{
    global $conn;
    $sql = "SELECT * FROM `$table_name`";
    return mysqli_query($conn, $sql);
}

function getInner($table_name1, $table_name2)
{
    global $conn;
    $sql_4 = "SELECT `$table_name1`.*, `$table_name2`.`name` FROM `$table_name1` INNER JOIN `$table_name2` ON  `$table_name2`.id = `$table_name1`.Category_id";
    return mysqli_query($conn, $sql_4);
}

function checkid($sql)
{
    global $conn;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}
function single_category($id)
{
    global $conn;
    $sql = "SELECT * FROM `categories` WHERE `id` = $id";
    if (checkid($sql)) {
        $sql = "SELECT `products`.*, `categories`.`name` FROM `products` INNER JOIN `categories` ON `products`.`Category_id` = `categories`.`id` WHERE `Category_id` = '$id'";
        return mysqli_query($conn, $sql);
    } else {
        redirect("404");
    }
}
function gender($gender)
{
    global $conn;
    $sql = "SELECT * FROM `products` WHERE `gender` = '$gender'";
    if (checkid($sql)) {
        $sql = "SELECT `products`.*, `categories`.`name` FROM `products` INNER JOIN `categories` ON `products`.`Category_id` = `categories`.`id` WHERE `gender` = '$gender'";
        return mysqli_query($conn, $sql);
    } else {
        redirect("404");
    }
}
function id_gender($id, $gender)
{
    global $conn;
    $sql = "SELECT `products`.*, `categories`.`name` FROM `products` INNER JOIN `categories` ON `products`.`Category_id` = `categories`.`id` WHERE `gender` = '$gender' && `Category_id` = '$id'";
    if (checkid($sql)) {
        return mysqli_query($conn, $sql);
    } else {
        redirect("404");
    }
}
function GetRow($table_name1, $table_name2, $id)
{
    global $conn;
    $sql = "SELECT $table_name1.*, $table_name2.`name` FROM $table_name1 INNER JOIN $table_name2 ON $table_name1.`Category_id` = $table_name2.`id` WHERE $table_name1.`id` = $id";
    $result1 = mysqli_query($conn, $sql);
    if ($result1) {
        return mysqli_fetch_assoc($result1);
    } else {
        echo "Error: " . mysqli_error($conn);
        return false;
    }
}
function Get_prodect($table_name1, $table_name2, $id)
{
    global $conn;
    $sql = "SELECT $table_name1.*, $table_name2.`name` FROM $table_name1 INNER JOIN $table_name2 ON $table_name1.`Category_id` = $table_name2.`id` WHERE $table_name1.`id` = $id";
    if (checkid($sql)) {
        return mysqli_query($conn, $sql);
    } else {
        redirect("404");
    }
}
function GetOne($table_name, $id)
{
    global $conn;
    $sql = "SELECT * FROM $table_name WHERE `id` = $id";
    if (checkid($sql)) {
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result);
    } else {
        redirect("404");
    }
}
function Getuser($id)
{
    global $conn;
    $sql = "SELECT * FROM `users` WHERE `id` = $id";
    if (checkid($sql)) {
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result);
    } else {
        return 0;
    }
}
function change_image($table_name, $id)
{
    global $conn;
    $sql = "UPDATE `$table_name` SET `image` = '01.png' WHERE `id` = $id";
    mysqli_query($conn, $sql);
}

function change_name($table_name, $id, $name)
{
    global $conn;
    $sql = "UPDATE `$table_name` SET `name` = '$name' WHERE `id` = $id";
    mysqli_query($conn, $sql);
}


function change_email($table_name, $id, $email)
{
    global $conn;
    $sql = "UPDATE `$table_name` SET `email` = '$email' WHERE `id` = $id";
    mysqli_query($conn, $sql);
}
function change_phone($table_name, $id, $phone)
{
    global $conn;
    $sql = "UPDATE `$table_name` SET `phone` = '$phone' WHERE `id` = $id";
    mysqli_query($conn, $sql);
}
function change_address($table_name, $id, $address)
{
    global $conn;
    $sql = "UPDATE `$table_name` SET `address` = '$address' WHERE `id` = $id";
    mysqli_query($conn, $sql);
}
function change_password($table_name, $id, $password)
{
    global $conn;
    $sql = "UPDATE `$table_name` SET `password` = '$password' WHERE `id` = $id";
    mysqli_query($conn, $sql);
}
function add_to_cart($id, $quantity, $user_id)
{
    global $conn;
    $sql = "INSERT INTO `cart`(`product_id`, `quantity`, `user_id`) VALUES ($id, $quantity, $user_id)";
    mysqli_query($conn, $sql);
}
function remove_from_cart($id, $user_id)
{
    global $conn;
    $sql = "DELETE FROM `cart` WHERE `product_id` = $id && `user_id` = $user_id";
    mysqli_query($conn, $sql);
}
function clear_cart($user_id)
{
    global $conn;
    $sql = "DELETE FROM `cart` WHERE `user_id` = $user_id";
    mysqli_query($conn, $sql);
}

function get_cart($user_id)
{
    global $conn;
    $sql = "SELECT `cart`.*, `products`.`title`, `products`.`image`, `products`.`price`, `products`.`rating` FROM `cart` 
    INNER JOIN `products` ON `cart`.`product_id` = `products`.`id`
    WHERE `user_id` = $user_id";
    return mysqli_query($conn, $sql);
}

function cart_count($user_id)
{
    global $conn;
    $sql = "SELECT * FROM `cart` WHERE `user_id` = $user_id";
    $result =  mysqli_query($conn, $sql);
    return mysqli_num_rows($result);
}
function Get_User($id)
{
    global $conn;
    $sql = "SELECT * FROM `users` WHERE `id` = $id";
    $result =  mysqli_query($conn, $sql);
    return mysqli_num_rows($result);
}
function add_to_wishlist($id, $user_id)
{
    global $conn;
    $sql = "INSERT INTO `wishlist`(`product_id`, `user_id`) VALUES ($id, $user_id)";
    mysqli_query($conn, $sql);
}

function remove_from_wishlist($id, $user_id)
{
    global $conn;
    $sql = "DELETE FROM `wishlist` WHERE `product_id` = $id && `user_id` = $user_id";
    mysqli_query($conn, $sql);
}
function in_wishlist($id, $user_id)
{
    global $conn;
    $sql = "SELECT * FROM `wishlist` WHERE `product_id` = $id && `user_id` = $user_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        return true;
    } else {
        return false;
    }
}
function check_wishlist($user_id)
{
    global $conn;
    $sql = "SELECT * FROM `wishlist` WHERE `user_id` = $user_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        return true;
    } else {
        return false;
    }
}
function get_wishlist($user_id)
{
    global $conn;
    $sql = "SELECT `wishlist`.*, `products`.`title`, `products`.`image`, `products`.`price`, `products`.`rating`, `categories`.`name` FROM `wishlist` 
    INNER JOIN `products` ON `wishlist`.`product_id` = `products`.`id` 
    INNER JOIN `categories` ON `products`.`Category_id` = `categories`.`id`
    WHERE `user_id` = $user_id";
    return mysqli_query($conn, $sql);
}

function wishlist_count($user_id)
{
    global $conn;
    $sql = "SELECT * FROM `wishlist` WHERE `user_id` = $user_id";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result);
}
function clear_wishlist($user_id)
{
    global $conn;
    $sql = "DELETE FROM `wishlist` WHERE `user_id` = $user_id";
    mysqli_query($conn, $sql);
}
function send_message($name, $email, $subject, $message, $user_id)
{
    global $conn;
    $sql = "INSERT INTO `Messages`(`name`, `subject`, `email`, `message`, `user_id`) VALUES ('$name','$subject','$email','$message','$user_id')";
    mysqli_query($conn, $sql);
}

function Create_Order($user_id, $total_price)
{
    global $conn;
    $sql = "INSERT INTO `orders`(`user_id`, `total_price`) VALUES ($user_id, $total_price)";
    mysqli_query($conn, $sql);
}
function Get_order($user_id)
{
    global $conn;
    $sql = "SELECT `orders`.*, `users`.`name`, `users`.`phone`, `users`.`address` FROM `orders`
    INNER JOIN `users` ON `orders`.`user_id` = `users`.`id`
    WHERE `orders`.`user_id` = $user_id";
    return mysqli_query($conn, $sql);
}

function Clear_Order($user_id, $order_id)
{
    global $conn;
    $sql = "UPDATE `orders` SET `status` = 'cancelled' WHERE `user_id` = $user_id && `id` = $order_id";
    mysqli_query($conn, $sql);
}

function Save_Order($user_id, $order_id)
{
    global $conn;
    $sql = "UPDATE `orders` SET `status` = 'completed' WHERE `user_id` = $user_id && `id` = $order_id";
    mysqli_query($conn, $sql);
}
function Get_All($table_name, $user_id)
{
    global $conn;
    $sql = "SELECT * FROM `$table_name` WHERE `user_id` = $user_id";
    return mysqli_query($conn, $sql);
}

function order_items($order_id)
{
    global $conn;
    $result = Get_All('cart', $_SESSION['auth']['id']);
    while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $user_id = $row['user_id'];
        $sql = "INSERT INTO `order_items`(`order_id`, `product_id`, `quantity`, `user_id`) 
        VALUES ('$order_id', '$product_id', '$quantity', '$user_id')";
        mysqli_query($conn, $sql);
    }
}


function Get_order_items($order_id)
{
    global $conn;
    $sql = "SELECT `order_items`.*, `products`.`title`, `products`.`image`, `products`.`price`, `products`.`rating`, `categories`.`name` FROM `order_items` 
    INNER JOIN `products` ON `order_items`.`product_id` = `products`.`id` 
    INNER JOIN `categories` ON `products`.`Category_id` = `categories`.`id`
    WHERE `order_id` = $order_id";
    return mysqli_query($conn, $sql);
}
function send_newsletter($email)
{
    global $conn;
    $sql = "INSERT INTO `newsletter` (`email`) VALUES ('$email')";
    mysqli_query($conn, $sql);
}

function get_search($search)
{
    global $conn;
    $sql = "SELECT * FROM `products` WHERE `title` LIKE '%$search%'";
    if (checkid($sql)) {
        $sql = "SELECT `products`.*, `categories`.`name` FROM `products` INNER JOIN `categories` ON `products`.`Category_id` = `categories`.`id` WHERE `products`.`title` LIKE '%$search%'";
        return mysqli_query($conn, $sql);
    } else {
        redirect("404");
    }
}
function Get_orders()
{
    global $conn;
    $sql = "SELECT `orders`.`id`, `orders`.`total_price`, `orders`.`status`,`orders`.`created_at`, `users`.`name` FROM `orders`
    INNER JOIN `users` ON `orders`.`user_id` = `users`.`id`";
    return mysqli_query($conn, $sql);
}
function Get_orders_limit()
{
    global $conn;
    $sql = "SELECT `orders`.`id`, `orders`.`total_price`, `orders`.`status`,`orders`.`created_at`, `users`.`name` FROM `orders`
    INNER JOIN `users` ON `orders`.`user_id` = `users`.`id` LIMIT 6";
    return mysqli_query($conn, $sql);
}
function count_rows($table_name)
{
    global $conn;
    $sql = "SELECT * FROM $table_name";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result);
}
function ck_or_id_in_or_items($order_id)
{
    global $conn;
    $sql = "SELECT * FROM `order_items` WHERE `order_id` = $order_id";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result);
}
function add_category($name, $image)
{
    global $conn;
    $sql = "INSERT INTO `categories` (`name`, `image`) VALUES ('$name', '$image')";
    mysqli_query($conn, $sql);
}
function add_product($title, $price, $rating, $review, $description, $gender, $image, $category_id, $brand_id)
{
    global $conn;
    $sql = "INSERT INTO `products` (`title`, `price`, `rating`, `review`, `description`, `gender`, `image`, `category_id`, `brand_id`) 
    VALUES ('$title', '$price', '$rating', '$review', '$description', '$gender', '$image', '$category_id', '$brand_id')";
    mysqli_query($conn, $sql);
}
function delete_product($id)
{
    global $conn;
    $sql = "DELETE FROM `products` WHERE `id` = $id";
    mysqli_query($conn, $sql);
}
function update_product($id, $title, $price, $rating, $review, $description, $gender, $category_id, $brand_id)
{
    global $conn;
    $sql = "UPDATE `products` SET  `title` = '$title', `price` = '$price', `rating` = '$rating', `review` = '$review', `description` = '$description', 
    `gender` = '$gender', `category_id` = '$category_id', `brand_id` = '$brand_id' WHERE `products`.`id` = $id";
    mysqli_query($conn, $sql);
}
function Get_prodect_brand_category($id)
{
    global $conn;
    $sql = "SELECT `products`.*, `categories`.`name`AS `category_name`,`brands`.`name`AS `brand_name` FROM `products` 
    INNER JOIN `categories` ON `products`.`Category_id` = `categories`.`id`
    INNER JOIN `brands` ON `products`.`brand_id` = `brands`.`id`
    WHERE `products`.`id` = $id";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}
