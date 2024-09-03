<?php
$title = "Zay Shop - Profile";
require_once ROOT_PATH . "inc/header.php";
check_login();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = GetOne('users', $id);
} else {
    redirect("404");
}
require_once ROOT_PATH . "inc/nav.php";
require_once ROOT_PATH . "inc/modal.php";
title($title);

?>

<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Profile</h1>
    </div>
</div>

<div class="text-center">
    <img src="<?= BASE_URL . "public/images/users/" . $row['image']; ?>" alt="Current Image" id="currentImage" class="rounded-circle img-fluid m-3" style="width: 300px; height: 300px;">
</div>
<form class="col-md-8 m-auto" action="<?= url("update-profile&id=" . $row['id'] . "&index=user") ?>" method="POST" enctype="multipart/form-data">
    <div class="col text-center mt-2 mb-3">
        <input type="file" name="filephoto" id="filephoto" style="display: none;">
        <label for="filephoto" class="btn btn-success" style="background: linear-gradient(90deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%);border-radius: 25px;border: solid black 2px;width: 20%;box-shadow: 3px 5px #c6c3c3;color: white;">
            <i class="fa fa-cloud-upload">
                Upload Image
            </i>
        </label>
    </div>
    <div class="row p-3">
        <div class="text-center">
            <span class="text-success"><?= $_SESSION['success'] ?? ''; ?></span>
            <span class="text-danger"><?= $_SESSION['errors']['update'] ?? ''; ?></span>
        </div>
        <div class="form-group md-8 mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control mt-2" id="name" name="name" value="<?= $row['name']; ?>" style="border-radius: 25px;border: solid 2px;box-shadow: 3px 5px #c6c3c3">
            <span class="text-danger"><?= $_SESSION['errors']['name'] ?? ''; ?></span>
        </div>
        <div class="form-group md-8 mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control mt-2" id="email" name="email" value="<?= $row['email']; ?>" style="border-radius: 25px;border: solid 2px;box-shadow: 3px 5px #c6c3c3">
            <span class="text-danger"><?= $_SESSION['errors']['email'] ?? ''; ?></span>
        </div>
        <div class="form-group md-8 mb-3">
            <label for="address">Address(Optional)</label>
            <input type="text" class="form-control mt-2" id="address" name="address" value="<?= $row['address'] ?? 'NULL'; ?>" style="border-radius: 25px;border: solid 2px;box-shadow: 3px 5px #c6c3c3">
            <span class="text-danger"><?= $_SESSION['errors']['address'] ?? ''; ?></span>
        </div>
        <div class="form-group md-8 mb-3">
            <label for="phone">Phone(Optional)</label>
            <input type="text" class="form-control mt-2" id="phone" name="phone" value="<?= $row['phone'] ?? 'NULL'; ?>" style="border-radius: 25px;border: solid 2px;box-shadow: 3px 5px #c6c3c3">
            <span class="text-danger"><?= $_SESSION['errors']['phone'] ?? ''; ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col text-center mt-2 mb-3 ">
            <button type="submit" name="update" class="btn btn-lg px-3" style="background: linear-gradient(90deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%);border-radius: 25px;border: solid black 2px;width: 60%;box-shadow: 3px 5px #c6c3c3;color: white;">
                Save
            </button>
        </div>
    </div>
</form>
<form class="col-md-8 m-auto" action="<?= url("change-password&id=" . $row['id']) ?>" method="post">
    <div class="row">
        <div class="col text-center mt-2 mb-3 ">
            <button type="submit" class="btn btn-lg px-3" style="background: linear-gradient(90deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%);border-radius: 25px;border: solid black 2px;width: 60%;box-shadow: 3px 5px #c6c3c3;color: white;">
                Change Password
            </button>
        </div>
    </div>
</form>

<?php
unset($_SESSION['success']);
unset($_SESSION['errors']);
require_once ROOT_PATH . "inc/footer.php";
?>