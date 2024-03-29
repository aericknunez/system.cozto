$(document).ready(function(){

    function delay(callback, ms) {
        var timer = 0;
        return function() {
          var context = this, args = arguments;
          clearTimeout(timer);
          timer = setTimeout(function () {
            callback.apply(context, args);
          }, ms || 0);
        };
      }
      
      
      // Example usage:
      
      $('#producto-busqueda').keyup(delay(function (e) {
        Search();
      }, 700));
    
    
      function Search(){
		$.ajax({
            type: "POST",
            url: "application/src/routes.php?op=75",
            data:'keyword='+$('#producto-busqueda').val(),
            beforeSend: function(){
                $("#muestra-busqueda").css("background","#FFF url(assets/img/LoaderIcon.gif) no-repeat 550px");
            },
            success: function(data){
                $("#muestra-busqueda").show();
                $("#muestra-busqueda").html(data);
                $("#producto-busqueda").css("background","#FFF");
                Esconder();
            }
            });
    }
// busqueda actualizar



$("#p-busqueda").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
if (e.which == 13) {
return false;
}
});

	// $("body").on("click","#select-p",function(){
	// 	var cod = $(this).attr('cod');
	// 	var descripcion = $(this).attr('descripcion');
	// 	$("#muestra-busqueda").hide();
	// 	$("#temp-productos").load('application/src/routes.php?op=76&key=' + cod);
	// });

//////// cancel 
	$("body").on("click","#cancel-p",function(){
		$("#muestra-busqueda").hide();
		Esconder();
		$("#p-busqueda").trigger("reset"); 
	});

	$("body").on("click","#cancel-x",function(){
		$("#muestra-busqueda").hide();
		Esconder();
		$("#p-busqueda").trigger("reset"); 
	});


////////////////

	$("body").on("click","#select-p",function(){
	Mostrar();
	var cod = $(this).attr('cod');
	var descripcion = $(this).attr('descripcion');
    	$.post("application/src/routes.php?op=76", {cod:cod, descripcion:descripcion}, 
    	function(data){
    		$("#muestra-busqueda").hide();
    		$("#temp-productos").html(data); // lo que regresa de la busquea 
		    $("#btn-addform").show();
		    $("#p-busqueda").trigger("reset"); // no funciona
		    $("#lateral").load('application/src/routes.php?op=70'); // caraga el lateral

            $("#cantidad").focus();

   	 	});

	});



	$('#btn-addform').click(function(e){ /// agregar un producto 
	Esconder();
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=80",
			method: "POST",
			data: $("#form-addform").serialize(),
			beforeSend: function () {
               $("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
			success: function(data){
				$("#form-addform").trigger("reset");
				$("#ver").html(data);	
		    	$("#lateral").load('application/src/routes.php?op=70'); // caraga el lateral					
			}
		})
	});
    


	$("#form-addform").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
	if (e.which == 13) {
	return false;
	}
	});


function Mostrar(){
 $("#btn-addform").removeClass("invisible");
 $("#btn-addform").addClass("visible");
 $("#cancel-x").removeClass("invisible");
 $("#cancel-x").addClass("visible");
 $("#temp-productos").show();
}

function Esconder(){
 $("#btn-addform").removeClass("visible");
 $("#btn-addform").addClass("invisible");
 $("#cancel-x").removeClass("visible");
 $("#cancel-x").addClass("invisible");
 $("#temp-productos").hide();
}

Esconder();






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
               $("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#ver").html(data); // lo que regresa de la busquea 
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
               $("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) { 
                $("#ventana").html(data);           
                $("#ver").load('application/src/routes.php?op=84'); // ver productos de la orden 
                $("#lateral").load('application/src/routes.php?op=70'); // caraga el lateral
            }
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
                $("#lateral").load('application/src/routes.php?op=70'); // caraga el lateral
            }
        });
    });   







// evita que se digite una cantidad mayor a la que hay en productos
  /*   $("#producto-busqueda").keyup(function(){ /// para la caja de busqueda
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
            Esconder();
        }
        });
    }); */








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
               $("#ver").load('application/src/routes.php?op=84'); // ver productos de la orden 
               $("#lateral").load('application/src/routes.php?op=70'); // caraga el lateral
            }
        })
    })

/// cambiar para porcentaje o establecer cantidad de propina
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

///////





    $("body").on("click","#del-descuento",function(){
    var dcantidad = $(this).attr('dcantidad');
    var dcodigo = $(this).attr('dcodigo');
    var descuento = $(this).attr('ddescuento');
       
        $.post("application/src/routes.php?op=94", {dcantidad:dcantidad, dcodigo:dcodigo, descuento:descuento}, 
        function(data){
               $('#ModalDescuento').modal('hide');
               $("#ver").load('application/src/routes.php?op=84'); // ver productos de la orden 
               $("#lateral").load('application/src/routes.php?op=70'); // caraga el lateral
        });
    });







