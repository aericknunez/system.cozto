$(document).ready(function(){



    function AddDetallesAutoParts(){
        $('#AddAutoParts').modal('show');

        var op = "520";
        var dataString = 'op='+op;
           
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
    }


    AddDetallesAutoParts();



    $("body").on("click","#cerrarDetalles",function(){  // este cierra el modal de agregar pro
        
        $('#AddAutoParts').modal('hide');
        $("#msj").load('application/src/routes.php?op=524');
        
    });


   $("body").on("click","#verModal",function(){  // es solo para ver el modal 
        AddDetallesAutoParts();
    });



    $("body").on("click","#selectmarca",function(){
       
        var op = $(this).attr('op');
        var marca = $(this).attr('marca');
        var dataString = 'op='+op+'&marca='+marca;
           
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
        })
    }); 



    $("body").on("click","#selectmodelo",function(){
       
        var op = $(this).attr('op');
        var modelo = $(this).attr('modelo');
        var dataString = 'op='+op+'&modelo='+modelo;
           
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
        })
    }); 


    $("body").on("click","#selectanio",function(){
       
        var op = $(this).attr('op');
        var anio = $(this).attr('anio');
        var dataString = 'op='+op+'&anio='+anio;
           
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
        })
    }); 



    $("body").on("click","#selectanio2",function(){
       
        var op = $(this).attr('op');
        var anio2 = $(this).attr('anio2');
        var dataString = 'op='+op+'&anio2='+anio2;
           
        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#vista").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#vista").html(data); // lo que regresa de la busquea 
                $('#AddAutoParts').modal('hide');
                $("#msj").load('application/src/routes.php?op=524');
            }
        })
    }); 



    $("body").on("click","#eliminardatos",function(){
       
        var op = $(this).attr('op');
        var dataString = 'op='+op;
           
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
        })
    }); 









}); // termina query