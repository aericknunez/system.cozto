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



	$('#btn-reportef').click(function(e){ /// historial de cortes
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=210",
			method: "POST",
			data: $("#form-reportef").serialize(),
			beforeSend: function () {
				$('#btn-reportef').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
	        },
			success: function(data){
				$('#btn-reportef').html('Mostrar Datos').removeClass('disabled');	      
				$("#form-reportef").trigger("reset");
				$("#contenido").html(data);	
			}
		})
	});























}); // termina query