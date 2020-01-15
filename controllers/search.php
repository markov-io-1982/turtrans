<?php
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
    	$trip = $row;
        $sql = 'SELECT trips_stops.*, 
            (SELECT locations.city FROM locations WHERE trips_stops.loc_id = locations.id) as loc_name,
            (SELECT stops.name FROM stops WHERE trips_stops.stop_id = stops.id) as stop_name
            FROM trips_stops 
            LEFT JOIN locations ON (trips_stops.loc_id = locations.id)
            LEFT JOIN stops ON (trips_stops.stop_id = stops.id)
            WHERE trips_stops.trip_id = '.$row['id'].' ORDER BY id';
        $query1 = $db->query($sql);
        $trip['stops'] = array();
        while ($row1 = $query1->fetch(PDO::FETCH_ASSOC)) {
			$trip['stops'][] = $row1;
        }

    	$trips[] = $trip;
    }
?>