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
          <form action="#" id="news-form" method="post" enctype="multipart/form-data">
            <div class="form-group row">
              <label for="id" class="col-sm-3 control-label">ID</label>
              <div class="col-sm-9">
                <input name="id" class="form-control" readonly type="number" type="text" id="id" value="">
              </div>
            </div>
            <div class="form-group row">
              <label for="brand" class="col-sm-3 control-label">Назва *</label>
              <div class="col-sm-9">
                <input name="name" class="form-control" type="text" placeholder="Назва" id="name" required>
              </div>
            </div>

            <div class="form-group row">
              <label for="preview_photo" class="col-sm-3 control-label">Фото</label>
              <div class="col-sm-9">
                <div class="row">
                  <div class="col-sm-4">
                    <img src="http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg" class="img-thumbnail" name="preview_photo" id="preview_photo">
                  </div>
                  <div class="col-sm-8">
                    <input type="file" name="photo" id="photo" aria-describedby="fileHelp">
                    <small id="fileHelp" class="text-muted"></small>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="description" class="col-sm-3 control-label">Опис</label>
              <div class="col-sm-9">
                <textarea class="form-control parsley-validated" rows="6" placeholder="Type your message" name="description" id="description"></textarea>
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