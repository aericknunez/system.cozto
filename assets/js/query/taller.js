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
 







/// Nueva vehiculo
	$("body").on("click","#addvehiculo",function(){ 
		
		$('#ModalAddVehiculo').modal('show');

	});
    

 /// add vehiculo    
	$('#btn-vehiculo').click(function(e){ /// agregar un producto 
	e.preventDefault();

	$.ajax({
			url: "application/src/routes.php?op=602",
			method: "POST",
			data: $("#form-vehiculo").serialize(),
			beforeSend: function () {
				$('#btn-vehiculo').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
	           // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
			success: function(data){
				$('#btn-vehiculo').html('<i class="fas fa-save mr-1"></i> Guardar').removeClass('disabled');	      
				$("#form-vehiculo").trigger("reset");
				$("#contenido").html(data);	
				$('#ModalAddVehiculo').modal('hide');
			}
		})
	});
    


/// cambia el tipo de cliente y muestra detalles
    $("#cliente").change(function(){
        var hash=$(this).val();
        var dataString = 'hash='+ hash;
    
        $.ajax ({
            type: "POST",
            url: "application/src/routes.php?op=604",
            data: dataString,
            cache: false,
            success: function(html) {
                $("#datos_cliente").html(html);
            } 
        });
    });



// moestra el modelo al cambiar la marca
    $("#marca").change(function(){
        var hash=$(this).val();
        var dataString = 'hash='+ hash;
    
        $.ajax ({
            type: "POST",
            url: "application/src/routes.php?op=605",
            data: dataString,
            cache: false,
            success: function(html) {
                $("#modelo").html(html);
            } 
        });
    });













/// Nueva vehiculo
	$("body").on("click","#addmantenimiento",function(){ 
		
		$('#ModalAddMantenimiento').modal('show');

	});



// obtiene datos del vehiculo
    $("#vehiculo").change(function(){
        var hash=$(this).val();
        var dataString = 'hash='+ hash;
    
        $.ajax ({
            type: "POST",
            url: "application/src/routes.php?op=606",
            data: dataString,
            cache: false,
            success: function(html) {
                $("#datos_src").html(html);
            } 
        });
    });













}); // termina query