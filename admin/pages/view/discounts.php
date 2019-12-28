<section id="content">
  <section class="vbox">
    <section class="scrollable padder">

      <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
        <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
        <li>Довідники</li>
        <li class="active">Довідник знижок (акцій)</li>
      </ul>

      <!-- .content -->
      <div class="wp-datatables">

        <section class="panel panel-default">
          <header class="panel-heading">
            Довідник знижок (акцій)
            <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom"
              data-title="ajax to load the data."></i>
          </header>
          <div class="table-responsive">
            <?php if ($user_roles['edit'] == 1) { ?>
                <a href="#modal-form" class="btn btn-primary btn-md button-add-option" data-toggle="modal" data-backdrop="static" data-keyboard="false" onclick="loadForm();">
                <i class="fa fa-plus"></i>Додати</a>
            <?php } ?>
            <table id="discounts-table" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th width="10%">ID</th>
                  <th width="10%">Назва знижки</th>
                  <th width="10%">Тип знижки</th>
                  <th width="10%">Відсоток %</th>
                  <th width="10%">Вартість</th>
                  <th width="10%">Акційна вартість</th>
                  <th width="10%">Дата від</th>
                  <th width="10%">Дата до</th>
                  <th width="10%">Ознака</th>
                  <th width="10%">Статус <i class="fa fa-eye"></i></th>
                  <th width="10%">Відображати в пошуку</th>
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
