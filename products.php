<?php
$servername = "localhost";
$username = "root";
$password = ""; // replace with your database password
$dbname = "dressify";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT id, name, price, image FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dressify - Online Shop</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <style>
        .Products-container .box .product{
            display: flex;
            align-items: center;
            justify-content: space-around;
        }
        .Products-container .box .product span{
            padding: 0 1rem;
            color: var(--bg-colour);
            background-color: var(--main-color);
            border-radius: 4px;
            font-weight: 500;
        }
        .Products-container .box .product a{
            border: 2px solid var(--main-color);
            padding: 0 1rem;
            color: palevioletred;
            border-radius: 4px;
            text-transform: uppercase;
        }
        .Products-container .box .product a:hover{
            background-color: var(--main-color);
            color: var(--bg-colour);
            transition: 1s background-color linear;
        }
        .Products-container .box .product .button{
            background-color: var(--main-color);
            color: var(--bg-colour);
            transition: 1s background-color linear;
        }
        #cart {
            display: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
            padding: 0.5em;
        }

        #cart-total {
            margin-top: 1em;
            text-align: right;
        }
    </style>
</head>
<body>
    <header>
        <!--Navbar-->
        <!--logo icon-->
        <a href="#home" class="logo">
            <img src="images/logo.jpg" alt="">
        </a>
        <!--Menu icon-->
        <i class='bx bx-menu' id="menu-icon"></i>
        <!--Links-->
        <ul>
            <li><a href="#products">Products</a></li>
            <li><a href="#cart">Cart</a></li>
        </ul>
        <!--Icons-->
        <div class="header-icon">
            <i class='bx bx-cart-alt' id="cart-icon"></i>
            <i class='bx bx-search-alt-2' id="search-icon"></i>
        </div>

        <!--Search Box-->
        <div class="search-box">
            <input type="search" placeholder="Search Hear.....">
        </div>
    </header> 
    <br><br><br><br>
    <!--container-->
    <div class="Products-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="box">';
                echo '<img src="images/' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["name"]) . '">';
                echo '<h3>' . htmlspecialchars($row["name"]) . '</h3>';
                echo '<div class="product" data-id="' . htmlspecialchars($row["id"]) . '" data-name="' . htmlspecialchars($row["name"]) . '" data-price="' . htmlspecialchars($row["price"]) . '">';
                echo '<span>Rs.' . htmlspecialchars($row["price"]) . '/=</span>';
                echo '<btn class="add-to-cart" style="cursor: pointer">Add to Cart</btn>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No products found.";
        }
        $conn->close();
        ?>
    </div>

    <section id="cart">
        <h2>Shopping Cart</h2>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <!-- Cart items will be dynamically added here -->
            </tbody>
        </table>
        <div id="cart-total">
            <h3>Total: Rs.<span id="total-amount">0</span></h3>
            <button id="checkout">Checkout</button>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cart = [];

            function updateCart() {
                const cartItems = document.getElementById('cart-items');
                cartItems.innerHTML = '';
                let totalAmount = 0;

                cart.forEach(item => {
                    const row = document.createElement('tr');

                    row.innerHTML = `
                        <td>${item.name}</td>
                        <td><input type="number" value="${item.quantity}" min="1" data-id="${item.id}" class="update-quantity"></td>
                        <td>Rs.${item.price}</td>
                        <td>Rs.${item.quantity * item.price}</td>
                        <td><button data-id="${item.id}" class="remove-from-cart">Remove</button></td>
                    `;

                    cartItems.appendChild(row);
                    totalAmount += item.quantity * item.price;
                });

                document.getElementById('total-amount').textContent = totalAmount;
            }

            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', (e) => {
                    const product = e.target.closest('.product');
                    const productId = product.getAttribute('data-id');
                    const productName = product.getAttribute('data-name');
                    const productPrice = product.getAttribute('data-price');

                    const cartItem = cart.find(item => item.id === productId);
                    if (cartItem) {
                        cartItem.quantity++;
                        
                    } else {
                        cart.push({ id: productId, name: productName, price: productPrice, quantity: 1 });
                        alert('Item added to the cart');
                    }

                    updateCart();
                    document.getElementById('cart').style.display = 'block';
                });
            });

            document.getElementById('cart-items').addEventListener('change', (e) => {
                if (e.target.classList.contains('update-quantity')) {
                    const productId = e.target.getAttribute('data-id');
                    const newQuantity = parseInt(e.target.value);
                    const cartItem = cart.find(item => item.id === productId);

                    if (cartItem) {
                        cartItem.quantity = newQuantity;
                        updateCart();
                    }
                }
            });

            document.getElementById('cart-items').addEventListener('click', (e) => {
                if (e.target.classList.contains('remove-from-cart')) {
                    const productId = e.target.getAttribute('data-id');
                    const itemIndex = cart.findIndex(item => item.id === productId);

                    if (itemIndex > -1) {
                        cart.splice(itemIndex, 1);
                        updateCart();
                    }
                }
            });

            document.getElementById('checkout').addEventListener('click', () => {
                if (cart.length === 0) {
                    alert('Your cart is empty.');
                    return;
                }

                let receipt = 'Receipt:\n\n';
                let totalAmount = 0;

                const now = new Date();
                const timestamp = `${now.toLocaleDateString()} ${now.toLocaleTimeString()}`;

                receipt += `Date: ${timestamp}\n\n`;

                cart.forEach(item => {
                    receipt += `${item.name} - ${item.quantity} x Rs.${item.price} = Rs.${item.quantity * item.price}\n`;
                    totalAmount += item.quantity * item.price;
            });

                receipt += `\nTotal: Rs.${totalAmount}`;
                alert(receipt);

                cart.length = 0;
                updateCart();
                document.getElementById('cart').style.display = 'none';
            });
        });
    </script>
    <script src="script.js"></script>
</body>
</html>
```

