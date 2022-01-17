$(document).ready(function(){


    $('#imprimir').on("click", function () {
      $('#vista').printThis({
        importCSS: false,
        loadCSS: [
        "https://sistema.hibridosv.com/assets/css/font-awesome-582.css",
        "https://sistema.hibridosv.com/assets/css/bootstrap.min.css", 
        "https://sistema.hibridosv.com/assets/css/mdb.min.css",
        "https://sistema.hibridosv.com/assets/css/galeria.css"],
        removeScripts: true,
         base: false
      });
    });



}); // termina query