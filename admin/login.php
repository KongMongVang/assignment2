<?php
include('reusable/connect.php');
session_start();

$error = "";
$success = "";

if (isset($_POST['login'])) {

    // Escape special characters in the submitted email to prevent SQL injection
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($connect, $query);

    if (!$result || mysqli_num_rows($result) == 0) {
        $error = "Invalid email or password.";
    } else {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($_POST['password'], $user['password'])) {

            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];

            header("Location: ../index.php");
            exit;

        } else {
            $error = "Invalid email or password.";
        }
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ontario Public Schools</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <div class="container fluid">
    <div class="container">
      <div class="row">
        <div class="col text-center">
          <h3 class="mt-5 mb-5">Login</h3>
        </div>
      </div>
      <div class="row">
        <div class="col">
            <?php if($error) echo "<p class='error'>$error</p>"; ?>
            <?php if($success) echo "<p class='success'>$success</p>"; ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 offset-md-4 mt-5">
          <form method="POST" action="login.php">
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>