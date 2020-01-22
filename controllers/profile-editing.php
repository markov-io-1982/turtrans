<?php
    function uploadImage($db, $id) {
        $filename = 'passenger'.$id.'_'.time().'.jpg';
        $maxDimW = 420;
        $maxDimH = 420;
        list($width, $height, $type, $attr) = getimagesize($_FILES['photo']['tmp_name']);
        if ( $width > $maxDimW || $height > $maxDimH ) {
            $target_filename = $_FILES['photo']['tmp_name'];
            $fn = $_FILES['photo']['tmp_name'];
            $size = getimagesize( $fn );
            $ratio = $size[0]/$size[1]; // width/height
            if( $ratio > 1) {
                $width = $maxDimW;
                $height = $maxDimH/$ratio;
            } else {
                $width = $maxDimW*$ratio;
                $height = $maxDimH;
            }
            $src = imagecreatefromstring(file_get_contents($fn));
            $dst = imagecreatetruecolor( $width, $height );
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
        
            imagejpeg($dst, $target_filename); // adjust format as needed
        }
        move_uploaded_file($_FILES['photo']['tmp_name'], 'photo/passengers/'.$filename);
        $sql = 'UPDATE `passengers` SET `photo` = "'.$filename.'" WHERE id = '.$id;
        $query = $db->query($sql);
    }


	if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $sql = 'UPDATE `passengers` SET 
            `name1` = :name1,
            `name2` = :name2,
            `name3` = :name3,
            `email` = :email,
            `phone` = :phone,
            `city` = :city,
            `country` = :country, 
            `description` = :description
            WHERE id = '.$id;
        $query = $db->prepare($sql);
        $query->bindParam(":name1", $_POST['name1']);
        $query->bindParam(":name2", $_POST['name2']);
        $query->bindParam(":name3", $_POST['name3']);
        $query->bindParam(":email", $_POST['email']);
        $query->bindParam(":phone", $_POST['phone']);
        $query->bindParam(":city", $_POST['city']);
        $query->bindParam(":country", $_POST['country']);
        $query->bindParam(":description", $_POST['description']);
        $query->execute();
            
        if (!empty($_FILES['photo']['tmp_name'])) {
            uploadImage($db, $id);    
        } 
        header('Location: profile.php');

	} else {

	}

?>