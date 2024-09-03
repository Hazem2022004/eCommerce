<!-- Start Footer -->
<?php
$result = getAll('settings');
$setting = mysqli_fetch_assoc($result);
$user = GetOne('users', $_SESSION['auth']['id']);
?>
<footer class="bg-dark" id="tempaltemo_footer">
    <div class="container">
        <div class="row">

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-success border-bottom pb-3 border-light logo">Zay Shop</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li>
                        <i class="fas fa-map-marker-alt fa-fw"></i>
                        <?= $setting['address']; ?>
                    </li>
                    <li>
                        <i class="fa fa-phone fa-fw"></i>
                        <a class="text-decoration-none" href="tel:<?= $setting['phone']; ?>"><?= $setting['phone']; ?></a>
                    </li>
                    <li>
                        <i class="fa fa-envelope fa-fw"></i>
                        <a class="text-decoration-none" href="mailto:<?= $setting['email']; ?>"><?= $setting['email']; ?></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light">Products</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <?php $result = sql(); ?>
                    <?php while ($product = mysqli_fetch_assoc($result)) : ?>
                        <li><a class="text-decoration-none" href="<?= url("single-shop&id=" . $product['id']); ?>"><?= $product['title']; ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light">Further Info</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li><a class="text-decoration-none" href="<?= url("home"); ?>">Home</a></li>
                    <li><a class="text-decoration-none" href="<?= url("about"); ?>">About Us</a></li>
                    <li><a class="text-decoration-none" href="<?= url("contact"); ?>">FAQs</a></li>
                </ul>
            </div>

        </div>

        <div class="row text-light mb-4">
            <div class="col-12 mb-3">
                <div class="w-100 my-3 border-top border-light"></div>
            </div>
            <div class="col-auto me-auto">
                <ul class="list-inline text-left footer-icons">
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="<?= $setting['facebook']; ?>"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="<?= $setting['instagram']; ?>"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="<?= $setting['whatsapp']; ?>"><i class="fab fa-whatsapp fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="<?= $setting['linkedin']; ?>"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                    </li>
                </ul>
            </div>
            <?php if ($user['role'] == "admin"): ?>
                <div class="col-auto">
                    <form action="<?= url("newsletter"); ?>" method="POST">
                        <label class="sr-only" for="email">Email address</label>
                        <span class="text-success"><?= $_SESSION['success'] ?? ''; ?></span>
                        <span class="text-danger"><?= $_SESSION['errors']['email'] ?? ''; ?></span>
                        <div class="input-group mb-2">
                            <input type="email" class="form-control" id="email" placeholder="Email address" name="email">
                            <button type="submit" class="btn btn-success">Subscribe</button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="w-100 bg-black py-3">
        <div class="container">
            <div class="row pt-2">
                <div class="col-12">
                    <p class="text-left text-light">
                        Copyright &copy; 2021 Company Name
                        | Designed by <a rel="sponsored" href="https://templatemo.com" target="_blank">TemplateMo</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->
<?php
unset($_SESSION['success']);
unset($_SESSION['errors']);
?>
<!-- Start Script -->
<script src="assets/js/jquery-1.11.0.min.js"></script>
<script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/templatemo.js"></script>
<script src="assets/js/custom.js"></script>
<!-- End Script -->
</body>

</html>