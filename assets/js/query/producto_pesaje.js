$(document).ready(function(){


 $("#key").focus(); // focus en el formulario busqueda
 $("#muestra-busqueda").hide();

// busqueda actualizar
	$("#key").keyup(function(){ /// para la caja de busqueda
		$.ajax({
		type: "POST",
		url: "application/src/routes.php?op=75", 
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			// $("#muestra-busqueda").css("background","#FFF url(assets/img/LoaderIcon.gif) no-repeat 550px");
		},
		success: function(data){
			$("#muestra-busqueda").show();
			$("#muestra-busqueda").html(data);
			$("#key").css("background","#FFF");
		}
		});
	});


    $('#btn-busqueda').click(function(e){ /// para que funcione la busqueda al dar enter
    e.preventDefault();
   
    $.ajax({
            url: "application/src/routes.php?op=425",
            method: "POST",
            data: $("#p-busqueda").serialize(),
            success: function(data){ 
                $("#retorno").html(data); // lo que regresa de la busquea 	
                $("#btn-registrar").removeClass('invisible').addClass('visible');			
            }
        });
    $("#p-busqueda").trigger("reset"); 
    $("#muestra-busqueda").hide();
    $("#retorno").show();
    $("#contenido").hide();

    
    $("#key").focusout();
    $("#peso").focus();
    
    });




//////// cancel 
	$("body").on("click","#cancel-p",function(){
		$("#muestra-busqueda").hide();
		$("#p-busqueda").trigger("reset"); 
		$("#btn-registrar").removeClass('visible').addClass('invisible');
		$("#retorno").hide();
	});

////////////////

	$("body").on("click","#select-p",function(){
	var key = $(this).attr('cod');
    	$.post("application/src/routes.php?op=425", {key:key}, 
    	function(data){
    		$("#muestra-busqueda").hide();
    		$("#retorno").html(data); // lo que regresa de la busquea 
		    $("#p-busqueda").trigger("reset");
		    $("#btn-registrar").removeClass('invisible').addClass('visible');	    
   	 	});

   	 	$("#peso").focus();
   	 	$("#retorno").show();
   	 	$("#contenido").hide();
	});






	$('#btn-registrar').click(function(e){ /// agregar un producto 
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=426",
			method: "POST",
			data: $("#form-registrar").serialize(),
			beforeSend: function () {
				$('#btn-registrar').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
	           // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
			success: function(data){
				$('#btn-registrar').html('<i class="fas fa-save mr-1"></i> Guardar Peso').removeClass('disabled');	      
				$("#form-registrar").trigger("reset");
				 $("#contenido").show();
				$("#contenido").html(data);	
				$("#btn-registrar").removeClass('visible').addClass('invisible');
			}
		});

		$("#retorno").hide();
	});







}); // termina query

