$(document).ready(function(){

    $("body").on("click","#buscarComentatarios",function(){ 
        
        $('#BuscadorComentarios').modal('show');

    });


    $('#btn-busqueda').click(function(e){ /// historial de cortes
        e.preventDefault();
        $.ajax({
                url: "application/src/routes.php?op=211",
                method: "POST",
                data: $("#form-busqueda").serialize(),
                beforeSend: function () {
                    $('#btn-busqueda').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
                },
                success: function(data){
                    $('#btn-busqueda').html('Mostrar Datos').removeClass('disabled');	      
                    $("#form-busqueda").trigger("reset");
                    $("#contenido").html(data);	
                    $('#BuscadorComentarios').modal('hide');
                }
            })
        });
    




















}); // termina query