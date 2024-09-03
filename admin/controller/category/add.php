<?php
require_once(ROOT_PATH . "src/validations.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = 'public/images/categories/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            } else {
                $errors['image'] = "Error uploading the image.";
            }
        } else {
            $errors['image'] = "The file is not a valid image.";
        }
    } else {
        $errors['image'] = "No image uploaded or there was an error in the upload.";
    }

    if (isset($_POST['name'])) {
        $name = sanitize('name');
        if (required($name)) {
            $errors['name'] = "Name is required";
        } elseif (maxlength($name, 30)) {
            $errors['name'] = "Name must be less than 30 characters";
        } elseif (minlength($name, 3)) {
            $errors['name'] = "Name must be more than 3 characters";
        }
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
    } else {
        add_category($name, $_FILES['image']['name']);
        $_SESSION['success'] = "Category added successfully";
    }
    redirect("admin-add-category&id=" . $_SESSION['auth']['id']);
} else {
    redirect("404");
}
