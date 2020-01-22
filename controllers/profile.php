<?php
    if (isset($_SESSION['user']['id'])) {
        $id = $_SESSION['user']['id'];	
        $statuses = array(1 => 'Заброньовано', 2 => 'Оплачено', 3 => '-');

	    $sql = 'SELECT tickets.*, 
	        (SELECT locations.city FROM locations WHERE tickets.loc_from_id = locations.id) as loc_from_name,
	        (SELECT locations.city FROM locations WHERE tickets.loc_to_id = locations.id) as loc_to_name
	        FROM tickets 
	        LEFT JOIN locations ON (tickets.loc_from_id = locations.id AND tickets.loc_to_id = locations.id)
	        WHERE passenger_id = '.$id;
	    $query = $db->query($sql);
	    $tickets = array();
	    $total = 0;
	    $trips_all = 0;
	    $trips_bonus = 0;
	    $trips_payed = 0;
	    $trips_reserved = 0;
	    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	    	$row['date_departure'] = date('d.m.Y', strtotime($row['date_departure']));
	    	$total += $row['cost'];
			$trips_all++;
			if ($row['status'] == 1)
				$trips_reserved++;
			if ($row['status'] == 2)
				$trips_payed++;
	    	$row['status'] = $statuses[$row['status']];			
			$tickets[] = $row;			
	    }	
	}
?>