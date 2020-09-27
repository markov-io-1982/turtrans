<?php
    require 'connect.php';
    require 'controllers/news_one.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Назва новини</title>
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

	<section class="gray-bg main-content gray-bg-news">
		<div class="container">
			<div class="row">

				<!-- Main News Start -->
				<div class="col-md-8 col-sm-8">
					<div class="row">
						<div class="tr-single-box main-news-wrapper">
							<div class="tr-single-body">

								<div>
									<img src="photo/news/<?=$news_one['photo'];?>" class="img-responsive" alt="">
									<span><i class="ti-time padd-r-5"></i><?=date('d.m.Y H:i', strtotime($news_one['created']));?></span>
									<h4><?=$news_one['name'];?></h4>
									<?=$news_one['description'];?>
								</div>

							</div>
						</div>
					</div>

				</div>

				<!-- Right News Start -->
				<div class="col-md-4 col-sm-4">
					<div class="tr-single-box">
						<div class="tr-single-header">
							<h4><i class="ti-write"></i><a href="news.html">Всі новини</a></h4>
						</div>
						<div class="tr-single-body right-news-wrapper">
							<?php foreach ($news as $news_one): ?>        	
								<div class="review-box">
									<div class="review-thumb">
										<img src="photo/news/<?=$news_one['photo'];?>" class="img-responsive img-circle" alt="" />
									</div>
									<div class="review-box-content">
										<div class="review-user-info">
											<h4><a href="news_one.php?id=<?=$news_one['id'];?>"><?=$news_one['name'];?></a></h4>

											<span><i class="ti-time padd-r-5"></i><?=date('d.m.Y H:i', strtotime($news_one['created']));?></span>
										</div>
									</div>
								</div>
							<?php endforeach; ?>   

						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

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

	<script src="assets/js/main.js"></script>

	<script>
		$(".collapse-button").collapse('hide')
		$("button[data-toggle=collapse]").click(function () {
			$(this).find('span:first').toggleClass('glyphicon-chevron-down glyphicon-chevron-up')
		});
	</script>


	<script>

	</script>


</body>

</html>