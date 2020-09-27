<?php
    require 'connect.php';
    require 'controllers/news.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Новини</title>
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

  <section class="main-content gray-bg wrapper-news">
    <div class="container">

      <div class="row">
        <div class="col-md-12">
          <div class="heading news-heading">
            <span>Новини</span>
          </div>
        </div>
      </div>

      <div class="posts">
        <?php foreach ($news as $news_one): ?>        
        <div class="posts-item">
          <div class="posts-image">
            <a href="news_one.php?id=<?=$news_one['id'];?>"><img src="photo/news/<?=$news_one['photo'];?>" alt="Post image"></a>
          </div>
          <div class="posts-information">
            <div class="posts-date">
              <i class="ti-time padd-r-5"></i><?=date('d.m.Y H:i', strtotime($news_one['created']));?>
            </div>
            <div class="posts-title">
              <a href="news_one.php?id=<?=$news_one['id'];?>"><?=$news_one['name'];?></a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>        
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

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/owl.carousel.min.js"></script>
  <script src="https://use.fontawesome.com/826a7e3dce.js"></script>

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