<?php
require_once(ROOT_PATH . "src/validations.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = sanitize("name");
    $email = sanitize("email");
    $password = sanitize("password");
    $phone = "";
    $address = "";

    if (required($name)) {
        $errors['name'] = "Name is required";
    } elseif (maxlength($name, 30)) {
        $errors['name'] = "Name must be less than 30 characters";
    } elseif (minlength($name, 3)) {
        $errors['name'] = "Name must be more than 3 characters";
    }

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
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users`(`name`, `email`, `password`) VALUES ('$name','$email','$password')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $id = mysqli_insert_id($conn);
            $_SESSION['auth'] = [
                "id" => $id,
                "name" => $name,
                "email" => $email,
                "address" => $address,
                "phone" => $phone
            ];
            $_SESSION['success'] = "Your data has been successfully submitted!";
        }
    }
    redirect("register");
}
