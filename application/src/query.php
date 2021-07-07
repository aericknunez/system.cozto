<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if($_SESSION["td"] != 100){
$numero = rand(1,9999999999);	
} else {
$numero = 1;	
}

//$numero = 1;

if(isset($_GET["modal"])) { 
echo '
	<script>
		$(document).ready(function()
		{
		  $("#' . $_GET["modal"] . '").modal("show");
		});
	</script>
	';


	if($_GET["modal"] == "conf_config"){
	echo '<script type="text/javascript" src="assets/js/query/conf_config.js?v='.$numero.'"></script>';
	}
	if($_GET["modal"] == "conf_root"){
	echo '<script type="text/javascript" src="assets/js/query/conf_config.js?v='.$numero.'"></script>';
	}
	if($_GET["modal"] == "img_negocio"){
	echo '<script type="text/javascript" src="assets/js/query/img_negocio.js?v='.$numero.'"></script>';
	}

	/// producto
	if($_GET["modal"] == "proadd"){
	echo '<script type="text/javascript" src="assets/js/query/modal.producto.js?v='.$numero.'"></script>';
	}
	if($_GET["modal"] == "productoBusqueda"){
	echo '<script type="text/javascript" src="assets/js/query/productoBusqueda.js?v='.$numero.'"></script>';
	}
	if($_GET["modal"] == "productoBusquedaTaller"){
	echo '<script type="text/javascript" src="assets/js/query/taller_producto.js?v='.$numero.'"></script>';	
	echo '<script type="text/javascript" src="assets/js/query/producto_vermodal.js?v='.$numero.'"></script>';	
	}

	/// proveedor
	if($_GET["modal"] == "editproveedor"){
	echo '<script type="text/javascript" src="assets/js/query/proveedor.js?v='.$numero.'"></script>';
	}
	/// Cliente
	if($_GET["modal"] == "editcliente"){
	echo '<script type="text/javascript" src="assets/js/query/cliente.js?v='.$numero.'"></script>';
	}


	/// facturar
	if($_GET["modal"] == "facturar"){
	// echo '<script type="text/javascript" src="assets/js/query/facturar.js?v='.$numero.'"></script>';
	include_once 'assets/js/query/facturar.php';
	}


	/// ventas
	if($_GET["modal"] == "descuento"){
	echo '<script type="text/javascript" src="assets/js/query/ventaPop.js?v='.$numero.'"></script>';
	}
	if($_GET["modal"] == "credito"){
	echo '<script type="text/javascript" src="assets/js/query/ventaPop.js?v='.$numero.'"></script>';
	}
	if($_GET["modal"] == "dfactura"){
	echo '<script type="text/javascript" src="assets/js/query/ventaPop.js?v='.$numero.'"></script>';
	}
	if($_GET["modal"] == "cliente"){
	echo '<script type="text/javascript" src="assets/js/query/ventaPop.js?v='.$numero.'"></script>';
	}
	if($_GET["modal"] == "oventas"){
	echo '<script type="text/javascript" src="assets/js/query/ventaPop.js?v='.$numero.'"></script>';
	}
	if($_GET["modal"] == "agrupado"){
	echo '<script type="text/javascript" src="assets/js/query/ventaPop.js?v='.$numero.'"></script>';
	}
// abono
	if($_GET["modal"] == "abonos"){
	echo '<script type="text/javascript" src="assets/js/query/credito.js?v='.$numero.'"></script>';
	}
// abonos cuentas
	if($_GET["modal"] == "abonos_cuentas"){
	echo '<script type="text/javascript" src="assets/js/query/cuentas.js?v='.$numero.'"></script>';
	}
	
// taller
	if($_GET["modal"] == "cliente_taller"){
	echo '<script type="text/javascript" src="assets/js/query/taller.js?v='.$numero.'"></script>';
	}
	if($_GET["modal"] == "edit_vehiculo_taller"){
	echo '<script type="text/javascript" src="assets/js/query/taller.js?v='.$numero.'"></script>';
	}
// cotizador
	if($_GET["modal"] == "cantidadc"){
	echo '<script type="text/javascript" src="assets/js/query/cotizaR.js?v='.$numero.'"></script>';
	}
	if($_GET["modal"] == "descuentocot"){
	echo '<script type="text/javascript" src="assets/js/query/cotizaR.js?v='.$numero.'"></script>';
	}


	/// Planilla
	if($_GET["modal"] == "editempleado"){
	echo '<script type="text/javascript" src="assets/js/query/planilla.js?v='.$numero.'"></script>';
	}


	if($_GET["modal"] == "respaldar"){
			$url = "sync/push.php?corte=1";
			echo '<script>
				$(document).ready(function(){

				function Respaldar(){
		                      $.ajax({
		                          type: "POST",
		                          url: "'.$url.'",
		                          success: function(data) {
		                            $("#respaldo").html(data);
		                          }
		                      });
		                  }

		        Respaldar();
		});
		</script>';
	}



} // termina modal

