<section id="content">
  <section class="vbox">
    <section class="scrollable padder">

      <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li>Довідники</li>
        <li class="active">Автобуси</li>
      </ul>

      <!-- .content -->
      <div class="wp-datatables">

        <section class="panel panel-default">
          <header class="panel-heading">
            Автобуси
            <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom"
              data-title="ajax to load the data."></i>
          </header>
          <div class="table-responsive">
            <?php if ($user_roles['edit'] == 1) { ?>
                <a href="#modal-form" class="btn btn-primary btn-md button-add-option" data-toggle="modal" data-backdrop="static" data-keyboard="false" onclick="loadForm();">
                <i class="fa fa-plus"></i>Додати</a>
            <?php } ?>
            <table id="buses-table" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th width="10%">ID</th>
                  <th width="20%">Марка автобуса</th>
                  <th width="20%">Модель автобуса</th>
                  <th width="10%">Номер автобуса</th>
                  <th width="10%">Кількість місць</th>
                  <th width="15%">Опції автобуса</th>
                  <!--<th width="15%">Короткий опис</th>
                  <th width="15%">Повний опис</th>-->
                  <th width="15%">Фото</th>
                  <th width="5%">Статус <i class="fa fa-eye"></i></th>
                  <th width="10%"> </th>
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