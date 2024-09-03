<?php
if (isset($_GET['id']) && isset($_GET['index'])) {
    $id = $_GET['id'];
    remove_from_cart($id, $_SESSION['auth']['id']);
    redirect($_GET['index']);
} else {
    redirect("404");
}
