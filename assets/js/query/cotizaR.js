$(document).ready(function(){




    $("body").on("click","#borrar-ticket",function(){
        var op = $(this).attr('op');
		var hash = $(this).attr('hash');
        var dataString = 'op='+op+'&hash='+hash;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#ver").html(data); // lo que regresa de la busquea 
                $("#lateral").load('application/src/routes.php?op=146'); // caraga el lateral
            }
        });
    });                 



    $("body").on("click","#guardar",function(){
        var op = $(this).attr('op');
		var orden = $(this).attr('orden');
        var dataString = 'op='+op+'&orden='+orden;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#ver").html(data); // lo que regresa de la busquea 
                $("#lateral").load('application/src/routes.php?op=146'); // caraga el lateral
            }
        });
    });                 




    $("body").on("click","#select-orden",function(){
        var op = $(this).attr('op');
		var orden = $(this).attr('orden');
        var dataString = 'op='+op+'&orden='+orden;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#ver").load('application/src/routes.php?op=153'); // ver productos de la orden 
                $("#lateral").load('application/src/routes.php?op=146'); // caraga el lateral
            }
        });
    });                 





///////////////////// para venta rapida

	$('#btn-busquedaR').click(function(e){ /// para el formulario
		e.preventDefault();
        if($('#cod').val() != ""){
    		$.ajax({
    			url: "application/src/routes.php?op=150",
    			method: "POST",
    			data: $("#form-busquedaR").serialize(),
    		// beforeSend: function(){
    		// 	$("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
      //           },
    		success: function(data){
    			$("#ver").html(data);
    			$("#form-busquedaR").trigger("reset");
                $("#lateral").load('application/src/routes.php?op=146'); // caraga el lateral
    		}
    		});
        }
	})




    $("body").on("click","#modcant",function(){
        var op = $(this).attr('op');
		var cod = $(this).attr('cod');
        var dataString = 'op='+op+'&cod='+cod;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            // beforeSend: function () {
            //    $("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            // },
            success: function(data) {            
                $("#ver").load('application/src/routes.php?op=153'); // ver productos de la orden 
                $("#lateral").load('application/src/routes.php?op=146'); // caraga el lateral
            }
        });
    });                 




/////buscar cliente
///
    $("#cliente-busqueda").keyup(function(){ /// para la caja de busqueda
        $.ajax({
        type: "POST",
        url: "application/src/routes.php?op=147",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            $("#muestra-busqueda");
        },
        success: function(data){
            $("#muestra-busqueda").show();
            $("#muestra-busqueda").html(data);
            $("#cliente-busqueda").css("background","#FFF");
        }
        });
    });


$("#c-busqueda").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
if (e.which == 13) {
return false;
}
});


    $("body").on("click","#select-c",function(){
    var hash = $(this).attr('hash');
    var nombre = $(this).attr('nombre');
        $.post("application/src/routes.php?op=148", {hash:hash, nombre:nombre}, 
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




//// buscar productos

    $("#producto-busqueda").keyup(function(){ /// para la caja de busqueda
        $.ajax({
        type: "POST",
        url: "application/src/routes.php?op=75",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            $("#muestra-busqueda").css("background","#FFF url(assets/img/LoaderIcon.gif) no-repeat 550px");
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
        $("#p-busqueda").trigger("reset"); 
    });

////////////////



    $("body").on("click","#select-p",function(){
    var cod = $(this).attr('cod');
        $.post("application/src/routes.php?op=150", {cod:cod}, 
        function(data){
            $("#muestra-busqueda").hide();
            $("#ver").html(data); // lo que regresa de la busquea 
            $("#p-busqueda").trigger("reset"); // no funciona
            $("#lateral").load('application/src/routes.php?op=146'); // caraga el lateral
        });
    });



//////////////cancelar
    $("body").on("click","#cancelar",function(){
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
                $("#lateral").load('application/src/routes.php?op=146'); // caraga el lateral
            }
        });
    });   




$('#ModalBusqueda').on('shown.bs.modal', function() { // para autofocus en el modal
  $(this).find('[autofocus]').focus();
});












    $('#btn-Ccantidad').click(function(e){ /// cambia la cantidad de los productos
        e.preventDefault();
        $.ajax({
            url: "application/src/routes.php?op=150",
            method: "POST",
            data: $("#form-Ccantidad").serialize(),
            beforeSend: function () {
               $("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data){
                $("#form-Ccantidad").trigger("reset");
                window.location.href="?cotizar"
            }
        })
    })




    $('#btn-descuento').click(function(e){ /// Aplicar descuento
        e.preventDefault();
        $.ajax({
            url: "application/src/routes.php?op=155",
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





/// llamar modal ver
    $("body").on("click","#xver",function(){ 
        
        $('#ModalVer').modal('show');
        
        var key = $(this).attr('key');
        var op = $(this).attr('op');
        var cotizacion = $(this).attr('cotizacion');
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
                $('#activar_cotizacion').attr("cotizacion", cotizacion);
                $('#facturar').attr("cotizacion", cotizacion);            
            }
        });

        if($(this).attr('esto') != null){
            $('#activar_cotizacion').hide();
             $('#facturar').hide();
        }

    });




///// mactivar/ mostrar cotizacion
    $("body").on("click","#activar_cotizacion",function(){ // quita descuento
        var op = $(this).attr('op');
        var cotizacion = $(this).attr('cotizacion');
        var dataString = 'op='+op+'&cotizacion='+cotizacion;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#vista").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                 window.location.href="?cotizar";
            }
        });
    });      





/////  pasar cotizacion a facturar
    $("body").on("click","#facturar",function(){ // quita descuento
        var op = $(this).attr('op');
        var cotizacion = $(this).attr('cotizacion');
        var dataString = 'op='+op+'&cotizacion='+cotizacion;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#vista").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                 window.location.href="?";
            }
        });
    });      






