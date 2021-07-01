$(document).ready(function(){



    function MostrarOrdenes(){

        var op = "651";
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


    // MostrarOrdenes();

//////////////

    function MostrarOrdenesE(){

        var op = "659";
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


    // MostrarOrdenesE();



/// aceptar orden
    $("body").on("click","#order_acept",function(){ 
        var op = "650";
        var hash = $(this).attr('hash');
        var dataString = 'op='+op+'&hash='+hash;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#contenido").html(data);
            }
        }); 

    });



/// cancelar
    $("body").on("click","#cancelar_orden",function(){ 
        var op = "652";
        var hash = $(this).attr('hash');
        var dataString = 'op='+op+'&hash='+hash;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                MostrarOrdenes();
            }
        }); 

    });







/// llamar modal ver
    $("body").on("click","#nueva_tranferencia",function(){ 

        $('#ModalNuevo').modal('show');
        $("#formulario_b").hide();
        $("#form-add").hide();

        var op = "653";
        var dataString = 'op='+op;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#vista_ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#vista_ver").html(data); // lo que regresa de la busquea         
            }
        });
    });
    

/// llamar modal ver
    $("body").on("click","#select_destino",function(){ 

        var op = "655";
        var destino = $(this).attr('destino');
        var dataString = 'op='+op+'&destino='+destino;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#vista_ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#vista_ver").html(data); // lo que regresa de la busquea   
                $("#formulario_b").show();     
            }
        });
    });
    



/// llamar modal ver
$("body").on("click","#cerrar_modal",function(){ 

    var op = "654";
    var dataString = 'op='+op;

    $.ajax({
        type: "POST",
        url: "application/src/routes.php",
        data: dataString,
        beforeSend: function () {
           $("#vista_ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
        },
        success: function(data) {            
            $("#vista_ver").html(data); // lo que regresa de la busquea         
        }
    });

$('#ModalNuevo').modal('hide');

});












// busqueda actualizar
    $("#key").keyup(function(){ /// para la caja de busqueda
        $.ajax({
        type: "POST",
        url: "application/src/routes.php?op=75", // op=75 busqueda // 550 por tags
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            $("#muestra-busqueda").css("background","#FFF url(assets/img/LoaderIcon.gif) no-repeat 550px");
        },
        success: function(data){
            $("#muestra-busqueda").show();
            $("#muestra-busqueda").html(data);
            $("#key").css("background","#FFF");
        }
        });
    });



//////// cancel 
    $("body").on("click","#cancel-p",function(){
        $("#muestra-busqueda").hide();
        $("#p-busqueda").trigger("reset"); 
    });

////////////////

    $("body").on("click","#select-p",function(){
    var key = $(this).attr('cod');
        $.post("application/src/routes.php?op=656", {key:key}, 
        function(data){
            $("#muestra-busqueda").hide();
            $("#vista_form").html(data); // lo que regresa de la busquea 
            $("#p-busqueda").trigger("reset");
            $("#form-add").show(); 
        });
    });




    $('#btn-add').click(function(e){ /// agregar un producto 
    e.preventDefault();
    $.ajax({
            url: "application/src/routes.php?op=657",
            method: "POST",
            data: $("#form-add").serialize(),
            beforeSend: function () {
                $('#btn-add').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
               // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data){
                $('#btn-add').html('Agregar Producto').removeClass('disabled');       
                $("#form-add").trigger("reset");
                $("#vista_ver").html(data); 
                $("#form-add").hide(); 
            }
        })
    });
    





    $("body").on("click","#enviar_orden",function(){ 

        var op = "658";
        var dataString = 'op='+op;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#vista_ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#vista_ver").html(data); // lo que regresa de la busquea     
            }
        });
    });




    $("body").on("click","#devolver_productos",function(){ 
        var op = "660";
        var hash = $(this).attr('hash');
        var dataString = 'op='+op+'&hash='+hash;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#contenido").html(data);
            }
        }); 

    });






    $('#btn-asociar').click(function(e){ /// agregar un producto 
    e.preventDefault();
    $.ajax({
            url: "application/src/routes.php?op=662",
            method: "POST",
            data: $("#form-asociar").serialize(),
            beforeSend: function () {
                $('#btn-asociar').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
            },
            success: function(data){
                $('#btn-asociar').html('Agregar Sucursal').removeClass('disabled');       
                $("#form-asociar").trigger("reset");
                $("#destinos").html(data); 
            }
        })
    });














}); // termina query