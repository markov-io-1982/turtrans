<?php
    $sql = 'SELECT * FROM locations WHERE status = 1 ORDER BY city';
    $query = $db->query($sql);
    $locations = array();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $locations[] = $row;
    }

    if (isset($_POST['date'])) {
        $loc_from = $_POST['loc_from'];
        $loc_to = $_POST['loc_to'];
        $date = $_POST['date'];
        $sql = 'SELECT trips.*, 
            (SELECT locations.city FROM locations WHERE trips.loc_from_id = locations.id) as loc_from_name,
            (SELECT locations.city FROM locations WHERE trips.loc_to_id = locations.id) as loc_to_name,
            (SELECT stops.name FROM stops WHERE trips.stop_from_id = stops.id) as stop_from_name,
            (SELECT stops.name FROM stops WHERE trips.stop_to_id = stops.id) as stop_to_name,
            (SELECT buses.brand FROM buses WHERE trips.bus_id = buses.id) as bus_brand,
            (SELECT buses.model FROM buses WHERE trips.bus_id = buses.id) as bus_model,
            (SELECT buses.seats FROM buses WHERE trips.bus_id = buses.id) as bus_seats,
            (SELECT trips_prices.price FROM trips_prices WHERE trips.id = trips_prices.trip_id AND trips.loc_from_id = trips_prices.loc_from_id AND trips.loc_to_id = trips_prices.loc_to_id) as trip_price 
            FROM trips
            LEFT JOIN locations ON (trips.loc_from_id = locations.id AND trips.loc_to_id = locations.id)
            LEFT JOIN stops ON (trips.stop_from_id = stops.id AND trips.stop_to_id = stops.id)
            LEFT JOIN buses ON (trips.bus_id = buses.id AND trips.bus_id = buses.id)
            LEFT JOIN trips_prices ON (trips.id = trips_prices.trip_id AND trips.loc_from_id = trips_prices.loc_from_id AND trips.loc_to_id = trips_prices.loc_to_id)
            WHERE 1';
        $query = $db->query($sql);

        $trips = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $trip = array();
            $trip['id'] = $row['id'];
            $trip['bus_name'] = $row['bus_brand'].' '.$row['bus_model'];
            $trip['bus_seats'] = $row['bus_seats'];
            $trip['blocked_dates'] = $row['blocked_dates'];
            $trip['blocked_seats'] = $row['blocked_seats'];
        	$trip['route'][] = array(
                'loc_id' => $row['loc_from_id'],
                'loc_name' => $row['loc_from_name'],
                'stop_id' => $row['stop_from_id'],
                'stop_name' => $row['stop_from_name'],
                'time' => $row['start_time'],
            );

            $sql = 'SELECT trips_stops.*, 
                (SELECT locations.city FROM locations WHERE trips_stops.loc_id = locations.id) as loc_name,
                (SELECT stops.name FROM stops WHERE trips_stops.stop_id = stops.id) as stop_name
                FROM trips_stops 
                LEFT JOIN locations ON (trips_stops.loc_id = locations.id)
                LEFT JOIN stops ON (trips_stops.stop_id = stops.id)
                WHERE trips_stops.trip_id = '.$row['id'].' ORDER BY id';
            $query1 = $db->query($sql);
            while ($row1 = $query1->fetch(PDO::FETCH_ASSOC)) {
                $trip['route'][] = array(
                    'loc_id' => $row1['loc_id'],
                    'loc_name' => $row1['loc_name'],
                    'stop_id' => $row1['stop_id'],
                    'stop_name' => $row1['stop_name'],
                    'time' => $row1['start_time'],
                );
            }

            $trip['route'][] = array(
                'loc_id' => $row['loc_to_id'],
                'loc_name' => $row['loc_to_name'],
                'stop_id' => $row['stop_to_id'],
                'stop_name' => $row['stop_to_name'],
                'time' => $row['end_time'],
            );

        	$all_trips[] = $trip;
        }

        $trips = array();
        foreach ($all_trips as $all_trip):
            // set locs to route
            $locs = array();
            foreach ($all_trip['route'] as $loc):
                $locs[] = $loc['loc_id'];
            endforeach;        
            $loc_from_key = array_search($loc_from, $locs); 
            $loc_to_key = array_search($loc_to, $locs);   

            // check blocked_dates
            $blocked_dates = explode(',', $all_trip['blocked_dates']);
            if (in_array(date("d-m-Y", strtotime($_POST['date'])), $blocked_dates)) {
                continue;                    
            } 

            // founded
            if (($loc_from_key !== false) && ($loc_to_key !== false) && ($loc_from_key < $loc_to_key)) {
                $trip = array();
                $trip = $all_trip;
                unset($trip['route']);
                for ($i = $loc_from_key; $i <= $loc_to_key; $i++) {
                    $trip['route'][] = $all_trip['route'][$i];
                }
                $sql = 'SELECT * FROM trips_prices WHERE loc_from_id = '.$loc_from.' AND loc_to_id = '.$loc_to.' AND trip_id = '.$all_trip['id'];
                $query = $db->query($sql);
                $row = $query->fetch(PDO::FETCH_ASSOC);
                $trip['price'] = $row['price'];
                $time_diff = strtotime($trip['route'][count($trip['route']) - 1]['time']) - strtotime($trip['route'][0]['time']);
                $h = floor($time_diff / 60 / 60);
                $m = (floor($time_diff / 60 % 60) == 0) ? '00' : floor($time_diff / 60 % 60);
                $trip['time'] = $h.':'.$m;

                $trips[] = $trip;
            }
        endforeach;
    }
?>