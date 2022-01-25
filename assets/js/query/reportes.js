$(document).ready(function()
{

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



	$('#btn-ventadetalles').click(function(e){ /// historial de cortes
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=200",
			method: "POST",
			data: $("#form-ventadetalles").serialize(),
			beforeSend: function () {
				$('#btn-ventadetalles').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
	        },
			success: function(data){
				$('#btn-ventadetalles').html('Mostrar Datos').removeClass('disabled');	      
				$("#form-ventadetalles").trigger("reset");
				$("#contenido").html(data);	
			}
		})
	});




	$('#btn-vantaagrupado').click(function(e){ /// historial de cortes
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=201",
			method: "POST",
			data: $("#form-vantaagrupado").serialize(),
			beforeSend: function () {
				$('#btn-vantaagrupado').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
	        },
			success: function(data){
				$('#btn-vantaagrupado').html('Mostrar Datos').removeClass('disabled');	      
				$("#form-vantaagrupado").trigger("reset");
				$("#contenido").html(data);	
			}
		})
	});



	$('#btn-gastodetallado').click(function(e){ /// historial de cortes
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=202",
			method: "POST",
			data: $("#form-gastodetallado").serialize(),
			beforeSend: function () {
				$('#btn-gastodetallado').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
	        },
			success: function(data){
				$('#btn-gastodetallado').html('Mostrar Datos').removeClass('disabled');	      
				$("#form-gastodetallado").trigger("reset");
				$("#contenido").html(data);	
			}
		})
	});




	$('#btn-ingresos').click(function(e){ /// ingresos detallados
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=203",
			method: "POST",
			data: $("#form-ingresos").serialize(),
			beforeSend: function () {
				$('#btn-ingresos').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
	        },
			success: function(data){
				$('#btn-ingresos').html('Mostrar Datos').removeClass('disabled');	      
				$("#form-ingresos").trigger("reset");
				$("#contenido").html(data);	
			}
		})
	});



	$('#btn-averias').click(function(e){ /// averias detallados
		e.preventDefault();
		$.ajax({
				url: "application/src/routes.php?op=204",
				method: "POST",
				data: $("#form-averias").serialize(),
				beforeSend: function () {
					$('#btn-averias').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
				},
				success: function(data){
					$('#btn-averias').html('Mostrar Datos').removeClass('disabled');	      
					$("#form-averias").trigger("reset");
					$("#contenido").html(data);	
				}
			})
		});
	
	
	











});