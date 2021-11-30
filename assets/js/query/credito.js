$(document).ready(function(){

	$('#btn-abono').click(function(e){ /// agregar un producto 
	e.preventDefault();

	var credito = $("#credito").val();
	var factura = $("#factura").val();
	var tx = $("#tx").val();
	var orden = $("#orden").val();
	
	$.ajax({
			url: "application/src/routes.php?op=105",
			method: "POST",
			data: $("#form-abono").serialize(),
			beforeSend: function () {
				$('#btn-abono').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
	           // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
			success: function(data){
				$('#btn-abono').html('Agregar Abono').removeClass('disabled');	      
				$("#form-abono").trigger("reset");
				$("#contenido").html(data);	
				$("#data-abonos").load('application/src/routes.php?op=106&credito='+credito);
				$("#data-total").load('application/src/routes.php?op=107&credito='+credito+'&factura='+factura+'&tx='+tx+'&orden='+orden);				
			}
		})
	});
    




    $("body").on("click","#delabono",function(){
        var op = $(this).attr('op');
		var hash = $(this).attr('hash');
		var credito = $(this).attr('credito');
		var factura = $(this).attr('factura');
		var tx = $(this).attr('tx');
		var orden = $(this).attr('orden');
        var dataString = 'op='+op+'&hash='+hash+'&credito='+credito+'&orden='+orden;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#contenido").html(data); // lo que regresa de la busquea 
                $("#data-abonos").load('application/src/routes.php?op=106&credito='+credito);
				$("#data-total").load('application/src/routes.php?op=107&credito='+credito+'&factura='+factura+'&tx='+tx+'&orden='+orden);				
            }
        });
    });                 



/// llamar modal ver
	$("body").on("click","#xver",function(){ 
		
		$("#btn-ra").remove();
		$('#ModalVerCredito').modal('show');
		
		var factura = $(this).attr('factura');
		var credito = $(this).attr('credito');
		var orden = $(this).attr('orden');
		var tx = $(this).attr('tx');
		var op = $(this).attr('op');
		var dataString = 'op='+op+'&credito='+credito+'&orden='+orden+'&factura='+factura+'&tx='+tx;

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
		//$('#btn-modal').attr("valor",valor).attr("op",op).attr("hash",hash);
		$("#cerrarmodal").before('<a href="?modal=abonos&cre='+credito+'&orden='+orden+'&factura='+factura+'&tx='+tx+'" id="btn-ra" class="btn btn-secondary btn-rounded">Realizar Abonos</a>');
		
	});
    







/// llamar modal busqueda
	$("body").on("click","#busqueda",function(){ 
		
		$('#BuscadorCredito').modal('show');

	});
    

	function delay(callback, ms) {
		var timer = 0;
		return function() {
		  var context = this, args = arguments;
		  clearTimeout(timer);
		  timer = setTimeout(function () {
			callback.apply(context, args);
		  }, ms || 0);
		};
	  }
	  
	  
	  // Example usage:
	  
	  $('#key').keyup(delay(function (e) {
		$.ajax({
			type: "POST",
			url: "application/src/routes.php?op=110",
			data:'keyword='+$(this).val(),
			beforeSend: function(){
				$("#muestra-busqueda").css("background","#FFF url(assets/img/LoaderIcon.gif) no-repeat 550px");
			},
			success: function(data){
				$("#muestra-busqueda").show();
				$("#muestra-busqueda").html(data);
				$("#key").css("background","#FFF");
			}
			});
	  }, 700));

	  




//////// cancel 
	$("body").on("click","#cancel-p",function(){
		$("#muestra-busqueda").hide();
		$("#p-busqueda").trigger("reset"); 
	});

////////////////

	$("body").on("click","#select-p",function(){
	var op = $(this).attr('op');
	var cliente = $(this).attr('cliente');
    	$.post("application/src/routes.php", {op:op, cliente:cliente}, 
    	function(data){
    		$("#muestra-busqueda").hide();
    		$("#contenido").html(data); // lo que regresa de la busquea 
		    $("#p-busqueda").trigger("reset");
		    $('#BuscadorCredito').modal('hide');
   	 	});
	});






	$("body").on("click","#printAbono",function(){
        var op = $(this).attr('op');
		var hash = $(this).attr('hash');
        var dataString = 'op='+op+'&hash='+hash;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#printAbono").html('<i class="fas fa-sync fa-spin fa-lg green-text"></i>');
            },
            success: function(data) {            
                $("#msj").html(data); // lo que regresa de la busquea 
				$("#printAbono").html('<i class="fa fa-print fa-lg blue-text"></i>');				
            }
        });
    });  







	$("body").on("click","#delete",function(){
        var op = '136';
		var credito = $(this).attr('credito');
		var factura = $(this).attr('factura');
		var tx = $(this).attr('tx');
		var orden = $(this).attr('orden');
		var tipo = $(this).attr('tipo');
        var dataString = 'op='+op+'&tx='+tx+'&credito='+credito+'&orden='+orden+'&factura='+factura+'&tipo='+tipo;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#contenido").html(data); // lo que regresa de la busquea 			
            }
        });
    });                 










}); // termina query