<section id="content">
  <section class="vbox">
    <section class="scrollable padder">
      <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
        <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
        <li>Додавання рейсів</li>
        <li class="active">Додані рейси</li>
      </ul>

      <!-- .content -->
      <div class="wp-datatables">

        <section class="panel panel-default">
          <header class="panel-heading">
            Додані рейси
            <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom"
              data-title="ajax to load the data."></i>
          </header>
          <div class="table-responsive">
            <a href="index.php?page=trip_add" class="btn btn-primary btn-md button-add-option"> Додати</a>
            <table id="trips-table" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>ID рейсу</th>
                  <th>Назва маршруту</th>
                  <th>Місто відправки</th>
                  <th>Відправлення з</th>
                  <th>Виїзд о</th>
                  <th>Місто прибуття</th>
                  <th>Кінцева зупинка</th>
                  <th>Прибуття о</th>
                  <th>Перелік дат блокування рейсу</th>
                  <th>Назва автобуса</th>
                  <th>Кількість місць</th>
                  <th>Вартість рейсу</th>
                  <th>Назва знижки при покупці</th>
                  <th>Назва знижки на рейс</th>
                  <th>Дозвіл на бронювання</th>
                  <th>Дисконт</th>
                  <th> </th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </section>
      </div>

      <!-- /.content -->

    </section>
  </section>
</section>
