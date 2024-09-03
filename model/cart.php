<?php
$title = "Zay Shop - Cards Page";
require_once ROOT_PATH . "inc/header.php";
title($title);
check_login();
require_once ROOT_PATH . "inc/nav.php";
require_once ROOT_PATH . "inc/modal.php";
if ($_SESSION['auth']['id']) {
    $user_id = $_SESSION['auth']['id'];
    $result = get_cart($user_id);
} else {
    redirect("login");
}
?>
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Shopping Cart</h1>
    </div>
</div>
<div class="container py-5">
    <div class="row">
        <?php if (mysqli_num_rows($result)): ?>
            <?php while ($cart = mysqli_fetch_assoc($result)) : ?>
                <div class="col-md-4">
                    <div class="card mb-4 product-wap rounded-0">
                        <div class="card rounded-0">
                            <div class="card rounded-0">
                                <a href="<?= url("single-shop&id=" . $cart['product_id']); ?>">
                                    <img src="<?= BASE_URL . "public/images/products/" . $cart['image']; ?>" class="card-img-top" alt="<?= $cart['title']; ?>">
                                </a>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled d-flex justify-content-between">
                                    <li>
                                        <?php
                                        echo str_repeat('<i class="text-warning fa fa-star"></i>', $cart['rating']);
                                        echo str_repeat('<i class="text-muted fa fa-star"></i>', 5 - $cart['rating']);
                                        ?>
                                    </li>
                                    <?php if (in_wishlist($cart['product_id'], $_SESSION['auth']['id'])): ?>
                                        <a class="nav-icon text-danger mr-3" href="<?= url("wishlist-remove&id=" . $cart['product_id'] . "&index=cart") ?>">
                                            <i class="bi bi-heart-fill"></i>
                                        </a>
                                    <?php else: ?>
                                        <a class="nav-icon text-danger mr-3" href="<?= url("wishlist-add&id=" . $cart['product_id'] . "&index=cart"); ?>">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="card-body ">
                                <a href="" class="h4 text-decoration-none text-dark">Name :<?= $cart['title']; ?></a>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled d-flex justify-content-between">
                                    <li>Quantity :(<?= $cart['quantity'] ?>)</li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled d-flex justify-content-between">
                                    <p>Price :</p>
                                    <li>$<?= $cart['price'] ?></li>
                                    <p>Total Price :</p>
                                    <li>$<?= $cart['price'] * $cart['quantity']; ?></li>
                                </ul>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="<?= url("cart-remove&id=" . $cart['product_id']) . "&index=cart" ?>" class="btn btn-primary m-auto" style="border-radius: 35px;"><i class="bi bi-cart-dash-fill"></i> Remove From Cart </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <div class="btn btn-success mb-3"><i class="bi bi-bag-fill"></i> Total Price : $<?= total_price($_SESSION['auth']['id']); ?></div>
            <a href="<?= url("checkout"); ?>" class="btn btn-success mb-3"><i class="bi bi-bag-fill"></i> Checkout</a>
            <a href="<?= url("shop"); ?>" class="btn btn-success mb-3"><i class="bi bi-bag-fill"></i> Continue Shopping</a>
            <a href="<?= url("clear-cart&index=cart") ?>" class="btn btn-danger mb-3"><i class="bi bi-bag-fill"></i> Clear Cart</a>
        <?php else: ?>
            <div class="alert alert-info">Cart is Empty</div>
        <?php endif; ?>
    </div>
</div>
<?php
require_once ROOT_PATH . "inc/footer.php";
?>