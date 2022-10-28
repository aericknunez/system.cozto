$(document).ready(function(){

// busqueda actualizar
	$("#producto-agregar-busqueda").keyup(function(){ /// para la caja de busqueda
		$.ajax({
		type: "POST",
		url: "application/src/routes.php?op=50",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#muestra-agregar-busqueda").css("background","#FFF url(images/LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#muestra-agregar-busqueda").show();
			$("#muestra-agregar-busqueda").html(data);
			$("#producto-agregar-busqueda").css("background","#FFF");
		}
		});
	});


	$("body").on("click","#select-agrega",function(){
		$("#muestra-agregar-busqueda").hide();
		var cod = $(this).attr('cod');
        var op = "710";
        var dataString = 'op='+op+'&cod='+cod;
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