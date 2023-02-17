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


if($_REQUEST["hash"] != NULL){

$hash = $_REQUEST["hash"];
//// obtener lor datos del corte
if ($r = $db->select("*", "corte_diario", "WHERE hash = '$hash'")) { 
  $aperturaF = $r["aperturaF"];
  $cierreF = $r["cierreF"];
  $apertura = $r["apertura"];
  $cierre = $r["cierre"];
  $fecha = $r["fecha"];
  $caja_chica = $r["caja_chica"];
  $efectivo = $r["efectivo_ingresado"];
  $total = $r["total"];
  $t_efectivo = $r["t_efectivo"];
  $t_tarjeta = $r["t_tarjeta"];
  $t_credito = $r["t_credito"];
  $gastos = $r["gastos"];
  $abonos = $r["abonos"];
  $diferencia = $r["diferencia"];
  $user = $r["user"];

} unset($r);  




require_once '../../application/common/PHPExcel.php';
include_once '../reportes/Reportes.php';
$reporte = new Reportes();
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
            ->setCellValue('A1', 'FECHA')
            ->setCellValue('B1', 'APERTURA')
            ->setCellValue('C1', 'CIERRE')
            ->setCellValue('D1', 'CANTIDAD APERTURA')
            ->setCellValue('E1', 'EFECTIVO INGRESADO')
            ->setCellValue('F1', 'TOTAL EFECTIVO')
            ->setCellValue('G1', 'TOTAL ' . strtoupper($_SESSION['root_tarjeta']))
            ->setCellValue('H1', 'TOTAL CREDITO')
            ->setCellValue('I1', 'VENTA TOTAL')
            ->setCellValue('J1', 'GASTOS')
            ->setCellValue('K1', 'ABONOS')
            ->setCellValue('L1', 'DIFERENCIA EFECTIVO');
 

 $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', Fechas::FechaEscrita($fecha))
            ->setCellValue('B2', $apertura)
            ->setCellValue('C2', $cierre)
            ->setCellValue('D2', $caja_chica)
            ->setCellValue('E2', $efectivo)
            ->setCellValue('F2', $t_efectivo)
            ->setCellValue('G2', $t_tarjeta)
            ->setCellValue('H2', $t_credito)
            ->setCellValue('I2', $total)
            ->setCellValue('J2', $gastos)
            ->setCellValue('K2', $abonos)
            ->setCellValue('L2', $diferencia);
 


if ($r = $db->select("sum(stotal)", "ticket", "WHERE edo = 1 and tipo = 1 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."'")) { 
    $t_ticket = $r["sum(stotal)"];
} unset($r);  

if ($r = $db->select("sum(stotal)", "ticket", "WHERE edo = 1 and tipo = 2 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."'")) { 
    $t_factura = $r["sum(stotal)"];
} unset($r);  

if ($r = $db->select("sum(stotal)", "ticket", "WHERE edo = 1 and tipo = 3 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."'")) { 
    $t_credito = $r["sum(stotal)"];
} unset($r);  

if ($r = $db->select("sum(imp)", "ticket", "WHERE edo = 1 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."'")) { 
    $t_imp = $r["sum(imp)"];
} unset($r);  



// Add encabezado
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'TICKET')
            ->setCellValue('B4', 'FACTURA')
            ->setCellValue('C4', 'CREDITO FISCAL')
            ->setCellValue('D4', 'IMPUESTO')
            ->setCellValue('E4', 'TOTAL');
 

 $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A5', Helpers::Format($t_ticket))
            ->setCellValue('B5', Helpers::Format($t_factura))
            ->setCellValue('C5', Helpers::Format($t_credito))
            ->setCellValue('D5', Helpers::Format($t_imp))
            ->setCellValue('E5', Helpers::Format($total));
 



// Add PAGOS
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A7', 'EFECTIVO')
            ->setCellValue('B7', strtoupper($_SESSION['root_tarjeta']))
            ->setCellValue('C7', 'TOTAL')
            ->setCellValue('D7', 'DIFERENCIA');
 

 $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A8', Helpers::Format($t_efectivo))
            ->setCellValue('B8', Helpers::Format($t_tarjeta))
            ->setCellValue('C8', Helpers::Format($total))
            ->setCellValue('D8', Helpers::Format($diferencia));
 



$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A10', 'DOCUMENTO')
            ->setCellValue('B10', 'CANTIDAD')
            ->setCellValue('C10', 'TOTAL');

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A11', 'TICKETS')
            ->setCellValue('B11', Helpers::Entero($cant_t))
            ->setCellValue('C11', Helpers::Format($t_ticket));

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A12', 'FACURAS')
            ->setCellValue('B12', Helpers::Entero($cant_f))
            ->setCellValue('C12', Helpers::Format($t_factura));

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A13', 'CREDITO FISCAL')
            ->setCellValue('B13', Helpers::Entero($cant_c))
            ->setCellValue('C13', Helpers::Format($t_credito));














// $objPHPExcel->getColumnDimension('C')->setAutoSize(true);



$a = $db->query("SELECT * FROM ticket WHERE time BETWEEN '$aperturaF' AND '$cierreF' and edo = 1 and tipo_pago != 8 and td = ".$_SESSION['td']." order by time desc");

if($a->num_rows > 0){

// Add encabezado
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A15', 'FECHA')
            ->setCellValue('B15', 'NO DOCUMENTO')
            ->setCellValue('C15', 'CLIENTE')
            ->setCellValue('D15', 'CATEGORIA')
            ->setCellValue('E15', 'CODIGO')
            ->setCellValue('F15', 'CANTIDAD')
            ->setCellValue('G15', 'PRODUCTO')
            ->setCellValue('H15', 'PRECIO UNITARIO')
            ->setCellValue('I15', 'PRECIO TOTAL')
            ->setCellValue('J15', 'DESCUENTO')
            ->setCellValue('K15', 'MONTO TOTAL')
            ->setCellValue('L15', 'PAGO');
 

$fila = 15;   
   foreach ($a as $b) {

      $totalcosto = $b["pc"] * $b["cant"];
      $total = $b["pv"] * $b["cant"];

$fila = $fila + 1; 
$objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A' . $fila, $b["fecha"])
          ->setCellValue('B' . $fila, $b["num_fac"])
          ->setCellValue('C' . $fila, $reporte->ClienteProducto($b["orden"]))
          ->setCellValue('D' . $fila, $reporte->CategoriaProducto($b["cod"]))
          ->setCellValue('E' . $fila, $b["cod"])
          ->setCellValue('F' . $fila, $b["cant"])
          ->setCellValue('G' . $fila, $b["producto"])
          ->setCellValue('H' . $fila, $b["pv"])
          ->setCellValue('I' . $fila, $total)
          ->setCellValue('J' . $fila, $b["descuento"])
          ->setCellValue('K' . $fila, $b["total"])
          ->setCellValue('L' . $fila, Helpers::TipoPago($b["tipo_pago"]));
 

        } 




$columnas = array('A','B','C','D','E','F','G','L');
$numeros = array('H','I','J','K');

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









} $a->close(); // si hay registros
            



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Corte X');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


$objPHPExcel->getActiveSheet()->getStyle("A15:O15")->getFont()->setBold(true);
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="CorteX-'. date("d-m-Y") . '-' . date("H:i:s").'.xlsx"');
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





} // termina fecha


} else { // si esta logueado
    
header("location: ../../");
}
/////////
$db->close();
?>