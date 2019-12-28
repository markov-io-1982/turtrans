<?php
    // this is super admin
    if ($_SESSION['user']['position_id'] == 1) {
        $carrier_id = $_SESSION['user']['id'];
        $carrier_where = '1';
    }
    // this is carrier
    else if ($_SESSION['user']['position_id'] == 2) {
        $carrier_id = $_SESSION['user']['id'];
        $carrier_where = 'carrier_id = '.$carrier_id;
    }
    // this is from personnel 
    else {
        $sql = 'SELECT * FROM users WHERE id = '.$_SESSION['user']['carrier_id'];
        $query = $db->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $carrier_id = $row['id'];
        $carrier_where = 'carrier_id = '.$carrier_id;
    }  
    
    // ***** POST ********************************************
    if (!empty($_POST)) {
        $loc_from_id = isset($_POST['loc_from_id']) ? $_POST['loc_from_id'] : 0;
        $stop_from_id = isset($_POST['stop_from_id']) ? $_POST['stop_from_id'] : 0;
        $start_time = !empty($_POST['start_time']) ? $_POST['start_time'] : null;
        $loc_to_id = isset($_POST['loc_to_id']) ? $_POST['loc_to_id'] : 0;
        $stop_to_id = isset($_POST['stop_to_id']) ? $_POST['stop_to_id'] : 0;
        $end_time = !empty($_POST['end_time']) ? $_POST['end_time'] : null;
        $bus_id = isset($_POST['bus_id']) ? $_POST['bus_id'] : 0;
        $blocked_dates = isset($_POST['blocked_dates']) ? $_POST['blocked_dates'] : null;
        $blocked_seats = '';
        if (isset($_POST['seats'])) {
            foreach ($_POST['seats'] as $key => $value):
                $blocked_seats .= $key.',';
            endforeach; 
            $blocked_seats = substr($blocked_seats, 0, -1);
        }
        $reserv_disabled = isset($_POST['reserv_disabled']) ? 1 : 0;
        
        // insert
        if (empty($_POST['id'])) {
            $sql = 'INSERT `trips` SET 
                `loc_from_id` = :loc_from_id,
                `stop_from_id` = :stop_from_id,
                `start_time` = :start_time,
                `loc_to_id` = :loc_to_id,
                `stop_to_id` = :stop_to_id,
                `end_time` = :end_time,
                `bus_id` = :bus_id,
                `blocked_dates` = :blocked_dates,
                `blocked_seats` = :blocked_seats,
                `reserv_disabled` = :reserv_disabled,
                `carrier_id` = :carrier_id
            ';
            $query = $db->prepare($sql);
            $query->bindParam(":loc_from_id", $loc_from_id);
            $query->bindParam(":stop_from_id", $stop_from_id);
            $query->bindParam(":start_time", $start_time);
            $query->bindParam(":loc_to_id", $loc_to_id);
            $query->bindParam(":stop_to_id", $stop_to_id);
            $query->bindParam(":end_time", $end_time);
            $query->bindParam(":bus_id", $bus_id);
            $query->bindParam(":blocked_dates", $blocked_dates);
            $query->bindParam(":blocked_seats", $blocked_seats);
            $query->bindParam(":reserv_disabled", $reserv_disabled);
            $query->bindParam(":carrier_id", $carrier_id);
            $query->execute();
            $trip_id = $db->lastInsertId();
        }    
        // update
        else {
            $trip_id = $_POST['id'];
            $sql = 'UPDATE `trips` SET 
                `loc_from_id` = :loc_from_id,
                `stop_from_id` = :stop_from_id,
                `start_time` = :start_time,
                `loc_to_id` = :loc_to_id,
                `stop_to_id` = :stop_to_id,
                `end_time` = :end_time,
                `bus_id` = :bus_id,
                `blocked_dates` = :blocked_dates,
                `blocked_seats` = :blocked_seats,
                `reserv_disabled` = :reserv_disabled
                WHERE id = '.$trip_id;
            $query = $db->prepare($sql);
            $query->bindParam(":loc_from_id", $loc_from_id);
            $query->bindParam(":stop_from_id", $stop_from_id);
            $query->bindParam(":start_time", $start_time);
            $query->bindParam(":loc_to_id", $loc_to_id);
            $query->bindParam(":stop_to_id", $stop_to_id);
            $query->bindParam(":end_time", $end_time);
            $query->bindParam(":bus_id", $bus_id);
            $query->bindParam(":blocked_dates", $blocked_dates);
            $query->bindParam(":blocked_seats", $blocked_seats);
            $query->bindParam(":reserv_disabled", $reserv_disabled);
            $query->execute();
        }
        
        // add trip_stops
        $sql = 'DELETE FROM trips_stops WHERE trip_id = '.$trip_id;
        $query = $db->query($sql);
        for ($i = 1; $i < count($_POST['stops_loc_id']); $i++) {
            $stops_loc_id = isset($_POST['stops_loc_id'][$i]) ? $_POST['stops_loc_id'][$i] : 0;
            $stops_stop_id = isset($_POST['stops_stop_id'][$i]) ? $_POST['stops_stop_id'][$i] : 0;
            $stops_start_time = !empty($_POST['stops_start_time'][$i]) ? $_POST['stops_start_time'][$i] : null;
            $stops_end_time = !empty($_POST['stops_end_time'][$i]) ? $_POST['stops_end_time'][$i] : null;
            $distance = isset($_POST['distance'][$i]) ? $_POST['distance'][$i] : 0;
            $sql = 'INSERT `trips_stops` SET 
                `trip_id` = :trip_id,
                `loc_id` = :loc_id,
                `stop_id` = :stop_id,
                `start_time` = :start_time,
                `end_time` = :end_time,
                `distance` = :distance
            ';
            $query = $db->prepare($sql);
            $query->bindParam(":trip_id", $trip_id);
            $query->bindParam(":loc_id", $stops_loc_id);
            $query->bindParam(":stop_id", $stops_stop_id);
            $query->bindParam(":start_time", $stops_start_time);
            $query->bindParam(":end_time", $stops_end_time);
            $query->bindParam(":distance", $distance);
            $query->execute();
        }
        
        // add trip reserv seats
        $sql = 'DELETE FROM trips_seats_reserv WHERE trip_id = '.$trip_id;
        $query = $db->query($sql);
        for ($i = 1; $i < count($_POST['reserv_date']); $i++) {
            $reserv_date = !empty($_POST['reserv_date'][$i]) ? $_POST['reserv_date'][$i] : null;
            $reserv_seats = isset($_POST['reserv_seats'][$i]) ? $_POST['reserv_seats'][$i] : null;
            $sql = 'INSERT `trips_seats_reserv` SET 
                `trip_id` = :trip_id,
                `date` = :reserv_date,
                `seats` = :reserv_seats
            ';
            $query = $db->prepare($sql);
            $query->bindParam(":trip_id", $trip_id);
            $query->bindParam(":reserv_date", date("Y-m-d", strtotime($reserv_date)));
            $query->bindParam(":reserv_seats", $reserv_seats);
            $query->execute();
        }
        
        // add trip prices
        $sql = 'DELETE FROM trips_prices WHERE trip_id = '.$trip_id;
        $query = $db->query($sql);
        foreach ($_POST['prices'] as $loc_from_id => $loc_to):
            foreach ($loc_to as $loc_to_id => $price):
                $sql = 'INSERT `trips_prices` SET 
                    `trip_id` = :trip_id,
                    `loc_from_id` = :loc_from_id,
                    `loc_to_id` = :loc_to_id,
                    `price` = :price
                ';
                $query = $db->prepare($sql);
                $query->bindParam(":trip_id", $trip_id);
                $query->bindParam(":loc_from_id", $loc_from_id);
                $query->bindParam(":loc_to_id", $loc_to_id);
                $query->bindParam(":price", $price);
                $query->execute();
            endforeach;
        endforeach;
        
        // add trip discounts
        $sql = 'DELETE FROM trips_discounts WHERE trip_id = '.$trip_id;
        $query = $db->query($sql);
        foreach ($_POST['discounts0'] as $discount_id):
            $sql = 'INSERT `trips_discounts` SET 
                `trip_id` = :trip_id,
                `discount_id` = :discount_id
            ';
            $query = $db->prepare($sql);
            $query->bindParam(":trip_id", $trip_id);
            $query->bindParam(":discount_id", $discount_id);
            $query->execute();
        endforeach; 
        foreach ($_POST['discounts1'] as $discount_id):
            $sql = 'INSERT `trips_discounts` SET 
                `trip_id` = :trip_id,
                `discount_id` = :discount_id
            ';
            $query = $db->prepare($sql);
            $query->bindParam(":trip_id", $trip_id);
            $query->bindParam(":discount_id", $discount_id);
            $query->execute();
        endforeach; 
        
        for ($i = 1; $i < count($_POST['discounts_ids']); $i++) {
            $discount_id = isset($_POST['discounts_ids'][$i]) ? $_POST['discounts_ids'][$i] : 0;
            $trips_from = isset($_POST['discounts_from'][$i]) ? $_POST['discounts_from'][$i] : 0;
            $trips_to = isset($_POST['discounts_to'][$i]) ? $_POST['discounts_to'][$i] : 0;
            
            $sql = 'INSERT `trips_discounts` SET 
                `trip_id` = :trip_id,
                `discount_id` = :discount_id,
                `trips_from` = :trips_from,
                `trips_to` = :trips_to
            ';
            $query = $db->prepare($sql);
            $query->bindParam(":trip_id", $trip_id);
            $query->bindParam(":discount_id", $discount_id);
            $query->bindParam(":trips_from", $trips_from);
            $query->bindParam(":trips_to", $trips_to);
            $query->execute();
        }
        
        
        header('Location: index.php?page=trip_add&id='.$trip_id);
        exit();
    }
    
    
    $locations = array();
    $stops_from = array();
    $stops_to = array();
    $buses = array();
    $trip_stops = array();
    $reserv_seats = array();
    $route = array();
    $trip_prices = array();
    $discounts0 = array();
    $discounts1 = array();
    $discounts2 = array();
    $trip_discounts0 = array();
    $trip_discounts1 = array();
    $trip_discounts2 = array();
    $blocked_seats = array();
        
    $sql = 'SELECT * FROM locations WHERE status = 1 AND '.$carrier_where;
    $query = $db->query($sql);
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $locations[] = array('id' => $row['id'], 'name' => $row['city']);    
    }
  
    $sql = 'SELECT * FROM buses WHERE status = 1 AND '.$carrier_where;
    $query = $db->query($sql);
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $buses[] = array('id' => $row['id'], 'name' => $row['brand']);    
    }
    
    $sql = 'SELECT * FROM discounts WHERE status = 1 AND sign = 0 AND '.$carrier_where;
    $query = $db->query($sql);
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $discounts0[] = array('id' => $row['id'], 'name' => $row['name']);    
    }
    $sql = 'SELECT * FROM discounts WHERE status = 1 AND sign = 1 AND '.$carrier_where;
    $query = $db->query($sql);
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $discounts1[] = array('id' => $row['id'], 'name' => $row['name']);    
    }
    $sql = 'SELECT * FROM discounts WHERE status = 1 AND sign = 2 AND '.$carrier_where;
    $query = $db->query($sql);
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $discounts2[] = array('id' => $row['id'], 'name' => $row['name'], 'discount' => $row['discount']);    
    }
    
    // ***** EDIT ********************************************
    if (isset($_GET['id'])) {
        // get trip
        $sql = 'SELECT trips.*, 
            (SELECT locations.city FROM locations WHERE trips.loc_from_id = locations.id) as loc_from_name,
            (SELECT locations.city FROM locations WHERE trips.loc_to_id = locations.id) as loc_to_name,
            (SELECT stops.name FROM stops WHERE trips.stop_from_id = stops.id) as stop_from_name,
            (SELECT stops.name FROM stops WHERE trips.stop_to_id = stops.id) as stop_to_name
            FROM trips 
            LEFT JOIN locations ON (trips.loc_from_id = locations.id AND trips.loc_to_id = locations.id)
            LEFT JOIN stops ON (trips.stop_from_id = stops.id AND trips.stop_to_id = stops.id)
            WHERE trips.id = '.$_GET['id'];
        $query = $db->query($sql);
        $trip = $query->fetch(PDO::FETCH_ASSOC);
        $trip['start_time'] = date("H:i", strtotime($trip['start_time']));
        $trip['end_time'] = date("H:i", strtotime($trip['end_time']));
        $blocked_seats = explode(',', $trip['blocked_seats']);
        
        // gel stops by locations
        $sql = 'SELECT * FROM stops WHERE status = 1 AND city_id = '.$trip['loc_from_id'].' AND '.$carrier_where;
        $query = $db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $stops_from[] = array('id' => $row['id'], 'name' => $row['name']);    
        }
        $sql = 'SELECT * FROM stops WHERE status = 1 AND city_id = '.$trip['loc_to_id'].' AND '.$carrier_where;
        $query = $db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $stops_to[] = array('id' => $row['id'], 'name' => $row['name']);    
        }

        // get all stops
        $sql = 'SELECT trips_stops.*, 
            (SELECT locations.city FROM locations WHERE trips_stops.loc_id = locations.id) as loc_name,
            (SELECT stops.name FROM stops WHERE trips_stops.stop_id = stops.id) as stop_name
            FROM trips_stops 
            LEFT JOIN locations ON (trips_stops.loc_id = locations.id)
            LEFT JOIN stops ON (trips_stops.stop_id = stops.id)
            WHERE trips_stops.trip_id = '.$_GET['id'].' ORDER BY id';
        $query = $db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $row['start_time'] = date("H:i", strtotime($row['start_time']));
            $row['end_time'] = date("H:i", strtotime($row['end_time']));
            $row['stops'] = array();
            $sql = 'SELECT * FROM stops WHERE status = 1 AND city_id = '.$row['loc_id'].' AND '.$carrier_where;
            $query2 = $db->query($sql);
            while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)) {
                $row['stops'][] = array('id' => $row2['id'], 'name' => $row2['name']);    
            }
            
            $trip_stops[] = $row; 
        }
        
        // get trip reserv seats
        $sql = 'SELECT * FROM trips_seats_reserv WHERE trip_id = '.$_GET['id'].' ORDER BY id';
        $query = $db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $row['date'] = date("d-m-Y", strtotime($row['date']));
            $reserv_seats[] = $row; 
        }
        
        // get full route
        $route[] = array('id' => $trip['loc_from_id'], 'name' => $trip['loc_from_name'].' '.$trip['stop_from_name']);
        foreach ($trip_stops as $trip_stop):
            $route[] = array('id' => $trip_stop['loc_id'], 'name' => $trip_stop['loc_name'].' '.$trip_stop['stop_name']);
        endforeach;
        $route[] = array('id' => $trip['loc_to_id'], 'name' => $trip['loc_to_name'].' '.$trip['stop_to_name']);

        // get trip prices     
        $sql = 'SELECT * FROM trips_prices WHERE trip_id = '.$_GET['id'].' ORDER BY id';
        $query = $db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $trip_prices[$row['loc_from_id']][$row['loc_to_id']] = $row['price']; 
        }
        
        // get discounts
        $sql = 'SELECT trips_discounts.*, 
            (SELECT discounts.name FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_name,
            (SELECT discounts.sign FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_sign
            FROM trips_discounts
            LEFT JOIN discounts ON (trips_discounts.discount_id = discounts.id)
            WHERE discounts.sign = 0 AND trips_discounts.trip_id = '.$_GET['id'];
        $query = $db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $trip_discounts0[] = $row; 
        }
        $sql = 'SELECT trips_discounts.*, 
            (SELECT discounts.name FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_name,
            (SELECT discounts.sign FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_sign
            FROM trips_discounts
            LEFT JOIN discounts ON (trips_discounts.discount_id = discounts.id)
            WHERE discounts.sign = 1 AND trips_discounts.trip_id = '.$_GET['id'];
        $query = $db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $trip_discounts1[] = $row; 
        }
        
        $sql = 'SELECT trips_discounts.*, 
            (SELECT discounts.discount FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_discount,
            (SELECT discounts.sign FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_sign
            FROM trips_discounts
            LEFT JOIN discounts ON (trips_discounts.discount_id = discounts.id)
            WHERE discounts.sign = 2 AND trips_discounts.trip_id = '.$_GET['id'].' ORDER BY trips_discounts.id';
        $query = $db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $trip_discounts2[] = $row; 
        }

    }
    

?>