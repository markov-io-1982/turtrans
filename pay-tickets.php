<?php 
    require 'connect.php';

	$private_key = 'sandbox_dQjdlQvA8h1H22Z691DdGp79REzW1ZeR64eZxmjF';
	$public_key = 'sandbox_i72245637255'; 

	if ($is_local)			
		$callback_url = 'http://localhost/turtrans/callback2.php';
	else
		$callback_url = 'http://turtrans-r.com/callback2.php';

	if (isset($_GET['ids'])) {
		$results = array();
		$dae_arr = array();
		$amount = 0; 
	    $ids = explode("-", $_GET['ids']);
	    foreach ($ids as $id) {
		    $sql = 'SELECT * FROM tickets WHERE id = '.$id;
		    $query = $db->query($sql);
		    $row = $query->fetch(PDO::FETCH_ASSOC); 
			$amount += $row['cost'];
			$dae_arr[] = $id;
	    }
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
	} else {
		header('location: 404.php');
	}
	// localhost/turtrans/pay-tickets.php?ids=30-31
?>

<html>
	<body>
		<script src="assets/plugins/js/jquery.min.js"></script>		
		<script>
			$(document).ready(function () {
				$("#liqpay-data").val('<?=$data;?>');
				$("#liqpay-signature").val('<?=$signature;?>');
				$("#liqpay-form").submit();
			});
		</script>
	</body>
	<form method="POST" id="liqpay-form" action="https://www.liqpay.ua/api/3/checkout" accept-charset="utf-8">
		<input type="hidden" id="liqpay-data" name="data" value=""/>
	 	<input type="hidden" id="liqpay-signature" name="signature" value=""/>
	</form> 
</html>