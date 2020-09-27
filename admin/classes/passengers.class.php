<?php
include_once dirname(dirname(__FILE__)) . '/connect.php';

class Passengers {
    
    private $db;
    private $carrier_id;
    private $carrier_where;
    private $roles;    

    function __construct() {
        global $db;
        $this->db = $db;
        global $user_roles;
        $this->roles = $user_roles;
        $this->setCarrier();
        
        if (isset($_POST['loadpage'])) {
            $this->loadpage();
        } else if (isset($_POST['loadRecord'])) {
            $this->loadRecord($_POST['id']);
        } else if (isset($_POST['update'])) {
            if (empty($_POST['id']))  
                $this->addRecord();
            else    
                $this->editRecord($_POST['id']);                
        } else if (isset($_POST['deleteRecord'])) {
            $this->deleteRecord($_POST['id']);
        } else if (isset($_POST['setStatus'])) {
            $this->setStatus($_POST['id'], $_POST['status']);
        }
    }   
    
    private function setCarrier() {
        // this is super admin
        if ($_SESSION['admin']['position_id'] == 1) {
            $this->carrier_id = $_SESSION['admin']['id'];
            $this->carrier_where = '1';
        }
        // this is carrier
        else if ($_SESSION['admin']['position_id'] == 2) {
            $this->carrier_id = $_SESSION['admin']['id'];
            $this->carrier_where = 'carrier_id = '.$this->carrier_id;
        }
        // this is from personnel 
        else {
            $sql = 'SELECT * FROM users WHERE id = '.$_SESSION['admin']['carrier_id'];
            $query = $this->db->query($sql);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->carrier_id = $row['id'];
            $this->carrier_where = 'carrier_id = '.$this->carrier_id;
        }    
    }

