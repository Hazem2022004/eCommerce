<?php
// checkout page
$title = "Zay Shop - Checkout Page";
require_once(ROOT_PATH . "inc/header.php");
check_login();
require_once(ROOT_PATH . "inc/nav.php");
require_once(ROOT_PATH . "inc/modal.php");
title($title);
if ($_SESSION['auth']['id']) {
    $user_id = $_SESSION['auth']['id'];
    $result = get_cart($user_id);
} else {
    redirect("login");
}
?>

<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Checkout</h1>
    </div>
</div>
<!-- table oreder -->
<div class="container mt-5 mb-5">
    <div class="row">
        <?php if (mysqli_num_rows($result) > 0) : ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Order Details</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="table-primary">
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($product = mysqli_fetch_assoc($result)) : ?>
                                    <tr class="table-secondary">
                                        <td class="table-secondary"><?= $product['title'] ?></td>
                                        <td class="table-primary"><?= $product['quantity'] ?></td>
                                        <td class="table-secondary">$<?= $product['price'] ?></td>
                                        <td class="table-primary">$<?= $product['price'] * $product['quantity'] ?></td>
                                        <td class="table-secondary"><a href="<?= url("cart-remove&id=" . $product['product_id']) . "&index=checkout" ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
                                        <td class="table-secondary"><a href="<?= url("single-shop&id=" . $product['product_id']) ?>" class="btn btn-success"><i class="bi bi-info-circle-fill"></i></a></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <tfoot>
                                <tr class="table-success">
                                    <td colspan="3" class="h3">Total</td>
                                    <td class="h3">$<?= $total = total_price($user_id) ?></td>
                                    <td colspan="2" class="text-center">
                                        <a href="<?= url("clear-cart&index=checkout") ?>" class="btn btn-danger"><i class="bi bi-bag-fill"></i> Clear Cart</a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <a href="<?= url("add-order&total=" . $total); ?>" class="btn btn-success mb-3"><i class="bi bi-bag-fill"></i> Save</a>
                    <a href="<?= url("shop"); ?>" class="btn btn-success mb-3"><i class="bi bi-bag-fill"></i> Continue Shopping</a>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-info">Order is empty</div>
        <?php endif; ?>
    </div>
</div>
<?php
unset($_SESSION['success']);
unset($_SESSION['errors']);
require_once(ROOT_PATH . "inc/footer.php");
?>