$(document).ready(function(){

function Selecciona(op, hash) {

        var dataString = 'op='+op+'&hash='+hash;
           
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
        })
}



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
  
  $('#criterio1').keyup(delay(function (e) {
    var valor=$(this).val();
    Selecciona(681, valor); 
  }, 700));

  $('#criterio2').keyup(delay(function (e) {
    var valor=$(this).val();
    Selecciona(682, valor); 
  }, 700));

  $('#criterio3').keyup(delay(function (e) {
    var valor=$(this).val();
    Selecciona(683, valor); 
  }, 700));

  $('#key').keyup(delay(function (e) {
    var valor=$(this).val();
    Selecciona(684, valor); 
  }, 700));



$("body").on("click","#deleteAll",function(){
   
    var dataString = 'op=685';
       
    $.ajax({
        type: "POST",
        url: "application/src/routes.php",
        data: dataString,
        beforeSend: function () {
           $("#contenido").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
        },
        success: function(data) {            
            $("#contenido").html(data); // lo que regresa de la busquea 
            $('#criterio1').val(null);
            $('#criterio2').val(null);
            $('#criterio3').val(null);
            $('#key').val(null);
        }
    })
}); 





}); // termina query