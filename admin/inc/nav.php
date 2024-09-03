<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    redirect("404");
}
$row = GetOne('users', $id);
?>

<body>
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <div class="d-flex">
                <a class="nav-item nav-link active  mx-3 mt-1 text-success" href="<?= url("home"); ?>">
                    <h4>Zay</h4>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="d-flex">
                <h4 class="mt-1 mx-3"><?= $row['name']; ?></h4>
                <img src="<?= BASE_URL . "public/images/users/" . $row['image']; ?>" alt="<?= $row['name']; ?>" class="rounded-circle img-fluid" width="40px" height="40px">
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"> Zay Shop</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="hover-text1">
                            <a aria-current="page" href="<?= url("admin&id=" . $id) ?>" style="color: black; text-decoration: none;"> Dashboard</a>
                        </li>
                        <li class="hover-text1">
                            <a aria-current="page" href="<?= url("admin-users&id=" . $id) ?>" style="color: black; text-decoration: none;">
                                <img src="../assets/img/people-fill.svg" alt="articles" width="30px" height="30px">
                                Users
                            </a>
                        </li>
                        <li class="hover-text1">
                            <a aria-current="page" href="<?= url("admin-orders&id=" . $id) ?>" style="color: black; text-decoration: none;">
                                <img src="../assets/img/box-seam-fill.svg" alt="report" width="30px" height="30px">
                                Orders
                            </a>
                        </li>
                        <div class="hover-text1">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black; text-decoration: none;">
                                    Categories
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?= url("admin-categories&id=" . $id) ?>">All Categories</a></li>
                                    <li><a class="dropdown-item" href="<?= url("admin-add-category&id=" . $id) ?>">Add Category</a></li>
                                </ul>
                            </li>
                        </div>
                        <div class="hover-text1">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black; text-decoration: none;">
                                    Products
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?= url("admin-products&id=" . $id) ?>">All Products</a></li>
                                    <li><a class="dropdown-item" href="<?= url("admin-add-product&id=" . $id) ?>">Add Product</a></li>
                                </ul>
                            </li>
                        </div>
                        <li class="hover-text1">
                            <a aria-current="page" href="<?= url("admin-profile&id=" . $id) ?>" style="color: black; text-decoration: none;">
                                <img src="../assets/img/person-circle.svg" alt="blog" width="30px" height="30px">
                                Profile
                            </a>
                        </li>
                        <li class="hover-text1">
                            <a aria-current="page" href="<?= url("logout") ?>" style="color: black; text-decoration: none;">
                                <img src="../assets/img/box-arrow-left.svg" alt="logout" width="30px" height="30px">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>