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
          <form action="#" id="stop-form">
            <div class="form-group row">
              <label for="id" class="col-sm-3 control-label">ID</label>
              <div class="col-sm-9">
                <input name="id" class="form-control" readonly type="number" id="id" value="">
              </div>
            </div>
            <div class="form-group row">
              <label for="city_id" class="col-sm-3 control-label">Населений пункт *</label>
              <div class="col-sm-9">
                <select name="city_id" id="city_id" style="width:260px" required>
                  <option value="1">Львів</option>
                  <option value="2">Івано-Франківськ</option>
                  <option value="3">Тернопіль</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="name" class="col-sm-3 control-label">Назва зупинки *</label>
              <div class="col-sm-9">
                <input name="name" class="form-control" type="text" placeholder="Назва зупинки" id="name">
              </div>
            </div>
            <div class="form-group row">
              <label for="address" class="col-sm-3 control-label">Адреса зупинки</label>
              <div class="col-sm-9">
                <input name="address" class="form-control" type="text" placeholder="Адреса зупинки" id="address">
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
