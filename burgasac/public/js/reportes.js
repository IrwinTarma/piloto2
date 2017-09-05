var data = 'flag=pdf&fechafiltro='+$("#fechafiltro").val()+'&proveedorfiltro='+$("#proveedorfiltro").val()+'&productofiltro='+$("#productofiltro").val()+'&colorfiltro='+$("#colorfiltro").val();
$(document).ready(function(){
	$("#table-reporte").DataTable();
	$("#fechafiltro").datepicker({ format: 'yyyy-mm-dd'})
	    .on("show", function(e) {
	        return false;
	    }).on("hide", function(e) {
	        return false;
	    }).on("clearDate", function(e) {
	        return false;
	});

	$(".btn-download").click(function(){
		url+="?"+data;
		window.open(url, ",mywin", "left=20, top=20, width=900, height = 900, toolbar=no, directories=no, menubar=no, status=no, resizable=1");

	});
})