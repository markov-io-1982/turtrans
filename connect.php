<?php
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);

    ob_start();
    session_start();

    $user = 'root';
    $pass = '';

    //$user = 'turtrans';
    //$pass = 'uUqHQ1TJ';
    
    $db = new PDO('mysql:host=localhost;dbname=turtrans', $user, $pass);
    
?>