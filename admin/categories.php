<?php
check_login();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    redirect("404");
}
$result = getAll('categories');
require_once(ROOT_PATH . "admin/inc/head.php");
require_once(ROOT_PATH . "admin/inc/nav.php");
?>


<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Categories</h1>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr class="table">
                    <th scope="col" class="table-primary">Name</th>
                    <th scope="col" class="table-secondary">Image</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($Category = mysqli_fetch_assoc($result)) : ?>
                    <tr class="text-center">
                        <td class="table-secondary"><?= $Category['name'] ?></td>
                        <td class="table-primary"><img src="<?= BASE_URL . "public/images/categories/" . $Category['image'] ?>" alt="<?= $Category['name'] ?>" class="rounded-circle img-fluid border" width="150px" height="150px"></td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</div>






<?php require_once(ROOT_PATH . "admin/inc/footer.php"); ?>