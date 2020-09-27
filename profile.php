<?php
    require 'connect.php';
    require 'controllers/profile.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Tour & Travel Bootstrap Template | Themez Hub</title>

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
	<section class="dashboard gray-bg padd-0 mrg-top-50">
		<div class="container-fluid">
			<div class="row">
				<?php require 'sidebar.php'; ?>

				<!-- All Item -->
				<div class="col-lg-10 col-md-10 col-sm-9 col-lg-push-2 col-md-push-2 col-sm-push-3">

					<div class="row mrg-0 mrg-top-20">
						<div class="tr-single-box single-box-profile">
							<div class="tr-single-header">
								<h3 class="dashboard-title">Статистика поїздок</h3>
							</div>
							<div class="tr-single-body">

								<!-- row -->
								<div class="row">
									<div class="col-md-3 col-sm-6">
										<div class="widget simple-widget">
											<div class="rwidget-caption info">
												<div class="row">
													<div class="col-xs-4 padd-r-0">
														<i class="cl-info icon ti-briefcase"></i>
													</div>
													<div class="col-xs-8">
														<div class="widget-detail">
															<h3><?=$trips_all;?></h3>
															<span>Кількість поїздок</span>
														</div>
													</div>
													<div class="col-xs-12">
														<div class="widget-line">
															<span style="width:80%;"
																class="bg-info widget-horigental-line"></span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-3 col-sm-6">
										<div class="widget simple-widget">
											<div class="widget-caption danger">
												<div class="row">
													<div class="col-xs-4 padd-r-0">
														<i class="cl-danger icon ti-shopping-cart-full"></i>
													</div>
													<div class="col-xs-8">
														<div class="widget-detail">
															<h3><?=$trips_bonus;?></h3>
															<span>Кількість бонусних поїздок</span>
														</div>
													</div>
													<div class="col-xs-12">
														<div class="widget-line">
															<span style="width:50%;"
																class="bg-danger widget-horigental-line"></span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-3 col-sm-6">
										<div class="widget simple-widget">
											<div class="widget-caption warning">
												<div class="row">
													<div class="col-xs-4 padd-r-0">
														<i class="cl-success icon fa fa-bus"></i>
													</div>
													<div class="col-xs-8">
														<div class="widget-detail">
															<h3><?=$trips_payed;?></h3>
															<span>Кількість оплачених поїздок</span>
														</div>
													</div>
													<div class="col-xs-12">
														<div class="widget-line">
															<span style="width:60%;"
																class="bg-success widget-horigental-line"></span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-3 col-sm-6">
										<div class="widget simple-widget">
											<div class="widget-caption purple">
												<div class="row">
													<div class="col-xs-4 padd-r-0">
														<i class="cl-purple icon ti-lock"></i>
													</div>
													<div class="col-xs-8">
														<div class="widget-detail">
															<h3><?=$trips_reserved;?></h3>
															<span>Заброньовані</span>
														</div>
													</div>
													<div class="col-xs-12">
														<div class="widget-line">
															<span style="width:40%;"
																class="bg-purple widget-horigental-line"></span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /row -->

								<!-- row -->
								<div class="row">

									<div class="col-md-12">
										<h3><?=$user['name1'].' '.$user['name2'].' '.$user['name3'];?></h3>
									</div>

									<div class="col-md-12">
										<dl class="dl-horizontal">
											<dt>Email:</dt>
											<dd><?=$user['email']?></dd>
											<dt>Номер телефону:</dt>
											<dd><?=$user['phone']?></dd>
											<dt>Місто/Село:</dt>
											<dd><?=$user['city']?></dd>
											<dt>Країна:</dt>
											<dd><?=$user['country']?></dd>
										</dl>
									</div>


									<?php if(!empty($r_tickets)) { ?>
									<div class="col-12 col-md-12">
										<strong>Заброньовані квитки:</strong>
									</div>
									<hr>

									<div class="col-lg-12 col-md-12 col-sm-12 wrapper-booked-tickets">
										<div class="table-responsive">
											<table class="table table-striped table-bordered">
												<thead>
													<tr>
														<th></th>
														<th>Номер бронювання:</th>
														<th>Дата виїзду</th>
														<th>Місто відправки</th>
														<th>Прибуття</th>
														<th>Номер місця</th>
														<th>Вартість</th>
														<th>Прізвище</th>
														<th>І'мя</th>
														<th>Закінчення бронювання</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($r_tickets as $ticket): ?>	
													<tr>
														<td><input type="checkbox" class="input-booked" id="<?=$ticket['id'];?>"></td>
														<td><?=$ticket['number'];?></td>
														<td><?=$ticket['date_departure'];?></td>
														<td><?=$ticket['loc_from_name'];?></td>
														<td><?=$ticket['loc_to_name'];?></td>
														<td><?=$ticket['seat'];?></td>
														<td><?=$ticket['cost'];?> грн.</td>
														<td><?=$ticket['name2'];?></td>
														<td><?=$ticket['name1'];?></td>
														<td class="end-of-booking">
															<?=$ticket['time_left'];?>
														</td>
													</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
										</div>

										<div class="tickets-to-buy">										
											<p class="error" style="display: none; color: #f00;">Не вибрано жодного квитка</p>
											<button type="submit" class="btn btn-m theme-btn pay-submit buy-a-ticket">Оплатити</button>
										</div>
									</div>
									<?php } ?>

									<div class="col-12 col-md-12">
										<strong>Статистика поїздок (активні, завершені, скасовані):</strong>
									</div>
									<hr>

									<div class="col-lg-12 col-md-12 col-sm-12">
										<div class="table-responsive">
											<table class="table table-striped table-bordered">
												<thead>
													<tr>
														<th>Номер квитка</th>
														<th>І'мя</th>
														<th>Прізвище</th>
														<th>Phone</th>
														<th>Email</th>
														<th>Дата виїзду</th>
														<th>Місто відправки</th>
														<th>Прибуття</th>
														<th>Номер місця</th>
														<th>Вартість</th>
														<th>Статус поїздки</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($tickets as $ticket): ?>	
													<tr>
														<td><?=$ticket['number'];?></td>
														<td><?=$ticket['name1'];?></td>
														<td><?=$ticket['name2'];?></td>
														<td><?=$ticket['phone'];?></td>
														<td><?=$ticket['email'];?></td>
														<td><?=$ticket['date_departure'];?></td>
														<td><?=$ticket['loc_from_name'];?></td>
														<td><?=$ticket['loc_to_name'];?></td>
														<td><?=$ticket['seat'];?></td>
														<td><?=$ticket['cost'];?> грн.</td>
														<td><?=$ticket['status'];?></td>
													</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
										</div>
									</div>

									<div class="col-lg-12 col-md-12 col-sm-12">
										<hr>
										<h4>Загальна вартість : <?=$total;?> грн. </h4>
										<hr>
										<div>
											<h4>Інформація про вхід в систему</h4>
											<dl class="dl-horizontal dl-system">
												<dt>IP-адреса:</dt>
												<dd><?=$user['ip']?></dd>
												<dt>Останній вхід:</dt>
												<dd><?=$user['last_login']?></dd>
												<dt>Останній вихід</dt>
												<dd><?=$user['last_logout']?></dd>
											</dl>
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
		$(document).on("click", ".pay-submit", function () {
			var count = $('input:checkbox:checked').length;
			if (count == 0) {
				$('.error').css({ "display": "block" })
				$('input[type=checkbox]').css({ "box-shadow": "0 0 5px 2px red" })
			}

			$(document).on("click", "input:checkbox", function () {
				$('.error').css({ "display": "none" })
				$('input[type=checkbox]').css({ "box-shadow": "none" })

			});

			var orderSeats = [];
			var ids_str = '';
			$(".input-booked:checked").each(function () {
				orderSeats.push(this.id); 
				ids_str += this.id+'-';
			});
			if (orderSeats.length !== 0) {
				console.log("Кінцеве замовлення:", orderSeats);
				var ids_str1 = ids_str.slice(0, -1);
				var pay_url = '<?=$pay_url;?>'+ids_str1;
				window.location.replace(pay_url);
			}
		});

	</script>

</body>

</html>