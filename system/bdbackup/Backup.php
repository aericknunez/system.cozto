<?php 
class BackUp{

  public function __construct() { 
     } 


public function AddRegistro($sistema){
    $db = new dbConn();
    /// el registro no se realiza en el servidor del sistema sino que en la app
      
      $updata = array(
      'sistema'  =>  $sistema,
      'td'   =>  $_SESSION['td']
        );
    $api_url = "https://app.hibridosv.com/api/addbackup.php";
    $client = curl_init($api_url);
    curl_setopt($client, CURLOPT_POST, true);
    curl_setopt($client, CURLOPT_POSTFIELDS, $updata);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    curl_close($client);
    $result = json_decode($response, true);
    foreach($result as $keys => $values){
      if($result[$keys]['success'] == '1'){
        Alerts::Alerta("success","Creado correctamente","Respaldo creado correctamente");
      }
      else{
        Alerts::Alerta("error","Error!","No se ha podido crear el registro de respaldo");
      }
    }

}


public function Search(){
    $db = new dbConn();

$api_url = "https://app.hibridosv.com/api/addbackup.php?action=search&x=" . $_SESSION["td"] . "&type=2";
$client = curl_init($api_url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($client);
curl_close($client);
$result = json_decode($response, true);
    foreach($result as $keys => $values){
        if($result[$keys]['success'] == '1'){
           Alerts::Mensajex("YA TIENES UNA PETICION DE RESPALDO PENDIENTE","danger");
        
        } elseif($result[$keys]['success'] == '2'){
          Alerts::Mensajex("EN ESTE MOMENTO SE ESTA GENERANDO TU RESPALDO","info");

        } else{
         echo '<a id="backup" sistema="2" class="btn btn-success">Crear BackUp</a>';
        }
    }
}



  public function Crear($td){
    $db = new dbConn();

    $dir = $this->Tablas();

foreach ($dir as $tabla) {
  //////////////////////        
    $s = $db->query("SELECT * FROM $tabla WHERE td = '".$td."'");
    foreach ($s as $y){ 

    $archivo.= "INSERT INTO $tabla VALUES(";
      // especifico los campos
        $fields = $db->listFields($tabla);
        $arrlength = count($fields);
        for($x = 0; $x < $arrlength; $x++) {
            $campo = $fields[$x]['name'];
  

  if($arrlength != $x+1) $archivo.= "\"" .$y["$campo"] . "\",";
  else $archivo.= "\"" . $y["$campo"] . "\"";

        }
    $archivo.= "); \n \n";

    }
     $s->close();
/////////////////////////////////


} /// termina recorrido de directorios

    if($archivo != NULL){

      // verifico si existe la carpeta. sino la creo
      if(!is_dir("../../system/bdbackup/backup/" .$td . "/")){
        mkdir("../../system/bdbackup/backup/" .$td . "/", 0777);

        $gitarch = fopen("../../system/bdbackup/backup/" .$td . "/" . ".gitkeep",'w+');
        fwrite($gitarch,"");
        fclose($gitarch);
      }

      $filename = "Backup-" . date("d-m-Y") . "-" . date("His");
      $ext =  ".piz";

      $handle = fopen("../../system/bdbackup/backup/" .$td . "/" . $filename . $ext,'w+');
      
      fwrite($handle,$archivo);

     fclose($handle);

    } else {
      echo "El Archivo esta vacio";
    }


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




public function VerRespaldos($url){

      $num = 0;
      $archivos = array_reverse(glob($url . "*.piz"));  
      foreach($archivos as $file){  
        $num ++;
        $size = $this->FileZ($file); 
        $filename = str_replace($url, "", $file);
        $data = str_replace(".piz", "", $filename);
      $output .= '
           <tr>
             <th scope="row">'.$num.'</th>
             <td>' . $data . '</td>
             <td>' . $size . '</td>
             <td>
             <a href="downloader.php?data='. $filename . $ext .'&name='. $data .'&type=2&x='.$_SESSION["td"].'" class="btn btn-indigo btn-sm m-0">Descargar
            </a>
             </td>
             <td>
               <a id="eliminar" data="'. $filename . $ext .'" ><i class="fas fa-ban fa-lg red-text"></i><br></a>
             </td>
           </tr>';
      }


      echo '<table class="table table-striped table-responsive-md btn-table">

   <thead>
     <tr>
       <th>#</th>
       <th>Respaldo</th>
       <th>Size</th>
       <th>Descargar</th>
       <th>Eliminar</th>
     </tr>
   </thead>

   <tbody>';

       echo $output;

  echo '</tbody>

</table>';

}


public function FileZ($archivo){

    $archivox = filesize($archivo);

  if($archivox < 1024){
    $file = filesize($archivo) . " Kbi";
  }
  if($archivox > 1023 and $archivox < 1024000){
    $file = round(filesize($archivo) / 1024) . " Kb";
  }
  if($archivox > 1024000){
    $file = filesize($archivo) . " Mb";
  }

  return $file;
}




public function Eliminar($url, $archivo){

  if(unlink($url . $archivo)){
    Alerts::Alerta("success","Eliminado Correctamente","Respaldo eliminado correctamente");
  }

}









}// class
?>