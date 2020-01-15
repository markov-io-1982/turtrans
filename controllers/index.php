<?php
    $sql = 'SELECT * FROM locations WHERE status = 1 ORDER BY city';
    $query = $db->query($sql);
    $locations = array();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
     	$locations[] = $row;
    }

    $sql = 'SELECT * FROM buses WHERE status = 1';
    $query = $db->query($sql);
    $buses = array();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$buses[] = $row;
    }

?>