<?php
if (isset($_GET['search'])) {
    $search = $_GET['search'];
} else {
    redirect("404");
}
$title = "Zay Shop - $search Page";
require_once ROOT_PATH . "inc/header.php";
title($title);
check_login();
$result_0 = get_search($search);
require_once ROOT_PATH . "inc/nav.php";
require_once ROOT_PATH . "inc/modal.php";
?>

<!-- Start Content -->
<div class="container py-5">
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <?php while ($product = mysqli_fetch_assoc($result_0)): ?>
                    <div class="col-md-4">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="<?= BASE_URL . "public/images/products/" . $product['image'] ?>" alt="<?= $product['title'] ?>">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <?php if (in_wishlist($product['id'], $_SESSION['auth']['id'] ?? null)): ?>
                                            <li><a class="btn btn-success text-white" href="<?= url("wishlist-remove&id=" . $product['id'] . "&index=search") ?>"><i class="bi bi-heart-fill"></i></a></li>
                                        <?php else: ?>
                                            <li><a class="btn btn-success text-white" href="<?= url("wishlist-add&id=" . $product['id'] . "&index=search"); ?>"><i class="far fa-heart"></i></a></li>
                                        <?php endif; ?>
                                        <li><a class="btn btn-success text-white mt-2" href="<?= url("single-shop&id=" . $product['id']); ?>"><i class="far fa-eye"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2" href="<?= url("add-to-cart&id=" . $product['id'] . "&index=search"); ?>"><i class="fas fa-cart-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled d-flex justify-content-between">
                                    <li>
                                        <?php
                                        echo str_repeat('<i class="text-warning fa fa-star"></i>', $product['rating']);
                                        echo str_repeat('<i class="text-muted fa fa-star"></i>', 5 - $product['rating']);
                                        ?>
                                    </li>
                                    <li class="text-muted text-right">$<?= $product['price'] ?></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <a href="<?= url("single-shop&id=" . $product['id']); ?>" class="h2 text-decoration-none text-dark"><?= $product['title'] ?></a>
                                <br>
                                <a href="" class="h4 text-decoration-none text-dark">(<?= $product['name'] ?>)</a>
                                <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                    <li><?= $product['description']; ?></li>
                                    <li class="pt-2">
                                        <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                    </li>
                                </ul>
                                <p class="text-muted">Reviews (<?= $product['review']; ?>)</p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

    </div>
</div>
<!-- End Content -->
<?php
require_once ROOT_PATH . "inc/footer.php";
?>