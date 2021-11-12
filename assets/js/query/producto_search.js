$(document).ready(function(){


/// llamar modal busqueda
$("body").on("click","#buscarProducto",function(){ 
		
	$('#BuscadorProductos').modal('show');

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
  
  $('#key').keyup(delay(function (e) {
    Search();
  }, 700));




$('#btn-busqueda').click(function(e){ /// agregar un producto 
	e.preventDefault();
	
        Search();

	});


  $('#cerrarmodal').click(function(e){ /// agregar un producto 
    e.preventDefault();
    
          Search();
  
    });


function Search(){
    $.ajax({
        type: "POST",
        url: "application/src/routes.php?op=54x",
        data:'keyword='+$("#key").val(),
        beforeSend: function(){
            $("#muestra-busqueda").css("background","#FFF url(assets/img/LoaderIcon.gif) no-repeat 550px");
        },
        success: function(data){
            $("#contenido").html(data);
        }
    });
}








}); // termina query