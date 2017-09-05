
$(document).ready(function(e){
	$("#fecha").datepicker({ format: 'yyyy-mm-dd'})
        .on("show", function(e) {
            return false;
        }).on("hide", function(e) {
            return false;
        }).on("clearDate", function(e) {
            return false;
    });
});