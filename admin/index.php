<?php
    require 'connect.php';

    if (!isset($_SESSION['user']['id']) || !isset($_SESSION['user']['role_id'])) {
	     header('Location: signin.php');
    }
?>

<!DOCTYPE html>
<html lang="en" class="app">

<head>
  <meta charset="utf-8" />
  <title>Bus System | Тур-транс</title>
  <meta name="description"
    content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="assets/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="assets/css/font.css" type="text/css" />
  <link rel="stylesheet" href="assets/js/select2/select2.css" type="text/css" />
  <link rel="stylesheet" href="assets/js/select2/theme.css" type="text/css" />
  <link rel="stylesheet" href="assets/js/calendar/bootstrap_calendar.css" type="text/css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="assets/js/datatablesNew/buttons.dataTables.min.css" type="text/css" />
  <link rel="stylesheet" href="assets/css/app.css" type="text/css" />
  <link rel="stylesheet" href="assets/css/styles.css">
  
  <link rel="stylesheet" href="assets/js/air-datepicker/datepicker.css" />

  <link href="assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="assets/js/datepicker/datepicker2.css" type="text/css" />
  <link rel="stylesheet" href="assets/js/datepicker/datepicker3.css" type="text/css"/>
  <link rel="stylesheet" href="assets/js/fuelux/fuelux.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" />
</head>

<?php 
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        if ($page == 'passenger_account')
            $access_page = 'passengers';
        else if ($page == 'trip_add')
            $access_page = 'trips';
        else
            $access_page = $page;
                
        if (isset($user_roles[$access_page]) && ($user_roles[$access_page] == 0)) {
            $page = 'error';
        }
    } else {
        $page = 'dashboard';
    } 

?>

<body class="">
  <section class="vbox">
    <?php include_once('header.php');?>
    
    <section>
      <section class="hbox stretch">
        
        <?php include_once('sidebar.php');?>
        <?php include_once('pages/view/'.$page.'.php');?>     
        
      </section>
    </section>
        
  </section>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/app.js"></script>
  <script src="assets/js/slimscroll/jquery.slimscroll.min.js"></script>

  <script src="assets/js/fuelux/fuelux.js"></script>
  <script src="assets/js/charts/easypiechart/jquery.easy-pie-chart.js"></script>
  <script src="assets/js/charts/sparkline/jquery.sparkline.min.js"></script>
  <script src="assets/js/charts/flot/jquery.flot.min.js"></script>
  <script src="assets/js/charts/flot/jquery.flot.tooltip.min.js"></script>
  <script src="assets/js/charts/flot/jquery.flot.resize.js"></script>
  <script src="assets/js/charts/flot/jquery.flot.grow.js"></script>

  <script src="assets/js/datatablesNew/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.colVis.min.js"></script>
  
  <script src="assets/js/charts/flot/demo.js"></script>
  <script src="assets/js/select2/select2.min.js"></script>
  <script src="assets/js/calendar/bootstrap_calendar.js"></script>
  <script src="assets/js/sortable/jquery.sortable.js"></script>
  <script src="assets/js/app.plugin.js"></script>
  
  <script type="text/javascript" src="assets/js/air-datepicker/datepicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
  <script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

  
  <?php
    if (file_exists('pages/modal/'.$page.'.php')) 
        include_once('pages/modal/'.$page.'.php');?>
  
</body>

<?php include_once('initscripts.php');?>

</html>

<script>
    $('#li-'+'<?=$page?>').addClass('active');
    <?php
        $directories = array('locations', 'buses', 'options', 'personnel', 'positions', 'roles', 'discounts', 'stops');
        $trips_menu = array('trips', 'trip_add');
    ?>    
    <?php if (in_array($page, $directories)) { ?>
        $('#li-directory').addClass('active');
    <?php } else if (in_array($page, $trips_menu)) { ?>
        $('#li-trips_menu').addClass('active');
    <?php } ?>
</script>