<?php
    require 'connect.php';
    require 'controllers/profile-editing.php';
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
						<form method="post" enctype="multipart/form-data">
							<input type="hidden" value="<?=$user['id'];?>" name="id">
							<div class="tr-single-box single-box-profile">
								<div class="tr-single-header">
									<h3 class="dashboard-title">Редагування профілю</h3>
								</div>

								<div class="tr-single-body">
									<div class="row">
										<!-- col-md-4 -->
										<div class="col-md-4">
											<p>
												<label>Прізвизще</label>
												<input type="text" class="form-control" value="<?=$user['name1'];?>" name="name1">
											</p>

											<p>
												<label>І'мя</label>
												<input type="text" class="form-control" value="<?=$user['name2'];?>" name="name2">
											</p>

											<p>
												<label>По-Батькові</label>
												<input type="text" class="form-control" value="<?=$user['name3'];?>" name="name3">
											</p>

											<p>
												<label>Email</label>
												<input type="text" class="form-control" value="<?=$user['email'];?>" name="email">
											</p>

										</div>
										<!-- /col-md-4 -->

										<!-- col-md-4 -->
										<div class="col-md-4">
											<p>
												<label>Номер телефону</label>
												<input type="text" class="form-control" value="<?=$user['phone'];?>" name="phone">
											</p>
											<p>
												<label>Місто/Село</label>
												<input type="text" class="form-control" value="<?=$user['city'];?>" name="city">
											</p>

											<p>
												<label>Країна</label>
												<input type="text" class="form-control" value="<?=$user['country'];?>" name="country">
											</p>

											<p>
												<label>Про мене</label>
												<input type="text" class="form-control" value="<?=$user['description'];?>" name="description">
											</p>

										</div>
										<!-- /col-md-4 -->

										<!-- col-md-4 -->
										<div class="col-md-4">
											<div id="profile-div" class="feature-media-upload">

												<img id="profile-image" class="img-responsive" src="<?=$user['preview_photo'];?>" alt="user image">

												<div id="upload-container">
													<div id="aaiu-upload-container" style="position: relative;">
														<input type="file" name="photo" id="photo" style="display:none;">
														<input type="button" class="btn theme-btn full-width" value="Upload Image" onclick="thisFileUpload();">
														<script>
        													function thisFileUpload() {
            													document.getElementById("photo").click();
        													};
														</script>
													</div>
													<span class="upload_explain">* рекомендований розмір: мінімум 420px</span>
												</div>
											</div>
										</div>
										<!-- /col-md-4 -->

									</div>
								</div>
							</div>

							<div class="row text-center">
								<div class="col-md-12">
									<button type="submit" class="btn theme-btn save-changes-btn">Зберегти зміни</button>
								</div>
							</div>

						</form>	
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

</body>

</html>