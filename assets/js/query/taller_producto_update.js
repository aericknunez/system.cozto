$(document).ready(function(){

//// actualizar producto
// carga anos y modelos


function CargaAniosUp(){

    var dataString = 'op=640';
           
    $.ajax({
        type: "POST",
        url: "application/src/routes.php",
        data: dataString,
        success: function(data) {            
            $("#modelosAgregados").load('application/src/routes.php?op=626'); // Modelos agregados
            $("#aniosAgregados").load('application/src/routes.php?op=631'); // anios agregados
        }
    })

}


CargaAniosUp();














}); // termina query