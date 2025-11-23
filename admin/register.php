<?php
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
                header("refresh:5; url=login.php");

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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
:root {
  --forest-green: #2d5016;
  --leaf-green: #4a7c3f;
  --sage-green: #7fa97f;
  --sky-blue: #87ceeb;
  --earth-brown: #8b7355;
  --cream: #f5f5dc;
}

/* Background + font same as parks page */
body {
  background: linear-gradient(135deg, #e8f5e9 0%, #f1f8e9 100%);
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  min-height: 100vh;
  padding: 0;
  margin: 0;
}

h1 {
  background: linear-gradient(135deg, var(--forest-green) 0%, var(--leaf-green) 100%);
  color: white;
  padding: 2rem 0;
  text-align: center;
  margin-bottom: 2rem;
  box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

/* Center form container */
.register-container {
  max-width: 450px;
  margin: auto;
}

/* Form card matching Parks card theme */
.form-card {
  background: white;
  padding: 2rem;
  border-radius: 12px;
  border-top: 5px solid var(--leaf-green);
  box-shadow: 0 4px 10px rgba(0,0,0,0.12);
 
}

.form-card:hover {
  box-shadow: 0 10px 18px rgba(0,0,0,0.18);
}

input {
  width: 100%;
  padding: 12px;
  margin: 10px 0;
  border: 2px solid var(--sage-green);
  border-radius: 6px;
  font-size: 16px;
}

button {
  width: 100%;
  padding: 12px;
  background: var(--leaf-green);
  border: none;
  color: white;
  font-size: 16px;
  border-radius: 6px;
  margin-top: 10px;
}

button:hover {
  background: var(--forest-green);
}

.error {
  color: red;
  font-weight: bold;
}

.success {
  color: green;
  font-weight: bold;
}
</style>
</head>
<body>

<!-- SAME HEADER + NAV AS PARKS PAGE -->
<?php include('reusable/admin-header.php'); ?>

<h1>Create an Account</h1>

<div class="register-container">
    <div class="form-card">

        <?php if($error) echo "<p class='error'>$error</p>"; ?>
        <?php if($success) echo "<p class='success'>$success</p>"; ?>

        <form method="POST">

            <input type="text" name="username" placeholder="Enter username" required>
            <input type="email" name="email" placeholder="Enter email" required>
            <input type="password" name="password" placeholder="Enter password" required>
            <input type="password" name="confirm" placeholder="Confirm password" required>

            <button type="submit">Register</button>

            <p style="text-align:center; margin-top:12px;">
                Already have an account?  
                <a href="login.php" style="color:var(--leaf-green);">Login here</a>
            </p>

        </form>

    </div>
</div>

</body>
</html>
