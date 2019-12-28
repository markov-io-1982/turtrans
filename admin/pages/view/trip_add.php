<?php
    require 'trip_controller.php';
    
    //echo "<pre>";
    //print_r($trip_discounts2);
    //echo "</pre>";
?>

<section id="content">
  <section class="vbox">
    <section class="scrollable padder">
      
      <form method="post">

      <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
        <li><a href="index.php"><i class="fa fa-home"></i> Головна</a></li>
        <li class="active">Додавання рейсу</li>
      </ul>
      
      <div class="form-group text-right wp-for-right-button">
        <button type="submit" class="btn btn-success">Зберегти</button>
      </div>
      
      <section class="panel panel-default main-wp-add-trips">
        <header class="panel-heading bg-light">
          <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#route-selection" data-toggle="tab">Вибір маршруту</a></li>
            <li><a href="#choice-of-bus" data-toggle="tab">Вибір автобуса</a></li>
            <li><a href="#cost-stock" data-toggle="tab">Вартість (акції)</a></li>
            <li><a href="#discount" data-toggle="tab">Дисконт</a></li>
          </ul>
        </header>
        <div class="panel-body">
          <input type="hidden" id="id" name="id" value="<?= isset($trip['id']) ? $trip['id'] : ''; ?>">
          <div class="tab-content">
            <div class="tab-pane active wp-add-flight" id="route-selection">

              <div class="row">
                <div class="col-md-6">
                  <section class="panel panel-default">
                    <header class="panel-heading font-bold">Відправлення</header>
                    <div class="panel-body">

                      <div class="form-group row">
                        <label for="role-name" class="col-lg-4 control-label">Місто відправлення </label>
                        <div class="col-lg-8">
                          <select id="loc_from_id" name="loc_from_id" class="select-option-item" onclick="updateStops(this)">
                            <option value="0"> - </option>
                            <?php foreach ($locations as $location): ?>
                                <?= (isset($trip['loc_from_id']) && ($trip['loc_from_id'] == $location['id'])) ? $selected = 'selected' : $selected = ''; ?>
                                <option value="<?=$location['id']?>" <?=$selected?>><?=$location['name']?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="role-name" class="col-lg-4 control-label">Відправлення з </label>
                        <div class="col-lg-8">
                          <select id="stop_from_id" name="stop_from_id" class="select-option-item">
                            <option value="0"> - </option>
                            <?php foreach ($stops_from as $stop): ?>
                                <?= (isset($trip['stop_from_id']) && ($trip['stop_from_id'] == $stop['id'])) ? $selected = 'selected' : $selected = ''; ?>
                                <option value="<?=$stop['id']?>" <?=$selected?>><?=$stop['name']?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row wp-last-row">
                        <label for="discounts-name" class="col-lg-4 control-label">Виїзд о</label>
                        <div class="col-lg-8">
        
                          <div class='input-group date' id='datetimepicker3'>
                              <input type="text" class="form-control" id="start_time" name="start_time" 
                              value="<?= isset($trip['start_time']) ? $trip['start_time'] : ''; ?>" />
                              <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                          </div>

                        </div>
                      </div>
                    </div>
                  </section>
                </div>

                <div class="col-md-6">
                  <section class="panel panel-default">
                    <header class="panel-heading font-bold">Прибуття</header>
                    <div class="panel-body">
                      <div class="form-group row">
                        <label for="role-name" class="col-lg-4 control-label">Місто прибуття</label>
                        <div class="col-lg-8">
                          <select id="loc_to_id" name="loc_to_id" class="select-option-item" onclick="updateStops(this)">
                            <option value="0"> - </option>
                            <?php foreach ($locations as $location): ?>
                                <?= (isset($trip['loc_to_id']) && ($trip['loc_to_id'] == $location['id'])) ? $selected = 'selected' : $selected = ''; ?>
                                <option value="<?=$location['id']?>" <?=$selected?>><?=$location['name']?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="role-name" class="col-lg-4 control-label">Кінцева зупинка</label>
                        <div class="col-lg-8">
                          <select id="stop_to_id" name="stop_to_id" class="select-option-item">
                            <option value="0"> - </option>
                            <?php foreach ($stops_to as $stop): ?>
                                <?= (isset($trip['stop_to_id']) && ($trip['stop_to_id'] == $stop['id'])) ? $selected = 'selected' : $selected = ''; ?>
                                <option value="<?=$stop['id']?>" <?=$selected?>><?=$stop['name']?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row wp-last-row ">
                        <label for="discounts-name" class="col-lg-4 control-label">Прибуття о</label>
                        <div class="col-lg-8">

                          <div class='input-group date' id='datetimepicker4'>
                              <input type="text" class="form-control" id="end_time" name="end_time" 
                              value="<?= isset($trip['end_time']) ? $trip['end_time'] : ''; ?>" />
                              <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                          </div>

                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <section class="panel panel-default">
                    <header class="panel-heading font-bold">Проміжні пункти</header>
                    <div class="panel-body intermediate-points-body">

                      <div class="wrapper-add-waypoint">
                        <!-- dynamic -->
                        <div class="form-group dynamic-element" style="display:none">
                          <div class="row wp-add-dynamic-element">
                            <div class="form-group row">
                              <label for="role-name" class="col-lg-4 control-label">Місто зупинки </label>
                              <div class="col-lg-8">
                                <select id="stops_loc_id" name="stops_loc_id[]" class="select-option-item-dynamic" onclick="updateStopsStops(this)">
                                  <option value="0"> - </option>
                                  <?php foreach ($locations as $location): ?>
                                      <option value="<?=$location['id']?>"><?=$location['name']?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="role-name" class="col-lg-4 control-label">Адреса зупинки </label>
                              <div class="col-lg-8">
                                <select id="stops_stop_id" name="stops_stop_id[]" class="select-option-item-dynamic">
                                  <option value="0"> - </option>
                                </select>    
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="discounts-name" class="col-lg-4 control-label">Прибуття о </label>
                              <div class="col-lg-8">

                                <div class='input-group date' id='datetimepicker3'>
                                  <input type='text' class="form-control" id="stops_start_time" name="stops_start_time[]" />
                                  <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                </div>

                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="discounts-name" class="col-lg-4 control-label"> Відправлення о </label>
                              <div class="col-lg-8">

                                <div class='input-group date' id='datetimepicker3'>
                                  <input type='text' class="form-control" id="stops_end_time" name="stops_end_time[]" />
                                  <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                </div>

                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="discounts-name" class="col-lg-4 control-label label-distance">Відстань до зупинки (від попередньої зупинки)</label>
                              <div class="col-lg-8">
                                <input class="form-control" type="text" placeholder="км" id="distance" name="distance[]">
                              </div>
                            </div>                        
                            <div class="row">
                              <div class="col-lg-12">
                                <a href="#" class="btn btn-s-md btn-danger delete" onClick="return false;"><i class="fa fa-times"></i> Видалити</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="dynamic-stuff">
                          <!-- Тут буде клонований динамічний елемент -->
                          <?php $i = 100; foreach($trip_stops as $trip_stop): ?>
                            <div class="form-group dynamic-element">
                              <div class="row wp-add-dynamic-element">
                                <div class="form-group row">
                                  <label for="role-name" class="col-lg-4 control-label">Місто зупинки </label>
                                  <div class="col-lg-8">
                                    <select id="stops_loc_id<?=$i?>" name="stops_loc_id[]" class="select-option-item" onclick="updateStopsStops(this)">
                                      <option value="0"> - </option>
                                      <?php foreach ($locations as $location): ?>
                                          <?= (isset($trip_stop['loc_id']) && ($trip_stop['loc_id'] == $location['id'])) ? $selected = 'selected' : $selected = ''; ?>
                                          <option value="<?=$location['id']?>" <?=$selected?>><?=$location['name']?></option>
                                      <?php endforeach; ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="role-name" class="col-lg-4 control-label">Адреса зупинки </label>
                                  <div class="col-lg-8">
                                    <select id="stops_stop_id<?=$i?>" name="stops_stop_id[]" class="select-option-item">
                                      <option value="0"> - </option>
                                      <?php foreach ($trip_stop['stops'] as $stop): ?>
                                          <?= (isset($trip_stop['stop_id']) && ($trip_stop['stop_id'] == $stop['id'])) ? $selected = 'selected' : $selected = ''; ?>
                                          <option value="<?=$stop['id']?>" <?=$selected?>><?=$stop['name']?></option>
                                      <?php endforeach; ?>
                                    </select>    
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="discounts-name" class="col-lg-4 control-label">Прибуття о </label>
                                  <div class="col-lg-8">
                                
                                    <div class='input-group date' id='datetimepicker3'>
                                      <input type='text' class="form-control" id="stops_start_time" name="stops_start_time[]" 
                                      value="<?= isset($trip_stop['start_time']) ? $trip_stop['start_time'] : ''; ?>" />
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                    </div>                                    

                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="discounts-name" class="col-lg-4 control-label"> Відправлення о </label>
                                  <div class="col-lg-8">

                                    <div class='input-group date' id='datetimepicker3'>
                                      <input type='text' class="form-control" id="stops_end_time"  name="stops_end_time[]" 
                                      value="<?= isset($trip_stop['end_time']) ? $trip_stop['end_time'] : ''; ?>" />
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                    </div>                                    

                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="discounts-name" class="col-lg-4 control-label label-distance">Відстань до зупинки (від попередньої зупинки)</label>
                                  <div class="col-lg-8">
                                    <input class="form-control" type="text" placeholder="км" id="distance" name="distance[]" 
                                    value="<?= isset($trip_stop['distance']) ? $trip_stop['distance'] : ''; ?>" >
                                  </div>
                                </div>                        
                                <div class="row">
                                  <div class="col-lg-12">
                                    <a href="#" class="btn btn-s-md btn-danger delete" onClick="return false;"><i class="fa fa-times"></i> Видалити</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          
                          <?php $i++; endforeach; ?>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-12">
                              <a href="#" class="btn btn-s-md btn-primary add-one" onClick="return false;"><i class="fa fa-plus"></i> Додати</a>
                            </div>
                          </div>
                        </div>
                        <!-- dynamic -->
                      </div>
                    </div>
                  </section>
                </div>

                <div class="col-md-6">
                  <section class="panel panel-default">
                    <header class="panel-heading font-bold">Блокування рейсу в обрані дні</header>
                    <section class="wp-control-date">
                      <div class="panel-body">
                        <input type="text" class="form-control date-datepicker2" placeholder=" Перелік дат у які рейс не буде відображатись для покупки квитків" 
                            id="blocked_dates" name="blocked_dates" value="<?= isset($trip['blocked_dates']) ? $trip['blocked_dates'] : ''; ?>">
                        <div class="alert alert-success">
                          <strong>Перелік дат у які рейс не буде відображатись для покупки квитків</strong>
                        </div>
                      </div>
                    </section>
                  </section>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="choice-of-bus">
              <section class="panel panel-default panel-departure">
                <div class="panel-body wp-main-departure">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="role-name" class="col-lg-5 control-label wp-choice-of-bus">Виберіть
                        автобус</label>
                      <div class="col-lg-7 wp-choice-of-bus">
                        <select id="bus_id" class="select-option-item select-bus" name="bus_id">
                            <option value="0"> - </option>
                            <?php foreach ($buses as $bus): ?>
                                <?= (isset($trip['bus_id']) && ($trip['bus_id'] == $bus['id'])) ? $selected = 'selected' : $selected = ''; ?>
                                <option value="<?=$bus['id']?>" <?=$selected?>><?=$bus['name']?></option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="alert alert-success">
                        <strong>Виділіть місця, які не будуть доступні для покупки пасажирам</strong>
                      </div>
                    </div>
                  </div>

                  <div class="plane">
                    <div class="bus-driver exit exit--front fuselage"></div>
                    <ol class="cabin fuselage">
                      <li class="row row--1">
                        <ol class="seats" type="A">
                          <li class="seat">
                            <input type="checkbox" id="1A" name="seats[1]" <?= in_array(1, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="1A">1</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" disabled id="2A" name="seats[2]" <?= in_array(2, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="2A">2</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="3A" name="seats[3]" <?= in_array(3, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="3A">3</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="4A" name="seats[4]" <?= in_array(4, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="4A">4</label>
                          </li>
                        </ol>
                      </li>
                      <li class="row row--2">
                        <ol class="seats" type="B">
                          <li class="seat">
                            <input type="checkbox" id="1B" name="seats[5]" <?= in_array(5, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="1B">5</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="2B" name="seats[6]" <?= in_array(6, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="2B">6</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="3B" name="seats[7]" <?= in_array(7, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="3B">7</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="4B" name="seats[8]" <?= in_array(8, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="4B">8</label>
                          </li>
                        </ol>
                      </li>
                      <li class="row row--3">
                        <ol class="seats" type="C">
                          <li class="seat">
                            <input type="checkbox" id="1C" name="seats[9]" <?= in_array(9, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="1C">9</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="2C" name="seats[10]" <?= in_array(10, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="2C">10</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="3C" name="seats[11]" <?= in_array(11, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="3C">11</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="4C" name="seats[12]" <?= in_array(12, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="4C">12</label>
                          </li>
                        </ol>
                      </li>
                      <li class="row row--4">
                        <ol class="seats" type="D">
                          <li class="seat">
                            <input type="checkbox" id="1D" name="seats[13]" <?= in_array(13, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="1D">13</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="2D" name="seats[14]" <?= in_array(14, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="2D">14</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="3D" name="seats[15]" <?= in_array(15, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="3D">15</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="4D" name="seats[16]" <?= in_array(16, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="4D">16</label>
                          </li>
                        </ol>
                      </li>
                      <li class="row row--5">
                        <ol class="seats" type="E">
                          <li class="seat">
                            <input type="checkbox" id="1E" name="seats[17]" <?= in_array(17, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="1E">17</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="2E" name="seats[18]" <?= in_array(18, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="2E">18</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="3E" name="seats[19]" <?= in_array(19, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="3E">19</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="4E" name="seats[20]" <?= in_array(20, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="4E">20</label>
                          </li>
                        </ol>
                      </li>
                      <li class="row row--6">
                        <ol class="seats" type="F">
                          <li class="seat">
                            <input type="checkbox" id="1F" name="seats[21]" <?= in_array(21, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="1F">21</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="2F" name="seats[22]" <?= in_array(22, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="2F">22</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="3F" name="seats[23]" <?= in_array(23, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="3F">23</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="4F" name="seats[24]" <?= in_array(24, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="4F">24</label>
                          </li>
                        </ol>
                      </li>
                      <li class="row row--7">
                        <ol class="seats" type="G">
                          <li class="seat">
                            <input type="checkbox" id="1G" name="seats[25]" <?= in_array(25, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="1G">25</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="2G" name="seats[26]" <?= in_array(26, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="2G">26</label>
                          </li>

                          <span class="exit exit-center"></span>

                        </ol>
                      </li>
                      <li class="row row--8">
                        <ol class="seats" type="H">
                          <li class="seat">
                            <input type="checkbox" id="1H" name="seats[27]" <?= in_array(27, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="1H">27</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="2H" name="seats[28]" <?= in_array(28, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="2H">28</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="3H" name="seats[29]" <?= in_array(29, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="3H">29</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="4H" name="seats[30]" <?= in_array(30, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="4H">30</label>
                          </li>
                        </ol>
                      </li>
                      <li class="row row--9">
                        <ol class="seats" type="I">
                          <li class="seat">
                            <input type="checkbox" id="1I" name="seats[31]" <?= in_array(31, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="1I">31</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="2I" name="seats[32]" <?= in_array(32, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="2I">32</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="3I" name="seats[33]" <?= in_array(33, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="3I">33</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="4I" name="seats[34]" <?= in_array(34, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="4I">34</label>
                          </li>
                        </ol>
                      </li>
                      <li class="row row--10">
                        <ol class="seats" type="J">
                          <li class="seat">
                            <input type="checkbox" id="1J" name="seats[35]" <?= in_array(35, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="1J">35</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="2J" name="seats[36]" <?= in_array(36, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="2J">36</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="3J" name="seats[37]" <?= in_array(37, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="3J">37</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="4J" name="seats[38]" <?= in_array(38, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="4J">38</label>
                          </li>
                        </ol>
                      </li>
                      <li class="row row--11">
                        <ol class="seats" type="K">
                          <li class="seat">
                            <input type="checkbox" id="1K" name="seats[39]" <?= in_array(39, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="1K">39</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="2K" name="seats[40]" <?= in_array(40, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="2K">40</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="3K" name="seats[41]" <?= in_array(41, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="3K">41</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="4K" name="seats[42]" <?= in_array(42, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="4K">42</label>
                          </li>
                        </ol>
                      </li>
                      <li class="row row--12">
                        <ol class="seats" type="L">
                          <li class="seat">
                            <input type="checkbox" id="1L" name="seats[43]" <?= in_array(43, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="1L">43</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="2L" name="seats[44]" <?= in_array(44, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="2L">44</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="3L" name="seats[45]" <?= in_array(45, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="3L">45</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="4L" name="seats[46]" <?= in_array(46, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="4L">46</label>
                          </li>
                        </ol>
                      </li>
                      <li class="row row--13">
                        <ol class="seats" type="M">
                          <li class="seat">
                            <input type="checkbox" id="1M" name="seats[47]" <?= in_array(47, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="1M">47</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="2M" name="seats[48]" <?= in_array(48, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="2M">48</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="3M" name="seats[49]" <?= in_array(49, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="3M">49</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="4M" name="seats[50]" <?= in_array(50, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="4M">50</label>
                          </li>
                        </ol>
                      </li>
                      <li class="row row--14">
                        <ol class="seats" type="N">
                          <li class="seat">
                            <input type="checkbox" id="1N" name="seats[51]" <?= in_array(51, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="1N">51</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="2N" name="seats[52]" <?= in_array(52, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="2N">52</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="3N" name="seats[53]" <?= in_array(53, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="3N">53</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="4N" name="seats[54]" <?= in_array(54, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="4N">54</label>
                          </li>
                        </ol>
                      </li>
                      <li class="row row--15">
                        <ol class="seats last-row" type="P">
                          <li class="seat">
                            <input type="checkbox" id="1P" name="seats[55]" <?= in_array(55, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="1P">55</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="2P" name="seats[56]" <?= in_array(56, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="2P">56</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="3P" name="seats[57]" <?= in_array(57, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="3P">57</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="4P" name="seats[58]" <?= in_array(58, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="4P">58</label>
                          </li>
                          <li class="seat">
                            <input type="checkbox" id="5P" name="seats[59]" <?= in_array(59, $blocked_seats) ? 'checked' : ''; ?> />
                            <label for="5P">59</label>
                          </li>
                        </ol>
                      </li>

                    </ol>
                  </div>

                  <section class="scrollable padder">
                    <div class="row">
                      <div class="col-md-6">
                        <section class="panel panel-default">
                          <div class="panel-body main-bus-body">
                            <div class="alert alert-success">
                              Бронювання місць на вказану дату. Виберіть дату бронювання та вкажіть перелік
                              місць бронювання в автобусі, і пасажирам на сайті не будуть відображатись місця
                              для покупки.
                            </div>
                            <div class="wp-success-title">
                              <div class="col-md-5">
                                <label for="role-name" class="control-label waiting-label"><strong>Вибір
                                    дати</strong>
                                </label>
                              </div>
                              <div class="col-md-7">
                                <label for="role-name" class="control-label waiting-label"><strong>Перелік
                                    заброньованих
                                    місць</strong>
                                </label>
                              </div>
                            </div>
                            <div class="panel-body wrapper-add-bus">
                              <!-- dynamic -->
                              <div class="form-group dynamic-element-bus" style="display:none">
                                <div class="row wp-add-dynamic-element-bus">
                                  <div class="col-xs-10 col-sm-11 col-md-10">
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <input type="text" class="form-control date-datepicker3" placeholder="Дата" id="reserv_date" name="reserv_date[]">
                                      </div>
                                      <div class="col-sm-6">
                                        <input class="form-control" placeholder="Перелік заброньованих місць" type="text" id="reserv_seats" name="reserv_seats[]">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-xs-2 col-sm-1 col-md-2">
                                    <div class="row">
                                      <div class="wp-delete-bus">
                                        <a href="#" class="btn btn-s-md btn-danger delete-bus" onClick="return false;"><i class="fa fa-times"></i></a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="dynamic-stuff-bus">
                                <!-- Тут буде клонований динамічний елемент -->
                                <?php foreach ($reserv_seats as $reserv_seat): ?>
                                  <div class="form-group dynamic-element-bus">
                                    <div class="row wp-add-dynamic-element-bus">
                                      <div class="col-xs-10 col-sm-11 col-md-10">
                                        <div class="row">
                                          <div class="col-sm-6">
                                            <input type="text" class="form-control date-datepicker3" placeholder="Дата" id="reserv_date" name="reserv_date[]"
                                            value="<?= isset($reserv_seat['date']) ? $reserv_seat['date'] : ''; ?>">
                                          </div>
                                          <div class="col-sm-6">
                                            <input class="form-control" placeholder="Перелік заброньованих місць" type="text" id="reserv_seats" name="reserv_seats[]"
                                            value="<?= isset($reserv_seat['seats']) ? $reserv_seat['seats'] : ''; ?>">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-xs-2 col-sm-1 col-md-2">
                                        <div class="row">
                                          <div class="wp-delete-bus">
                                            <a href="#" class="btn btn-s-md btn-danger delete-bus" onClick="return false;"><i class="fa fa-times"></i></a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <?php endforeach; ?>
                              </div>
                              <div class="row">
                                <a href="#" class="btn btn-s-md btn-primary add-one-bus" onClick="return false;"><i class="fa fa-plus"></i> Додати</a>
                              </div>
                              <!-- dynamic -->
                            </div>
                          </div>
                        </section>
                      </div>
                      <div class="col-md-6">
                      </div>
                    </div>
                  </section>
                    
                </div>
              </section>
            </div>

            <div class="tab-pane" id="cost-stock">
              <!-- .content -->
              <?php if (!empty($route)) { ?>
              <div class="wp-datatables">
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th> </th>
                        <?php for ($i = 1; $i < count($route); $i++) { ?>
                            <th><?=$route[$i]['name']?></th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php for ($i = 0; $i < count($route) - 1; $i++) { ?>  
                      <tr>
                        <td><?=$route[$i]['name']?></td>
                        <?php for ($j = 1; $j < count($route); $j++) { ?>
                            <?php if ($i < $j) { ?>
                                <td><input class="form-control" type="text" placeholder="Ціна" name="prices[<?=$route[$i]['id']?>][<?=$route[$j]['id']?>]"
                                value="<?= isset($trip_prices[$route[$i]['id']][$route[$j]['id']]) ? $trip_prices[$route[$i]['id']][$route[$j]['id']] : ''; ?>"></td>
                            <?php } else { ?>
                                <td></td>
                            <?php }  ?>
                        <?php } ?>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <?php } ?>
              <!-- /.content -->

              <section class="scrollable padder multiselect-selected">
                <div class="m-b-md">
                  <h4 class="m-t-none">Вибір знижки при покупці квитка<small>(знижка яка буде відображатися при
                      оплаті квитка)</small></h4>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <select id="multiselect" class="form-control" size="5" multiple="multiple">
                      <?php foreach ($discounts0 as $discount): ?>  
                          <option value="<?=$discount['id']?>"><?=$discount['name']?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <button type="button" id="multiselect_rightAll" class="btn btn-block btn-s-md btn-success"><i class="fa fa-plus-circle"></i> Додати все</button>
                    <button type="button" id="multiselect_leftAll" class="btn btn-block btn-s-md btn-warning"><i class="fa fa-minus-circle"></i> Видалити все</button>
                  </div>
                  <div class="col-md-4">
                    <select id="multiselect_to" class="form-control" size="8" multiple="multiple" name="discounts0[]" >
                      <?php foreach ($trip_discounts0 as $discount): ?>  
                          <option value="<?=$discount['discount_id']?>"><?=$discount['discount_name']?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </section>

              <section class="scrollable padder multiselect-selected">
                <div class="m-b-md">
                  <h4 class="m-t-none">Відображати на сайті <small>(знижка яка буде відображатися при пошуку рейсу)</small></h4>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <select id="multiselect2" class="form-control" size="5" multiple="multiple">
                      <?php foreach ($discounts1 as $discount): ?>  
                          <option value="<?=$discount['id']?>"><?=$discount['name']?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <button type="button" id="multiselect2_rightAll" class="btn btn-block btn-s-md btn-success"><i class="fa fa-plus-circle"></i> Додати все</button>
                    <button type="button" id="multiselect2_leftAll" class="btn btn-block btn-s-md btn-warning"><i class="fa fa-minus-circle"></i> Видалити все</button>
                  </div>
                  <div class="col-md-4">
                    <select id="multiselect2_to" class="form-control" size="8" multiple="multiple" name="discounts1[]">
                      <?php foreach ($trip_discounts1 as $discount): ?>  
                          <option value="<?=$discount['discount_id']?>"><?=$discount['discount_name']?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </section>

              <section class="scrollable padder booking-trips">
                <div class="m-b-md">
                  <h4 class="m-t-none">Дозвіл на бронювання рейсу</h4>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="alert alert-success">
                      <strong>
                        Якщо поставлено чекбокс "Заборонити бронювання квитків", то при покупці квитка буде
                        дозволено тільки оплата онлайн.
                      </strong>
                      <br><br>
                      <strong>
                        Якщо не вибрано жодного пункуту, то буде дозволено оплата онлайн та бронювання квитка
                      </strong>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>
                          <input type="checkbox" name="reserv_disabled" id="reserv_disabled" <?= ($trip['reserv_disabled'] == 1) ? 'checked' : ''; ?>>
                          Заборонити бронювання квитків
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>

            <div class="tab-pane wp-discount" id="discount">
              <section class="scrollable padder">
                <div class="row">
                  <div class="col-sm-6">
                    <section class="panel panel-default">
                      <div class="panel-body discount-body">
                        <div class="alert alert-success">
                          <strong>Відношення кількості поїздок до процентної ставки.</strong>
                          <br><br>
                          Для прикладу: Кількість поїздок
                          <br>
                          Від 0 До 19 - 0% (не буде знижки на квиток)
                          <br>
                          Від 20 До 20 - 100% (20-та поїздка безкоштовна)
                          <br>
                          Від 21 До 49 - 5% (від 21-ї поїздки до 49-ї, знижка на покупку квитка
                          5%)
                          <br>
                          Від 50 До 99 - 10% (від 50-ї поїздки до 99-ї, знижка на покупку квитка 10%)
                          <br>
                          Від 100 До 99999 - 15% (від 100-ї поїздки до 99999-ї, знижка на покупку квитка 15%)
                        </div>
                        <div class="wp-discount-title">
                          <div class="col-lg-6">
                            <label for="role-name" class="control-label"><strong>Кількість поїздок</strong>
                            </label>
                          </div>
                          <div class="col-lg-4">
                            <label for="role-name" class="control-label"><strong>Відсоток</strong>
                            </label>
                          </div>
                          <div class="col-lg-2">
                          </div>
                        </div>
                        <div class="panel-body wrapper-add-discount">
                          
                          <!-- dynamic -->
                          <div class="form-group dynamic-element-discount" style="display:none">
                            <div class="row wp-add-dynamic-element-discount">

                              <div class="col-xs-10 col-sm-10 col-md-10">
                                <div class="row">
                                  <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                      <input class="form-control" type="text" placeholder="Від" id="discounts_from" name="discounts_from[]" >
                                    </div>
                                  </div>
                                  <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                      <input class="form-control" type="text" placeholder="До" id="discounts_to" name="discounts_to[]" >
                                    </div>
                                  </div>
                                  <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                      <select id="discounts_ids" name="discounts_ids[]" class="form-control">
                                        <option value="0"></option>
                                        <?php foreach($discounts2 as $discount): ?>
                                            <option value="<?=$discount['id']?>"><?=$discount['discount']?>%</option>
                                        <?php endforeach; ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="col-xs-2 col-sm-2 col-md-2">
                                <div class="wp-delete-discount">
                                  <a href="#" class="btn btn-s-md btn-danger delete-discount" onClick="return false;"><i class="fa fa-times"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                          
                          <div class="dynamic-stuff-discount">
                            <!-- Тут буде клонований динамічний елемент -->
                            <?php foreach($trip_discounts2 as $discount2): ?>
                              <div class="form-group dynamic-element-discount">
                                <div class="row wp-add-dynamic-element-discount">
    
                                  <div class="col-xs-10 col-sm-10 col-md-10">
                                    <div class="row">
                                      <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                          <input class="form-control" type="text" placeholder="Від" id="discounts_from" name="discounts_from[]" 
                                          value="<?= isset($discount2['trips_from']) ? $discount2['trips_from'] : ''; ?>">
                                        </div>
                                      </div>
                                      <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                          <input class="form-control" type="text" placeholder="До" id="discounts_to" name="discounts_to[]" 
                                          value="<?= isset($discount2['trips_to']) ? $discount2['trips_to'] : ''; ?>">
                                        </div>
                                      </div>
                                      <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                          <select id="discounts_ids" name="discounts_ids[]" class="form-control">
                                            <option value="0"></option>
                                            <?php foreach($discounts2 as $discount): ?>
                                                <?= (isset($discount2['discount_id']) && ($discount2['discount_id'] == $discount['id'])) ? $selected = 'selected' : $selected = ''; ?>
                                                <option value="<?=$discount['id']?>" <?=$selected?>><?=$discount['discount']?>%</option>
                                            <?php endforeach; ?>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  
                                  <div class="col-xs-2 col-sm-2 col-md-2">
                                    <div class="wp-delete-discount">
                                      <a href="#" class="btn btn-s-md btn-danger delete-discount" onClick="return false;"><i class="fa fa-times"></i></a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            
                            <?php endforeach; ?>
                          </div>
                          <div class="row">
                            <a href="#" class="btn btn-s-md btn-primary add-one-discount" onClick="return false;"><i class="fa fa-plus"></i> Додати</a>
                          </div>
                          <!-- dynamic -->
                        </div>
                      </div>
                    </section>
                  </div>

                  <div class="col-sm-6">
                  </div>
                </div>
              </section>
            </div>

          </div>
        </div>
        </div>
      </section>

    </form>

    </section>
  </section>
</section>