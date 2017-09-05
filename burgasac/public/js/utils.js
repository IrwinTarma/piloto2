$(".solo-enteros").numeric(false, 
  function() { 
    this.notify("Solo Enteros", "danger");this.value = ""; this.focus(); 
});
$(".decimales").numeric();

Web = {
  showloading: function(){
    $(".contenedor-spinner").css("display", "block");
  },
  hideloading: function(){
    $(".contenedor-spinner").css("display", "none");
  }

};
Mensaje = {
  alerta : function(mensaje) {
    swal(
      'Oops...',
      mensaje,
      'error'
    )
  },
  confirmacion: function(titulo, mensaje) {
  	swal(
		titulo,
		mensaje,
		'success'
	)
  },
  info: function (titulo, mensaje) {
    swal({
      title: titulo,
      type: 'info',
      html: mensaje
    })
  }
}