 <?php  
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;



class Impresiones{
    public function __construct() { 
     } 




 public function Ticket($efectivo, $numero){
  $db = new dbConn();
  $nombre_impresora = "LR2000";
  // $img  = "C:/AppServ/www/pizto/assets/img/logo_factura/grosera.jpg";


$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer -> initialize();

$printer -> setFont(Printer::FONT_B);
// $printer -> selectPrintMode(Printer::MODE_DOUBLE_HEIGHT);
// $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);

$printer -> setTextSize(1, 2);
$printer -> setLineSpacing(80);


// $printer -> setJustification(Printer::JUSTIFY_CENTER);
// $logo = EscposImage::load($img, false);
// $printer->bitImage($logo);
$printer -> setJustification(Printer::JUSTIFY_LEFT);

$printer->text("SERVI AGRO VICENTINO");

$printer->feed();
$printer->text("Clinica Veterinaria y venta de productos Agropecuarios");

$printer->feed();
$printer->text("Dr. Ulises Napoleon Rivas Martinez");

$printer->feed();
$printer->text("Calle Quinones de Osorio # 35. Bo. El Calvario, San Vicente");

$printer->feed();
$printer->text("Tel: 2393-0845");

$printer->feed();
$printer->text("FACTURA NUMERO: " . $numero);


/* Stuff around with left margin */
$printer->feed();
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("____________________________________________________________");
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer->feed();
/* Items */

$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
$printer -> text($this->Item("Cant", 'Producto', 'Precio', 'Total'));
$printer -> setEmphasis(false);


$subtotalf = 0;

$a = $db->query("select cod, cant, producto, pv, total, fecha, hora, num_fac from ticket where num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." group by cod");
  
    foreach ($a as $b) {
 
$printer -> text($this->Item($b["cant"], $b["producto"], $b["pv"], $b["total"]));

$subtotalf = $subtotalf + $b["total"];

}    $a->close();



if ($sx = $db->select("sum(total)", "ticket", "WHERE num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."")) { 
       $stotalx=$sx["sum(total)"];
    } unset($sx); 
 



$printer -> text("____________________________________________________________");
$printer->feed();


$printer -> text($this->DosCol("Sub Total " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format(Helpers::STotal($subtotalf, $_SESSION['config_imp'])), 20));


$printer -> text($this->DosCol("IVA " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format(Helpers::Impuesto(Helpers::STotal($subtotalf, $_SESSION['config_imp']), $_SESSION['config_imp'])), 20));


$printer -> text($this->DosCol("TOTAL " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format($subtotalf), 20));



$printer -> text("____________________________________________________________");
$printer->feed();


//efectivo
if($efectivo == NULL){
  $efectivo = $xtotal;
}



$printer -> text($this->DosCol("Efectivo " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format($efectivo), 20));

//cambio
$cambios = $efectivo - $subtotalf;
$printer -> text($this->DosCol("Cambio " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format($cambios), 20));


$printer -> text("____________________________________________________________");
$printer->feed();




$printer -> text($this->DosCol($fechaf, 30, $horaf, 30));



$printer -> text("Cajero: " . $_SESSION['nombre']);

$printer->feed();
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("GRACIAS POR SU PREFERENCIA...");
$printer -> setJustification();




$printer->feed();
$printer->cut();
$printer->pulse();
$printer->close();

}







 public function Factura($efectivo, $numero){
  $db = new dbConn();


}   /// termina FACTURA





 public function CreditoFiscal($data){
  $db = new dbConn();

}










 public function ImprimirAntes($efectivo, $numero, $cancelar){
  $db = new dbConn();


} /// TERMINA IMPRIMIR ANTES







 public function Comanda(){


 }














 public function ReporteDiario($fecha){
  $db = new dbConn();


}   // termina reporte diario








 public function AbrirCaja(){
 // $print
  $print = "EPSON TM-T20II Receipt5";
  
    $handle = printer_open($print);
    printer_set_option($handle, PRINTER_MODE, "RAW");

    printer_start_doc($handle, "Mi Documento");
    printer_start_page($handle);
    printer_write($handle, chr(27).chr(112).chr(48).chr(55).chr(121)); //enviar pulso
    printer_end_page($handle);
    printer_end_doc($handle, 20);
    printer_close($handle);
}












 public function Barcode($numero){
  $db = new dbConn();
  $nombre_impresora = "LR2000";
  // $img  = "C:/AppServ/www/pizto/assets/img/logo_factura/grosera.jpg";


$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer -> initialize();

$a = "{A" . $numero;

$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer->setBarcodeWidth(3);
$printer -> setBarcodeHeight(100);
$printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
    $printer -> barcode($a, Printer::BARCODE_CODE128);
    $printer -> feed(1);

$printer -> cut();
$printer -> close();

}




















 public function Item($cant,  $name = '', $price = '', $total = '', $dollarSign = false)
    {
        $rightCols = 10;
        $leftCols = 42;
        if ($dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($cant . " " . $name, $leftCols) ;
        
        $sign = ($dollarSign ? '$ ' : '');

        $total = str_pad($sign . $total, $rightCols, ' ', STR_PAD_LEFT);
        $right = str_pad($sign . $price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right$total\n";
    }



 public function DosCol($izquierda = '', $iz, $derecha = '', $der)
    {
        $left = str_pad($izquierda, $iz, ' ', STR_PAD_LEFT) ;      
        $right = str_pad($derecha, $der, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }











}// class