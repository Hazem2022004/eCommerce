<?php
check_login();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    redirect("404");
}
$result = getInner('products', 'categories');
require_once(ROOT_PATH . "admin/inc/head.php");
require_once(ROOT_PATH . "admin/inc/nav.php");
?>


<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Products</h1>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr class="table">
                    <th scope="col" class="table-primary">Name</th>
                    <th scope="col" class="table-primary">Description</th>
                    <th scope="col" class="table-secondary">Price</th>
                    <th scope="col" class="table-secondary">Category</th>
                    <th scope="col" class="table-secondary">Image</th>
                    <th scope="col" class="table-secondary">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($product = mysqli_fetch_assoc($result)) : ?>
                    <tr class="text-center">
                        <td class="table-secondary"><?= $product['title'] ?></td>
                        <td class="table-primary"><?= $product['description'] ?></td>
                        <td class="table-secondary"><?= $product['price'] ?></td>
                        <td class="table-primary"><?= $product['name'] ?></td>
                        <td class="table-secondary">
                            <img src="<?= BASE_URL . "public/images/products/" . $product['image'] ?>" alt="<?= $product['title'] ?>" class="rounded-circle img-fluid border" width="150px" height="150px">
                        </td>
                        <td class="table-primary">
                            <a href="<?= url("admin-edit-product&id=" . $id . "&product_id=" . $product['id']) ?>" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                            <a href="<?= url("delete-product&id=" . $product['id']) ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</div>






<?php require_once(ROOT_PATH . "admin/inc/footer.php"); ?>