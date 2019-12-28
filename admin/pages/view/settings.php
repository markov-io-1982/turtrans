<section id="content">
  <section class="vbox">
    <header class="header bg-white b-b b-light">
      <p>Налаштування</p>
    </header>
    <section class="scrollable wrapper">
      <section class="panel panel-default user-profile">
        <div class="panel-body">
          
          <form action="#" id="settings-form">
            <div class="form-group row">
              <label for="id" class="col-sm-3 control-label">ID</label>
              <div class="col-sm-9">
                <input name="id" class="form-control" readonly type="number" id="id" value="">
              </div>
            </div>
            <div class="form-group row">
              <label for="firstname" class="col-sm-3 control-label">ПІБ *</label>
              <div class="col-sm-9">
                <input name="name" class="form-control" type="text" id="name">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 control-label">Посада *</label>
              <div class="col-sm-9">
                <select name="position_id" class="form-control m-b" id="position_id" disabled >
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="phone" class="col-sm-3 control-label">Номер телефону *</label>
              <div class="col-sm-9">
                <input name="phone" class="form-control" type="text" id="phone">
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-3 control-label">Email *</label>
              <div class="col-sm-9">
                <input name="email" class="form-control" type="email" id="email">
              </div>
            </div>
            <div class="form-group row">
              <label for="preview_photo" class="col-sm-3">Попередній перегляд</label>
              <div class="col-sm-9">
                <img src="http://bus-ticket.bdtask.com/bus_demo_v5/./assets/img/user/m2.png" class="img-thumbnail" name="preview_photo" id="preview_photo">
              </div>
            </div>
            <div class="form-group row">
              <label for="photo" class="col-sm-3">Зображення</label>
              <div class="col-sm-9">
                <input type="file" name="photo" id="photo" aria-describedby="fileHelp">
                <small id="fileHelp" class="text-muted"></small>
              </div>
            </div>
            <input type="hidden" name="saveSettings">
            <div class="form-group text-right wp-for-right-button">
              <button type="button" id="submit-settings" class="btn btn-success">Зберегти</button>
            </div>
          </form>
          
        </div>
      </section>

      <div class="row">
        <div class="col-sm-6">
          <section class="panel panel-default user-profile">
            <header class="panel-heading font-bold">Змінити пароль</header>
            <div class="panel-body">
            
              <form action="#" id="password-form">
                <div class="form-group row">
                  <label for="password" class="col-sm-5">Старий пароль: * </label>
                  <div class="col-sm-7">
                    <input name="old_pass" id="old_pass" class="form-control" type="password" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-sm-5">Новий пароль: * </label>
                  <div class="col-sm-7">
                    <input name="new_pass" id="new_pass" class="form-control" type="password" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-sm-5">Повтор нового пароля: *</label>
                  <div class="col-sm-7">
                    <input name="confirm_pass" id="confirm_pass" class="form-control" type="password" required>
                  </div>
                </div>
                <input type="hidden" name="savePassword">
                <div class="form-group text-right wp-for-right-button">
                  <button type="button" id="submit-password" class="btn btn-success">Змінити</button>
                </div>
              </form>
              
            </div>
          </section>

        </div>
        <div class="col-sm-6">
        </div>
      </div>

    </section>
  </section>
</section>
