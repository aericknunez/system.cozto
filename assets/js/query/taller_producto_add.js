$(document).ready(function(){

//// actualizar producto
// carga anos y modelos

function CargaAnios(){

    $("#modelosAgregados").load('application/src/routes.php?op=626'); // Modelos agregados
    $("#aniosAgregados").load('application/src/routes.php?op=631'); // anios agregados
    
    }
    
    
CargaAnios();



}); // termina query