<?php 
class DataClear{

  public function __construct() { 
     } 




public function Clear($config = NULL, $user = NULL){
    $db = new dbConn();

if($config != NULL){
  $dir = $this->TablasConfig();
} else {
  $dir = $this->Tablas();
}


if($user != NULL){
  $this->DeleteUser();
}



    foreach ($dir as $tabla) {

      $db->delete($tabla, "WHERE td=" . $_SESSION["td"]);

    } /// termina recorrido de directorios

$this->ImgDelete("../../assets/img/productos/".$_SESSION["td"]."/");
$this->ImgDelete("../../assets/img/productos/".$_SESSION["td"]."/tmb/");
$this->ImgDelete("../../assets/img/gastosimg/".$_SESSION["td"]."/");
$this->ImgDelete("../../assets/img/imgcategorias/".$_SESSION["td"]."/");


Alerts::Mensajex("Se eliminaron todos los registos de su sistema", "info");

}



public function ImgDelete($dir){
$archivos = glob($dir."*.*");  
  foreach($archivos as $data){ 

  	$data = str_replace($dir, "", $data);
    $archx = $dir . $data;            

	if (file_exists($archx)) {
     @unlink($archx); } 
} // termina busqueda de archivos en la carpeta
}



public function TablasConfig(){

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
"cuentas", 
"cuentas_abonos",
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
"taller_cliente", 
"taller_facturas", 
"taller_mantenimiento", 
"taller_vehiculo", 
"ticket", 
"ticket_cliente", 
"ticket_descuenta", 
"ticket_num", 
"ticket_orden", 
"ubicacion", 
"ubicacion_asig"); // directorios a recorrer

  return $dir;
}




public function DeleteUser(){
    $db = new dbConn();

    $a = $db->query("SELECT user FROM login_userdata WHERE td = " . $_SESSION["td"]);
    foreach ($a as $b) {
      $db->delete("login_members", "WHERE username='".$b["user"] ."'"); /// usuarios email
      $db->delete("login_sucursales", "WHERE user'".$b["user"] ."'"); // sucursales vinculadas
      $db->delete("login_userdata", "WHERE user='".$b["user"] ."'"); // datos usuario
    } $a->close();

}










}// class
?>