<?php
include_once dirname(dirname(__FILE__)) . '/connect.php';

class Stops {
    
    private $db;
    private $carrier_id;
    private $stops_carrier_where;
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
            $this->stops_carrier_where = '1';
            $this->carrier_where = '1';
        }
        // this is carrier
        else if ($_SESSION['admin']['position_id'] == 2) {
            $this->carrier_id = $_SESSION['admin']['id'];
            $this->stops_carrier_where = 'stops.carrier_id = '.$this->carrier_id;
            $this->carrier_where = 'carrier_id = '.$this->carrier_id;
        }
        // this is from personnel 
        else {
            $sql = 'SELECT * FROM users WHERE id = '.$_SESSION['admin']['carrier_id'];
            $query = $this->db->query($sql);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->carrier_id = $row['id'];
            $this->stops_carrier_where = 'stops.carrier_id = '.$this->carrier_id;
            $this->carrier_where = 'carrier_id = '.$this->carrier_id;
        }    
    }

    private function loadpage() {
        $results = '';
        $sql = 'SELECT stops.*, (SELECT locations.city FROM locations WHERE stops.city_id = locations.id) as city_name 
            FROM stops 
            LEFT JOIN locations ON stops.city_id = locations.id
            WHERE '.$this->stops_carrier_where;
        $query = $this->db->query($sql);

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $row['status'] == 1 ? $status = 'active' : $status = '';
            
            $results .= '
                <tr>
                  <td>'.$row['id'].'</td>
                  <td>'.$row['city_name'].'</td>
                  <td>'.$row['name'].'</td>
                  <td>'.$row['address'].'</td>
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
        $cities = array();
            
        if ($id > 0) {
            $sql = 'SELECT * FROM stops WHERE id = '.$id;
            $query = $this->db->query($sql);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            
            $results = array(
                'id' => $row['id'],
                'city_id' => $row['city_id'],
                'name' => $row['name'],
                'address' => $row['address'],
                'status' => $row['status']
            );
        }

        $sql = 'SELECT * FROM locations WHERE status = 1 AND '.$this->carrier_where.' ORDER BY `city` ASC';
        $query = $this->db->query($sql);
        
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $cities[] = array('id' => $row['id'], 'name' => $row['city']);    
        }
        
        $results['cities'] = $cities; 
        echo json_encode($results);
    }

    private function addRecord() {
        $city_id = isset($_POST['city_id']) ? $_POST['city_id'] : 0;
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $address = isset($_POST['address']) ? $_POST['address'] : null;
        $status = isset($_POST['status']) ? $_POST['status'] : 0;
        
        $sql = 'INSERT `stops` SET 
            `city_id` = :city_id, 
            `name` = :name, 
            `address` = :address, 
            `status` = :status, 
            `carrier_id` = :carrier_id
        ';
        $query = $this->db->prepare($sql);
        $query->bindParam(":city_id", $city_id);
        $query->bindParam(":name", $name);
        $query->bindParam(":address", $address);
        $query->bindParam(":status", $status);
        $query->bindParam(":carrier_id", $this->carrier_id);
        $query->execute();
        $insert_id = $this->db->lastInsertId();

    }

    private function editRecord($id) {
        $id = $_POST['id'];
        $sql = 'SELECT * FROM stops WHERE id = '.$id;
        $query = $this->db->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        if (isset($row)) {
            $city_id = isset($_POST['city_id']) ? $_POST['city_id'] : $row['city_id'];
            $name = isset($_POST['name']) ? $_POST['name'] : $row['name'];
            $address = isset($_POST['address']) ? $_POST['address'] : $row['address'];
            $status = isset($_POST['status']) ? $_POST['status'] : $row['status'];
            
            $sql = 'UPDATE `stops` SET 
                `city_id` = :city_id, 
                `name` = :name, 
                `address` = :address, 
                `status` = :status 
                WHERE id = '.$id;
            $query = $this->db->prepare($sql);
            $query->bindParam(":city_id", $city_id);
            $query->bindParam(":name", $name);
            $query->bindParam(":address", $address);
            $query->bindParam(":status", $status);
            $query->execute();

        } 
    }
    
    private function deleteRecord($id) {
        $sql = 'DELETE FROM stops WHERE id = '.$id;
        $query = $this->db->query($sql);
    }

    private function setStatus($id, $status) {
        $sql = 'UPDATE `stops` SET `status` = '.$status.' WHERE id = '.$id;
        $query = $this->db->query($sql);
    }
    
}

$stops = new Stops();
?>