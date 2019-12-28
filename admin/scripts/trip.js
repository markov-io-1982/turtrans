$(document).ready(function () {
    $('.date-datepicker2').datepicker2({
      multidate: true,
      format: 'dd-mm-yyyy'
    });
    $('.date-datepicker3').datepicker3({
      multidate: false,
      format: 'dd-mm-yyyy'
    });

    $('#datetimepicker3, #datetimepicker4').datetimepicker({
        format: 'HH:mm'
    });

    $('.select-option-item').select2(); 
    attach_delete();   
    attach_delete_bus();
    attach_delete_discount();
});

function updateStops(loc) {
	$.post('classes/trips.class.php', {updateStops:1, id:loc.value}, function(data) {
        var stops = JSON.parse(data);
        
        if (loc.id == 'loc_from_id') 
            var stop_element = '#stop_from_id';            
        else if (loc.id == 'loc_to_id') 
            var stop_element = '#stop_to_id';
        
        $(stop_element).empty();
        var newOption = new Option(' - ', 0, false, false);
        $(stop_element).append(newOption).trigger('change');            
        for (i = 0; i < stops.length; i++) {
		    var item = stops[i];
            var newOption = new Option(item.name, item.id, false, false);
            $(stop_element).append(newOption).trigger('change');            
        }
        $(stop_element).val('').trigger('change');
	})
}

function updateStopsStops(loc) {
	$.post('classes/trips.class.php', {updateStops:1, id:loc.value}, function(data) {
        var stops = JSON.parse(data);
        
        var index = loc.id.substr(12, 14);
        var stop_element = '#stops_stop_id'+index;
                
        $(stop_element).empty();
        var newOption = new Option(' - ', 0, false, false);
        $(stop_element).append(newOption).trigger('change');            
        for (i = 0; i < stops.length; i++) {
		    var item = stops[i];
            var newOption = new Option(item.name, item.id, false, false);
            $(stop_element).append(newOption).trigger('change');            
        }
        $(stop_element).val('').trigger('change');
	})
}