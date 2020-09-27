<?php
include_once dirname(dirname(__FILE__)) . '/connect.php';

class News {
    
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
        $sql = 'SELECT * FROM news WHERE '.$this->carrier_where;
        $query = $this->db->query($sql);

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $row['status'] == 1 ? $status = 'active' : $status = '';
            !empty($row['photo']) ? $photo = '../photo/news/'.$row['photo'] : $photo = 'http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg';   
            
            $results .= '
                <tr>
                  <td>'.$row['id'].'</td>
                  <td>'.$row['name'].'</td>
                  <td><img src="'.$photo.'" class="personnel-image" alt="Image"></td>
                  <td>'.$row['description'].'</td>
                  <td>'.date('d.m.Y H:i', strtotime($row['created'])).'</td>
                  <td>
                    <a href="#" class="'.$status.'" data-toggle="class">
                        <i class="fa fa-check text-success text-active" onclick="setStatus('.$row['id'].', 0)"></i>
                        <i class="fa fa-times text-danger text" onclick="setStatus('.$row['id'].', 1)"></i></a>
                  </td>
                  <td>';
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
            $sql = 'SELECT * FROM news WHERE id = '.$id;
            $query = $this->db->query($sql);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            !empty($row['photo']) ? $photo = '../photo/news/'.$row['photo'] : $photo = 'http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg';
            
            $results = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'photo' => $photo,
                'description' => $row['description'],
                'status' => $row['status']
            );
            
        }

        echo json_encode($results);
    }

    private function addRecord() {
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $status = isset($_POST['status']) ? $_POST['status'] : 0;
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $photo = isset($_POST['photo']) ? $_POST['photo'] : null;
        $created = date('Y-m-d H:i:s');
        
        $sql = 'INSERT `news` SET 
            `name` = :name, 
            `status` = :status, 
            `description` = :description, 
            `photo` = :photo, 
            `created` = :created, 
            `carrier_id` = :carrier_id
        ';
        $query = $this->db->prepare($sql);
        $query->bindParam(":name", $name);
        $query->bindParam(":status", $status);
        $query->bindParam(":description", $description);
        $query->bindParam(":created", $created);
        $query->bindParam(":carrier_id", $this->carrier_id);
        $query->bindParam(":photo", $photo);
        $query->execute();
        $insert_id = $this->db->lastInsertId();

        if (!empty($_FILES['photo']['tmp_name'])) {
            $this->uploadImage($insert_id);    
        }

    }

    private function editRecord($id) {
        $id = $_POST['id'];
        $sql = 'SELECT * FROM news WHERE id = '.$id;
        $query = $this->db->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        if (isset($row)) {
            $name = isset($_POST['name']) ? $_POST['name'] : $row['name'];
            $status = isset($_POST['status']) ? $_POST['status'] : $row['status'];
            $description = isset($_POST['description']) ? $_POST['description'] : $row['description'];
            $photo = isset($_POST['photo']) ? $_POST['photo'] : $row['photo'];

            $sql = 'UPDATE `news` SET 
                `name` = :name, 
                `status` = :status,
                `description` = :description, 
                `photo` = :photo 
                WHERE id = '.$id;
            $query = $this->db->prepare($sql);
            $query->bindParam(":name", $name);
            $query->bindParam(":status", $status);
            $query->bindParam(":description", $description);
            $query->bindParam(":photo", $photo);
            $query->execute();

            if (!empty($_FILES['photo']['tmp_name'])) {
                $this->uploadImage($id);    
            }

        } 
    }
    
    private function deleteRecord($id) {
        $sql = 'DELETE FROM news WHERE id = '.$id;
        $query = $this->db->query($sql);
    }

    private function setStatus($id, $status) {
        $sql = 'UPDATE `news` SET `status` = '.$status.' WHERE id = '.$id;
        $query = $this->db->query($sql);
    }
    
    private function uploadImage($id) {
        $filename = 'news'.$id.'_'.time().'.jpg';
        $maxDimW = 1280;
        $maxDimH = 900;
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
        move_uploaded_file($_FILES['photo']['tmp_name'], '../../photo/news/'.$filename);
        $sql = 'UPDATE `news` SET `photo` = "'.$filename.'" WHERE id = '.$id;
        $query = $this->db->query($sql);
    }

}

$news = new News();
?>