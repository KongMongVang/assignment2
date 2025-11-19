<?php
// Connect to database
include "reusable/connect.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm = trim($_POST["confirm"]);

    if ($username == "" || $email == "" || $password == "" || $confirm == "") {
        $error = "Please fill in all fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";

    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";

    } else {

        $checkSql = "SELECT * FROM users WHERE email='$email' OR username='$username'";
        $result = mysqli_query($connect, $checkSql);

        if (mysqli_num_rows($result) > 0) {
            $error = "This username or email already exists.";
        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insertSql = "
                INSERT INTO users (username, email, password)
                VALUES ('$username', '$email', '$hashedPassword')
            ";

            if (mysqli_query($connect, $insertSql)) {
                $success = "Registration successful! Redirecting...";

                // Redirect to login after 2 seconds
                header("refresh:2; url=login.php");

            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body { 
            font-family: Arial; 
            background:#eef2f3; 
            padding:40px; 
        }
        form {
            width: 350px;
            background: #fff;
            padding: 65px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 6px;
            align: center
        }
        .error { color: red; }
        .success { color: green; font-weight: bold; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Create an Account</h2>

<form method="POST">

    <?php if($error) echo "<p class='error'>$error</p>"; ?>
    <?php if($success) echo "<p class='success'>$success</p>"; ?>

    <input type="text" name="username" placeholder="Enter username" required>
    <input type="email" name="email" placeholder="Enter email" required>
    <input type="password" name="password" placeholder="Enter password" required>
    <input type="password" name="confirm" placeholder="Confirm password" required>

    <button type="submit">Register</button>

    <p style="text-align:center;">
        Already have an account? <a href="login.php">Login here</a>
    </p>

</form>

</body>
</html>