//  paso al archivo de printThis_print
    // $('#imprimir').on("click", function () {
    //   $('#vista').printThis({
    //     importCSS: false,
    //     loadCSS: [
    //     "http://localhost/cozto/assets/css/font-awesome-582.css",
    //     "http://localhost/cozto/assets/css/bootstrap.min.css", 
    //     "http://localhost/cozto/assets/css/mdb.min.css",
    //     "http://localhost/cozto/assets/css/galeria.css"],
    //     removeScripts: true,
    //      base: false
    //   });
    // });




    ////////////// otras ventas ////////
    $('#btn-oventascot').click(function(e){ /// para el formulario
        e.preventDefault();
        $.ajax({
                url: "application/src/routes.php?op=78",
                method: "POST",
                data: $("#form-oventascot").serialize(),
                beforeSend: function () {
                    $('#btn-oventascot').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
                },
                success: function(data){
                    $('#btn-oventascot').html('Agregar Producto').removeClass('disabled');
                    $("#form-oventascot").trigger("reset");
                    $("#msj").html(data);           
                }
            })
        })



    $('#btn-materiales').click(function(e){ /// para el formulario
        e.preventDefault();
        $.ajax({
                url: "application/src/routes.php?op=690",
                method: "POST",
                data: $("#form-materiales").serialize(),
                beforeSend: function () {
                    $('#btn-materiales').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
                },
                success: function(data){
                    $('#btn-materiales').html('Agregar Material').removeClass('disabled');
                    $("#form-materiales").trigger("reset");
                    $("#ver").html(data);           
                }
            })
        })



        $("body").on("click","#borrar-material",function(){ // quita descuento
            var op = $(this).attr('op');
            var hash = $(this).attr('hash');
            var dataString = 'op='+op+'&hash='+hash;
    
            $.ajax({
                type: "POST",
                url: "application/src/routes.php",
                data: dataString,
                beforeSend: function () {
                   $("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
                },
                success: function(data) {            
                    $("#ver").html(data);           
                }
            });
        });      
    
        // llamar modal descuento
        $("body").on("click","#xdescuento",function(){ 
        
            $('#ModalDescuento').modal('show');
            
            var ddescuento = $(this).attr('ddescuento');
            var dcantidad = $(this).attr('dcantidad');
            var dcodigo = $(this).attr('dcodigo');
            var porcentaje = $(this).attr('dporcentaje');
    
            $('#dcodigo').attr("value", dcodigo);
            $('#dcantidad').attr("value", dcantidad);
    
            if(ddescuento != "0.00"){
                $('#ver-descuento').html('<div class="border border-light alert alert-success alert-dismissible"><div align="center">El total descuento en este producto es: $'+ddescuento+' ('+porcentaje+'%)<br></div></div>');
                $('#ver-btndescuento').html('<a id="del-descuento" dcantidad="'+dcantidad+'" dcodigo="'+dcodigo+'" ddescuento="0" class="btn btn-danger btn-rounded waves-effect waves-light">Quitar Descuento</a>');
                $('#ver-btndescuento').show();
            } else {
                $('#ver-descuento').html('<div class="border border-light alert alert-danger alert-dismissible"><div align="center">No se ha aplicado descuento a este producto</div></div>');
                $('#ver-btndescuento').hide();
            }
        });
    

        $('#btn-Ddescuento').click(function(e){ /// cambia la cantidad de los productos
            e.preventDefault();
            $.ajax({
                url: "application/src/routes.php?op=155-1",
                method: "POST",
                data: $("#form-Ddescuento").serialize(),
                beforeSend: function () {
                    $('#btn-Ddescuento').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
                },
                success: function(data){
                   $('#btn-Ddescuento').html('Agregar').removeClass('disabled');
                   $("#form-Ddescuento").trigger("reset");
                //    $('#ModalDescuento').modal('hide');
                   $("#ver").load('application/src/routes.php?op=153'); // ver productos de la orden 
                   $("#lateral").load('application/src/routes.php?op=146'); // caraga el lateral
                   $('#ver-descuento').html(data);
    
                }
            })
        })
    

        /// cambiar tipo de descuento para porcentaje o cantidad
    $("body").on("click","#prop",function(){ /// para el los botones de opciones

        if($(this).attr('checked')){ // es por que estaba activo
            $('#prop').removeAttr("checked","checked");
            var dir = 'op=154&edo=0';
        } 
        else {
            $('#prop').attr("checked","checked");
            var dir = 'op=154&edo=1';
        }
    
    QueryGo(dir);   
    
    });

function QueryGo(dir){

        var dataString = dir;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#load").html('<div class="row justify-content-md-center" ><img src="assets/img/load.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#load").html(data); // lo que regresa de la busquea 
            }

    });      
}

