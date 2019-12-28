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
 
	var oTable = $('#tickets-table').dataTable(settings);
	oTable.fnDestroy();
 
	$('#tickets-table tbody').html('');

	$.post('classes/tickets.class.php', {loadpage:1}, function(data) {
        var pageContent = data;
		$('#tickets-table tbody').html(pageContent);
        var oTable = $('#tickets-table').dataTable(settings);
	})
}

function deleteRecord(id) {
    var result = confirm("Ви впевнені ? ");
    if (result) {
    	$.post('classes/tickets.class.php', {deleteRecord:1, id:id}, function(data) {
    	   loadpage();
    	})
    }
}