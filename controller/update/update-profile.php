<?php
require_once(ROOT_PATH . "src/validations.php");
if (isset($_GET['id']) && $_GET['index']) {
    $id = $_GET['id'];
    $page = $_GET['index'];
} else {
    redirect("404");
}

if (isset($_POST['update'])) {
    $name = sanitize("name");
    $email = sanitize("email");
    $phone = sanitize("phone");
    $address = sanitize("address");
    $image = $_FILES["filephoto"]["name"];
    if (!empty($image)) {
        change_image("users", $id);
        $current_image_path = "public/images/users/01.png";
        $target_dir = "public/images/users/";
        $target_file = $target_dir . basename($image);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["filephoto"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (file_exists($current_image_path)) {
                unlink($current_image_path);
            }
            if (move_uploaded_file($_FILES["filephoto"]["tmp_name"], $target_file)) {
                rename($target_file, $current_image_path);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    if (!empty($name)) {
        if (maxlength($name, 30)) {
            $errors['name'] = "Name must be less than 30 characters";
        } elseif (minlength($name, 3)) {
            $errors['name'] = "Name must be more than 3 characters";
        }
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {
            change_name("users", $id, $name);
            $_SESSION['auth']['name'] = $name;
        }
    }

    if (!empty($email)) {
        if (email($email)) {
            $errors['email'] = "Email is not valid";
        }
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {
            change_email("users", $id, $email);
            $_SESSION['auth']['email'] = $email;
        }
    }

    if (!empty($phone)) {
        if (maxlength($phone, 11)) {
            $errors['phone'] = "Phone must be less than 11 characters";
        } elseif (minlength($phone, 11)) {
            $errors['phone'] = "Phone must be more than 11 characters";
        }
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {
            change_phone("users", $id, $phone);
            $_SESSION['auth']['phone'] = $phone;
        }
    }

    if (!empty($address)) {
        if (maxlength($address, 100)) {
            $errors['address'] = "Address must be less than 100 characters";
        }
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {
            change_address("users", $id, $address);
            $_SESSION['auth']['address'] = $address;
        }
    }
    if ($page == "user") {
        redirect("profile&id=" . $id);
    } elseif ($page == "admin") {
        redirect("admin-profile&id=" . $id);
    } else {
        redirect("404");
    }
}
