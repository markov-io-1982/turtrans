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
    
    if (isset($_SESSION['user']['id'])) {
        $id = $_SESSION['user']['id'];
        $sql = 'SELECT * FROM passengers WHERE id = '.$id;
        $query = $db->query($sql);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($user['photo'])) {
            $user['preview_photo'] = 'photo/passengers/'.$user['photo'];
            $user['side_photo'] = 'photo/passengers/'.$user['photo'];
            $user['ava_photo'] = 'photo/passengers/'.$user['photo'];
        } else {
            $user['preview_photo'] = 'http://via.placeholder.com/420x420';
            $user['side_photo'] = 'https://i.pinimg.com/originals/c3/55/2c/c3552c4c1d71dcd0f502a33260110cc3.png';
            $user['ava_photo'] = 'http://via.placeholder.com/420x420';
        }
    } else {
        $user = array();
        $user['preview_photo'] = 'http://via.placeholder.com/420x420';
        $user['side_photo'] = 'https://i.pinimg.com/originals/c3/55/2c/c3552c4c1d71dcd0f502a33260110cc3.png';
        $user['ava_photo'] = 'http://via.placeholder.com/420x420';
    }

?>