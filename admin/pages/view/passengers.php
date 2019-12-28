<section id="content">
  <section class="vbox">
    <section class="scrollable padder">

      <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
        <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Пасажири</li>
      </ul>

      <!-- .content -->
      <div class="wp-datatables">

        <section class="panel panel-default">
          <header class="panel-heading">
            Пасажири
            <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom"
              data-title="ajax to load the data."></i>
          </header>
          <div class="table-responsive">
            <?php if ($user_roles['edit'] == 1) { ?>
                <a href="#modal-form" class="btn btn-primary btn-md button-add-option" data-toggle="modal" data-backdrop="static" data-keyboard="false" onclick="loadForm();">
                <i class="fa fa-plus"></i>Додати</a>
            <?php } ?>
            <table id="passengers-table" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th width="7%">Id</th>
                  <th width="7%">Прізвище</th>
                  <th width="7%">Ім'я</th>
                  <th width="7%">По-батькові</th>
                  <th width="7%">email</th>
                  <th width="7%">Номер телефону</th>
                  <th width="7%">Кількість поїздок</th>
                  <th width="7%">Місто/Село</th>
                  <th width="7%">Країна</th>
                  <th width="7%">фото</th>
                  <th width="7%">Пароль</th>
                  <th width="7%">Додаткова інформація</th>
                  <th width="7%">Ким додано</th>
                  <th width="7%">Статус</th>                  
                  <th width="7%"> </th>
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
