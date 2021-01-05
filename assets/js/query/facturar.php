<?php 
/// el sistema es local no se hace mas que imprimir mandando el a llamar la funcion 120 de routes
/// pero si el sistema es web manda a que se ejecute a la ip del equipo donde esta instalada la impresora

if($_SESSION["root_plataforma"] == 0){
 ?>
<script>
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
            $("#formularios").hide();
            $("#btn-te").hide(); // esconde boton tarjeta y efectivo
            $("#form-facturar").trigger("reset");
            $("#resultado").html(data);     
            $("#botones-imprimir").load('application/src/routes.php?op=120'); // caraga los botones / imprimir          
        }
    })
});
</script>


<?php } else {  /// si es version web


if(isset($_SESSION["orden"])){
    $_SESSION["orden_print"] = $_SESSION["orden"];
}?>

<script>
$('#btn-facturar').click(function(e){ /// agregar un producto 
e.preventDefault();
$.ajax({
        url: "application/src/routes.php?op=85",
        method: "POST",
        data: $("#form-facturar").serialize(),
        beforeSend: function () {
           $("#formularios").hide();
           $("#btn-te").hide(); // esconde boton tarjeta y efectivo 
           $("#botones-imprimir").html('<div class="row justify-content-center" >Imprimiendo</div>');
           $("#resultado").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
        },
        success: function(data){
            $("#form-facturar").trigger("reset");
            $("#formularios").hide();
            $("#btn-te").hide(); // esconde boton tarjeta y efectivo
            $("#resultado").html(data);     

            LoadData();   
        }
    })

});




function LoadData(){
    $.ajax({
        type: "POST",
        url: "application/src/routes.php?op=546",
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
        url: "http://192.168.1.47/impresion/prueba.php",
        data: parametros,
        datatype: 'json',
        beforeSend: function () {
           $("#botones-imprimir").html('<div class="row justify-content-center" >Espere... </div>');
        },
        success: function(data) {            
            $("#botones-imprimir").html(data); // lo que regresa de la busquea         
        }
    });
   
}




</script>



<? } ?>