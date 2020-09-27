    <header class="bg-dark dk header navbar navbar-fixed-top-xs">
      <div class="navbar-header aside-md">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="fa fa-bars"></i>
        </a>
        <a href="#" class="navbar-brand" data-toggle="fullscreen">
          <img src="assets/images/bussystem.png" class="m-r-sm header-images-bus">Bus System</a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
      <ul class="nav navbar-nav hidden-xs">
        <li class="dropdown">
          <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon button-aside">
            <i class="fa fa-angle-left text"></i>
            <i class="fa fa-angle-right text-active"></i>
            <span class="badge badge-sm up bg-danger m-l-n-sm count"></span>
          </a>
        </li>

      </ul>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
        <li class="hidden-xs">
          <a href="#" class="dropdown-toggle dk" data-toggle="dropdown">
            <i class="fa fa-bell"></i>
            <span class="badge badge-sm up bg-danger m-l-n-sm count">0</span>
          </a>
          <section class="dropdown-menu aside-xl">
            <section class="panel bg-white">
              <header class="panel-heading b-light bg-light">
                <strong>У вас є <span class="count">0</span> сповіщення</strong>
              </header>
              <div class="list-group list-group-alt animated fadeInRight">
<!--
                <a href="#" class="media list-group-item">
                  <span class="pull-left thumb-sm text-center"><i class="fa fa-ticket fa-2x text-success"></i></span>
                  <span class="media-body block m-b-none"> Долина - Варшава<br><small class="text-muted"> 15 хвилин тому</small></span>
                </a>
-->
              </div>
            </section>
          </section>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
              <?php
                !empty($_SESSION['admin']['photo']) ? $photo = '../photo/users/'.$_SESSION['admin']['photo'] : $photo = 'http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg';
              ?>  
              <img src="<?=$photo;?>">
            </span>
            <?php echo $_SESSION['admin']['login'];?> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">
            <span class="arrow top"></span>
            <li>
              <a href="index.php?page=settings">Налаштування</a>
            </li>
            <li>
              <a href="index.php?page=profile">Профіль</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="signout.php">Вийти</a>
            </li>
          </ul>
        </li>
      </ul>
    </header>