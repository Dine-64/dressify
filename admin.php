<?php
include 'db.php';
session_start();

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_product'])) {
        // Add product logic
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];
        $target = "upload/" . basename($image);

        $sql = "INSERT INTO products (name, price, image) VALUES ('$name', '$price', '$image')";

        if ($conn->query($sql) === TRUE) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                echo "Product added successfully";
            } else {
                echo "Failed to upload image";
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['delete_product'])) {
        // Delete product logic
        $product_id = $_POST['product_id'];
        $sql = "DELETE FROM products WHERE id='$product_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Product deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
    </header>
    <br><br>

    <section class="admin-section">

    <button type="submit" name="add_product" style="background-color: blueviolet; color: aliceblue" href="#product_section">Production Management</button>
    &nbsp
    <button type="submit" name="add_product" style="background-color: blueviolet; color: aliceblue"href="#order_management">Order Management</button>
    &nbsp
    <button type="submit" name="add_product" style="background-color: blueviolet; color: aliceblue"href="#usermanagement">User Management</button>
    
    <br><br>
    <section class="Production Management" id="product_section">
        <h2>Add Product</h2>
        <form action="admin.php" method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Product Name" required>
            <input type="text" name="price" placeholder="Product Price" required>
            <input type="file" name="image" required>
            <button type="submit" name="add_product">Add Product</button>
        </form>

        <br><br>
        <h2>Delete Product</h2>
        <form action="admin.php" method="post">
            <input type="text" name="product_id" placeholder="Product ID" required>
            <button type="submit" name="delete_product">Delete Product</button>
        </form>
</section>
    <section class="Order Management" id="order_management">
        <h2>Order Management</h2>
    </section>

    <section class="User Management" id="usermanagement">
        <h2>User Management</h2>
    </section>
    </section>
</body>
</html>