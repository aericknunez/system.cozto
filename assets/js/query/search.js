$(document).ready(function(){


 ///////////// llamar modal para eliminar elemento
    $("body").on("click","#xdelete",function(){ 
      
        $('#ConfirmDelete').modal('show');
    });

   
/// borrar factura
    $("body").on("click","#borrar-factura",function(){ 
        $('#ConfirmDelete').modal('hide');
        var op = "582";
        var dataString = 'op='+op;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#detallesf").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#detallesf").load('application/src/routes.php?op=580');
                $("#mensajef").load('application/src/routes.php?op=581');
            }
        }); 

    });






// lamar modal ticket
    $("body").on("click","#mticket",function(){ 
        $('#ModalTicket').modal('show');
        var op = "547";
        var dataString = 'op='+op;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#contenidomticket").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#contenidomticket").html(data); // lo que regresa de la busquea 
            }
        }); 

    });



    $("body").on("click","#opticket",function(){ // llamar nada mas a los productos

        var op = "551";
        var tipo = $(this).attr('tipo');
        var dataString = 'op='+op+'&tipo='+tipo;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            success: function(data) {            
                $('#ModalTicket').modal('hide');
                $("#vticket").html(data); // lo que regresa de la busquea 
                $("#detallesf").load('application/src/routes.php?op=580');
                $("#mensajef").load('application/src/routes.php?op=581');
            }
        }); 
    });
















}); // termina query