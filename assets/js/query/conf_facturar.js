$(document).ready(function()
{

	$("body").on("click","#ninguno",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#ninguno').removeAttr("checked","checked");
			var dir = 'op=450&iden=ninguno&edo=0';
		} 
		else {
			$('#ninguno').attr("checked","checked");
			var dir = 'op=450&iden=ninguno&edo=1';
		}
	
	QueryGo(dir);	
	
	});


	$("body").on("click","#nota_envio",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#nota_envio').removeAttr("checked","checked");
			var dir = 'op=450&iden=nota_envio&edo=0';
		} 
		else {
			$('#nota_envio').attr("checked","checked");
			var dir = 'op=450&iden=nota_envio&edo=1';
		}
	
	QueryGo(dir);	
	
	});



	$("body").on("click","#ax0",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#ax0').removeAttr("checked","checked");
			var dir = 'op=450&iden=ax0&edo=0';
		} 
		else {
			$('#ax0').attr("checked","checked");
			var dir = 'op=450&iden=ax0&edo=1';
		}
	
	QueryGo(dir);	
	
	});


	$("body").on("click","#ax1",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#ax1').removeAttr("checked","checked");
			var dir = 'op=450&iden=ax1&edo=0';
		} 
		else {
			$('#ax1').attr("checked","checked");
			var dir = 'op=450&iden=ax1&edo=1';
		}
	
	QueryGo(dir);	
	
	});






	$("body").on("click","#bx0",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#bx0').removeAttr("checked","checked");
			var dir = 'op=450&iden=bx0&edo=0';
		} 
		else {
			$('#bx0').attr("checked","checked");
			var dir = 'op=450&iden=bx0&edo=1';
		}
	
	QueryGo(dir);	
	
	});


	$("body").on("click","#bx1",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#bx1').removeAttr("checked","checked");
			var dir = 'op=450&iden=bx1&edo=0';
		} 
		else {
			$('#bx1').attr("checked","checked");
			var dir = 'op=450&iden=bx1&edo=1';
		}
	
	QueryGo(dir);	
	
	});



	$("body").on("click","#cx0",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#cx0').removeAttr("checked","checked");
			var dir = 'op=450&iden=cx0&edo=0';
		} 
		else {
			$('#cx0').attr("checked","checked");
			var dir = 'op=450&iden=cx0&edo=1';
		}
	
	QueryGo(dir);	
	
	});


	$("body").on("click","#cx1",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#cx1').removeAttr("checked","checked");
			var dir = 'op=450&iden=cx1&edo=0';
		} 
		else {
			$('#cx1').attr("checked","checked");
			var dir = 'op=450&iden=cx1&edo=1';
		}
	
	QueryGo(dir);	
	
	});



	$("body").on("click","#dx0",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#dx0').removeAttr("checked","checked");
			var dir = 'op=450&iden=dx0&edo=0';
		} 
		else {
			$('#dx0').attr("checked","checked");
			var dir = 'op=450&iden=dx0&edo=1';
		}
	
	QueryGo(dir);	
	
	});


	$("body").on("click","#dx1",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#dx1').removeAttr("checked","checked");
			var dir = 'op=450&iden=dx1&edo=0';
		} 
		else {
			$('#dx1').attr("checked","checked");
			var dir = 'op=450&iden=dx1&edo=1';
		}
	
	QueryGo(dir);	
	
	});




	$("body").on("click","#ex0",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#ex0').removeAttr("checked","checked");
			var dir = 'op=450&iden=ex0&edo=0';
		} 
		else {
			$('#ex0').attr("checked","checked");
			var dir = 'op=450&iden=ex0&edo=1';
		}
	
	QueryGo(dir);	
	
	});


	$("body").on("click","#ex1",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#ex1').removeAttr("checked","checked");
			var dir = 'op=450&iden=ex1&edo=0';
		} 
		else {
			$('#ex1').attr("checked","checked");
			var dir = 'op=450&iden=ex1&edo=1';
		}
	
	QueryGo(dir);	
	
	});


	$("body").on("click","#fx0",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#fx0').removeAttr("checked","checked");
			var dir = 'op=450&iden=fx0&edo=0';
		} 
		else {
			$('#fx0').attr("checked","checked");
			var dir = 'op=450&iden=fx0&edo=1';
		}
	
	QueryGo(dir);	
	
	});


	$("body").on("click","#fx1",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#fx1').removeAttr("checked","checked");
			var dir = 'op=450&iden=fx1&edo=0';
		} 
		else {
			$('#fx1').attr("checked","checked");
			var dir = 'op=450&iden=fx1&edo=1';
		}
	
	QueryGo(dir);	
	
	});

	$("body").on("click","#gx0",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#gx0').removeAttr("checked","checked");
			var dir = 'op=450&iden=gx0&edo=0';
		} 
		else {
			$('#gx0').attr("checked","checked");
			var dir = 'op=450&iden=gx0&edo=1';
		}
	
	QueryGo(dir);	
	
	});


	$("body").on("click","#gx1",function(){ /// para el los botones de opciones

		if($(this).attr('checked')){ // es por que estaba activo
			$('#gx1').removeAttr("checked","checked");
			var dir = 'op=450&iden=gx1&edo=0';
		} 
		else {
			$('#gx1').attr("checked","checked");
			var dir = 'op=450&iden=gx1&edo=1';
		}
	
	QueryGo(dir);	
	
	});


function QueryGo(dir){

        var dataString = dir;

        $.ajax({
            type: "POST",
            url: "application/src/routes.php",
            data: dataString,
            beforeSend: function () {
               $("#contenido").html('<div class="row justify-content-md-center" ><img src="assets/img/load.gif" alt=""></div>');
            },
            success: function(data) {            
                $("#contenido").html(data); // lo que regresa de la busquea 
            }

    });      
}




});
