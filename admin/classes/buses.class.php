<?php
include_once dirname(dirname(__FILE__)) . '/connect.php';

class Buses {
    
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
        $sql = 'SELECT * FROM buses WHERE '.$this->carrier_where;
        $query = $this->db->query($sql);

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $row['status'] == 1 ? $status = 'active' : $status = '';
            !empty($row['photo']) ? $photo = '../photo/buses/'.$row['photo'] : $photo = 'http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg';   
            
            $options = '';
            $sql2 = 'SELECT (SELECT options.name FROM options WHERE option_id = options.id) as option_name 
                FROM buses_options 
                LEFT JOIN options ON buses_options.option_id = options.id
                WHERE bus_id = '.$row['id'];
            $query2 = $this->db->query($sql2);
            while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)) {
                $options .= $row2['option_name'].', ';
            }
            $options = substr($options, 0, -2);
             
            $results .= '
                <tr>
                  <td>'.$row['id'].'</td>
                  <td>'.$row['brand'].'</td>
                  <td>'.$row['model'].'</td>
                  <td>'.$row['number'].'</td>
                  <td>'.$row['seats'].'</td>
                  <td>'.$options.'</td>
                  <td><img src="'.$photo.'" class="personnel-image" alt="Image"></td>
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
        $options = array();
        $options_ids = array();        
            
        if ($id > 0) {
            $sql = 'SELECT * FROM buses WHERE id = '.$id;
            $query = $this->db->query($sql);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            !empty($row['photo']) ? $photo = '../photo/buses/'.$row['photo'] : $photo = 'http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg';
            
            $results = array(
                'id' => $row['id'],
                'brand' => $row['brand'],
                'model' => $row['model'],
                'number' => $row['number'],
                'seats' => $row['seats'],
                'status' => $row['status'],
                'short_descr' => $row['short_descr'],
                'full_descr' => $row['full_descr'],
                'photo' => $photo
            );
            
            $sql2 = 'SELECT option_id FROM buses_options WHERE bus_id = '.$id;
            $query2 = $this->db->query($sql2);
            while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)) {
                $options_ids[] = $row2['option_id'];    
            }
        }

        $sql = 'SELECT * FROM options WHERE status = 1 AND '.$this->carrier_where;
        $query = $this->db->query($sql);
        
        //print_r($options_ids);
        
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            if (in_array($row['id'], $options_ids))
                $selected = true;
            else
                $selected = false;                
            $options[] = array('id' => $row['id'], 'name' => $row['name'], 'selected' => $selected);    
        }
        
        $results['options'] = $options; 
        echo json_encode($results);
    }

    private function addRecord() {
        $brand = isset($_POST['brand']) ? $_POST['brand'] : null;
        $model = isset($_POST['model']) ? $_POST['model'] : null;
        $number = isset($_POST['number']) ? $_POST['number'] : null;
        $seats = isset($_POST['seats']) ? $_POST['seats'] : 0;
        $status = isset($_POST['status']) ? $_POST['status'] : 0;
        $short_descr = isset($_POST['short_descr']) ? $_POST['short_descr'] : null;
        $full_descr = isset($_POST['full_descr']) ? $_POST['full_descr'] : null;
        $photo = isset($_POST['photo']) ? $_POST['photo'] : null;
        
        $sql = 'INSERT `buses` SET 
            `brand` = :brand, 
            `model` = :model, 
            `number` = :number, 
            `seats` = :seats, 
            `status` = :status, 
            `short_descr` = :short_descr, 
            `full_descr` = :full_descr, 
            `photo` = :photo, 
            `carrier_id` = :carrier_id
        ';
        $query = $this->db->prepare($sql);
        $query->bindParam(":brand", $brand);
        $query->bindParam(":model", $model);
        $query->bindParam(":number", $number);
        $query->bindParam(":seats", $seats);
        $query->bindParam(":status", $status);
        $query->bindParam(":short_descr", $short_descr);
        $query->bindParam(":full_descr", $full_descr);
        $query->bindParam(":carrier_id", $this->carrier_id);
        $query->bindParam(":photo", $photo);
        $query->execute();
        $insert_id = $this->db->lastInsertId();

        if (!empty($_FILES['photo']['tmp_name'])) {
            $this->uploadImage($insert_id);    
        }

        if (!empty($_FILES['gallery']['tmp_name'][0])) {
            $this->uploadGallery($id);    
        }

        // options
        foreach ($_POST['options'] as $key => $option_id):
            $sql = 'INSERT `buses_options` SET `bus_id` = '.$insert_id.', `option_id` = '.$option_id;
            $query = $this->db->query($sql);
        endforeach;
    }

    private function editRecord($id) {
        $id = $_POST['id'];
        $sql = 'SELECT * FROM buses WHERE id = '.$id;
        $query = $this->db->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        if (isset($row)) {
            $brand = isset($_POST['brand']) ? $_POST['brand'] : $row['brand'];
            $model = isset($_POST['model']) ? $_POST['model'] : $row['model'];
            $number = isset($_POST['number']) ? $_POST['number'] : $row['number'];
            $seats = isset($_POST['seats']) ? $_POST['seats'] : $row['seats'];
            $status = isset($_POST['status']) ? $_POST['status'] : $row['status'];
            $short_descr = isset($_POST['short_descr']) ? $_POST['short_descr'] : $row['short_descr'];
            $full_descr = isset($_POST['full_descr']) ? $_POST['full_descr'] : $row['full_descr'];
            $photo = isset($_POST['photo']) ? $_POST['photo'] : $row['photo'];

            $sql = 'UPDATE `buses` SET 
                `brand` = :brand, 
                `model` = :model, 
                `number` = :number, 
                `seats` = :seats, 
                `status` = :status,
                `short_descr` = :short_descr, 
                `full_descr` = :full_descr,
                `photo` = :photo 
                WHERE id = '.$id;
            $query = $this->db->prepare($sql);
            $query->bindParam(":brand", $brand);
            $query->bindParam(":model", $model);
            $query->bindParam(":number", $number);
            $query->bindParam(":seats", $seats);
            $query->bindParam(":status", $status);
            $query->bindParam(":short_descr", $short_descr);
            $query->bindParam(":full_descr", $full_descr);
            $query->bindParam(":photo", $photo);
            $query->execute();

            if (!empty($_FILES['photo']['tmp_name'])) {
                $this->uploadImage($id);    
            }

            if (!empty($_FILES['gallery']['tmp_name'][0])) {
                $this->uploadGallery($id);    
            }

            // options
            $sql = 'DELETE FROM buses_options WHERE bus_id = '.$id;
            $query = $this->db->query($sql);
            foreach ($_POST['options'] as $key => $option_id):
                $sql = 'INSERT `buses_options` SET `bus_id` = '.$id.', `option_id` = '.$option_id;
                $query = $this->db->query($sql);
            endforeach;
        } 
    }
    
    private function deleteRecord($id) {
        $sql = 'DELETE FROM buses WHERE id = '.$id;
        $query = $this->db->query($sql);
    }

    private function setStatus($id, $status) {
        $sql = 'UPDATE `buses` SET `status` = '.$status.' WHERE id = '.$id;
        $query = $this->db->query($sql);
    }
    
    private function uploadImage($id) {
        $filename = 'bus'.$id.'_'.time().'.jpg';
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
        move_uploaded_file($_FILES['photo']['tmp_name'], '../../photo/buses/'.$filename);
        $sql = 'UPDATE `buses` SET `photo` = "'.$filename.'" WHERE id = '.$id;
        $query = $this->db->query($sql);
    }

    private function uploadGallery($id) {
        $maxDimW = 1280;
        $maxDimH = 900;
        if ((count($_FILES['gallery']['tmp_name']) > 0) && !empty(($_FILES['gallery']['tmp_name'][0]))) {
            $sql = 'DELETE FROM buses_gallery WHERE bus_id = '.$id;
            $query = $this->db->query($sql);
            for ($i = 0; $i < count($_FILES['gallery']['tmp_name']); $i++) {     
                $tmp_name = $_FILES['gallery']['tmp_name'][$i];
                $filename = 'gallery'.$id.'_'.$i.'.jpg';
                list($width, $height, $type, $attr) = getimagesize($tmp_name);
                if ( $width > $maxDimW || $height > $maxDimH ) {
                    $target_filename = $tmp_name;
                    $fn = $tmp_name;
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
                move_uploaded_file($tmp_name, '../../photo/buses/'.$filename);
                $sql = 'INSERT `buses_gallery` SET `bus_id` = '.$id.', `photo` = "'.$filename.'"';
                $query = $this->db->query($sql);
            }
        }
    }    

}

$buses = new Buses();
?>