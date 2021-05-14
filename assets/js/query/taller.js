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


    $(document).ready(function() {
    $('.mdb-select').materialSelect();
    });



/// Nueva cuenta
	$("body").on("click","#addcliente",function(){ 
		
		$('#ModalAddCliente').modal('show');

	});
    

 /// add cuenta    
	$('#btn-cliente').click(function(e){ /// agregar un producto 
	e.preventDefault();

	$.ajax({
			url: "application/src/routes.php?op=600",
			method: "POST",
			data: $("#form-cliente").serialize(),
			beforeSend: function () {
				$('#btn-cliente').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
	           // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
			success: function(data){
				$('#btn-cliente').html('<i class="fas fa-save mr-1"></i> Guardar').removeClass('disabled');	      
				$("#form-cliente").trigger("reset");
				$("#contenido").html(data);	
				$('#ModalAddCuenta').modal('hide');
			}
		})
	});
    




/// llamar modal ver
	$("body").on("click","#xver",function(){ 

		$('#ModalVerCuenta').modal('show');
		$("#btn-ra").remove();
		
		var op = $(this).attr('op');
		var cuenta = $(this).attr('cuenta');
		var dataString = 'op='+op+'&cuenta='+cuenta;

		$.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#vista_ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#vista_ver").html(data); // lo que regresa de la busquea 		
            }
        });
		$("#cerrarver").before('<a href="?modal=abonos_cuentas&cuenta='+cuenta+'" id="btn-ra" class="btn btn-secondary btn-rounded">Realizar Abonos</a>');
	});
    


/// 
/// 
/// 
 







/// Nueva cuenta
	$("body").on("click","#addvehiculo",function(){ 
		
		$('#ModalAddVehiculo').modal('show');

	});
    







}); // termina query