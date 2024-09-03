<?php
if (isset($_SESSION['auth'])) {
    $id = $_SESSION['auth']['id'];
    $row = Getuser($id);
} else {
    $row = 0;
}
$result = getAll('settings');
$setting = mysqli_fetch_assoc($result);
$user = GetOne('users', $_SESSION['auth']['id']);
?>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <?php if ($row == 0): ?>
                        <i class="fa fa-fw fa-user mr-3"></i>
                        <a class="navbar-sm-brand text-light text-decoration-none" href="<?= url("register"); ?>">register</a>
                        <i class="bi bi-box-arrow-in-right"></i>
                        <a class="navbar-sm-brand text-light text-decoration-none" href="<?= url("login"); ?>">login</a>
                    <?php elseif (GetSession("auth")): ?>
                        <?php if ($user['role'] == "admin"): ?>
                            <i class="fa fa-fw fa-user mr-3"></i>
                            <a class="navbar-sm-brand text-light text-decoration-none" href="<?= url("admin&id=" . GetSession("auth")["id"]); ?>"><?= GetSession("auth")["name"]; ?></a>
                        <?php else: ?>
                            <i class="fa fa-fw fa-user mr-3"></i>
                            <a class="navbar-sm-brand text-light text-decoration-none" href="<?= url("profile&id=" . GetSession("auth")["id"]); ?>"><?= GetSession("auth")["name"]; ?></a>
                        <?php endif; ?>
                        <i class="fa fa-fw fa-sign-out-alt text-light mr-3"></i>
                        <a class="navbar-sm-brand text-light text-decoration-none" href="<?= url("logout"); ?>">logout</a>

                    <?php endif; ?>
                </div>
                <div>
                    <a class="text-light" href="<?= $setting['facebook']; ?>" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="<?= $setting['instagram']; ?>" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="<?= $setting['whatsapp']; ?>" target="_blank"><i class="fab fa-whatsapp fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="<?= $setting['linkedin']; ?>" target="_blank"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="<?= url("home"); ?>">
                Zay
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= url("home"); ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= url("about"); ?>">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= url("shop"); ?>">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= url("contact"); ?>">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="<?= url("cart"); ?>">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">
                            <?= cart_count($_SESSION["auth"]["id"] ?? 0); ?>
                        </span>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="<?= url("wishlist"); ?>">
                        <i class="bi bi-heart-fill text-danger mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">
                            <?= wishlist_count($_SESSION["auth"]["id"] ?? 0); ?>
                        </span>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="<?= url("order"); ?>">
                        <i class="fa fa-fw fa-box text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">
                            <?= order_count($_SESSION["auth"]["id"] ?? 0); ?>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Header -->