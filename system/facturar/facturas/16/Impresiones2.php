 <?php  

class Impresiones{
    public function __construct() { 
     } 


  public function Ticket($efectivo, $numero){
  $db = new dbConn();

// $img  = "logo.bmp";
$txt1   = "35"; 
$txt2   = "15";
$txt3   = "0";
$txt4   = "0";
$n1   = "40";
$n2   = "60";
$n3   = "0";
$n4   = "0";

$col1 = 0;
$col2 = 35;
$col3 = 50;
$col4 = 400;
$col5 = 490;

// $print
$print = "EPSON2";
// $logo_imagen="C:/AppServ/www/cozto/assets/img/logo_factura/". $img;



$handle = printer_open($print);
printer_set_option($handle, PRINTER_MODE, "RAW");

printer_start_doc($handle, "Mi Documento");
printer_start_page($handle);

// printer_draw_bmp($handle, $logo_imagen, 35, 1, 450, 300);

$font = printer_create_font("Arial", $txt1, $txt2, PRINTER_FW_NORMAL, false, false, false, 0);
printer_select_font($handle, $font);



$oi=20;
//// comienza la factura

printer_draw_text($handle, "SERVI AGRO VICENTINO", 100, $oi);
$oi=$oi+$n1;
printer_draw_text($handle, "Clinica Veterinaria y venta de productos", 5, $oi);
$oi=$oi+$n1;
printer_draw_text($handle, "Agropecuarios", 200, $oi);

$oi=$oi+$n1;
printer_draw_text($handle, "Dr. Ulises Napoleon Rivas Martinez", 5, $oi);
$oi=$oi+$n1;
printer_draw_text($handle, "Calle Quinones de Osorio # 35", 5, $oi);
$oi=$oi+$n1;
printer_draw_text($handle, "Bo. El Calvario, San Vicente", 5, $oi);

$oi=$oi+$n1;
printer_draw_text($handle, "Tel: 2393-0845", 5, $oi);


// $oi=$oi+$n1;
// printer_draw_text($handle, Helpers::Pais($_SESSION['config_pais']), 0, $oi);
// $oi=$oi+$n1;
// printer_draw_text($handle, "Propietario: " . $_SESSION['config_propietario'], 0, $oi);
// $oi=$oi+$n1;
// printer_draw_text($handle, $_SESSION['config_nombre_documento'] . ": " . $_SESSION['config_nit'], 0, $oi);

$oi=$oi+$n2;
printer_draw_text($handle, "____________________________________", 0, $oi);
$oi=$oi+$n1;
printer_draw_text($handle, "Cant.", 55, $oi);
printer_draw_text($handle, "Descripcion", $col2, $oi);
printer_draw_text($handle, "P/U", $col4, $oi);
printer_draw_text($handle, "Total", $col5, $oi);

$oi=$oi+30;
printer_draw_text($handle, "____________________________________", 0, $oi);


$font = printer_create_font("Arial", 30, 12, PRINTER_FW_NORMAL, false, false, false, 0);
printer_select_font($handle, $font);


$subtotalf = 0;
///

$a = $db->query("select cod, cant, producto, pv, total, fecha, hora, num_fac from ticket where num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." group by cod");
  
    foreach ($a as $b) {
 
 $fechaf=$b["fecha"];
 $horaf=$b["hora"];
 $num_fac=$b["num_fac"];

          $oi=$oi+$n1;
          printer_draw_text($handle, $b["cant"], $col1, $oi);
          printer_draw_text($handle, $b["producto"], $col2, $oi);
          printer_draw_text($handle, $b["pv"], $col4, $oi);
          printer_draw_text($handle, $b["total"], $col5, $oi);


////
$subtotalf = $subtotalf + $b["total"];
///


$font = printer_create_font("Arial", $txt1, $txt2, PRINTER_FW_NORMAL, false, false, false, 0);
printer_select_font($handle, $font);


    }    $a->close();


if ($sx = $db->select("sum(total)", "ticket", "WHERE num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."")) { 
       $stotalx=$sx["sum(total)"];
    } unset($sx); 
 

$oi=$oi+$n1;
printer_draw_text($handle, "____________________________________", 0, $oi);


$oi=$oi+$n3+$n1;
printer_draw_text($handle, "Sub Total: " . $_SESSION['config_moneda_simbolo'] . ":", 175, $oi);
printer_draw_text($handle, Helpers::Format(Helpers::STotal($subtotalf, $_SESSION['config_imp'])), $col5, $oi);


$oi=$oi+$n1;
printer_draw_text($handle, "IVA: " . $_SESSION['config_moneda_simbolo'] . ":", 260, $oi);
printer_draw_text($handle, Helpers::Format(Helpers::Impuesto(Helpers::STotal($subtotalf, $_SESSION['config_imp']), $_SESSION['config_imp'])), $col5, $oi);




$oi=$oi+$n1;
printer_draw_text($handle, "Total: " . $_SESSION['config_moneda_simbolo'] . ":", 240, $oi);
printer_draw_text($handle, Helpers::Format($subtotalf), $col5, $oi);




$oi=$oi+$n2;
printer_draw_text($handle, "____________________________________", 0, $oi);

//efectivo
if($efectivo == NULL){
  $efectivo = $stotalx;
}
$oi=$oi+$n1;
printer_draw_text($handle, "Efectivo " . $_SESSION['config_moneda_simbolo'] . ":", 200, $oi);
printer_draw_text($handle, Helpers::Format($efectivo), $col5, $oi);

//cambio
$cambios = $efectivo - $stotalx;
$oi=$oi+$n1;
printer_draw_text($handle, "Cambio " . $_SESSION['config_moneda_simbolo'] . ":", 202, $oi);
printer_draw_text($handle, Helpers::Format($cambios), $col5, $oi);

$oi=$oi+$n2;
printer_draw_text($handle, "___________________________________", 0, $oi);


$oi=$oi+$n1;
printer_draw_text($handle, $fechaf, 100, $oi);
printer_draw_text($handle, $horaf, 332, $oi);


$oi=$oi+$n1;
printer_draw_text($handle, "Cajero: " . $_SESSION['nombre'], 25, $oi);


$oi=$oi+$n1+$n4;
printer_draw_text($handle, "GRACIAS POR PREFERIRNOS...", 50, $oi);


$oi=$oi+$n1;
printer_draw_text($handle, ".", 0, $oi);

printer_write($handle, chr(27).chr(112).chr(48).chr(55).chr(121)); //enviar pulso

printer_delete_font($font);
///
printer_end_page($handle);
printer_end_doc($handle);
printer_close($handle);



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











}// class