elseif($_SESSION["caduca"] != 0) {
echo '<script type="text/javascript" src="assets/js/query/noacceso.js?v='.$numero.'"></script>';
} 

//config
elseif(isset($_GET["tablas"])) {
echo '<script type="text/javascript" src="assets/js/query/conf_config.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["ctc"])) {
echo '<script type="text/javascript" src="assets/js/query/conf_config.js?v='.$numero.'"></script>';
}

elseif(isset($_GET["user"])) {
echo '<script type="text/javascript" src="system/user/login.js?v='.$numero.'"></script>';
} 

/// producto
elseif(isset($_GET["proadd"])) {
echo '<script type="text/javascript" src="assets/js/query/producto.js?v='.$numero.'"></script>';
	if($_SESSION["root_autoparts"] == "on"){
	echo '<script type="text/javascript" src="assets/js/query/autoparts.js?v='.$numero.'"></script>';	
	}
	if($_SESSION["root_taller"] == "on"){
	echo '<script type="text/javascript" src="assets/js/query/taller_producto.js?v='.$numero.'"></script>';	
	}
} 
elseif(isset($_GET["proopciones"])) {
echo '<script type="text/javascript" src="assets/js/query/proopciones.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["productos"])) {
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/producto_vermodal.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["proup"])) {
echo '<script type="text/javascript" src="assets/js/query/producto.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["proagregar"])) {
echo '<script type="text/javascript" src="assets/js/query/producto.js?v='.$numero.'"></script>';
}
elseif(isset($_GET["proaverias"])) {
echo '<script type="text/javascript" src="assets/js/query/producto.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["bajasexistencias"])) {
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/producto_vermodal.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["vencimientos"])) {
echo '<script type="text/javascript" src="assets/js/query/vencimientos.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/producto_vermodal.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["compuestos"])) {
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/producto_vermodal.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["pesaje"])) {
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/producto_pesaje.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["listadoproductos"])) {
echo '<script type="text/javascript" src="assets/js/query/producto_vermodal.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["ingresorapido"])) {
echo '<script type="text/javascript" src="assets/js/query/ingresorapido.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["modificarproducto"])) {
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/producto_vermodal.js?v='.$numero.'"></script>';
} 

elseif(isset($_GET["ajustedeinventario"])) {
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/producto_vermodal.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/ingresorapido.js?v='.$numero.'"></script>';
} 

elseif(isset($_GET["importarproducto"])) {
echo '<script type="text/javascript" src="assets/js/query/importarproducto.js?v='.$numero.'"></script>';
} 






elseif(isset($_GET["cotizar"])) {
echo '<script type="text/javascript" src="assets/js/printThis.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/cotizaR.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["cotizaciones"])) {
echo '<script type="text/javascript" src="assets/js/printThis.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/cotizaR.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
} 



//////////////// proveedor
elseif(isset($_GET["proveedoradd"])) {
echo '<script type="text/javascript" src="assets/js/query/proveedor.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["proveedorver"])) {
echo '
<script type="text/javascript" src="assets/js/addons/datatables.min.js?v='.$numero.'"></script>
<script type="text/javascript" src="assets/js/query/proveedordatatable.js?v='.$numero.'"></script>
<script type="text/javascript" src="assets/js/query/proveedor.js?v='.$numero.'"></script>';
} 

//////////////// cliente
elseif(isset($_GET["clienteadd"])) {
echo '<script type="text/javascript" src="assets/js/query/cliente.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["clientever"])) {
echo '
<script type="text/javascript" src="assets/js/addons/datatables.min.js?v='.$numero.'"></script>
<script type="text/javascript" src="assets/js/query/clientedatatable.js?v='.$numero.'"></script>
<script type="text/javascript" src="assets/js/query/cliente.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["cliente_facturas"])) {
echo '
<script type="text/javascript" src="assets/js/addons/datatables.min.js?v='.$numero.'"></script>
<script type="text/javascript" src="assets/js/query/clientedatatable.js?v='.$numero.'"></script>
<script type="text/javascript" src="assets/js/query/cliente.js?v='.$numero.'"></script>';
} 

