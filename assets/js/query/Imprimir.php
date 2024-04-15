<?php 
/// el sistema es local no se hace mas que imprimir mandando el a llamar la funcion 120 de routes
/// pero si el sistema es web manda a que se ejecute a la ip del equipo donde esta instalada la impresora

if($_SESSION["root_plataforma"] == 0){
 ?>
<script>
/// imprimir factura
    $("body").on("click","#imprimir",function(){ 
        var op = "583";
        var orden = $(this).attr('orden');
        var dataString = 'op='+op+'&orden='+orden;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
                $("#detallesf").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#detallesf").load('application/src/routes.php?op=580');
                $("#msjreload").html(data);
            }
        }); 

    });


</script>


<?php } else {  /// si es version web
?>

<script>
    $("body").on("click","#imprimir",function(){ 
        var orden = $(this).attr('orden');
        LoadData(orden);
    });





function LoadData(orden){
    var dataString = 'orden='+orden;
    $.ajax({
        type: "POST",
        url: "application/src/routes.php?op=584",
        data: dataString,
        datatype: 'json',
        success: function(data) {  
            var datos = data;  
            var json = $.parseJSON(datos);
            // console.log(json);        
            LoadImprimir(json);
        }
    });
}



function LoadImprimir(parametros){
    $.ajax({
        type: "POST",
        url: "http://localhost/impresiones/index.php",
        data: parametros,
        datatype: 'json',
        beforeSend: function () {
           $("#msjreload").html('<div class="row justify-content-center" >Espere... </div>');
        },
        success: function(data) {            
            $("#msjreload").html(data); // lo que regresa de la busquea         
        }
    });
   
}




</script>



<? } ?>