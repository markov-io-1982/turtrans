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
 
	var oTable = $('#news-table').dataTable(settings);
	oTable.fnDestroy();
 
	$('#news-table tbody').html('');

	$.post('classes/news.class.php', {loadpage:1}, function(data) {
        var pageContent = data;
		$('#news-table tbody').html(pageContent);
        var oTable = $('#news-table').dataTable(settings);
	})
}

function clearForm() {
	$('#id').val('');
	$('#name').val('');
    $('#description').val('');
    $('#photo').val('');
    $("#preview_photo").attr("src", "http://bus-ticket.bdtask.com/bus_demo_v5/assets/img/icons/default.jpg");
	$('#status0').prop('checked', false);
    $('#status1').prop('checked', true);
}

function validateForm() {
    if ($('#name').val() == '')
        return false;
    return true;    
}

function loadForm() {
	clearForm();
	$('#modal-title').html('Додати');
	$('#submit-add').show();
	$('#submit-edit').hide();
	$.post('classes/news.class.php', {loadRecord:1, id:0}, function(data) {
        var record = JSON.parse(data);
        
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
	$.post('classes/news.class.php', {loadRecord:1, id:id}, function(data) {
        var record = JSON.parse(data);
        
		$('#id').val(record.id);
		$('#name').val(record.name);
        $('#description').val(record.description);

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
    
    var form = $('#news-form')[0];
    var data = new FormData(form);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "classes/news.class.php",
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
    	$.post('classes/news.class.php', {deleteRecord:1, id:id}, function(data) {
    	   loadpage();
    	})
    }
}

function setStatus(id, status) {
	$.post('classes/news.class.php', {setStatus:1, id:id, status: status}, function(data) {
	   
	})
}