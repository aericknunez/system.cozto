$(document).ready(function(){

 $("#key").focus(); // focus en el formulario busqueda
 $("#muestra-busqueda").hide();

// busqueda actualizar
	$("#key").keyup(function(){ /// para la caja de busqueda
		$.ajax({
		type: "POST",
		url: "application/src/routes.php?op=" + Btags(), // op=75 busqueda // 550 por tags
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
	});



    $('#btn-busqueda').click(function(e){ /// para que funcione la busqueda al dar enter
    e.preventDefault();
    
    $.ajax({
            url: "application/src/routes.php?op=58",
            method: "POST",
            data: $("#p-busqueda").serialize(),
            success: function(data){ 
                $("#contenido").html(data); // lo que regresa de la busquea 				
            }
        });
    $("#p-busqueda").trigger("reset"); 
    $("#muestra-busqueda").hide();
    });




//////// cancel 
	$("body").on("click","#cancel-p",function(){
		$("#muestra-busqueda").hide();
		$("#p-busqueda").trigger("reset"); 
	});

////////////////

	$("body").on("click","#select-p",function(){
	var key = $(this).attr('cod');
    	$.post("application/src/routes.php?op=58", {key:key}, 
    	function(data){
    		$("#muestra-busqueda").hide();
    		$("#contenido").html(data); // lo que regresa de la busquea 
		    $("#p-busqueda").trigger("reset");
   	 	});
	});



// switch de busqueda por tags
	$("body").on("click","#busquedaTags",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#busquedaTags').removeAttr("checked","checked");
			$('#key').attr("placeholder","Ingrese el nombre del producto");
		} 
		else {
			$('#busquedaTags').attr("checked","checked");
			$('#key').attr("placeholder","Ingrese palabras claves a buscar");
		}
	});

function Btags(){

		if($("#busquedaTags").attr('checked')){ // es por que estaba activo
			var opnum = '500';
		} 
		else {
			var opnum = '75';
		}

		return opnum;
}

/// switch


}); // termina query