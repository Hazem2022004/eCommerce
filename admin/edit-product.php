<?php
check_login();
if (isset($_GET['id']) && $_GET['product_id']) {
    $id = $_GET['id'];
    $product_id = $_GET['product_id'];
} else {
    redirect("404");
}
$product = Get_prodect_brand_category($product_id);
$brands = GetAll('brands');
$category = GetAll('categories');
require_once(ROOT_PATH . "admin/inc/head.php");
require_once(ROOT_PATH . "admin/inc/nav.php");
?>
<br><br>
<div class="container-fluid bg-light py-5">
    <div class="col-md-12">
        <div class="col-md-6 m-auto text-center">
            <h1 class="h1">Edit Product</h1>
        </div>
    </div>
</div>
<div class="container py-5">
    <div class="row py-5">
        <div class="col-md-6 m-auto">
            <form class="row g-3" action="<?= url("edit-product&id=" . $product_id . "&image=" . $product['image']) ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= $product['title'] ?>">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price" id="price" class="form-control" value="<?= $product['price'] ?>">
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="text" name="rating" id="rating" class="form-control" value="<?= $product['rating'] ?>">
                </div>
                <div class="form-group">
                    <label for="review">Review</label>
                    <input type="text" name="review" id="review" class="form-control" value="<?= $product['review'] ?>">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" class="form-control" value="<?= $product['description'] ?>">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Gender</label>
                    <select class="form-select" aria-label="Default select example" id="inputState" class="form-select" name="Gender">
                        <?php if ($product['gender'] == "men") : ?>
                            <option value="Men"><?= $product['gender'] ?></option>
                            <option value="Women">Women</option>
                        <?php else : ?>
                            <option value="Women"><?= $product['gender'] ?></option>
                            <option value="Men">Men</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Category</label>
                    <select class="form-select" aria-label="Default select example" id="inputState" class="form-select" name="name_category">
                        <option selected value="<?= $product['category_id'] ?>"><?= $product['category_name'] ?></option>
                        <?php while ($row = mysqli_fetch_assoc($category)) : ?>
                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Brand</label>
                    <select class="form-select" aria-label="Default select example" id="inputState" class="form-select" name="name_brand">
                        <option selected value="<?= $product['brand_id'] ?>"><?= $product['brand_name'] ?></option>
                        <?php while ($row = mysqli_fetch_assoc($brands)) : ?>
                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control" value="<?= $product['image'] ?>">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
unset($_SESSION['errors']);
unset($_SESSION['success']);
require_once(ROOT_PATH . "admin/inc/footer.php");
?>