<?php
    $sql = 'SELECT * FROM passengers WHERE id = '.$_GET['id'];
    $query = $db->query($sql);
    $row = $query->fetch(PDO::FETCH_ASSOC);
    if (empty($row['photo']))
        $photo = 'http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg';
    else
        $photo = '../photo/passengers/'.$row['photo']; 
        
    $sql = 'SELECT tickets.*, 
        (SELECT locations.city FROM locations WHERE tickets.loc_from_id = locations.id) as loc_from_name,
        (SELECT locations.city FROM locations WHERE tickets.loc_to_id = locations.id) as loc_to_name
        FROM tickets 
        LEFT JOIN locations ON (tickets.loc_from_id = locations.id AND tickets.loc_to_id = locations.id)
        WHERE passenger_id = '.$_GET['id'];
    $query = $db->query($sql);
           
?>

<section id="content">
  <section class="vbox">
    <header class="header bg-white b-b b-light">
      <p>Профіль пасажира</p>
    </header>

    <section class="scrollable padder wp-passenger-account">
      <div class="panel panel-default user-profile">
        <div class="panel-body">
          <a href="index.php?page=passengers" class="btn btn-primary btn-md button-add-option"><i class="fa fa-arrow-left"></i> Назад</a>
          <div class="user-header">
            <img src="<?=$photo;?>" alt="User Image" height="200">
          </div>
          <div class="h3 m-t-xs m-b-xs"><?=$row['name1'].' '.$row['name2'].' '.$row['name3'];?></div>
        </div>
        <hr />
        <dl class="dl-horizontal">
          <dt>ID</dt>
          <dd><?=$row['id'];?></dd>
          <dt>Номер телефону</dt>
          <dd><?=$row['phone'];?></dd>
          <dt>Email</dt>
          <dd><?=$row['email'];?></dd>
          <dt>Кількість поїздок</dt>
          <dd><?=$row['trips_count'];?></dd>
          <dt>Місто/Село</dt>
          <dd><?=$row['city'];?></dd>
          <dt>Країна</dt>
          <dd><?=$row['country'];?></dd>
          <br>
          <dt>IP-адреса</dt>
          <dd><?=$row['ip'];?></dd>
          <dt>Останній вхід</dt>
          <dd><?=$row['last_login'];?></dd>
          <dt>Останній вихід</dt>
          <dd><?=$row['last_logout'];?></dd>
        </dl>
      </div>
      <!-- .content -->

      <div class="wp-datatables">
        <section class="panel panel-default">
          <header class="panel-heading passenger-account-heading">
            Інформація про квитки
            <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom"
              data-title="ajax to load the data."></i>
          </header>
          <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th width="11%">ID</th>
                  <th width="11%">Номер квитка</th>
                  <th width="11%">Дата виїзду</th>
                  <th width="11%">Номер рейсу</th>
                  <th width="11%">Місто відправки</th>
                  <th width="11%">Місто прибуття</th>
                  <th width="11%">Номер місця</th>
                  <th width="11%">Ціна</th>
                  <th width="11%">Статус оплати</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                  <td><?=$row['id'];?></td>
                  <td><?=$row['number'];?></td>
                  <td><?=$row['date_departure'];?></td>
                  <td><?=$row['trip_id'];?></td>
                  <td><?=$row['loc_from_name'];?></td>
                  <td><?=$row['loc_to_name'];?></td>
                  <td><?=$row['seat'];?></td>
                  <td><?=$row['cost'];?></td>
                  <td><?=$row['status'];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </section>
      </div>
    </section>

  </section>
</section>
