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
		var cod = $(this).attr('cod');
		var descripcion = $(this).attr('descripcion');
		$("#muestra-agregar-busqueda").hide();
		window.location.href="?estadistica_costos&key=" + cod;
	});





}); // termina query