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
 
	var oTable = $('#roles-table').dataTable(settings);
	oTable.fnDestroy();
 
	$('#roles-table tbody').html('');

	$.post('classes/roles.class.php', {loadpage:1}, function(data) {
        var pageContent = data;
		$('#roles-table tbody').html(pageContent);
        var oTable = $('#roles-table').dataTable(settings);
	})
}

function clearForm() {
	$('#id').val('');
    $('#name').val('');
	$('#position_id').empty();
    $('#edit').prop('checked', false);
    $('#del').prop('checked', false);
    $('#locations').prop('checked', false);
    $('#buses').prop('checked', false);
    $('#options').prop('checked', false);
    $('#personnel').prop('checked', false);
    $('#positions').prop('checked', false);
    $('#roles').prop('checked', false);
    $('#discounts').prop('checked', false);
	$('#stops').prop('checked', false);    
    $('#trips').prop('checked', false);
    $('#tickets').prop('checked', false);
    $('#site_info').prop('checked', false);
    $('#passengers').prop('checked', false);
    $('#admins').prop('checked', false);
}

function validateForm() {
    if ($('#name').val() == '')
        return false;
    if ($('#position_id').val() == '')
        return false;
    return true;    
}

function loadForm() {
	clearForm();
	$('#modal-title').html('Додати');
	$('#submit-add').show();
	$('#submit-edit').hide();
    
	$.post('classes/roles.class.php', {loadRecord:1, id:0}, function(data) {
        var record = JSON.parse(data);
        
        $('#position_id').append('<option value="">--Виберіть посаду--</option>');
        for (i = 0; i < record.positionss.length; i++) {
		    var item = record.positionss[i];
            $('#position_id').append('<option value="'+item.id+'">'+item.name+'</option>');            
        }
        
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
	$.post('classes/roles.class.php', {loadRecord:1, id:id}, function(data) {
        var record = JSON.parse(data);
        
        $('#position_id').append('<option value="">--Виберіть посаду--</option>');        
        for (i = 0; i < record.positionss.length; i++) {
		    var item = record.positionss[i];
            $('#position_id').append('<option value="'+item.id+'">'+item.name+'</option>');            
        }
        
		$('#id').val(record.id);
        $('#name').val(record.name);
		$('#position_id').val(record.position_id);
        $('#edit').prop('checked', parseInt(record.edit));
        $('#del').prop('checked', parseInt(record.del));
        $('#locations').prop('checked', parseInt(record.locations));
        $('#buses').prop('checked', parseInt(record.buses));
        $('#options').prop('checked', parseInt(record.options));
        $('#personnel').prop('checked', parseInt(record.personnel));
        $('#positions').prop('checked', parseInt(record.positions));
        $('#roles').prop('checked', parseInt(record.roles));
        $('#discounts').prop('checked', parseInt(record.discounts));
    	$('#stops').prop('checked', parseInt(record.stops));        
        $('#trips').prop('checked', parseInt(record.trips));
        $('#tickets').prop('checked', parseInt(record.tickets));
        $('#site_info').prop('checked', parseInt(record.site_info));
        $('#passengers').prop('checked', parseInt(record.passengers));
        $('#admins').prop('checked', parseInt(record.admins));

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
    
	var filedata = $('#role-form').serialize();
	$.post('classes/roles.class.php', filedata, function(data) {
		$('#modal-form').modal('hide');
		loadpage();
	});
}

function deleteRecord(id) {
    var result = confirm("Ви впевнені ? ");
    if (result) {
    	$.post('classes/roles.class.php', {deleteRecord:1, id:id}, function(data) {
    	   loadpage();
    	})
    }
}