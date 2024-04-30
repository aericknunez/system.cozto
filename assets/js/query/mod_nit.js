$(document).ready(function(){



/// Nueva cuenta
	$("body").on("click","#addcuenta",function(){ 
		
		$('#ModalAddCuenta').modal('show');

	});
    

 /// add cuenta    
	$('#btn-cuenta').click(function(e){ /// agregar un producto 
	e.preventDefault();

	$.ajax({
			url: "application/src/routes.php?op=400",
			method: "POST",
			data: $("#form-cuenta").serialize(),
			beforeSend: function () {
				$('#btn-cuenta').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
	           // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
			success: function(data){
				$('#btn-cuenta').html('Guardar').removeClass('disabled');	      
				$("#form-cuenta").trigger("reset");
				$("#contenido").html(data);	
				$('#ModalAddCuenta').modal('hide');
			}
		})
	});
    







///////////// llamar modal para eliminar elemento
    $("body").on("click","#xdelete",function(){ 
        
        $('#ConfirmDelete').modal('show');
        var op = $(this).attr('op');
        var iden = $(this).attr('iden');
         
        $('#borrar-cliente').attr("op",op).attr("iden",iden);
        
    });



    $("body").on("click","#borrar-cliente",function(){
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

// llamar modal ver
$("body").on("click","#xver",function(){ 
		
    $('#ModalVerCliente').modal('show');
    
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

    $('#btn-pro').attr("href",'?modal=editclientecf&key='+key);
    
});

//editar cliente credito fiscal
$('#btn-documento').click(function(e){ /// Nuevo Documento
    e.preventDefault();
    $.ajax({
        url: "application/src/routes.php?op=67-CF",
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
})

//Busqueda de Clientes Credito Fiscal
///////////// llamar modal para buscar Cliente
$("body").on("click","#buscarCliente",function(){ 
        
    $('#ModalBuscarCliente').modal('show');
    
});


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
  
  $('#clienteSearch').keyup(delay(function (e) {
    Search();
  }, 1000));


$('#btn-busqueda').click(function(e){ /// agregar un producto 
	e.preventDefault();
	
        Search();

	});

    function Search(){
        $.ajax({
            type: "POST",
            url: "application/src/routes.php?op=320x",
            data:'keyword='+$("#clienteSearch").val(),
            beforeSend: function(){
                $("#muestra-busqueda").css("background","#FFF url(assets/img/LoaderIcon.gif) no-repeat 550px");
            },
            success: function(data){
                $("#contenido").html(data);
            }
        });
    } // Termina busqueda de clientes de credito fiscal


















}); // termina query