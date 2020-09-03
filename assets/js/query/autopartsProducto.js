$(document).ready(function(){

// $("#descripcion")focus();

function DisableBoton(){
    $('#btn-proadd').addClass("disabled");
}
DisableBoton();


    $('#btn-proadd').click(function(e){ /// para el formulario
    e.preventDefault();
    $.ajax({
            url: "application/src/routes.php?op=536",
            method: "POST",
            data: $("#form-proadd").serialize(),
            beforeSend: function () {
                $('#btn-proadd').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
               // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data){
                $('#btn-proadd').html('<i class="fa fa-save mr-1"></i> Guardar Producto').removeClass('disabled');       
                $("#form-proadd").trigger("reset");
                $("#msj").html(data);         
                // window.location.href="?modal=proadd&key=0000";
            }
        })
    })
    



    $("#form-proadd").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
    if (e.which == 13) {
    return false;
    }
    });






    $("#busqueda").keyup(function(){ /// para la caja de busqueda
        $.ajax({
        type: "POST",
        url: "application/src/routes.php?op=537",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            // $("#muestra-busqueda").css("background","#FFF url(assets/img/LoaderIcon.gif) no-repeat 0px");
        },
        success: function(data){
            $("#muestra-busqueda").show();
            $("#muestra-busqueda").html(data);
            $("#producto-busqueda").css("background","#FFF");
        }
        });
    });



    $("body").on("click","#cancel-p",function(){
        $("#muestra-busqueda").hide();
         $("#form-proadd").trigger("reset");
    });



    $("body").on("click","#select-p",function(){
        var cod = $(this).attr('cod');
        var item = $(this).attr('item');
        var categoria = $(this).attr('categoria');
        $("#muestra-busqueda").hide();
        // window.location.href="?proup&key=" + cod;
        $('#busqueda').hide();
        $('#cod').attr("value",cod);
        $('#categoria').attr("value",categoria);
        $('#descripcion').attr("value",item).attr("type","text");

        VerificarExistencia(cod);
    });



function VerificarExistencia(cod){

        var op = "540";
        var dataString = 'op='+op+'&cod='+cod;
           
        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            success: function(data) {  
                if(data == "TRUE"){
                $("#verexistencia").html('<div class="border border-light alert alert-danger alert-dismissible"><div align="center">Ya se encuentra este producto agregado, por favor verifique existencias<br><a id="mostrarformulario" class="btn btn-danger btn-rounded">Aceptar</a></div></div>'); // lo que regresa de la busquea              
                $('#formulariox').hide();
                } else {
                    $('#btn-proadd').removeClass('disabled'); 
                }     

            }
        });
}






    $("body").on("click","#mostrarformulario",function(){
        $('#formulariox').show();
        $("#verexistencia").html('');
        $("#form-proadd").trigger("reset");

        $('#busqueda').show();
        $('#cod').attr("value","");
        $('#categoria').attr("value","");
        $('#descripcion').attr("value","").attr("type","hidden");
    });



    $("body").on("click","#eliminardatos",function(){
        $('#busqueda').show();
        $('#cod').attr("value","");
        $('#categoria').attr("value","");
        $('#descripcion').attr("value","").attr("type","hidden");
        $("#form-proadd").trigger("reset");
        DisableBoton();
    });




}); // termina query