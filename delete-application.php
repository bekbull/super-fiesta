<?php
if ($_COOKIE['admin'] == '') {
    header('Location: ./index.php');
}
require_once "setup.php";
$username = $_GET['username'];
$link->query("DELETE FROM `applications` WHERE `username`='$username'");
header('Location: ./dashboard.php');
?>