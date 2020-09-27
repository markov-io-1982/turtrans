<?php
	$buses = array();
    $sql = 'SELECT * FROM buses WHERE status = 1';
    $query = $db->query($sql);
    while ($bus = $query->fetch(PDO::FETCH_ASSOC)) {
	    $gallery = array();
	    $sql = 'SELECT * FROM buses_gallery WHERE bus_id = '.$bus['id'];
	    $query1 = $db->query($sql);
	    while ($row = $query1->fetch(PDO::FETCH_ASSOC)) {
	    	$gallery[] = $row['photo'];
	    }
	    $bus['gallery'] = $gallery;

	    $options = array();
	    $sql = 'SELECT (SELECT options.name FROM options WHERE option_id = options.id) as option_name 
	        FROM buses_options 
	        LEFT JOIN options ON buses_options.option_id = options.id
	        WHERE bus_id = '.$bus['id'];
	    $query1 = $db->query($sql);
	    while ($row = $query1->fetch(PDO::FETCH_ASSOC)) {
	        $options[] = $row['option_name'];
	    }
		$bus['options'] = $options;

		$buses[] = $bus;
    }
?>