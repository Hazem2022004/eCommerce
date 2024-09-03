<?php
require_once ROOT_PATH . "src/validations.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = GetOne('users', $id);
} else {
    redirect("404");
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $old_password = sanitize("old_password");
    $new_password = sanitize("new_password");
    if (password_verify($old_password, $row['password'])) {
        if (required($new_password)) {
            $errors['new_password'] = "New Password is required";
        } elseif (minlength($new_password, 5)) {
            $errors['new_password'] = "New Password must be more than 5 characters";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {
            $new_password = password_hash($new_password, PASSWORD_DEFAULT);
            change_password("users", $id, $new_password);
            $_SESSION['success'] = "Password Updated Successfully";
        }
    } else {
        $_SESSION['errors']['old_password'] = "Old Password is not correct";
    }
    redirect("change-password&id=" . $id);
}
