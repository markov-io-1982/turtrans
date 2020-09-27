<?php
	if (isset($_GET['id'])) {
	    $sql = 'SELECT * FROM news WHERE id = '.$_GET['id'];
	    $query = $db->query($sql);
	    $news_one = $query->fetch(PDO::FETCH_ASSOC);

		$news = array();
    	$sql = 'SELECT * FROM news WHERE status = 1';
    	$query = $db->query($sql);
    	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    		if ($row['id'] != $_GET['id'])
    			$news[] = $row;
    	}
	} else {
		header('location: 404.php');
	}
?>