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


	$('#btn-fecha').click(function(e){ /// para el formulario
		e.preventDefault();
		$.ajax({
			url: "application/src/routes.php?op=711",
			method: "POST",
			data: $("#form-fecha").serialize(),
			success: function(data){
				$("#contenido").html(data);
				$("#form-fecha").trigger("reset");
			}
		})
	})
	

    function cargaFecha(){
        $.ajax({
            url: "application/src/routes.php?op=712",
            method: "POST",
            success: function(data){
                $("#contenido").html(data);         
            }
        });
    }

    cargaFecha();
	

});