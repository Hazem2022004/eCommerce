<?php
$title = "Zay Shop - Product Detail Page";
require_once ROOT_PATH . "inc/header.php";
title($title);
check_login();
if (isset($_SESSION['auth']['id'])) {
    $row = Get_User($_SESSION['auth']['id']);
    if ($row == 0) {
        redirect("login");
    }
} else {
    redirect("login");
}
require_once ROOT_PATH . "inc/nav.php";
require_once ROOT_PATH . "inc/modal.php";
$product = GetRow('products', 'categories', $_GET['id']);
?>




<!-- Open Content -->
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="card-img img-fluid" src="<?= BASE_URL . "public/images/products/" . $product['image'] ?>" alt="Card image cap" id="product-detail">
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2"><?= $product['title']; ?></h1>
                        <p class="h3 py-2">$<?= $product['price']; ?></p>
                        <p class="py-2">
                            <?php
                            echo str_repeat('<i class="text-warning fa fa-star"></i>', $product['rating']);
                            echo str_repeat('<i class="text-muted fa fa-star"></i>', 5 - $product['rating']);
                            ?>
                            <span class="list-inline-item text-dark">Rating <?= $product['rating'] . " | " . $product['review'] ?> Review</span>
                        </p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Category:</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong><?= $product['name']; ?></strong></p>
                            </li>
                        </ul>

                        <h6>Description:</h6>
                        <p><?= $product['description']; ?></p>
                        <form action="<?= url("add-to-cart&id=" . $product['id'] . "&index=single-shop"); ?>" method="POST">
                            <input type="hidden" name="product-title" value="Activewear">
                            <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item text-right">
                                            Quantity
                                            <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                        </li>
                                        <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                        <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                        <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <button type="submit" class="btn btn-primary" style="border-radius: 35px;">
                                        <i class="fas fa-cart-plus"></i>
                                        Add To Cart
                                    </button>
                                    <a href="#" class="btn btn-primary" style="border-radius: 35px;"><i class="bi bi-bag-fill"></i> Buy Now </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Close Content -->


<?php
require_once ROOT_PATH . "inc/footer.php";
?>
<!-- Start Slider Script -->
<script src="assets/js/slick.min.js"></script>
<script>
    $('#carousel-related-product').slick({
        infinite: true,
        arrows: false,
        slidesToShow: 4,
        slidesToScroll: 3,
        dots: true,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 3
                }
            }
        ]
    });
</script>
<!-- End Slider Script -->
<?php
require_once ROOT_PATH . "inc/footer.php";
unset($_SESSION['success']);
unset($_SESSION['errors']);
?>