    private function loadpage() {
        $results = '';
        $sql = 'SELECT * FROM passengers WHERE '.$this->carrier_where;
        
        $query = $this->db->query($sql);

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $row['status'] == 1 ? $status = 'active' : $status = '';
            !empty($row['photo']) ? $photo = '../photo/passengers/'.$row['photo'] : $photo = 'http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg';   
            $pass = '';
            for ($i = 0; $i < strlen($row['pass']); $i++)
                $pass .= '*'; 
             
            $results .= '
                <tr>
                  <td>'.$row['id'].'</td>
                  <td>'.$row['name1'].'</td>
                  <td>'.$row['name2'].'</td>
                  <td>'.$row['name3'].'</td>
                  <td>'.$row['email'].'</td>
                  <td>'.$row['phone'].'</td>
                  <td>'.$row['trips_count'].'</td>
                  <td>'.$row['city'].'</td>
                  <td>'.$row['country'].'</td>
                  <td><img src="'.$photo.'" class="personnel-image" alt="Image"></td>
                  <td>'.$pass.'</td>
                  <td>'.$row['description'].'</td>
                  <td>'.$row['added_by'].'</td>
                  <td>
                    <a href="#" class="'.$status.'" data-toggle="class">
                        <i class="fa fa-check text-success text-active" onclick="setStatus('.$row['id'].', 0)"></i>
                        <i class="fa fa-times text-danger text" onclick="setStatus('.$row['id'].', 1)"></i></a>
                  </td>
                  <td>
                    <a href="index.php?page=passenger_account&id='.$row['id'].'" class="btn btn-sm btn-default"
                      data-toggle="tooltip" data-placement="left" title="" data-original-title="Перегляд">
                      <i class="fa fa-eye"></i>
                    </a>';
                      if ($this->roles['edit'] == 1)
                        $results .= '<a href="#modal-form" onclick="loadRecord('.$row['id'].')" class="btn btn-info btn-sm datatables-graediting-deletede"
                              data-toggle="modal" data-placement="left" title="" data-original-title="Update"><i class="fa fa-pencil" aria-hIDden="true"></i></a>';
                      if ($this->roles['del'] == 1)
                        $results .= '<a href="#" onclick="deleteRecord('.$row['id'].')" class="btn btn-danger btn-sm datatables-graediting-deletede" data-toggle="tooltip"
                              data-placement="right" title="" data-original-title="Delete "><i class="fa fa-trash-o" aria-hIDden="true"></i></a>';
                      $results .= '
                   </td>
                </tr>
            ';
        }
        echo $results;
    }

    private function loadRecord($id) {
        $results = array();
        
        if ($id > 0) {
            $sql = 'SELECT * FROM passengers WHERE id = '.$id;
            $query = $this->db->query($sql);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            !empty($row['photo']) ? $photo = '../photo/passengers/'.$row['photo'] : $photo = 'http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg';
            
            $results = array(
                'id' => $row['id'],
                'name1' => $row['name1'],
                'name2' => $row['name2'],
                'name3' => $row['name3'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'trips_count' => $row['trips_count'],
                'city' => $row['city'],
                'country' => $row['country'],
                'photo' => $photo,
                'pass' => $row['pass'],
                'description' => $row['description'],
                'status' => $row['status'],
                'added_by' => $row['added_by']
            );
        }
        
        echo json_encode($results);
    }
    
    private function addRecord() {
        $name1 = isset($_POST['name1']) ? $_POST['name1'] : null;
        $name2 = isset($_POST['name2']) ? $_POST['name2'] : null;
        $name3 = isset($_POST['name3']) ? $_POST['name3'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
        $trips_count = isset($_POST['trips_count']) ? $_POST['trips_count'] : 0;
        $city = isset($_POST['city']) ? $_POST['city'] : null;
        $country = isset($_POST['country']) ? $_POST['country'] : null;
        $photo = isset($_POST['photo']) ? $_POST['photo'] : null;
        $pass = isset($_POST['pass']) ? $_POST['pass'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $status = isset($_POST['status']) ? $_POST['status'] : 0;
        $added_by = $_SESSION['admin']['name'];
        
        $sql = 'INSERT `passengers` SET 
            `name1` = :name1,
            `name2` = :name2,
            `name3` = :name3,
            `email` = :email,
            `phone` = :phone,
            `trips_count` = :trips_count,
            `city` = :city,
            `country` = :country, 
            `photo` = :photo,
            `pass` = :pass,
            `description` = :description,
            `status` = :status,
            `added_by` = :added_by,
            `carrier_id` = :carrier_id
        ';
        $query = $this->db->prepare($sql);
        $query->bindParam(":name1", $name1);
        $query->bindParam(":name2", $name2);
        $query->bindParam(":name3", $name3);
        $query->bindParam(":email", $email);
        $query->bindParam(":phone", $phone);
        $query->bindParam(":trips_count", $trips_count);
        $query->bindParam(":city", $city);
        $query->bindParam(":country", $country);
        $query->bindParam(":photo", $photo);
        $query->bindParam(":pass", $pass);
        $query->bindParam(":description", $description);
        $query->bindParam(":status", $status);
        $query->bindParam(":added_by", $added_by);
        $query->bindParam(":carrier_id", $this->carrier_id);
        $query->execute();
        $insert_id = $this->db->lastInsertId();

        if (!empty($_FILES['photo']['tmp_name'])) {
            $this->uploadImage($insert_id);    
        }
    }

    private function editRecord($id) {
        $id = $_POST['id'];
        $sql = 'SELECT * FROM passengers WHERE id = '.$id;
        $query = $this->db->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        if (isset($row)) {
            $name1 = isset($_POST['name1']) ? $_POST['name1'] : $row['name1'];
            $name2 = isset($_POST['name2']) ? $_POST['name2'] : $row['name2'];
            $name3 = isset($_POST['name3']) ? $_POST['name3'] : $row['name3'];
            $email = isset($_POST['email']) ? $_POST['email'] : $row['email'];
            $phone = isset($_POST['phone']) ? $_POST['phone'] : $row['phone'];
            $trips_count = isset($_POST['trips_count']) ? $_POST['trips_count'] : $row['trips_count'];
            $city = isset($_POST['city']) ? $_POST['city'] : $row['city'];
            $country = isset($_POST['country']) ? $_POST['country'] : $row['country'];
            $photo = isset($_POST['photo']) ? $_POST['photo'] : $row['photo'];
            $pass = isset($_POST['pass']) ? $_POST['pass'] : $row['pass'];
            $description = isset($_POST['description']) ? $_POST['description'] : $row['description'];
            $status = isset($_POST['status']) ? $_POST['status'] : $row['status'];

            $sql = 'UPDATE `passengers` SET 
                `name1` = :name1,
                `name2` = :name2,
                `name3` = :name3,
                `email` = :email,
                `phone` = :phone,
                `trips_count` = :trips_count,
                `city` = :city,
                `country` = :country, 
                `photo` = :photo,
                `pass` = :pass,
                `description` = :description,
                `status` = :status
                WHERE id = '.$id;
            $query = $this->db->prepare($sql);
            $query->bindParam(":name1", $name1);
            $query->bindParam(":name2", $name2);
            $query->bindParam(":name3", $name3);
            $query->bindParam(":email", $email);
            $query->bindParam(":phone", $phone);
            $query->bindParam(":trips_count", $trips_count);
            $query->bindParam(":city", $city);
            $query->bindParam(":country", $country);
            $query->bindParam(":photo", $photo);
            $query->bindParam(":pass", $pass);
            $query->bindParam(":description", $description);
            $query->bindParam(":status", $status);
            $query->execute();
            
            if (!empty($_FILES['photo']['tmp_name'])) {
                $this->uploadImage($id);    
            }
            
        } 
    }
    
    private function deleteRecord($id) {
        $sql = 'DELETE FROM passengers WHERE id = '.$id;
        $query = $this->db->query($sql);
    }

    private function setStatus($id, $status) {
        $sql = 'UPDATE `passengers` SET `status` = '.$status.' WHERE id = '.$id;
        $query = $this->db->query($sql);
    }
    
    private function uploadImage($id) {
        $filename = 'passenger'.$id.'_'.time().'.jpg';
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
        move_uploaded_file($_FILES['photo']['tmp_name'], '../../photo/passengers/'.$filename);
        $sql = 'UPDATE `passengers` SET `photo` = "'.$filename.'" WHERE id = '.$id;
        $query = $this->db->query($sql);
    }
    
}

$passengers = new Passengers();
?>