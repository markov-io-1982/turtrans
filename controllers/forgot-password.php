<?php
	if (!empty($_POST)) {
        $stmt = $db->prepare('SELECT * FROM passengers WHERE email = :email');
        $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();

        if (!empty($row)) {
        	// generate new pass
        	$bytes = random_bytes(5);
			$pass = bin2hex($bytes);
            $sql = 'UPDATE `passengers` SET `pass` = "'.$pass.'" WHERE id = '.$row['id'];
            $query = $db->query($sql);

            // send email
            $to_email = $row['email'];
			$subject = 'Новий пароль';
			$message = 'Ваш новий пароль - '.$pass;
			$headers = 'From: kalush.turtrans@gmail.com';
			$result = mail($to_email, $subject, $message, $headers);
        	header('Location: index.php');
        }
    }
?>