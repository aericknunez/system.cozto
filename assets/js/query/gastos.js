$(document).ready(function()
{



	$('#btn-gastos').click(function(e){ /// agregar un producto 
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=170",
			method: "POST",
			data: $("#form-gastos").serialize(),
			beforeSend: function () {
				$('#btn-gastos').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
	           // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
			success: function(data){
				$('#btn-gastos').html('Agregar Gasto').removeClass('disabled');	      
				$("#form-gastos").trigger("reset");
				$("#contenido").html(data);	
			}
		})
	});
    



$("#form-gastos").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
if (e.which == 13) {
return false;
}
});




    $("body").on("click","#borrar-gasto",function(){
        var op = $(this).attr('op');
        var iden = $(this).attr('iden');
        var dataString = 'op='+op+'&iden='+iden;

        $('#ConfirmDelete').modal('hide');

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
    });                 






	$('#btn-entradas').click(function(e){ /// agregar un producto 
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=172",
			method: "POST",
			data: $("#form-entradas").serialize(),
			beforeSend: function () {
				$('#btn-entradas').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
	           // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
			success: function(data){
				$('#btn-entradas').html('Agregar Efectivo').removeClass('disabled');	      
				$("#form-entradas").trigger("reset");
				$("#contenido").html(data);	
			}
		})
	});
    



$("#form-entradas").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
if (e.which == 13) {
return false;
}
});


    $("body").on("click","#borrar-efectivo",function(){
        var op = $(this).attr('op');
        var iden = $(this).attr('iden');
        var dataString = 'op='+op+'&iden='+iden;
        
        $('#ConfirmDelete').modal('hide');

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
    });      




///////////// llamar modal para eliminar elemento
    $("body").on("click","#xdelete",function(){ 
        
        $('#ConfirmDelete').modal('show');
        var op = $(this).attr('op');
        var iden = $(this).attr('iden');
         
        $('#borrar-efectivo').attr("op",op).attr("iden",iden);
        $('#borrar-gasto').attr("op",op).attr("iden",iden);
        
    });






///////////// llamar modal para ver elemento
    $("body").on("click","#xver",function(){ 
        
        $('#ModalAddImg').modal('show');
        $('#formulario').hide();
        var iden = $(this).attr('iden');
     
        $('#codigo').attr("value",iden);

        CargaImagen(iden);
    });

    
    function CargaImagen(iden){ // Extrae los datos del perfil cuando es invocada la funcion
            $.ajax({
                url: "application/src/routes.php?op=175&gasto="+iden,
                method: "POST",
                success: function(data){
                    $("#vista").html(data);         
                }
            });
    }


    $("body").on("click","#showform",function(){ 
        $('#formulario').toggle();
    });


    
    $("body").on("click","#verimagen",function(){ 
         var iden = $(this).attr('iden');
          var gasto = $(this).attr('gasto');
         $.ajax({
                url: "application/src/routes.php?op=176&iden="+iden+"&gasto="+gasto,
                method: "POST",
                success: function(data){
                    $("#vista").html(data);         
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
            url: "application/src/routes.php?op=174",
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
                $("#vista").html(data);
                $("#form-img").trigger("reset");
                $('#formulario').hide();
            },
        });
    });





/// Commienza gastos update
$("#tipo").change(function(){
    var id=$(this).val();
    if(id == 2){ // se muestra numero de factura
        $('#nofactura').attr("type", "text");
        $('#nofactura').attr("value", "");
        $('#tipo_comprobante').attr("value", "");
        $("#elcomprobante").show();
    } else {
        $('#nofactura').attr("value", "");
        $('#nofactura').attr("type", "hidden");
        $('#tipo_comprobante').attr("value", "");
        $("#elcomprobante").hide();
    }
   
});


$("#pago").change(function(){
    var id=$(this).val();
    var dataString = 'id='+ id;

    if(id == 1){ // se muestra numero de factura
        $("#muestra_b").hide();
    } else {
        $("#muestra_b").show();
               $.ajax({
                type: "POST",
                url: "application/src/routes.php?op=177", // obtengo el lsitado de bancos y cuentas
                data: dataString,
                cache: false,
                success: function(html){
                    $("#muestra_banco").html(html);
                } 
            });
    }

});

$("#muestra_b").hide();
// $("#elcomprobante").hide();


    // $("#pais").change(function()
    // {
    //     var id=$(this).val();
    //     var dataString = 'id='+ id;
    
    //     $.ajax
    //     ({
    //         type: "POST",
    //         url: "application/src/routes.php?op=16", // obterngo departamento
    //         data: dataString,
    //         cache: false,
    //         success: function(html)
    //         {
    //             $("#dep").html(html);
    //         } 
    //     });
    // });






/// llamar modal ver
    $("body").on("click","#addbanco",function(){ 
        
        $('#ModalAddBanco').modal('show');

        var op = "178";
        var dataString = 'op='+op;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#vista_banco").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#vista_banco").html(data); // lo que regresa de la busquea         
            }
        });

    });



    $('#btn-banco').click(function(e){ /// agregar un producto 
    e.preventDefault();
    $.ajax({
            url: "application/src/routes.php?op=179",
            method: "POST",
            data: $("#form-banco").serialize(),
            beforeSend: function () {
                $('#btn-banco').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
               // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data){
                $('#btn-banco').html('Agregar Cuenta').removeClass('disabled');          
                $("#form-banco").trigger("reset");
                $("#vista_banco").html(data); 
            }
        })
    });
    







/// llamar modal ver
    $("body").on("click","#addcat",function(){ 
        
        $('#ModalAddCategoria').modal('show');

        var op = "180";
        var dataString = 'op='+op;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#vista_categoria").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#vista_categoria").html(data); // lo que regresa de la busquea         
            }
        });

    });



    $('#btn-categoria').click(function(e){ /// agregar un producto 
    e.preventDefault();
    $.ajax({
            url: "application/src/routes.php?op=181",
            method: "POST",
            data: $("#form-categoria").serialize(),
            beforeSend: function () {
                $('#btn-categoria').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
               // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data){
                $('#btn-categoria').html('Agregar Categoria').removeClass('disabled');          
                $("#form-categoria").trigger("reset");
                $("#vista_categoria").html(data); 
                $("#muestra_categoria").load('application/src/routes.php?op=182');
            }
        })
    });
    







    $("body").on("click","#verdetallesbanco",function(){ 
        
        var op = "183";
        var hash =  $(this).attr('hash');
        var dataString = 'op='+op+'&hash='+hash;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#resultado").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#resultado").html(data); // lo que regresa de la busquea         
            }
        });

    });





});