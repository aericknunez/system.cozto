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
    

	$('#btn-repartidores').click(function(e){ /// historial de cortes
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=708",
			method: "POST",
			data: $("#form-repartidores").serialize(),
			beforeSend: function () {
				$('#btn-repartidores').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
	        },
			success: function(data){
				$('#btn-repartidores').html('Mostrar Datos').removeClass('disabled');	      
				$("#form-repartidores").trigger("reset");
				$("#contenido").html(data);	
			}
		})
	});




}); // termina query