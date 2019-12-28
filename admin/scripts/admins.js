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
 
	var oTable = $('#admins-table').dataTable(settings);
	oTable.fnDestroy();
 
	$('#admins-table tbody').html('');

	$.post('classes/admins.class.php', {loadpage:1}, function(data) {
        var pageContent = data;
		$('#admins-table tbody').html(pageContent);
        var oTable = $('#admins-table').dataTable(settings);
	})
}

function clearForm() {
	$('#id').val('');
	$('#name').val('');
	$('#position_id').empty();
	$('#phone').val('');
    $('#login').val('');
    $('#email').val('');
    $('#pass').val('');
    $('#photo').val('');
    $("#preview_photo").attr("src", "http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg");
	$('#status0').prop('checked', false);
    $('#status1').prop('checked', true);
    $('#role_id').empty();
}

function validateForm() {
    if ($('#name').val() == '')
        return false;
    if ($('#position_id').val() == '')
        return false;
    if ($('#phone').val() == '')
        return false;
    if ($('#login').val() == '')
        return false;
    if ($('#email').val() == '')
        return false;
    if ($('#pass').val() == '')
        return false;
    if ($('#role_id').val() == '')
        return false;
    return true;    
}

function loadForm() {
	clearForm();
	$('#modal-title').html('Додати');
	$('#submit-add').show();
	$('#submit-edit').hide();
    
	$.post('classes/admins.class.php', {loadRecord:1, id:0}, function(data) {
        var record = JSON.parse(data);
        
        $('#position_id').append('<option value="">--Виберіть посаду--</option>');
        for (i = 0; i < record.positions.length; i++) {
		    var item = record.positions[i];
            $('#position_id').append('<option value="'+item.id+'">'+item.name+'</option>');            
        }
        $('#position_id').val(2);
        
        $('#role_id').append('<option value="">--Виберіть роль--</option>');
        for (i = 0; i < record.roles.length; i++) {
		    var item = record.roles[i];
            $('#role_id').append('<option value="'+item.id+'">'+item.name+'</option>');            
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
	$.post('classes/admins.class.php', {loadRecord:1, id:id}, function(data) {
        var record = JSON.parse(data);
        
        $('#position_id').append('<option value="">--Виберіть посаду--</option>');        
        for (i = 0; i < record.positions.length; i++) {
		    var item = record.positions[i];
            $('#position_id').append('<option value="'+item.id+'">'+item.name+'</option>');            
        }
        $('#role_id').append('<option value="">--Виберіть роль--</option>');
        for (i = 0; i < record.roles.length; i++) {
		    var item = record.roles[i];
            $('#role_id').append('<option value="'+item.id+'">'+item.name+'</option>');            
        }
        
		$('#id').val(record.id);
		$('#name').val(record.name);
		$('#position_id').val(record.position_id);
		$('#phone').val(record.phone);
        $('#login').val(record.login);
        $('#email').val(record.email);
        $('#pass').val(record.pass);
        $('#role_id').val(record.role_id);

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

function loadProfile(id) {
	$.post('classes/admins.class.php', {loadProfile:1, id:id}, function(data) {
        var record = JSON.parse(data);
        
		$('#view-id').html(record.id);
        $('#view-name').html(record.name);
		$('#view-position').html(record.position_name);
		$('#view-phone').html(record.phone);
        $('#view-email').html(record.email);
        $('#view-ip').html(record.ip);
        $('#view-login').html(record.last_login);
        $('#view-logout').html(record.last_logout);
        $("#view-photo").attr("src", record.photo);

		setTimeout(function() {
			$('#modal-profile').modal('show');
		}, 500)
	})

}


function updateRecord() {
    if (validateForm() == false) {
        alert('Заповніть всі необхідні поля!'); 
        return false;   
    }
    
    var form = $('#admin-form')[0];
    var data = new FormData(form);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "classes/admins.class.php",
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
    	$.post('classes/admins.class.php', {deleteRecord:1, id:id}, function(data) {
    	   loadpage();
    	})
    }
}

function setStatus(id, status) {
	$.post('classes/admins.class.php', {setStatus:1, id:id, status: status}, function(data) {
	   
	})
}