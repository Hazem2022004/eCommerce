<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    delete_product($id);
    redirect("admin-products&id=" . $_SESSION['auth']['id']);
} else {
    redirect("404");
}
