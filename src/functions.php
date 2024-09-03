<?php

function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

function url($path)
{
    return BASE_URL . "index.php?page=" . $path;
}

function redirect($path)
{
    header("Location: " . url($path));
}

function GetSession($session)
{
    return $_SESSION[$session] ?? false;
}
function sql()
{
    global $conn;
    $sql = "SELECT * FROM `products` LIMIT 6";
    return mysqli_query($conn, $sql);
}

function check_login()
{
    if (isset($_SESSION['auth']['id'])) {
        $user_id = $_SESSION['auth']['id'];
        $row = Get_User($user_id);
        if ($row == 0) {
            redirect("login");
        }
    } else {
        redirect("login");
    }
    return $user_id;
}
function total_price($user_id)
{
    global $conn;
    $sql = "SELECT SUM(`products`.`price` * `cart`.`quantity`) FROM `products` 
    INNER JOIN `cart` ON `products`.`id` = `cart`.`product_id` WHERE `user_id` = $user_id";
    $total_price = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($total_price)['SUM(`products`.`price` * `cart`.`quantity`)'];
}
function order_count($user_id)
{
    global $conn;
    $sql = "SELECT * FROM `orders` WHERE `user_id` = $user_id";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result);
}
