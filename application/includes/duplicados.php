<?
include_once '../common/Helpers.php';
include_once '../common/Encrypt.php';
include_once 'variables_db.php';
include_once 'db_connect.php';
include_once 'functions.php';
sec_session_start();
include_once '../common/Mysqli.php';
include_once '../common/Fechas.php';



// Delete("corte_diario", "user", $fecha);


  function Delete($tabla, $hash){
    $db = new dbConn();

$dir = $this->Tablas();


// foreach ($dir as $tabla) {

//   $db->delete($tabla, "WHERE td=" . $_SESSION["td"]);

// } /// termina recorrido de directorios




// $a = $db->query("SELECT * FROM $tabla WHERE hash = '$hash'");
//     foreach ($a as $b) { //$b["id"]

//     $ax = $db->query("SELECT * FROM $tabla WHERE hora = '$hora' and $cod = '$codigo' and fecha = '$fecha'");

//     if($ax->num_rows > 1){
//         $contador = $contador + $ax->num_rows;
//         $cant = $ax->num_rows - 1;

//         if ( $db->delete("$tabla", "WHERE hora = '$hora' and $cod = '$codigo' and fecha = '$fecha' LIMIT " . $cant)) {
//                 echo "$cant - Record Deleted!<br />"; 
//             } unset($cant);

//         $ax->close();
//     } 

//     } 


//     $a->close();
//  }
 



public function Tablas(){

$dir  = array(
"ajuste_inventario", 
"ajuste_inventario_activate", 
"autoparts_busqueda_producto", 
"autoparts_item", 
"autoparts_marca", 
"autoparts_modelo", 
"caracteristicas", 
"caracteristicas_asig", 
"clientes", 
"config_master", 
"config_root", 
"corte_diario", 
"cotizaciones", 
"cotizaciones_data", 
"creditos", 
"creditos_abonos",
"ecommerce", 
"ecommerce_data", 
"entradas_efectivo", 
"facturar_documento", 
"facturar_documento_factura", 
"facturar_opciones", 
"gastos", 
"gastos_categorias", 
"gastos_cuentas", 
"gastos_images", 
"marcas", 
"marca_asig", 
"pesaje", 
"planilla_descuentos", 
"planilla_descuentos_asig", 
"planilla_empleados", 
"planilla_extras", 
"planilla_pagos",
"producto", 
"producto_averias", 
"producto_cambios", 
"producto_categoria", 
"producto_categoria_sub", 
"producto_compuestos", 
"producto_dependiente", 
"producto_devoluciones", 
"producto_imagenes", 
"producto_ingresado", 
"producto_precio", 
"producto_precio_mayorista", 
"producto_precio_promo", 
"producto_tags", 
"producto_unidades", 
"proveedores", 
"sync_tabla", 
"sync_tables_updates", 
"sync_up", 
"sync_up_cloud", 
"system_version", 
"ticket", 
"ticket_cliente", 
"ticket_descuenta", 
"ticket_num", 
"ticket_orden", 
"ubicacion", 
"ubicacion_asig"); // directorios a recorrer

  return $dir;
}











?>