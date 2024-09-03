<?php

$conn = mysqli_connect("localhost", "root", "");

$sql = "CREATE DATABASE IF NOT EXISTS `zay-store`";

mysqli_query($conn, $sql);

$conn = mysqli_connect("localhost", "root", "", "zay-store");

$sql = "CREATE TABLE IF NOT EXISTS `Sliders`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `title` VARCHAR(150) NOT NULL,
    `sub_title` VARCHAR(200),
    `description` TEXT NOT NULL,
    `image` VARCHAR(150) NOT NULL
)";

mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `categories`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(150) NOT NULL,
    `image` VARCHAR(200) NOT NULL
)";

mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `Brands`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(150) NOT NULL,
    `image` VARCHAR(150) NOT NULL,
    `category_id` INT NOT NULL,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`)
)";

mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `products`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `title` VARCHAR(150) NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `rating` SMALLINT NOT NULL,
    `review` SMALLINT NOT NULL,
    `description` TEXT NOT NULL,
    `gender` ENUM('men','women') DEFAULT 'men', 
    `image` VARCHAR(255) NOT NULL,
    `category_id` INT NOT NULL,
    `brand_id` INT NOT NULL,
    FOREIGN KEY (`brand_id`) REFERENCES `Brands`(`id`),
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`)
)";

mysqli_query($conn, $sql);


$sql = "INSERT INTO `Sliders`(`title`,`sub_title`,`description`,`image`) VALUES
('Zay eCommerce','Tiny and Perfect eCommerce Template','Zay Shop is an eCommerce HTML5 CSS template with latest version of Bootstrap 5 (beta 1). This template is 100% free provided by TemplateMo website. Image credits go to Freepik Stories, Unsplash and Icons 8.','01.jpg'),
('Proident occaecat','Aliquip ex ea commodo consequat','You are permitted to use this Zay CSS template for your commercial websites. You are not permitted to re-distribute the template ZIP file in any kind of template collection websites.','02.jpg'),
('Repr in voluptate','Ullamco laboris nisi ut','We bring you 100% free CSS templates for your websites. If you wish to support TemplateMo, please make a small contribution via PayPal or tell your friends about our website. Thank you.','03.jpg')
";

mysqli_query($conn, $sql);

$sql = "INSERT INTO `categories`(`name`,`image`) VALUES(
'Watches','01.jpg'),
('Shoes','02.jpg'),
('Accessories','03.jpg')";

mysqli_query($conn, $sql);

$sql = "INSERT INTO `Brands`(`name`,`image`,`category_id`) VALUES
('ActiveGear','01.jpg',1),
('TrailBlaze','02.jpg',2),
('EleganceTime','03.jpg',1),
('PrestigeTime','04.jpg',1),
('TechFit','05.jpg',1),
('FastTrack','06.jpg',2),
('ClassyStep','07.jpg',2),
('UrbanWalk','08.jpg',2),
('SunRay','09.jpg',3),
('SoundPulse','10.jpg',3),
('AdventureGear','11.jpg',3),
('UrbanLeather','12.jpg',3)
";

mysqli_query($conn, $sql);

$sql = "INSERT INTO `products` (`title`,`price`,`rating`,`review` ,`description` ,`image`,`category_id`,`brand_id`,`gender`) VALUES
('Classic Stainless Steel Watch', 159.99, 3, 320, 'A timeless stainless steel watch with a minimalist design and durable construction.', '01.jpg',1,3,'men'),
('Sports Digital Watch', 89.99, 5, 210, 'A rugged digital watch with multiple functions including a stopwatch, alarm, and backlight.', '02.jpg',1,1,'women'),
('Luxury Leather Watch', 299.99, 3, 180, 'A luxurious leather watch with a polished gold case and elegant design.', '03.jpg',1,4,'men'),
('Smartwatch with Fitness Tracker', 129.99, 4, 275, 'A versatile smartwatch with fitness tracking, heart rate monitoring, and customizable watch faces.', '04.jpg',1,5,'women'),
('Running Shoes', 99.99, 4, 500, 'Lightweight and comfortable running shoes with excellent grip and breathability.', '05.jpg',2,6,'women'),
('Leather Dress Shoes', 149.99, 4, 320, 'Elegant leather dress shoes with a polished finish, perfect for formal occasions.', '06.jpg',2,7,'men'),
('Casual Sneakers', 79.99, 3, 270, 'Stylish and versatile casual sneakers with cushioned soles for all-day comfort.', '07.jpg',2,8,'women'),
('Hiking Boots', 129.99, 5, 190, 'Durable and waterproof hiking boots designed for tough terrains and long trails.', '08.jpg',2,2,'men'),
('Sunglasses', 89.99, 4, 210, 'Stylish polarized sunglasses with UV protection and durable frames.', '09.jpg', 3,9,'women'),
('Bluetooth Earbuds', 79.99, 5, 290, 'Wireless Bluetooth earbuds with noise cancellation and long battery life.', '10.jpg', 3, 10,'women'),
('Backpack', 129.99, 4, 180, 'A spacious backpack with multiple compartments and water-resistant material.', '11.jpg',3,11,'men'),
('Leather Wallet', 45.99, 3, 122, 'A premium leather wallet with multiple card slots and a sleek design.', '12.jpg',3,12,'men')
";

mysqli_query($conn, $sql);


$sql = "CREATE TABLE IF NOT EXISTS `users`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(150) NOT NULL,
    `email` VARCHAR(200) NOT NULL,
    `password` VARCHAR(200) NOT NULL,
    `phone` VARCHAR(200),
    `address` VARCHAR(200),
    `image` VARCHAR(200) DEFAULT 'default.png',
    `role` ENUM('admin','user') DEFAULT 'user'
)";

mysqli_query($conn, $sql);
$sql = "CREATE TABLE IF NOT EXISTS `orders`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `total_price` FLOAT NOT NULL,
    `status` ENUM('pending','processing','completed','cancelled') DEFAULT 'pending',
    `created_at` TIMESTAMP DEFAULT(now()),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
)";
mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `cart`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `quantity` INT NOT NULL,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
)";

mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `wishlist`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `product_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)
)";

mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `Messages`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(150) NOT NULL,
    `subject` VARCHAR(200) NOT NULL,
    `email` VARCHAR(200) NOT NULL,
    `message` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT(now()),
    `user_id` INT NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
)";

mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `order_items`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `order_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `quantity` INT NOT NULL,
    `user_id` INT NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`),
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)  
)";

mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `settings`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `phone` VARCHAR(200) NOT NULL,
    `email` VARCHAR(200) NOT NULL,
    `address` VARCHAR(200) NOT NULL,
    `facebook` VARCHAR(200) NOT NULL,
    `instagram` VARCHAR(200) NOT NULL,
    `whatsapp` VARCHAR(200) NOT NULL,
    `linkedin` VARCHAR(200) NOT NULL
)";

mysqli_query($conn, $sql);

$sql = "INSERT INTO `settings` (`phone`, `email`, `address`, `facebook`, `instagram`, `whatsapp`, `linkedin`) 
VALUES('010-9249-2013', 'hhazm6745@gmail.com', 'Dakahlia Governorate, Mansoura, El-Danabiq', 'https://www.facebook.com/profile.php?id=100043427103439', 'https://www.instagram.com/hazemhatem20/', 'https://wa.me/201092492013', 'https://www.linkedin.com')";
mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `newsletter`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `email` VARCHAR(200) NOT NULL 
)";

mysqli_query($conn, $sql);
