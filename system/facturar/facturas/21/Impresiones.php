 <?php  
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;



class Impresiones{
    public function __construct() { 
     } 



 public function Ticket($efectivo, $numero){
  $db = new dbConn();
  $nombre_impresora = "POS-80C";
  // $img  = "C:/AppServ/www/pizto/assets/img/logo_factura/grosera.jpg";


$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer -> initialize();

$printer -> setFont(Printer::FONT_B);
// $printer -> selectPrintMode(Printer::MODE_DOUBLE_HEIGHT);
// $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);

$printer -> setTextSize(1, 1);
$printer -> setLineSpacing(80);


// $printer -> setJustification(Printer::JUSTIFY_CENTER);
// $logo = EscposImage::load($img, false);
// $printer->bitImage($logo);
$printer -> setJustification(Printer::JUSTIFY_CENTER);

$printer->text("MINI SUPER TRUJILLO");

$printer -> setJustification(Printer::JUSTIFY_LEFT);

$printer->feed();
$printer->text("Entrada Barrio el Salitre, Ojos de agua. Chalatenango");


$printer->feed();
$printer->text("Maria Hilda Martinez de Trujillo");

$printer->feed();
$printer->text("Compra y venta de articulos de primera necesidad");


$printer->feed();
$printer->text("Tel: 7561-1786");

$printer->feed();
$printer->text("TICKET NUMERO: " . $numero);


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


$printer -> text($this->DosCol("Sub Total " . $_SESSION['config_moneda_simbolo'] . ":", 50, Helpers::Format(Helpers::STotal($subtotalf, $_SESSION['config_imp'])), 10));


$printer -> text($this->DosCol("IVA " . $_SESSION['config_moneda_simbolo'] . ":", 50, Helpers::Format(Helpers::Impuesto(Helpers::STotal($subtotalf, $_SESSION['config_imp']), $_SESSION['config_imp'])), 10));


$printer -> text($this->DosCol("TOTAL " . $_SESSION['config_moneda_simbolo'] . ":", 50, Helpers::Format($subtotalf), 10));



$printer -> text("____________________________________________________________");
$printer->feed();


//efectivo
if($efectivo == NULL){
  $efectivo = $xtotal;
}



$printer -> text($this->DosCol("Efectivo " . $_SESSION['config_moneda_simbolo'] . ":", 50, Helpers::Format($efectivo), 10));

//cambio
$cambios = $efectivo - $subtotalf;
$printer -> text($this->DosCol("Cambio " . $_SESSION['config_moneda_simbolo'] . ":", 50, Helpers::Format($cambios), 10));


$printer -> text("____________________________________________________________");
$printer->feed();




$printer -> text($this->DosCol(date("d-m-Y"), 30, date("H:i:s"), 30));



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




 public function Ninguno(){

$nombre_impresora = "POS-80C";

$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer->pulse();
$printer->close();


}   /// termina /.;ninguno






 public function ImprimirAntes($efectivo, $numero, $cancelar){
  $db = new dbConn();


} /// TERMINA IMPRIMIR ANTES







 public function Comanda(){


 }














 public function ReporteDiario($fecha){


}   // termina reporte diario








 public function AbrirCaja(){
 // $print
$nombre_impresora = "POS-80C";

$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer->pulse();
$printer->close();

}







 public function Barcode($numero){
  $db = new dbConn();
  $nombre_impresora = "POS-80C";


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




















 public function Item($cant,  $name = '', $price = '', $total = '', $dollarSign = false){
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



 public function DosCol($izquierda = '', $iz, $derecha = '', $der){
        $left = str_pad($izquierda, $iz, ' ', STR_PAD_LEFT) ;      
        $right = str_pad($derecha, $der, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }










}// class