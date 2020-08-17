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


   $("body").on("click","#verModal",function(){  // es solo para ver el modal 
        $('#AddAutoParts').modal('show');
    });



    $("body").on("click","#cerrarDetalles",function(){  // este cierra el modal de agregar pro
        
        $('#AddAutoParts').modal('hide');
        $("#msj").load('application/src/routes.php?op=528');
        
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



    $("body").on("click","#selectmotor",function(){
       
        var op = $(this).attr('op');
        var motor = $(this).attr('motor');
        var dataString = 'op='+op+'&motor='+motor;
           
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
                VerTodosLosProductos();

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
                VerTodosLosProductos();
            }
        })
    }); 





    function VerTodosLosProductos(){
        var op = "527";
        var dataString = 'op='+op;
           
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
        });
    }

////////////////////////////////



VerTodosLosProductos();






/// llamar modal ver
    $("body").on("click","#xver",function(){ 
        
        $('#ModalVer').modal('show');
        
        var key = $(this).attr('key');
        var op = $(this).attr('op');
        var dataString = 'op='+op+'&key='+key;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#vista-producto").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#vista-producto").html(data); // lo que regresa de la busquea         
            }
        });

        $('#btn-pro').attr("href",'?proup&key='+key);
       
        VerImagenes(key);
        
    });

function VerImagenes(key){ // extrae las imagenes del producto
        $.ajax({
            url: "application/src/routes.php?op=18&key="+key,
            method: "POST",
            success: function(data){
                $("#contenido-img").html(data);         
            }
        });
}



$(function () { /// despliega el light box
$("#mdb-lightbox-ui").load("assets/mdb-addons/mdb-lightbox-ui.html");
});








}); // termina query