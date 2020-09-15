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






    $("body").on("click","#veruser",function(){ 
        
        $('#ModalVer').modal('show');
        
        var usuario = $(this).attr('usuario');
        var op = $(this).attr('op');
        var dataString = 'op='+op+'&usuario='+usuario;

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





/// llamar modal ver
    $("body").on("click","#xverproducto",function(){ 
        
        $('#ModalVerProducto').modal('show');
        
        var key = $(this).attr('key');
        var op = $(this).attr('op');
        var dataString = 'op='+op+'&key='+key;

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











//// precios
    $("body").on("click","#c_pronombre",function(){ 

            var cod = $(this).attr('cod');
            var hash = $(this).attr('hash');
            var cat = $(this).attr('cat');
        
        $('#ModalCambiarPronombre').modal('show');
        $('#cod').attr("value",cod);
        $('#hash').attr("value",hash);
        $("#cat").html('<h3 class="row justify-content-md-center" >'+cat+'</h3>');
            
    });

/// cambia precio
    $('#btn-pronombre').click(function(e){ /// para el formulario
        e.preventDefault();
        $.ajax({
            url: "application/src/routes.php?op=385",
            method: "POST",
            data: $("#form-pronombre").serialize(),
            beforeSend: function () {
            $('#btn-pronombre').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
            },
            success: function(data){
                $('#btn-pronombre').html('Registrar').removeClass('disabled');
                $("#contenido").html(data);
                $("#form-pronombre").trigger("reset");
                $('#ModalCambiarPronombre').modal('hide');
            }
        })
    })
$("#form-pronombre").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
if (e.which == 13) {
return false;
}
});




// eliminar Orden
    $("body").on("click","#xdelete",function(){ 
        
        var op = $(this).attr('op');
        var hash = $(this).attr('hash');
        
        $('#edelorden').attr("op",op).attr("hash",hash);
        $('#ConfirmDelete').modal('show');
    });



    $("body").on("click","#edelorden",function(){ 
        
        var usuario = $(this).attr('usuario');
        var hash = $(this).attr('hash');
        var op = $(this).attr('op');
        var dataString = 'op='+op+'&hash='+hash;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#contenido").html(data); // lo que regresa de la busquea     
                $('#ConfirmDelete').modal('hide');    
            }
        });
        
    });






/// llamar modal ver
    $("body").on("click","#addimg",function(){ 
        
        $('#ModalImagen').modal('show');
        $('#verformularioimg').hide();
        $('#verbtnimg').show();
        $('#mostrarvinculo').hide();
        
        var hash = $(this).attr('hash');
        var op = $(this).attr('op');
        var dataString = 'hash='+hash+'&op='+op;

        $('#hash_cat').attr("value",hash);

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#verimg").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#verimg").html(data); // lo que regresa de la busquea         
            }
        });
        
    });


    $("body").on("click","#mostraradd",function(){ 
        $('#verformularioimg').show();
        $('#verbtnimg').hide();
        $('#mostrarvinculo').show();
    });

    $("body").on("click","#ocultaradd",function(){ 
        
        $('#verformularioimg').hide();
        $('#verbtnimg').show();
        $('#mostrarvinculo').hide();
    });



//////agregar imagen
    $("#btn-img").click(function (event) {
        event.preventDefault();
        var form = $('#form-img')[0];
        var data = new FormData(form);
        var iden = $(this).attr('codigo');

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "application/src/routes.php?op=388",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            beforeSend: function () {
                $('#btn-img').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
            },
            success: function (data) {
                $('#btn-img').html('Subir Imagen').removeClass('disabled');
                $("#verimg").html(data);
                $("#form-img").trigger("reset");
                $('#verformularioimg').hide();
                $('#verbtnimg').show();
                $('#mostrarvinculo').hide();
            },
        });
    });










});  // fin del jquery