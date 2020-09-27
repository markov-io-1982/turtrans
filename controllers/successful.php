<?php
	require('fpdf.php');

	// http://localhost/turtrans/successful.php?ids=19-20
	if (isset($_GET['ids'])) {
		$tickets_ids = explode('-', $_GET['ids']);
		$data = array();

		foreach ($tickets_ids as $ticket_id):
		    $sql = 'SELECT tickets.*, 
		        (SELECT locations.city FROM locations WHERE tickets.loc_from_id = locations.id) as loc_from_name,
		        (SELECT locations.city FROM locations WHERE tickets.loc_to_id = locations.id) as loc_to_name,
		        (SELECT trips_stops.end_time FROM trips_stops WHERE tickets.trip_id = trips_stops.trip_id AND tickets.loc_from_id = trips_stops.loc_id) as time_from,
		        (SELECT trips_stops.start_time FROM trips_stops WHERE tickets.trip_id = trips_stops.trip_id AND tickets.loc_to_id = trips_stops.loc_id) as time_to
		        FROM tickets 
		        LEFT JOIN locations ON (tickets.loc_from_id = locations.id AND tickets.loc_to_id = locations.id)
		        WHERE tickets.id = '.$ticket_id;
		    $query = $db->query($sql);
		    $row = $query->fetch(PDO::FETCH_ASSOC);
			
			$record = array(
				'number' => $row['number'],
				'cost' => $row['cost'],
				'email' => $row['email'],
				'fullname' => $row['name1'].' '.$row['name2'],
				'seat' => $row['seat'],
				'loc_from' => $row['loc_from_name'],
				'loc_to' => $row['loc_to_name'],
				'date_from' => date('d-m-Y', strtotime($row['date_departure'])),
				'time_from' => date('H:i', strtotime($row['time_from'])),
				'date_to' => date('d-m-Y', strtotime($row['date_departure'])),
				'time_to' => date('H:i', strtotime($row['time_to']))
			);
			$data[] = $record;
		endforeach;	

		//echo "<pre>";
		//print_r($data);
		//echo "</pre>";

		$filename = __DIR__.'/../photo/tickets/ticket_template.jpg';

		$files = array();
		foreach ($data as $ticket) {
			$newfilename = __DIR__.'/../photo/tickets/ticket_'.$ticket['seat'].'.jpg';
			$pdffilename = __DIR__.'/../photo/tickets/ticket_'.$ticket['seat'].'.pdf';
			$img = ImageCreateFromJPEG($filename);
	 		$color = imagecolorallocate($img, 0, 0, 0);
			$font = __DIR__.'/../photo/tickets/arial.ttf';

			$text = $ticket['fullname'];
			imagettftext($img, 40, 0, 140, 410, $color, $font, $text);
			imagettftext($img, 32, 0, 1750, 90, $color, $font, $text);
			imagettftext($img, 32, 0, 1120, 395, $color, $font, 'Повний');
	 
			$text = $ticket['number'];
			imagettftext($img, 32, 0, 1320, 600, $color, $font, $text);
			imagettftext($img, 32, 0, 1750, 600, $color, $font, $text);

			$text = $ticket['seat'];
			imagettftext($img, 70, 0, 1115, 635, $color, $font, $text);
			imagettftext($img, 70, 0, 2115, 635, $color, $font, $text);

			$text = $ticket['loc_from'];
			imagettftext($img, 32, 0, 140, 600, $color, $font, $text);
			imagettftext($img, 28, 0, 1750, 210, $color, $font, $text);

			$text = $ticket['loc_to'];
			imagettftext($img, 32, 0, 140, 730, $color, $font, $text);
			imagettftext($img, 28, 0, 2110, 210, $color, $font, $text);

			$text = $ticket['date_from'];
			imagettftext($img, 32, 0, 560, 605, $color, $font, $text);
			imagettftext($img, 32, 0, 1750, 340, $color, $font, $text);

			$text = $ticket['date_to'];
			imagettftext($img, 32, 0, 560, 705, $color, $font, $text);
			imagettftext($img, 32, 0, 2110, 340, $color, $font, $text);


			$text = $ticket['time_from'];
			imagettftext($img, 32, 0, 890, 605, $color, $font, $text);
			imagettftext($img, 32, 0, 1810, 475, $color, $font, $text);

			$text = $ticket['time_to'];
			imagettftext($img, 32, 0, 890, 705, $color, $font, $text);
			imagettftext($img, 32, 0, 2160, 475, $color, $font, $text);

			imagejpeg($img, $newfilename);

			$pdf = new FPDF();
			$pdf->AddPage();
			$pdf->Image($newfilename, 5, 5, 200, 100);
			$pdf->Output($pdffilename, 'F');
			$files[] = 'photo/tickets/ticket_'.$ticket['seat'].'.pdf';
		}

	    $sql = 'SELECT * FROM users WHERE position_id = 1';
	    $query = $db->query($sql);
	    $get_admin = $query->fetch(PDO::FETCH_ASSOC);
	    
	    //$sql = 'SELECT * FROM passengers WHERE id = '.$_SESSION['user']['id'];
	    //$query = $db->query($sql);
	    //$get_buyer = $query->fetch(PDO::FETCH_ASSOC);
	    $get_buyer_fullname = $record['fullname'];
	    $get_buyer_email = $record['email'];

		$from = 'admin@turtrans.com';
		$from_name = 'Turtrans';
		$subject = 'Turtrans - Придбання квитків'; 

		$to = $get_admin['email'];
		$html_content = '<h1>Пасажир '.$get_buyer_fullname.' придбав квитки</h1>
		            <p><b>Прикріплені файли : </b>'.count($files).' файли</p>';
		$send_email = multi_attach_mail($to, $subject, $html_content, $from, $from_name, $files);

		$to = $get_buyer_email;
		$html_content = '<h1>Вами були куплені квитки</h1>
		            <p><b>Прикріплені файли : </b>'.count($files).' файли</p>';
		$send_email = multi_attach_mail($to, $subject, $html_content, $from, $from_name, $files);

		foreach ($data as $ticket) {
			$body = "Купівля квитка: ".$ticket['loc_from']."-".$ticket['loc_to'];
			$created = date('Y-m-d H:i:s');
			$status = 0;
	        $sql = 'INSERT `notifications` SET 
	            `user_id` = :user_id,
	            `body` = :body,
	            `created` = :created,
	            `status` = :status
	        ';
	        $query = $db->prepare($sql);
	        $query->bindParam(":user_id", $get_admin['id']);
	        $query->bindParam(":body", $body);
	        $query->bindParam(":created", $created);
	        $query->bindParam(":status", $status);
	        $query->execute();
		}
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