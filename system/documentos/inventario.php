<?php
include_once '../../application/common/Helpers.php'; // [Para todo]
include_once '../../application/common/Encrypt.php';
include_once '../../application/includes/variables_db.php';
include_once '../../application/common/Mysqli.php';
include_once '../../application/includes/DataLogin.php';
$db = new dbConn();
$seslog = new Login();
$seslog->sec_session_start();



if ($seslog->login_check() == TRUE) {

include_once '../../application/common/Fechas.php';
include_once '../../application/common/Alerts.php';



// $objPHPExcel->getColumnDimension('C')->setAutoSize(true);
if($_REQUEST["search"] != NULL){
  $search = $_REQUEST["search"];
  }else{
    $search = "";
  }

 $a = $db->query("SELECT 
                  producto.cod, 
                  producto.descripcion, 
                  producto.cantidad, 
                  producto.existencia_minima, 
                  producto.compuesto, 
                  producto.dependiente, 
                  producto.servicio, 
                  producto_categoria_sub.subcategoria 
                  FROM 
                  producto 
                  INNER JOIN 
                  producto_categoria_sub ON producto.categoria = producto_categoria_sub.hash 
                  WHERE 
                  (producto.cod LIKE '%".$search."%' OR producto.descripcion LIKE '%".$search."%' OR producto_categoria_sub.subcategoria LIKE '%".$search."%') 
                  AND producto.td = ".$_SESSION["td"]."");

    if($a->num_rows > 0){

require_once '../../application/common/PHPExcel.php';

require_once '../herramientas/Herramientas.php';
$herramientas = new Herramientas();

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Hibrido")
                      ->setLastModifiedBy("Hibrido")
                      ->setTitle("Office 2007 XLSX Documento de reporte")
                      ->setSubject("Office 2007 XLSX Documento de reporte")
                      ->setDescription("Documento generado por Hibrido y su sistema Pizto.")
                      ->setKeywords("office 2007 openxml")
                      ->setCategory("Archivo de Reporte");



$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
                                          ->setSize(12);

// Add encabezado
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'CODIGO')
            ->setCellValue('B1', 'DESCRIPCION')
            ->setCellValue('C1', 'CANTIDAD')
            ->setCellValue('D1', 'CATEGORIA')
            ->setCellValue('E1', 'COSTO')
            ->setCellValue('F1', 'PRECIO')
            ->setCellValue('G1', 'EXISTENCIA MINIMA')
            ->setCellValue('H1', 'MARCA')
            ->setCellValue('I1', '');
 


$fila = 1;   
   foreach ($a as $b) {
 
 if ($r = $db->select("precio", "producto_precio", "WHERE producto = '".$b["cod"]."' and td = ". $_SESSION["td"] ."")) { 
        $precio = $r["precio"]; } unset($r); 


$costo = $herramientas->ObtenerPrecioCosto($b["cod"]);

if($costo == 0){
if ($r = $db->select("precio_costo", "producto_ingresado", "WHERE precio_costo != 0 and producto = '".$b["cod"]."' and td = ". $_SESSION["td"] ." order by time desc limit 1")) {   
  $costo = $r["precio_costo"]; } unset($r); 
}


/// cantidad solo si es producto, si es servio o dependiente no aplica
if($b["compuesto"] == "on"){
  $cantidad = 'N/A';
} else if($b["dependiente"] == "on"){
  $cantidad = 'N/A';
} else if($b["servicio"] == "on"){
  $cantidad = 'N/A';
} else {
  $cantidad = $b["cantidad"];
}



// productos vendidos
/* if ($r = $db->select("sum(cant) as cantidad", "ticket", "WHERE cod = '".$b["cod"]."' and td = ". $_SESSION["td"] ."")) {
$vcantidad = $r["cantidad"];
}  unset($r); */

//marca
if ($r = $db->select("marca", "marca_asig", "WHERE producto = '".$b["cod"]."' and td =".$_SESSION["td"]."")) { 
   $codigo = $r["marca"];
} unset($r);  

if($codigo != NULL){
  if ($r = $db->select("marca", "marcas", "WHERE hash = '".$codigo."' and td =".$_SESSION["td"]."")) { 
     $marca = $r["marca"];
  } unset($r);  
} else {
    $marca = "N/A";
}
unset($codigo);

$fila = $fila + 1; 
$objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A' . $fila, $b["cod"])
          ->setCellValue('B' . $fila, $b["descripcion"])
          ->setCellValue('C' . $fila, $cantidad)
          ->setCellValue('D' . $fila, $b["subcategoria"])
          ->setCellValue('E' . $fila, $costo)
          ->setCellValue('F' . $fila, $precio)
          ->setCellValue('G' . $fila, $b["existencia_minima"])
          ->setCellValue('H' . $fila, $marca)
          ->setCellValue('I' . $fila, '');
 

        } 




$columnas = array('A','B','C','D','E','F','G','H','I');
$numeros = array('E','F');

// establece ceros numerocico las filas numerocas
foreach($numeros as $columnID) {
$objPHPExcel->getActiveSheet()->getStyle($columnID . '2:' . $columnID.$fila)
    ->getNumberFormat()
    ->setFormatCode(
        '$0.00'
    );
}

// establece auto dimension a las columnas
foreach($columnas as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}


// estableces como texto
$range = 'A2'.':A'.$fila;
$objPHPExcel->getActiveSheet()
       ->getStyle($range)
       ->getNumberFormat()
       ->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );

// // formula de sumatoria
// $filax = $fila + 1;
// $objPHPExcel->setActiveSheetIndex(0)
//             ->setCellValue('D'. $filax, "TOTAL: ");
// $objPHPExcel->setActiveSheetIndex(0)
//             ->setCellValue('E'. $filax, "=SUM(E2:E".$fila.")");

// $objPHPExcel->getActiveSheet()->getStyle('E'. $filax)
//     ->getNumberFormat()
//     ->setFormatCode(
//         '$0.00'
//     );




// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Inventario');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


$objPHPExcel->getActiveSheet()->getStyle("A1:I1")->getFont()->setBold(true);
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Inventario-'.date("d-m-Y-H_i_s").'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setPreCalculateFormulas(true);
$objWriter->save('php://output');
exit;





}  $a->close();         




} else {
    
header("location: ../../");
}
/////////
$db->close();
?>