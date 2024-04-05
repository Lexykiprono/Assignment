
<?php
require 'connection.php';

$name = $email = $message = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (empty($name)) {
        $errors['name'] = "Name is required";
    }

    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    if (empty($message)) {
        $errors['message'] = "Message is required";
    }

    if (empty($errors)) {
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $message = mysqli_real_escape_string($conn, $message);

        $insert_query = "INSERT INTO contact_form (name, email, message) VALUES ('$name', '$email', '$message')";

        if (mysqli_query($conn, $insert_query)) {
            echo "<script>alert('Message sent successfully!');</script>";
            header("Location: home.html");
            exit();
        } else {
            echo "<script>alert('Error sending message!');</script>" . mysqli_error($conn);
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
    <title>Contact - Period Poverty Awareness</title>
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

        .contact-section {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            margin-bottom: 10px;
            color: #ff66b2;
        }

        form {
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group textarea {
            height: 150px;
            resize: vertical;
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

        .form-group button:hover {
            background-color: #e64d91;
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background-color: #ff66b2;
            color: #fff;
        }

        /* Media queries for responsiveness */
        @media only screen and (max-width: 600px) {
            nav ul li {
                display: block;
                margin-bottom: 10px;
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
                <li><a href="sign.php">Account</a></li>
                <li><a href="#" class="active">Contact</a></li>
            </ul>
        </nav>
    </header>

    <section class="contact-section">
        <div class="content">
            <h1>Contact Us</h1>
            <p>If you have any questions or inquiries, please feel free to get in touch with us using the form below.</p>
            <form action="" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                    <?php if (isset($errors['name'])) echo "<span style='color: red;'>{$errors['name']}</span>"; ?>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    <?php if (isset($errors['email'])) echo "<span style='color: red;'>{$errors['email']}</span>"; ?>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required><?php echo htmlspecialchars($message); ?></textarea>
                    <?php if (isset($errors['message'])) echo "<span style='color: red;'>{$errors['message']}</span>"; ?>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit">Send Message</button>
                </div>
            </form>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Period Poverty Awareness. All rights reserved.</p>
    </footer>
</body>
</html>