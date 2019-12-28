  <div class="modal fade adding-components" id="modal-form">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="panel-heading">
          <div class="panel-title">
            <span id="modal-title">Додати</span>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
        </div>
        <div class="panel-body">
          <form action="#" id="role-form">
            <div class="form-group row">
              <label for="id" class="col-sm-3 control-label">ID</label>
              <div class="col-sm-9">
                <input name="id" class="form-control" readonly type="number" id="id" value="">
              </div>
            </div>
            <div class="form-group row">
              <label for="name" class="col-sm-3 control-label">Назва *</label>
              <div class="col-sm-9">
                <input name="name" class="form-control" type="text" id="name" value="">
              </div>
            </div>
            <div class="form-group row">
              <label for="role-name" class="col-sm-3 control-label">Посада *</label>
              <div class="col-sm-9">
                <select name="position_id" class="form-control m-b" id="position_id" required>
                  <option value="">--Виберіть посаду--</option>
                </select>
              </div>
            </div>
            <div class="form-group row wp-checkbox-options">
              <div class="col-sm-6">
                <label class="label-for-checkbox">
                  <input type="checkbox" class="checkbox-style" id="edit" name="edit">Редагування</label>
              </div>
              <div class="col-sm-6">
                <label class="label-for-checkbox">
                  <input type="checkbox" class="checkbox-style" id="del" name="del">Видалення</label>
              </div>
              <div class="col-sm-6">
                <label class="label-for-checkbox">
                  <input type="checkbox" class="checkbox-style" id="locations" name="locations">Населені пункти</label>
              </div>
              <div class="col-sm-6">
                <label class="label-for-checkbox">
                  <input type="checkbox" class="checkbox-style" id="buses" name="buses">Автобуси</label>
              </div>
              <div class="col-sm-6">
                <label class="label-for-checkbox">
                  <input type="checkbox" class="checkbox-style" id="options" name="options">Опції автобуса</label>
              </div>
              <div class="col-sm-6">
                <label class="label-for-checkbox">
                  <input type="checkbox" class="checkbox-style" id="personnel" name="personnel">Персонал</label>
              </div>
              <div class="col-sm-6">
                <label class="label-for-checkbox">
                  <input type="checkbox" class="checkbox-style" id="positions" name="positions">Посади</label>
              </div>
              <div class="col-sm-6">
                <label class="label-for-checkbox">
                  <input type="checkbox" class="checkbox-style" id="roles" name="roles">Ролі</label>
              </div>
              <div class="col-sm-6">
                <label class="label-for-checkbox">
                  <input type="checkbox" class="checkbox-style" id="discounts" name="discounts">Знижки (акції)</label>
              </div>
              <div class="col-sm-6">
                <label class="label-for-checkbox">
                  <input type="checkbox" class="checkbox-style" id="stops" name="stops">Зупинки</label>
              </div>
             <div class="col-sm-6">
                <label class="label-for-checkbox">
                  <input type="checkbox" class="checkbox-style" id="trips" name="trips">Рейси</label>
              </div>
              <div class="col-sm-6">
                <label class="label-for-checkbox">
                  <input type="checkbox" class="checkbox-style" id="tickets" name="tickets">Статистика квитків</label>
              </div>
              <div class="col-sm-6">
                <label class="label-for-checkbox">
                  <input type="checkbox" class="checkbox-style" id="site_info" name="site_info">Інформація на сайті</label>
              </div>
              <div class="col-sm-6">
                <label class="label-for-checkbox">
                  <input type="checkbox" class="checkbox-style" id="passengers" name="passengers">Пасажири</label>
              </div>
              <div class="col-sm-6" style="display: none;">
                <label class="label-for-checkbox">
                  <input type="checkbox" class="checkbox-style" id="admins" name="admins">Адміністратори</label>
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
