<?php
    if (isset($_POST['login'])) {
        // by phone
        $stmt = $db->prepare('SELECT * FROM passengers WHERE phone = :login AND pass = :pass');
        $stmt->bindParam(':login', $_POST['login'], PDO::PARAM_STR);
        $stmt->bindParam(':pass', $_POST['pass'], PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();

        // try bu email    
        if (empty($row)) {
            $stmt = $db->prepare('SELECT * FROM passengers WHERE email = :login AND pass = :pass');
            $stmt->bindParam(':login', $_POST['login'], PDO::PARAM_STR);
            $stmt->bindParam(':pass', $_POST['pass'], PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
        }    

        if (!empty($row)) {
            $_SESSION['user']['id'] = $row['id'];
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
                //$ip = '192.168.100.200';
            }
            $sql = 'UPDATE `passengers` SET `ip` = "'.$ip.'",  `last_login` = "'.date("Y-m-d H:i:s").'" WHERE id = '.$row['id'];
            $query = $db->query($sql);
            header('Location: index.php');
        } else {
            //echo "Невірний логін або пароль!";
        }
    }

?>