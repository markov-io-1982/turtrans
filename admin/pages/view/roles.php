        <section id="content">
          <section class="vbox">
            <section class="scrollable padder">

              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                <li>Довідники</li>
                <li class="active">Ролі</li>
              </ul>

              <!-- .content -->
              <div class="wp-datatables">

                <section class="panel panel-default">
                  <header class="panel-heading">
                    Довідник ролей
                    <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom"
                      data-title="ajax to load the data."></i>
                  </header>
                  <div class="table-responsive">
                    <?php if ($user_roles['edit'] == 1) { ?>
                        <a href="#modal-form" class="btn btn-primary btn-md button-add-option" data-toggle="modal" data-backdrop="static" data-keyboard="false" onclick="loadForm();">
                        <i class="fa fa-plus"></i>Додати</a>
                    <?php } ?>
                    <table id="roles-table" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th width="10%"> </th>
                          <th width="10%">ID</th>
                          <th width="10%">Назва</th>
                          <th width="10%">Посада</th>
                          <th width="10%">Редагування</th>
                          <th width="10%">Видалення</th>
                          <th width="10%">Населені пункти</th>
                          <th width="10%">Автобуси</th>
                          <th width="10%">Опції автобуса</th>
                          <th width="10%">Персонал</th>
                          <th width="10%">Посади</th>
                          <th width="10%">Ролі</th>
                          <th width="10%">Знижки (акції)</th>
                          <th width="10%">Зупинки</th>                          
                          <th width="10%">Рейси</th>
                          <th width="10%">Статистика квитків</th>
                          <th width="10%">Інформація на сайті</th>
                          <th width="10%">Пасажири</th>
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
