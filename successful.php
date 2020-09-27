<?php
    require 'connect.php';
    require 'controllers/successful.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Статус оплати</title>
	<meta name="description" content="Туртранс - міжнародні автобусні перевезення Україна - Польща." />

	<!-- Plugins CSS -->
	<link rel="stylesheet" href="assets/plugins/css/plugins.css">

	<!-- Custom style -->
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/responsiveness.css" rel="stylesheet">
	<link href="assets/css/skins/red.css" rel="stylesheet">
	<link href="assets/css/main.css" rel="stylesheet">

</head>

<body>
	<?php require 'header.php'; ?>

	<section>
		<div class="container">
			<div class="success-wrap text-center">
				<div class="success-text">
					<i class="ti-check cl-success font-80"></i>
					<h3>Оплата пройшла успішно</h3>

					<?php foreach ($data as $ticket): ?>	
						<ul>
							<li>Номер квитка:<span class="fl-right font-midium"><?=$ticket['number'];?></span></li>
							<li>Загальна сума:<span class="fl-right font-25 font-midium"><?=$ticket['cost'];?> грн.</span></li>

							<li>Квиток буде надіслано Вам на електронну адресу <span
									class="email-adress"><?=$ticket['email'];?></span></li>
						</ul>

						<div class="wp-ticket-image">
							<?php $img = 'photo/tickets/ticket_'.$ticket['seat'].'.jpg'; ?>
							<img id="profile-image" class="img-responsive" src="<?=$img;?>" alt="user image">
						</div>
						<?php $pdf_url = 'photo/tickets/ticket_'.$ticket['seat'].'.pdf'; ?>
						<a href="<?=$pdf_url;?>" download><button class="btn theme-btn"><i class="fa fa-download"></i> Завантажити квиток</button></a>

					<?php endforeach; ?>	
				</div>
			</div>
		</div>
	</section>

	<?php require 'footer.php'; ?>

	<!-- Sign Up Window Code -->
	<div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" id="myModalLabel1">
				<div class="modal-body">
					<div class="text-center"><img src="img/logo.png" class="img-responsive" alt=""></div>

					<!-- Panel -->
					<div class="tab-pane fade in show active" id="employer" role="tabpanel">
						<form>
							<div class="form-group">
								<label>Номер тел. або e-mail</label>
								<input type="text" class="form-control" placeholder="+38(000)123 45 67. або e-mail"
									required>
							</div>
							<div class="form-group">
								<label>Пароль</label>
								<input type="password" class="form-control" placeholder="*********" required>
							</div>
							<div class="form-group">
								<span class="custom-checkbox">
									<input type="checkbox" id="4">
									<label for="4"></label>Запам'ятати мене
								</span>
								<a href="forgot-password.html" title="Forget" class="fl-right">Забули пароль?</a>
							</div>
							<div class="form-group text-center">
								<button type="submit" class="btn theme-btn full-width btn-m">Вхід </button>
							</div>
						</form>
					</div>
					<!-- Panel -->

				</div>
			</div>
		</div>
	</div>
	<!-- End Sign Up Window -->

	<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

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

	<!-- Custom Js -->
	<script src="assets/js/custom.js"></script>

	<script src="assets/js/main.js"></script>

</body>

</html>