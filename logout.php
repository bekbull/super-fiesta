<?php 
 // in order to logout remove the info from COOKIES  
    setcookie('username', $user['username'], time() - 3600 * 24 * 7, "/");
    setcookie('admin', $user['admin'], time() - 3600 * 24 * 7, "/");
    header('Location: ./index.php');
?>