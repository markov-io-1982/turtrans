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
 
	var oTable = $('#options-table').dataTable(settings);
	oTable.fnDestroy();
 
	$('#options-table tbody').html('');

	$.post('classes/options.class.php', {loadpage:1}, function(data) {
        var pageContent = data;
		$('#options-table tbody').html(pageContent);
        var oTable = $('#options-table').dataTable(settings);
	})
}

function clearForm() {
	$('#id').val('');
	$('#name').val('');
	$('#description').val('');
	$('#status0').prop('checked', false);
    $('#status1').prop('checked', true);
}

function validateForm() {
    if ($('#name').val() == '')
        return false;
    //if ($('#description').val() == '')
    //    return false;
    return true;    
}

function loadForm() {
	clearForm();
	$('#modal-title').html('Додати');
	$('#submit-add').show();
	$('#submit-edit').hide();
}

function loadRecord(id) {
    clearForm();
	$('#modal-title').html('Редагувати');
	$('#submit-add').hide();
	$('#submit-edit').show();
	$.post('classes/options.class.php', {loadRecord:1, id:id}, function(data) {
        var record = JSON.parse(data);
        
		$('#id').val(record.id);
		$('#name').val(record.name);
		$('#description').val(record.description);
        if (record.status == 0)
            $('#status0').prop('checked', true);
        else
            $('#status1').prop('checked', true);

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
    
	var filedata = $('#option-form').serialize();
	$.post('classes/options.class.php', filedata, function(data) {
		$('#modal-form').modal('hide');
		loadpage();
	});
}

function deleteRecord(id) {
    var result = confirm("Ви впевнені ? ");
    if (result) {
    	$.post('classes/options.class.php', {deleteRecord:1, id:id}, function(data) {
    	   loadpage();
    	})
    }
}

function setStatus(id, status) {
	$.post('classes/options.class.php', {setStatus:1, id:id, status: status}, function(data) {
	   
	})
}