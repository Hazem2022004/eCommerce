<?php
clear_cart($_SESSION['auth']['id']);
if (isset($_GET['index'])) {
    redirect($_GET['index']);
}
