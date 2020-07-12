$(document).ready(function()
{

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






/// para promociones
///////////// llamar modal para eliminar elemento
    $("body").on("click","#xdelete",function(){ 
        
        var op = $(this).attr('op');
        var hash = $(this).attr('hash');
        var cod = $(this).attr('cod');
        
        $('#delpromo').attr("op",op).attr("hash",hash).attr("cod",cod);
        $('#ConfirmDelete').modal('show');
    });



    $("body").on("click","#delpromo",function(){ // borrar promo
    var op = $(this).attr('op');
    var hash = $(this).attr('hash');
    var cod = $(this).attr('cod');
        $.post("application/src/routes.php", {op:op, hash:hash, cod:cod}, function(data){
        $("#contenido").html(data);
        $('#ConfirmDelete').modal('hide');
         });
    });




});