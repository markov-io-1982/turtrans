<?php
include_once dirname(dirname(__FILE__)) . '/connect.php';

class Roles {
    
    private $db;
    private $carrier_id;
    private $roles_carrier_where;
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
        } 
    }   

    private function setCarrier() {
        // this is super admin
        if ($_SESSION['user']['position_id'] == 1) {
            $this->carrier_id = $_SESSION['user']['id'];
            $this->roles_carrier_where = '1';
            $this->carrier_where = '1';
        }
        // this is carrier
        else if ($_SESSION['user']['position_id'] == 2) {
            $this->carrier_id = $_SESSION['user']['id'];
            $this->roles_carrier_where = 'roles.carrier_id = '.$this->carrier_id;
            $this->carrier_where = 'carrier_id = '.$this->carrier_id;
        }
        // this is from personnel 
        else {
            $sql = 'SELECT * FROM users WHERE id = '.$_SESSION['user']['carrier_id'];
            $query = $this->db->query($sql);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->carrier_id = $row['id'];
            $this->roles_carrier_where = 'roles.carrier_id = '.$this->carrier_id;
            $this->carrier_where = 'carrier_id = '.$this->carrier_id;
        }    
    }

    private function loadpage() {
        $results = '';
        $sql = 'SELECT roles.*, (SELECT positions.name FROM positions WHERE roles.position_id = positions.id) as position_name 
            FROM roles 
            LEFT JOIN positions ON roles.position_id = positions.id
            WHERE roles.id > 1 AND '.$this->roles_carrier_where;
        $query = $this->db->query($sql);

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $results .= '
                <tr>
                  <td>';
                  if ($this->roles['edit'] == 1)
                    $results .= '<a href="#modal-form" onclick="loadRecord('.$row['id'].')" class="btn btn-info btn-sm datatables-graediting-deletede"
                          data-toggle="modal" data-placement="left" title="" data-original-title="Update"><i class="fa fa-pencil" aria-hIDden="true"></i></a>';
                  if ($this->roles['del'] == 1)
                    $results .= '<a href="#" onclick="deleteRecord('.$row['id'].')" class="btn btn-danger btn-sm datatables-graediting-deletede" data-toggle="tooltip"
                          data-placement="right" title="" data-original-title="Delete "><i class="fa fa-trash-o" aria-hIDden="true"></i></a>';
                  $results .= ' 
                   </td>
                
                  <td>'.$row['id'].'</td>
                  <td>'.$row['name'].'</td>
                  <td>'.$row['position_name'].'</td>
                  <td>
                    <div class="wp-checkbox-style">
                        <input type="checkbox" class="checkbox-style" onclick="return false;" '.(($row['edit'] == 1) ? "checked" : "").'>
                    </div>
                  </td>
                  <td>
                    <div class="wp-checkbox-style">
                        <input type="checkbox" class="checkbox-style" onclick="return false;" '.(($row['del'] == 1) ? "checked" : "").'>
                    </div>
                  </td>
                  <td>
                    <div class="wp-checkbox-style">
                        <input type="checkbox" class="checkbox-style" onclick="return false;" '.(($row['locations'] == 1) ? "checked" : "").'>
                    </div>
                  </td>
                  <td>
                    <div class="wp-checkbox-style">
                        <input type="checkbox" class="checkbox-style" onclick="return false;" '.(($row['buses'] == 1) ? "checked" : "").'>
                    </div>
                  </td>
                  <td>
                    <div class="wp-checkbox-style">
                        <input type="checkbox" class="checkbox-style" onclick="return false;" '.(($row['options'] == 1) ? "checked" : "").'>
                    </div>
                  </td>
                  <td>
                    <div class="wp-checkbox-style">
                        <input type="checkbox" class="checkbox-style" onclick="return false;" '.(($row['personnel'] == 1) ? "checked" : "").'>
                    </div>
                  </td>
                  <td>
                    <div class="wp-checkbox-style">
                        <input type="checkbox" class="checkbox-style" onclick="return false;" '.(($row['positions'] == 1) ? "checked" : "").'>
                    </div>
                  </td>
                  <td>
                    <div class="wp-checkbox-style">
                        <input type="checkbox" class="checkbox-style" onclick="return false;" '.(($row['roles'] == 1) ? "checked" : "").'>
                    </div>
                  </td>
                  <td>
                    <div class="wp-checkbox-style">
                        <input type="checkbox" class="checkbox-style" onclick="return false;" '.(($row['discounts'] == 1) ? "checked" : "").'>
                    </div>
                  </td>
                  <td>
                    <div class="wp-checkbox-style">
                        <input type="checkbox" class="checkbox-style" onclick="return false;" '.(($row['stops'] == 1) ? "checked" : "").'>
                    </div>
                  </td>
                  <td>
                    <div class="wp-checkbox-style">
                        <input type="checkbox" class="checkbox-style" onclick="return false;" '.(($row['trips'] == 1) ? "checked" : "").'>
                    </div>
                  </td>
                  <td>
                    <div class="wp-checkbox-style">
                        <input type="checkbox" class="checkbox-style" onclick="return false;" '.(($row['tickets'] == 1) ? "checked" : "").'>
                    </div>
                  </td>
                  <td>
                    <div class="wp-checkbox-style">
                        <input type="checkbox" class="checkbox-style" onclick="return false;" '.(($row['site_info'] == 1) ? "checked" : "").'>
                    </div>
                  </td>
                  <td>
                    <div class="wp-checkbox-style">
                        <input type="checkbox" class="checkbox-style" onclick="return false;" '.(($row['passengers'] == 1) ? "checked" : "").'>
                    </div>
                  </td>
                </tr>
            ';
        }
        echo $results;
    }

    private function loadRecord($id) {
        $results = array();
        $positions = array();
        
        if ($id > 0) {
            $sql = 'SELECT * FROM roles WHERE id = '.$id;
            $query = $this->db->query($sql);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            
            $results = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'position_id' => $row['position_id'],
                'edit' => $row['edit'],
                'del' => $row['del'],
                'locations' => $row['locations'],
                'buses' => $row['buses'],
                'options' => $row['options'],
                'personnel' => $row['personnel'],
                'positions' => $row['positions'],
                'roles' => $row['roles'],
                'discounts' => $row['discounts'],
                'stops' => $row['stops'],                
                'trips' => $row['trips'],
                'tickets' => $row['tickets'],
                'site_info' => $row['site_info'],
                'passengers' => $row['passengers'],
                'admins' => $row['admins']
            );
        }
        
        $sql = 'SELECT * FROM positions WHERE status = 1 AND id > 1 AND '.$this->carrier_where;
        $query = $this->db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $positions[] = array('id' => $row['id'], 'name' => $row['name']);    
        }
        $results['positionss'] = $positions; 
        
        echo json_encode($results);
    }
    
    private function addRecord() {
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $position_id = isset($_POST['position_id']) ? $_POST['position_id'] : 0;
        $edit = isset($_POST['edit']) ? 1 : 0;
        $del = isset($_POST['del']) ? 1 : 0;
        $locations = isset($_POST['locations']) ? 1 : 0;
        $buses = isset($_POST['buses']) ? 1 : 0;
        $options = isset($_POST['options']) ? 1 : 0;
        $personnel = isset($_POST['personnel']) ? 1 : 0;
        $positions = isset($_POST['positions']) ? 1 : 0;
        $roles = isset($_POST['roles']) ? 1 : 0;
        $discounts = isset($_POST['discounts']) ? 1 : 0;
        $stops = isset($_POST['stops']) ? 1 : 0;        
        $trips = isset($_POST['trips']) ? 1 : 0;
        $tickets = isset($_POST['tickets']) ? 1 : 0;
        $site_info = isset($_POST['site_info']) ? 1 : 0;
        $passengers = isset($_POST['passengers']) ? 1 : 0;
        $admins = isset($_POST['admins']) ? 1 : 0;
          
        $sql = 'INSERT `roles` SET 
            `name` = :name,
            `position_id` = :position_id, 
            `edit` = :edit, 
            `del` = :del, 
            `locations` = :locations, 
            `buses` = :buses, 
            `options` = :options,
            `personnel` = :personnel, 
            `positions` = :positions, 
            `roles` = :roles, 
            `discounts` = :discounts,
            `stops` = :stops,             
            `trips` = :trips, 
            `tickets` = :tickets, 
            `site_info` = :site_info,
            `passengers` = :passengers,
            `admins` = :admins,
            `carrier_id` = :carrier_id
        ';
        $query = $this->db->prepare($sql);
        $query->bindParam(":name", $name);
        $query->bindParam(":position_id", $position_id);
        $query->bindParam(":edit", $edit);
        $query->bindParam(":del", $del);
        $query->bindParam(":locations", $locations);
        $query->bindParam(":buses", $buses);
        $query->bindParam(":options", $options);
        $query->bindParam(":personnel", $personnel);
        $query->bindParam(":positions", $positions);
        $query->bindParam(":roles", $roles);
        $query->bindParam(":discounts", $discounts);
        $query->bindParam(":stops", $stops);        
        $query->bindParam(":trips", $trips);
        $query->bindParam(":tickets", $tickets);
        $query->bindParam(":site_info", $site_info);
        $query->bindParam(":passengers", $passengers);
        $query->bindParam(":admins", $admins);
        $query->bindParam(":carrier_id", $this->carrier_id);
        $query->execute();
        $insert_id = $this->db->lastInsertId();
    }

    private function editRecord($id) {
        $id = $_POST['id'];
        $sql = 'SELECT * FROM roles WHERE id = '.$id;
        $query = $this->db->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        if (isset($row)) {
            $name = isset($_POST['name']) ? $_POST['name'] : $row['name'];
            $position_id = isset($_POST['position_id']) ? $_POST['position_id'] : $row['position_id'];
            $edit = isset($_POST['edit']) ? 1 : 0;
            $del = isset($_POST['del']) ? 1 : 0;
            $locations = isset($_POST['locations']) ? 1 : 0;
            $buses = isset($_POST['buses']) ? 1 : 0;
            $options = isset($_POST['options']) ? 1 : 0;
            $personnel = isset($_POST['personnel']) ? 1 : 0;
            $positions = isset($_POST['positions']) ? 1 : 0;
            $roles = isset($_POST['roles']) ? 1 : 0;
            $discounts = isset($_POST['discounts']) ? 1 : 0;
            $stops = isset($_POST['stops']) ? 1 : 0;            
            $trips = isset($_POST['trips']) ? 1 : 0;
            $tickets = isset($_POST['tickets']) ? 1 : 0;
            $site_info = isset($_POST['site_info']) ? 1 : 0;
            $passengers = isset($_POST['passengers']) ? 1 : 0;
            $admins = isset($_POST['admins']) ? 1 : 0;
            
            $sql = 'UPDATE `roles` SET 
                `name` = :name,
                `position_id` = :position_id, 
                `edit` = :edit, 
                `del` = :del, 
                `locations` = :locations, 
                `buses` = :buses, 
                `options` = :options,
                `personnel` = :personnel, 
                `positions` = :positions, 
                `roles` = :roles, 
                `discounts` = :discounts,
                `stops` = :stops, 
                `trips` = :trips, 
                `tickets` = :tickets, 
                `site_info` = :site_info,
                `passengers` = :passengers,
                `admins` = :admins
                WHERE id = '.$id
            ;
            $query = $this->db->prepare($sql);
            $query->bindParam(":name", $name);
            $query->bindParam(":position_id", $position_id);
            $query->bindParam(":edit", $edit);
            $query->bindParam(":del", $del);
            $query->bindParam(":locations", $locations);
            $query->bindParam(":buses", $buses);
            $query->bindParam(":options", $options);
            $query->bindParam(":personnel", $personnel);
            $query->bindParam(":positions", $positions);
            $query->bindParam(":roles", $roles);
            $query->bindParam(":discounts", $discounts);
            $query->bindParam(":stops", $stops);
            $query->bindParam(":trips", $trips);
            $query->bindParam(":tickets", $tickets);
            $query->bindParam(":site_info", $site_info);
            $query->bindParam(":passengers", $passengers);
            $query->bindParam(":admins", $admins);
            $query->execute();
        } 
    }
    
    private function deleteRecord($id) {
        $sql = 'DELETE FROM roles WHERE id = '.$id;
        $query = $this->db->query($sql);
    }

}

$roles = new Roles();
?>