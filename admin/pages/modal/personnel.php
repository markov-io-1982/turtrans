  <div class="modal fade adding-components" id="modal-form">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="panel-heading">
          <div class="panel-title">
            <span id="modal-ttile">Додати</span>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
        </div>
        <div class="panel-body">
          <form action="#" id="personnel-form" method="post" enctype="multipart/form-data">

            <div class="form-group row">
              <label for="id" class="col-sm-3 control-label">ID</label>
              <div class="col-sm-9">
                <input name="id" class="form-control" readonly type="number" type="text" id="id" value="">
              </div>
            </div>
            <div class="form-group row">
              <label for="name" class="col-sm-3 control-label">ПІБ *</label>
              <div class="col-sm-9">
                <input name="name" class="form-control" type="text" placeholder="ПІБ" id="name" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 control-label">Посада *</label>
              <div class="col-sm-9">
                <select name="position_id" class="form-control m-b" id="position_id" required>
                  <option value="">--Виберіть посаду--</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="phone" class="col-sm-3 control-label">Номер телефону *</label>
              <div class="col-sm-9">
                <input name="phone" class="form-control" type="text" placeholder="Номер телефону" id="phone" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="login" class="col-sm-3 control-label">Логін *</label>
              <div class="col-sm-9">
                <input name="login" class="form-control" type="text" placeholder="Логін" id="login" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-3 control-label">Email *</label>
              <div class="col-sm-9">
                <input name="email" class="form-control" type="email" placeholder="Email" id="email" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="pass" class="col-sm-3 control-label">Пароль *</label>
              <div class="col-sm-9">
                <input name="pass" class="form-control" type="password" placeholder="Пароль" id="pass" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="preview_photo" class="col-sm-3 control-label">Фото</label>
              <div class="col-sm-9">
                <div class="row">
                  <div class="col-sm-4">
                    <img src="http://bus-ticket.bdtask.com/bus_demo_v5/./assets/img/icons/default.jpg" class="img-thumbnail" name="preview_photo" id="preview_photo">
                  </div>
                  <div class="col-sm-8">
                    <input type="file" name="photo" id="photo" aria-describedby="fileHelp">
                    <small id="fileHelp" class="text-muted"></small>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="status" class="col-sm-3 control-label">Статус *</label>
              <div class="col-sm-9">
                <label class="radio-inline">
                  <input type="radio" name="status" value="1" id="status1" required>
                  Активний
                </label>
                <label class="radio-inline">
                  <input type="radio" name="status" value="0" id="status0" required>
                  Неактивний
                </label>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 control-label">Ролі *</label>
              <div class="col-sm-9">
                <select name="role_id" class="form-control m-b" id="role_id" required>
                  <option value="">--Виберіть роль--</option>
                </select>
              </div>
            </div>

            <input type="hidden" name="update">
            <div class="form-group text-right wp-for-right-button">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Закрити</button>
              <button type="button" class="btn btn-success" id="submit-add">Додати</button>
              <button type="button" class="btn btn-success" id="submit-edit">Редагувати</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  
  <div class="modal fade adding-components" id="modal-profile">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="panel-body">
          <div class="panel-body user-profile">
            <div class="user-header">
              <img id="view-photo" src="http://bus-ticket.bdtask.com/bus_demo_v5/./assets/img/user/m2.png" class="img-thumbnail" alt="User Image" height="200">
            </div>
            <div class="h3 m-t-xs m-b-xs" id="view-name">John Smith</div>
          </div>
          <hr />
          <dl class="dl-horizontal">
            <dt>ID </dt>
            <dd id="view-id"></dd>
            <dt>Посада </dt>
            <dd id="view-position"></dd>
            <dt>Номер телефону</dt>
            <dd id="view-phone"></dd>
            <dt>Email</dt>
            <dd id="view-email"></dd>
            <br>
            <dt>IP-адреса</dt>
            <dd id="view-ip"></dd>
            <dt>Останній вхід</dt>
            <dd id="view-login"></dd>
            <dt>Останній вихід</dt>
            <dd id="view-logout"></dd>
          </dl>
          <div class="form-group text-right wp-for-right-button">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Закрити</button>
          </div>
        </div>
      </div>

    </div>
  </div>