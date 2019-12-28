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
 
	var oTable = $('#buses-table').dataTable(settings);
	oTable.fnDestroy();
 
	$('#buses-table tbody').html('');

	$.post('classes/buses.class.php', {loadpage:1}, function(data) {
        var pageContent = data;
		$('#buses-table tbody').html(pageContent);
        var oTable = $('#buses-table').dataTable(settings);
	})
}

function clearForm() {
	$('#id').val('');
	$('#brand').val('');
	$('#model').val('');
	$('#number').val('');
    $('#seats').val('');
    $('#options').val(null).trigger('change');
    $('#short_descr').val('');
    $('#full_descr').val('');
    $('#options').empty();
    $('#photo').val('');
    $('#gallery').val('');
    $("#preview_photo").attr("src", "http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg");
	$('#status0').prop('checked', false);
    $('#status1').prop('checked', true);
}

function validateForm() {
    if ($('#brand').val() == '')
        return false;
    if ($('#model').val() == '')
        return false;
    if ($('#number').val() == '')
        return false;
    if ($('#seats').val() == '')
        return false;
    return true;    
}

function loadForm() {
	clearForm();
	$('#modal-title').html('Додати');
	$('#submit-add').show();
	$('#submit-edit').hide();
	$.post('classes/buses.class.php', {loadRecord:1, id:0}, function(data) {
        var record = JSON.parse(data);
        
        for (i = 0; i < record.options.length; i++) {
		    var item = record.options[i];
            var newOption = new Option(item.name, item.id, false, false);
            $('#options').append(newOption).trigger('change');            
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
	$.post('classes/buses.class.php', {loadRecord:1, id:id}, function(data) {
        var record = JSON.parse(data);
        
		$('#id').val(record.id);
		$('#brand').val(record.brand);
		$('#model').val(record.model);
		$('#number').val(record.number);
        $('#seats').val(record.seats);
        $('#short_descr').val(record.short_descr);
        $('#full_descr').val(record.full_descr);

        $("#preview_photo").attr("src", record.photo);
        if (record.status == 0)
            $('#status0').prop('checked', true);
        else
            $('#status1').prop('checked', true);

        for (i = 0; i < record.options.length; i++) {
		    var item = record.options[i];
            var newOption = new Option(item.name, item.id, false, item.selected);
            $('#options').append(newOption).trigger('change');            
        }
        
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
    
    var form = $('#bus-form')[0];
    var data = new FormData(form);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "classes/buses.class.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            $('#modal-form').modal('hide');
           loadpage();
        }
    });

}

function deleteRecord(id) {
    var result = confirm("Ви впевнені ? ");
    if (result) {
    	$.post('classes/buses.class.php', {deleteRecord:1, id:id}, function(data) {
    	   loadpage();
    	})
    }
}

function setStatus(id, status) {
	$.post('classes/buses.class.php', {setStatus:1, id:id, status: status}, function(data) {
	   
	})
}