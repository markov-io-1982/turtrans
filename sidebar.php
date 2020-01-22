<!-- Filter Sidebar -->
<div class="col-lg-2 col-md-2 col-sm-3 dashboard-bg left-nav-profile">

	<nav class="navbar navbar-side">
		<!-- Start Logo Header Navigation -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#dashboard-menu">
				<i class="fa fa-bars"></i>
			</button>

		</div>
		<div class="collapse sidebar-collapse" id="dashboard-menu">
			<div class="profile-wrapper">
				<div class="profile-wrapper-thumb">
					<img src="<?=$user['side_photo'];?>" class="img-responsive img-circle" alt="" />
					<span class="dashboard-user-status bg-success"></span>
				</div>
				<h4><?=$user['name1'].' '.$user['name2'];?></h4>
			</div>
			<ul class="nav" id="main-menu">
				<li class="active">
					<a href="profile.php"><i class="ti-user" aria-hidden="true"></i>Профіль</a>
				</li>
				<li>
					<a href="profile-editing.php"><i class="fa fa-edit" aria-hidden="true"></i>Редагування профілю</a>
				</li>
				<li>
					<a href="access-settings.php"><i class="fa fa-cog" aria-hidden="true"></i>Налаштування доступу</a>
				</li>
				<li>
					<a href="find-ticket.php"><i class="fa fa-ticket" aria-hidden="true"></i>Знайти квиток</a>
				</li>
				<li class="log-off">
					<a href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i>Вийти</a>
				</li>
			</ul>
		</div>
	</nav>

</div>
