<?php
include_once dirname(dirname(__FILE__)) . '/connect.php';

class Tickets {
    
    private $db;
    private $statuses = array(1 => 'Заброньовано', 2 => 'Оплачено', 3 => '-');
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
        if ($_SESSION['user']['position_id'] == 1) {
            $this->carrier_id = $_SESSION['user']['id'];
            $this->carrier_where = '1';
        }
        // this is carrier
        else if ($_SESSION['user']['position_id'] == 2) {
            $this->carrier_id = $_SESSION['user']['id'];
            $this->carrier_where = 'tickets.carrier_id = '.$this->carrier_id;
        }
        // this is from personnel 
        else {
            $sql = 'SELECT * FROM users WHERE id = '.$_SESSION['user']['carrier_id'];
            $query = $this->db->query($sql);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->carrier_id = $row['id'];
            $this->carrier_where = 'tickets.carrier_id = '.$this->carrier_id;
        }    
    }

    private function loadpage() {
        $results = '';
        $sql = 'SELECT tickets.*, 
            (SELECT passengers.name1 FROM passengers WHERE tickets.passenger_id = passengers.id) as passenger_name1,
            (SELECT passengers.name2 FROM passengers WHERE tickets.passenger_id = passengers.id) as passenger_name2,
            (SELECT passengers.name3 FROM passengers WHERE tickets.passenger_id = passengers.id) as passenger_name3,
            (SELECT passengers.phone FROM passengers WHERE tickets.passenger_id = passengers.id) as passenger_phone,
            (SELECT passengers.email FROM passengers WHERE tickets.passenger_id = passengers.id) as passenger_email,
            (SELECT locations.city FROM locations WHERE tickets.loc_from_id = locations.id) as loc_from_name,
            (SELECT locations.city FROM locations WHERE tickets.loc_to_id = locations.id) as loc_to_name
            FROM tickets 
            LEFT JOIN passengers ON tickets.passenger_id = passengers.id
            LEFT JOIN locations ON (tickets.loc_from_id = locations.id AND tickets.loc_to_id = locations.id)
            WHERE '.$this->carrier_where;
        $query = $this->db->query($sql);

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $results .= '
                <tr>
                  <td>'.$row['id'].'</td>
                  <td>'.$row['number'].'</td>
                  <td>'.$row['passenger_name1'].'</td>
                  <td>'.$row['passenger_name2'].'</td>
                  <td>'.$row['passenger_name3'].'</td>
                  <td>'.$row['passenger_phone'].'</td>
                  <td>'.$row['passenger_email'].'</td>
                  <td>'.$row['date_buy'].'</td>
                  <td>'.$row['date_departure'].'</td>
                  <td>'.$row['trip_id'].'</td>
                  <td>'.$row['loc_from_name'].' - '.$row['loc_to_name'].'</td>
                  <td>'.$row['loc_from_name'].'</td>
                  <td>'.$row['loc_to_name'].'</td>
                  <td>'.$row['seat'].'</td>
                  <td>'.$row['cost'].'</td>
                  <td>'.$this->statuses[$row['status']].'</td>
                  <td>'.$row['date_reserv_start'].'</td>
                  <td>'.$row['date_reserv_end'].'</td>
                  <td>';
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

    private function deleteRecord($id) {
        $sql = 'DELETE FROM tickets WHERE id = '.$id;
        $query = $this->db->query($sql);
    }

}

$tickets = new Tickets();
?>