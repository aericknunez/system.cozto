<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if($_SESSION["caduca"] != 0) include_once 'system/index/noacceso.php';

elseif(isset($_GET["modal"])) include_once 'system/modal/modal.php';

elseif(isset($_GET["user"])) include_once 'system/user/user.php';

elseif(isset($_GET["configuraciones"])) include_once 'system/config_configuraciones/configuraciones.php';

elseif(isset($_GET["root"])  and $_SESSION['tipo_cuenta'] == "1") include_once 'system/config_configuraciones/root.php';
elseif(isset($_GET["tablas"])) include_once 'system/config_configuraciones/tablas.php';

elseif(isset($_GET["ctc"])) include_once 'system/config_configuraciones/cambio_tipo_cuenta.php';


// producto
elseif(isset($_GET["proadd"])) include_once 'system/producto/proadd.php'; // agregar
elseif(isset($_GET["proopciones"])) include_once 'system/producto/proopciones.php'; //opciones
elseif(isset($_GET["productos"])) include_once 'system/producto/producto.php'; //todos los productos
elseif(isset($_GET["proup"])) include_once 'system/producto/proup.php'; // actualizar
elseif(isset($_GET["proagregar"])) include_once 'system/producto/proagregar.php'; // agregar producto
elseif(isset($_GET["proaverias"])) include_once 'system/producto/proaverias.php'; // agregar averias
elseif(isset($_GET["bajasexistencias"])) include_once 'system/producto/bajasexistencias.php'; 
elseif(isset($_GET["vencimientos"])) include_once 'system/producto/vencimientos.php'; 
elseif(isset($_GET["compuestos"])) include_once 'system/producto/compuestos.php'; 
elseif(isset($_GET["pesaje"])) include_once 'system/producto/pesajes.php'; 
elseif(isset($_GET["listadoproductos"])) include_once 'system/producto/productoresumen.php'; 
elseif(isset($_GET["estadistica_costos"])) include_once 'system/producto/estadistica_costos.php'; 
// rapido
elseif(isset($_GET["ingresorapido"])) include_once 'system/herramientas/ingresarrapido.php'; 
elseif(isset($_GET["modificarproducto"])) include_once 'system/herramientas/productos.php'; 
elseif(isset($_GET["ajustedeinventario"])) include_once 'system/herramientas/ajustedeinventario.php'; 
elseif(isset($_GET["importarproducto"])) include_once 'system/herramientas/importarproductos.php'; 
elseif(isset($_GET["restartprecio"])) include_once 'system/herramientas/restartprecio.php'; 





elseif(isset($_GET["cotizar"])) include_once 'system/cotizar/cotizar.php'; 
elseif(isset($_GET["cotizaciones"])) include_once 'system/cotizar/cotizaciones.php'; 


// proveedores
elseif(isset($_GET["proveedoradd"])) include_once 'system/proveedor/proveedores.php'; // agregar proveedores
elseif(isset($_GET["proveedorver"])) include_once 'system/proveedor/proveedorver.php'; // proveedores


// clientes
elseif(isset($_GET["clienteadd"])) include_once 'system/cliente/clientes.php'; // agregar cliente
elseif(isset($_GET["clientever"])) include_once 'system/cliente/clientever.php'; // ver clientes
elseif(isset($_GET["cliente_facturas"])) include_once 'system/cliente/cliente_facturas.php'; // ver clientes

// creditos
elseif(isset($_GET["creditos"])) include_once 'system/credito/creditosver.php'; // ver todos los creditos
elseif(isset($_GET["creditospendientes"])) include_once 'system/credito/creditospendientes.php'; // pendientes
elseif(isset($_GET["creditosvercliente"])) include_once 'system/credito/creditosvercliente.php'; // credito cleinte


// Cuentas por pagar
elseif(isset($_GET["cuentas"])) include_once 'system/cuentas/cuentasver.php'; // ver todos las cuentas
elseif(isset($_GET["cuentaspendientes"])) include_once 'system/cuenta/cuentaspendientes.php'; // pendientes


// Modulo de taller
elseif(isset($_GET["clientes"])) include_once 'system/taller/clientes.php'; // clientes nuevos
elseif(isset($_GET["vehiculos"])) include_once 'system/taller/vehiculos.php'; // vehiculos
elseif(isset($_GET["mantenimiento"])) include_once 'system/taller/mantenimiento.php'; // mantenimiento




// Gastos y compras
elseif(isset($_GET["gastos"])) include_once 'system/gastos/gastos_update.php'; 
elseif(isset($_GET["entradas"])) include_once 'system/gastos/entradas.php'; 
elseif(isset($_GET["remesas"])) include_once 'system/gastos/remesas.php'; 
elseif(isset($_GET["cuentas_banco"])) include_once 'system/gastos/cuentas.php'; 


// Corte Diario
elseif(isset($_GET["corte"])) include_once 'system/corte/cortes.php'; 



