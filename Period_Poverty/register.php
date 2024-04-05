
<?php
    require 'connection.php';
    if (!empty($_SESSION["id"])) {
        header("Location: index.php");
    }
    if (isset($_POST["submit"])) {
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $type = $_POST["type"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        $dublicate = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        if (mysqli_num_rows($dublicate) > 0) {
            echo "<script>alert('Email Already Taken!')</script>";
        } else {
            if ($password == $cpassword) {
                $query = "INSERT INTO users VALUES('', '$fullname', '$email', '$type', '$password')";
                mysqli_query($conn, $query);
                echo "<script>alert('Registration Successful!')</script>";
            } else {
                echo "<script>alert('Password do not match!')</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Period Poverty Awareness</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333;
        }

        header {
            background-color: #ff66b2;
            color: #fff;
            padding: 10px 0;
        }

        nav ul {
            list-style-type: none;
            text-align: center;
        }

        nav ul li {
            display: inline-block;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul li a.active {
            border-bottom: 2px solid #fff;
        }

        .form-container {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            color: #ff66b2;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group button {
            background-color: #ff66b2;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Ensures padding and border are included in width */
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background-color: #ff66b2;
            color: #fff;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }

        /* Media queries for responsiveness */
        @media only screen and (max-width: 600px) {
            nav ul li {
                display: block;
                margin-bottom: 10px;
            }

            .form-container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="#" class="active">Account</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="form-container">
        <h2>Register to Support Period Poverty Awareness</h2>
        <form action="#" method="post" autocomplete="off">
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="type">Select User Type</label>
                <select name="type" id="type" required>
                    <option value="" disabled selected>Select Type</option>
                    <option value="regular">Regular User</option>
                    <option value="guest">Guest User</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="cpassword">Confirm Password</label>
                <input type="password" id="cpassword" name="cpassword" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Register</button>
            </div>
        </form>
        <p>Already have an account? <a href="sign.php">Sign In</a></p>
    </div>

    <footer>
        <p>&copy; 2024 Period Poverty Awareness. All rights reserved.</p>
    </footer>
</body>
</html>