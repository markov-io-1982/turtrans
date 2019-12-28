<?php
include_once dirname(dirname(__FILE__)) . '/connect.php';

class Admins {
    
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
        } else if (isset($_POST['loadProfile'])) {
            $this->loadProfile($_POST['id']);
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
        if ($_SESSION['user']['position_id'] == 1) {
            $this->carrier_id = $_SESSION['user']['id'];
            $this->carrier_where = '1';
        }
        // this is carrier
        else if ($_SESSION['user']['position_id'] == 2) {
            $this->carrier_id = $_SESSION['user']['id'];
            $this->carrier_where = 'carrier_id = '.$this->carrier_id;
        }
        // this is from personnel 
        else {
            $sql = 'SELECT * FROM users WHERE id = '.$_SESSION['user']['carrier_id'];
            $query = $this->db->query($sql);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->carrier_id = $row['id'];
            $this->carrier_where = 'carrier_id = '.$this->carrier_id;
        }    
    }

    private function loadpage() {
        $results = '';
        $sql = 'SELECT users.*, (SELECT positions.name FROM positions WHERE users.position_id = positions.id) as position_name 
            FROM users 
            LEFT JOIN positions ON users.position_id = positions.id
            WHERE users.id > 1 AND users.position_id = 2';
        
        $query = $this->db->query($sql);

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $row['status'] == 1 ? $status = 'active' : $status = '';
            !empty($row['photo']) ? $photo = '../photo/users/'.$row['photo'] : $photo = 'http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg';   
             
            $results .= '
                <tr>
                  <td>'.$row['id'].'</td>
                  <td>'.$row['name'].'</td>
                  <td>'.$row['position_name'].'</td>
                  <td>'.$row['phone'].'</td>
                  <td>'.$row['login'].'</td>
                  <td>'.$row['email'].'</td>
                  <td><img src="'.$photo.'" class="personnel-image" alt="Image"></td>
                  <td>'.$row['ip'].'</td>
                  <td>'.$row['last_login'].'</td>
                  <td>'.$row['last_logout'].'</td>
                  <td>
                    <a href="#" class="'.$status.'" data-toggle="class">
                        <i class="fa fa-check text-success text-active" onclick="setStatus('.$row['id'].', 0)"></i>
                        <i class="fa fa-times text-danger text" onclick="setStatus('.$row['id'].', 1)"></i></a>
                  </td>
                  <td>
                    <a href="#modal-profile" onclick="loadProfile('.$row['id'].')" class="btn btn-sm btn-default" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i class="fa fa-eye"></i></a>';
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
        $positions = array();
        $roles = array();
        
        if ($id > 0) {
            $sql = 'SELECT * FROM users WHERE id = '.$id;
            $query = $this->db->query($sql);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            !empty($row['photo']) ? $photo = '../photo/users/'.$row['photo'] : $photo = 'http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg';
            
            $results = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'position_id' => $row['position_id'],
                'phone' => $row['phone'],
                'login' => $row['login'],
                'email' => $row['email'],
                'pass' => $row['pass'],
                'photo' => $photo,
                'status' => $row['status'],
                'role_id' => $row['role_id']
            );
        }
        
        $sql = 'SELECT * FROM positions WHERE status = 1 AND id <= 2 AND '.$this->carrier_where;
        $query = $this->db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $positions[] = array('id' => $row['id'], 'name' => $row['name']);    
        }
        $results['positions'] = $positions; 
        
        $sql = 'SELECT * FROM roles WHERE position_id = 2 AND '.$this->carrier_where;
        $query = $this->db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $roles[] = array('id' => $row['id'], 'name' => $row['name']);    
        }
        $results['roles'] = $roles; 

        echo json_encode($results);
    }
    
    private function loadProfile($id) {
        $results = array();
        
        $sql = 'SELECT users.*, (SELECT positions.name FROM positions WHERE users.position_id = positions.id) as position_name 
            FROM users 
            LEFT JOIN positions ON users.position_id = positions.id
            WHERE users.id = '.$id;
        $query = $this->db->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        !empty($row['photo']) ? $photo = '../photo/users/'.$row['photo'] : $photo = 'http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg';
        
        $results = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'position_name' => $row['position_name'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'ip' => $row['ip'],
            'last_login' => $row['last_login'],
            'last_logout' => $row['last_logout'],
            'photo' => $photo
        );
        echo json_encode($results);
    }
    

    private function addRecord() {
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $position_id = 2; //isset($_POST['position_id']) ? $_POST['position_id'] : 0;
        $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
        $login = isset($_POST['login']) ? $_POST['login'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $pass = isset($_POST['pass']) ? $_POST['pass'] : null;
        $photo = isset($_POST['photo']) ? $_POST['photo'] : null;
        $status = isset($_POST['status']) ? $_POST['status'] : 0;
        $role_id = isset($_POST['role_id']) ? $_POST['role_id'] : 0;
          
        $sql = 'INSERT `users` SET 
            `name` = :name, 
            `position_id` = :position_id, 
            `phone` = :phone, 
            `login` = :login, 
            `email` = :email, 
            `pass` = :pass, 
            `photo` = :photo, 
            `status` = :status, 
            `carrier_id` = :carrier_id, 
            `role_id` = :role_id
        ';
        $query = $this->db->prepare($sql);
        $query->bindParam(":name", $name);
        $query->bindParam(":position_id", $position_id);
        $query->bindParam(":phone", $phone);
        $query->bindParam(":login", $login);
        $query->bindParam(":email", $email);
        $query->bindParam(":pass", $pass);
        $query->bindParam(":photo", $photo);
        $query->bindParam(":status", $status);
        $query->bindParam(":carrier_id", $this->carrier_id);
        $query->bindParam(":role_id", $role_id);        
        $query->execute();
        $insert_id = $this->db->lastInsertId();

        if (!empty($_FILES['photo']['tmp_name'])) {
            $this->uploadImage($insert_id);    
        }
    }

    private function editRecord($id) {
        $id = $_POST['id'];
        $sql = 'SELECT * FROM users WHERE id = '.$id;
        $query = $this->db->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        if (isset($row)) {
            $name = isset($_POST['name']) ? $_POST['name'] : $row['name'];
            $phone = isset($_POST['phone']) ? $_POST['phone'] : $row['phone'];
            $login = isset($_POST['login']) ? $_POST['login'] : $row['login'];
            $email = isset($_POST['email']) ? $_POST['email'] : $row['email'];
            $pass = isset($_POST['pass']) ? $_POST['pass'] : $row['pass'];
            $photo = isset($_POST['photo']) ? $_POST['photo'] : $row['photo'];
            $status = isset($_POST['status']) ? $_POST['status'] : $row['status'];
            $role_id = isset($_POST['role_id']) ? $_POST['role_id'] : $row['role_id'];

            $sql = 'UPDATE `users` SET 
                `name` = :name, 
                `phone` = :phone, 
                `login` = :login, 
                `email` = :email, 
                `pass` = :pass, 
                `photo` = :photo, 
                `status` = :status, 
                `role_id` = :role_id 
                WHERE id = '.$id;
            $query = $this->db->prepare($sql);
            $query->bindParam(":name", $name);
            $query->bindParam(":phone", $phone);
            $query->bindParam(":login", $login);
            $query->bindParam(":email", $email);
            $query->bindParam(":pass", $pass);
            $query->bindParam(":photo", $photo);
            $query->bindParam(":status", $status);
            $query->bindParam(":role_id", $role_id);
            $query->execute();
            
            if (!empty($_FILES['photo']['tmp_name'])) {
                $this->uploadImage($id);    
            }
            
        } 
    }
    
    private function deleteRecord($id) {
        $sql = 'DELETE FROM users WHERE id = '.$id;
        $query = $this->db->query($sql);
    }

    private function setStatus($id, $status) {
        $sql = 'UPDATE `users` SET `status` = '.$status.' WHERE id = '.$id;
        $query = $this->db->query($sql);
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

$admins = new Admins();
?>