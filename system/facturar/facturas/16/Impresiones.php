 <?php  
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;



class Impresiones{
    public function __construct() { 
     } 




 public function Ticket($efectivo, $numero){
  $db = new dbConn();
  $nombre_impresora = "EPSON2";
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

$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer->text("ANIMAL PET'S");

// $printer -> setJustification(Printer::JUSTIFY_LEFT);

$printer->feed();
$printer->text("Calle Quinones de Osorio # 35. Bo. El Calvario, San Vicente");

$printer->feed();
$printer->text("Tel: 2393-0845");


$printer->feed();
$printer->text("CONTRIBUYENTE: Dr. Ulises Napoleon Rivas Martinez");


/////////////////////
$printer->feed();
$printer->text("NIT: 1010-291061-002-4   NRC: 33274-7");

$printer->feed();
$printer->text("GIRO: Clinica Veterinaria y venta de productos Agropecuarios");


$printer->feed();
$printer->text("Autorizacion: ASC-15041-036310-2021");

$printer->feed();
$printer->text("DEL: 21SV00000001-1  AL: 21SV00000001-50000");

$printer->feed();
$printer->text("FECHA DE AUTORIZACION: 09/01/2021");

$printer->feed();
$printer->text("CAJA: 1.  TICKET NUMERO: " . $numero);


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
 
$printer -> text($this->Item($b["cant"], substr($b["producto"], 0, 38), $b["pv"], $b["total"]));

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

$printer->feed();
$printer->text("SERIE: 2UA329130D");


$printer->feed();
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
$nombre_impresora = "EPSON2";

$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer->pulse();
$printer->close();

}   /// termina FACTURA





 public function CreditoFiscal($data){
$nombre_impresora = "EPSON2";

$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer->pulse();
$printer->close();

}










 public function ImprimirAntes($efectivo, $numero, $cancelar){
  $db = new dbConn();


} /// TERMINA IMPRIMIR ANTES







 public function Comanda(){


 }





 public function Ninguno(){

$nombre_impresora = "EPSON2";

$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer->pulse();
$printer->close();


}   /// termina /.;ninguno










 public function ReporteDiario($fecha){
  $db = new dbConn();


}   // termina reporte diario








 public function AbrirCaja(){
$nombre_impresora = "EPSON2";

$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer->pulse();
$printer->close();
}













 public function Barcode($numero){
  $db = new dbConn();
  $nombre_impresora = "EPSON2";


$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer -> initialize();

$a = "{A" . $numero;

$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer->setBarcodeWidth(3);
$printer -> setBarcodeHeight(100);
$printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
    $printer -> barcode($a, Printer::BARCODE_CODE128);

if ($r = $db->select("descripcion", "producto", "WHERE cod = '$numero' and td = ".$_SESSION["td"]."")) { 
$pro = $r["descripcion"];
} unset($r);  

$printer -> feed(1);

$printer->text($pro);

$printer -> feed(1);

$printer -> cut();
$printer -> close();

}
















