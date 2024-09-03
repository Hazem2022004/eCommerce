<?php
$title = "Zay Shop eCommerce HTML CSS Template";
require_once ROOT_PATH . "inc/header.php";
check_login();
require_once ROOT_PATH . "inc/nav.php";
require_once ROOT_PATH . "inc/modal.php";
title($title);
$result = getAll('Sliders');
$result1 = getAll('categories');
?>




<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <?php $i = 0; ?>
        <?php while ($Slider = mysqli_fetch_assoc($result)) : ?>
            <div class="carousel-item <?php if ($i == 0) echo "active";
                                        $i++; ?>">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="<?= BASE_URL . "public/images/slider/" . $Slider['image']; ?>" alt="<?= $Slider['title']; ?>">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-success"><?= $Slider['title']; ?></h1>
                                <h3 class="h2"><?= $Slider['sub_title']; ?></h3>
                                <p>
                                    <?= $Slider['description']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- End Banner Hero -->
<!-- Start Categories of The Month -->
<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Categories of The Month</h1>
            <p>
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum.
            </p>
        </div>
    </div>
    <div class="row">
        <?php while ($category = mysqli_fetch_assoc($result1)) : ?>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="<?= url("shop&id=" . $category['id']); ?>"><img src="<?= BASE_URL . "public/images/categories/" . $category['image']; ?>" alt="<?= $category['name'] ?>" class="rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3"><?php echo $category['name'] ?></h5>
                <p class="text-center"><a class="btn btn-success" href="<?= url("shop&id=" . $category['id']); ?>">Go Shop</a></p>
            </div>
        <?php endwhile; ?>
    </div>
</section>
<!-- End Categories of The Month -->

<!-- Start Featured Product -->
<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Featured Product</h1>
                <p>
                    Reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident.
                </p>
            </div>
        </div>
        <div class="row">
            <?php while ($product = mysqli_fetch_assoc($my_result)): ?>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="<?= url("single-shop&id=" . $product['id']); ?>">
                            <img src="<?= BASE_URL . "public/images/products/" . $product['image'] ?>" class="card-img-top" alt="<?= $product['title'] ?>">
                        </a>
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
                            <a href="shop-single.html" class="h2 text-decoration-none text-dark"><?= $product['title'] ?></a>
                            <p class="card-text"><?= $product['description']; ?></p>
                            <p class="text-muted">Reviews (<?= $product['review']; ?>)</p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<!-- End Featured Product -->
<?php require_once ROOT_PATH . "inc/footer.php"; ?>