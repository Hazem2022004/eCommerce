<?php
$user_id = check_login();
if (isset($_GET['id']) && isset($_GET['index'])) {
    $id = $_GET['id'];
    $page = $_GET['index'];
    remove_from_wishlist($id, $user_id);
    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        redirect($page . "&id=" . $order_id);
    } else {
        redirect($page);
    }
} else {
    redirect("404");
}