//////////////// creditos
elseif(isset($_GET["creditos"])) {
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/credito.js?v='.$numero.'"></script>';
} 

elseif(isset($_GET["creditospendientes"])) {
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/credito.js?v='.$numero.'"></script>';
} 

elseif(isset($_GET["creditosvercliente"])) {
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/credito.js?v='.$numero.'"></script>';
} 



//////////////// cuentas
elseif(isset($_GET["cuentas"])) {
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/cuentas.js?v='.$numero.'"></script>';
} 

elseif(isset($_GET["ccuentaspendientes"])) {
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/cuentas.js?v='.$numero.'"></script>';
} 


//// gastos
elseif(isset($_GET["gastos"])) {
echo '<script type="text/javascript" src="assets/js/query/gastos.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["entradas"])) {
echo '<script type="text/javascript" src="assets/js/query/gastos.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["remesas"])) {
echo '<script type="text/javascript" src="assets/js/query/gastos.js?v='.$numero.'"></script>';
} 
//// corte
elseif(isset($_GET["corte"])) {
echo '<script type="text/javascript" src="assets/js/query/corte.js?v='.$numero.'"></script>';
} 

//// Historial
elseif(isset($_GET["consolidado"])) {
echo '<script type="text/javascript" src="assets/js/query/historial.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/historial_modal_gastos.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["rdiario"])) {
echo '<script type="text/javascript" src="assets/js/query/historial.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["vdiario"])) {
echo '<script type="text/javascript" src="assets/js/query/historial.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["vmensual"])) {
echo '<script type="text/javascript" src="assets/js/query/historial.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["hcortes"])) {
echo '<script type="text/javascript" src="assets/js/query/historial.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["gdiario"])) {
echo '<script type="text/javascript" src="assets/js/query/historial.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/historial_modal_gastos.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["gmensual"])) {
echo '<script type="text/javascript" src="assets/js/query/historial.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/historial_modal_gastos.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["descuentos"])) {
echo '<script type="text/javascript" src="assets/js/query/historial.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["gra_semanal"])) include_once 'assets/js/query/gra_semanal.php';
elseif(isset($_GET["gra_mensual"])) include_once 'assets/js/query/gra_mensual.php';
elseif(isset($_GET["gra_clientes"])) include_once 'assets/js/query/gra_clientes.php';
elseif(isset($_GET["gra_semestre"])) include_once 'assets/js/query/gra_semestre.php';

elseif(isset($_GET["utilidades"])) {
echo '<script type="text/javascript" src="assets/js/query/historial.js?v='.$numero.'"></script>';
} 

elseif(isset($_GET["listaventa"])) {
echo '<script type="text/javascript" src="assets/js/query/historial.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["cortez"])) {
echo '<script type="text/javascript" src="assets/js/query/historial.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["movimientos"])) {
echo '<script type="text/javascript" src="assets/js/query/historial.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["rmensual"])) {
echo '<script type="text/javascript" src="assets/js/query/historial.js?v='.$numero.'"></script>';
} 



/// reportes
elseif(isset($_GET["ventadetalle"])) {
echo '<script type="text/javascript" src="assets/js/query/reportes.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["ventaagrupado"])) {
echo '<script type="text/javascript" src="assets/js/query/reportes.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["gastodetallado"])) {
echo '<script type="text/javascript" src="assets/js/query/reportes.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["ingresos"])) {
echo '<script type="text/javascript" src="assets/js/query/reportes.js?v='.$numero.'"></script>';
} 









// panel de control
elseif(isset($_GET["control"])) {
echo '<script type="text/javascript" src="assets/js/query/control.js?v='.$numero.'"></script>';
include_once 'assets/js/query/gra_control.php';
} 


//////////////// Planilla
elseif(isset($_GET["addempleado"])) {
echo '<script type="text/javascript" src="assets/js/query/planilla.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["verempleado"])) {
echo '<script type="text/javascript" src="assets/js/printThis.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/planilla.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["pdescuentos"])) {
echo '<script type="text/javascript" src="assets/js/query/planilla.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["planillasver"])) {
echo '<script type="text/javascript" src="assets/js/printThis.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/planilla.js?v='.$numero.'"></script>';
} 

//////////////// BackUp
elseif(isset($_GET["backup"])) {
echo '<script type="text/javascript" src="assets/js/query/backup.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["deleteall"])) {
echo '<script type="text/javascript" src="assets/js/query/backup.js?v='.$numero.'"></script>';
} 


elseif(isset($_GET["autoopciones"])) {
echo '<script type="text/javascript" src="assets/js/query/autoparts_opciones.js?v='.$numero.'"></script>';
} 


elseif(isset($_GET["autoverproductos"])) {
if($_SESSION["root_autoparts"] == "on"){
echo '<script type="text/javascript" src="assets/js/query/autopartsVerProductos.js?v='.$numero.'"></script>';	
}
} 
elseif(isset($_GET["autoproadd"])) {
		if($_SESSION["root_autoparts"] == "on"){
	echo '<script type="text/javascript" src="assets/js/query/autoparts.js?v='.$numero.'"></script>';
	echo '<script type="text/javascript" src="assets/js/query/autopartsProducto.js?v='.$numero.'"></script>';	
		}
} 



/// taller
elseif(isset($_GET["clientes"])) {
echo '<script type="text/javascript" src="assets/js/query/taller.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["vehiculos"])) {
echo '<script type="text/javascript" src="assets/js/query/taller.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["mantenimiento"])) {
echo '<script type="text/javascript" src="assets/js/query/taller.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
} 



/// ecommerce
elseif(isset($_GET["epedidos"])) {
echo '<script type="text/javascript" src="assets/js/query/ecommerce.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
} 

elseif(isset($_GET["eusuarios"])) {
echo '<script type="text/javascript" src="assets/js/query/ecommerce.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
} 

elseif(isset($_GET["eproductos"])) {
echo '<script type="text/javascript" src="assets/js/query/ecommerce.js?v='.$numero.'"></script>';
echo '<script type="text/javascript" src="assets/js/query/paginador.js?v='.$numero.'"></script>';
} 

elseif(isset($_GET["ecategorias"])) {
echo '<script type="text/javascript" src="assets/js/query/ecommerce.js?v='.$numero.'"></script>';
} 




//////////////// factura
elseif(isset($_GET["mod_factura"])) {
echo '<script type="text/javascript" src="assets/js/query/conf_facturar.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["search"])) {
echo '<script type="text/javascript" src="assets/js/query/search.js?v='.$numero.'"></script>';
include_once 'assets/js/query/Imprimir.php';
} 
elseif(isset($_GET["reportef"])) {
echo '<script type="text/javascript" src="assets/js/query/facturar.js?v='.$numero.'"></script>';
} 




////////// transferencias
elseif(isset($_GET["transferencias"])) {
echo '<script type="text/javascript" src="assets/js/query/transferencias.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["enviadas"])) {
echo '<script type="text/javascript" src="assets/js/query/transferencias.js?v='.$numero.'"></script>';
} 
elseif(isset($_GET["asociar"])) {
echo '<script type="text/javascript" src="assets/js/query/transferencias.js?v='.$numero.'"></script>';
} 










else{
/// lo que llevara index
//echo '<script type="text/javascript" src="assets/js/query/ventas.js?v='.$numero.'"></script>';

	if($venta == TRUE){ // si es en venta
		if($tventa == 1){
			echo '<script type="text/javascript" src="assets/js/query/ventaR.js?v='.$numero.'"></script>';
		} else {
			echo '<script type="text/javascript" src="assets/js/query/ventaL.js?v='.$numero.'"></script>';
			// echo '<script type="text/javascript" src="assets/js/query/ventaL_filtrocantidad.js?v='.$numero.'"></script>';
		}

	/// para actualizar automaticamente el lateral cada 3 seg
		if($_SESSION['root_multiusuario'] == "on"){
		echo '<script type="text/javascript" src="assets/js/query/venta_getlateral.js?v='.$numero.'"></script>';		
		}
	} 

	if($_SESSION["caja_apertura"] == NULL){ // para aperturar caja
		echo '<script type="text/javascript" src="assets/js/query/abrircaja.js?v='.$numero.'"></script>';
	}

}
	
?>

<script>
	
	$("body").on("click","#cambiar",function(){
        var op = $(this).attr('op');
        $.post("application/src/routes.php", {op:op}, 
        	function(htmlexterno){
            window.location.href="?";
        });
    });	


// preloader
    $(window).on("load", function () {
        $('#mdb-preloader').fadeOut('fast');
    });

</script>








<script>
	$("body").on("click","#pop-up",function(){

		var url = $(this).attr('url');
      	var caracteristicas = "height=100,width=175,scrollTo,resizable=1,scrollbars=1,location=1, top=100, left=500";
      	nueva=window.open(url, 'Popup', caracteristicas);
      	return false;
    });	
</script>






<?php // restringir Acciones

if(!isset($_GET["control"])) {
// echo '<script type="text/javascript" src="assets/js/query/restricciones.js?v='.$numero.'"></script>';
} 

?>