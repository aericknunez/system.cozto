<?php 
class DataClear{

  public function __construct() { 
     } 




public function Clear(){
    $db = new dbConn();

    $dir = $this->Tablas();

    foreach ($dir as $tabla) {

      $db->delete($tabla, "WHERE td=" . $_SESSION["td"]);

    } /// termina recorrido de directorios

// productos
// gastosimg
// imgcategorias
// unlink("../../assets/img/productos/" . $_SESSION["td"] . "/" . $b["imagen"]);


Alerts::Mensajex("Se eliminaron todos los registos de su sistema", "info");

}//



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
// "config_master", 
// "config_root", 
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
// "facturar_opciones", 
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
// "system_version", 
"ticket", 
"ticket_cliente", 
"ticket_descuenta", 
"ticket_num", 
"ticket_orden", 
// "ubicacion", 
"ubicacion_asig"); // directorios a recorrer

  return $dir;
}










}// class
?>