<style>
    body { 
        background-color: black; /* La página de fondo será negra */
        color: 000; 
    	}
</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if($_REQUEST["modal"]=="conf_config") include_once 'system/modal/modal/conf_config.php';

if($_REQUEST["modal"]=="conf_root") include_once 'system/modal/modal/conf_root.php';

if($_REQUEST["modal"]=="img_negocio") include_once 'system/modal/modal/imagen_negocio.php';

if($_REQUEST["modal"]=="editproveedor") include_once 'system/modal/modal/editar-proveedor.php';

if($_REQUEST["modal"]=="editcliente") include_once 'system/modal/modal/editar-cliente.php';
if($_REQUEST["modal"]=="editclientecf") include_once 'system/modal/modal/editar-clientecf.php';

// facturar
if($_REQUEST["modal"]=="facturar") include_once 'system/modal/modal/facturar.php';


// producto
if($_REQUEST["modal"]=="proadd") include_once 'system/modal/modal/proadd.php';

if($_REQUEST["modal"]=="productoBusqueda") include_once 'system/modal/modal/productoBusqueda.php';
if($_REQUEST["modal"]=="productoBusquedaTaller") include_once 'system/modal/modal/productoBusquedaTaller.php';
if($_REQUEST["modal"]=="productoBusquedaAvanzada") include_once 'system/modal/modal/productoBusquedaAvanzada.php';



// venta
if($_REQUEST["modal"]=="descuento") include_once 'system/modal/modal/descuento.php';

if($_REQUEST["modal"]=="credito") include_once 'system/modal/modal/credito.php';

if($_REQUEST["modal"]=="dfactura") include_once 'system/modal/modal/dfactura.php';

if($_REQUEST["modal"]=="oventas") include_once 'system/modal/modal/oventas.php';

if($_REQUEST["modal"]=="oventascot") include_once 'system/modal/modal/oventascot.php';

if($_REQUEST["modal"]=="cliente") include_once 'system/modal/modal/cliente.php';

if($_REQUEST["modal"]=="agrupado") include_once 'system/modal/modal/agrupado.php';


//taller -- para agregar a la factura
if($_REQUEST["modal"]=="cliente_taller") include_once 'system/modal/modal/cliente_taller.php';

if($_REQUEST["modal"]=="edit_cliente_taller") include_once 'system/modal/modal/editar_cliente_taller.php';
if($_REQUEST["modal"]=="edit_vehiculo_taller") include_once 'system/modal/modal/editar_vehiculo_taller.php';


// creditos
if($_REQUEST["modal"]=="abonos") include_once 'system/modal/modal/creditos_abonos.php';
if($_REQUEST["modal"]=="faturar_credito") include_once 'system/modal/modal/faturar_credito.php';

if($_REQUEST["modal"]=="cre_prodcuto") include_once 'system/modal/modal/creditos_producto.php';


// cuentas abonos
if($_REQUEST["modal"]=="abonos_cuentas") include_once 'system/modal/modal/cuentas_abonos.php';


// cotizacion
if($_REQUEST["modal"]=="cantidadc") include_once 'system/modal/modal/cantidad_cotizador.php';

if($_REQUEST["modal"]=="descuentocot") include_once 'system/modal/modal/descuento_cot.php';

if($_REQUEST["modal"]=="respaldar") include_once 'system/modal/modal/respaldar.php';


/// planilla
if($_REQUEST["modal"]=="editempleado") include_once 'system/modal/modal/editar-empleado.php';

// add repartidor a la factura
if($_REQUEST["modal"]=="add_repartidor") include_once 'system/modal/modal/repartidor.php';


// add fecha de entrega a la factura
if($_REQUEST["modal"]=="add_fecha") include_once 'system/modal/modal/establecer_entrega.php';
?>