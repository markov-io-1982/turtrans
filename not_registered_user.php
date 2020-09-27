<?php
    require 'connect.php';
    require 'controllers/not_registered_user.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Бронювання</title>

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

	<!-- ======================= Start Profile ===================== -->
	<section class="dashboard gray-bg main-content">
		<div class="container-fluid">
			<div class="row">

				<!-- All Item -->
				<div class="col-md-12">

					<div class="row mrg-0 mrg-top-20">
						<div class="tr-single-box single-box-profile">
							<div class="tr-single-header">
								<h3 class="dashboard-title">Бронювання</h3>
							</div>
							<div class="tr-single-body">

								<!-- row -->
								<div class="row">
									<!--<div class="col-md-12">
										<h3>Анастасія Теодорівна Січенко</h3>
									</div>-->

									<div class="col-md-12">
										<dl class="dl-horizontal">
											<dt>Дата виїзду:</dt>
											<dd><?=$data['date'];?></dd>
											<dt>Час виїзду:</dt>
											<dd><?=$data['time_from'];?></dd>
											<dt>Час прибуття:</dt>
											<dd><?=$data['time_to'];?></dd>
											<dt>Місто відправки:</dt>
											<dd><?=$data['loc_from'];?></dd>
											<dt>Місто прибуття:</dt>
											<dd><?=$data['loc_to'];?></dd>
											<dt>Email:</dt>
											<dd><?=$data['email'];?></dd>
										</dl>
									</div>

									<div class="col-12 col-md-12">
										<strong>Заброньовані квитки:</strong>
									</div>
									<hr>

									<div class="col-lg-12 col-md-12 col-sm-12 wrapper-booked-tickets">
										<div class="table-responsive">
											<table class="table table-striped table-bordered">
												<thead>
													<tr>
														<th>Номер бронювання:</th>
														<th>Номер місця</th>
														<th>Вартість</th>
														<th>Прізвище</th>
														<th>І'мя</th>
														<th>Телефон</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($data['tickets'] as $ticket): ?>
													<tr>
														<td><?=$ticket['number'];?></td>
														<td><?=$ticket['seat'];?></td>
														<td><?=$ticket['cost'];?> грн.</td>
														<td><?=$ticket['name1'];?></td>
														<td><?=$ticket['name2'];?></td>
														<td><?=$ticket['phone'];?></td>
													</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
										</div>
										<hr>
										<span class="booking-not-user">Час бронювання закінчується через<span
												id="end-of-booking-not-user"></span></span>
										<hr>
										<h4>Загальна вартість : <?=$data['amount']?> грн. </h4>
										<hr>
										<div class="tickets-to-buy">
											<a href="<?=$pay_url;?>">
											<button type="submit" class="btn btn-m theme-btn pay-submit buy-a-ticket">Оплатити</button>
											</a>
											<div class="text-register">Щоб бачити всі свої поїздки, куплені та
												заброньовані квитки, <a class="text-register"
													href="signup.php">зареєструйтесь!</a></div>
										</div>
									</div>

								</div>
								<!-- /row -->

							</div>
						</div>
					</div>


				</div>

			</div>
		</div>
	</section>
	<!-- ======================= End Profile ===================== -->

	<?php require 'footer.php'; ?>

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

	<script>
		var countDownDate = new Date("<?=$data['reserv_end'];?>").getTime();

		var x = setInterval(function () {

			var now = new Date().getTime();
			var distance = countDownDate - now;

			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);

			document.getElementById("end-of-booking-not-user").innerHTML = days + "д. " + hours + "г. "
				+ minutes + "х. " + seconds + "с. ";

			if (distance < 0) {
				clearInterval(x);
				document.getElementById("end-of-booking-not-user").innerHTML = "Термін вийшов";
			}
		}, 1000);
	</script>

</body>

</html>