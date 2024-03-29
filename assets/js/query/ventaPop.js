$(document).ready(function(){




    $('#btn-descuento').click(function(e){ /// Aplicar descuento
        e.preventDefault();
        $.ajax({
            url: "application/src/routes.php?op=95",
            method: "POST",
            data: $("#form-descuento").serialize(),
            beforeSend: function () {
               $("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data){
                $("#form-descuento").trigger("reset");
                 $("#ver").html(data); // lo que regresa de la busquea 
            }
        })
    })


    $("body").on("click","#quitar-descuento",function(){ // quita descuento
        var op = $(this).attr('op');
        var dataString = 'op='+op;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#ver").html(data); // lo que regresa de la busquea 
            }
        });
    });                 






//// agregar credito

    $("#cliente-busqueda").keyup(function(){ /// para la caja de busqueda
        $.ajax({
        type: "POST",
        url: "application/src/routes.php?op=97",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            $("#muestra-busqueda").css("background","#FFF url(assets/img/LoaderIcon.gif) no-repeat 550px");
        },
        success: function(data){
            $("#muestra-busqueda").show();
            $("#muestra-busqueda").html(data);
            $("#cliente-busqueda").css("background","#FFF");
        }
        });
    });


////////////////

    $("body").on("click","#select-c",function(){
    var hash = $(this).attr('hash');
    var nombre = $(this).attr('nombre');
        $.post("application/src/routes.php?op=98", {hash:hash, nombre:nombre}, 
        function(data){
            $("#muestra-busqueda").hide();
            $("#ver").html(data); // lo que regresa de la busquea 
            $("#c-busqueda").trigger("reset"); // no funciona
        });
    });


    $("body").on("click","#quitar-cliente",function(){ // quita descuento
        var op = $(this).attr('op');
        var dataString = 'op='+op;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#ver").html(data); // lo que regresa de la busquea 
            }
        });
    });                 







//// agregar Documento

    $("#cliente-documento").keyup(function(){ /// para la caja de busqueda
        $.ajax({
        type: "POST",
        url: "application/src/routes.php?op=100",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            $("#muestra-documento").css("background","#FFF url(assets/img/LoaderIcon.gif) no-repeat 550px");
        },
        success: function(data){
            $("#muestra-documento").show();
            $("#muestra-documento").html(data);
            $("#cliente-documento").css("background","#FFF");
        }
        });
    });


////////////////

    $("body").on("click","#select-d",function(){
    var documento = $(this).attr('documento');
    var cliente = $(this).attr('cliente');
    var contribuyente = $(this).attr('contribuyente');
        $.post("application/src/routes.php?op=101", {documento:documento, cliente:cliente, contribuyente:contribuyente,}, 
        function(data){
            $("#muestra-documento").hide();
            $("#ver").html(data); // lo que regresa de la busquea 
            $("#c-documento").trigger("reset"); // no funciona
        });
    });


    $("body").on("click","#quitar-documento",function(){ // quita descuento
        var op = $(this).attr('op');
        var dataString = 'op='+op;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#ver").html(data); // lo que regresa de la busquea 
            }
        });
    });                 

  

    $('#btn-documento').click(function(e){ /// Nuevo Documento
        e.preventDefault();
        if(validarFormularioNit() == true) {
        $.ajax({
            url: "application/src/routes.php?op=103",
            method: "POST",
            data: $("#form-documento").serialize(),
            beforeSend: function () {
               $("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data){
                $("#form-documento").trigger("reset");
                $("#ver").html(data); // lo que regresa de la busquea 
            }
        })
}})

function validarFormularioNit() {
    var cliente = document.getElementById('cliente');
    var documento = document.getElementById('documento');
    var giro = document.getElementById('giro');
    var registro = document.getElementById('registro');
    var direccion = document.getElementById('direccion');
    var departamento = document.getElementById('departamento');
    var errorMensaje = document.getElementById('error-mensaje');

    // Verificar que ningún campo esté vacío
    if (cliente.value === '' || documento.value === '' || giro.value === '' || registro.value === '' || direccion.value === '' || departamento.value === '') {
        errorMensaje.textContent = 'Por favor, complete todos los campos.';
        return false; // Evitar el envío del formulario
    } else {
        errorMensaje.textContent = ''; // Limpiar el mensaje de error si todo está bien
        return true;
    }
}










//// agregar cliente

    $("#cliente-busquedaA").keyup(function(){ /// para la caja de busqueda
        $.ajax({
        type: "POST",
        url: "application/src/routes.php?op=87",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            $("#muestra-busquedaA").css("background","#FFF url(assets/img/LoaderIcon.gif) no-repeat 550px");
        },
        success: function(data){
            $("#muestra-busquedaA").show();
            $("#muestra-busquedaA").html(data);
            $("#cliente-busquedaA").css("background","#FFF");
        }
        });
    });


