<?php
$title = "Zay Shop - Product Listing Page";
require_once ROOT_PATH . "inc/header.php";
title($title);
check_login();
if (isset($_GET['id']) && isset($_GET['gender'])) {
    $result_0 = id_gender($_GET['id'], $_GET['gender']);
} elseif (isset($_GET['gender'])) {
    $result_0 = gender($_GET['gender']);
} elseif (isset($_GET['id'])) {
    $result_0 = single_category($_GET['id']);
} else {
    $result_0 = getInner('products', 'categories');
}
require_once ROOT_PATH . "inc/nav.php";
require_once ROOT_PATH . "inc/modal.php";
$result1 = getAll('categories');
$result2 = getAll('products');

?>

<!-- Start Content -->
<div class="container py-5">
    <div class="row">

        <div class="col-lg-3">
            <ul class="list-unstyled templatemo-accordion">
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none">
                        Gender
                        <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul class="collapse show list-unstyled pl-3">
                        <li><a class="text-decoration-none" href="<?= url("shop&gender=men") ?>">men</a></li>
                        <li><a class="text-decoration-none" href="<?= url("shop&gender=women") ?>">women</a></li>
                    </ul>
                </li>
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        Categories
                        <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul id="collapseThree" class="collapse list-unstyled pl-3">
                        <?php while ($category = mysqli_fetch_assoc($result1)) : ?>
                            <li><a class="text-decoration-none" href="<?= url("shop&id=" . $category['id']); ?>"><?= $category['name'] ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-inline shop-top-menu pb-3 pt-1">
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none mr-3" href="<?= url("shop"); ?>">All</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none mr-3" href="<?= url("shop&gender=men") ?>">Men's</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none" href="<?= url("shop&gender=women") ?>">Women's</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <?php while ($product = mysqli_fetch_assoc($result_0)): ?>
                    <div class="col-md-4">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="<?= BASE_URL . "public/images/products/" . $product['image'] ?>" alt="<?= $product['title'] ?>">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <?php if (in_wishlist($product['id'], $_SESSION['auth']['id'] ?? null)): ?>
                                            <li><a class="btn btn-success text-white" href="<?= url("wishlist-remove&id=" . $product['id'] . "&index=shop") ?>"><i class="bi bi-heart-fill"></i></a></li>
                                        <?php else: ?>
                                            <li><a class="btn btn-success text-white" href="<?= url("wishlist-add&id=" . $product['id'] . "&index=shop"); ?>"><i class="far fa-heart"></i></a></li>
                                        <?php endif; ?>
                                        <li><a class="btn btn-success text-white mt-2" href="<?= url("single-shop&id=" . $product['id']); ?>"><i class="far fa-eye"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2" href="<?= url("add-to-cart&id=" . $product['id'] . "&index=shop"); ?>"><i class="fas fa-cart-plus"></i></a></li>
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

<!-- Start Brands -->
<section class="bg-light py-5">
    <div class="container my-4">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Our Brands</h1>
                <p>
                    At Zay Shop, we take pride in offering a diverse selection of trusted and globally recognized brands.
                </p>
            </div>
            <div class="col-lg-9 m-auto tempaltemo-carousel">
                <div class="row d-flex flex-row">
                    <!--Controls-->
                    <div class="col-1 align-self-center">
                        <a class="h1" href="#multi-item-example" role="button" data-bs-slide="prev">
                            <i class="text-light fas fa-chevron-left"></i>
                        </a>
                    </div>
                    <!--End Controls-->

                    <!--Carousel Wrapper-->
                    <div class="col">
                        <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="multi-item-example" data-bs-ride="carousel">
                            <!--Slides-->
                            <div class="carousel-inner product-links-wap" role="listbox">

                                <!--First slide-->
                                <div class="carousel-item active">
                                    <div class="row">
                                        <?php while ($brand = mysqli_fetch_assoc($result_1)): ?>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="<?php echo BASE_URL . "public/images/brands/" . $brand['image'] ?>" alt="Brand Logo"></a>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                                <!--End First slide-->

                                <!--Second slide-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <?php while ($brand = mysqli_fetch_assoc($result_2)): ?>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="<?php echo BASE_URL . "public/images/brands/" . $brand['image'] ?>" alt="Brand Logo"></a>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                                <!--End Second slide-->

                                <!--Third slide-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <?php while ($brand = mysqli_fetch_assoc($result_3)): ?>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="<?php echo BASE_URL . "public/images/brands/" . $brand['image'] ?>" alt="Brand Logo"></a>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                                <!--End Third slide-->

                            </div>
                            <!--End Slides-->
                        </div>
                    </div>
                    <!--End Carousel Wrapper-->

                    <!--Controls-->
                    <div class="col-1 align-self-center">
                        <a class="h1" href="#multi-item-example" role="button" data-bs-slide="next">
                            <i class="text-light fas fa-chevron-right"></i>
                        </a>
                    </div>
                    <!--End Controls-->
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!--End Brands-->


<?php
require_once ROOT_PATH . "inc/footer.php";
?>