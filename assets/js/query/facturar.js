$(document).ready(function(){

	$('#btn-facturar').click(function(e){ /// agregar un producto 
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=85",
			method: "POST",
			data: $("#form-facturar").serialize(),
			beforeSend: function () {
			   $("#formularios").hide();
			   $("#btn-te").hide(); // esconde boton tarjeta y efectivo
               $("#resultado").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
			success: function(data){
				$("#form-facturar").trigger("reset");
				$("#formularios").hide();
				$("#btn-te").hide(); // esconde boton tarjeta y efectivo 
				$("#resultado").html(data);		
				$("#botones-imprimir").load('application/src/routes.php?op=120'); // caraga los botones / imprimir			
			}
		})
	});


}); // termina query