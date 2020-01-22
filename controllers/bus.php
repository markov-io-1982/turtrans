<?php
	if (isset($_GET['id'])) {
	    $sql = 'SELECT * FROM buses WHERE id = '.$_GET['id'];
	    $query = $db->query($sql);
	    $bus = $query->fetch(PDO::FETCH_ASSOC);

	    $sql = 'SELECT * FROM buses_gallery WHERE bus_id = '.$_GET['id'];
	    $query = $db->query($sql);
	    $gallery = array();
	    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	    	$gallery[] = $row['photo'];
	    }

        $options = array();
        $sql = 'SELECT (SELECT options.name FROM options WHERE option_id = options.id) as option_name 
            FROM buses_options 
            LEFT JOIN options ON buses_options.option_id = options.id
            WHERE bus_id = '.$_GET['id'];
        $query = $db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $options[] = $row['option_name'];
        }

	}
?>