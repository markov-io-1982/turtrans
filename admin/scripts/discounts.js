$(document).ready(function () {
    loadpage();
    
	$('#submit-add').click(function() {
		updateRecord();
	})

	$('#submit-edit').click(function() {
		updateRecord();
	})
    
    $('.my-datepicker').datepicker({
      language: 'uk'
    });
    
    $('.minus').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.plus').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
});

function discountsCost() {
  if ($("#type0").is(":checked")) {
    $('#price_div').show();
    $('#discount_div').hide();    
  }
  else if ($("#type1").is(":checked")) {
    $('#price_div').hide();
    $('#discount_div').show();    
  }
}


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
 
	var oTable = $('#discounts-table').dataTable(settings);
	oTable.fnDestroy();
 
	$('#discounts-table tbody').html('');

	$.post('classes/discounts.class.php', {loadpage:1}, function(data) {
        var pageContent = data;
		$('#discounts-table tbody').html(pageContent);
        var oTable = $('#discounts-table').dataTable(settings);
	})
}

function clearForm() {
	$('#id').val('');
	$('#name').val('');
	$('#discount').val('');
    $('#price').val('');
    $('#promo_price').val('');
    $('#date_from').val('');
    $('#date_to').val('');
	
    $('#status0').prop('checked', false);
    $('#status1').prop('checked', true);
	
    $('#sign0').prop('checked', true);
    $('#sign1').prop('checked', false);
	$('#sign2').prop('checked', false);
    
	$('#search').prop('checked', false);
    
    $('#type0').prop('checked', true);
    $('#type1').prop('checked', false);
    $('#price_div').show();
    $('#discount_div').hide();    
}

function validateForm() {
    if ($('#name').val() == '')
        return false;
    if ($('#type').val() == '')
        return false;
    if (($("#type0").is(":checked") == false) && ($("#type1").is(":checked") == false))
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
	$.post('classes/discounts.class.php', {loadRecord:1, id:id}, function(data) {
        var record = JSON.parse(data);
        
		$('#id').val(record.id);
		$('#name').val(record.name);
		//$('#type').val(record.type);
		$('#discount').val(record.discount);
        $('#price').val(record.price);
        $('#promo_price').val(record.promo_price);
        $('#date_from').val(record.date_from);
        $('#date_to').val(record.date_to);

        $('#status'+record.status).prop('checked', true);
        $('#sign'+record.sign).prop('checked', true);
        $('#type'+record.type).prop('checked', true);
        $('#search').prop('checked', parseInt(record.search));
        discountsCost();
        
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
    
	var filedata = $('#discount-form').serialize();
	$.post('classes/discounts.class.php', filedata, function(data) {
		$('#modal-form').modal('hide');
		loadpage();
	});
}

function deleteRecord(id) {
    var result = confirm("Ви впевнені ? ");
    if (result) {
    	$.post('classes/discounts.class.php', {deleteRecord:1, id:id}, function(data) {
    	   loadpage();
    	})
    }
}

function setStatus(id, status) {
	$.post('classes/discounts.class.php', {setStatus:1, id:id, status: status}, function(data) {
	   
	})
}

function setSearch(id, search) {
	$.post('classes/discounts.class.php', {setSearch:1, id:id, search: search}, function(data) {
	   
	})
}