<?php
    require 'connect.php';
    require 'controllers/forgot-password.php';
    if (!empty($_POST)) {
    	exit();
    }	
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Відновлення паролю</title>
	<link href="assets/plugins/css/plugins.css" rel="stylesheet">
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/responsiveness.css" rel="stylesheet">
	<link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="theme-bg log-screen">

	<section class="log-wrapper">
		<div class="container">
			<div class="col-md-6 col-md-push-6">
				<h3 class="log-title">Відновлення паролю</h3>
				<p class="restoration-info">Введіть всій адрес електронної пошти, на яку буде надіслано новий пароль</p>
				<form class="form" method="post">
					<div class="form-group">
						<div class="row">						
							<div class="col-md-6 col-sm-6">								
								<input type="email" name="email" class="form-control" placeholder="Email" required>
							</div>		
							<div class="col-md-6 col-sm-6">
								<button type="submit" class="btn btn-dark btn-dark-restoration">Отримати пароль</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>

	<!-- =================== START JAVASCRIPT ================== -->
	<script src="assets/plugins/js/jquery.min.js"></script>
	<script src="assets/plugins/js/bootstrap.min.js"></script>
	<script src="assets/plugins/js/viewportchecker.js"></script>
	<script src="assets/plugins/js/bootsnav.js"></script>
	<script src="assets/plugins/js/slick.min.js"></script>
	<script src="assets/plugins/js/jquery.nice-select.min.js"></script>
	<script src="assets/plugins/js/jquery.fancybox.min.js"></script>
	<script src="assets/plugins/js/jquery.downCount.js"></script>
	<script src="assets/plugins/js/freshslider.1.0.0.js"></script>
	<script src="assets/plugins/js/moment.min.js"></script>
	<script src="assets/plugins/js/daterangepicker.js"></script>
	<script src="assets/plugins/js/wysihtml5-0.3.0.js"></script>
	<script src="assets/plugins/js/bootstrap-wysihtml5.js"></script>

	<!-- Dashboard Js -->
	<script src="assets/plugins/js/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/js/jquery.metisMenu.js"></script>
	<script src="assets/plugins/js/jquery.easing.min.js"></script>

</body>

</html>