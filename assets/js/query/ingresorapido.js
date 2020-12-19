$(document).ready(function(){

$('.datepicker').pickadate({
  weekdaysShort: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
  weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
  monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre',
  'Noviembre', 'Diciembre'],
  monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct',
  'Nov', 'Dic'],
  showMonthsShort: true,
  formatSubmit: 'dd-mm-yyyy',
  close: 'Cancelar',
  clear: 'Limpiar',
  today: 'Hoy'
})


$('.mdb-select').materialSelect();
    


	$('#btn-proadd').click(function(e){ /// agregar un producto 
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=560",
			method: "POST",
			data: $("#form-proadd").serialize(),
			beforeSend: function () {
				$('#btn-proadd').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
	           // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
			success: function(data){
				$('#btn-proadd').html('<i class="fas fa-save mr-1"></i> GUARDAR PRODUCTO').removeClass('disabled');	      
				$("#form-proadd").trigger("reset");
				$("#ultimosproductos").html(data);	
			}
		})
	});
    


$("#form-proadd").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
if (e.which == 13) {
return false;
}
});











}); // termina query