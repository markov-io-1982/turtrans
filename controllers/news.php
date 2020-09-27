<?php
	$news = array();
    $sql = 'SELECT * FROM news WHERE status = 1';
    $query = $db->query($sql);
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    	$news[] = $row;
    }
?>