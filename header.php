<!-- ======================= Start Navigation ===================== -->
<nav class="navbar navbar-default nav bar-mobile navbar-fixed light bootsnav">

	<!-- <div class="container">
		<div class="phones">
			<ul class="nav navbar-phones" data-in="fadeInDown" data-out="fadeOutUp">					
				<li class="dropdown">
					<img src="assets/img/ua.png" alt="ua"><a href="#" class="dropdown-toggle dropdown-toggle-flag" data-toggle="dropdown">+38 (050) 538-92-95</a>
					<ul class="dropdown-menu animated fadeOutUp wp-phones-flag">
						<li><img src="assets/img/ua.png" alt="ua"><a href="tel:+380444867900">+38 (050) 538-92-95</a></li>
						<li><img src="assets/img/ua.png" alt="ua"><a href="tel:+380444867900">+38 (097) 011-36-13</a></li>							
					</ul>
				</li>		
			</ul>
		</div>		
	</div> -->

	<div class="container">

		<!-- Start Logo Header Navigation -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
				<i class="fa fa-bars"></i>
			</button>
			<a class="navbar-brand" href="index.php">
				<img src="assets/img/logo.png" class="logo logo-scrolled" alt="logo">
			</a>

		</div>
		<!-- End Logo Header Navigation -->

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="navbar-menu">

			<ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">
				<li class="dropdown">
					<a href="index.php">Головна</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Для пасажирів</a>
					<ul class="dropdown-menu animated fadeOutUp">
						<li><a href="trips-prices.html">Рейси та ціни</a></li>
						<li><a href="transportation-rules.html">Правила перевезення</a></li>
						<li><a href="faq.html">Часті питання</a></li>
						<li><a href="action.html">Акції, знижки, бонуси</a></li>
					</ul>
				</li>
				<li>
					<a href="hire-guider.html">Автопарк</a>
				</li>
				<li>
					<a href="#about">Про нас</a>
				</li>
				<li>
					<a href="#contacts">Контакти</a>
				</li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<?php if (isset($_SESSION['passenger'])) { ?>
					<li class="dropdown dash-link">
						<a href="#" class="dropdown-toggle"><img src="http://via.placeholder.com/420x420" class="img-responsive avatar" alt="" />Привіт, 
							<?=$_SESSION['passenger']['name2'];?></a>
						<ul class="dropdown-menu left-nav">
							<li><a href="profile.php">Профіль</a></li>
							<li><a href="logout.php">Вийти</a></li>
						</ul>
					</li>
				<?php } else { ?>
					<li class="br-right"><a class="btn-signup" href="signup.php"><i class="login-icon ti-user"></i>Реєстрація</a></li>
					<li class="br-right"><a class="btn-signup red-btn" href="login.php"><i class="fa fa-fw fa-sign-in"></i>Увійти</a></li>
				<?php } ?>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
</nav>
<!-- ======================= End Navigation ===================== -->