// para ModalBalanza

    $("body").on("click","#xbalanza",function(){ // llamar nada mas a los productos
        
        $('#ModalBalanza').modal('show');
        
        var op = "429";

        var dataString = 'op='+op;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#productos_bal").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#productos_bal").html(data); // lo que regresa de la busquea 
            }
        }); 
    });



    $("body").on("click","#xfacturar",function(){ // llamar nada mas a los productos

        var op = "430";
        var probal = $(this).attr('probal');
        var dataString = 'op='+op+'&probal='+probal;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#ver").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $('#ModalBalanza').modal('hide');
                $("#ver").html(data); // lo que regresa de la busquea 
                $("#lateral").load('application/src/routes.php?op=70'); // caraga el lateral
            }
        }); 
    });



    $('#btn-balanza').click(function(e){ /// cambia la cantidad de los productos
        e.preventDefault();
        $.ajax({
            url: "application/src/routes.php?op=430",
            method: "POST",
            data: $("#form-balanza").serialize(),
            beforeSend: function () {
                // $('#btn-balanza').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
            },
            success: function(data){
               // $('#btn-balanza').html('Agregar').removeClass('disabled');
               $("#form-balanza").trigger("reset");
               $('#ModalBalanza').modal('hide');
               $("#ver").html(data); // lo que regresa de la busquea 
               $("#lateral").load('application/src/routes.php?op=70'); // caraga el lateral
            }
        });
    });







// lamar modal ticket
    $("body").on("click","#mticket",function(){ 
        $('#ModalTicket').modal('show');
        var op = "547";
        var dataString = 'op='+op;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#contenidomticket").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#contenidomticket").html(data); // lo que regresa de la busquea 
            }
        }); 

    });


    $("body").on("click","#opticket",function(){ // llamar nada mas a los productos

        var op = "551";
        var tipo = $(this).attr('tipo');
        var dataString = 'op='+op+'&tipo='+tipo;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            success: function(data) {            
                $('#ModalTicket').modal('hide');
                $("#vticket").html(data); // lo que regresa de la busquea 
            }
        }); 
    });










    $("body").on("click","#agrupado",function(){
        var op = "586";
        var dataString = 'op='+op;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            success: function(data) {            
                $("#msj_agrupado").html(data);
            }
        });
    });  




    $('#btn-comment').click(function(e){ /// cambia la cantidad de los productos
        e.preventDefault();
        $.ajax({
            url: "application/src/routes.php?op=700",
            method: "POST",
            data: $("#form-comment").serialize(),
            beforeSend: function () {
                $('#btn-comment').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
            },
            success: function(data){
               $('#btn-comment').html('Agregar').removeClass('disabled');
               $("#form-comment").trigger("reset");
               $('#ModalComentario').modal('hide');
                $("#msj_comment").html(data);
            }
        })
    })

    $("#form-comment").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
        if (e.which == 13) {
        return false;
        }
    });

	$("body").on("click","#selectComment",function(){
        $('#ModalComentario').modal('show');
        var iden = $(this).attr('iden');
        $('#iden').attr("value", iden);
        var op = "701";
        var dataString = 'op='+op+'&iden='+iden;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            success: function(data) {            
                $("#msj_comment").html(data);
            }
        });    
    });



    $("body").on("click","#btnCorrelativo",function(){ 
        $('#ModalTicket').modal('hide');
        $('#ModalCorrelativo').modal('show');

        var op = "714";
        var dataString = 'op='+op;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#contenidocorrelativo").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#contenidocorrelativo").html(data); // lo que regresa de la busquea 
            }
        }); 

    });

    $('#btn-correlativo').click(function(e){ /// cambia la cantidad de los productos
        e.preventDefault();
        $.ajax({
            url: "application/src/routes.php?op=713",
            method: "POST",
            data: $("#form-correlativo").serialize(),
            beforeSend: function () {
                $('#btn-correlativo').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
            },
            success: function(data){
               $('#btn-correlativo').html('Asignar').removeClass('disabled');
               $("#form-correlativo").trigger("reset");
               $("#contenidocorrelativo").html(data);
            }
        })
    })



    $("body").on("click","#credito-sin-factura",function(){
        var op = "720";
        var dataString = 'op='+op;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            success: function(data) {            
                $("#ver-credito-sin-factura").html(data); // lo que regresa de la busquea 
            }
        });
    });   


    function VerCreditoSinFactura(){
        var op = "721";
        var dataString = 'op='+op;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            success: function(data) {            
                $("#ver-credito-sin-factura").html(data); // lo que regresa de la busquea 
            }
        });
       }
       
       VerCreditoSinFactura();


}); // termina query