<?php
    require 'connect.php';

    $sql = 'UPDATE `passengers` SET `last_logout` = "'.date("Y-m-d H:i:s").'" WHERE id = '.$_SESSION['passenger']['id'];
    $query = $db->query($sql);

    unset($_SESSION['passenger']);
    header('Location: index.php');
?>