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


if($_REQUEST["inicio"] != NULL){

$inicio = $_REQUEST["inicio"];
$primero = Fechas::Format($_REQUEST["inicio"]);
$segundo = Fechas::Format($_REQUEST["fin"]);
$diaA = strtotime('+1 day', $segundo);
$diaA = date('d-m-Y', $diaA);
$tercero = Fechas::Format($diaA);


// $objPHPExcel->getColumnDimension('C')->setAutoSize(true);


if($primero == $segundo){
	$sqlx = "fecha = '$inicio'";
} else {
	$sqlx = "time BETWEEN '$primero' AND '$tercero'";
}

if($type == NULL or $type == 0){
  $a = $db->query("SELECT * FROM ticket_num WHERE $sqlx and td = ".$_SESSION['td']." order by time desc");	
} else {
  $a = $db->query("SELECT * FROM ticket_num WHERE $sqlx and td = ".$_SESSION['td']." order by time desc");
}

   if ($a->num_rows > 0) {

require_once '../../application/common/PHPExcel.php';
$objPHPExcel = new PHPExcel();

include_once '../reportes/Reportes.php';
$reporte = new Reportes();
// Create new PHPExcel object


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
            ->setCellValue('A1', 'FECHA')
            ->setCellValue('B1', 'TIPO')
            ->setCellValue('C1', 'NUMERO')
            ->setCellValue('D1', 'ESTADO')
            ->setCellValue('E1', 'REGISTRO CLIENTE')
            ->setCellValue('F1', 'CLIENTE')
            ->setCellValue('G1', 'TIPO PAGO')
            ->setCellValue('H1', 'CAJERO')
            ->setCellValue('I1', 'PRODUCTOS')
            ->setCellValue('J1', 'MONTO GRAVADO')
            ->setCellValue('K1', 'IVA')
            ->setCellValue('L1', 'TOTAL');
 

$fila = 1;   
   foreach ($a as $b) {
    if($b["edo"] == 1){
      $estado = "Activo";
    }else{
      $estado = "Anulado";
    }

$numeroFactura = $b["num_fac"];
$ag = $db->query("SELECT sum(cant), sum(total), sum(stotal), sum(imp), cajero, tipo_pago, orden, tipo FROM ticket where num_fac = '".$b["num_fac"]."' and tipo = '".$b["tipo"]."' and td = ".$_SESSION['td']."");
foreach ($ag as $bg) { 
	$cant = $bg["sum(cant)"];
	$total = $bg["sum(total)"];
  $stotal = $bg["sum(stotal)"];
  $impuestos = $bg["sum(imp)"];
	$cajero = $bg["cajero"];
	$tipo_pago = $bg["tipo_pago"];
	$orden = $bg["orden"];
	$tipo = $bg["tipo"];
  $cliente = Helpers::ClienteProducto($orden, $tipo, $numeroFactura);
  if( $tipo == 3){
    $registro = Helpers::GetData("facturar_documento", "registro", "cliente", $cliente);
  }else{
    $registro = " ";
  }
	
} $ag->close();
 


$fila = $fila + 1; 
$objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A' . $fila, $b["fecha"].' '.$b["hora"])
          ->setCellValue('B' . $fila, Helpers::TipoFacturaVentas($b["tipo"]))
          ->setCellValue('C' . $fila, $b["num_fac"])
          ->setCellValue('D' . $fila, $estado)
          ->setCellValue('E' . $fila, $registro)
          ->setCellValue('F' . $fila, $cliente)
          ->setCellValue('G' . $fila, Helpers::TipoPago($tipo_pago))
          ->setCellValue('H' . $fila, Helpers::GetData("login_userdata", "nombre", "user", $cajero))
          ->setCellValue('I' . $fila, $cant)
          ->setCellValue('J' . $fila, $stotal)
          ->setCellValue('K' . $fila, $impuestos)
          ->setCellValue('L' . $fila, $total);
 

        } 




$columnas = array('A','B','C','D','E','F','G','H','I','J','K','L');
$numeros = array('J','K','L');

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
$range = 'B2'.':B'.$fila;
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
$objPHPExcel->getActiveSheet()->setTitle('Reporte de Documentos Emitidos');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


$objPHPExcel->getActiveSheet()->getStyle("A1:O1")->getFont()->setBold(true);
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte de Documentos Emitidos-'.$_REQUEST["inicio"] . '-al-' . $_REQUEST["fin"].'.xlsx"');
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





} $a->close();         

} // termina fecha


} else {
    
header("location: ../../");
}
/////////
$db->close();

?>