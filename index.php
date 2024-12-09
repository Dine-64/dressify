<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dressify</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <!--Navbar-->
    <header>
        <!--logo icon-->
        <a href="#home" class="logo">
            <img src="images/logo.jpg" alt="">
        </a>
        <!--Menu icon-->
        <i class='bx bx-menu' id="menu-icon"></i>
        <!--Links-->
        <ul class="navbar">
            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="logout.php">Hi <?php echo $_SESSION['user_name']; ?> Logout</a> <a href="edit.php">Edit Profile</a></li>
            <?php else: ?>
                <li><a href="login.php#login">Login</a></li>
            <?php endif; ?>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#products">Products</a></li>
            <li><a href="#customer">Customers</a></li>
        </ul>

        <!--Icons-->
        <div class="header-icon">
            <i class='bx bx-cart-alt'></i>
            <i class='bx bx-search-alt-2' id="search-icon"></i>
        </div>

        <!--Search Box-->
        <div class="search-box">
            <input type="search" placeholder="Search Hear.....">
        </div>
    </header> 
    <!--Home-->
    <section class="home" id="home">
        <div class="home-text">
            <h1>Where every outfit tells a story! 💖✨</h1>
            <p>"Dressify offers a harmonious blend of elegance and style, 
                featuring high-quality apparel and accessories 
                crafted for every occasion. Embrace timeless fashion 
                that complements your unique beauty with Dressify."</p>
                <br>
                <a href="#products" class="btn">Shop Now</a>
        </div>
        <div class="home-img">
            <img src="images/img1.jpg" alt="">
        </div>
    </section>
    <!--About-->
    <section class="about" id="about">
        <div class="about-img">
            <img src="images/bg.jpeg" alt="">
        </div>
        <div class="about-text">
        <h2>About Us</h2>
        <p>Welcome to Dressify, where fashion meets elegance. At Dressify, 
        we believe that every piece of clothing tells a story and that your wardrobe should reflect your unique style and personality.</p> 
        <p>Our collection is a carefully curated blend of trendy and timeless pieces, 
        designed to offer high-quality apparel and accessories for every occasion. 
        From chic everyday wear to sophisticated evening outfits, we aim to provide our customers with the perfect look for any moment.</p> 
        <p>Founded with a passion for fashion and a commitment to excellence, 
        Dressify stands out for its dedication to quality, style, and customer satisfaction. 
        Our team of designers and fashion experts work tirelessly to bring you the latest trends, 
        while ensuring each item meets our high standards of craftsmanship and durability.</p>
        <p>At Dressify, we strive to make your shopping experience enjoyable and fulfilling. 
        Our friendly customer service team is always here to assist you, ensuring you find exactly what you’re looking for.</p>
        <p>Join us on our fashion journey and discover the Dressify difference – where elegance, quality, and style come together to create something truly special. 
        Thank you for choosing Dressify.</p>
        <br>
        <a href="#" class="btn">Learn More</a>
        </div>
    </section>

    <!--Products-->
    <section class="products" id="products">
        <div class="heading">
            <h2>Our Products</h2>
        </div>
        <!--container-->
        <div class="Products-container">
            
            <div class="box">
                <img src="images/p1.jpg" alt="">
                <h3>Azure Blossom Dress</h3>
                <div class="content">
                    <span>Rs.2000/=</span>
                    <a href="">Add To Cart</a>
                </div>
                <div class="content">
                <a href="products.php">More</a>
                </div>
            </div>

            <div class="box">
                <img src="images/p2.jpg" alt="">
                <h3>Floral Flair Sundress</h3>
                <div class="content">
                    <span>Rs.2000/=</span>
                    <a href="#">Add To Cart</a>
                </div>
            </div>

            <div class="box">
                <img src="images/p3.jpg" alt="">
                <h3>Blossom Breeze</h3>
                <div class="content">
                    <span>Rs.2000/=</span>
                    <a href="#">Add To Cart</a>
                </div>
            </div>

            <div class="box">
                <img src="images/p4.jpg" alt="">
                <h3>Elegance Blossom</h3>
                <div class="content">
                    <span>Rs.2000/=</span>
                    <a href="#">Add To Cart</a>
                </div>
            </div>

        </div>
    </section>

    <!--Customers-->
    <section class="customer" id="customer">
        <div class="heading">
            <h2>Our Customer's</h2>
        </div>
        <!--container-->
        <div class="customers-container">

            <div class="box">
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star-half' ></i>
                </div>
                <p>I absolutely love shopping at Dressify! They have a fantastic selection of stylish and trendy 
                    clothing that always keeps me coming back for more. Whether I'm looking for a chic outfit for work or 
                    something casual for the weekend, Dressify never disappoints. The quality of their clothes is excellent, 
                    and I always receive compliments when I wear their pieces. Moreover, their customer service is top-notch — friendly, helpful, and always willing to assist. Shopping at Dressify is truly a delightful experience, 
                    and I highly recommend it to anyone looking for fashionable clothing..</p>
                <h2>Tharushi Ravinya</h2>
                <img src="images/ravinya.jpg" alt="">
            </div>
            <div class="box">
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star-half' ></i>
                </div>
                <p>Dressify has become my go-to shop for all things fashion! Their collection is curated with the latest trends in mind, 
                    and I love how easy it is to find something that fits my style perfectly. The quality of their garments is exceptional, 
                    and each piece feels like a luxurious find without breaking the bank. What sets Dressify apart is not just their amazing products 
                    but also their attention to detail in customer service. I've had nothing but positive experiences — from quick shipping to hassle-free returns. 
                    If you're looking for a clothing store that combines style, quality, and great service, Dressify is the place to go!</p>
                <h2>Sandali Gayasha</h2>
                <img src="images/sandali2.jpg" alt="">
            </div>
            <div class="box">
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star-half'></i>
                </div>
                <p>Dressify exceeded all expectations when I purchased a suit for my girlfriend from their store. 
                    The entire experience, from browsing their stylish collection to finding the perfect fit, was seamless. 
                    The suit itself was not only beautifully crafted but also made my girlfriend feel incredibly special. 
                    Dressify's attention to detail and commitment to quality were evident in every aspect of the purchase. 
                    The staff was helpful and ensured that I found exactly what I was looking for. Thanks to Dressify, 
                    I was able to make a memorable and stylish gesture that my girlfriend absolutely loved. 
                    I highly recommend Dressify to anyone looking for exceptional clothing and a wonderful shopping experience.</p>
                <h2>Hansana Sandamaal</h2>
                <img src="images/hansana.jpg" alt="">
            </div>
        </div>
    </section>

    <!--Footer Section-->
    <section class="footer">
        <div class="footer-box">
            <h3>Dressify</h3>
            <p>Dressify: Your ultimate destination for chic and trendy apparel. 
                Discover a curated selection of stylish clothing and accessories that redefine your wardrobe. 
                Embrace fashion that speaks to your unique style, only at Dressify.</p>

            <div class="social">
                <a href="https://web.facebook.com/profile.php?id=100094581116937"><i class='bx bxl-facebook-circle'></i></a>
                <a href="#"><i class='bx bxl-twitter' ></i></a>
                <a href="https://www.instagram.com/dressify_____sl/"><i class='bx bxl-instagram-alt' ></i></a>
                <a href="https://www.tiktok.com/@dressify?_t=8ns3R9prfFJ&_r=1"><i class='bx bxl-tiktok' ></i></a>
            </div>
        </div>

        <div class="footer-box">
            <h3>Support</h3>
            <li><a href="#">Products</a></li>
            <li><a href="#">Help & Support</a></li>
            <li><a href="#">Return Policy</a></li>
            <li><a href="#">Terms of Use</a></li>
            <li><a href="#">Products</a></li>
        </div>

        <div class="footer-box">
            <h3>View Guides</h3>
            <li><a href="#">Features</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Blog Post</a></li>
            <li><a href="#">Our Branches</a></li>
        </div>

        <div class="footer-box">
        <h3>Contact</h3>
        <div class="contact">
        <span><i class='bx bx-map' ></i>205/A, Pore, Athurugiriya</span>
        <span><i class='bx bx-phone-call' ></i>077 028 2756</span>
        <span><i class='bx bx-envelope'></i>dressify.sl@gmail.com</span>
    </div>
    </div>
    </section>
    <script src="script.js"></script>
</body>
</html>