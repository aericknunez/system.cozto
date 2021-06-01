$(document).ready(function(){

		$('.datepicker').pickadate({
		  weekdaysShort: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		  weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		  monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre',
		  'Noviembre', 'Diciembre'],
		  monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct',
		  'Nov', 'Dic'],
		  showMonthsShort: true,
		  formatSubmit: 'dd-mm-yyyy',
		  close: 'Cancelar',
		  clear: 'Limpiar',
		  today: 'Hoy'
		})
    

    $(document).ready(function() {
    $('.mdb-select').materialSelect();
    });



	$('#btn-proadd').click(function(e){ /// para el formulario
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=20",
			method: "POST",
			data: $("#form-proadd").serialize(),
			success: function(data){
				// $("#form-proadd").trigger("reset");
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




/// para activar o desactivoar los botones
	$("body").on("click","#servicio",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#servicio').removeAttr("checked","checked");

			$('#compuesto').removeAttr("unchecked","unchecked");
			$('#caduca').removeAttr("unchecked","unchecked");
			$('#dependiente').removeAttr("unchecked","unchecked");

			$('#compuesto').removeAttr("disabled","disabled");
			$('#caduca').removeAttr("disabled","disabled");
			$('#dependiente').removeAttr("disabled","disabled");

		} else {
			//$('#compuesto').attr("disabled","disabled");
			$('#servicio').attr("checked","checked");

			$('#compuesto').removeAttr("checked","checked");
			$('#caduca').removeAttr("checked","checked");
			$('#dependiente').removeAttr("checked","checked");			

			$('#compuesto').attr("unchecked","unchecked");
			$('#caduca').attr("unchecked","unchecked");
			$('#dependiente').attr("unchecked","unchecked");

			$('#compuesto').attr("disabled","disabled");
			$('#caduca').attr("disabled","disabled");
			$('#dependiente').attr("disabled","disabled");

		}
		
	});


	$("body").on("click","#compuesto",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#compuesto').removeAttr("checked","checked");

			$('#servicio').removeAttr("unchecked","unchecked");
			$('#caduca').removeAttr("unchecked","unchecked");
			$('#dependiente').removeAttr("unchecked","unchecked");

			$('#servicio').removeAttr("disabled","disabled");
			$('#caduca').removeAttr("disabled","disabled");
			$('#dependiente').removeAttr("disabled","disabled");

		} else {
			//$('#compuesto').attr("disabled","disabled");
			$('#compuesto').attr("checked","checked");

			$('#servicio').removeAttr("checked","checked");
			$('#caduca').removeAttr("checked","checked");
			$('#dependiente').removeAttr("checked","checked");			

			$('#servicio').attr("unchecked","unchecked");
			$('#caduca').attr("unchecked","unchecked");
			$('#dependiente').attr("unchecked","unchecked");

			$('#servicio').attr("disabled","disabled");
			$('#caduca').attr("disabled","disabled");
			$('#dependiente').attr("disabled","disabled");

		}
		
	});

	$("body").on("click","#dependiente",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#dependiente').removeAttr("checked","checked");

			$('#compuesto').removeAttr("unchecked","unchecked");
			$('#caduca').removeAttr("unchecked","unchecked");
			$('#servicio').removeAttr("unchecked","unchecked");

			$('#compuesto').removeAttr("disabled","disabled");
			$('#caduca').removeAttr("disabled","disabled");
			$('#servicio').removeAttr("disabled","disabled");

		} else {
			//$('#compuesto').attr("disabled","disabled");
			$('#dependiente').attr("checked","checked");

			$('#compuesto').removeAttr("checked","checked");
			$('#caduca').removeAttr("checked","checked");
			$('#servicio').removeAttr("checked","checked");			

			$('#compuesto').attr("unchecked","unchecked");
			$('#caduca').attr("unchecked","unchecked");
			$('#servicio').attr("unchecked","unchecked");

			$('#compuesto').attr("disabled","disabled");
			$('#caduca').attr("disabled","disabled");
			$('#servicio').attr("disabled","disabled");

		}
		
	});


//////////////////////////////////////////ter mina activar desactivar    




// busqueda actualizar
	$("#producto-busqueda").keyup(function(){ /// para la caja de busqueda
		$.ajax({
		type: "POST",
		url: "application/src/routes.php?op=32",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#muestra-busqueda").css("background","#FFF url(images/LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#muestra-busqueda").show();
			$("#muestra-busqueda").html(data);
			$("#producto-busqueda").css("background","#FFF");
		}
		});
	});


	$("body").on("click","#select-p",function(){
		var cod = $(this).attr('cod');
		var descripcion = $(this).attr('descripcion');
		$("#muestra-busqueda").hide();
		window.location.href="?proup&key=" + cod;
	});


