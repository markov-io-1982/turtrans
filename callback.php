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

		    $sql = 'SELECT * FROM trips WHERE id = '.$dae->trip_id;
		    $query = $db->query($sql);
	    	$trip = $query->fetch(PDO::FETCH_ASSOC);

			echo "<pre>";
			print_r($trip);
			echo "</pre>";

			$ids_str = '';
			foreach ($dae->tickets as $ticket):
				$passenger_id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;
				$name1 = isset($ticket->firstName) ? $ticket->firstName : null;
	        	$name2 = isset($ticket->lastName) ? $ticket->lastName : null;
	        	$email = isset($dae->email) ? $dae->email : null;
	        	$phone = isset($ticket->phone) ? $ticket->phone : null;
	        	$trip_id = isset($dae->trip_id) ? $dae->trip_id : 0;
	        	$loc_from_id = isset($dae->from) ? $dae->from : 0;
	        	$loc_to_id = isset($dae->to) ? $dae->to : 0;
	        	$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	        	$nbr = substr(str_shuffle($permitted_chars), 0, 10);
	        	$date_buy = date('Y-m-d H:i:s');
	        	$date_departure = isset($dae->date) ? date('Y-m-d H:i:s', $dae->date) : null;
	        	$seat = isset($ticket->id) ? $ticket->id : 0;
	        	$cost = isset($ticket->discountPrice) ? $ticket->discountPrice : 0;
	        	$status = 2;
	        	$carrier_id = $trip['carrier_id'];
	        
		        $sql = 'INSERT `tickets` SET 
		        	`passenger_id` = :passenger_id,
		            `name1` = :name1,
		            `name2` = :name2,
		            `email` = :email,
		            `phone` = :phone,
		        	`trip_id` = :trip_id,
		        	`loc_from_id` = :loc_from_id,
	    	    	`loc_to_id` = :loc_to_id,
	        		`number` = :nbr,
	        		`date_buy` = :date_buy,
	        		`date_departure` = :date_departure,
	        		`seat` = :seat,
	        		`cost` = :cost,
	        		`status` = :status,
	        		`carrier_id` = :carrier_id
		        ';
		        $query = $db->prepare($sql);
		        $query->bindParam(":passenger_id", $passenger_id);
		        $query->bindParam(":name1", $name1);
		        $query->bindParam(":name2", $name2);
		        $query->bindParam(":email", $email);
		        $query->bindParam(":phone", $phone);
		        $query->bindParam(":trip_id", $trip_id);
		        $query->bindParam(":loc_from_id", $loc_from_id);
		        $query->bindParam(":loc_to_id", $loc_to_id);
		        $query->bindParam(":nbr", $nbr);
		        $query->bindParam(":date_buy", $date_buy);
		        $query->bindParam(":date_departure", $date_departure);
		        $query->bindParam(":seat", $seat);
		        $query->bindParam(":cost", $cost);
		        $query->bindParam(":status", $status);
		        $query->bindParam(":carrier_id", $carrier_id);
		        $query->execute();
		        $insert_id = $db->lastInsertId();
		        $ids_str .= $insert_id.'-';
		    endforeach;
		    $ids_str = substr($ids_str, 0, -1);
		    echo $ids_str;
		    
		    header('Location: successful.php?ids='.$ids_str);
		}	
	} else {
		header('location: 404.php');
	}
 ?>