<?php
	$private_key = 'sandbox_dQjdlQvA8h1H22Z691DdGp79REzW1ZeR64eZxmjF';
	$public_key = 'sandbox_i72245637255'; 

	// POST pay
	if (isset($_POST['pay-submit'])) {
		require '../connect.php';

		$tickets = $_POST['tickets'];
		// http://localhost/turtrans/checkout.php?id=13&from=8&to=5&date=21-09-2020&price=400
		// http://turtrans-r.com/checkout.php?id=13&from=8&to=5&date=21-09-2020&price=400

		if ($is_local)			
			$callback_url = 'http://localhost/turtrans/callback.php';
		else
			$callback_url = 'http://turtrans-r.com/callback.php';

		$results = array();
		$amount = 0; 
		foreach ($tickets as $ticket):
			$amount += $ticket['discountPrice'];
		endforeach;

		$dae_arr = array(
			'trip_id' => $_POST['trip_id'],
			'from' => $_POST['from'],
			'to' => $_POST['to'],
			'date' => $_POST['date'],
			'email' => $_POST['email'],
			'tickets' => $tickets
		);

		$dae = base64_encode(json_encode($dae_arr));

		$json_arr = array(
			"public_key" => $public_key, 
			"version" => "3", 
			"action" => "pay",
			"amount" => $amount,
			"currency" => "UAH",
			"description" => "test",
			"order_id" => time(),
			"result_url" => $callback_url,
        	"server_url" => $callback_url,
        	"dae" => $dae
		);
		$json_string = json_encode($json_arr);
		$data = base64_encode($json_string);
		$sign_string = $private_key.$data.$private_key;
		$signature = base64_encode(sha1($sign_string, 1));
		$results['data'] = $data;
		$results['signature'] = $signature;
		echo json_encode($results);
	}
	// POST reserv
	else if (isset($_POST['reserv-submit'])) {
		require '../connect.php';

		$tickets = $_POST['tickets'];
		$ids_str = '';

	    $sql = 'SELECT * FROM trips WHERE id = '.$_POST['trip_id'];
	    $query = $db->query($sql);
    	$trip = $query->fetch(PDO::FETCH_ASSOC);

 		foreach ($tickets as $ticket):
			$passenger_id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;
			$name1 = isset($ticket['firstName']) ? $ticket['firstName'] : null;
        	$name2 = isset($ticket['lastName']) ? $ticket['lastName'] : null;
        	$email = isset($_POST['email']) ? $_POST['email'] : null;
        	$phone = isset($ticket['phone']) ? $ticket['phone'] : null;
        	$trip_id = isset($_POST['trip_id']) ? $_POST['trip_id'] : 0;
        	$loc_from_id = isset($_POST['from']) ? $_POST['from'] : 0;
        	$loc_to_id = isset($_POST['to']) ? $_POST['to'] : 0;
        	$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        	$nbr = substr(str_shuffle($permitted_chars), 0, 10);
        	$date_departure = isset($_POST['date']) ? date('Y-m-d H:i:s', $_POST['date']) : null;
        	$seat = isset($ticket['id']) ? $ticket['id'] : 0;
        	$cost = isset($ticket['discountPrice']) ? $ticket['discountPrice'] : 0;
        	$status = 1;
        	$carrier_id = $trip['carrier_id'];
        	$date_reserv_start = date('Y-m-d H:i:s');
        	$date_reserv_end = date("Y-m-d H:i:s", strtotime($date_reserv_start . " +12 hours"));

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
        		`date_departure` = :date_departure,
        		`seat` = :seat,
        		`cost` = :cost,
        		`status` = :status,
        		`date_reserv_start`	= :date_reserv_start, 
        		`date_reserv_end`	= :date_reserv_end,
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
	        $query->bindParam(":date_departure", $date_departure);
	        $query->bindParam(":seat", $seat);
	        $query->bindParam(":cost", $cost);
	        $query->bindParam(":status", $status);
	        $query->bindParam(":date_reserv_start", $date_reserv_start);
			$query->bindParam(":date_reserv_end", $date_reserv_end);
			$query->bindParam(":carrier_id", $carrier_id);
	        $query->execute();
	        $insert_id = $db->lastInsertId();
	        $ids_str .= $insert_id.'-';
	    endforeach;
	    $ids_str = substr($ids_str, 0, -1);

	    if ($is_local)
	    	$pay_url = 'http://localhost/turtrans/pay-tickets.php?ids='.$ids_str;
	    else
	    	$pay_url = 'http://turtrans-r.com/pay-tickets.php?ids='.$ids_str;	    
	
		$from = 'admin@turtrans.com';
		$from_name = 'Turtrans';
		$subject = 'Turtrans - Бронювання квитків'; 
		$to = $_POST['email'];
		$html_content = '<h1>Вами були заброньовані квитки</h1><br>
			Оплатити квитки ви можете за адресою: <a href="'.$pay_url.'">Ссилка</a>';
		$send_email = multi_attach_mail($to, $subject, $html_content, $from, $from_name, array());
		$url = (isset($_SESSION['user']['id'])) ? 'profile.php' : 'not_registered_user.php?ids='.$ids_str;
		echo $url;
	} 
	// LOAD page
	else if (isset($_GET['id'])) {
	    $sql = 'SELECT * FROM trips WHERE id = '.$_GET['id'];
	    $query = $db->query($sql);
		$trip = $query->fetch(PDO::FETCH_ASSOC);
		$blocked_seats = array();
		if (!empty($trip['blocked_seats'])) {
			$blocked_seats = explode(',', $trip['blocked_seats']);
		}

	    $sql = 'SELECT * FROM locations WHERE id = '.$_GET['from'];
	    $query = $db->query($sql);
		$row = $query->fetch(PDO::FETCH_ASSOC);
		$from = $row['city'];

	    $sql = 'SELECT city FROM locations WHERE id = '.$_GET['to'];
	    $query = $db->query($sql);
		$row = $query->fetch(PDO::FETCH_ASSOC);
		$to = $row['city'];

        // get trip reserv seats
        $sql = 'SELECT * FROM trips_seats_reserv WHERE `date` = "'.date('Y-m-d', strtotime($_GET['date'])).'" AND trip_id = '.$_GET['id'];
        $query = $db->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $reserv_seats = array();
        if (!empty($row['seats'])) {
        	$reserv_seats = explode(',', $row['seats']);
        } 

        // get trip buyed seats
        $buyed_seats = array();
        $date = date('Y-m-d', strtotime($_GET['date']));
        $sql = 'SELECT * FROM tickets WHERE DATE(date_departure) = "'.$date.'" AND trip_id = '.$_GET['id'];
        $query = $db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$buyed_seats[] = $row['seat'];
        }

        $disabled_seats = array_merge($blocked_seats, $reserv_seats, $buyed_seats);

        // get discounts
        $sql = 'SELECT trips_discounts.*, 
        	(SELECT discounts.id FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_id,
        	(SELECT discounts.type FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_type,
            (SELECT discounts.name FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_name,
            (SELECT discounts.sign FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_sign,
			(SELECT discounts.discount FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_discount,
			(SELECT discounts.price FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_price,
			(SELECT discounts.promo_price FROM discounts WHERE trips_discounts.discount_id = discounts.id) as discount_promo_price
            FROM trips_discounts
            LEFT JOIN discounts ON (trips_discounts.discount_id = discounts.id)
            WHERE discounts.sign = 0 AND discounts.type = 1 AND trips_discounts.trip_id = '.$_GET['id'];
        $query = $db->query($sql);
        $discounts = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        	$name = $row['discount_type'] == 1 ? $row['discount_name'].' '.$row['discount_discount'].'%' : $row['discount_name'];
            $discounts[] = array('id' => $row['discount_discount'], 'name' => $name); 
        }

		$date = date('d.m.Y', strtotime($_GET['date']));
		$price = $_GET['price'];
	} else {
		header('location: 404.php');
	}



	function multi_attach_mail($to, $subject, $message, $senderMail, $senderName, $files){
	    $from = $senderName." <".$senderMail.">"; 
	    $headers = "From: $from";

	    // boundary 
	    $semi_rand = md5(time()); 
	    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

	    // headers for attachment 
	    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

	    // multipart boundary 
	    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
	    "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 

	    // preparing attachments
	    if(count($files) > 0){
	        for($i = 0; $i < count($files); $i++){
	            if(is_file($files[$i])){
	                $message .= "--{$mime_boundary}\n";
	                $fp =    @fopen($files[$i],"rb");
	                $data =  @fread($fp,filesize($files[$i]));

	                @fclose($fp);
	                $data = chunk_split(base64_encode($data));
	                $message .= "Content-Type: application/octet-stream; name=\"".basename($files[$i])."\"\n" . 
	                "Content-Description: ".basename($files[$i])."\n" .
	                "Content-Disposition: attachment;\n" . " filename=\"".basename($files[$i])."\"; size=".filesize($files[$i]).";\n" . 
	                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
	            }
	        }
	    }

	    $message .= "--{$mime_boundary}--";
	    $returnpath = "-f" . $senderMail;

	    //send email
	    $mail = @mail($to, $subject, $message, $headers, $returnpath); 

	    //function return true, if email sent, otherwise return fasle
	    if($mail){ return TRUE; } else { return FALSE; }
	}    

?>