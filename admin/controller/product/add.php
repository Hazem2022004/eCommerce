<?php
require_once(ROOT_PATH . "src/validations.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = 'public/images/products/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            } else {
                $errors['image'] = "Error adding the image.";
            }
        } else {
            $errors['image'] = "The file is not a valid image.";
        }
    } else {
        $errors['image'] = "No image added or there was an error in the add.";
    }

    if (isset($_POST['name'])) {
        $name = sanitize('name');
        if (required($name)) {
            $errors['name'] = "Name is required";
        } elseif (maxlength($name, 30)) {
            $errors['name'] = "Name must be less than 30 characters";
        } elseif (minlength($name, 2)) {
            $errors['name'] = "Name must be more than 3 characters";
        }
    }

    if (isset($_POST['description'])) {
        $description = sanitize('description');
        if (required($description)) {
            $errors['description'] = "Description is required";
        } elseif (maxlength($description, 500)) {
            $errors['description'] = "Description must be less than 500 characters";
        } elseif (minlength($description, 10)) {
            $errors['description'] = "Description must be more than 10 characters";
        }
    }

    if (isset($_POST['price'])) {
        $price = sanitize('price');
        if (required($price)) {
            $errors['price'] = "Price is required";
        } elseif (maxlength($price, 10)) {
            $errors['price'] = "Price must be less than 10";
        } elseif (!is_numeric($price)) {
            $errors['price'] = "Price must be a number";
        } elseif ($price < 0) {
            $errors['price'] = "Price must be more than 0";
        }
    }

    if (isset($_POST['rating'])) {
        $rating = sanitize('rating');
        if (required($rating)) {
            $errors['rating'] = "Rating is required";
        } elseif (!is_numeric($rating)) {
            $errors['rating'] = "Rating must be a number";
        } elseif ($rating < 0) {
            $errors['rating'] = "Rating must be more than 0";
        } elseif ($rating > 5) {
            $errors['rating'] = "Rating must be less than 5";
        }
    }

    if (isset($_POST['review'])) {
        $review = sanitize('review');
        if (required($review)) {
            $errors['review'] = "Review is required";
        } elseif (!is_numeric($review)) {
            $errors['review'] = "Review must be a number";
        } elseif ($review < 0) {
            $errors['review'] = "Review must be more than 0";
        }
    }
    if (isset($_POST['name_category'])) {
        $name_category = sanitize('name_category');
        if (required($name_category)) {
            $errors['name_category'] = "Category is required";
        } elseif (!is_numeric($name_category)) {
            $errors['name_category'] = "Category must be a number";
        } elseif ($name_category < 0) {
            $errors['name_category'] = "Category must be more than 0";
        }
    }
    if (isset($_POST['name_brand'])) {
        $name_brand = sanitize('name_brand');
        if (required($name_brand)) {
            $errors['name_brand'] = "Brand is required";
        } elseif (!is_numeric($name_brand)) {
            $errors['name_brand'] = "Brand must be a number";
        } elseif ($name_brand < 0) {
            $errors['name_brand'] = "Brand must be more than 0";
        }
    }
    if (isset($_POST['Gender'])) {
        $Gender = sanitize('Gender');
        if (required($Gender)) {
            $errors['Gender'] = "Gender is required";
        }
    }


    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
    } else {
        add_product($name, $price, $rating, $review, $description, $Gender, $_FILES['image']['name'], $name_category, $name_brand);
        $_SESSION['success'] = "Product added successfully";
    }
    redirect("admin-add-product&id=" . $_SESSION['auth']['id']);
} else {
    redirect("404");
}
