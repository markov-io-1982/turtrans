<?php
    if (isset($_SESSION['user']['id'])) {
        $id = $_SESSION['user']['id'];	
        $statuses = array(1 => 'Заброньовано', 2 => 'Оплачено', 3 => '-');
        date_default_timezone_set('Europe/Kiev');
	    if ($is_local)
    		$pay_url = 'http://localhost/turtrans/pay-tickets.php?ids=';
    	else
    		$pay_url = 'http://turtrans-r.com/pay-tickets.php?ids=';	    

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

	    $sql = 'SELECT tickets.*, 
	        (SELECT locations.city FROM locations WHERE tickets.loc_from_id = locations.id) as loc_from_name,
	        (SELECT locations.city FROM locations WHERE tickets.loc_to_id = locations.id) as loc_to_name
	        FROM tickets 
	        LEFT JOIN locations ON (tickets.loc_from_id = locations.id AND tickets.loc_to_id = locations.id)
	        WHERE passenger_id = '.$id.' AND date_reserv_end > "'.date('Y-m-d H:i:s').'" AND tickets.status = 1';
	    $query = $db->query($sql);
	    $r_tickets = array();
	    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	    	$row['date_departure'] = date('d.m.Y', strtotime($row['date_departure']));
			$d1 = strtotime($row['date_reserv_end']);
			$d2 = strtotime(date('Y-m-d H:i:s'));
			$diff = $d1 - $d2;
			$hours = floor($diff / 60 / 60);
			$mins = date('i', $diff);
			$secs = date('s', $diff);
	    	$row['time_left'] = $hours."г. ".$mins."х. ".$secs."с.";
			$r_tickets[] = $row;			
	    }	


	} else {
		header('Location: login.php');
	}
?>