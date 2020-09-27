<?php
include_once dirname(dirname(__FILE__)) . '/connect.php';

class Positions {
    
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
        $sql = 'SELECT * FROM positions WHERE id > 2 AND '.$this->carrier_where;
        $query = $this->db->query($sql);

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $row['status'] == 1 ? $status = 'active' : $status = '';
             
            $results .= '
                <tr>
                  <td>'.$row['id'].'</td>
                  <td>'.$row['name'].'</td>
                  <td>'.$row['description'].'</td>
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
        $sql = 'SELECT * FROM positions WHERE id = '.$id;
        $query = $this->db->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        $results = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'description' => $row['description'],
            'status' => $row['status']
        );
        echo json_encode($results);
    }

    private function addRecord() {
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $status = isset($_POST['status']) ? $_POST['status'] : 0;
          
        $sql = 'INSERT `positions` SET 
            `name` = :name, 
            `description` = :description, 
            `status` = :status,
            `carrier_id` = :carrier_id
        ';
        $query = $this->db->prepare($sql);
        $query->bindParam(":name", $name);
        $query->bindParam(":description", $description);
        $query->bindParam(":status", $status);
        $query->bindParam(":carrier_id", $this->carrier_id);
        $query->execute();
        $insert_id = $this->db->lastInsertId();
    }

    private function editRecord($id) {
        $id = $_POST['id'];
        $sql = 'SELECT * FROM positions WHERE id = '.$id;
        $query = $this->db->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        if (isset($row)) {
            $name = isset($_POST['name']) ? $_POST['name'] : $row['name'];
            $description = isset($_POST['description']) ? $_POST['description'] : $row['description'];
            $status = isset($_POST['status']) ? $_POST['status'] : $row['status'];
            
            $sql = 'UPDATE `positions` SET 
                `name` = :name, 
                `description` = :description, 
                `status` = :status 
                WHERE id = '.$id;
            $query = $this->db->prepare($sql);
            $query->bindParam(":name", $name);
            $query->bindParam(":description", $description);
            $query->bindParam(":status", $status);
            $query->execute();
        } 
    }
    
    private function deleteRecord($id) {
        $sql = 'DELETE FROM positions WHERE id = '.$id;
        $query = $this->db->query($sql);
    }

    private function setStatus($id, $status) {
        $sql = 'UPDATE `positions` SET `status` = '.$status.' WHERE id = '.$id;
        $query = $this->db->query($sql);
    }
    
}

$positions = new Positions();
?>