<?php
$user_id = $_SESSION['auth']['id'];
if (isset($_GET['total'])) {
    $total_price = $_GET['total'];
} else {
    redirect("404");
}
$row = GetOne('users', $user_id);
if (!isset($row['phone']) && !isset($row['address'])) {
    $_SESSION['errors']['update'] = "Please enter your phone number and address first";
    redirect("profile&id=" . $user_id);
} else {
    Create_Order($user_id, $total_price);
    redirect("order");
}
