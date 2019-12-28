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
 
	var oTable = $('#passengers-table').dataTable(settings);
	oTable.fnDestroy();
 
	$('#passengers-table tbody').html('');

	$.post('classes/passengers.class.php', {loadpage:1}, function(data) {
        var pageContent = data;
		$('#passengers-table tbody').html(pageContent);
        var oTable = $('#passengers-table').dataTable(settings);
	})
}

function clearForm() {
	$('#id').val('');
	$('#name1').val('');
    $('#name2').val('');
    $('#name3').val('');
    $('#email').val('');
	$('#phone').val('');
    $('#trips_count').val('');
    $('#city').val('');
    $('#country').val('');
    $('#photo').val('');
    $("#preview_photo").attr("src", "http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg");
    $('#pass').val('');
    $('#description').val('');
    //$('#added_by').val('');
	$('#status0').prop('checked', false);
    $('#status1').prop('checked', true);
}

function validateForm() {
    if ($('#name1').val() == '')
        return false;
    if ($('#name2').val() == '')
        return false;
    if ($('#email').val() == '')
        return false;
    if ($('#phone').val() == '')
        return false;
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
	$.post('classes/passengers.class.php', {loadRecord:1, id:id}, function(data) {
        var record = JSON.parse(data);
        
		$('#id').val(record.id);
    	$('#name1').val(record.name1);
        $('#name2').val(record.name2);
        $('#name3').val(record.name3);
        $('#email').val(record.email);
    	$('#phone').val(record.phone);
        $('#trips_count').val(record.trips_count);
        $('#city').val(record.city);
        $('#country').val(record.country);
        $('#pass').val(record.pass);
        $('#description').val(record.description);
        //$('#added_by').val(record.added_by);

        $("#preview_photo").attr("src", record.photo);
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
    
    var form = $('#passenger-form')[0];
    var data = new FormData(form);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "classes/passengers.class.php",
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
    	$.post('classes/passengers.class.php', {deleteRecord:1, id:id}, function(data) {
    	   loadpage();
    	})
    }
}

function setStatus(id, status) {
	$.post('classes/passengers.class.php', {setStatus:1, id:id, status: status}, function(data) {
	   
	})
}