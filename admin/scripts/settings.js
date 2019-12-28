$(document).ready(function () {
    loadSettings();
    
	$('#submit-settings').click(function() {
		saveSettings();
	})

	$('#submit-password').click(function() {
		savePassword();
	})
});

function clearSettings() {
	$('#id').val('');
	$('#name').val('');
	$('#position_id').empty();
	$('#phone').val('');
    $('#email').val('');
    $('#photo').val('');
    $("#preview_photo").attr("src", "http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg");
}

function clearPassword() {
	$('#old_pass').val('');
    $('#new_pass').val('');
    $('#confirm_pass').val('');
}

function validateSettings() {
    if ($('#name').val() == '')
        return false;
    //if ($('#position_id').val() == '')
    //    return false;
    if ($('#phone').val() == '')
        return false;
    if ($('#email').val() == '')
        return false;
    return true;    
}

function validatePassword() {
    if ($('#old_pass').val() == '')
        return false;
    if ($('#new_pass').val() == '')
        return false;
    if ($('#confirm_pass').val() == '')
        return false;
    return true;    
}

function loadSettings() {
    clearSettings();
	$.post('classes/settings.class.php', {loadSettings:1}, function(data) {
        var record = JSON.parse(data);
        
        $('#position_id').append('<option value="">--Виберіть посаду--</option>');        
        for (i = 0; i < record.positions.length; i++) {
		    var item = record.positions[i];
            $('#position_id').append('<option value="'+item.id+'">'+item.name+'</option>');            
        }
        
		$('#id').val(record.id);
		$('#name').val(record.name);
		$('#position_id').val(record.position_id);
		$('#phone').val(record.phone);
        $('#email').val(record.email);
        $("#preview_photo").attr("src", record.photo);
	})
}

function saveSettings() {
    if (validateSettings() == false) {
        alert('Заповніть всі необхідні поля!'); 
        return false;   
    }
    
    var form = $('#settings-form')[0];
    var data = new FormData(form);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "classes/settings.class.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            loadSettings();    
        }
    });
}

function savePassword() {
    if (validatePassword() == false) {
        alert('Заповніть всі необхідні поля!'); 
        clearPassword();
        return false;   
    }
    
	var filedata = $('#password-form').serialize();
	$.post('classes/settings.class.php', filedata, function(data) {
        alert(data);
        clearPassword();
    });
}