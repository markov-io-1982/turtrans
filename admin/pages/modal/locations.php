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
          <form action="#" id="location-form">
            <div class="form-group row">
              <label for="id" class="col-sm-3 control-label">ID міста</label>
              <div class="col-sm-9">
                <input name="id" class="form-control" readonly type="number" type="text" id="id" value="">
              </div>
            </div>
            <div class="form-group row">
              <label for="city" class="col-sm-3 control-label">Місто *</label>
              <div class="col-sm-9">
                <input name="city" class="form-control" type="text" placeholder="Місто" id="city" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="region" class="col-sm-3 control-label">Область</label>
              <div class="col-sm-9">
                <input name="region" class="form-control" type="text" placeholder="Область" id="region">
              </div>
            </div>
            <div class="form-group row">
              <label for="country" class="col-sm-3 control-label">Країна *</label>
              <div class="col-sm-9">
                <input name="country" class="form-control" type="text" placeholder="Країна" id="country" required>
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