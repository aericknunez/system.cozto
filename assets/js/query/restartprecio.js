$(document).ready(function(){

    $("#key").focus(); // focus en el formulario busqueda
    $("#muestra-busqueda").hide();
   


 // busqueda actualizar
 $("#producto-busqueda").keyup(function(){ /// para la caja de busqueda
    $.ajax({
    type: "POST",
    url: "application/src/routes.php?op=32",
    data:'keyword='+$(this).val(),
    beforeSend: function(){
        $("#muestra-busqueda").css("background","#FFF url(images/LoaderIcon.gif) no-repeat 165px");
    },
    success: function(data){
        $("#muestra-busqueda").show();
        $("#muestra-busqueda").html(data);
        $("#producto-busqueda").css("background","#FFF");
    }
    });
});


$("body").on("click","#select-p",function(){
    var cod = $(this).attr('cod');
    var descripcion = $(this).attr('descripcion');
    $("#muestra-busqueda").hide();
    window.location.href="?restartprecio&key=" + cod;
});




$("body").on("click","#cambiarprecio",function(){ 

    $('#ModalVer').modal('show');
    $('#iden').attr("value", $(this).attr('key'));

});



$('#btn-cambiaprecio').click(function(e){ /// agregar un producto 
	e.preventDefault();
    
	$.ajax({
			url: "application/src/routes.php?op=671",
			method: "POST",
			data: $("#form-cambiaprecio").serialize(),
			beforeSend: function () {
				$('#btn-cambiaprecio').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
            },
			success: function(data){
				$('#btn-cambiaprecio').html('Agregar Gasto').removeClass('disabled');	      
				$("#form-cambiaprecio").trigger("reset");
				// $("#contenido").html(data);	
                $("#precio_est_" + $("#iden").val()).html(data);
                // $('#iden').attr("value", $(this).attr('key'));

			}
		})
    
    
    $('#ModalVer').modal('hide');

	});



}); // termina query