// formulario actualizar
	$('#btn-proup').click(function(e){ /// para el formulario
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=46",
			method: "POST",
			data: $("#form-proup").serialize(),
			success: function(data){
				$("#msj").html(data);			
			}
		})
	})
    


	$("#form-proup").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
	if (e.which == 13) {
	return false;
	}
	});


// busqueda actualizar
	$("#producto-agregar-busqueda").keyup(function(){ /// para la caja de busqueda
		$.ajax({
		type: "POST",
		url: "application/src/routes.php?op=50",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#muestra-agregar-busqueda").css("background","#FFF url(images/LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#muestra-agregar-busqueda").show();
			$("#muestra-agregar-busqueda").html(data);
			$("#producto-agregar-busqueda").css("background","#FFF");
		}
		});
	});


	$("body").on("click","#select-agrega",function(){
		var cod = $(this).attr('cod');
		var descripcion = $(this).attr('descripcion');
		$("#muestra-agregar-busqueda").hide();
		window.location.href="?proagregar&key=" + cod;
	});


// agrega
	$('#btn-productoagrega').click(function(e){ /// para el formulario
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=48",
			method: "POST",
			data: $("#form-productoagrega").serialize(),
			success: function(data){
				$("#form-productoagrega").trigger("reset");
				$("#destinoproductoagrega").html(data);			
			}
		})
	})
    



	$("#form-productoagrega").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
	if (e.which == 13) {
	return false;
	}
	});


	$("body").on("click","#delproagrega",function(){ // borrar producto
	var op = $(this).attr('op');
	var hash = $(this).attr('hash');
	var producto = $(this).attr('producto');
	    $.post("application/src/routes.php", {op:op, hash:hash, producto:producto}, function(data){
		$("#destinoproductoagrega").html(data);
	   	 });
	});




// busqueda actualizar
	$("#producto-averias").keyup(function(){ /// para la caja de busqueda
		$.ajax({
		type: "POST",
		url: "application/src/routes.php?op=53",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#muestra-averias").css("background","#FFF url(images/LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#muestra-averias").show();
			$("#muestra-averias").html(data);
			$("#producto-averias").css("background","#FFF");
		}
		});
	});


	$("body").on("click","#select-averia",function(){
		var cod = $(this).attr('cod');
		var descripcion = $(this).attr('descripcion');
		$("#muestra-averias").hide();
		window.location.href="?proaverias&key=" + cod;
	});




// agrega averias
	$('#btn-productoaverias').click(function(e){ /// para el formulario
	$('#btn-productoaverias').addClass('disabled');
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=51",
			method: "POST",
			data: $("#form-productoaverias").serialize(),
			success: function(data){
				$("#form-productoaverias").trigger("reset");
				$("#destinoaverias").html(data);			
				setTimeout(BotonEnable, 1000); // para desactivar elboton por un rato
			}
		})
	})
    

    function BotonEnable(){
        $('#btn-productoaverias').removeClass("disabled");
    }


	$("#form-productoaverias").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
	if (e.which == 13) {
	return false;
	}
	});


	$("body").on("click","#delaveria",function(){ // borrar producto
	var op = $(this).attr('op');
	var hash = $(this).attr('hash');
	var producto = $(this).attr('producto');
	    $.post("application/src/routes.php", {op:op, hash:hash, producto:producto}, function(data){
		$("#destinoaverias").html(data);
	   	 });
	});












// comienza modal de ajuste de cantidad de productos en modificar producto
/// llamar modal ver
    $("body").on("click","#modificarcantidad",function(){ 
        
        $('#ModalCantidad').modal('show');
        
        var key = $(this).attr('key');
        var op = $(this).attr('op');
        var dataString = 'op='+op+'&key='+key;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#cantproducto").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#cantproducto").html('<div class="text-center">Cantidad Actual</div><div class="text-center h1">'+data+'</div>'); // lo que regresa de la busquea         
            }
        });

        $('#codx').attr("value",key);
       
        
    });



  $('#btn-ajustari').click(function(e){ /// agregar un producto 
  e.preventDefault();
  $.ajax({
      url: "application/src/routes.php?op=572",
      method: "POST",
      data: $("#form-ajustari").serialize(),
      beforeSend: function () {
        $('#btn-ajustari').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
             // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
      success: function(data){
        $('#btn-ajustari').html('<i class="fas fa-save mr-1"></i> Ingresar').removeClass('disabled');       
        $("#form-ajustari").trigger("reset");
        // $("#contenido").html(data); 
        $('#cantidad').attr("value",data); 
        $('#ModalCantidad').modal('hide');
      }
    })
  });
    













}); // termina query