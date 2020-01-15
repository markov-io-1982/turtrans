<?php
    require 'connect.php';
    require 'controllers/signup.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Реєстрація</title>
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
				<h3 class="log-title">Реєстрація</h3>
				<form data-validate="parsley" method="post">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<label for="name1">Прізвище *</label>
								<input type="text" name="name1" class="form-control parsley-validated" data-error-message="Прізвище є обов'язковим" data-required="true">
							</div>
							<div class="col-md-6 col-sm-6">
								<label for="name2">І'мя *</label>
								<input type="text" name="name2" class="form-control parsley-validated" data-error-message="І'мя є обов'язковим" data-required="true">
							</div>
							<div class="col-md-6 col-sm-6">
								<label for="phone">Номер телефону *</label>
								<input type="text" name="phone" class="form-control parsley-validated" data-error-message="Номер телефону є обов'язковим" data-required="false">
							</div>
							<div class="col-md-6 col-sm-6">
								<label for="email">Електронна пошта</label>
								<input type="text" name="email" class="form-control parsley-validated">
							</div>
							<div class="col-md-12 col-sm-12">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<label for="pass">Пароль *</label>
										<input type="password" name="pass" data-error-message="Пароль є обов'язковим" class="form-control parsley-validated" 
										placeholder="*******" data-required="true">
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="wp-personal-data">
											<input type="checkbox" name="check" id="check" value="check" data-required="true"
												data-error-message="Ви повинні погодитися з політикою сайту."
												class="parsley-validated">
											<label for="check">Я приймаю <a href="personal-data.html"
													class="btn-signup red-btn" target="_blank">
													умови обробки персональних даних
												</a>
											</label>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="form-group wp-signup-submit">
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<button type="submit" class="btn btn-dark group-btn-dark">Зареєструватись</button>
							</div>
							<div class="col-md-6 col-sm-6">
								<p>Маєте обліковий запис? <a href="login.php" class="btn-signup red-btn">Вхід тут</a>
								</p>
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

	<script src="assets/plugins/js/contactform.js"></script>
	<script src="assets/plugins/js/parsley.min.js"></script>

</body>

</html>