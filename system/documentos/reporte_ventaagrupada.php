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

$primero = Fechas::Format($_REQUEST["inicio"]);
$segundo = Fechas::Format($_REQUEST["fin"]);

// $objPHPExcel->getColumnDimension('C')->setAutoSize(true);


if($primero == $segundo){
$a = $db->query("select cod, sum(cant), sum(total), producto, pv, pc, sum(descuento) FROM ticket WHERE 
  fechaF = '$segundo' and edo = 1 and tipo_pago != 8 and td = ".$_SESSION['td']." 
  GROUP BY cod order by sum(cant) desc");
} else {
$a = $db->query("select cod, sum(cant), sum(total), producto, pv, pc, sum(descuento) FROM ticket WHERE 
  time BETWEEN '$primero' AND '$segundo' and edo = 1 and tipo_pago != 8 and td = ".$_SESSION['td']." 
  GROUP BY cod order by sum(cant) desc");
}

    if($a->num_rows > 0){

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
            ->setCellValue('A1', 'CATEGORIA')
            ->setCellValue('B1', 'CODIGO')
            ->setCellValue('C1', 'CANTIDAD')
            ->setCellValue('D1', 'PRODUCTO')
            ->setCellValue('E1', 'PRECIO UNITARIO')
            ->setCellValue('F1', 'PRECIO TOTAL')
            ->setCellValue('G1', 'DESCUENTO')
            ->setCellValue('H1', 'TOTAL');
 

$fila = 1;   
   foreach ($a as $b) {

      $totalcosto = $b["pc"] * $b["cant"];
      $total = $b["pv"] * $b["sum(cant)"];
      $ganancia = $b["total"] - $totalcosto;
      @$porcentaje = ($ganancia / $b["total"])*100;


$fila = $fila + 1; 
$objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A' . $fila, $reporte->CategoriaProducto($b["cod"]))
          ->setCellValue('B' . $fila, $b["cod"])
          ->setCellValue('C' . $fila, $b["sum(cant)"])
          ->setCellValue('D' . $fila, $b["producto"])
          ->setCellValue('E' . $fila, $b["pv"])
          ->setCellValue('F' . $fila, $total)
          ->setCellValue('G' . $fila, $b["sum(descuento)"])
          ->setCellValue('H' . $fila, $b["sum(total)"]);
 
        } 




$columnas = array('A','B','C','D');
$numeros = array('E','F','G','H');

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
$objPHPExcel->getActiveSheet()->setTitle('Reporte Venta Agrupada');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


$objPHPExcel->getActiveSheet()->getStyle("A1:O1")->getFont()->setBold(true);
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ReporteVentaAgrupada-'.$_REQUEST["inicio"] . '-al-' . $_REQUEST["fin"].'.xlsx"');
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