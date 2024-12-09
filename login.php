<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    


    if (isset($_POST['login'])) {
        // Login logic for admin
        $email = $_POST['email'];
        
        $password = $_POST['password'];

        if ($email == 'admin' && $password == '1234') {
            $_SESSION['user_id'] = 'admin';
            $_SESSION['user_role'] = 'admin';
            header("Location: admin.php");
            exit();
        }

        // Login logic for regular users
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $username = $row['username'];
                $_SESSION['user_name'] =  $username ;
                $user_id = $row['id'];
                
                $_SESSION['user_role'] = 'customer';

                // function to save user id in local storage
                function saveToLocalStorage() {
                    echo "<script>
                    localStorage.setItem('user_id', " . json_encode($user_id) . ");
                    </script>";
                }
            
                // calling the function
                saveToLocalStorage();

                header("Location: index.php");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that email.";
        }
    } elseif (isset($_POST['register'])) {
        // Registration logic
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Dressify</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        header {
            position: fixed;
            width: 100%;
            top: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 100px;
            background: rgb(227, 160, 171);
            transition: 0.5s linear;
        }

        .logo img {
            width: 80px;
        }

        .navbar {
            display: flex;
            list-style: none;
        }

        .navbar a {
            padding: 8px 17px;
            color: #fff;
            font-size: 1rem;
            text-transform: uppercase;
            font-weight: 500;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .navbar a:hover {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 0.2rem;
        }

        .menu-icon {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
            color: #fff;
        }

        @media (max-width: 768px) {
            header {
                padding: 18px 20px;
            }

            .navbar {
                display: none;
                flex-direction: column;
                background: rgb(227, 160, 171);
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                padding: 20px;
            }

            .navbar.active {
                display: flex;
            }

            .menu-icon {
                display: block;
            }
        }

        body {
            background-color: pink;
            background: linear-gradient(to right, #e2e2e2, pink);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .container p {
            font-size: 14px;
            line-height: 20px;
            letter-spacing: 0.3px;
            margin: 20px 0;
        }

        .container span {
            font-size: 12px;
        }

        .container a {
            color: #333;
            font-size: 13px;
            text-decoration: none;
            margin: 15px 0 10px;
        }

        .container button {
            background-color: rgb(234, 144, 159);
            color: #fff;
            font-size: 12px;
            padding: 10px 45px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 10px;
            cursor: pointer;
        }

        .container button.hidden {
            background-color: transparent;
            border-color: #fff;
        }

        .container form {
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            height: 100%;
        }

        .container input {
            background-color: #eee;
            border: none;
            margin: 8px 0;
            padding: 10px 15px;
            font-size: 13px;
            border-radius: 8px;
            width: 100%;
            outline: none;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.active .sign-in {
            transform: translateX(100%);
        }

        .sign-up {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.active .sign-up {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: move 0.6s;
        }

        @keyframes move {
            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .social-icons {
            margin: 20px 0;
        }

        .social-icons a {
            border: 1px solid #ccc;
            border-radius: 20%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 3px;
            width: 40px;
            height: 40px;
        }

        .toggle-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: all 0.6s ease-in-out;
            border-radius: 150px 0 0 100px;
            z-index: 1000;
        }

        .container.active .toggle-container {
            transform: translateX(-100%);
            border-radius: 0 150px 100px 0;
        }

        .toggle {
            background-color: rgb(234, 144, 159);
            height: 100%;
            background: linear-gradient(to right, rgb(234, 144, 159), rgb(234, 144, 159));
            color: #fff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .container.active .toggle {
            transform: translateX(50%);
        }

        .toggle-panel {
            position: absolute;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 30px;
            text-align: center;
            top: 0;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .toggle-left {
            transform: translateX(-200%);
        }

        .container.active .toggle-left {
            transform: translateX(0);
        }

        .toggle-right {
            right: 0;
            transform: translateX(0);
        }

        .container.active .toggle-right {
            transform: translateX(100%);
        }
    </style>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form action="login.php" method="post">
                <h2>Sign In</h2>
                <input type="text" name="email" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <a href="#">Forgot your password?</a>
                <button type="submit" name="login">Sign In</button>
            </form>
        </div>
        <div class="form-container sign-up">
            <form action="login.php" method="post">
                <h2>Register</h2>
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="register">Register</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h2>Welcome Back!</h2>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="hidden" id="signIn" >Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h2>Hello, Friend!</h2>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="hidden" id="signUp">Register</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const signInButton = document.getElementById('signIn');
        const signUpButton = document.getElementById('signUp');
        const container = document.getElementById('container');

        signInButton.addEventListener('click', () => {
            container.classList.remove("active");
        });

        signUpButton.addEventListener('click', () => {
            container.classList.add("active");
        });
    </script>
</body>

</html>