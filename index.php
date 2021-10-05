<?php
if ($_COOKIE['admin'] != '') {
    header('Location: ./dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
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
                <li><a href="./logout.php"><button
                    style="background-color: #ff4136;border: 1px solid #ff4136;color: white;">Logout</button></a></li>
            <?php endif; ?>
        </ul>
    </header>
    <main>
        <div class="">
            <h3>We are hiring 🎉</h3>
            <p style="margin-top: 25px;">We need awaiter/waitress. If you are more than 16 then you can apply to the job. Job is still open.</p>
            <p style="margin-top: 5px;">You have to be logged in to be able to apply.</p>
            <a href="./apply.php"><button>Apply now</button></a>
        </div>
    </main>
</body>
</html>