$(document).ready(function(){




    $("body").on("click","#abrirCaja",function(){  
        $('#ModalAbrirCaja').modal('show');
    });


    $('#btn-abrircaja').click(function(e){ /// agregar un producto 
    e.preventDefault();
    $.ajax({
            url: "application/src/routes.php?op=116",
            method: "POST",
            data: $("#form-abrircaja").serialize(),
            beforeSend: function () {
                $('#btn-abrircaja').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
               // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data){
                $('#btn-abrircaja').html('<i class="fa fa-save mr-1"></i> Ingresar').removeClass('disabled');       
                $("#form-abrircaja").trigger("reset");

                if(data == "realizado"){
                    $('#ModalAbrirCaja').modal('hide');
                    $('#ModalMensaje').modal('show');
                } else {
                    $("#verabrircaja").html(data);
                }
                 
            }
            
        })
    });



$("#form-abrircaja").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
if (e.which == 13) {
return false;
}
});




}); // termina query