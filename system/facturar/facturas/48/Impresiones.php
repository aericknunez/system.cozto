 <?php  
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;



class Impresiones{
    public function __construct() { 
     } 


 public function Ticket($efectivo, $numero){
  $db = new dbConn();


$txt1   = "17"; 
$txt2   = "10";
$txt3   = "15";
$txt4   = "8";
$n1   = "18";
$n2   = "24";
$n3   = "21";
$n4   = "10";

// $print
$print = "EPSON TM-U220 Receipt";


$col1 = 0;
$col2 = 30;
$col3 = 250;
$col4 = 330;
$col5 = 330;




$handle = printer_open($print);
printer_set_option($handle, PRINTER_MODE, "RAW");

printer_start_doc($handle, "Mi Documento");
printer_start_page($handle);


$font = printer_create_font("Arial", $txt1, $txt2, PRINTER_FW_NORMAL, false, false, false, 0);
printer_select_font($handle, $font);


//// comienza la factura
printer_draw_text($handle, "FARMACIA JEHOVA RAFAH", 50, $oi);

$oi=$oi+$n1;
printer_draw_text($handle, "Km 51.5 Carr a Ilobasco, Plaza comercial", 0, $oi);
$oi=$oi+$n1;
printer_draw_text($handle, "Ennio Escobar local #2 Ilobasco", 0, $oi);
$oi=$oi+$n1;
printer_draw_text($handle, "Cabanas", 0, $oi);

$oi=$oi+$n1;
printer_draw_text($handle, "Tel: 7861-9295", 0, $oi);

$oi=$oi+$n1;
printer_draw_text($handle, "CAJA: 1", 0, $oi);

///
$oi=$oi+$n2;
printer_draw_text($handle, "____________________________________", 0, $oi);
$oi=$oi+$n1;
printer_draw_text($handle, "Cant.", 0, $oi);
printer_draw_text($handle, "Producto", 60, $oi);
printer_draw_text($handle, "P/U", 240, $oi);
printer_draw_text($handle, "Total", 320, $oi);
$oi=$oi+$n1+$n3;
printer_draw_text($handle, "____________________________________", 0, $oi);


$subtotalf = 0;

$a = $db->query("select cod, cant, producto, pv, total, fecha, hora, num_fac from ticket where num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." and tipo = ".$_SESSION["tipoticket"]." group by cod");
  
    foreach ($a as $b) {
 
 // si el nombre del producto no cabe en el ticket cambiar substr($b["producto"], 0, 38) el 38 por menos
          $oi=$oi+$n1;
          printer_draw_text($handle, $b["cant"], $col1, $oi);
          printer_draw_text($handle, substr($b["producto"], 0, 38), $col2, $oi);
          printer_draw_text($handle, $b["pv"], $col3, $oi);
          printer_draw_text($handle, $b["total"], $col4, $oi);


$subtotalf = $subtotalf + $b["total"];

}    $a->close();


$oi=$oi+$n3+$n1;
printer_draw_text($handle, "Sub Total " . $_SESSION['config_moneda_simbolo'] . ":", 185, $oi);
printer_draw_text($handle, Helpers::Format(Helpers::STotal($subtotalf, $_SESSION['config_imp'])), 320, $oi);


$oi=$oi+$n1;
printer_draw_text($handle, "IVA. " . $_SESSION['config_moneda_simbolo'] . ":", 175, $oi);
printer_draw_text($handle, Helpers::Format(Helpers::Impuesto(Helpers::STotal($subtotalf, $_SESSION['config_imp']), $_SESSION['config_imp'])), 320, $oi);


$oi=$oi+$n1;
printer_draw_text($handle, "Total " . $_SESSION['config_moneda_simbolo'] . ":", 232, $oi);
printer_draw_text($handle, Helpers::Format($subtotalf), 320, $oi);

$oi=$oi+$n2;
printer_draw_text($handle, "____________________________________", 0, $oi);




//efectivo
if($efectivo == NULL){
  $efectivo = $xtotal;
}



$oi=$oi+$n1;
printer_draw_text($handle, "Efectivo " . $_SESSION['config_moneda_simbolo'] . ":", 160, $oi);
printer_draw_text($handle,  Helpers::Format($efectivo), 320, $oi);

//cambio
$cambios = $efectivo - $subtotalf;
$oi=$oi+$n1;
printer_draw_text($handle, "Cambio " . $_SESSION['config_moneda_simbolo'] . ":", 162, $oi);
printer_draw_text($handle, Helpers::Format($cambios), 320, $oi);




$oi=$oi+$n2;
printer_draw_text($handle, "___________________________________", 0, $oi);

// $oi=$oi+$n1;
// printer_draw_text($handle, "G=Articulo Gravado", 0, $oi);


if ($x = $db->select("fecha, hora", "ticket", "WHERE num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."  and tipo = ".$_SESSION["tipoticket"]."" )) { 
$fechaf=$x["fecha"];
$horaf=$x["hora"];
} unset($x); 



$oi=$oi+$n1;
printer_draw_text($handle, $fechaf, 0, $oi);
printer_draw_text($handle, $horaf, 232, $oi);




///// crea de nuevo fuente
$font = printer_create_font("Arial", $txt1, $txt2, PRINTER_FW_NORMAL, false, false, false, 0);
printer_select_font($handle, $font);
//////////////////


$oi=$oi+$n1;
printer_draw_text($handle, "Cajero: " . $_SESSION['nombre'], 25, $oi);

$oi=$oi+$n1+$n4;
printer_draw_text($handle, "GRACIAS POR SU COMPRA...", 50, $oi);

$oi=$oi+$n1+$n2;
printer_draw_text($handle, ".", NULL, $oi);
printer_write($handle, chr(27).chr(112).chr(48).chr(55).chr(121)); //enviar pulso
printer_delete_font($font);



///
printer_end_page($handle);
printer_end_doc($handle);
printer_close($handle);



}





 public function Factura($efectivo, $numero){
$this->Ninguno();
}   /// termina FACTURA





 public function CreditoFiscal($efectivo, $numero){
$this->Ninguno();
}










 public function ImprimirAntes($efectivo, $numero, $cancelar){
  $db = new dbConn();


} /// TERMINA IMPRIMIR ANTES







 public function Comanda(){


 }





 public function Ninguno(){

$nombre_impresora = "TICKET";

$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer->pulse();
$printer->close();


}   /// termina /.;ninguno










 public function ReporteDiario($fecha){
  $db = new dbConn();


}   // termina reporte diario








 public function AbrirCaja(){
$nombre_impresora = "TICKET";

$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer->pulse();
$printer->close();
}













 public function Barcode($numero){

}
















 public function CorteX($hash){ // imprime el resumen del ultimo corte

}











 public function CorteZ($fechax){ // imprime el resumen del ultimo corte
 

}







}// class