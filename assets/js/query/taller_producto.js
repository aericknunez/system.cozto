$(document).ready(function(){

    $("body").on("click","#AddOpcionesTaller",function(){
       
       $('#AddTaller').modal('show');

        var op = $(this).attr('op');
        var dataString = 'op='+op;
           
        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#vistataller").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#vistataller").html(data); // lo que regresa de la busquea
                $("#vistataller_detalles").load('application/src/routes.php?op=632'); // carga modelos y anios
                $("#modelosAgregados").load('application/src/routes.php?op=626'); // Modelos agregados
                $("#aniosAgregados").load('application/src/routes.php?op=631'); // anios agregados
            }
        })
    }); 




    $("body").on("click","#select",function(){
       
        var op = $(this).attr('op');
        var hash = $(this).attr('hash');
        var dataString = 'op='+op+'&hash='+hash;
           
        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#vistataller_detalles").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
               $("#modelosAgregados").html('<div class="row justify-content-center" ><img src="assets/img/LoaderIcon.gif" alt=""></div>');
               $("#aniosAgregados").html('<div class="row justify-content-center" ><img src="assets/img/LoaderIcon.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#vistataller_detalles").html(data); // lo que regresa de la busquea 
                $("#modelosAgregados").load('application/src/routes.php?op=626'); // Modelos agregados
                $("#aniosAgregados").load('application/src/routes.php?op=631'); // anios agregados
            }
        })
    }); 


    $("body").on("click","#cerrarModal",function(){    
       $('#AddTaller').modal('hide');
    }); 










function Selecciona(op, hash) {

        var dataString = 'op='+op+'&hash='+hash;
           
        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#contenido").html(data); // lo que regresa de la busquea 
            }
        })
}


$("#modelos").change(function(){
    var modelos=$(this).val();
    Selecciona(633, modelos);   
});

$("#anio").change(function(){
    var anio=$(this).val();
    Selecciona(634, anio); 
});

$("#medida").keyup(function(){ /// para la caja de busqueda
    var valor=$(this).val();
    Selecciona(635, valor); 
});

$("#key").keyup(function(){ /// para la caja de busqueda
    var valor=$(this).val();
    Selecciona(636, valor); 
});

$("body").on("click","#deleteAll",function(){
   
    var dataString = 'op=637';
       
    $.ajax({
        type: "POST",
        url: "application/src/routes.php",
        data: dataString,
        beforeSend: function () {
           $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
        },
        success: function(data) {            
            $("#contenido").html(data); // lo que regresa de la busquea 
        }
    })
}); 







}); // termina query