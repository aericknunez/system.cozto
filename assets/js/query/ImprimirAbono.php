<?php 

if($_SESSION["root_plataforma"] == 0){
 ?>
<script>

$("body").on("click","#printAbono",function(){
        var op = "135";
		var hash = $(this).attr('hash');
        var dataString = 'op='+op+'&hash='+hash;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#printAbono").html('<i class="fas fa-sync fa-spin fa-lg green-text"></i>');
            },
            success: function(data) {            
                $("#msj").html(data); // lo que regresa de la busquea 
				$("#printAbono").html('<i class="fa fa-print fa-lg blue-text"></i>');				
            }
        });
    });  


</script>


<?php } else {  /// si es version web
?>

<script>
    $("body").on("click","#printAbono",function(){ 
        var hash = $(this).attr('hash');
        LoadData(hash);
    });





function LoadData(hash){
    var dataString = 'hash='+hash;
    $.ajax({
        type: "POST",
        url: "application/src/routes.php?op=138", // verificar ruta
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
            $("#printAbono").html('<i class="fas fa-sync fa-spin fa-lg green-text"></i>');
        },
        success: function(data) {            
            $("#printAbono").html('<i class="fa fa-print fa-lg blue-text"></i>');
        }
    });
   
}




</script>



<? } ?>