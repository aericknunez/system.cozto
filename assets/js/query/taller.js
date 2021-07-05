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
	$("body").on("click","#detalles",function(){ 
		
		$('#ModalVerDetalles').modal('show');
		
		var key = $(this).attr('key');
		var op = $(this).attr('op');
		var dataString = 'op='+op+'&key='+key;

		$.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#vista_detalles").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#vista_detalles").html(data); // lo que regresa de la busquea 		
            }
        });

		$('#btn-pro').attr("href",'?modal=edit_'+$(this).attr('ref')+'_taller&key='+key);
		
	});






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


 /// add mantenimiento    
	$('#btn-mantenimiento').click(function(e){ /// agregar un producto 
	e.preventDefault();

	$.ajax({
			url: "application/src/routes.php?op=608",
			method: "POST",
			data: $("#form-mantenimiento").serialize(),
			beforeSend: function () {
				$('#btn-mantenimiento').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
	           // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
			success: function(data){
				$('#btn-mantenimiento').html('<i class="fas fa-save mr-1"></i> Guardar Ingreso').removeClass('disabled');	      
				$("#form-mantenimiento").trigger("reset");
				$("#contenido").html(data);	
				$('#ModalAddMantenimiento').modal('hide');
			}
		})
	});
    





/// llamar modal ver
	$("body").on("click","#xver",function(){ 

		$('#ModalVer').modal('show');

		var op = $(this).attr('op');
		var hash = $(this).attr('hash');
		var dataString = 'op='+op+'&hash='+hash;

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
	});
    




	$("body").on("click","#edit",function(){ 
		
		$('#ModalEditor').modal('show');
		$('#tipo').attr("value",$(this).attr('tipo'));
		$('#hash').attr("value",$(this).attr('hash'));

		var hash = $(this).attr('hash');
		var tipo = $(this).attr('tipo');
		var dataString = 'tipo='+tipo+'&hash='+hash;

		$.ajax({
            type: "POST",
            url: "application/src/routes.php?op=611",
            data: dataString,
            beforeSend: function () {
               $("#texto").val('Cargando... Espere!');
            },
            success: function(data) {    
            	$('#texto').val(data);        
                // $("#vista_ver").html(data); // lo que regresa de la busquea 		
            }
        });

	});


	$('#btn-editor').click(function(e){ /// agregar un producto 
	e.preventDefault();

	$.ajax({
			url: "application/src/routes.php?op=610",
			method: "POST",
			data: $("#form-editor").serialize(),
			beforeSend: function () {
				$('#btn-editor').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
	           // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
			success: function(data){
				$('#btn-editor').html('<i class="fas fa-save mr-1"></i> Guardar Cambios ').removeClass('disabled');	      
				$("#form-editor").trigger("reset");
				$("#vista_ver").html(data);	
				$('#ModalEditor').modal('hide');
			}
		})
	});




	$("body").on("click","#estado",function(){ 
		
		var hash = $(this).attr('hash');
		var edo = $(this).attr('edo');
		var dataString = 'edo='+edo+'&hash='+hash;

		$.ajax({
            type: "POST",
            url: "application/src/routes.php?op=612",
            data: dataString,
            beforeSend: function () {
               $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {         
                $("#contenido").html(data); // lo que regresa de la busquea 		
            }
        });

	});


	$("body").on("click","#cestado",function(){ 
		
		$('#ModalEstadoDel').modal('show');
		$('#competado').attr("hash",$(this).attr('hash'));
		$('#competado').attr("edo",'2');

	});


	$("body").on("click","#competado",function(){ 
		
		var hash = $(this).attr('hash');
		var edo = $(this).attr('edo');
		var dataString = 'edo='+edo+'&hash='+hash;

		$.ajax({
            type: "POST",
            url: "application/src/routes.php?op=612",
            data: dataString,
            beforeSend: function () {
               $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {         
                $("#contenido").html(data); // lo que regresa de la busquea 
                $('#ModalEstadoDel').modal('hide');		
            }
        });

	});




















//// agregar cliente a factura

    $("#cliente-busquedaA").keyup(function(){ /// para la caja de busqueda
        $.ajax({
        type: "POST",
        url: "application/src/routes.php?op=617",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            $("#muestra-busquedaA").css("background","#FFF url(assets/img/LoaderIcon.gif) no-repeat 550px");
        },
        success: function(data){
            $("#muestra-busquedaA").show();
            $("#muestra-busquedaA").html(data);
            $("#cliente-busquedaA").css("background","#FFF");
        }
        });
    });


////////////////

    $("body").on("click","#select-cli",function(){
    var hash = $(this).attr('hash');
    var nombre = $(this).attr('nombre');
        $.post("application/src/routes.php?op=618", {hash:hash, nombre:nombre}, 
        function(data){
            $("#muestra-busquedaA").hide();
            $("#ver").html(data); // lo que regresa de la busquea 
            $("#c-busquedaA").trigger("reset"); // no funciona
        });
    });


    $("body").on("click","#quitar-clienteA",function(){ // quita descuento
        var op = $(this).attr('op');
        var dataString = 'op='+op;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#ver").html(data); // lo que regresa de la busquea 
            }
        });
    });                 






}); // termina query