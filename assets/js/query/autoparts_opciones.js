$(document).ready(function(){


$('.mdb-select').materialSelect();
    



	$('#btn-addmarca').click(function(e){ /// para agregar marca
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=530",
			method: "POST",
			data: $("#form-addmarca").serialize(),
			success: function(data){
				$("#form-addmarca").trigger("reset");
				$("#destinomarca").html(data);
				$("#marca-motor").load('application/src/routes.php?op=14&select=Marca&tabla=autoparts_marca&iden=hash&nombre=marca');		

				LoaderOn();
			
			}
		});
	});
    

	$("#form-addmarca").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
	if (e.which == 13) {
	return false;
	}
	});



	$('#btn-addmodelos').click(function(e){ /// para agregar marca
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=532",
			method: "POST",
			data: $("#form-addmodelos").serialize(),
			success: function(data){
				$("#form-addmodelos").trigger("reset");
				$("#destinomodelo").html(data);
			}
		});
	});
    

	$("#form-addmodelos").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
	if (e.which == 13) {
	return false;
	}
	});



	$('#btn-addmotor').click(function(e){ /// para agregar marca
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=534",
			method: "POST",
			data: $("#form-addmotor").serialize(),
			success: function(data){
				$("#form-addmotor").trigger("reset");
				$("#destinomotor").html(data);
			}
		});
	});
    

	$("#form-addmotor").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
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
	    	
	    	if(valor == '1'){ $("#destinomarca").html(data); }
	    	if(valor == '2'){ $("#destinomodelo").html(data); }
	    	if(valor == '3'){ $("#destinomotor").html(data); }
			$('#ConfirmDelete').modal('hide');
			
			$("#marca-motor").load('application/src/routes.php?op=14&select=Marca&tabla=autoparts_marca&iden=hash&nombre=marca');		

	   	 });
	    LoaderOn();

	    
	});


function LoaderOn(){
		$.get("application/src/routes.php?op=14&select=Marca&tabla=autoparts_marca&iden=hash&nombre=marca",  function(data){
	    	$("#marca-modelo").html(data); 
	   	 });

}



}); // termina query