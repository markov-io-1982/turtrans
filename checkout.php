<?php
    require 'connect.php';
    require 'controllers/checkout.php';
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

	<section class="gray-bg">
		<div class="container">

			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<div class="container-fluid app">
						<div class="row">

							<div class="col-md-6">
								<div class="tr-single-box">
									<div class="tr-single-body">

										<div class="booking-price-detail side-list no-border">
											<ul class="booking-price-detail-item">
												<span>Дата відправки:</span><strong
													class="pull-right"><?=$date;?></strong>
											</ul>
											<ul class="booking-price-detail-item">
												<span>Місто відправки:</span><strong
													class="pull-right"><?=$from;?></strong>
											</ul>
											<ul class="booking-price-detail-item"><span>Місто прибуття:</span><strong
													class="pull-right"><?=$to;?></strong></ul>
										</div>


										<div class="theatre">
											<div class="stage none-element" style="width:96px;">BUS</div>
											<div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">1</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">2</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">3</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">4</div>
											</div>
											<div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">5</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">6</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">7</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">8</div>
											</div>
											<div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">9</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">10</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">11</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">12</div>
											</div>
											<div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">13</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">14</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">15</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">16</div>
											</div>
											<div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">17</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">18</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">19</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">20</div>
											</div>
											<div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">21</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">22</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">23</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">24</div>
											</div>
											<div class="seat-at-the-exit">
												<div class="seat seat-category-1 seat-status-free add-cus-seat">25</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">26</div>
											</div>
											<div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">27</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">28</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">29</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">30</div>
											</div>
											<div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">31</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">32</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">33</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">34</div>
											</div>
											<div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">35</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">36</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">37</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">38</div>
											</div>
											<div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">39</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">40</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">41</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">42</div>
											</div>
											<div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">43</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">44</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">45</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">46</div>
											</div>
											<div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">47</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">48</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">49</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">50</div>
											</div>
											<div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">51</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">52</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">53</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">54</div>
											</div>
											<div class="the-last-row">
												<div class="seat seat-category-1 seat-status-free add-cus-seat">55</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">56</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">57</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">58</div>
												<div class="seat seat-category-1 seat-status-free add-cus-seat">59</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="tr-single-box">
									<div class="tr-single-body">
										<form data-validate="parsley">
											<div class="wrapper-add-waypoint">
												<!-- dynamic -->
												<div class="form-group dynamic-element" style="display:none">
													<div class="wp-add-dynamic-element">
														<div class="reserved-seats">
															<div class="reserved-seat">
																<div class="row">
																	<div class="col-sm-12 wp-for-delete-button">
																		<div
																			class="reserved-seat-category delete seat-category-">
																			X</div>
																	</div>
																	<div class="col-sm-6">
																		<label>І'мя</label>
																		<input type="text"
																			class="form-control parsley-validated firstName" value="<?=$user['name2'];?>">
																		<p class="error" style="display: none; color: #f00;">Поле не може бути пустим!</p>
																	</div>
																	<div class="col-sm-6">
																		<label>Прізвище</label>
																		<input type="text"
																			class="form-control parsley-validated lastName" value="<?=$user['name1'];?>">
																		<p class="error" style="display: none; color: #f00;">Поле не може бути пустим!</p>
																	</div>

																	<div class="col-sm-12">
																		<label>Телефон</label>
																		<input type="text"
																			class="form-control parsley-validated phone" value="<?=$user['phone'];?>">
																		<p class="error" style="display: none; color: #f00;">Поле не може бути пустим!</p>
																	</div>
													
																	<div class="col-sm-12">
																		<label>Знижка</label>
																		<div class="fl-box">
																			<select class="form-control">
																				<option selected="" value="0">немає</option>
																				<?php foreach($discounts as $discount): ?>
																					<option value="<?=$discount['id'];?>"><?=$discount['name'];?></option>		
																				<?php endforeach; ?>						
																			</select>
																		</div>
																	</div>
																	<div class="col-sm-6 place-price">
																		<b class="form-seat"></b><span> Місце </span>
																	</div>
																	<div class="col-sm-6 place-price">
																		<label class="wp-ticket-price-label">
																			<span>Вартість квитка: </span>
																			<span class="priceByOne"><?=$price;?>&nbsp;грн.</span></label>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="dynamic-stuff">
													<!-- Тут буде клонований динамічний елемент -->
												</div>
												<!-- dynamic -->
											</div>

											
											<div class="row">
												<div class="col-sm-12">
													<div class="reserved-total">
														<span class="reserved-total-label">Загальна сума:</span>
														<span class="reserved-total-price">0&nbsp;грн.</span>
													</div>
												</div>
											</div>


											<div class="tr-single-box">
												<div class="tr-single-body">
													<div class="payment-card wp-types-of-payment">
														<header class="payment-card-header cursor-pointer"
															data-toggle="collapse" data-target="#debit-credit"
															aria-expanded="true">
															<div class="payment-card-title flexbox">
																<h4>Оплатити онлайн</h4>
															</div>
															<div class="pull-right">
																<img src="https://mlp-bus.com/img/visa.png" alt="logo">
																<img src="https://mlp-bus.com/img/mastercard.png"
																	alt="logo">
															</div>
														</header>

														<div class="collapse" id="debit-credit" aria-expanded="false">
															<div class="payment-card-body">
																<div class="booking-price-detail side-list no-border">
																	<ul>
																		<li>Сума до оплати
																			<strong class="theme-cl pull-right total-price"></strong>
																		</li>
																	</ul>
																</div>
																<div class="wp-personal-data wp-email-payment">
																	<div class="row">
																		<div class="col-sm-12">
																			<label class="label-checkout-payment">Введіть e-mail, на яку будуть відправлені квитки:</label>
																			<input type="email" data-required="true" class="form-control parsley-validated"
																			id="pay_email" value="<?=$user['email'];?>">																	
																		</div>
																	</div>
																</div>
																<div class="wp-personal-data">
																	<input type="checkbox" id="check" name="check"
																		value="option1" data-required="true"
																		data-error-message="Ви повинні погодитися з політикою сайту."
																		class="parsley-validated">
																	<label for="check">Я приймаю <a
																			href="personal-data.html"
																			class="btn-signup red-btn" target="_blank">
																			умови обробки персональних даних
																		</a>
																	</label>
																</div>
																<div class="wp-success">
																	<button type="submit"
																		class="btn btn-m theme-btn pay-submit">Оплатити</button>
																</div>
															</div>
														</div>
													</div>

													<!-- 2 -->
													<div
														class="payment-card wp-types-of-payment wp-types-of-payment-booking">
														<header class="payment-card-header cursor-pointer"
															data-toggle="collapse" data-target="#booking"
															aria-expanded="true">
															<div class="payment-card-title flexbox">
																<h4>Забронювати</h4>
															</div>
														</header>
														<div class="collapse" id="booking" aria-expanded="false">
															<div class="payment-card-body">
																<div class="booking-price-detail side-list no-border">
																	<p>
																		При бнонюванні квитка, Вам буде надіслано
																		повідомлення
																		на
																		email,
																		перевірте пошту та перейдіть по ссилці щоб
																		оплатити заброньований квиток. Квиток дійсний 12
																		годин.
																	</p>
																</div>
																<div class="wp-personal-data wp-email-booking">
																	<div class="row">
																		<div class="col-sm-12">
																			<label class="label-checkout-payment">Введіть e-mail, на яку будуть відправлені квитки:</label>
																			<input type="email" data-required="true" class="form-control parsley-validated" 
																			id="order_email" value="<?=$user['email'];?>">																	
																		</div>
																	</div>
																</div>
																<div class="wp-personal-data">
																	<input type="checkbox" id="checkBooking" name="checkBooking"
																		value="option1" data-required="true"
																		data-error-message="Ви повинні погодитися з політикою сайту."
																		class="parsley-validated">
																	<label for="checkBooking">Я приймаю <a
																			href="personal-data.html"
																			class="btn-signup red-btn" target="_blank">
																			умови обробки персональних даних
																		</a>
																	</label>
																</div>
																<div class="wp-success">
																	<button type="submit"
																		class="btn btn-m theme-btn order-submit">Забронювати</button>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>

	<?php require 'footer.php'; ?>

	<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

	<!-- partial -->
	<script src='https://unpkg.com/react/umd/react.development.js'></script>
	<script src='https://unpkg.com/react-dom/umd/react-dom.development.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/react/0.14.3/react.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/react-bootstrap/0.28.3/react-bootstrap.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/react/0.14.3/react-dom.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/redux/3.3.1/redux.js'></script>
	<script src='https://code.jquery.com/jquery-2.2.1.min.js'></script>

	<!-- =================== START JAVASCRIPT ================== -->
	<script src="assets/plugins/js/jquery.min.js"></script>
	<script src="assets/plugins/js/bootstrap.min.js"></script>
	<script src="assets/plugins/js/viewportchecker.js"></script>
	<script src="assets/plugins/js/bootsnav.js"></script>
	<script src="assets/plugins/js/slick.min.js"></script>
	<!-- <script src="plugins/js/jquery.nice-select.min.js"></script> -->
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

	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.2.2/web-animations.min.js">
	</script>
	<script src="assets/plugins/js/counterup.min.js"></script>
	<script src="assets/plugins/js/hoverIntent.js"></script>
	<script src="assets/plugins/js/superfish.min.js"></script>
	<script src="assets/js/main.js"></script>

	<script>

		$(document).ready(function(){
			let orderSeats = [];

			let autoBooking = () => {
				// Here you call back and load data
				// $.ajax({
				// 	url : '/example/',
				// 	success : function(response){
					let data = [];
					<?php foreach($disabled_seats as $seat_number): ?>
						data.push({id: <?=$seat_number;?>});
					<?php endforeach; ?>
					console.log(data);							
					data.forEach((response)=>{
						orderSeats.push(response);
						// $( ".add-cus-seat:contains(" + response.id + ")" ).css({"background-color": "#f1f1f1", "color": "#334e6f"}).removeClass("add-cus-seat");
						$('.add-cus-seat').filter(function() {return $(this).text() ==  response.id}).css({ "background-color": "#f1f1f1", "color": "#334e6f" }).removeClass("add-cus-seat").removeClass("seat-status-free");
					})
						
				// 	}
            	// });
				console.log("autoBooking",);
			}
			autoBooking();

			// click on seat item
			$(".add-cus-seat").click(function(){
				let seat = $(this).text();
				let findIndexInOrderSeats = orderSeats.findIndex((value) => value.id == seat);

				// chack if seat added earlier
				if(findIndexInOrderSeats === -1){
					orderSeats.push({id: $(this).text(), price: <?=$price;?>, discountPrice: <?=$price;?>, discount: "0%"});
					$(this).css({"background-color": "#f00"});
					let clone = $(".dynamic-element").first().clone().addClass("add");
					clone.find( ".form-seat").html(seat);

					// Set summery price
					setSummery();

					clone.appendTo(".dynamic-stuff").show();
				}else{
					orderSeats.splice(findIndexInOrderSeats, 1);
					$(this).css({"background-color": "#334e6f"});
					setSummery();
					$( ".form-seat:contains(" + seat + ")" ).closest(".form-group").remove();
				}

				// attach handlers
				attachDelete();
			});

			let setSummery = () => {
				let summeryPrice = 0;
				orderSeats.forEach(item => {
					if(item.discountPrice){
						summeryPrice = summeryPrice + item.discountPrice;
					}
				});
				$(".reserved-total-price").html(summeryPrice + " грн.");
				$(".total-price").html(summeryPrice + " грн.");
			}

			let attachDelete = () => {
				$(".delete").off();
				$(".delete").click(function () {
					$(this).closest(".form-group").remove();
					let findSeatNumber = $(this).closest(".form-group").find(".form-seat").text();
					let findIndexInOrderSeats = orderSeats.findIndex((value) => value.id == findSeatNumber);
					orderSeats.splice(findIndexInOrderSeats, 1);
					$( ".add-cus-seat:contains(" + findSeatNumber + ")" ).css({"background-color": "#334e6f"});
					setSummery();
				});
			}

			// Click on discount select item
			$(document).on("change", "select", function(){
				// Find discount
				let discount = $(this).val();

				let findSeatNumber = $(this).closest(".form-group").find(".form-seat").text();
				let findIndexInOrderSeats = orderSeats.findIndex((value) => value.id == findSeatNumber);

				// Calculate discount
				let discountPrice = orderSeats[findIndexInOrderSeats].price - (orderSeats[findIndexInOrderSeats].price * discount) / 100;
				orderSeats[findIndexInOrderSeats].discountPrice = discountPrice;
				orderSeats[findIndexInOrderSeats].discount = discount + "%";

				// Set price with discount
				$(this).closest(".form-group").find(".priceByOne").html(discountPrice + " грн.");

				// Set summery price
				setSummery();
			});

			// click ОПЛАТИТИ
			$(document).on("click", ".pay-submit", function(){
				$( ".dynamic-element.add" ).each(function( index ) {

					// Check for empty values
					$(this).find("input").each(function(item){
						if($(this).val() === ""){
							$(this).next(".error").css({"display": "block"})
						}else{
							$(this).next(".error").css({"display": "none"})
						}
					});
				});


				let empty = $(".dynamic-element.add").find("input").filter(function() {
					return this.value === "";
				});
				
				/*
				let emptyEmail = $(".wp-email-payment").find("input").filter(function () {
					return this.value === "";
				});
				console.log($(".wp-email-payment").find('.parsley-success').length)
				*/

				// check if empty inputs exists
				if (empty.length === 0 && ($(".wp-email-payment").find('.parsley-success').length) === 1) {
					if ($('input#check').is(':checked')) {
						submit();
						<?php $str_date = strtotime($_GET['date']);?>
						$.post('controllers/checkout.php', {
							'pay-submit': 1, 
							'tickets': orderSeats,
							'trip_id': <?=$_GET['id']?>,
							'from': <?=$_GET['from']?>,
							'to': <?=$_GET['to']?>,
							'date': <?=$str_date?>,
							'email': $("#pay_email").val()
						}, function(data) {
							var record = JSON.parse(data);
							//alert(record.data);
							$("#liqpay-data").val(record.data);
							$("#liqpay-signature").val(record.signature);
							$("#liqpay-form").submit();
						});

						// remove all book forms
						$(".dynamic-element.add").remove();
					}
				}
			});

			// click ЗАБРОНЮВАТИ
			$(document).on("click", ".order-submit", function(){
				$( ".dynamic-element.add" ).each(function( index ) {

					// Check for empty values
					$(this).find("input").each(function(item){
						if($(this).val() === ""){
							$(this).next(".error").css({"display": "block"})
						}else{
							$(this).next(".error").css({"display": "none"})
						}
					});
				});

				let empty = $(".dynamic-element.add").find("input").filter(function() {
					return this.value === "";
				});

				/*
				let emptyEmail = $(".wp-email-booking").find("input").filter(function () {
					return this.value === "";
				});
				console.log($(".wp-email-booking").find('.parsley-success').length)
				*/
			
				// check if empty inputs exists
				if (empty.length === 0 && ($(".wp-email-booking").find('.parsley-success').length) === 1) {
					if ($('input#checkBooking').is(':checked')) {
						submit();
						<?php $str_date = strtotime($_GET['date']);?>
						$.post('controllers/checkout.php', {
							'reserv-submit': 1, 
							'tickets': orderSeats,
							'trip_id': <?=$_GET['id']?>,
							'from': <?=$_GET['from']?>,
							'to': <?=$_GET['to']?>,
							'date': <?=$str_date?>,
							'email': $("#order_email").val()
						}, function(data) {
							window.location.replace(data);
						});

						// remove all book forms
						$(".dynamic-element.add").remove();
					}
				}
			});

			let submit = () => {
				let findSeatNumber = $(this).closest(".form-group").find(".form-seat").text();
				let findIndexInOrderSeats = orderSeats.findIndex((value) => value.id == findSeatNumber);

				orderSeats.forEach(item => {

					if(item.price){
						// find inputs in every forms
						let firstName = $( ".form-seat:contains(" + item.id + ")" ).closest(".dynamic-element.add").find(".firstName").val();
						let lastName = $( ".form-seat:contains(" + item.id + ")" ).closest(".form-group").find(".lastName").val();
						let phone = $( ".form-seat:contains(" + item.id + ")" ).closest(".form-group").find(".phone").val();
						// let email = $( ".form-seat:contains(" + item.id + ")" ).closest(".form-group").find(".email").val();

						// find and color booked seats 
						$(".add-cus-seat").filter(function() {
							return $(this).text() === item.id;
						}).css({"background-color": "#f1f1f1", "color": "#334e6f"});

						let findIndexInOrderSeats = orderSeats.findIndex((value) => value.id == item.id);

						orderSeats[findIndexInOrderSeats].firstName = firstName;
						orderSeats[findIndexInOrderSeats].lastName = lastName;
						orderSeats[findIndexInOrderSeats].phone = phone;
						// orderSeats[findIndexInOrderSeats].email = email;
					}
					
				})

				
				orderSeats = orderSeats.filter(function(item){
					return item.price !== undefined;
				});
				console.log("Кінцеве замовлення:", orderSeats);

				// clear data array and sum
				//orderSeats = [];
				//setSummery();
			}
		});

	</script>

	<script src="assets/plugins/js/contactform.js"></script>
	<script src="assets/plugins/js/parsley.min.js"></script>

</body>

<form method="POST" id="liqpay-form" action="https://www.liqpay.ua/api/3/checkout" accept-charset="utf-8">
	<input type="hidden" id="liqpay-data" name="data" value=""/>
 	<input type="hidden" id="liqpay-signature" name="signature" value=""/>
</form> 

</html>