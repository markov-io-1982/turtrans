  <div class="modal fade adding-components form-add-item" id="modal-form">
    <div class="modal-dialog modal-wide">
      <div class="modal-content">

        <div class="panel-heading">
          <div class="panel-title">
            <span id="modal-title">Додати</span>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
        </div>
        <div class="panel-body">
          <form action="#" id="passenger-form">
            <input name="id" class="form-control" type="hidden" id="id" value="">
            
            <div class="form-group row">
              <div class="col-sm-6">
                <div class="row">
                  <label for="name1" class="col-sm-4 control-label">Прізвище *</label>
                  <div class="col-sm-8">
                    <input name="name1" class="form-control" type="text" placeholder="Прізвище" id="name1" required>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="row">
                  <label for="name3" class="col-sm-4 control-label">По-батькові</label>
                  <div class="col-sm-8">
                    <input name="name3" class="form-control" type="text" placeholder="По-батькові" id="name3">
                  </div>
                </div>
              </div>
            </div>
            
            <div class="form-group row">
              <div class="col-sm-6">
                <div class="row">
                  <label for="name2" class="col-sm-4 control-label">Ім'я *</label>
                  <div class="col-sm-8">
                    <input name="name2" class="form-control" type="text" placeholder="Ім'я" id="name2" required>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group row">
                  <label for="country" class="col-sm-4 control-label">Країна</label>
                  <div class="col-sm-8">
                    <input name="country" class="form-control" type="text" placeholder="Країна" id="country">
                  </div>
                </div>
              </div>
            </div>
            
            <div class="form-group row">
              <div class="col-sm-6">
                <div class="row">
                  <label for="email" class="col-sm-4 control-label">Email *</label>
                  <div class="col-sm-8">
                    <input name="email" class="form-control" type="email" placeholder="Email" id="email" required>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group row">
                  <label for="city" class="col-sm-4 control-label">Місто/Село</label>
                  <div class="col-sm-8">
                    <input name="city" class="form-control" type="text" placeholder="Місто/Село" id="city">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="row">
                  <label for="phone" class="col-sm-4 control-label">Телефон *</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control parsley-validated" data-type="phone" placeholder="+XX XXX XXX XX XX" data-required="true" name="phone" id="phone" required>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="row">
                  <label for="trips_count" class="col-sm-4 control-label">Кількість поїздок</label>
                  <div class="col-sm-8">
                    <input name="trips_count" class="form-control" type="text" placeholder="Кількість поїздок" id="trips_count">
                  </div>
                </div>
              </div>
            </div>
            
            <div class="form-group row">
              <label for="image_name" class="col-sm-2 control-label">Фото</label>
              <div class="col-sm-9">
                <div class="row">
                  <div class="col-sm-4">
                    <img src="http://bus-ticket.bdtask.com/bus_demo_v5/./assets/img/icons/default.jpg" class="img-thumbnail" name="preview_photo" id="preview_photo">
                  </div>
                  <div class="col-sm-10">
                    <input type="file" name="photo" id="photo" aria-describedby="fileHelp">
                    <small id="fileHelp" class="text-muted"></small>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="pass" class="col-sm-2 control-label">Пароль</label>
              <div class="col-sm-10">
                <input name="pass" class="form-control" type="password" placeholder="******" id="pass">
              </div>
            </div>
            <div class="form-group row">
              <label for="description" class="col-sm-2 control-label">Додаткова інформація</label>
              <div class="col-sm-10">
                <textarea class="form-control parsley-validated" rows="6" data-minwords="6" data-required="true"
                  placeholder="Type your message" name="description" id="description"></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label for="status" class="col-sm-2 control-label">Статус *</label>
              <div class="col-sm-10">
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
