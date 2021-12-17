<?php
include_once '../../application/common/Helpers.php'; // [Para todo]
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


 $a = $db->query("SELECT * FROM creditos WHERE edo = 1 and td = ". $_SESSION['td'] ."");

    if($a->num_rows > 0){

require_once '../../application/common/PHPExcel.php';


require_once '../credito/Creditos.php';
$credito = new Creditos();

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
            ->setCellValue('A1', 'CLIENTE')
            ->setCellValue('B1', 'FECHA')
            ->setCellValue('C1', 'FACTURA')
            ->setCellValue('D1', 'TOTAL')
            ->setCellValue('E1', 'ABONADO')
            ->setCellValue('F1', 'SALDO')
            ->setCellValue('G1', 'ESTADO');


$fila = 1; 

   foreach ($a as $b) {
$fila = $fila + 1; 

$total = $credito->ObtenerTotal($b["factura"], $b["tx"], $b["orden"]);
$abonado = $credito->TotalAbono($b["hash"]);
$saldo = $total - $abonado;

if ($b["edo"] == 1) {
    $edo = 'Activo';
}
if ($b["edo"] == 2) {
    $edo = 'Pagado';
}
if ($b["edo"] == 0) {
    $edo = 'Eliminado';
}

$objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A' . $fila, $b["nombre"])
          ->setCellValue('B' . $fila, $b["fecha"]. ' ' . $b["hora"])
          ->setCellValue('C' . $fila, $b["factura"])
          ->setCellValue('D' . $fila, Helpers::Entero($total))
          ->setCellValue('E' . $fila, Helpers::Entero($abonado))
          ->setCellValue('F' . $fila, Helpers::Entero($saldo))
          ->setCellValue('G' . $fila, $edo);
 
        } 




$columnas = array('A','B','C','D','E','F','G');
$numeros = array('D','E','F');

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
$objPHPExcel->getActiveSheet()->setTitle('Creditos');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


$objPHPExcel->getActiveSheet()->getStyle("A1:I1")->getFont()->setBold(true);
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="CreditosPendientes.xlsx"');
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