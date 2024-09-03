<?php
// checkout page
$title = "Zay Shop - Order Details";
require_once(ROOT_PATH . "inc/header.php");
check_login();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result_0 = Get_order_items($_GET['id']);
    $order = GetOne('orders', $_GET['id']);
} else {
    redirect("404");
}
require_once(ROOT_PATH . "inc/nav.php");
require_once(ROOT_PATH . "inc/modal.php");
title($title);

?>

<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Order Details</h1>
    </div>
</div>
<!-- table oreder -->
<div class="container py-5">
    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result_0)) : ?>
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
                                <?php if (in_wishlist($row['product_id'], $_SESSION['auth']['id'])): ?>
                                    <a class="nav-icon text-danger mr-3" href="<?= url("wishlist-remove&id=" . $row['product_id'] . "&index=order-details&order_id=" . $_GET['id']) ?>">
                                        <i class="bi bi-heart-fill"></i>
                                    </a>
                                <?php else: ?>
                                    <a class="nav-icon text-danger mr-3" href="<?= url("wishlist-add&id=" . $row['product_id'] . "&index=order-details&order_id=" . $_GET['id']); ?>">
                                        <i class="far fa-heart"></i>
                                    </a>
                                <?php endif; ?>
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
                                <li>Quantity :(<?= $row['quantity'] ?>)</li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <p>Price :</p>
                                <li>$<?= $row['price'] ?></li>
                                <p>Total Price :</p>
                                <li>$<?= $row['price'] * $row['quantity']; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <div class="btn btn-success mb-3"><i class="bi bi-bag-fill"></i> Total Price : $<?= $order['total_price'] ?></div>
    </div>
</div>
<?php
require_once(ROOT_PATH . "inc/footer.php");
?>