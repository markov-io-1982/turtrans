<?php
    require 'connect.php';

    $sql = 'UPDATE `users` SET `last_logout` = "'.date("Y-m-d H:i:s").'" WHERE id = '.$_SESSION['admin']['id'];
    $query = $db->query($sql);

    unset($_SESSION['admin']);
    header('Location: signin.php');
?>

