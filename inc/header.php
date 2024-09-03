<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    function title($title)
    {
        if ($_SERVER['PHP_SELF'] = "/index.php") {
            echo '<title>' . $title . '</title>';
        } elseif ($_SERVER['PHP_SELF'] = "/about.php") {
            echo '<title>' . $title . '</title>';
        } elseif ($_SERVER['PHP_SELF'] = ("/contact.php")) {
            echo '<title>' . $title . '</title>';
        } elseif ($_SERVER['PHP_SELF'] = "/shop.php") {
            echo '<title>' . $title . '</title>';
        } elseif ($_SERVER['PHP_SELF'] = "/shop-single.php") {
            echo '<title>' . $title . '</title>';
        } elseif ($_SERVER['PHP_SELF'] = "/cart.php") {
            echo '<title>' . $title . '</title>';
        } elseif ($_SERVER['PHP_SELF'] =  "/login.php") {
            echo '<title>' . $title . '</title>';
        } elseif ($_SERVER['PHP_SELF'] =  "/register.php") {
            echo '<title>' . $title . '</title>';
        } elseif ($_SERVER['PHP_SELF'] =  "/404.php") {
            echo '<title>' . $title . '</title>';
        }
    }
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <!--
TemplateMo 559 Zay Shop
https://templatemo.com/tm-559-zay-shop
-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <script>
        <?php if ($_SESSION['errors']['update']) : ?>
            alert("<?= $_SESSION['errors']['update']; ?>");
            <?php unset($_SESSION['errors']['update']); ?>
        <?php endif; ?>
    </script>
</head>