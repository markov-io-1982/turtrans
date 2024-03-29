<?php
    require 'connect.php';
    require 'controllers/search.php';

    //echo "<pre>";
    //print_r($trips);
    //echo "</pre>";
    //exit();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Оформлення квитка</title>
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

	<!-- ======================= Start Page Title ===================== -->
	<div class="page-title image-title mini-banner-others-page-search"
		style="background-image:url(assets/img/mini-background-image.jpg);">
		<div class="container">
			<div class="wp-search-multi-option-booking">
				<form class="form-search-trips" method="post" action="search.php">
					<fieldset class="home-form-1">
						<div class="col-md-3 col-sm-3 padd-0">
							<div class="sl-box">
								<select class="wide form-control br-1 form-control-where" name="loc_from">
									<option data-display="Звідки" value="0">Звідки</option>
									<?php foreach ($locations as $location): ?>
										<option <?=($loc_from==$location['id'])?'selected':''?> value="<?=$location['id']?>"><?=$location['city']?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-md-3 col-sm-3 padd-0">
							<div class="sl-box">
								<select class="wide form-control br-1" name="loc_to">
									<option data-display="Куди" value="0">Куди</option>
									<?php foreach ($locations as $location): ?>
										<option <?=($loc_to==$location['id'])?'selected':''?> value="<?=$location['id']?>"><?=$location['city']?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-md-3 col-sm-3 padd-0">
							<input type="text" name="date" id="book-date" class="form-control br-1" value="<?=$date;?>">
						</div>

						<div class="col-md-3 col-sm-3 padd-0">
							<button type="submit" class="btn theme-btn cl-white seub-btn">ЗНАЙТИ</button>
						</div>

					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<!-- ======================= End Page Title ===================== -->

	<!-- ======================= Start search ===================== -->
	<section class="gray-bg wp-search-gray-bg main-content">
		<div class="container">
			<?php if (count($trips) > 0) { ?>
			<div class="tr-single-body">
				<div class="row">
					<div class="col-md-12">

						<?php 
							foreach ($trips as $trip): 
								$first_index = 0;
								$last_index = count($trip['route']) - 1;
							?>
							<div class="pay-integration wp-block-search">
								<div class="row">
									<div class="col-sm-5">
										<div class="icon-box-icon-block">
											<div class="icon-box-round micro-timeline">
												<!-- ======================= Start Timeline ===================== -->
												<ul class="timeline timeline-centered">
													<li class="timeline-item ">
														<div class="timeline-marker intermediate-points"></div>
													</li>
													<li class="timeline-item">
														<div class="timeline-marker last-stop"></div>
													</li>
												</ul>
												<!-- ======================= End Timeline ===================== -->
											</div>
											<div class="icon-box-text first-block">
												<span class="departure-time"><?=date('H:i', strtotime($trip['route'][$first_index]['time']));?></span>
												<span class="departure-date"><?=$_POST['date'];?></span>
												<span class="flight-info city"><?=$trip['route'][$first_index]['loc_name'];?></span>
												<span class="flight-info address"><?=$trip['route'][$first_index]['stop_name'];?></p>

												<span class="flight-info wp-flight-details-button">
													<button type="button" class="collapse-button" data-toggle="collapse"
														data-target="#demo<?=$trip['id'];?>">
														Деталі <span class="glyphicon glyphicon-chevron-down"></span>
													</button>
												</span>

											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="center-block">
											<span class="departure-time"><?=date('H:i', strtotime($trip['route'][$last_index]['time']));?></span>
											<span class="flight-info city"><?=$trip['route'][$last_index]['loc_name'];?></span>
											<span class="flight-info address"><?=$trip['route'][$last_index]['stop_name'];?></p>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="right-block">
											<div class="text-through"><?=$trip['price'];?> грн.</div>
											<div class="ticket-price"><?=$trip['price'];?> грн.</div>
											<div class="wp-details-buy">
												<div class="number-places">
													<span class="number-free-places"><?=$trip['bus_seats'];?> місць</span>
													<span class="flight-info wp-flight-details-button">
														<button type="button" class="collapse-button" data-toggle="collapse"
															data-target="#demo<?=$trip['id'];?>">
															Деталі <span class="glyphicon glyphicon-chevron-down"></span>
														</button>
													</span>
													<div>
														<?php 
															$link = 'checkout.php?id='.$trip['id'].'&from='.$trip['route'][$first_index]['loc_id'].'&to='.
															$trip['route'][$last_index]['loc_id'].'&date='.$date.'&price='.$trip['price'];
														?>
														<a href="<?=$link;?>" class="btn theme-btn buy-button">Купити</a>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>

								<div id="demo<?=$trip['id'];?>" class="panel-collapse collapse in wp-collapse-timeline">
									<div class="row">
										<div class="col-sm-6">
											<div class="wrapper-timeline">
												<!-- ======================= Start Timeline ===================== -->
												<ul class="timeline timeline-centered">
													
													<li class="timeline-item">
														<div class="timeline-info">
															<span><?=date('H:i', strtotime($trip['route'][$first_index]['time']));?></span>
														</div>
														<div class="timeline-marker"></div>
														<div class="timeline-content">
															<h5 class="timeline-title"><?=$trip['route'][$first_index]['loc_name'];?></h5>
															<p><?=$trip['route'][$first_index]['stop_name'];?></p>
														</div>
													</li>

													<?php for ($i = $first_index + 1; $i < $last_index; $i++) { ?>	
														<li class="timeline-item ">
															<div class="timeline-info">
																<span><?=date('H:i', strtotime($trip['route'][$i]['time']));?></span>
															</div>
															<div class="timeline-marker intermediate-points"></div>
															<div class="timeline-content">
																<h5 class="timeline-title"><?=$trip['route'][$i]['loc_name'];?></h5>
																<p><?=$trip['route'][$i]['stop_name'];?></p>
															</div>
														</li>
													<?php } ?>
													<li class="timeline-item">
														<div class="timeline-info">
															<span><?=date('H:i', strtotime($trip['route'][$last_index]['time']));?></span>
														</div>
														<div class="timeline-marker last-stop"></div>
														<div class="timeline-content">
															<h5 class="timeline-title"><?=$trip['route'][$last_index]['loc_name'];?></h5>
															<p><?=$trip['route'][$last_index]['stop_name'];?></p>
														</div>
													</li>

												</ul>
												<!-- ======================= End Timeline ===================== -->
												<div class="wp-detail">
													<span class="wp-travel">
														<span class="travel-time">Час в дорозі:</span><span
															class="time"><?=$trip['time'];?></span>
													</span>
													<span class="wp-bus-info">
														<span class="bus-info">Автобус:</span><span class="bus"><?=$trip['bus_name'];?></span>
													</span>
												</div>
											</div>

										</div>
										<div class="col-sm-6">
											<div class="additionally-panel-collapse">
												Додатково
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>	

					</div>
				</div>
			<?php } else { ?>
				<h2 class="text-center">За вказану дату квитків не знайдено</h2>
			<?php } ?>
			</div>

	</section>


	<!-- ======================= End search ===================== -->

	<?php require 'footer.php'; ?>

	<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

	<!-- =================== START JAVASCRIPT ================== -->
	<script src="assets/plugins/js/jquery.min.js"></script>
	<script src="assets/plugins/js/bootstrap.min.js"></script>
	<script src="assets/plugins/js/viewportchecker.js"></script>
	<!-- <script src="assets/plugins/js/bootsnav.js"></script> -->
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

	<script>
		var date = new Date();
		var currentMonth = date.getMonth();
		var currentDate = date.getDate();
		var currentYear = date.getFullYear();

		$('#book-date').daterangepicker({
			singleDatePicker: true,
			timePicker: false,
			startDate: moment(date),
			minDate: date,
			locale: {
				format: 'DD-MM-YYYY',
				"daysOfWeek": [
					"Нд",
					"Пн",
					"Вт",
					"Ср",
					"Чт",
					"Пт",
					"Сб"
				],
				"monthNames": [
					"Січень",
					"Лютий",
					"Березень",
					"Квітень",
					"Травень",
					"Червень",
					"Липень",
					"Серпень",
					"Вересень",
					"Жовтень",
					"Листопад",
					"Грудень"
				],
				"firstDay": 1
			}
		});
	</script>

	<script src="js/main.js"></script>

	<script>
		$(".collapse").collapse('hide')
		$("button[data-toggle=collapse]").click(function () {
			$(this).find('span:first').toggleClass('glyphicon-chevron-down glyphicon-chevron-up')
		});
	</script>

</body>

</html>