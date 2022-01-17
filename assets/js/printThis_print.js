$(document).ready(function(){


    $('#imprimir').on("click", function () {
      $('#vista').printThis({
        importCSS: false,
        loadCSS: [
        "http://localhost/cozto/assets/css/font-awesome-582.css",
        "http://localhost/cozto/assets/css/bootstrap.min.css", 
        "http://localhost/cozto/assets/css/mdb.min.css",
        "http://localhost/cozto/assets/css/galeria.css"],
        removeScripts: true,
         base: false
      });
    });



}); // termina query