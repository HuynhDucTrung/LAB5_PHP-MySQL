<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "product_catalog";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    die("Error creating database: " . $conn->error);
}

// Select database
$conn->select_db($dbname);

// Create table
$sql = "CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    brand VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    original_price DECIMAL(10, 2) NOT NULL,
    discount_percentage INT NOT NULL,
    screen_size VARCHAR(10) NOT NULL,
    ram VARCHAR(10) NOT NULL,
    storage VARCHAR(10) NOT NULL,
    rating INT NOT NULL,
    likes INT NOT NULL,
    image_url VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully\n";
} else {
    die("Error creating table: " . $conn->error);
}

// Insert data
$sql = "INSERT INTO products (name, brand, price, original_price, discount_percentage, screen_size, ram, storage, rating, likes, image_url) VALUES
    ('iPhone 14 Pro Max 128GB', 'Apple', 29490000, 34900000, 16, '6.7 inches', '6 GB', '128 GB', 5, 0, 'images/iphone_14_pro_max_128gb.jpg'),
    ('OPPO Reno8', 'OPPO', 7850000, 8900000, 13, '6.4 inches', '8 GB', '256 GB', 0, 0, 'images/oppo_reno8.jpg'),
    ('iPhone 11 64GB', 'Apple', 11990000, 14990000, 25, '6.1 inches', '4 GB', '64 GB', 5, 0, 'images/iphone_11_64gb.jpg'),
    ('iPhone 13 128GB', 'Apple', 17990000, 24990000, 28, '6.1 inches', '4 GB', '128 GB', 5, 0, 'images/iphone_13_128gb.jpg'),
    ('iPhone 13 Pro Max 128GB', 'Apple', 27190000, 34900000, 22, '6.7 inches', '6 GB', '128 GB', 5, 0, 'images/iphone_13_pro_max_128gb.jpg'),
    ('iPhone 14 Pro Max 256GB', 'Apple', 31490000, 37900000, 17, '6.7 inches', '256 GB', '256 GB', 5, 0, 'images/iphone_14_pro_max_256gb.jpg'),
    ('iPhone 14 128GB', 'Apple', 19990000, 24990000, 20, '6.1 inches', '4 GB', '128 GB', 5, 0, 'images/iphone_14_128gb.jpg'),
    ('Samsung Galaxy S22 Ultra', 'Samsung', 23090000, 30900000, 25, '6.8 inches', '8 GB', '128 GB', 0, 0, 'images/samsung_galaxy_s22_ultra.jpg'),
    ('Samsung Galaxy Z Fold4', 'Samsung', 34290000, 40900000, 16, '7.6 inches', '12 GB', '256 GB', 0, 0, 'images/samsung_galaxy_z_fold4.jpg'),
    ('iPhone 11 128GB', 'Apple', 12790000, 16990000, 25, '6.1 inches', '4 GB', '128 GB', 0, 0, 'images/iphone_11_128gb.jpg')
    ON DUPLICATE KEY UPDATE
        name = VALUES(name),
        brand = VALUES(brand),
        price = VALUES(price),
        original_price = VALUES(original_price),
        discount_percentage = VALUES(discount_percentage),
        screen_size = VALUES(screen_size),
        ram = VALUES(ram),
        storage = VALUES(storage),
        rating = VALUES(rating),
        likes = VALUES(likes),
        image_url = VALUES(image_url)";
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully\n";
} else {
    die("Error inserting data: " . $conn->error);
}

// Fetch data
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Grid</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="product-grid">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product">';
                echo '<img src="' . $row["image_url"] . '" alt="' . $row["name"] . '">';
                echo '<h2>' . $row["name"] . '</h2>';
                echo '<p>Brand: ' . $row["brand"] . '</p>';
                echo '<p>Screen Size: ' . $row["screen_size"] . '</p>';
                echo '<p>RAM: ' . $row["ram"] . '</p>';
                echo '<p>Storage: ' . $row["storage"] . '</p>';
                echo '<p>Price: ' . number_format($row["price"]) . 'đ</p>';
                echo '<p>Original Price: ' . number_format($row["original_price"]) . 'đ</p>';
                echo '<p>Discount: ' . $row["discount_percentage"] . '%</p>';
                echo '<p>Rating: ' . str_repeat('★', $row["rating"]) . '</p>';
                echo '<button>Yêu thích</button>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </div>
</body>

</html>