////////////////

    $("body").on("click","#select-cli",function(){
    var hash = $(this).attr('hash');
    var nombre = $(this).attr('nombre');
    var contribuyente = $(this).attr('contribuyente');
        $.post("application/src/routes.php?op=88", {hash:hash, nombre:nombre, contribuyente:contribuyente}, 
        function(data){
            $("#muestra-busquedaA").hide();
            $("#ver").html(data); // lo que regresa de la busquea 
            $("#c-busquedaA").trigger("reset"); // no funciona
        });
    });


    $("body").on("click","#quitar-clienteA",function(){ // quita descuento
        var op = $(this).attr('op');
        var dataString = 'op='+op;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#ver").html(data); // lo que regresa de la busquea 
            }
        });
    });                 



////////////// otras ventas ////////
    $('#btn-oventas').click(function(e){ /// para el formulario
    e.preventDefault();
    $.ajax({
            url: "application/src/routes.php?op=79",
            method: "POST",
            data: $("#form-oventas").serialize(),
            beforeSend: function () {
                $('#btn-oventas').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
            },
            success: function(data){
                $('#btn-oventas').html('Agregar Producto').removeClass('disabled');
                $("#form-oventas").trigger("reset");
                $("#msj").html(data);           
            }
        })
    })
    

////////////// otras ventas ////////
    $('#btn-agrupado').click(function(e){ /// para el formulario
    e.preventDefault();
    $.ajax({
            url: "application/src/routes.php?op=79",
            method: "POST",
            data: $("#form-agrupado").serialize(),
            beforeSend: function () {
                $('#btn-agrupado').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
            },
            success: function(data){
                $('#btn-agrupado').html('Agregar Producto').removeClass('disabled');
                $("#form-agrupado").trigger("reset");
                $("#msj").html(data);           
            }
        })
    })
    





//// agregar repartidor

$("#repartidor-busquedaR").keyup(function(){ /// para la caja de busqueda
    $.ajax({
    type: "POST",
    url: "application/src/routes.php?op=705",
    data:'keyword='+$(this).val(),
    beforeSend: function(){
        $("#muestra-busquedaR").css("background","#FFF url(assets/img/LoaderIcon.gif) no-repeat 550px");
    },
    success: function(data){
        $("#muestra-busquedaR").show();
        $("#muestra-busquedaR").html(data);
        $("#repartidor-busquedaR").css("background","#FFF");
    }
    });
});


////////////////

$("body").on("click","#select-rep",function(){
var hash = $(this).attr('hash');
var nombre = $(this).attr('nombre');
    $.post("application/src/routes.php?op=706", {hash:hash, nombre:nombre}, 
    function(data){
        $("#muestra-busquedaR").hide();
        $("#ver").html(data); // lo que regresa de la busquea 
        $("#c-busquedaR").trigger("reset"); // no funciona
    });
});


$("body").on("click","#quitar-repartidorA",function(){ // quita descuento
    var op = $(this).attr('op');
    var dataString = 'op='+op;

    $.ajax({
        type: "POST",
        url: "application/src/routes.php",
        data: dataString,
        beforeSend: function () {
           $("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
        },
        success: function(data) {            
            $("#ver").html(data); // lo que regresa de la busquea 
        }
    });
});                 

















}); // termina query