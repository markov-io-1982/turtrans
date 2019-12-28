<?php
include_once dirname(dirname(__FILE__)) . '/connect.php';

class Settings {
    
    private $db;
    private $id;

    function __construct() {
        global $db;
        $this->db = $db;
        $this->id = $_SESSION['user']['id'];
        if (isset($_POST['loadSettings'])) {
            $this->loadSettings();
        } else if (isset($_POST['saveSettings'])) {
            $this->saveSettings();
        } else if (isset($_POST['savePassword'])) {
            $this->savePassword();
        }  
    }   

    private function loadSettings() {
        $results = array();
        $positions = array();
        
        if ($this->id > 0) {
            $sql = 'SELECT * FROM users WHERE id = '.$this->id;
            $query = $this->db->query($sql);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            !empty($row['photo']) ? $photo = '../photo/users/'.$row['photo'] : $photo = 'http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg';
            
            $results = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'position_id' => $row['position_id'],
                'phone' => $row['phone'],
                'email' => $row['email'],
                'photo' => $photo
            );
        }
        
        $sql = 'SELECT * FROM positions WHERE status = 1';
        $query = $this->db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $positions[] = array('id' => $row['id'], 'name' => $row['name']);    
        }
        $results['positions'] = $positions; 
        
        echo json_encode($results);
    }
    
    private function saveSettings() {
        $id = $this->id;
        $sql = 'SELECT * FROM users WHERE id = '.$id;
        $query = $this->db->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        if (isset($row)) {
            $name = isset($_POST['name']) ? $_POST['name'] : $row['name'];
            $phone = isset($_POST['phone']) ? $_POST['phone'] : $row['phone'];
            $email = isset($_POST['email']) ? $_POST['email'] : $row['email'];

            $sql = 'UPDATE `users` SET `name` = :name, `phone` = :phone, `email` = :email WHERE id = '.$id;
            $query = $this->db->prepare($sql);
            $query->bindParam(":name", $name);
            $query->bindParam(":phone", $phone);
            $query->bindParam(":email", $email);
            $query->execute();
            
            if (!empty($_FILES['photo']['tmp_name'])) {
                $this->uploadImage($id);    
            }
            
        } 
    }
    
    private function savePassword() {
        $id = $this->id;
        $sql = 'SELECT * FROM users WHERE id = '.$id;
        $query = $this->db->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        if (isset($row)) {
            $db_pass = $row['pass'];
            $old_pass = $_POST['old_pass'];
            $new_pass = $_POST['new_pass'];
            $confirm_pass = $_POST['confirm_pass'];
            
            if ($db_pass != $old_pass) {
                echo "Старий пароль невірний!";
            } else if ($new_pass != $confirm_pass) {
                echo "Введені паролі не співпадають!";
            } else {
                $sql = 'UPDATE `users` SET `pass` = "'.$new_pass.'" WHERE id = '.$id;
                $query = $this->db->query($sql);
                echo "Пароль успішно змінено!";                
            }
                                   
        }        
    }
    
    private function uploadImage($id) {
        $filename = 'user'.$id.'_'.time().'.jpg';
        $maxDimW = 200;
        $maxDimH = 200;
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
        move_uploaded_file($_FILES['photo']['tmp_name'], '../../photo/users/'.$filename);
        $sql = 'UPDATE `users` SET `photo` = "'.$filename.'" WHERE id = '.$id;
        $query = $this->db->query($sql);
    }
    
}

$settings = new Settings();
?>