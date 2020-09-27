<?php
	if (!empty($_POST)) {
        $name1 = isset($_POST['name1']) ? $_POST['name1'] : null;
        $name2 = isset($_POST['name2']) ? $_POST['name2'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
        $pass = isset($_POST['pass']) ? $_POST['pass'] : null;
        $status = 1;
        $carrier_id = 1;
        
        $sql = 'INSERT `passengers` SET 
            `name1` = :name1,
            `name2` = :name2,
            `email` = :email,
            `phone` = :phone,
            `pass` = :pass,
            `status` = :status,
            `carrier_id` = :carrier_id
        ';
        $query = $db->prepare($sql);
        $query->bindParam(":name1", $name1);
        $query->bindParam(":name2", $name2);
        $query->bindParam(":email", $email);
        $query->bindParam(":phone", $phone);
        $query->bindParam(":pass", $pass);
        $query->bindParam(":status", $status);
        $query->bindParam(":carrier_id", $carrier_id);
        $query->execute();

        $insert_id = $db->lastInsertId();

        $_SESSION['user']['id'] = $insert_id;
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
            //$ip = '192.168.100.200';
        }
        $sql = 'UPDATE `passengers` SET `ip` = "'.$ip.'",  `last_login` = "'.date("Y-m-d H:i:s").'" WHERE id = '.$insert_id;
        $query = $db->query($sql);

		header('Location: index.php');
	}
?>