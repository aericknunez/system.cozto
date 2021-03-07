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


$('.mdb-select').materialSelect();
    


	$('#btn-proadd').click(function(e){ /// agregar un producto 
	e.preventDefault();
	$.ajax({
			url: "application/src/routes.php?op=560",
			method: "POST",
			data: $("#form-proadd").serialize(),
			beforeSend: function () {
				$('#btn-proadd').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
	           // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
			success: function(data){
				$('#btn-proadd').html('<i class="fas fa-save mr-1"></i> GUARDAR PRODUCTO').removeClass('disabled');	      
				$("#form-proadd").trigger("reset");
				$("#ultimosproductos").html(data);	
			}
		})
	});
    


$("#form-proadd").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
if (e.which == 13) {
return false;
}
});








///////////// llamar modal para eliminar elemento
    $("body").on("click","#delpro",function(){ 
        
        $('#ConfirmDelete').modal('show');
        var op = $(this).attr('op');
        var iden = $(this).attr('iden');
         
        $('#borrar-producto').attr("op",op).attr("iden",iden);
        
    });



    $("body").on("click","#borrar-producto",function(){
        var op = $(this).attr('op');
        var iden = $(this).attr('iden');
        var dataString = 'op='+op+'&iden='+iden;

        $('#ConfirmDelete').modal('hide');

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#ultimosproductos").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#ultimosproductos").html(data); // lo que regresa de la busquea 
            }
        });
    });                 





/// para ajuste de inventario
    $("body").on("click","#iniciarajuste",function(){
        var op = "568";
        var dataString = 'op='+op;
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

        $('#cod').attr("value",key);
       
        
    });



/// para ajuste de inventario
    $("body").on("click","#establecercantidad",function(){
        var key = $(this).attr('key');
        var op = $(this).attr('op');
        var dataString = 'op='+op+'&key='+key;

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






  $('#btn-ajustari').click(function(e){ /// agregar un producto 
  e.preventDefault();
  $.ajax({
      url: "application/src/routes.php?op=570",
      method: "POST",
      data: $("#form-ajustari").serialize(),
      beforeSend: function () {
        $('#btn-ajustari').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
             // $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
      success: function(data){
        $('#btn-ajustari').html('<i class="fas fa-save mr-1"></i> Ingresar').removeClass('disabled');       
        $("#form-ajustari").trigger("reset");
        $("#contenido").html(data);  
        $('#ModalCantidad').modal('hide');
      }
    })
  });
    

















}); // termina query