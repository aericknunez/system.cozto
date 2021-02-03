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

$printer->text("ROTULACIONES DIVERSAS JUAYUA");

$printer -> setJustification(Printer::JUSTIFY_LEFT);

$printer->feed();
$printer->text("2a avenida sur, barrio Santa Lucía, contiguo a plaza Juayúa");


$printer->feed();
$printer->text("Carlos Alberto Siciliano Ayala");


$printer->feed();
$printer->text("Tel: 7258-5619");

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

$txt1   = "31"; 
$txt2   = "11";
$txt3   = "0";
$txt4   = "0";
$n1   = "40";
$n2   = "60";
$n3   = "0";
$n4   = "0";


$col1 = 0;
$col2 = 30;
$col3 = 340;
$col4 = 440;
$col5 = 500;
// $print
$print = "EPSON LX-350";

$handle = printer_open($print);
printer_set_option($handle, PRINTER_MODE, "RAW");

printer_start_doc($handle, "Mi Documento");
printer_start_page($handle);


$font = printer_create_font("Arial", $txt1, $txt2, PRINTER_FW_NORMAL, false, false, false, 0);
printer_select_font($handle, $font);



$oi=350;
//// comienza la factura

$oi=$oi+$n1;
printer_draw_text($handle, date("d"), 55, $oi);
printer_draw_text($handle, date("m"), 100, $oi);
printer_draw_text($handle, date("Y"), 150, $oi);




    if ($r = $db->select("cliente", "ticket_cliente", "WHERE factura = '$numero' and tx = " . $_SESSION["tx"] . " and td = " .  $_SESSION["td"])) { 
        $hashcliente = $r["cliente"];
    } unset($r);  



    if ($r = $db->select("nombre, documento, direccion", "clientes", "WHERE hash = '$hashcliente' and td = " .  $_SESSION["td"])) { 
        $nombre = $r["nombre"];
        $documento = $r["documento"];
        $direccion = $r["direccion"];
    } unset($r);  




printer_draw_text($handle, $nombre, 80, $oi);
$oi=$oi+$n1;
printer_draw_text($handle, $documento, 100, $oi);
$oi=$oi+$n1;
printer_draw_text($handle, $direccion, 5, $oi);



$subtotalf = 0;


$a = $db->query("select cod, cant, producto, pv, total, fecha, hora, num_fac from ticket where num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." group by cod");
  
    foreach ($a as $b) {
 
 $fechaf=$b["fecha"];
 $horaf=$b["hora"];
 $num_fac=$b["num_fac"];

          $oi=$oi+$n1;
          printer_draw_text($handle, $b["cant"], $col1, $oi);
          printer_draw_text($handle, $b["producto"], $col2, $oi);
          printer_draw_text($handle, $b["pv"], $col2, $oi);
          printer_draw_text($handle, $b["total"], $col4, $oi);


////
$subtotalf = $subtotalf + $stotal;
///

    }    $a->close();


if ($sx = $db->select("sum(total)", "ticket", "WHERE num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."")) { 
       $stotalx=$sx["sum(total)"];
    } unset($sx); 
 

$oi=$oi+$n1;
printer_draw_text($handle, Helpers::Format($stotalx), $col4, $oi);







printer_delete_font($font);
///
printer_end_page($handle);
printer_end_doc($handle);
printer_close($handle);




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