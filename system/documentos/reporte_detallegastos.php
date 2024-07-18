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
$diaA = strtotime('+1 day', $segundo);
$diaA = date('d-m-Y', $diaA);
$tercero = Fechas::Format($diaA);

// $objPHPExcel->getColumnDimension('C')->setAutoSize(true);


if($primero == $segundo){
  $a = $db->query("SELECT * FROM gastos WHERE edo = 1 and fechaF = '$segundo' and td = ".$_SESSION['td']." order by time desc");
} else {
  $a = $db->query("SELECT * FROM gastos WHERE edo = 1 and time BETWEEN '$primero' AND '$tercero' and td = ".$_SESSION['td']." order by time desc");
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
            ->setCellValue('A1', 'FECHA INGRESO')
            ->setCellValue('B1', 'TIPO')
            ->setCellValue('C1', 'DOCUMENTO')
            ->setCellValue('D1', 'NO DOCUMENTO')
            ->setCellValue('E1', 'FECHA COMPRA/GASTO')
            ->setCellValue('F1', 'REGISTRO CONTRIBUYENTE')
            ->setCellValue('G1', 'PROVEEDOR')
            ->setCellValue('H1', 'GRUPO GASTO')
            ->setCellValue('I1', 'GASTO')
            ->setCellValue('J1', 'DESCRIPCION')
            ->setCellValue('K1', 'TIPO PAGO')
            ->setCellValue('L1', 'CUENTA')
            ->setCellValue('M1', 'SUBTOTAL')
            ->setCellValue('N1', 'IMPUESTO')
            ->setCellValue('O1', 'TOTAL');


$fila = 1;   
   foreach ($a as $b) {
$proveedor = $b["proveedor"];
$nombreProveedor = Helpers::GetData("proveedores", "nombre", "hash", $proveedor);
$registroProveedor =  Helpers::GetData("proveedores", "registro", "hash", $proveedor);
if($registroProveedor == FALSE) {
  $registroProveedor = " ";
}else{
   $registroProveedor;
  }

if($b["edo"] != 0){ $total = $total + $b["cantidad"]; $colores='class="text-black font-weight-bold"'; } 
else { $colores='class="text-danger font-weight-light"';}

$fecha = strtotime($b["fecha_gasto"]);

if($fecha == FALSE) {
  $fechaGasto = " ";
}else{
  $fechaGasto = date('d-m-Y', $fecha);
}


$fila = $fila + 1; 
$objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A' . $fila, $b["fecha"])
          ->setCellValue('B' . $fila, Gasto($b["tipo"]))
          ->setCellValue('C' . $fila, DocumentoPago($b["tipo_comprobante"]))
          ->setCellValue('D' . $fila, $b["no_factura"])
          ->setCellValue('E' . $fila, $fechaGasto)
          ->setCellValue('F' . $fila, $registroProveedor)
          ->setCellValue('G' . $fila, $nombreProveedor)
          ->setCellValue('H' . $fila, $reporte->CategoriaGastos($b["categoria"]))
          ->setCellValue('I' . $fila, $b["nombre"])
          ->setCellValue('J' . $fila, $b["descripcion"])
          ->setCellValue('K' . $fila, TipoPagoGasto($b["tipo_pago"]))
          ->setCellValue('L' . $fila, $reporte->CuentaGastos($b["cuenta_banco"]))
          ->setCellValue('M' . $fila, $b["cantidad"]/1.13)
          ->setCellValue('N' . $fila, ($b["cantidad"]/1.13)*0.13)
          ->setCellValue('O' . $fila, $b["cantidad"]);
 
        } 




$columnas = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P');
$numeros = array('M','N','O');

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
$objPHPExcel->getActiveSheet()->setTitle('Reporte Detalle de Gastos');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


$objPHPExcel->getActiveSheet()->getStyle("A1:O1")->getFont()->setBold(true);
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ReporteGastosDetalles-'.$_REQUEST["inicio"] . '-al-' . $_REQUEST["fin"].'.xlsx"');
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










    function DocumentoPago($string) {
    if($string == "0") return 'Ninguno';
    if($string == "1") return 'Credito Fiscal';
    if($string == "2") return 'Factura';
    if($string == "3") return 'Recibo';
    if($string == "4") return 'Otros';
    }



    function TipoPagoGasto($string) {
    if($string == "1") return 'Efectivo';
    if($string == "2") return 'Cheque';
    if($string == "3") return 'Transferencia';
    if($string == "4") return $_SESSION['root_tarjeta'];
    }





    function Gasto($string) {
    if($string == "1") return 'Sin Comprobante';
    if($string == "2") return 'Con Comprobante';
    if($string == "3") return 'Remesas';
    if($string == "4") return 'Adelanto a personal';
    if($string == "5") return 'Cheques';
    if($string == "6") return 'Tranferencias';
    }

?>