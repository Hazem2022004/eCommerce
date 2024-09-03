<?php
require_once(ROOT_PATH . "src/validations.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = sanitize("name");
    $email = sanitize("email");
    $subject = sanitize("subject");
    $message = sanitize("message");
    $user_id = $_SESSION['auth']['id'];
    if (required($name)) {
        $errors['name'] = "Name is required";
    } elseif (maxlength($name, 30)) {
        $errors['name'] = "Name must be less than 50 characters";
    } elseif (minlength($name, 3)) {
        $errors['name'] = "Name must be more than 3 characters";
    }
    if (required($subject)) {
        $errors['subject'] = "Subject is required";
    } elseif (maxlength($subject, 50)) {
        $errors['subject'] = "Subject must be less than 50 characters";
    } elseif (minlength($subject, 3)) {
        $errors['subject'] = "Subject must be more than 3 characters";
    }

    if (required($message)) {
        $errors['message'] = "Message is required";
    } elseif (maxlength($message, 500)) {
        $errors['message'] = "Message must be less than 500 characters";
    } elseif (minlength($message, 10)) {
        $errors['message'] = "Message must be more than 10 characters";
    }

    if (required($email)) {
        $errors['email'] = "Email is required";
    } elseif (email($email)) {
        $errors['email'] = "Email is not valid";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
    } else {
        $result = send_message($name, $email, $subject, $message, $user_id);
        if ($result) {
            $_SESSION['success'] = "Message sent successfully";
        }
    }
    redirect("contact");
}
