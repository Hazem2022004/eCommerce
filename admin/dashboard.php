<?php
check_login();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    redirect("404");
}
$result = Get_orders_limit();
require_once(ROOT_PATH . "admin/inc/head.php");
require_once(ROOT_PATH . "admin/inc/nav.php");
?>

<div class="container-fluid bg-light py-5">
    <div class="main">
        <div class="box-container">
            <div class="box box1">
                <div class="text">
                    <h2 class="topic-heading"><?= count_rows('users') ?></h2>
                    <h2 class="topic">Users</h2>
                </div>
                <img src="../assets/img/people-fill.svg" alt="Views">
            </div>

            <div class="box box4">
                <div class="text">
                    <h2 class="topic-heading"><?= count_rows('orders') ?></h2>
                    <h2 class="topic">Orders</h2>
                </div>
                <img src="../assets/img/13.png" alt="published">
            </div>
        </div>

        <div class="report-container">
            <div class="report-header">
                <h1 class="recent-Articles">Order Details</h1>
                <?php if (count_rows('orders') > 6): ?>
                    <button class="view"><a href="<?= url("admin-orders&id=" . $id) ?>" style="text-decoration: none; color: white;">View All</a></button>
                <?php endif ?>
            </div>

            <div class="report-body">
                <div class="report-topic-heading">
                    <h3 class="t-op">Name</h3>
                    <h3 class="t-op">Total Price</h3>
                    <h3 class="t-op">Create At</h3>
                    <h3 class="t-op">Status</h3>
                </div>

                <div class="items">
                    <?php while ($order = mysqli_fetch_assoc($result)) : ?>
                        <div class="item1">
                            <h3 class="t-op-nextlvl"><?= $order['name'] ?></h3>
                            <h3 class="t-op-nextlvl">$<?= $order['total_price'] ?></h3>
                            <h3 class="t-op-nextlvl"><?= $order['created_at'] ?></h3>
                            <h3 class="t-op-nextlvl label-tag"><?= $order['status'] ?></h3>
                        </div>
                    <?php endwhile ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once(ROOT_PATH . "admin/inc/footer.php"); ?>