<?php 
/// el sistema es local no se hace mas que imprimir mandando el a llamar la funcion 120 de routes
/// pero si el sistema es web manda a que se ejecute a la ip del equipo donde esta instalada la impresora

if($_SESSION["root_plataforma"] == 0){
 ?>
<script>

function advertenciaAntesDeSalir(event) {
    event.preventDefault();
    event.returnValue = "¿Estás seguro de que quieres salir de esta página?";
}

$('#btn-facturar').click(function(e){ /// agregar un producto 
e.preventDefault();
$.ajax({
        url: "application/src/routes.php?op=85",
        method: "POST",
        data: $("#form-facturar").serialize(),
        beforeSend: function () {
 // Agregar el evento beforeunload usando la función definida
 window.addEventListener("beforeunload", advertenciaAntesDeSalir);

           $("#formularios").hide();
           $("#btn-regresar").hide()
           $("#btn-te").hide(); // esconde boton tarjeta y efectivo 
           $("#link-to").addClass('disabled'); // esconde link para no regresar
           $("#resultado").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt="">Procesando venta por favor espere...</div>');
        },
        success: function(data){
            // Eliminar el evento beforeunload usando la misma función definida
            window.removeEventListener("beforeunload", advertenciaAntesDeSalir);

            $("#formularios").hide();
            $("#btn-regresar").show()
            $("#btn-te").hide(); // esconde boton tarjeta y efectivo
            $("#link-to").removeClass('disabled'); // muestr link para  regresar
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
    function advertenciaAntesDeSalir(event) {
    event.preventDefault();
    event.returnValue = "¿Estás seguro de que quieres salir de esta página?";
}
$('#btn-facturar').click(function(e){ /// agregar un producto 
e.preventDefault();
$.ajax({
        url: "application/src/routes.php?op=85",
        method: "POST",
        data: $("#form-facturar").serialize(),
        beforeSend: function () {
            window.addEventListener("beforeunload", advertenciaAntesDeSalir);
           $("#formularios").hide();
           $("#btn-regresar").hide()
           $("#btn-te").hide(); // esconde boton tarjeta y efectivo 
           $("#link-to").addClass('disabled'); // esconde link para no regresar
           $("#botones-imprimir").html('<div class="row justify-content-center" >Imprimiendo</div>');
           $("#resultado").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt="">Procesando venta por favor espere... </div>');
        },
        success: function(data){
            window.removeEventListener("beforeunload", advertenciaAntesDeSalir);
            $("#form-facturar").trigger("reset");
            $("#formularios").hide();
            $("#btn-regresar").show()
            $("#btn-te").hide(); // esconde boton tarjeta y efectivo
            $("#link-to").removeClass('disabled'); // muestr link para  regresar
            $("#resultado").html(data);     

            <?php
            if($_SESSION["td"] == 10){
            ?>
            $("#botones-imprimir").load('application/src/routes.php?op=120');
            <?
            } else {
            ?>
            LoadData();   
            <?php } ?>
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
        url: "http://localhost/impresiones/index.php",
        data: parametros,
        datatype: 'json',
        beforeSend: function () {
           $("#botones-imprimir").html('<div class="row justify-content-center" >Espere... </div>');
        },
        success: function(data) {            
            $("#botones-imprimir").html('<div class="row justify-content-center" >Realizado!</div>');
            // $("#botones-imprimir").html(data); // lo que regresa de la busquea         
        }
    });
   
}




</script>



<? } ?>