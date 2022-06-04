<?php 
class Importar {

//importador de productos a inventario






public function ExtraeExcel($file){ // comprueba si existe el archivo

$archivo = "../../assets/file/" . $file;

if (file_exists($archivo)) {
$this->CrearTabla();



require_once('../../application/common/PHPExcel.php');
require_once('../../application/common/PHPExcel/Reader/Excel2007.php');          
// Cargando la hoja de excel
$objReader = new PHPExcel_Reader_Excel2007();
$objPHPExcel = $objReader->load($archivo);
$objFecha = new PHPExcel_Shared_Date();       
// Asignamon la hoja de excel activa
$objPHPExcel->setActiveSheetIndex(0);

$columnas = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
$filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

  //Creamos un array con todos los datos del Excel importado
  for ($i=2;$i<=$filas;$i++){
      $_DATOS_EXCEL[$i]['codigo']       = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['descripcion']  = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['cantidad']     = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['categoria']    = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['costo']        = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['precio']       = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['caducidad']    = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['tags']         = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
    }   


$_SESSION["errores"]=0;
$_SESSION["insertados"]=0;

foreach($_DATOS_EXCEL as $data){
  $this->Insertar($data);
}

$this->EjecutaTransaccion();


if($_SESSION["insertados"] > 0){
  Alerts::Mensajex("Realizado: " . $_SESSION["insertados"] . " productos ingresados correctamente a la base de datos","success");
}


if($_SESSION["errores"] > 0){
  Alerts::Mensajex("Error: " . $_SESSION["errores"] . " productos no pudieron ser agregados por que algunos de los datos necesarios estan vacios","danger");

  echo '<div class="text-danger">Productos no ingresados por falta de datos necesarios</div>
  <table class="table table-sm table-hover">
    <thead>
      <tr>
        <th scope="col">CODIGO</th>
        <th scope="col">DESCRIPCION</th>
        <th scope="col">CANTIDAD</th>
        <th scope="col">PRECIO</th>
      </tr>
    </thead>
    <tbody>';

  foreach ($_SESSION["errpro"] as $malpro) { 
    echo '<tr>
          <th scope="row">'. $malpro["codigo"] .'</th>
          <td>'.$malpro["descripcion"].'</td>
          <td>'.$malpro["cantidad"].'</td>
          <td>'.$malpro["precio"].'</td>
        </tr>';        
  }



  echo '</tbody>
  </table>';

  Alerts::Mensajex("Info: Esta información dejará de ser visible al salir de esta ventana","info");

}

// print_r($_SESSION["errpro"]);

unset($_SESSION["errores"]);
unset($_SESSION["insertados"]);
unset($_SESSION["errpro"]);



@unlink($archivo);

$this->EliminarTabla();


} // file exist


} /// funcion









public function Insertar($data){ // inserta los datos a la base de datos
    $db = new dbConn();
// verifico su el codigo existe   
$a = $db->query("SELECT descripcion FROM producto WHERE cod = '".$data["codigo"]."' and td = " .$_SESSION["td"]);
$canti = $a->num_rows; $a->close();


if($data["codigo"] != NULL and 
  $data["descripcion"] != NULL and 
  $data["cantidad"] != NULL  and 
  $data["precio"] != NULL and 
  $canti == 0){
  
    $datos = array();
    $datos = $data;
    if($db->insert("import_to_excel", $datos)){
     $_SESSION["insertados"] = $_SESSION["insertados"] + 1; 
    }
} else {
  $_SESSION["errores"] = $_SESSION["errores"] + 1;

  $_SESSION["errpro"][$_SESSION["errores"]] = $data;
}
    unset($datos);
}





public function CrearTabla(){ // CREA LA TABLA PARA INSERTAR LOS DATOS
    $db = new dbConn();

 @$db->query("CREATE TABLE IF NOT EXISTS `import_to_excel` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `cantidad` float(10,4) NOT NULL,
  `categoria` varchar(25) NOT NULL,
  `costo` float(10,4) NOT NULL,
  `precio` float(10,4) NOT NULL,
  `caducidad` varchar(25) NULL,
  `tags` varchar(250) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");



}



public function EliminarTabla(){ // CREA LA TABLA PARA INSERTAR LOS DATOS
    $db = new dbConn();

  @$db->query("DROP TABLE import_to_excel");

}






public function EjecutaTransaccion(){ // Ingresa los datos tamporales a la base de datos
    $db = new dbConn();

 $a = $db->query("SELECT * FROM import_to_excel");
foreach ($a as $b) {
   
if($b["caducidad"] != NULL){
  $caducax = "on";
} else {
  $caducax = NULL;
}


$datos = array();
$datos["cod"] = $b["codigo"];
$datos["descripcion"] = $b["descripcion"];
$datos["categoria"] = $this->Categoria($b["categoria"]); // necesito la csategoria correcta
$datos["cantidad"] = $b["cantidad"];
$datos["medida"] = $this->Medida(); /// unidad de media primera
$datos["proveedor"] = $this->Proveedor(); /// proveedor predeterminado
$datos["informacion"] = NULL;
$datos["existencia_minima"] = 1;
$datos["caduca"] = $caducax;
$datos["compuesto"] = NULL;
$datos["gravado"] = "on";
$datos["receta"] = NULL;
$datos["dependiente"] = NULL;
$datos["servicio"] = NULL;
$datos["promocion"] = NULL;
$datos["verecommerce"] = NULL;
$datos["ilimitado"] = NULL;
$datos["hash"] = Helpers::HashId();
$datos["time"] = Helpers::TimeId();
$datos["td"] = $_SESSION["td"];
$db->insert("producto", $datos); 



$data = array();
$data["producto"] = $b["codigo"];
$data["cant"] = 1;
$data["precio"] = $b["precio"];
$data["hash"] = Helpers::HashId();
$data["time"] = Helpers::TimeId();
$data["td"] = $_SESSION["td"];
$db->insert("producto_precio", $data); 



$datax = array();
$datax["producto"] = $b["codigo"];
$datax["cant"] = $b["cantidad"];
$datax["existencia"] = $b["cantidad"];
$datax["precio_costo"] = $b["costo"];
$datax["caduca"] = $b["caducidad"];
$datax["caducaF"] = Fechas::Format($b["caducidad"]);
$datax["comentarios"] = "Ingreso desde Excel";
$datax["fecha"] = date("d-m-Y");
$datax["hora"] = date("H:i:s");
$datox["fecha_ingreso"] = Fechas::Format(date("d-m-Y"));
$datax["hash"] = Helpers::HashId();
$datax["time"] = Helpers::TimeId();
$datax["td"] = $_SESSION["td"];
$db->insert("producto_ingresado", $datax); 




if($b["tags"] != NULL){
  $caducax = "on";
}

$tag1 = array();
$tag1["producto"] = $b["codigo"];
$tag1["tag"] = $b["tags"];
$tag1["hash"] = Helpers::HashId();
$tag1["time"] = Helpers::TimeId();
$tag1["td"] = $_SESSION["td"];
$db->insert("producto_tags", $tag1); 



// $tag2 = array();
// $tag2["producto"] = $b["cod"];
// $tag2["tag"] = $b["comentario2"];
// $tag2["hash"] = Helpers::HashId();
// $tag2["time"] = Helpers::TimeId();
// $tag2["td"] = 16;
// $db->insert("producto_tags", $tag2); 




$ubi = array();
$ubi["ubicacion"] = Helpers::GetData("ubicacion", "hash", "predeterminada", 1); // ubicacion predeterminada
$ubi["producto"] = $b["codigo"];
$ubi["cant"] = $b["cantidad"];
$ubi["hash"] = Helpers::HashId();
$ubi["time"] = Helpers::TimeId();
$ubi["td"] = $_SESSION["td"];
$db->insert("ubicacion_asig", $ubi); 



} $a->close();


}








public function Categoria($categoria){ // inserta los datos a la base de datos
    $db = new dbConn();

    // busco el hash y el nombre de la categoria, si exsite lo devuelo sino uso el hash de  predeterminado
    if ($r = $db->select("hash", "producto_categoria_sub", "WHERE subcategoria = '$categoria' and  td = ".$_SESSION["td"]." order by id asc limit 1")) { 
      $hash = $r["hash"];
    }unset($r);  

    if ($hash != NULL) {
      return $hash;
    } else {
      if ($r = $db->select("hash", "producto_categoria_sub", "WHERE td = ".$_SESSION["td"]." order by id asc limit 1")) { 
        return $r["hash"];
       }unset($r);  
    }


}

public function Medida(){ // inserta los datos a la base de datos
    $db = new dbConn();

    if ($r = $db->select("hash", "producto_unidades", "WHERE td = ".$_SESSION["td"]." order by id asc limit 1")) { 
        return $r["hash"];
    }unset($r);  

}


public function Proveedor(){ // inserta los datos a la base de datos
    $db = new dbConn();

    if ($r = $db->select("hash", "proveedores", "WHERE td = ".$_SESSION["td"]." order by id asc limit 1")) { 
        return $r["hash"];
    }unset($r);  
}












} // Termina la clase
?>