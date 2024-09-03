<?php
$user_id = $_SESSION['auth']['id'];
if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    Save_Order($user_id, $order_id);
    clear_cart($user_id);
    redirect("order");
} else {
    redirect("404");
}
