<?php
include_once dirname(dirname(__FILE__)) . '/connect.php';

class Discounts {
    
    private $db;
    private $types = array(0 => 'Вартість', 1 => 'Відсоток');
    private $signs = array(0 => 'Покупка', 1 => 'Пошук', 2 => 'Дисконт');
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
        } else if (isset($_POST['setSearch'])) {
            $this->setSearch($_POST['id'], $_POST['search']);
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
        $sql = 'SELECT * FROM discounts WHERE '.$this->carrier_where;
        $query = $this->db->query($sql);

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $row['status'] == 1 ? $status = 'active' : $status = '';
            $row['search'] == 1 ? $search = 'active' : $search = '';
             
            $results .= '
                <tr>
                  <td>'.$row['id'].'</td>
                  <td>'.$row['name'].'</td>
                  <td>'.$this->types[$row['type']].'</td>
                  <td>'.$row['discount'].'</td>
                  <td>'.$row['price'].'</td>
                  <td>'.$row['promo_price'].'</td>
                  <td>'.date("d.m.Y", strtotime($row['date_from'])).'</td>
                  <td>'.date("d.m.Y", strtotime($row['date_to'])).'</td>
                  <td>'.$this->signs[$row['sign']].'</td>
                  <td>
                    <a href="#" class="'.$status.'" data-toggle="class">
                        <i class="fa fa-check text-success text-active" onclick="setStatus('.$row['id'].', 0)"></i>
                        <i class="fa fa-times text-danger text" onclick="setStatus('.$row['id'].', 1)"></i></a>
                  </td>
                  <td>
                    <a href="#" class="'.$search.'" data-toggle="class">
                        <i class="fa fa-check text-success text-active" onclick="setSearch('.$row['id'].', 0)"></i>
                        <i class="fa fa-times text-danger text" onclick="setSearch('.$row['id'].', 1)"></i></a>
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
        $sql = 'SELECT * FROM discounts WHERE id = '.$id;
        $query = $this->db->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        $results = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'type' => $row['type'],
            'discount' => $row['discount'],
            'price' => $row['price'],
            'promo_price' => $row['promo_price'],
            'date_from' => $row['date_from'],
            'date_to' => $row['date_to'],
            'status' => $row['status'],
            'sign' => $row['sign'],
            'search' => $row['search']
        );
        echo json_encode($results);
    }

    private function addRecord() {
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $type = isset($_POST['type']) ? $_POST['type'] : null;
        $discount = isset($_POST['discount']) ? $_POST['discount'] : null;
        $price = isset($_POST['price']) ? $_POST['price'] : null;
        $promo_price = isset($_POST['promo_price']) ? $_POST['promo_price'] : null;
        $date_from = isset($_POST['date_from']) ? $_POST['date_from'] : null;
        $date_to = isset($_POST['date_to']) ? $_POST['date_to'] : null;
        $status = isset($_POST['status']) ? $_POST['status'] : 0;
        $sign = isset($_POST['sign']) ? $_POST['sign'] : 0;
        $search = isset($_POST['search']) ? $_POST['search'] : 0;
        
        if ($type == 0) {
            $discount = null;
        } else if ($type == 1) {
            $price = null;
            $promo_price = null;
        } 
           
        $sql = 'INSERT `discounts` SET 
            `name` = :name, 
            `type` = :type, 
            `discount` = :discount, 
            `price` = :price, 
            `promo_price` = :promo_price, 
            `date_from` = :date_from, 
            `date_to` = :date_to, 
            `status` = :status,
            `sign` = :sign,
            `search` = :search,
            `carrier_id` = :carrier_id
        ';
        $query = $this->db->prepare($sql);
        $query->bindParam(":name", $name);
        $query->bindParam(":type", $type);
        $query->bindParam(":discount", $discount);
        $query->bindParam(":price", $price);
        $query->bindParam(":promo_price", $promo_price);
        $query->bindParam(":date_from", $date_from);
        $query->bindParam(":date_to", $date_to);
        $query->bindParam(":status", $status);
        $query->bindParam(":sign", $sign);
        $query->bindParam(":search", $search);
        $query->bindParam(":carrier_id", $this->carrier_id);
        $query->execute();
        $insert_id = $this->db->lastInsertId();
    }

    private function editRecord($id) {
        $id = $_POST['id'];
        $sql = 'SELECT * FROM discounts WHERE id = '.$id;
        $query = $this->db->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        if (isset($row)) {
            $name = isset($_POST['name']) ? $_POST['name'] : $row['name'];
            $type = isset($_POST['type']) ? $_POST['type'] : $row['type'];
            $discount = isset($_POST['discount']) ? $_POST['discount'] : $row['discount'];
            $price = isset($_POST['price']) ? $_POST['price'] : $row['price'];
            $promo_price = isset($_POST['promo_price']) ? $_POST['promo_price'] : $row['promo_price'];
            $date_from = isset($_POST['date_from']) ? $_POST['date_from'] : $row['date_from'];
            $date_to = isset($_POST['date_to']) ? $_POST['date_to'] : $row['date_to'];
            $status = isset($_POST['status']) ? $_POST['status'] : $row['status'];
            $sign = isset($_POST['sign']) ? $_POST['sign'] : $row['sign'];
            $search = isset($_POST['search']) ? 1 : 0;
            
            if ($type == 0) {
                $discount = null;
            } else if ($type == 1) {
                $price = null;
                $promo_price = null;
            } 
            
            $sql = 'UPDATE `discounts` SET 
                `name` = :name, 
                `type` = :type, 
                `discount` = :discount, 
                `price` = :price, 
                `promo_price` = :promo_price, 
                `date_from` = :date_from, 
                `date_to` = :date_to, 
                `status` = :status,
                `sign` = :sign,
                `search` = :search 
                WHERE id = '.$id;
            $query = $this->db->prepare($sql);
            $query->bindParam(":name", $name);
            $query->bindParam(":type", $type);
            $query->bindParam(":discount", $discount);
            $query->bindParam(":price", $price);
            $query->bindParam(":promo_price", $promo_price);
            $query->bindParam(":date_from", $date_from);
            $query->bindParam(":date_to", $date_to);
            $query->bindParam(":status", $status);
            $query->bindParam(":sign", $sign);
            $query->bindParam(":search", $search);
            $query->execute();
        } 
    }
    
    private function deleteRecord($id) {
        $sql = 'DELETE FROM discounts WHERE id = '.$id;
        $query = $this->db->query($sql);
    }

    private function setStatus($id, $status) {
        $sql = 'UPDATE `discounts` SET `status` = '.$status.' WHERE id = '.$id;
        $query = $this->db->query($sql);
    }

    private function setSearch($id, $search) {
        $sql = 'UPDATE `discounts` SET `search` = '.$search.' WHERE id = '.$id;
        $query = $this->db->query($sql);
    }
    
}

$discounts = new Discounts();
?>