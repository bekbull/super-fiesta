<?php
// Include config file
require_once "setup.php";
// redirect the user to the main page if there is an email in COOKIE
if ($_COOKIE['username'] != '') {
  header('Location: ./index.php');
}
if ($_COOKIE['admin'] != '') {
  header('Location: ./dashboard.php');
}
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // assert all variables like password, login and email
  $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
  $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
  $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
  //   in order to check user's existence, check credentials
  $result = $link->query("SELECT * FROM `users` WHERE `username`='$username' OR email='$email' LIMIT 1");
  $user = $result->fetch_assoc();
  // respond respective page if there is someone at the barber
  if ($user) {
    $error_message = "Email or Phone already exists";
  } else {
    // hash the password with the salt
    $password = md5($password . "itsmysupersecr3tkeeeey");
    // insert the new client
    $link->query("INSERT INTO `users` (`username`, `email`, `password`) VALUES ('$username', '$email', '$password')");
    // redirect to the login page
    header('Location: ./login.php');
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<style>
    .container-name {
        margin: 30px 0 15px;
    }
    form div input[type=text], form div input[type=password], form div input[type=email] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0 15px;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        border-radius: 5px;
    }

    form div button {
        background-color: #2ecc40;
        color: white;
        padding: 14px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        border-radius: 5px;
    }

    form div button:hover {
        opacity: 0.8;
    }

    .container {
        max-width: 300px;
        margin: 0 auto;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }

    form div a {
        text-align: center;
        display: block;
        margin-top: -10px;
        margin-bottom: 15px;
    }
</style>
<body>
    <header>
        <h2>ELNARA TOP</h2>
        <ul>
            <li><a href="./index.php">Home</a></li>
            <li><a href="./register.php"><button>Get started</button></a></li>
        </ul>
    </header>
    <form method="POST" action="./register.php">
      <div class="container">
        <h2 class="container-name">Get started</h2>
        <label for="uname"><b>Email</b></label>
        <input type="Email" placeholder="Email" name="email" required>
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Username" name="username" required>
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Password" name="password" required>
        <a href="./login.php">Already registered?</a>
        <button type="submit">Get started</button>
      </div>
    </form>
</body>
</html>