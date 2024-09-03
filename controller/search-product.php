<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['search'])) {
        redirect("shop");
    } else {
        $search = $_POST['search'];
        redirect("search&search=" . $search);
    }
} else {
    redirect("404");
}
