<?php
    require 'connect.php';

	if (isset($_POST['data'])) {
		$result = json_decode( base64_decode($_POST['data']));
		if ($result->status == 'success') {

			echo "<pre>";
			print_r($result);
			echo "</pre>";

			$dae = json_decode(base64_decode($result->dae));
			echo "<pre>";
			print_r($dae);
			echo "</pre>";

			$ids_str = '';
			foreach ($dae as $id):
	            $date_buy = date('Y-m-d H:i:s');
            	$date_reserv_start = null;
            	$date_reserv_end = null;
	            $status = 2;
	            $sql = 'UPDATE `tickets` SET 
    	            `date_buy` = :date_buy, 
        	        `date_reserv_start` = :date_reserv_start, 
                	`date_reserv_end` = :date_reserv_end, 
                	`status` = :status
                	WHERE id = '.$id;
            	$query = $db->prepare($sql);
            	$query->bindParam(":date_buy", $date_buy);
            	$query->bindParam(":date_reserv_start", $date_reserv_start);
            	$query->bindParam(":date_reserv_end", $date_reserv_end);
    	        $query->bindParam(":status", $status);
	            $query->execute();
	            $ids_str .= $id.'-';
			endforeach;	
			$ids_str = substr($ids_str, 0, -1);
		}
		header('Location: successful.php?ids='.$ids_str);
	} else {
		header('location: 404.php');
	}

?>