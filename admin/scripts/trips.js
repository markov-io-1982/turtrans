$(document).ready(function () {
    loadpage();
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
 
	var oTable = $('#trips-table').dataTable(settings);
	oTable.fnDestroy();
 
	$('#trips-table tbody').html('');

	$.post('classes/trips.class.php', {loadpage:1}, function(data) {
        var pageContent = data;
		$('#trips-table tbody').html(pageContent);
        var oTable = $('#trips-table').dataTable(settings);
	})
}


function loadDiscounts(id) {
    $('#discounts-table tbody').html('');
	$.post('classes/trips.class.php', {loadDiscounts:1, id:id}, function(data) {
        var pageContent = data;
        $('#discounts-table tbody').html(pageContent);
	})

}

function deleteRecord(id) {
    var result = confirm("Ви впевнені ? ");
    if (result) {
    	$.post('classes/trips.class.php', {deleteRecord:1, id:id}, function(data) {
    	   loadpage();
    	})
    }
}

function setStatus(id, status) {
	$.post('classes/trips.class.php', {setStatus:1, id:id, status: status}, function(data) {
	   
	})
}