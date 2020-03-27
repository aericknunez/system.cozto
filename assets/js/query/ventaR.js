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
               $("#ver").html('<div class="row justify-content-md-center" ><img src="assets/img/load.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#ver").html(data); // lo que regresa de la busquea 
                $("#lateral").load('application/src/routes.php?op=70'); // caraga el lateral
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
               $("#ver").html('<div class="row justify-content-md-center" ><img src="assets/img/load.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#ver").load('application/src/routes.php?op=93'); // ver productos de la orden 
                $("#lateral").load('application/src/routes.php?op=70'); // caraga el lateral
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
               $("#ver").html('<div class="row justify-content-md-center" ><img src="assets/img/load.gif" alt=""></div>');
            },
            success: function(data) {            
               $("#ver").load('application/src/routes.php?op=93'); // ver productos de la orden 
               $("#lateral").load('application/src/routes.php?op=70'); // caraga el lateral
            }
        });
    });                 






///////////////////// para venta rapida

	$('#btn-busquedaR').click(function(e){ /// para el formulario
		e.preventDefault();
        if($('#cod').val() != ""){
    		$.ajax({
    			url: "application/src/routes.php?op=90",
    			method: "POST",
    			data: $("#form-busquedaR").serialize(),
    		// beforeSend: function(){
    		// 	$("#ver").html('<div class="row justify-content-md-center" ><img src="assets/img/load.gif" alt=""></div>');
      //           },
    		success: function(data){
    			$("#ver").html(data);
    			$("#lateral").load('application/src/routes.php?op=70'); // caraga el lateral
    			$("#form-busquedaR").trigger("reset");
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
            //    $("#ver").html('<div class="row justify-content-md-center" ><img src="assets/img/load.gif" alt=""></div>');
            // },
            success: function(data) {            
                $("#ver").load('application/src/routes.php?op=93'); // ver productos de la orden 
                $("#lateral").load('application/src/routes.php?op=70'); // caraga el lateral
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
        $.post("application/src/routes.php?op=90", {cod:cod}, 
        function(data){
            $("#muestra-busqueda").hide();
            $("#ver").html(data); // lo que regresa de la busquea 
            $("#p-busqueda").trigger("reset"); // no funciona
            $("#lateral").load('application/src/routes.php?op=70'); // caraga el lateral
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
               $("#ver").html('<div class="row justify-content-md-center" ><img src="assets/img/load.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#ver").html(data); // lo que regresa de la busquea 
                $("#lateral").load('application/src/routes.php?op=70'); // caraga el lateral
            }
        });
    });   




$('#ModalBusqueda').on('shown.bs.modal', function() { // para autofocus en el modal
  $(this).find('[autofocus]').focus();
});







/// llamar modal cantidad
    $("body").on("click","#xcantidad",function(){ 
        
        $('#ModalCantidad').modal('show');
        
        var cantidad = $(this).attr('cantidad');
        var codigox = $(this).attr('codigox');
        var op = $(this).attr('op');

        $('#codigox').attr("value", codigox);
        $('#cantidad').attr("value", cantidad);
        
    });




    $('#btn-Ccantidad').click(function(e){ /// cambia la cantidad de los productos
        e.preventDefault();
        $.ajax({
            url: "application/src/routes.php?op=90",
            method: "POST",
            data: $("#form-Ccantidad").serialize(),
            beforeSend: function () {
                $('#btn-Ccantidad').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
            },
            success: function(data){
                $('#btn-Ccantidad').html('Agregar').removeClass('disabled');
               $("#form-Ccantidad").trigger("reset");
               $('#ModalCantidad').modal('hide');
               $("#ver").html(data); // lo que regresa de la busquea 
               $("#lateral").load('application/src/routes.php?op=70'); // caraga el lateral
            }
        })
    })




/// llamar modal descuento
    $("body").on("click","#xdescuento",function(){ 
        
        $('#ModalDescuento').modal('show');
        
        var ddescuento = $(this).attr('ddescuento');
        var dcantidad = $(this).attr('dcantidad');
        var dcodigo = $(this).attr('dcodigo');
        var porcentaje = $(this).attr('dporcentaje');

        $('#dcodigo').attr("value", dcodigo);
        $('#dcantidad').attr("value", dcantidad);

        if(ddescuento != "0.00"){
            $('#ver-descuento').html('<div class="border border-light alert alert-success alert-dismissible"><div align="center">El total descuento en este prooducto es: $'+ddescuento+' ('+porcentaje+'%)<br></div></div>');
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
            url: "application/src/routes.php?op=94",
            method: "POST",
            data: $("#form-Ddescuento").serialize(),
            beforeSend: function () {
                $('#btn-Ddescuento').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
            },
            success: function(data){
               $('#btn-Ddescuento').html('Agregar').removeClass('disabled');
               $("#form-Ddescuento").trigger("reset");
               $('#ModalDescuento').modal('hide');
               $("#ver").load('application/src/routes.php?op=93'); // ver productos de la orden 
               $("#lateral").load('application/src/routes.php?op=70'); // caraga el lateral
            }
        })
    })



    $("body").on("click","#del-descuento",function(){
    var dcantidad = $(this).attr('dcantidad');
    var dcodigo = $(this).attr('dcodigo');
    var descuento = $(this).attr('ddescuento');
       
        $.post("application/src/routes.php?op=94", {dcantidad:dcantidad, dcodigo:dcodigo, descuento:descuento}, 
        function(data){
               $('#ModalDescuento').modal('hide');
               $("#ver").load('application/src/routes.php?op=93'); // ver productos de la orden 
               $("#lateral").load('application/src/routes.php?op=70'); // caraga el lateral
        });
    });





}); // termina query