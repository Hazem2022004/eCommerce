<?php
$title = "Zay Shop - Order Page";
require_once(ROOT_PATH . "inc/header.php");
check_login();
require_once(ROOT_PATH . "inc/nav.php");
require_once(ROOT_PATH . "inc/modal.php");
title($title);
$result = Get_order($_SESSION['auth']['id']);
?>
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Order</h1>
    </div>
</div>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Order Details</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-primary text-center">
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Confirm or Clear</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($order = mysqli_fetch_assoc($result)) : ?>
                                <?php if (ck_or_id_in_or_items($order['id']) == 0): ?>
                                    <?php order_items($order['id']); ?>
                                <?php endif; ?>
                                <tr class="table-secondary">
                                    <td class="table-secondary"><?= $order['name'] ?></td>
                                    <td class="table-primary"><?= $order['phone'] ?></td>
                                    <td class="table-secondary"><?= $order['address'] ?></td>
                                    <td class="table-primary">$<?= $order['total_price'] ?></td>
                                    <td class="table-secondary"><?= $order['status'] ?></td>
                                    <td class="table-primary"><?= $order['created_at'] ?></td>
                                    <?php if ($order['status'] == "pending") : ?>
                                        <td class="table-secondary text-center">
                                            <a href="<?= url("save-order&id=" . $order['id']); ?>" class="btn btn-success"><i class="bi bi-check-circle h4"></i></a>
                                            <a href="<?= url("clear-order&id=" . $order['id']); ?>" class="btn btn-danger"><i class="bi bi-x-circle h4"></i></a>
                                        </td>
                                    <?php elseif ($order['status'] == "completed") : ?>
                                        <td class="table-secondary text-center"><a class="btn btn-success"><i class="bi bi-check-circle h4"></i></a></td>
                                    <?php elseif ($order['status'] == "cancelled"): ?>
                                        <td class="table-secondary text-center"><a class="btn btn-danger"><i class="bi bi-x-circle h4"></i></a></td>
                                    <?php endif; ?>
                                    <td class="table-secondary text-center"><a href="<?= url("order-details&id=" . $order['id']); ?>" class="btn btn-primary"><i class="bi bi-eye-fill h4"></i></a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <a href="<?= url("shop"); ?>" class="btn btn-success mb-3"><i class="bi bi-bag-fill"></i> Continue Shopping</a>
            </div>
        </div>
    </div>
</div>
<?php
unset($_SESSION['success']);
unset($_SESSION['errors']);
require_once(ROOT_PATH . "inc/footer.php");
?>