// Historia;
elseif(isset($_GET["consolidado"])) include_once 'system/historial/consolidado_diario.php';
elseif(isset($_GET["vdiario"])) include_once 'system/historial/vdiario.php'; 
elseif(isset($_GET["vmensual"])) include_once 'system/historial/vmensual.php'; 
elseif(isset($_GET["hcortes"])) include_once 'system/historial/hcortes.php'; 
elseif(isset($_GET["gdiario"])) include_once 'system/historial/gdiario.php'; 
elseif(isset($_GET["gmensual"])) include_once 'system/historial/gmensual.php'; 
elseif(isset($_GET["descuentos"])) include_once 'system/historial/descuentos.php'; 
elseif(isset($_GET["utilidades"])) include_once 'system/historial/utilidades.php'; 
elseif(isset($_GET["listaventa"])) include_once 'system/historial/listaventa.php'; 
elseif(isset($_GET["cortez"])) include_once 'system/historial/cortez.php'; 
elseif(isset($_GET["movimientos"])) include_once 'system/historial/movimientos.php'; 
elseif(isset($_GET["rmensual"])) include_once 'system/historial/reportemensual.php'; 
elseif(isset($_GET["ventasxuser"])) include_once 'system/historial/ventasxuser.php'; 
elseif(isset($_GET["nota_envio"])) include_once 'system/historial/nota_envio.php'; 

// reportes
elseif(isset($_GET["ventadetalle"])) include_once 'system/reportes/ventasdetalle.php'; 
elseif(isset($_GET["ventaagrupado"])) include_once 'system/reportes/ventaagrupado.php'; 
elseif(isset($_GET["gastodetallado"])) include_once 'system/reportes/gastodetallado.php'; 
elseif(isset($_GET["ingresos"])) include_once 'system/reportes/ingresos.php'; 
elseif(isset($_GET["kardex"])) include_once 'system/reportes/verkardex.php'; 
elseif(isset($_GET["raverias"])) include_once 'system/reportes/averias.php'; 
elseif(isset($_GET["reporte_repartidor"])) include_once 'system/reportes/reporte-repartidor.php'; 



// graficos;
elseif(isset($_GET["gra_semanal"])) include_once 'system/historial/gra_semanal.php';
elseif(isset($_GET["gra_mensual"])) include_once 'system/historial/gra_mensual.php';
elseif(isset($_GET["gra_clientes"])) include_once 'system/historial/gra_clientes.php';
elseif(isset($_GET["gra_semestre"])) include_once 'system/historial/gra_semestre.php';



// Panel de Control
elseif(isset($_GET["control"])) include_once 'system/control/control.php';


// planilla
elseif(isset($_GET["addempleado"])) include_once 'system/planilla/empleados.php'; // agregar planilla
elseif(isset($_GET["verempleado"])) include_once 'system/planilla/empleadover.php'; // ver empleados
elseif(isset($_GET["pdescuentos"])) include_once 'system/planilla/descuentos.php'; // ver descuentos
elseif(isset($_GET["planillasver"])) include_once 'system/planilla/planillasver.php'; // ver planilla

// backup
elseif(isset($_GET["backup"])) include_once 'system/bdbackup/respaldo.php'; // backup de bd
elseif(isset($_GET["deleteall"])) include_once 'system/bdbackup/eliminardatos.php'; // Elimina DB




// opciones de autoparts
elseif(isset($_GET["autoopciones"])) include_once 'system/autoparts/opciones.php'; 
elseif(isset($_GET["autoverproductos"])) include_once 'system/autoparts/verproductos.php'; 
elseif(isset($_GET["autoproadd"])) include_once 'system/autoparts/proadd.php'; // agregar


// ecommerce
elseif(isset($_GET["epedidos"])) include_once 'system/ecommerce/commerce.php'; 
elseif(isset($_GET["eusuarios"])) include_once 'system/ecommerce/eusuarios.php'; 
elseif(isset($_GET["eproductos"])) include_once 'system/ecommerce/verproductos.php'; 
elseif(isset($_GET["ecategorias"])) include_once 'system/ecommerce/categoria_pronombre.php'; 



// factura
elseif(isset($_GET["mod_factura"])) include_once 'system/facturar/mod_factura.php'; // cambia lo de la factra
elseif(isset($_GET["search"])) include_once 'system/facturar/busqueda.php'; // search factura
elseif(isset($_GET["reportef"])) include_once 'system/facturar/reportef.php'; // search factura
elseif(isset($_GET["mod_nit"])) include_once 'system/facturar/modificar_datos_nit.php'; // modificar datos NIT
elseif(isset($_GET["busquedaOpt"])) include_once 'system/facturar/buscar_campo.php'; // Buscar por campo

//trasnferencias
elseif(isset($_GET["transferencias"])) include_once 'system/transferencias/transfer.php'; 
elseif(isset($_GET["enviadas"])) include_once 'system/transferencias/enviadas.php'; 
elseif(isset($_GET["asociar"])) include_once 'system/transferencias/asociar.php'; 






else{
include_once 'system/index/index.php';
}
	
?>