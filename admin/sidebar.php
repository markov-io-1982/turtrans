<aside class="bg-dark lter aside-md hidden-print hidden-xs" id="nav">

  <section class="vbox">

    <section class="w-f scrollable">
      <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px"
        data-color="#333333">

        <!-- nav -->
        <nav class="nav-primary hidden-xs">
          <ul class="nav">

            <li class="wp-company">
              <a class="wp-company-name">
                <span>Тур-транс</span>
              </a>
            </li>
            
            <li id="li-dashboard">
              <a href="index.php">
                <i class="fa fa-home">
                  <b class="bg-info"></b>
                </i>
                <span>Головна</span>
              </a>
            </li>
            
            <li id="li-directory">
              <a href="#">
                <i class="fa fa-book">
                  <b class="bg-success"></b>
                </i>
                <span class="pull-right">
                  <i class="fa fa-angle-down text"></i>
                  <i class="fa fa-angle-up text-active"></i>
                </span>
                <span>Довідники</span>
              </a>
              <ul class="nav lt">
                <?php if ($user_roles['locations'] == 1) { ?>              
                    <li id="li-locations">
                      <a href="index.php?page=locations">
                        <i class="fa fa-angle-right"></i>
                        <span>Населені пункти</span>
                      </a>
                    </li>
                <?php } ?>
                <?php if ($user_roles['buses'] == 1) { ?>
                    <li id="li-buses">
                      <a href="index.php?page=buses">
                        <i class="fa fa-angle-right"></i>
                        <span>Автобуси</span>
                      </a>
                    </li>
                <?php } ?>
                <?php if ($user_roles['options'] == 1) { ?>
                    <li id="li-options">
                      <a href="index.php?page=options">
                        <i class="fa fa-angle-right"></i>
                        <span>Опції автобуса</span>
                      </a>
                    </li>
                <?php } ?>
                <?php if ($user_roles['personnel'] == 1) { ?>
                    <li id="li-personnel">
                      <a href="index.php?page=personnel">
                        <i class="fa fa-angle-right"></i>
                        <span>Персонал</span>
                      </a>
                    </li>
                <?php } ?>
                <?php if ($user_roles['positions'] == 1) { ?>
                    <li id="li-positions">
                      <a href="index.php?page=positions">
                        <i class="fa fa-angle-right"></i>
                        <span>Посади</span>
                      </a>
                    </li>
                <?php } ?>
                <?php if ($user_roles['roles'] == 1) { ?>
                    <li id="li-roles">
                      <a href="index.php?page=roles">
                        <i class="fa fa-angle-right"></i>
                        <span>Довідник ролей</span>
                      </a>
                    </li>
                <?php } ?>
                <?php if ($user_roles['discounts'] == 1) { ?>
                    <li id="li-discounts">
                      <a href="index.php?page=discounts">
                        <i class="fa fa-angle-right"></i>
                        <span>Довідник знижок (акцій)</span>
                      </a>
                    </li>
                <?php } ?>
                <?php if ($user_roles['stops'] == 1) { ?>
                    <li id="li-stops">
                      <a href="index.php?page=stops">
                        <i class="fa fa-angle-right"></i>
                        <span>Довідник зупинок</span>
                      </a>
                    </li>
                <?php } ?>
              </ul>
            </li>
            <?php if ($user_roles['trips'] == 1) { ?>
            <li id="li-trips_menu">
              <a href="#">
                <i class="fa fa-globe">
                  <b class="bg-warning"></b>
                </i>
                <span class="pull-right">
                  <i class="fa fa-angle-down text"></i>
                  <i class="fa fa-angle-up text-active"></i>
                </span>
                <span>Додавання рейсів</span>
              </a>
              <ul class="nav lt">
                <li id="li-trips">
                  <a href="index.php?page=trips">
                    <i class="fa fa-angle-right"></i>
                    <span>Додані рейси</span>
                  </a>
                </li>
                <li id="li-trip_add">
                  <a href="index.php?page=trip_add">
                    <i class="fa fa-angle-right"></i>
                    <span>Додати рейс</span>
                  </a>
                </li>
              </ul>
            </li>
            <?php } ?>
            <?php if ($user_roles['tickets'] == 1) { ?>
                <li id="li-tickets">
                  <a href="index.php?page=tickets">
                    <i class="fa fa-building-o">
                      <b class="bg-primary"></b>
                    </i>
                    <span>Статистика квитків</span>
                  </a>
                </li>
            <?php } ?>
            <?php if ($user_roles['site_info'] == 1) { ?>
            <li id="li-site_info">
                  <a href="index.php?page=site_info">
                    <i class="fa fa-info-circle">
                      <b class="bg-info"></b>
                    </i>
                    <span>Інформація на сайті</span>
                  </a>
                </li>
            <?php } ?>
            <?php if ($user_roles['passengers'] == 1) { ?>
                <li id="li-passengers">
                  <a href="index.php?page=passengers">
                    <i class="fa fa-info-circle">
                      <b class="bg-primary"></b>
                    </i>
                    <span>Пасажири</span>
                  </a>
                </li>
            <?php } ?>
            <?php if ($user_roles['admins'] == 1) { ?>
                <li id="li-admins">
                  <a href="index.php?page=admins">
                    <i class="fa fa-smile-o">
                      <b class="bg-danger"></b>
                    </i>
                    <span>Адміністратори</span>
                  </a>
                </li>
            <?php } ?>
          </ul>
        </nav>
        <!-- / nav -->

      </div>
    </section>

  </section>
</aside>