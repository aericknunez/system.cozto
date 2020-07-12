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


	$('#btn-addcliente').click(function(e){ /// para el formulario
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=64",
			method: "POST",
			data: $("#form-addcliente").serialize(),
			success: function(data){
				$("#form-addcliente").trigger("reset");
				$("#destinocliente").html(data);			

			}
		})
	})
    


	$("#form-addcliente").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
	if (e.which == 13) {
	return false;
	}
	});



	$("body").on("click","#delcliente",function(){ // borrar categoria
	var op = $(this).attr('op');
	var hash = $(this).attr('hash');
	    $.post("application/src/routes.php", {op:op, hash:hash}, function(data){
		$("#destinocliente").html(data);
		$('#ConfirmDelete').modal('hide');
	   	 });
	});


////////////////
	$('#btn-editcliente').click(function(e){ /// actualizar proveedor
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=67",
			method: "POST",
			data: $("#form-editcliente").serialize(),
			success: function(data){
				$("#form-editcliente").trigger("reset");
				$("#destinocliente").html(data);			
			}
		})
	})
    



	$("#form-editcliente").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
	if (e.which == 13) {
	return false;
	}
	});



/// llamar modal ver
	$("body").on("click","#xver",function(){ 
		
		$('#ModalVerCliente').modal('show');
		
		var key = $(this).attr('key');
		var op = $(this).attr('op');
		var dataString = 'op='+op+'&key='+key;

		$.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#vista").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#vista").html(data); // lo que regresa de la busquea 		
            }
        });

		$('#btn-pro').attr("href",'?modal=editcliente&key='+key);
		
	});



///////////// llamar modal para eliminar elemento
	$("body").on("click","#xdelete",function(){ 
		
		var op = $(this).attr('op');
		var hash = $(this).attr('hash');
		
		$('#delcliente').attr("op",op).attr("hash",hash);
		$('#ConfirmDelete').modal('show');
	});





/// llamar modal ver factura
	$("body").on("click","#xverfactura",function(){ 
		
		$('#ModalVerCliente').modal('show');
		
		var factura = $(this).attr('factura');
		var tx = $(this).attr('tx');
		var op = $(this).attr('op');
		var dataString = 'op='+op+'&factura='+factura+'&tx='+tx;

		$.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#vista").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#vista").html(data); // lo que regresa de la busquea 		
            }
        });
	});






}); // termina query