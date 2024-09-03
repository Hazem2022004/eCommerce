<?php
$title = "Zay Shop - Register Page";
require_once ROOT_PATH . "inc/header.php";
title($title);
if (isset($_SESSION['auth']['id'])) {
    $row = Getuser($_SESSION['auth']['id']);
    if ($row != 0) {
        redirect("home");
    }
}

?>

<!-- Start Content Page -->
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Register</h1>
        <p>
            To register or sign up for an account with Zay Shop, please fill out the form below.
        </p>
    </div>
</div>
<!-- Start Contact -->
<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto border p-3 shadow" style="border-radius: 0px 70px;" action="<?= url("store-user"); ?>" method="POST" role="form">
            <div class="row p-3">
                <div class="text-center">
                    <span class="text-success"><?= $_SESSION['success'] ?? ''; ?></span>
                </div>
                <div class="form-group md-8 mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control mt-2" id="name" name="name" placeholder="Name" style="border-radius: 25px;border: solid 2px;box-shadow: 3px 5px #c6c3c3">
                    <span class="text-danger"><?= $_SESSION['errors']['name'] ?? ''; ?></span>
                </div>
                <div class="form-group md-8 mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control mt-2" id="email" name="email" placeholder="Email" style="border-radius: 25px;border: solid 2px;box-shadow: 3px 5px #c6c3c3">
                    <span class="text-danger"><?= $_SESSION['errors']['email'] ?? ''; ?></span>
                </div>
                <div class="form-group md-8 mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control mt-2" id="password" name="password" placeholder="Password" style="border-radius: 25px;border: solid 2px; box-shadow: 3px 5px #c6c3c3 ;">
                    <span class="text-danger"><?= $_SESSION['errors']['password'] ?? ''; ?></span>
                </div>
                <div class="mb-3">
                    Already register ?
                    <a class="navbar-sm-brand text-grey text-decoration-none" href="<?= url("login"); ?>">Login</a>
                </div>
            </div>
            <div class="row">
                <div class="col text-center mt-2 mb-3 ">
                    <button type="submit" class="btn btn-lg px-3" style="background: linear-gradient(90deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%);border-radius: 25px;border: solid black 2px;width: 60%;box-shadow: 3px 5px #c6c3c3;color: white;">
                        Register
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Contact -->
<?php
unset($_SESSION['success']);
unset($_SESSION['errors']);
// require_once ROOT_PATH . "inc/footer.php";
?>