$("body").on("click","#del-descuento",function(){
    var dcantidad = $(this).attr('dcantidad');
    var dcodigo = $(this).attr('dcodigo');
    var descuento = $(this).attr('ddescuento');
       
        $.post("application/src/routes.php?op=155-1", {dcantidad:dcantidad, dcodigo:dcodigo, descuento:descuento}, 
        function(data){
               $('#ModalDescuento').modal('hide');
               $("#ver").load('application/src/routes.php?op=153'); // ver productos de la orden 
               $("#lateral").load('application/src/routes.php?op=146'); // caraga el lateral
        });
    });


    ///////////// llamar modal para agregar imagen
    $("body").on("click","#imagen",function(){ 
        
        $('#ModalAddImg').modal('show');
        $('#formulario').hide();
        var iden = $(this).attr('iden');
     
        $('#codigo').attr("value",iden);

        CargaImagen(iden);
    });

    function CargaImagen(iden){ // Extrae los datos del perfil cuando es invocada la funcion
        $.ajax({
            url: "application/src/routes.php?op=175-1&cotizacion="+iden,
            method: "POST",
            success: function(data){
                $("#imagenCot").html(data);         
            }
        });
    }

    $("body").on("click","#showform",function(){ 
        $('#formulario').toggle();
    });

        
    $("body").on("click","#verimagen",function(){ 
         var iden = $(this).attr('iden');
         var cotizacion = $(this).attr('cotizacion');
         console.log(iden);
         $.ajax({
                url: "application/src/routes.php?op=176-1&iden="+iden+"&cotizacion="+cotizacion,
                method: "POST",
                success: function(data){
                    $("#imagenCot").html(data);         
                }
            });
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
            url: "application/src/routes.php?op=174-1",
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
                $("#imagenCot").html(data);
                $("#form-img").trigger("reset");
                $('#formulario').hide();
            },
        });
    });

    $("body").on("click","#borrar-img",function(){ // borrar Imagen
        var op = $(this).attr('op');
        var hash = $(this).attr('hash');
        var cotizacion = $(this).attr('cotizacion');
                $.post("application/src/routes.php", {op:op, hash:hash, cotizacion:cotizacion}, function(data){
                $("#imagenCot").html(data);
                });
        });


}); // termina query