 public function CoteX(){ // imprime el resumen del ultimo corte
  $db = new dbConn();



  $nombre_impresora = "TICKET";


$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer -> initialize();

$printer -> setFont(Printer::FONT_B);

$printer -> setTextSize(1, 2);
$printer -> setLineSpacing(80);

$printer -> setJustification(Printer::JUSTIFY_LEFT);

$printer -> text("CORTE X");

/* Stuff around with left margin */
$printer->feed();
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("____________________________________________________________");
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer->feed();
/* Items */



$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer->text("ANIMAL PET'S");

// FECHA 
// HORA

// $printer -> setJustification(Printer::JUSTIFY_LEFT);

$printer->feed();
$printer->text("Calle Quinones de Osorio # 35. Bo. El Calvario, San Vicente");

$printer->feed();
$printer->text("Tel: 2393-0845");


$printer->feed();
$printer->text("CONTRIBUYENTE: Dr. Ulises Napoleon Rivas Martinez");


/////////////////////
$printer->feed();
$printer->text("NIT: 1010-291061-002-4   NRC: 33274-7");

$printer->feed();
$printer->text("GIRO: Clinica Veterinaria y venta de productos Agropecuarios");


$printer->feed();
$printer->text("CAJA: 1.");

























$printer -> text("VENTAS");
$printer -> text("____________________________________________________________");
$printer->feed();



$printer -> text("PAGOS");
$printer -> text("____________________________________________________________");
$printer->feed();



$printer -> text("CORRELATIVOS");
$printer -> text("____________________________________________________________");
$printer->feed();



$printer -> text("DETALLES");
$printer -> text("____________________________________________________________");
$printer->feed();




  // total de venta
      $axy = $db->query("SELECT SUM(total) FROM ticket WHERE time BETWEEN '".$inicio."' and '".Helpers::TimeId()."' and edo = 1 and td = ".$_SESSION["td"]."");
    foreach ($axy as $bxy) {
        $counte=$bxy["SUM(total)"];
    } $axy->close();





//////////////// del corte anterior
    if ($r = $db->select("efectivo, propina, total, gastos, diferencia, clientes, time", "corte_diario", "WHERE edo = 1 and td = ".$_SESSION["td"]." order by time desc")) { 
        $efectivo = $r["efectivo"];
        $propina = $r["propina"];
        $total = $r["total"];
        $gastos = $r["gastos"];
        $diferencia = $r["diferencia"];
        $clientes = $r["clientes"];
        $fin = $r["time"];

    } unset($r);  





// tarjeta de credito
$a = $db->query("SELECT sum(total) FROM ticket WHERE edo = 1 and tipo_pago = 2 and td = ".$_SESSION["td"]." and time BETWEEN '".$inicio."' and '".$fin."'");
    foreach ($a as $b) {
     $tarjetacredito=$b["sum(total)"];
    } $a->close();

// venta en efectivo
$a = $db->query("SELECT sum(total) FROM ticket WHERE edo = 1 and tipo_pago = 1 and td = ".$_SESSION["td"]." and time BETWEEN '".$inicio."' and '".$fin."'");
    foreach ($a as $b) {
     $vefectivo=$b["sum(total)"];
    } $a->close();

/// propina de tarjeta
    $a = $db->query("SELECT num_fac, tx FROM ticket WHERE edo = 1 and tipo_pago = 2 and td = ".$_SESSION["td"]." and time BETWEEN  '".$inicio."' and '".$fin."' GROUP BY num_fac");
    $propinatarjetac = 0;
    foreach ($a as $b) {

      if ($r = $db->select("total", "ticket_propina", "WHERE num_fac = ".$b["num_fac"]." and td = ".$_SESSION["td"]." and tx = ".$b["tx"]."")) { 
          $totalx = $r["total"];
      } unset($r);  
      $propinatarjetac = $propinatarjetac + $totalx;
    } $a->close();


/// propina de efectivo
    $a = $db->query("SELECT num_fac, tx FROM ticket WHERE edo = 1 and tipo_pago = 1 and td = ".$_SESSION["td"]." and time BETWEEN  '".$inicio."' and '".$fin."' GROUP BY num_fac");
    $propinatarjetae = 0;
    foreach ($a as $b) {

      if ($r = $db->select("total", "ticket_propina", "WHERE num_fac = ".$b["num_fac"]." and td = ".$_SESSION["td"]." and tx = ".$b["tx"]."")) { 
          $total2 = $r["total"];
      } unset($r);  
      $propinatarjetae = $propinatarjetae + $total2;
    } $a->close();






$printer -> text($this->DosCol("VENTA EN EFECTIVO: ", 40, Helpers::Dinero($vefectivo), 20));

$printer -> text($this->DosCol("PROPINA EN EFECTIVO: ", 40, Helpers::Dinero($propinatarjetae), 20));


$printer -> text($this->DosCol("VENTA CON TARJETA: ", 40, Helpers::Dinero($tarjetacredito), 20));

$printer -> text($this->DosCol("PROPINA CON TARJETA: ", 40, Helpers::Dinero($propinatarjetac), 20));



$printer -> text($this->DosCol("TOTAL DE VENTA: ", 40, Helpers::Dinero($counte), 20));




  // total de venta
      $axy = $db->query("SELECT sum(total) FROM ticket_propina WHERE time BETWEEN '".$inicio."' and '".Helpers::TimeId()."' and td = ".$_SESSION["td"]."");
    foreach ($axy as $bxy) {
        $propinas=$bxy["sum(total)"];
    } $axy->close();


$printer -> text($this->DosCol("TOTAL DE PROPINA: ", 40, Helpers::Dinero($propinas), 20));



$printer -> text($this->DosCol("TOTAL: ", 40, Helpers::Dinero($counte + $propinas), 20));


  
$printer -> text("____________________________________________________________");
$printer->feed();



// Eliminadas
  $axy = $db->query("SELECT count(num_fac) FROM ticket_num WHERE time BETWEEN '".$inicio."' and '".Helpers::TimeId()."' and tx = 1 and edo = 2 and td = ".$_SESSION["td"]."");
foreach ($axy as $bxy) {
    $counte=$bxy["count(num_fac)"];
} $axy->close();



$printer -> text($this->DosCol("TICKET ELIMINADOS: ", 40, $counte, 20));


$printer -> text("____________________________________________________________");
$printer->feed();




// gastos
  $axy = $db->query("SELECT sum(cantidad) FROM gastos WHERE tipo != 3 and tipo != 5 and time BETWEEN '".$inicio."' and '".Helpers::TimeId()."' and edo = 1 and td = ".$_SESSION["td"]."");
foreach ($axy as $bxy) {
    $gasto=$bxy["sum(cantidad)"];
} $axy->close();

// remesas (tipo  3)
  $axy = $db->query("SELECT sum(cantidad) FROM gastos WHERE tipo = 3 and time BETWEEN '".$inicio."' and '".Helpers::TimeId()."' and edo = 1 and td = ".$_SESSION["td"]."");
foreach ($axy as $bxy) {
    $remesas=$bxy["sum(cantidad)"];
} $axy->close();



$printer -> text($this->DosCol("GASTOS REGISTRADOS: ", 40, Helpers::Dinero($gasto), 10));


$printer -> text($this->DosCol("REMESAS: ", 40, Helpers::Dinero($remesas), 10));


$printer -> text("_______________________________________________________");
$printer->feed();




$printer -> text($this->DosCol("DINERO EN APERTURA: ", 40, Helpers::Dinero($apertura), 20));

$printer -> text($this->DosCol("EFECTIVO INGRESADO: ", 40, Helpers::Dinero($efectivo), 20));


$printer -> text($this->DosCol("DIFERENCIA: ", 40, Helpers::Dinero($diferencia), 20));

$printer -> text("____________________________________________________________");
$printer->feed();




$printer -> text("ORDENES ELIMINADAS: ");
$printer->feed();

$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
$printer -> text($this->Item("#", 'Cant', 'Descripcion', 'Total'));
$printer -> setEmphasis(false);


$printer -> text("____________________________________________________________");
$printer->feed();



$a = $db->query("select mesa, cod, cant, producto, pv, total, fecha, hora, num_fac from ticket_borrado where time BETWEEN '".$inicio."' and '".Helpers::TimeId()."' and td = ".$_SESSION["td"]." order by num_fac");
  
    foreach ($a as $b) {
 
$subtotalf = 0;

$printer -> text($this->Item("(" . $b["mesa"] . ") " . $b["cant"], $b["producto"], NULL ,$b["total"]));

$subtotalf = $subtotalf + $stotal;
///

}    $a->close();



$printer->feed();
$printer->cut();
$printer->close();


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