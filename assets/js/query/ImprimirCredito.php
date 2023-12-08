<?php 

if($_SESSION["root_plataforma"] == 0){
 ?>
<script>
/// imprimir factura
    $("body").on("click","#imprimir",function(){ 
        var op = "587";
        var dataString = 'op='+op;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            success: function(data) {            
                $("#msj").html(data);
            }
        }); 

    });


</script>


<?php } else {  /// si es version web
?>

<script>
    $("body").on("click","#imprimir",function(){ 
        var orden = $(this).attr('orden');
        var factura = $(this).attr('factura');
        LoadData(orden, factura);
    });





function LoadData(orden, factura){
    var dataString = 'orden='+orden+'&factura='+factura;
    $.ajax({
        type: "POST",
        url: "application/src/routes.php?op=588",
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
           $("#msj").html('<div class="row justify-content-center" >Espere... </div>');
        },
        success: function(data) {            
            $("#msj").html(data); // lo que regresa de la busquea         
        }
    });
   
}




</script>



<? } ?>