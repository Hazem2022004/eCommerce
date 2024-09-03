<?php
$title = "Zay Shop - Wishlist Page";
require_once ROOT_PATH . "inc/header.php";
title($title);
check_login();
require_once ROOT_PATH . "inc/nav.php";
require_once ROOT_PATH . "inc/modal.php";
?>

<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Wishlist</h1>
        <p>You can see your wishlist here</p>
    </div>
</div>
<div class="container py-5">
    <div class="row">
        <?php if (check_wishlist($_SESSION['auth']['id'])): ?>
            <?php $result = get_wishlist($_SESSION['auth']['id']); ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="col-md-4">
                    <div class="card mb-4 product-wap rounded-0">
                        <div class="card rounded-0">
                            <div class="card rounded-0">
                                <a href="<?= url("single-shop&id=" . $row['product_id']); ?>">
                                    <img src="<?= BASE_URL . "public/images/products/" . $row['image']; ?>" class="card-img-top" alt="<?= $row['title']; ?>">
                                </a>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled d-flex justify-content-between">
                                    <li>
                                        <?php
                                        echo str_repeat('<i class="text-warning fa fa-star"></i>', $row['rating']);
                                        echo str_repeat('<i class="text-muted fa fa-star"></i>', 5 - $row['rating']);
                                        ?>
                                    </li>
                                    <a class="nav-icon text-danger mr-3" href="<?= url("wishlist-remove&id=" . $row['product_id'] . "&index=wishlist") ?>">
                                        <i class="bi bi-heart-fill"></i>
                                    </a>
                                </ul>
                            </div>
                            <div class="card-body ">
                                <a href="<?= url("single-shop&id=" . $row['product_id']); ?>" class="h4 text-decoration-none text-dark">Name :<?= $row['title']; ?></a>
                            </div>
                            <div class="card-body ">
                                <a href="" class="h4 text-decoration-none text-dark">Category :<?= $row['name']; ?></a>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled d-flex justify-content-between">
                                    <p>Price :</p>
                                    <li>$<?= $row['price']; ?></li>
                                </ul>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="<?= url("add-to-cart&id=" . $row['product_id']) . "&index=wishlist" ?>" class="btn btn-primary m-auto" style="border-radius: 35px;"><i class="fas fa-cart-plus"></i> Add To Cart </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <a href="<?= url("add-all-to-cart"); ?>" class="btn btn-success mb-3"><i class="bi bi-bag-fill"></i> Add All To Cart</a>
            <a href="<?= url("shop"); ?>" class="btn btn-success mb-3"><i class="bi bi-bag-fill"></i> Continue Shopping</a>
            <a href="<?= url("clear-wishlist") ?>" class="btn btn-danger mb-3"><i class="bi bi-bag-fill"></i> Clear Wishlist</a>
        <?php else: ?>
            <div class="alert alert-info">Wishlist is Empty</div>
        <?php endif; ?>
    </div>
</div>
<?php
require_once ROOT_PATH . "inc/footer.php";
?>