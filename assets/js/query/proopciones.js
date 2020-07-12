$(document).ready(function(){

    $(document).ready(function() {
    $('.mdb-select').materialSelect();
    });



/// categorias
	$('#btn-addcategoria').click(function(e){ /// para agregar categoria
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=22",
			method: "POST",
			data: $("#form-addcategoria").serialize(),
			success: function(data){
				$("#form-addcategoria").trigger("reset");
				$("#destinocategoria").html(data);
				$("#categoriax").load('application/src/routes.php?op=14&select=Categoria&tabla=producto_categoria&iden=hash&nombre=categoria');
			}
		})
	})
    

	$("#form-addcategoria").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
	if (e.which == 13) {
	return false;
	}
	});





/// sub categorias
	$('#btn-subcategoria').click(function(e){ /// agregar sub categoria
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=19",
			method: "POST",
			data: $("#form-subcategoria").serialize(),
			beforeSend: function () {
				$('#btn-subcategoria').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
	           // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
			success: function(data){
				$('#btn-subcategoria').html('Guardar').removeClass('disabled');	      
				$("#form-subcategoria").trigger("reset");
				$("#destinocategoria").html(data);	
				$("#categoriax").load('application/src/routes.php?op=14&select=Categoria&tabla=producto_categoria&iden=hash&nombre=categoria');				
			}
		})
	});
    

/// Unidades de medida
	$('#btn-addunidad').click(function(e){ /// para agregar categoria
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=24",
			method: "POST",
			data: $("#form-addunidad").serialize(),
			success: function(data){
				$("#form-addunidad").trigger("reset");
				$("#destinounidad").html(data);			
			}
		})
	})
    

	$("#form-addunidad").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
	if (e.which == 13) {
	return false;
	}
	});






/// Caracteristicas
	$('#btn-addcarateristica').click(function(e){ /// para agregar categoria
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=26",
			method: "POST",
			data: $("#form-addcarateristica").serialize(),
			success: function(data){
				$("#form-addcarateristica").trigger("reset");
				$("#destinocaracteristica").html(data);			
			}
		})
	})
    

	$("#form-addcarateristica").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
	if (e.which == 13) {
	return false;
	}
	});

	




/// ubicacion
	$('#btn-addubicacion').click(function(e){ /// para agregar ubicacion
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=28",
			method: "POST",
			data: $("#form-addubicacion").serialize(),
			success: function(data){
				$("#form-addubicacion").trigger("reset");
				$("#destinoubicacion").html(data);			
			}
		})
	})
    

	$("#form-addubicacion").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
	if (e.which == 13) {
	return false;
	}
	});








///////////// llamar modal para eliminar elemento
	$("body").on("click","#xdelete",function(){ 
		
		var op = $(this).attr('op');
		var hash = $(this).attr('hash');
		var valor = $(this).attr('valor');
		var tipo = $(this).attr('tipo');

		// valor es para ver cual div actualizar
		// tipo es solo para categoria, si es 1 categoria, 2 subcategoria
		$('#btn-modal').attr("valor",valor).attr("op",op).attr("hash",hash).attr("tipo",tipo);
		$('#ConfirmDelete').modal('show');
	});
    



	$("body").on("click","#btn-modal",function(){ // borrar el elemento
	var op = $(this).attr('op');
	var valor = $(this).attr('valor');
	var hash = $(this).attr('hash');
	var tipo = $(this).attr('tipo');
	    $.post("application/src/routes.php", {op:op, hash:hash, tipo:tipo}, function(data){
	    	
	    	if(valor == '1'){ $("#destinocategoria").html(data); }
	    	if(valor == '2'){ $("#destinounidad").html(data); }
	    	if(valor == '3'){ $("#destinocaracteristica").html(data); }
	    	if(valor == '4'){ $("#destinoubicacion").html(data); }
		
			$('#ConfirmDelete').modal('hide');
	   	 });
	});







}); // termina query