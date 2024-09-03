<?php
require_once(ROOT_PATH . "src/validations.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = sanitize("email");
    $password = sanitize("password");



    if (required($email)) {
        $errors['email'] = "Email is required";
    } elseif (email($email)) {
        $errors['email'] = "Email is not valid";
    }

    if (required($password)) {
        $errors['password'] = "Password is required";
    } elseif (minlength($password, 5)) {
        $errors['password'] = "Password must be more than 5 characters";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
    } else {
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            if (!password_verify($password, $row['password'])) {
                $_SESSION['errors']['login'] = "Email or Password is incorrect";
            } else {
                $_SESSION['auth'] = [
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "email" => $email
                ];
            }
        } else {
            $_SESSION['errors']['login'] = "Email or Password is incorrect";
        }
    }
    redirect("login");
}
