<?php
check_login();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    redirect("404");
}
require_once(ROOT_PATH . "admin/inc/head.php");
require_once(ROOT_PATH . "admin/inc/nav.php");
?>
<br><br>
<div class="container-fluid bg-light py-5">
    <div class="col-md-12">
        <div class="col-md-6 m-auto text-center">
            <h1 class="h1">Add Category</h1>
        </div>
    </div>
</div>
<div class="container py-5">
    <div class="row py-5">
        <div class="col-md-6 m-auto">
            <form action="<?= url("add-category&id=" . $id) ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add Category</button>
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