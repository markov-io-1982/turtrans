$(document).ready(function () {
    loadpage();
    
	$('#submit-add').click(function() {
		updateRecord();
	})

	$('#submit-edit').click(function() {
		updateRecord();
	})
});

function loadpage() {
    var settings = {
          "dom": "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
          "destroy": true,            
          buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
          ]
    };
 
	var oTable = $('#stops-table').dataTable(settings);
	oTable.fnDestroy();
 
	$('#stops-table tbody').html('');

	$.post('classes/stops.class.php', {loadpage:1}, function(data) {
        var pageContent = data;
		$('#stops-table tbody').html(pageContent);
        var oTable = $('#stops-table').dataTable(settings);
	})
    $('select').select2().select2('val', $('.select2 option:eq(1)').val());
}

function clearForm() {
	$('#id').val('');
	$('#name').val('');
	$('#address').val('');
    $('#options').val(null).trigger('change');
    $('#city_id').empty();
	$('#status0').prop('checked', false);
    $('#status1').prop('checked', true);
}

function validateForm() {
    if ($('#city_id').val() == '')
        return false;
    if ($('#name').val() == '')
        return false;
    return true;    
}

function loadForm() {
	clearForm();
	$('#modal-title').html('Додати');
	$('#submit-add').show();
	$('#submit-edit').hide();
	$.post('classes/stops.class.php', {loadRecord:1, id:0}, function(data) {
        var record = JSON.parse(data);
        
        var newOption = new Option('--Виберіть пункт--', '', false, false);
        $('#city_id').append(newOption).trigger('change');            
        for (i = 0; i < record.cities.length; i++) {
		    var item = record.cities[i];
            var newOption = new Option(item.name, item.id, false, false);
            $('#city_id').append(newOption).trigger('change');            
        }
        $('#city_id').val('').trigger('change');
        
		setTimeout(function() {
			$('#modal-form').modal('show');
		}, 500)
	})
    
}

function loadRecord(id) {
    clearForm();
	$('#modal-title').html('Редагувати');
	$('#submit-add').hide();
	$('#submit-edit').show();
	$.post('classes/stops.class.php', {loadRecord:1, id:id}, function(data) {
        var record = JSON.parse(data);
        
		$('#id').val(record.id);
		$('#name').val(record.name);
		$('#address').val(record.address);
        if (record.status == 0)
            $('#status0').prop('checked', true);
        else
            $('#status1').prop('checked', true);

        var newOption = new Option('--Виберіть пункт--', '', false, false);
        $('#city_id').append(newOption).trigger('change');            
        for (i = 0; i < record.cities.length; i++) {
		    var item = record.cities[i];
            var newOption = new Option(item.name, item.id, false, false);
            $('#city_id').append(newOption).trigger('change');            
        }
        $('#city_id').val(record.city_id).trigger('change');
        
		setTimeout(function() {
			$('#modal-form').modal('show');
		}, 500)
	})

}

function updateRecord() {
    if (validateForm() == false) {
        alert('Заповніть всі необхідні поля!'); 
        return false;   
    }
    
	var filedata = $('#stop-form').serialize();
	$.post('classes/stops.class.php', filedata, function(data) {
		$('#modal-form').modal('hide');
		loadpage();
	});
}

function deleteRecord(id) {
    var result = confirm("Ви впевнені ? ");
    if (result) {
    	$.post('classes/stops.class.php', {deleteRecord:1, id:id}, function(data) {
    	   loadpage();
    	})
    }
}

function setStatus(id, status) {
	$.post('classes/stops.class.php', {setStatus:1, id:id, status: status}, function(data) {
	   
	})
}