<?php
    require 'connect.php';
    require 'controllers/buses.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Автопарк</title>
  <meta name="description" content="Туртранс - міжнародні автобусні перевезення Україна - Польща." />

  <!-- Plugins CSS -->
  <link rel="stylesheet" href="assets/plugins/css/plugins.css">

  <!-- Custom style -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/responsiveness.css" rel="stylesheet">
  <link href="assets/css/skins/red.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css'>

  <link href="assets/css/main.css" rel="stylesheet">

</head>

<body>

  <?php require 'header.php'; ?>

  <section class="tr-single-detail">
    <div class="container">

    <?php foreach($buses as $bus): ?>
      <div class="wp-common-block-bus">
        <div class="row">
          <div class="col-md-12">
            <div class="heading bus-heading">
              <span><?=$bus['brand'].' '.$bus['model'];?></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="bus-slider">
            <div class="col-md-7">
              <div id="carousel" class="carousel slide">
                <div class="carousel-inner">
                  <div class="item active"><img src="photo/buses/<?=$bus['photo'];?>"></div>
                  <?php foreach ($bus['gallery'] as $photo): ?> 
                    <div class="item"> <img src="photo/buses/<?=$photo;?>"> </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

            <div class="col-md-5">
              <div class="tr-single-box bus-info-slider">
                <div class="tr-single-header">
                  <div class="clearfix">

                    <div id="thumbcarousel" class="carousel slide" data-interval="false">
                      <div class="carousel-inner carousel-wrap">
                        <div class="owl-carousel item active">
                          <div data-target="#carousel" data-slide-to="0" class="thumb"><img src="photo/buses/<?=$bus['photo'];?>"></div>
                          <?php $i = 1; foreach ($bus['gallery'] as $photo): ?> 
                            <div data-target="#carousel" data-slide-to="<?=$i;?>" class="thumb"><img src="photo/buses/<?=$photo;?>"></div>
                          <?php $i++; endforeach; ?>  
                        </div>
                      </div>

                    </div>
                    <!-- /thumbcarousel -->
                  </div>

                </div>
                <div class="tr-single-body">
                  <div class="wp-bus-service">
                    <?php foreach ($bus['options'] as $option): ?>
                      <span class="srv1" title="<?=$option;?>"><?=$option;?></span>
                    <?php endforeach; ?>
                  </div>
                </div>
                <div class="wrapper-bus-info">
                  <p><strong><?=$bus['brand'].' '.$bus['model'];?></strong>
                    <?=$bus['full_descr'];?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="spacer">
        <div class="mask"></div>
      </div>
    <?php endforeach; ?>

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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/owl.carousel.min.js"></script>
  <script src="https://use.fontawesome.com/826a7e3dce.js"></script>

  <script src="assets/js/main.js"></script>

  <script>
    /* owl-carousel */
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 15,
      nav: true,
      navText: [
        "<i class='fa fa-caret-left'></i>",
        "<i class='fa fa-caret-right'></i>"
      ],
      autoplay: true,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 2
        },
        600: {
          items: 4
        },
        1000: {
          items: 3
        }
      }
    })
  </script>


</body>

</html>