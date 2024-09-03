<?php
$title = "Zay Shop - Profile";
require_once ROOT_PATH . "inc/header.php";
title($title);
check_login();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    redirect("404");
}
require_once ROOT_PATH . "inc/nav.php";
require_once ROOT_PATH . "inc/modal.php";


?>

<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto border p-3 shadow" style="border-radius: 0px 70px;" action="<?= url("update-password&id=" . $id); ?>" method="POST">
            <div class="row p-3">
                <div class="text-center">
                    <span class="text-success"><?= $_SESSION['success'] ?? ''; ?></span>
                </div>
                <div class="form-group md-8 mb-3">
                    <label for="old_password">Old Password</label>
                    <input type="password" name="old_password" id="old_password" class="form-control" style="border-radius: 25px;border: solid 2px;box-shadow: 3px 5px #c6c3c3">
                    <span class="text-danger"><?= $_SESSION['errors']['old_password'] ?? ''; ?></span>
                </div>
                <div class="form-group md-8 mb-3">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" style="border-radius: 25px;border: solid 2px;box-shadow: 3px 5px #c6c3c3">
                    <span class="text-danger"><?= $_SESSION['errors']['new_password'] ?? ''; ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col text-center mt-2 mb-3 ">
                    <button type="submit" class="btn btn-lg px-3" style="background: linear-gradient(90deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%);border-radius: 25px;border: solid black 2px;width: 60%;box-shadow: 3px 5px #c6c3c3;color: white;">
                        Change Password
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
unset($_SESSION['success']);
unset($_SESSION['errors']);
require_once ROOT_PATH . "inc/footer.php";
?>