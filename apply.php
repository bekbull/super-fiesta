<?php
    require_once "setup.php";

    if ($_COOKIE['username'] == '') {
        header('Location: ./login.php');
    }
    if ($_COOKIE['admin'] != '') {
        header('Location: ./dashboard.php');
    }
    $username = $_COOKIE['username'];
    $result = $link->query("SELECT * FROM `applications` WHERE `username`='$username' LIMIT 1");
    $app = $result->fetch_assoc();
    $message = "";
    if ($app) {
        $message = "You have already applied. HR will contact you soon.";
    } 
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !$app) {
        $age = filter_var(trim($_POST['age']), FILTER_SANITIZE_STRING);
        $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
        $bio = filter_var(trim($_POST['bio']), FILTER_SANITIZE_STRING);
        $username = $_COOKIE['username'];
        $link->query("INSERT INTO `applications` (`username`, `age`, `phone`, `bio`) VALUES ('$username', '$age', '$phone', '$bio')");
        header('Location: ./index.php');
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
    .appy-form div input[type=text] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0 15px;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        border-radius: 5px;
    }

    .appy-form div button {
        background-color: #ffdc00;
        color: white;
        padding: 14px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        border-radius: 5px;
    }

    .appy-form div button:hover {
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

    .appy-form div a {
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
            <?php if ($_COOKIE['username'] != '') : ?>
            <b>Hello, <?= $_COOKIE['username']?></b>
            <?php endif; ?>
                <li><a href="./index.php">Home</a></li>
            <?php if ($_COOKIE['username'] == '') : ?>
                <li><a href="./register.php"><button>Get started</button></a></li>
            <?php endif; ?>
            <?php if ($_COOKIE['username'] != '') : ?>
                <li><a href="./logout.php"><button style="background-color: #ff4136;border: 1px solid #ff4136;color: white;">Logout</button></a></li>
            <?php endif; ?>
        </ul>
    </header>
    <?php if (strlen($message) > 0) : ?>
          <p style="max-width: 500px; margin: 40px auto;"><?= $message?></p>
    <?php else : ?>
        <form class="appy-form" method="POST" action="./apply.php">
            <div class="container">
                <h2 class="container-name">Application form</h2>
                <label for="uname"><b>Age</b></label>
                <input type="text" placeholder="Age" name="age" required>
                <label for="uname"><b>Phone</b></label>
                <input type="text" maxlength="12" placeholder="Phone number" name="phone" required>
                <div style="display: flex; flex-direction:column; align-items:flex-start;">
                    <label for="uname"><b>About yourself</b></label>
                    <textarea maxlength="2000" style="width:calc(100% - 40px); margin: 8px 0 15px; padding: 12px 20px; height: 200px;" type="text" placeholder="Bio" name="bio" required></textarea>
                </div>
                <button type="submit">Apply</button>
            </div>
        </form>
    <?php endif; ?>
    
</body>
</html>