<?php
require_once(ROOT_PATH . "src/validations.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = sanitize("email");
    if (required($email)) {
        $errors['email'] = "Email is required";
    } elseif (email($email)) {
        $errors['email'] = "Email is not valid";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
    } else {
        $sql = "SELECT * FROM `users` WHERE `email` = '$email' && `role` = 'user'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            send_newsletter($email);
            $_SESSION['success'] = "Email sent successfully";
        } else {
            $errors['email'] = "Email not found";
            $_SESSION['errors'] = $errors;
        }
    }
    redirect("home");
}
