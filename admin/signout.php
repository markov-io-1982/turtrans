<?php
    require 'connect.php';

    $sql = 'UPDATE `users` SET `last_logout` = "'.date("Y-m-d H:i:s").'" WHERE id = '.$_SESSION['user']['id'];
    $query = $db->query($sql);

    unset($_SESSION['user']);
    header('Location: signin.php');
?>

