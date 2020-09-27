<?php
// http://localhost/turtrans/not_registered_user.php?ids=52-53
	if (isset($_GET['ids'])) {
		$ids_str = $_GET['ids'];
	    if ($is_local)
	    	$pay_url = 'http://localhost/turtrans/pay-tickets.php?ids='.$ids_str;
	    else
	    	$pay_url = 'http://turtrans-r.com/pay-tickets.php?ids='.$ids_str;	    
	    $tickets_ids = explode("-", $ids_str);

		$tickets = array();
		$amount = 0;
		foreach ($tickets_ids as $ticket_id):
		    $sql = 'SELECT tickets.*, 
		        (SELECT locations.city FROM locations WHERE tickets.loc_from_id = locations.id) as loc_from_name,
		        (SELECT locations.city FROM locations WHERE tickets.loc_to_id = locations.id) as loc_to_name,
		        (SELECT trips_stops.end_time FROM trips_stops WHERE tickets.trip_id = trips_stops.trip_id AND tickets.loc_from_id = trips_stops.loc_id) as time_from,
		        (SELECT trips_stops.start_time FROM trips_stops WHERE tickets.trip_id = trips_stops.trip_id AND tickets.loc_to_id = trips_stops.loc_id) as time_to
		        FROM tickets 
		        LEFT JOIN locations ON (tickets.loc_from_id = locations.id AND tickets.loc_to_id = locations.id)
		        WHERE tickets.id = '.$ticket_id;
		    $query = $db->query($sql);
		    $row = $query->fetch(PDO::FETCH_ASSOC);
			
			$ticket = array(
				'name1' => $row['name1'],
				'name2' => $row['name2'],
				'number' => $row['number'],
				'cost' => $row['cost'],
				'seat' => $row['seat'],
				'phone' => $row['phone']
			);
			$tickets[] = $ticket;
			$amount += $row['cost'];
		endforeach;	

		$data = array(
			'email' => $row['email'],
			'loc_from' => $row['loc_from_name'],
			'loc_to' => $row['loc_to_name'],
			'date' => date('d.m.Y', strtotime($row['date_departure'])),
			'time_from' => date('H:i', strtotime($row['time_from'])),
			'time_to' => date('H:i', strtotime($row['time_to'])),
			'amount' => $amount,
			'reserv_end' => $row['date_reserv_end']
		);
		$data['tickets'] = $tickets;
	} else {
		header('location: 404.php');
	}
?>
