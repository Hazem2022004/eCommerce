<?php
check_login();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    redirect("404");
}
$result = getAll('users');
require_once(ROOT_PATH . "admin/inc/head.php");
require_once(ROOT_PATH . "admin/inc/nav.php");
?>


<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Users</h1>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr class="table-primary">
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Role</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = mysqli_fetch_assoc($result)) : ?>
                    <tr class="table-secondary">
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['phone'] ?></td>
                        <td><?= $user['address'] ?></td>
                        <td><?= $user['role'] ?></td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</div>






<?php require_once(ROOT_PATH . "admin/inc/footer.php"); ?>