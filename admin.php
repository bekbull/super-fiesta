<?php
// Include config file
require_once "setup.php";
if ($_COOKIE['admin'] != '') {
  header('Location: ./dashboard.php');
}
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // assert all variables like password, login 
  $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
  $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
  // in order to hide real password hash it
  $password = md5($password . "itsADMINsupersecr3tkeeeey");
  // inquiring to check client's credentials
  $result = $link->query("SELECT * FROM `admins` WHERE `username` = '$username' AND `password` = '$password'");
  // Fetch assoc is used to make an array from result
  $user = $result->fetch_assoc();
  // respond the respective message if there is no client
  if (count($user) == 0) {
    $error_message = "Failed to login";
    echo $error_message;
    // else set cookies of email and login for one week, after that the clinet will be logged out
  } else {
    setcookie('admin', $user['username'], time() + 3600 * 24 * 7, "/");
  //  redirect client to the main page
    header('Location: ./index.php');
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
    form div input[type=text], form div input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0 15px;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        border-radius: 5px;
    }

    form div button {
        background-color: #0074d9;
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
    <form method="POST" action="./admin.php">
      <div class="container">
        <h2 class="container-name">Admin login</h2>
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Username" name="username" required>
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Password" name="password" required>
        <button type="submit">Login</button>
      </div>
    </form>
</body>
</html>