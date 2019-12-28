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
          <form action="#" id="discount-form">

            <div class="form-group row">
              <label for="id" class="col-sm-3 control-label">ID</label>
              <div class="col-sm-9">
                <input name="id" class="form-control" readonly type="number" type="text" id="id" value="">
              </div>
            </div>

            <div class="form-group row">
              <label for="name" class="col-sm-3 control-label">Назва знижки *</label>
              <div class="col-sm-9">
                <input name="name" class="form-control" placeholder="Назва знижки" id="name" type="text" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="discount-type" class="col-sm-3 control-label">Тип знижки *</label>
              <div class="col-sm-9">

                <div class="form-group row wp-discount-guide-modal">
                  
                  <div class="col-sm-6">
                    <div class="radio">
                      <label class="radio-inline">
                        <input type="radio" onclick="javascript:discountsCost();" name="type" value="0" id="type0" required>
                        <!--<i class="fa fa-circle-o"></i>-->
                        Вартість
                      </label>
                    </div>
                    
                    <div id="price_div" class="discounts-wp-modal" style="display: none;">
                      <div class="form-group row">
                        <label class="col-sm-3 control-label">Ціна</label>
                        <div class="col-sm-9">
                          <input class="form-control" type="text" id="price" name="price">
                        </div>
                      </div>
                      <div class="form-group row wp-sm-action">
                        <label class="col-sm-3 control-label">Акційна ціна </label>
                        <div class="col-sm-9">
                          <input class="form-control" type="text" id="promo_price" name="promo_price">
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-sm-6">
                    <div class="radio">
                      <label class="radio-inline">
                        <input type="radio" onclick="javascript:discountsCost();" name="type" value="1" id="type1" required>
                        <!--<i class="fa fa-circle-o"></i>-->
                        Відсоток
                      </label>
                    </div>
                    
                    <div id="discount_div" class="discounts-wp-modal" style="display: none;">
                      <input class="form-control" type="text" id="discount" name="discount">
                    </div>
                  </div>
                  
                </div>
                
              </div>
            </div>
            <div class="form-group row">
              <label for="date_from" class="col-sm-3 control-label">Дата з </label>
              <div class="col-sm-9">
                <input class="datepicker-here my-datepicker form-control" data-timepicker="true" id="date_from" name="date_from" />
              </div>
            </div>

            <div class="form-group row">
              <label for="date_to" class="col-sm-3 control-label">Дата по </label>
              <div class="col-sm-9">
                <input class="datepicker-here my-datepicker form-control" data-timepicker="true" id="date_to" name="date_to" />
              </div>
            </div>
            
            <div class="form-group row">
              <label for="sign_name" class="col-sm-3 control-label">Ознака *</label>
              <div class="col-sm-9">
                <label class="radio-inline">
                  <input type="radio" name="sign" value="0" id="sign0" required>
                  Покупка
                </label>
                <label class="radio-inline">
                  <input type="radio" name="sign" value="1" id="sign1" required>
                  Пошук
                </label>
                <label class="radio-inline">
                  <input type="radio" name="sign" value="2" id="sign2" required>
                  Дисконт
                </label>
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
              <div class="col-sm-12">
                <label>
                  <input type="checkbox" name="search" value="1" id="search">
                  Враховувати до вартості під час пошуку рейсу (акційна перекреслена ціна)
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