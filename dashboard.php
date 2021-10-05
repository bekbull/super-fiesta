<?php 
if ($_COOKIE['admin'] == '') {
    header('Location: ./index.php');
}
require_once "setup.php";
$result = $link->query("SELECT * FROM `applications`");
// $apps = $result->fetch_assoc();
// while($row = $result->fetch_assoc()){
//     echo $row['age'];
//     echo $row['phone'];
//     echo $row['bio'];
//     echo $row['username'];
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin</title>
</head>
<style>
    .application {
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        margin-bottom: 25px;
        padding: 12px 20px;
        border-radius: 5px;
    }
    .application p {
        margin-bottom: 8px;
    }
</style>
<body>
    <header>
        <h2>ELNARA ADMIN PAGE</h2>
        <a href="./logout.php">
                <button 
                    style="
                    background-color: #ff4136;
                    border: 1px solid #ff4136;
                    color: white;
                ">
                Logout
                </button>
            </a>
    </header>
    <main class="admin-main">
    <? while($row = $result->fetch_assoc()){
        $username = $row['username'];
        $userEmailResult = $link->query("SELECT `email` FROM `users` WHERE `username`='$username' LIMIT 1");
        $userEmail = $userEmailResult->fetch_assoc();
        echo "<div class='application'>
        <b>Age</b>
        <p>{$row['age']}</p>
        <b>Phone</b>
        <p>{$row['phone']}</p>
        <b>Email</b>
        <p>{$userEmail['email']}</p>
        <b>Bio</b>
        <p>" . nl2br($row['bio']) . "</p>
        <a href='./delete-application.php?username={$row['username']}'>
            <button 
                style='
                background-color: #ff4136;
                border: 1px solid #ff4136;
                color: white;
            '>
            Delete
            </button>
        </a>
    </div>";
    }?>
    </main>
</body>
</html>