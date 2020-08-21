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
        AddDetallesAutoParts();
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










//// agregar productos

   $("body").on("click","#addproducto",function(){ 
        
        $('#ModalAgregar').modal('show');
        
        var key = $(this).attr('key');
        var op = $(this).attr('op');
        var dataString = 'op='+op+'&key='+key;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#destinoproductoagrega").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#destinoproductoagrega").html(data); // lo que regresa de la busquea         
            }
        });


        $('#btn-productoagrega').attr("cod", key);

        DatosDelProducto(key);

        
    });


function DatosDelProducto(key){
        var op = "539";
        var dataString = 'op='+op+'&key='+key;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            success: function(data) {            
                $("#datosproducto").html(data); // lo que regresa de la busquea         
            }
        });
}



///
// agrega
    $('#btn-productoagrega').click(function(e){ /// para el formulario
    e.preventDefault();
    var cod = $(this).attr('cod');
    $.ajax({
            url: "application/src/routes.php?op=48",
            method: "POST",
            data: $("#form-productoagrega").serialize(),
            beforeSend: function () {
                $('#btn-productoagrega').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
            },
            success: function(data){
                $('#btn-productoagrega').html('<i class="fa fa-save mr-1"></i> Guardar').removeClass('disabled');  
                $("#form-productoagrega").trigger("reset");
                $("#destinoproductoagrega").html(data);
                $("#cant-"+cod).load('application/src/routes.php?op=542&key='+cod);  
                $("#cant-"+cod).addClass("red-text");       
            }
        })
    });


    $("body").on("click","#delproagrega",function(){ // borrar producto
    var op = $(this).attr('op');
    var hash = $(this).attr('hash');
    var producto = $(this).attr('producto');

        $.post("application/src/routes.php", {op:op, hash:hash, producto:producto}, function(data){
        $("#destinoproductoagrega").html(data);
        $("#cant-"+producto).load('application/src/routes.php?op=542&key='+producto);
        $("#cant-"+producto).addClass("red-text");
         });
    });




//// acambiar el precio de los productos

   $("body").on("click","#cambiarprecio",function(){ 
        
        $('#ModalCambiarPrecio').modal('show');
        
        var key = $(this).attr('key');
        var op = $(this).attr('op');
        var dataString = 'op='+op+'&key='+key;

        var cod = $(this).attr('cod');

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#vista-precio").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#vista-precio").html(data); // lo que regresa de la busquea         
            }
        });

        $('#btn-modprecio').attr("cod", key);
    });


// agrega
    $('#btn-modprecio').click(function(e){ /// para el formulario
    e.preventDefault();
    var cod = $(this).attr('cod');
    $.ajax({
            url: "application/src/routes.php?op=544",
            method: "POST",
            data: $("#form-modprecio").serialize(),
            beforeSend: function () {
                $('#btn-modprecio').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
            },
            success: function(data){
                $('#btn-modprecio').html('<i class="fa fa-save mr-1"></i> Guardar').removeClass('disabled');          
                $("#form-modprecio").trigger("reset");
                $("#vista-precio").html(data);
                $("#precio-"+cod).load('application/src/routes.php?op=543&key='+cod);  
                $("#precio-"+cod).addClass("red-text"); 
                 $('#ModalCambiarPrecio').modal('hide');      
            }
        })
    });





    $("body").on("click","#todoslosproductos",function(){
       
        var op = "545";
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
                $('#AddAutoParts').modal('hide');
            }
        })
    }); 








}); // termina query