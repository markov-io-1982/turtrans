<?php
    require 'connect.php';
    require 'controllers/index.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Головна</title>
	<meta name="description" content="Туртранс - міжнародні автобусні перевезення Україна - Польща." />

	<!-- Plugins CSS -->
	<link rel="stylesheet" href="assets/plugins/css/plugins.css">

	<!-- Custom style -->
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/responsiveness.css" rel="stylesheet">
	<link href="assets/css/skins/red.css" rel="stylesheet">
	<link href="assets/css/main.css" rel="stylesheet">

	<link rel='stylesheet' href='https://daneden.github.io/animate.css/animate.min.css'>

</head>

<body class="index-page">
	<?php require 'header.php'; ?>

	<!-- ======================= Slide Multiple Booking Start Banner ===================== -->
	<section class="main-banner scroll-con-sec hero-section" data-scrollax-parent="true" id="sec1">
		<div class="slideshow-container">
			<div class="slideshow-item">
				<div class="bg" data-bg="assets/img/tt-slideshow-1.jpg"></div>
			</div>
			<div class="slideshow-item">
				<div class="bg" data-bg="assets/img/tt-slideshow-2.jpg"></div>
			</div>
			<div class="slideshow-item">
				<div class="bg" data-bg="assets/img/tt-slideshow-3.jpg"></div>
			</div>
		</div>
		<div class="overlay"></div>
		<div class="hero-section-wrap fl-wrap multi-option-booking">
			<div class="container">
				<div class="intro-item fl-wrap">

					<span class="nice-select wide  wp-mini-center">
						<span class="current">Телефони диспетчерів
						</span>
						<ul class="list">
							<li><a class="dropdown-itens" href="tel:+3806364544577">
									<img src="assets/img/Ukraine-Flag_16.png" class="img-flag-phones" alt="flag" />+38 (050)
									538-92-951</a>
							</li>
							<li><a class="dropdown-itens" href="tel:+3806364544577">
									<img src="assets/img/Ukraine-Flag_16.png" class="img-flag-phones" alt="flag" />+38 (063)
									645-44-577</a>
							</li>
							<li><a class="dropdown-itens" href="tel:+3805053892951">
									<img src="assets/img/Ukraine-Flag_16.png" class="img-flag-phones" alt="flag" />+38 (050)
									538-92-951</a>
							</li>
							<li><a class="dropdown-itens" href="tel:+48888947700">
									<img src="assets/img/Poland-Flag_16.png" class="img-flag-phones" alt="flag" />+48 (888)
									947-700</a>
							</li>
							<li><a class="dropdown-itens" href="tel:+48889134661">
									<img src="assets/img/Poland-Flag_16.png" class="img-flag-phones" alt="flag" />+48 (889)
									134-661</a>
							</li>
						</ul>
					</span>

					<span class="wp-left-dropdown-menu">
						<div class="dropdown">
							<a class="dropdown-itens" href="tel:+3805053892951">
								<img src="assets/img/Ukraine-Flag_16.png" class="img-flag-phones" alt="flag" />+38 (050)
								538-92-951 <i class="fa fa-angle-down"></i> </a>
							<div class="dropdown-content">
								<a class="dropdown-itens" href="tel:+3806364544577"><img src="assets/img/Ukraine-Flag_16.png"
										class="img-flag-phones" alt="flag" />+38 (063) 645-44-577</a>
								<a class="dropdown-itens" href="tel:+3809708836135"><img src="assets/img/Ukraine-Flag_16.png"
										class="img-flag-phones" alt="flag" />+38 (097) 088-36-135</a>
								<a class="dropdown-itens" href="tel:+3805012343997"><img src="assets/img/Ukraine-Flag_16.png"
										class="img-flag-phones" alt="flag" />+38 (050) 123-43-997</a>
							</div>
						</div>
					</span>

					<span class="wp-right-dropdown-menu">
						<div class="dropdown">
							<a class="dropdown-itens" href="tel:+48888947700">
								<img src="assets/img/Poland-Flag_16.png" class="img-flag-phones" alt="flag" />+48 (888)
								947-700<i class="fa fa-angle-down"></i> </a>
							<div class="dropdown-content">
								<a class="dropdown-itens" href="tel:+4(889134-661"><img src="assets/img/Poland-Flag_16.png"
										class="img-flag-phones" alt="flag" />+48 (889) 134-661</a>
							</div>
						</div>
					</span>

					<div class="caption text-center cl-white hero-text-center">
						<h2 class="wow slideInLeft" data-wow-delay="0.25s">Пошук автобусних рейсів</h2>
						<div class="wow pulse animated" data-wow-delay="300ms" data-wow-iteration="infinite" data-wow-duration="2s">
							<p>Якісні перевезення кожного дня</p>
						</div>
					</div>

					<form method="post" action="search.php" class="wow bounceInUp form-search-trips" data-wow-delay="1.2s">
						<fieldset class="home-form-1">

							<div class="col-md-3 col-sm-3 padd-0">
								<div class="sl-box">
									<select class="wide form-control br-1 form-control-where" name="loc_from">
										<option data-display="Звідки" value="0">Звідки</option>
										<?php foreach ($locations as $location): ?>
											<option value="<?=$location['id']?>"><?=$location['city']?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="col-md-3 col-sm-3 padd-0">
								<div class="sl-box">
									<select class="wide form-control br-1" name="loc_to">
										<option data-display="Куди" value="0">Куди</option>
										<?php foreach ($locations as $location): ?>
											<option value="<?=$location['id']?>"><?=$location['city']?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="col-md-3 col-sm-3 padd-0">
								<input type="text" name="date" id="book-date" class="form-control br-1" value="When...">
							</div>

							<!--<div class="col-md-2 col-sm-2 padd-0">
								<div class="sl-box">
									<input type="number" name="children" value="0" class="form-control">
								</div>
							</div>-->

							<div class="col-md-3 col-sm-3 padd-0">
								<button type="submit" class="btn theme-btn cl-white seub-btn">ЗНАЙТИ</button>
							</div>

						</fieldset>
					</form>



				</div>
			</div>
		</div>
	</section>
	<!-- ======================= Slide Multiple Booking End Banner ===================== -->
	<div class="clearfix"></div>

	<!-- ====================== How It Work ================= -->
	<section class="how-it-works">
		<div class="container">

			<div class="row">
				<div class="col-md-12">
					<div class="heading">
						<h1>Поїздка до Польщі автобусом</h1>
						<h4>Ми виконуємо регулярні автобусні перевезення пасажирів по наступних напрямках:</h4>
					</div>
				</div>
			</div>

			<div class="row">

				<div class="col-md-4 col-sm-4">
					<div class="work-process">
						<div class="process-img">
							<img src="assets/img/tour-1.png" class="img-responsive" alt="" />
							<span class="process-num">01</span>
						</div>
						<h4>Долина - Варшава</h4>
						<p>Post a job to tell us about your project. We'll quickly match you with the right freelancers.
						</p>
					</div>
				</div>

				<div class="col-md-4 col-sm-4">
					<div class="work-process">
						<div class="process-img">
							<img src="assets/img/tour-2.png" class="img-responsive" alt="" />
							<span class="process-num">02</span>
						</div>
						<h4>Івано-Франківськ - Щецин</h4>
						<p>Івано-Франківськ • Калуш • Долина • Стрий • Львів • Варшава • Познань• Гожув Велькополь •
							Щецин• Голенюв • Свиноуйсьце
						</p>
					</div>
				</div>

				<div class="col-md-4 col-sm-4">
					<div class="work-process">
						<div class="process-img">
							<img src="assets/img/tour-3.png" class="img-responsive" alt="" />
							<span class="process-num">03</span>
						</div>
						<h4>Чернівці - Свіноуйсьце</h4>
						<p>Чернівці • Снятин • Коломия • Івано-Франківськ • Калуш • Долина • Стрий • Львів • Варшава •
							Варшава (Аеропорт) • Лодзь • Познань • Гожув Велькополь • Щецин • Голенюв • Свіноуйсьце
						</p>
					</div>
				</div>

			</div>

		</div>
	</section>
	<!-- ====================== How It Work ================= -->
	<div class="clearfix"></div>

	<!-- ====================== Bus park ================= -->
	<section class="gray-bg">
		<div class="container">

			<div class="row">
				<div class="col-md-12">
					<div class="heading">
						<a href="bus-park.html">
							<h4 class="block-header">Автопарк</h4>
						</a>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="list-slider">

					<?php foreach ($buses as $bus): ?>
						<div class="list-slide-box">
							<article class="tour-box style-1">
								<div class="tour-box-image">
									<figure>
										<a href="bus.php?id=<?=$bus['id']?>">
											<img src="photo/buses/<?=$bus['photo'];?>" class="img-responsive listing-box-img" alt="" />
											<div class="list-overlay"></div>
											<div class="tour-time">
												<i class="ti ti-car"></i><span><?=$bus['seats'];?> місць</span>
											</div>
											<h4 class="destination-place">
												<a href="bus.php?id=<?=$bus['id']?>"><?=$bus['brand'].' '.$bus['model'];?></a>
											</h4>
										</a>
									</figure>
								</div>
								<div class="description-bus">
									<p><?=$bus['short_descr'];?></p>
								</div>
								<a href="bus.php?id=<?=$bus['id']?>" class="btn btn-success full-width bus-details-btn">Деталі</a>
							</article>
						</div>
					<?php endforeach; ?>

				</div>
			</div>

		</div>
	</section>
	<!-- ====================== Bus park ================= -->

	<div class="clearfix"></div>

	<!-- ====================== About ================= -->

	<section id="about">
		<div class="container">

			<div class="row">

				<div class="col-md-6 col-sm-12">
					<div class="ab-detail">
						<h2>Про нас</h2>
						<p><strong>Тур-Транс</strong> - це передова компанія, що здійснює регулярні міжнародні
							пасажирські автобусні перевезення. Ми працюєм вже більше 15 років на ринку транспортних
							послуг, що дало нам можливість отримати великий досвід роботи, сформувати команду
							кваліфікованих спеціалістів і запропонувати Вам якісний сервіс за доступною ціною. </p>
						<p><strong>Наша мета</strong> - задоволений поїздкою клієнт, який рекомендує нас своїм друзям і
							знайомим!</p>
					</div>
				</div>

				<div class="col-md-6 col-sm-12">
					<!-- row -->
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="info-module">
								<i class="ti-timer cl-success"></i>
								<h4 class="infobox_title">Більше 20 років на ринку</h4>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="info-module">
								<i class="ti-money cl-success"></i>
								<h4 class="infobox_title">Доступні ціни</h4>
							</div>
						</div>
					</div>
					<!-- /row -->

					<!-- row -->
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="info-module">
								<i class="ti-crown cl-success"></i>
								<h4 class="infobox_title">Автобуси VIP класу</h4>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="info-module">
								<i class="ti-stats-up cl-success"></i>
								<h4 class="infobox_title">Більше 150 000 перевезених пасажирів</h4>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>

			</div>

		</div>
	</section>

	<!-- ====================== About ================= -->
	<div class="clearfix"></div>

	<!-- ====================== Contacts ================= -->
	<section id="contacts" class="gray-bg">
		<div class="container">
			<div class="row">

				<div class="col-md-12">
					<div class="heading">
						<h4 class="block-header">Контакти</h4>						
					</div>
				</div>

				<div class="col-md-5 col-sm-5">
					<div class="form-box">
						<i class="c-icon ti-email theme-cl"></i>
						<div class="c-detail">
							<strong>Email:</strong>
							<p>kalush.turtrans@gmail.com</p>
						</div>
					</div>

					<div class="form-box">
						<i class="c-icon ti-headphone-alt theme-cl"></i>
						<div class="c-detail">
							<strong>Зателефонуйте нам:</strong>
							<p>+38 (050) 538-92-95</p>
						</div>
					</div>

					<div class="form-box">
						<i class="c-icon ti-map-alt theme-cl"></i>
						<div class="c-detail">
							<strong>Місце розташування офісу:</strong>
							<p>Україна, Івано-Франківська обл. м. Калуш<br>вул. Долинська, 52</p>
						</div>
					</div>

				</div>

				<div class="col-md-7 col-sm-7">
					<div class="form-box">
						<form class="c-form">

							<div class="row">
								<div class="col-sm-6">
									<label>Ім'я та Прізвище<sup class="cl-danger">*</sup></label>
									<input type="text" class="form-control">
								</div>
								<div class="col-sm-6">
									<label>Email<sup class="cl-danger">*</sup></label>
									<input type="email" class="form-control">
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6">
									<label>Номер телефону<sup class="cl-danger">*</sup></label>
									<input type="text" class="form-control">
								</div>
								<div class="col-sm-6">
									<label>Тема повідомлення</label>
									<input type="text" class="form-control">
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12">
									<label>Повідомлення</label>
									<textarea class="form-control height-150"></textarea>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12">
									<button type="button" class="btn theme-btn btn-arrow">Надіслати повідомлення</button>
								</div>
							</div>

						</form>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- ====================== Contacts ================= -->
	<div class="clearfix"></div>


	<!-- ============== Before Footer ====================== -->
	<section class="before-footer bt-1 bb-1">
		<div class="container-fluid padd-0 full-width">

			<div class=" col-md-2 col-sm-2 br-1 mbb-1">
				<div class="data-flex">
					<h4>Contact Us!</h4>
				</div>
			</div>

			<div class="col-md-3 col-sm-3 br-1 mbb-1">
				<div class="data-flex text-center">
					53 Boulevard Victor Hugo 44200 Nantes, France
				</div>
			</div>

			<div class="col-md-3 col-sm-3 br-1 mbb-1">
				<div class="data-flex text-center">
					<span class="d-block mrg-bot-0">06 52 52 20 30</span>
					<a href="#" class="theme-cl"><strong>hello@gmail.com</strong></a>
				</div>
			</div>

			<div class="col-md-4 col-sm-4 padd-0">
				<div class="data-flex padd-0">
					<ul class="social-share">
						<li><a href="#"><i class="fa fa-facebook theme-cl"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus theme-cl"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter theme-cl"></i></a></li>
						<li><a href="#"><i class="fa fa-linkedin theme-cl"></i></a></li>
					</ul>
				</div>
			</div>

		</div>
	</section>
	<!-- =================== Before Footer ====================== -->

	<?php require 'footer.php'; ?>

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

	<script src="assets/plugins/js/wow/wow.min.js"></script>
	<script>
		new WOW().init();
	</script>

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
		$('a[href*="#"]').on('click', function (e) {
			e.preventDefault()

			$('html, body').animate(
				{
					scrollTop: $($(this).attr('href')).offset().top - 65,
				},
				1500, 'easeInOutExpo')
		})
	</script>

	<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

</body class="index-page">

</html>