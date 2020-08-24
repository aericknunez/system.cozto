$(document).ready(function(){

// busqueda actualizar
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
			Esconder();
		}
		});
	});

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
               $("#ver").load('application/src/routes.php?op=84'); // ver productos de la orden 
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







}); // termina query