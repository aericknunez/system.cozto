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
           $("#btn-regresar").hide()
           $("#btn-te").hide(); // esconde boton tarjeta y efectivo 
           $("#link-to").addClass('disabled'); // esconde link para no regresar
           $("#resultado").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt="">Procesando venta por favor espere... </div>');
        },
        success: function(data){
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
$('#btn-facturar').click(function(e){ /// agregar un producto 
e.preventDefault();
$.ajax({
        url: "application/src/routes.php?op=85",
        method: "POST",
        data: $("#form-facturar").serialize(),
        beforeSend: function () {
           $("#formularios").hide();
           $("#btn-regresar").hide()
           $("#btn-te").hide(); // esconde boton tarjeta y efectivo 
           $("#link-to").addClass('disabled'); // esconde link para no regresar
           $("#botones-imprimir").html('<div class="row justify-content-center" >Procesando</div>');
           $("#resultado").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt="">Procesando venta por favor espere... </div>');
        },
        success: function(data){
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
            <?php if ($_SESSION["root_factura_electronica"] == "on") { ?>
                var json = datos;
                sendDTE(json);
                <? } else { ?>
                var json = $.parseJSON(datos);
                LoadImprimir(json);
            <? } ?>
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
            // $("#botones-imprimir").html('<div class="row justify-content-center" >Realizado!</div>');
            $("#botones-imprimir").html(data); // lo que regresa de la busquea         
        }
    });
   
}

function sendDTE(parametros){

    console.log("Datos: ", parametros)
    $.ajax({
        type: "POST",
        url: "https://api-connect.hibridosv.com/api/documents",
        data: parametros,
        dataType: 'json',
        contentType: "application/json",
        beforeSend: function () {
           $("#botones-imprimir").html('<div class="row justify-content-center" >Espere... </div>');
        },
        success: function(data) {            
            // $("#botones-imprimir").html('<div class="row justify-content-center" >Realizado!</div>');
            $("#botones-imprimir").html(data?.message ? data.message : data?.estado ? data.estado : "Error!"); // lo que regresa de la busquea        
            console.log("Retorno: ", data?.message)
        }
    });
   
}





</script>



<? } ?>
