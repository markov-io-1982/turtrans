<?php
    require 'connect.php';
    require 'controllers/search.php';
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

	<!-- ======================= Start search ===================== -->
	<section class="gray-bg wp-search-gray-bg">
		<div class="container">

			<div class="tr-single-body">
				<div class="row">
					<div class="col-md-12">

						<?php foreach ($trips as $trip): ?>
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
												<span class="departure-time"><?=date('H:i', strtotime($trip['start_time']));?></span>
												<span class="departure-date"><?=$_POST['date'];?></span>
												<span class="flight-info city"><?=$trip['loc_from_name'];?></span>
												<span class="flight-info address"><?=$trip['stop_from_name'];?></p>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="center-block">
											<span class="departure-time"><?=date('H:i', strtotime($trip['end_time']));?></span>
											<span class="flight-info city"><?=$trip['loc_to_name'];?></span>
											<span class="flight-info address"><?=$trip['stop_to_name'];?></p>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="right-block">
											<div class="text-through"><?=$trip['trip_price'];?> грн.</div>
											<div class="ticket-price"><?=$trip['trip_price'];?> грн.</div>
											<div class="wp-details-buy">
												<button type="button" class="collapse-button" data-toggle="collapse"
													data-target="#demo<?=$trip['id'];?>">
													Деталі <span class="glyphicon glyphicon-chevron-down"></span>
												</button>
												<div>
													<a href="#" class="btn theme-btn buy-button">Купити</a>
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
															<span><?=date('H:i', strtotime($trip['start_time']));?></span>
														</div>
														<div class="timeline-marker"></div>
														<div class="timeline-content">
															<h5 class="timeline-title"><?=$trip['loc_from_name'];?></h5>
															<p><?=$trip['stop_from_name'];?></p>
														</div>
													</li>

													<?php foreach($trip['stops'] as $stop): ?>	
														<li class="timeline-item ">
															<div class="timeline-info">
																<span><?=date('H:i', strtotime($stop['start_time']));?></span>
															</div>
															<div class="timeline-marker intermediate-points"></div>
															<div class="timeline-content">
																<h5 class="timeline-title"><?=$stop['loc_name'];?></h5>
																<p><?=$stop['stop_name'];?></p>
															</div>
														</li>
													<?php endforeach; ?>
													<li class="timeline-item">
														<div class="timeline-info">
															<span><?=date('H:i', strtotime($trip['end_time']));?></span>
														</div>
														<div class="timeline-marker last-stop"></div>
														<div class="timeline-content">
															<h5 class="timeline-title"><?=$trip['loc_to_name'];?></h5>
															<p><?=$trip['stop_to_name'];?></p>
														</div>
													</li>

												</ul>
												<!-- ======================= End Timeline ===================== -->
												<div class="wp-detail">
													<span class="wp-travel">
														<span class="travel-time">Час в дорозі:</span><span
															class="time">13:50</span>
													</span>
													<span class="wp-bus-info">
														<span class="bus-info">Автобус:</span><span class="bus"><?=$trip['bus_brand'].' '.$trip['bus_model'];?></span>
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
			</div>
	</section>


	<!-- ======================= End search ===================== -->

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

	<script>
		var date = new Date();
		var currentMonth = date.getMonth();
		var currentDate = date.getDate();
		var currentYear = date.getFullYear();
		$('#book-date').daterangepicker({
			"singleDatePicker": true,
			"timePicker": true,
			"startDate": moment(date),
			locale: {
				format: 'DD.MM.YYYY'
			}
		}, function (start, end, label) {
			console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
		});
	</script>

	<script src="js/main.js"></script>

	<script>
		$(".collapse").collapse()
		$("button[data-toggle=collapse]").click(function () {
			$(this).find('span:first').toggleClass('glyphicon-chevron-down glyphicon-chevron-up')
		});
	</script>

</body>

</html>