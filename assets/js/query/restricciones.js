
    $.fn.extend({  // evita seleccionar
        disableSelection: function() { 
            this.each(function() { 
                if (typeof this.onselectstart != 'undefined') {
                    this.onselectstart = function() { return false; };
                } else if (typeof this.style.MozUserSelect != 'undefined') {
                    this.style.MozUserSelect = 'none';
                } else {
                    this.onmousedown = function() { return false; };
                }
            }); 
        } 
    });

    $(document).ready(function() {
        $('body').disableSelection();

    });



    $(document).on('dragstart', 'body', function(evt) { // evita arrartrar
      evt.preventDefault();
    });



    $(document).ready(function(){ // evita clic derecho
       $(document).bind("contextmenu",function(e){
          return false;
       });
    });

