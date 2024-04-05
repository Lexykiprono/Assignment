
<?php
require 'connection.php';
session_start();

if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // Check if the form is submitted for updating user details
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
        // Update user details code...

    }

    // Check if the delete button is clicked
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
        // Delete user account code...
    }

    // Check if the donate button is clicked
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['donate'])) {
        $amount = $_POST['amount'];
        $fullname = $_POST['fullname'];

        $insert_query = "INSERT INTO donation (id, fullname, amount) VALUES ('', '$fullname', $amount)";

        if (mysqli_query($conn, $insert_query)) {
            echo "<script>alert('Donation added successfully!')</script>";
            // Refresh the page to display updated information
            header("Refresh:0");
        } else {
            echo "<script>alert('Error adding donation!')</script>" . mysqli_error($conn);
        }
    }

    // Retrieve donation history for the user
    $donation_history_query = "SELECT * FROM donation WHERE fullname = '{$row['fullname']}'";
    $donation_history_result = mysqli_query($conn, $donation_history_query);
} else {
    header("Location: sign.php");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
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

        .profile-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1, h2, h3 {
            margin-bottom: 10px;
            color: #ff66b2;
        }

        .profile-details {
            margin-bottom: 20px;
        }

        .profile-details label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }

        .profile-details p {
            display: inline-block;
            margin: 0;
        }

        .logout-btn {
            background-color: #ff66b2;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #e64d91;
        }

        .donation-container {
            margin-top: 30px;
        }

        .donation-form {
            background-color: #f2f2f2;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .donation-form h2 {
            color: #ff66b2;
            margin-bottom: 10px;
        }

        .update-form {
            background-color: #f2f2f2;
            border-radius: 8px;
            padding: 20px;
        }

        .update-form h2 {
            color: #ff66b2;
            margin-bottom: 10px;
        }

        .update-form .form-group {
            margin-bottom: 15px;
        }

        .update-form .form-group label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }

        .update-form .form-group input {
            width: 300px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .update-form .form-group button {
            background-color: #ff66b2;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .update-form .form-group button:hover {
            background-color: #e64d91;
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background-color: #ff66b2;
            color: #fff;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="#" class="active">Profile</a></li>
                <li><a href="logout.php" class="logout-btn">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="profile-container">
        <h1>Welcome, <?php echo $row["fullname"]; ?></h1>
        <div class="profile-details">
            <label>Full Name:</label>
            <p><?php echo $row["fullname"]; ?></p>
        </div>
        <div class="profile-details">
            <label>Email:</label>
            <p><?php echo $row["email"]; ?></p>
        </div>
        <div class="profile-details">
            <label>Role:</label>
            <p><?php echo $row["type"]; ?></p>
        </div>

        <div class="donation-container">
            <div class="donation-form">
                <h2>Make a Donation</h2>
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="amount">Amount in USD:</label>
                        <input type="hidden" id="fullname" name="fullname" value="<?php echo $row["fullname"]; ?>">
                        <input type="number" id="amount" name="amount" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="donate">Donate Now</button>
                    </div>
                </form>
            </div>

            <div class="donation-container">
                <div class="donation-form">
                <h2>Donation History</h2>
                <ul>
                <?php
                    while ($donation_row = mysqli_fetch_assoc($donation_history_result)) {
                        echo "<li>{$donation_row['amount']} USD";
                        if (isset($donation_row['date'])) {
                            echo " - {$donation_row['date']}";
                        }
                        echo "</li>";
                    }
                    ?>
                </ul>
                </div>
            </div>

            <div class="update-form">
                <h2>Update Profile</h2>
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="fullname">Full Name:</label>
                        <input type="text" id="fullname" name="fullname" value="<?php echo $row["fullname"]; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $row["email"]; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="update">Update Details</button>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="delete"  onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Period Poverty Awareness. All rights reserved.</p>
    </footer>
</body>
</html>