<?php
    require 'connect.php';
    require 'controllers/login.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Вхід</title>
	<link href="assets/css/skins/red.css" rel="stylesheet">
	<link href="assets/plugins/css/plugins.css" rel="stylesheet">
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/responsiveness.css" rel="stylesheet">
	<link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="theme-bg log-screen">

	<section class="log-wrapper">
		<div class="container">
			<div class="col-md-6 col-md-push-6">
				<h3 class="log-title">Вхід</h3>
				<form class="form" method="post">
					<div class="form-group">
						<label for="login">Номер тел. або e-mail</label>
						<input type="text" name="login" class="form-control" placeholder="+380951234567 або e-mail" required>
					</div>
					<div class="form-group">
						<label for="pass">Пароль</label>
						<input type="password" name="pass" class="form-control" placeholder="*******" required>
					</div>
					<div class="form-group wp-login-submit">
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<button type="submit" class="btn btn-dark group-btn-dark">Вхід</button>
							</div>
							<div class="col-md-6 col-sm-6">
								<p>Забули пароль? <a href="forgot-password.php">Натисніть тут</a></p>
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