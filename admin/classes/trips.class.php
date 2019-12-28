<?php
include_once dirname(dirname(__FILE__)) . '/connect.php';

class Trips {
    
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
        } else if (isset($_POST['loadDiscounts'])) {
            $this->loadDiscounts($_POST['id']);
        } else if (isset($_POST['deleteRecord'])) {
            $this->deleteRecord($_POST['id']);
        } else if (isset($_POST['setStatus'])) {
            $this->setStatus($_POST['id'], $_POST['status']);
        } else if (isset($_POST['updateStops'])) {
            $this->updateStops($_POST['id']);
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
            $this->carrier_where = 'trips.carrier_id = '.$this->carrier_id;
        }
        // this is from personnel 
        else {
            $sql = 'SELECT * FROM users WHERE id = '.$_SESSION['user']['carrier_id'];
            $query = $this->db->query($sql);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $this->carrier_id = $row['id'];
            $this->carrier_where = 'trips.carrier_id = '.$this->carrier_id;
        }    
    }

    private function loadpage() {
        $results = '';
        $sql = 'SELECT trips.*, 
            (SELECT locations.city FROM locations WHERE trips.loc_from_id = locations.id) as loc_from_name,
            (SELECT locations.city FROM locations WHERE trips.loc_to_id = locations.id) as loc_to_name,
            (SELECT stops.name FROM stops WHERE trips.stop_from_id = stops.id) as stop_from_name,
            (SELECT stops.name FROM stops WHERE trips.stop_to_id = stops.id) as stop_to_name,
            (SELECT buses.brand FROM buses WHERE trips.bus_id = buses.id) as bus_name,
            (SELECT buses.seats FROM buses WHERE trips.bus_id = buses.id) as bus_seats,
            (SELECT trips_prices.price FROM trips_prices WHERE trips.id = trips_prices.trip_id AND trips.loc_from_id = trips_prices.loc_from_id AND trips.loc_to_id = trips_prices.loc_to_id) as trip_price 
            FROM trips
            LEFT JOIN locations ON (trips.loc_from_id = locations.id AND trips.loc_to_id = locations.id)
            LEFT JOIN stops ON (trips.stop_from_id = stops.id AND trips.stop_to_id = stops.id)
            LEFT JOIN buses ON (trips.bus_id = buses.id AND trips.bus_id = buses.id)
            LEFT JOIN trips_prices ON (trips.id = trips_prices.trip_id AND trips.loc_from_id = trips_prices.loc_from_id AND trips.loc_to_id = trips_prices.loc_to_id)
            WHERE '.$this->carrier_where;
        $query = $this->db->query($sql);

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $row['reserv_disabled'] == 0 ? $status = 'active' : $status = '';
            $discounts_names0 = '';
            $discounts_names1 = '';
                         
            $sql = 'SELECT trips_discounts.*, 
                (SELECT discounts.name FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_name,
                (SELECT discounts.sign FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_sign
                FROM trips_discounts
                LEFT JOIN discounts ON (trips_discounts.discount_id = discounts.id)
                WHERE discounts.sign = 0 AND trips_discounts.trip_id = '.$row['id'];
            $query2 = $this->db->query($sql);
            while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)) {
                $discounts_names0 .= $row2['discount_name'].', ';
            }
            $discounts_names0 = substr($discounts_names0, 0, -2);
            
            $sql = 'SELECT trips_discounts.*, 
                (SELECT discounts.name FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_name,
                (SELECT discounts.sign FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_sign
                FROM trips_discounts
                LEFT JOIN discounts ON (trips_discounts.discount_id = discounts.id)
                WHERE discounts.sign = 1 AND trips_discounts.trip_id = '.$row['id'];
            $query2 = $this->db->query($sql);
            while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)) {
                $discounts_names1 .= $row2['discount_name'].', ';
            }
            $discounts_names1 = substr($discounts_names1, 0, -2);
            
             
            $results .= '
                <tr>
                  <td>'.$row['id'].'</td>
                  <td>'.$row['loc_from_name'].' - '.$row['loc_to_name'].'</td>
                  <td>'.$row['loc_from_name'].'</td>
                  <td>'.$row['stop_from_name'].'</td>
                  <td>'.date("H:i", strtotime($row['start_time'])).'</td>
                  <td>'.$row['loc_to_name'].'</td>
                  <td>'.$row['stop_to_name'].'</td>
                  <td>'.date("H:i", strtotime($row['end_time'])).'</td>
                  <td>'.$row['blocked_dates'].'</td>
                  <td>'.$row['bus_name'].'</td>
                  <td>'.$row['bus_seats'].'</td>
                  <td>'.$row['trip_price'].'</td>
                  <td>'.$discounts_names0.'</td>
                  <td>'.$discounts_names1.'</td>
                  <td>
                    <a href="#" class="'.$status.'" data-toggle="class">
                        <i class="fa fa-check text-success text-active" onclick="setStatus('.$row['id'].', 1)"></i>
                        <i class="fa fa-times text-danger text" onclick="setStatus('.$row['id'].', 0)"></i></a>
                  </td>
                  <td>
                    <a href="#modal-form" onclick="loadDiscounts('.$row['id'].')" class="btn btn-dark btn-sm" data-toggle="modal" data-backdrop="static"
                      data-keyboard="false"><i class="fa fa-eye" aria-hIDden="true"></i>
                    </a>
                  </td>
                  <td>';
                  if ($this->roles['edit'] == 1)
                    $results .= '<a href="index.php?page=trip_add&id='.$row['id'].'" class="btn btn-info btn-sm datatables-graediting-deletede"
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

    private function loadDiscounts($id) {
        $results = '';
        $sql = 'SELECT trips_discounts.*, 
            (SELECT discounts.discount FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_discount,
            (SELECT discounts.sign FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_sign
            FROM trips_discounts
            LEFT JOIN discounts ON (trips_discounts.discount_id = discounts.id)
            WHERE discounts.sign = 2 AND trips_discounts.trip_id = '.$id.' ORDER BY trips_discounts.id';
        $query = $this->db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $results .= '      
              <tr>
                <td>'.$row['trips_from'].'</td>
                <td>'.$row['trips_to'].'</td>
                <td>'.$row['discount_discount'].' %</td>
              </tr>
            ';
        }

        echo $results;
    }

    private function deleteRecord($id) {
        $sql = 'DELETE FROM trips WHERE id = '.$id;
        $query = $this->db->query($sql);
    }

    private function setStatus($id, $status) {
        $sql = 'UPDATE `trips` SET `reserv_disabled` = '.$status.' WHERE id = '.$id;
        $query = $this->db->query($sql);
    }
    
    private function updateStops($id) {
        $results = array();
        $sql = 'SELECT * FROM stops WHERE city_id = '.$id.' AND '.$this->carrier_where;
        $query = $this->db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $results[] = array('id' => $row['id'], 'name' => $row['name']);
        }
        
        echo json_encode($results);
    }
    
}

$trips = new Trips();
?>