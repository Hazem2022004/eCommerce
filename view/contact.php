<?php
$title = "Zay Shop - Contact";
require_once ROOT_PATH . "inc/header.php";
check_login();
title($title);
require_once ROOT_PATH . "inc/nav.php";
require_once ROOT_PATH . "inc/modal.php";

?>






<!-- Start Content Page -->
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Contact Us</h1>
        <p>If you have any questions or need support, please fill out the form below or reach us at the contact details provided.</p>
    </div>
</div>
<!-- Start Contact -->
<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto border p-3 shadow" style="border-radius: 0px 70px;" action="<?= url("send-message"); ?>" method="POST" role="form">
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
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control mt-2" id="subject" name="subject" placeholder="Subject" style="border-radius: 25px;border: solid 2px;box-shadow: 3px 5px #c6c3c3">
                    <span class="text-danger"><?= $_SESSION['errors']['subject'] ?? ''; ?></span>
                </div>
                <div class="form-group md-8 mb-3">
                    <label for="message">Message</label>
                    <textarea class="form-control mt-2" id="message" name="message" placeholder="Message" rows="8" style="border-radius: 25px;border: solid 2px;box-shadow: 3px 5px #c6c3c3"></textarea>
                    <span class="text-danger"><?= $_SESSION['errors']['message'] ?? ''; ?></span>
                </div>
                <div class="row">
                    <div class="col text-center mt-2 mb-3 ">
                        <button type="submit" class="btn btn-lg px-3" style="background: linear-gradient(90deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%);border-radius: 25px;border: solid black 2px;width: 60%;box-shadow: 3px 5px #c6c3c3;color: white;">
                            Send
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
?>