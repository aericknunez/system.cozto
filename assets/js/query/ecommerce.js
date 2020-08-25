$(document).ready(function()
{

/// llamar modal ver
    $("body").on("click","#xver",function(){ 
        
        $('#ModalVer').modal('show');
        
        var orden = $(this).attr('orden');
        var op = $(this).attr('op');
        var dataString = 'op='+op+'&orden='+orden;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#vista").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#vista").html(data); // lo que regresa de la busquea         
            }
        });
        
    });






    $("body").on("click","#op-edo",function(){ 
        
        $('#ModalEstado').modal('show');
        $('#btn-cambiaedo').show();  
        
        var orden = $(this).attr('orden');
        var user = $(this).attr('user');
        var op = "377";
        var dataString = 'op='+op+'&orden='+orden+'&user='+user;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#vistaestado").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#vistaestado").html(data); // lo que regresa de la busquea    
                $('#btn-cambiaedo').attr("orden", orden).attr("user", user);     
            }
        });
        
    });





    $('#btn-cambiaedo').click(function(e){ /// para el formulario

        $('#btn-cambiaedo').hide();
        var user = $(this).attr('user');
        var orden = $(this).attr('orden');

    e.preventDefault();
    $.ajax({
            url: "application/src/routes.php?op=378",
            method: "POST",
            data: $("#form-cambiaedo").serialize(),
            beforeSend: function () {
                $("#vistaestado").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data){
                $("#form-cambiaedo").trigger("reset");
                $("#vistaestado").html(data);  
                $('#ModalEstado').modal('hide'); 
                $("#"+orden+""+user).load('application/src/routes.php?op=379&orden='+orden+'&user='+user);
                $("#btn"+orden+""+user).load('application/src/routes.php?op=380&orden='+orden+'&user='+user);      
            }
        })
    })




    $("body").on("click","#facturar",function(){ // quita descuento
        var op = $(this).attr('op');
        var orden = $(this).attr('orden');
        var user = $(this).attr('user');
        var dataString = 'op='+op+'&orden='+orden+'&user='+user;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                 window.location.href="?";
                 // $("#contenido").html(data);
            }
        });
    });     











});  // fin del jquery