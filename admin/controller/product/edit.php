<?php
echo "<pre>";
print_r($_POST);
echo "</pre>";
echo "<pre>";
var_dump($_FILES['image']['name'] ?? 0);
echo "</pre>";
echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
echo "<pre>";
print_r($_GET);
echo "</pre>";
require_once(ROOT_PATH . "src/validations.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $image = $_FILES["image"]["name"];
    if (!empty($image)) {
        $current_image_path = "public/images/products/" . $_GET['image'];
        $target_dir = "public/images/products/";
        $target_file = $target_dir . basename($image);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["image"]["tmp_name"]);
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
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                rename($target_file, $current_image_path);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
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
        update_product($_GET['id'], $name, $price, $rating, $review, $description, $Gender, $name_category, $name_brand);
        $_SESSION['message'] = "Product updated successfully";
    }
    redirect("admin-edit-product&id=" . $_SESSION['auth']['id'] . "&product_id=" . $_GET['id']);
}
