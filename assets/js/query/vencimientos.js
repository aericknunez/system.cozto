$(document).ready(function(){



function CargarDatos(){

        var op = "57";
        var dataString = 'op='+op;


        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#CargaContenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
                $("#MensajeCarga").addClass("visible");
                $("#MensajeCarga").removeClass("invisible"); 
            },
            success: function(data) {            
                $("#CargaContenido").html(data); // lo que regresa de la busquea 
                $("#MensajeCarga").removeClass("visible");
                $("#MensajeCarga").addClass("invisible");
            }
        });
                
}

CargarDatos();






}); // termina query