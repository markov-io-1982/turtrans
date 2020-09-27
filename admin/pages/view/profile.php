<?php
    $sql = 'SELECT users.*, (SELECT positions.name FROM positions WHERE users.position_id = positions.id) as position_name 
            FROM users 
            LEFT JOIN positions ON users.position_id = positions.id
            WHERE users.id = '.$_SESSION['admin']['id'];
    $query = $db->query($sql);
    $row = $query->fetch(PDO::FETCH_ASSOC);
    if (empty($row['photo']))
        $photo = 'http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg';
    else
        $photo = '../photo/users/'.$row['photo'];    
?>

<section id="content">
  <section class="vbox">
    <header class="header bg-white b-b b-light">
      <p>Профіль</p>
    </header>
    <section class="scrollable padder">
      <section class="scrollable wrapper user-profile">
        <div class="panel panel-default  ">
          <div class="panel-body">
            <div class="user-header">
              <img src="<?=$photo;?>" alt="User Image" height="200">
            </div>
            <div class="h3 m-t-xs m-b-xs"><?=$row['name'];?></div>
          </div>
          <hr />
          <dl class="dl-horizontal">
            <dt>ID </dt>
            <dd><?=$row['id'];?></dd>
            <dt>Посада </dt>
            <dd><?=$row['position_name'];?></dd>
            <dt>Номер телефону</dt>
            <dd><?=$row['phone'];?></dd>
            <dt>Email</dt>
            <dd><?=$row['email'];?></dd>
            <br>
            <dt>IP-адреса</dt>
            <dd><?=$row['ip'];?></dd>
            <dt>Останній вхід</dt>
            <dd><?=$row['last_login'];?></dd>
            <dt>Останній вихід</dt>
            <dd><?=$row['last_logout'];?></dd>
          </dl>
        </div>
      </section>
    </section>
  </section>
</section>
