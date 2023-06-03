 <?php
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;




class Impresiones{
    public function __construct() {
     }


public function Ticket($efectivo, $numero){
$this->Ticket2($efectivo, $numero);
//$this->Ticket2($efectivo, $numero);
}


 public function Ticket2($efectivo, $numero){
  $db = new dbConn();
  $nombre_impresora = "TICKET";
  // $img  = "C:/AppServ/www/pizto/assets/img/logo_factura/abrego.jpg";


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
$printer->text("MINI SUPER 24/7 EL DIVINO NIÑO");

$printer->feed();
$printer->text("JAYUMI S.A. DE C.V.");
$printer->feed();
$printer->text("4 calle ote. local c-1, San Martin de Porres");
$printer->feed();
$printer->text("San Francisco Menendez");

$printer->feed();
$printer->text("NRC: 285464-2 NIT: 0108-091019-101-0");
$printer->feed();
$printer->text("Giro:Otros servicios relacionados con la salud NCP");
//$printer->text("de Construccion y articulos conexos ");


// $printer->feed();
// $printer->text("NIT: 1010-291061-002-4   NRC: 33274-7");

// $printer->feed();
// $printer->text("GIRO: Clinica Veterinaria y venta de productos Agropecuarios");

$printer->feed();
$printer->text("CAJA: 1.  TICKET NUMERO: " . $numero);


/* Stuff around with left margin */
$printer->feed();
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("_______________________________________________________");
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer->feed();
/* Items */

$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
$printer -> text($this->Item("Cant", 'Producto', 'Precio', 'Total'));
$printer -> setEmphasis(false);


$subtotalf = 0;
$productos = 0;

$a = $db->query("select cod, cant, producto, pv, total, fecha, hora, num_fac from ticket where num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." and tipo = ".$_SESSION["tipoticket"]." group by cod");

    foreach ($a as $b) {

$printer -> text($this->Item($b["cant"], substr($b["producto"], 0, 38), $b["pv"], $b["total"]));

$subtotalf = $subtotalf + $b["total"];
$productos = $productos + $b["cant"];

}    $a->close();



if ($sx = $db->select("sum(total)", "ticket", "WHERE num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."  and tipo = ".$_SESSION["tipoticket"]."" )) {
       $stotalx=$sx["sum(total)"];
    } unset($sx);




$printer -> text("_______________________________________________________");
$printer->feed();

$printer -> text("Cantidad de productos: " . $productos);
$printer->feed();


// $printer -> text($this->DosCol("Sub Total " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format(Helpers::STotal($subtotalf, $_SESSION['config_imp'])), 10));
$printer -> text($this->DosCol("Sub Total  " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format($subtotalf), 10));



// $printer -> text($this->DosCol("IVA " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format(Helpers::Impuesto(Helpers::STotal($subtotalf, $_SESSION['config_imp']), $_SESSION['config_imp'])), 10));


$printer -> text($this->DosCol("TOTAL " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format($subtotalf), 10));



$printer -> text("_______________________________________________________");
$printer->feed();


//efectivo
if($efectivo == NULL){
  $efectivo = $xtotal;
}



$printer -> text($this->DosCol("Efectivo " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format($efectivo), 10));

//cambio
$cambios = $efectivo - $subtotalf;
$printer -> text($this->DosCol("Cambio " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format($cambios), 10));


$printer -> text("_______________________________________________________");
$printer->feed();




if ($x = $db->select("fecha, hora", "ticket", "WHERE num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."  and tipo = ".$_SESSION["tipoticket"]."" )) {
$fechaf=$x["fecha"];
$horaf=$x["hora"];
} unset($x);


$printer->feed();
$printer -> text($this->DosCol("Fecha: ".$fechaf, 30, "Hora: ".$horaf, 20));


// $printer->feed();
// $printer->text("SERIE: 2UA329130D");

$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer->feed();
$printer -> text("Cajero: " . $_SESSION['nombre']);

$printer->feed();
$printer->text("SERIE N°: 23NA00000001");
$printer->feed();
$printer->text("Resolución N°: 30109-RES-CR-38872-2023");
$printer->feed();
$printer->text("RANGO AUTORIZADO DEL 1 AL 200000");
$printer->feed();
$printer->text("FECHA DE AUTORIZACION: 19/12/2019");


$printer->feed();
$printer->feed();
$printer -> text("GRACIAS POR SU PREFERENCIA...");
$printer->feed();





$printer->feed();
$printer->cut();
$printer->pulse();
$printer->close();

}





 public function Factura($efectivo, $numero){
  $db = new dbConn();

$txt1   = "15";
$txt2   = "5";
$txt3   = "0";
$txt4   = "0";
$n1   = "15";
$n2   = "18";
$n3   = "30";
$n4   = "0";


$col1 = 27;
$col2 = 65;
$col3 = 280; //400
$col4 = 400; //565
$col5 = 500;
// $print
$print = "FACTURA";

$handle = printer_open($print);
printer_set_option($handle, PRINTER_MODE, "RAW");

printer_start_doc($handle, "Mi Documento");
printer_start_page($handle);


$font = printer_create_font("Arial", $txt1, $txt2, PRINTER_FW_NORMAL, false, false, false, 0);
printer_select_font($handle, $font);



$oi=120;
//// comienza la factura

$oi=$oi+$n1;
printer_draw_text($handle, date("d") . "          " . Fechas::MesEscrito(date("m")) ."               " . date("Y"), 290, $oi);


$oi=120;


if ($r = $db->select("orden", "ticket_num", "WHERE num_fac = '$numero' and tx = " . $_SESSION["tx"] . " and tipo = ".$_SESSION["tipoticket"]." and td = " .  $_SESSION["td"])) {
    $orden = $r["orden"];
} unset($r);

    if ($r = $db->select("cliente", "ticket_cliente", "WHERE orden = '$orden' and factura = '$numero' and tx = " . $_SESSION["tx"] . " and td = " .  $_SESSION["td"])) {
        $hashcliente = $r["cliente"];
    } unset($r);


    if ($r = $db->select("nombre, documento, direccion", "clientes", "WHERE hash = '$hashcliente' and td = " .  $_SESSION["td"])) {
        $nombre = $r["nombre"];
        $documento = $r["documento"];
        $direccion = $r["direccion"];
    } unset($r);


$oi=$oi+$n1+30;
printer_draw_text($handle, $nombre, 65, $oi);

$oi=$oi+$n1;
printer_draw_text($handle, $direccion, 70, $oi+15);

$oi=$oi+$n1+2;
printer_draw_text($handle, $documento, 105, $oi);
printer_draw_text($handle, "x", 350, $oi+18);


$oi=260; // salto de linea

$a = $db->query("select cod, cant, producto, pv, total, fecha, hora, num_fac from ticket where num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." and tipo = ".$_SESSION["tipoticket"]." group by cod");

    foreach ($a as $b) {

 $fechaf=$b["fecha"];
 $horaf=$b["hora"];
 $num_fac=$b["num_fac"];

          $oi=$oi+$n2;
          printer_draw_text($handle, $b["cant"], $col1, $oi);
          printer_draw_text($handle, $b["producto"], $col2, $oi);
          printer_draw_text($handle, $b["pv"], $col3, $oi);
          printer_draw_text($handle, $b["total"], $col4, $oi);



    }    $a->close();


if ($sx = $db->select("sum(stotal), sum(imp), sum(total)", "ticket", "WHERE num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." and tipo = ".$_SESSION["tipoticket"]."")) {
       $stotalx=$sx["sum(stotal)"];
       $impx=$sx["sum(imp)"];
       $totalx=$sx["sum(total)"];
    } unset($sx);

/// salto de linea
$oi=560;


// valores en letras
printer_draw_text($handle, Dinero::DineroEscrito($totalx), $col2, $oi);
// echo wordwrap($cadena, 15, "<br>" ,FALSE);


// volores numericos
printer_draw_text($handle, Helpers::Format($totalx), $col4, $oi);



$oi=$oi+$n1;
// printer_draw_text($handle, Helpers::Format($impx), $col4, $oi);
// printer_draw_text($handle, Helpers::Format(Helpers::Impuesto(Helpers::STotal($totalx, $_SESSION['config_imp']), $_SESSION['config_imp'])), $col4, $oi);


$oi=$oi+$n1+$n1;
printer_draw_text($handle, Helpers::Format($totalx), $col4, $oi);


$oi=$oi+$n1+$n1;
printer_draw_text($handle, Helpers::Format($totalx), $col4, $oi+48);


// $oi=$oi+$n3+$n1;
// printer_draw_text($handle, "Sub Total " . $_SESSION['config_moneda_simbolo'] . ":", 185, $oi);
// printer_draw_text($handle, Helpers::Format(Helpers::STotal($subtotalf, $_SESSION['config_imp'])), 320, $oi);


// $oi=$oi+$n1;
// printer_draw_text($handle, "15% Impu. " . $_SESSION['config_moneda_simbolo'] . ":", 175, $oi);
// printer_draw_text($handle, Helpers::Format(Helpers::Impuesto(Helpers::STotal($subtotalf, $_SESSION['config_imp']), $_SESSION['config_imp'])), 320, $oi);




// $oi=$oi+$n1;
// printer_draw_text($handle, "Total " . $_SESSION['config_moneda_simbolo'] . ":", 232, $oi);
// printer_draw_text($handle, Helpers::Format($subtotalf), 320, $oi);





printer_delete_font($font);
///
printer_end_page($handle);
printer_end_doc($handle);
printer_close($handle);




}   /// termina FACTURA





 public function CreditoFiscal($efectivo, $numero){
  $db = new dbConn();

$txt1   = "15";
$txt2   = "5";
$txt3   = "0";
$txt4   = "0";
$n1   = "18";
$n2   = "22";
$n3   = "30";
$n4   = "0";


$col1 = 40;
$col2 = 95;
$col3 = 385; //400
$col4 = 540; //565
$col5 = 500;
// $print
$print = "FACTURA";

$handle = printer_open($print);
printer_set_option($handle, PRINTER_MODE, "RAW");

printer_start_doc($handle, "Mi Documento");
printer_start_page($handle);


$font = printer_create_font("Arial", $txt1, $txt2, PRINTER_FW_NORMAL, false, false, false, 0);
printer_select_font($handle, $font);



$oi=197;
//// comienza la factura

$oi=$oi+$n1;
printer_draw_text($handle, date("d             m               Y"), 418, $oi-60);

$oi=$oi+$n1;

// printer_draw_text($handle, date("m"), 490, $oi);
// printer_draw_text($handle, substr(date("Y"), -1), 590, $oi);

$oi=186;

  if ($r = $db->select("documento", "facturar_documento_factura", "WHERE factura = '$numero' and tx = " . $_SESSION["tx"] . " and td = " .  $_SESSION["td"] . " order by time desc limit 1" )) {
      $documento = $r["documento"];
  } unset($r);



    if ($r = $db->select("cliente, giro, registro, direccion, departamento", "facturar_documento", "WHERE documento = '$documento' and td = " .  $_SESSION["td"])) {
        $cliente = $r["cliente"];
        $giro = $r["giro"];
        $registro = $r["registro"];
        $direccion = $r["direccion"];
        $departamento = $r["departamento"];
    } unset($r);



$oi=$oi+$n1+16;
printer_draw_text($handle, $cliente, 75, $oi-32);

$oi=$oi+$n1;
printer_draw_text($handle, $direccion, 90, $oi-25);
printer_draw_text($handle, $departamento, 445, $oi+8);
printer_draw_text($handle, $registro, 445, $oi+8);

$oi=$oi+$n1;
printer_draw_text($handle, $giro, 100, $oi+36);
printer_draw_text($handle, $documento, 445, $oi+12);
printer_draw_text($handle, "CONTADO", 418, $oi+65);


$oi=387; // salto de linea

$a = $db->query("select cod, cant, producto, pv, stotal, total, fecha, hora, num_fac from ticket where num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." and tipo = ".$_SESSION["tipoticket"]." group by cod");

    foreach ($a as $b) {

 $fechaf=$b["fecha"];
 $horaf=$b["hora"];
 $num_fac=$b["num_fac"];

          $oi=$oi+$n2;
          printer_draw_text($handle, $b["cant"], $col1, $oi);
          printer_draw_text($handle, $b["producto"], $col2, $oi);
          printer_draw_text($handle, Helpers::Format4D(Helpers::STotal($b["pv"], $_SESSION['config_imp'])), $col3, $oi);

          // printer_draw_text($handle, $b["pv"], $col3, $oi);
          printer_draw_text($handle, $b["stotal"], $col4, $oi);



    }    $a->close();


if ($sx = $db->select("sum(stotal), sum(imp), sum(total)", "ticket", "WHERE num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." and tipo = ".$_SESSION["tipoticket"]."")) {
       $stotalx=$sx["sum(stotal)"];
       $impx=$sx["sum(imp)"];
       $totalx=$sx["sum(total)"];
    } unset($sx);

/// salto de linea
$oi=720;

// valores en letras
printer_draw_text($handle, Dinero::DineroEscrito($totalx), $col2, $oi);
// echo wordwrap($cadena, 15, "<br>" ,FALSE);


// volores numericos
// printer_draw_text($handle, Helpers::Format($totalx), $col4, $oi);
printer_draw_text($handle, Helpers::Format($stotalx), $col4, $oi);




$oi=$oi+$n1;
// printer_draw_text($handle, Helpers::Format($impx), $col4, $oi);
printer_draw_text($handle, Helpers::Format(Helpers::Impuesto(Helpers::STotal($totalx, $_SESSION['config_imp']), $_SESSION['config_imp'])), $col4, $oi+5);


$oi=$oi+$n1;
printer_draw_text($handle, Helpers::Format($totalx), $col4, $oi+5);


$oi=$oi+$n1+$n1+$n1+$n1;
printer_draw_text($handle, Helpers::Format($totalx), $col4, $oi+32);


// $oi=$oi+$n3+$n1;
// printer_draw_text($handle, "Sub Total " . $_SESSION['config_moneda_simbolo'] . ":", 185, $oi);
// printer_draw_text($handle, Helpers::Format(Helpers::STotal($subtotalf, $_SESSION['config_imp'])), 320, $oi);


// $oi=$oi+$n1;
// printer_draw_text($handle, "15% Impu. " . $_SESSION['config_moneda_simbolo'] . ":", 175, $oi);
// printer_draw_text($handle, Helpers::Format(Helpers::Impuesto(Helpers::STotal($subtotalf, $_SESSION['config_imp']), $_SESSION['config_imp'])), 320, $oi);




// $oi=$oi+$n1;
// printer_draw_text($handle, "Total " . $_SESSION['config_moneda_simbolo'] . ":", 232, $oi);
// printer_draw_text($handle, Helpers::Format($subtotalf), 320, $oi);





printer_delete_font($font);
///
printer_end_page($handle);
printer_end_doc($handle);
printer_close($handle);


}

public function NotaEnvio($efectivo, $numero){
  $db = new dbConn();
  $nombre_impresora = "TICKET";
  // $img  = "C:/AppServ/www/pizto/assets/img/logo_factura/abrego.jpg";


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
$printer->text("MINI SUPER 24/7 EL DIVINO NIÑO");

$printer->feed();
$printer->text("JAYUMI S.A. DE C.V.");
$printer->feed();
$printer->text("4 calle ote. local c-1, San Martin de Porres");
$printer->feed();
$printer->text("San Francisco Menendez");

$printer->feed();
$printer->text("NRC: 285464-2 NIT: 0108-091019-101-0");
$printer->feed();
$printer->text("Giro:Otros servicios relacionados con la salud NCP");
//$printer->text("de Construccion y articulos conexos ");


// $printer->feed();
// $printer->text("NIT: 1010-291061-002-4   NRC: 33274-7");

// $printer->feed();
// $printer->text("GIRO: Clinica Veterinaria y venta de productos Agropecuarios");

$printer->feed();
$printer->text("NOTA DE ENVIO NUMERO: " . $numero);


/* Stuff around with left margin */
$printer->feed();
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("_______________________________________________________");
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer->feed();
/* Items */

$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
$printer -> text($this->Item("Cant", 'Producto', 'Precio', 'Total'));
$printer -> setEmphasis(false);


$subtotalf = 0;
$productos = 0;

$a = $db->query("select cod, cant, producto, pv, total, fecha, hora, num_fac from ticket where num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." and tipo = ".$_SESSION["tipoticket"]." group by cod");

    foreach ($a as $b) {

$printer -> text($this->Item($b["cant"], substr($b["producto"], 0, 38), $b["pv"], $b["total"]));

$subtotalf = $subtotalf + $b["total"];
$productos = $productos + $b["cant"];

}    $a->close();



if ($sx = $db->select("sum(total)", "ticket", "WHERE num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."  and tipo = ".$_SESSION["tipoticket"]."" )) {
       $stotalx=$sx["sum(total)"];
    } unset($sx);




$printer -> text("_______________________________________________________");
$printer->feed();

$printer -> text("Cantidad de productos: " . $productos);
$printer->feed();


// $printer -> text($this->DosCol("Sub Total " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format(Helpers::STotal($subtotalf, $_SESSION['config_imp'])), 10));
$printer -> text($this->DosCol("Sub Total  " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format($subtotalf), 10));



// $printer -> text($this->DosCol("IVA " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format(Helpers::Impuesto(Helpers::STotal($subtotalf, $_SESSION['config_imp']), $_SESSION['config_imp'])), 10));


$printer -> text($this->DosCol("TOTAL " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format($subtotalf), 10));



$printer -> text("_______________________________________________________");
$printer->feed();


//efectivo
if($efectivo == NULL){
  $efectivo = $xtotal;
}



$printer -> text($this->DosCol("Efectivo " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format($efectivo), 10));

//cambio
$cambios = $efectivo - $subtotalf;
$printer -> text($this->DosCol("Cambio " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format($cambios), 10));


$printer -> text("_______________________________________________________");
$printer->feed();




if ($x = $db->select("fecha, hora", "ticket", "WHERE num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."  and tipo = ".$_SESSION["tipoticket"]."" )) {
$fechaf=$x["fecha"];
$horaf=$x["hora"];
} unset($x);


$printer->feed();
$printer -> text($this->DosCol("Fecha: ".$fechaf, 30, "Hora: ".$horaf, 20));


// $printer->feed();
// $printer->text("SERIE: 2UA329130D");

$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer->feed();
$printer -> text("Cajero: " . $_SESSION['nombre']);

$printer->feed();
/*$printer->text("SERIE N°: 19NA00000001");
$printer->feed();
$printer->text("Resolución N°: 30109-RES-CR-72782-2019");
$printer->feed();
$printer->text("RANGO AUTORIZADO DEL 1 AL 100000");
$printer->feed();
$printer->text("FECHA DE AUTORIZACION: 19/12/2019");*/
$printer->feed();
$printer->feed();
$printer->cut();
$printer->close();

}









 public function ImprimirAntes($efectivo, $numero, $cancelar){
  $db = new dbConn();


} /// TERMINA IMPRIMIR ANTES







 public function Comanda(){


 }





 public function Ninguno($efectivo, $numero){
  $db = new dbConn();
  $nombre_impresora = "TICKET";
  // $img  = "C:/AppServ/www/pizto/assets/img/logo_factura/abrego.jpg";


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
$printer->text("MINI SUPER 24/7 EL DIVINO NIÑO");

$printer->feed();
$printer->text("JAYUMI S.A. DE C.V.");
$printer->feed();
$printer->text("4 calle ote. local c-1, San Martin de Porres");
$printer->feed();
$printer->text("San Francisco Menendez");

$printer->feed();
$printer->text("NRC: 285464-2 NIT: 0108-091019-101-0");
$printer->feed();
$printer->text("Giro:Otros servicios relacionados con la salud NCP");
//$printer->text("de Construccion y articulos conexos ");


// $printer->feed();
// $printer->text("NIT: 1010-291061-002-4   NRC: 33274-7");

// $printer->feed();
// $printer->text("GIRO: Clinica Veterinaria y venta de productos Agropecuarios");

$printer->feed();
$printer->text("CAJA: 2.  TICKET NUMERO: " . $numero);


/* Stuff around with left margin */
$printer->feed();
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("_______________________________________________________");
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer->feed();
/* Items */

$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
$printer -> text($this->Item("Cant", 'Producto', 'Precio', 'Total'));
$printer -> setEmphasis(false);


$subtotalf = 0;
$productos = 0;

$a = $db->query("select cod, cant, producto, pv, total, fecha, hora, num_fac from ticket where num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." and tipo = ".$_SESSION["tipoticket"]." group by cod");

    foreach ($a as $b) {

$printer -> text($this->Item($b["cant"], substr($b["producto"], 0, 38), $b["pv"], $b["total"]));

$subtotalf = $subtotalf + $b["total"];
$productos = $productos + $b["cant"];

}    $a->close();



if ($sx = $db->select("sum(total)", "ticket", "WHERE num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."  and tipo = ".$_SESSION["tipoticket"]."" )) {
       $stotalx=$sx["sum(total)"];
    } unset($sx);




$printer -> text("_______________________________________________________");
$printer->feed();

$printer -> text("Cantidad de productos: " . $productos);
$printer->feed();


// $printer -> text($this->DosCol("Sub Total " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format(Helpers::STotal($subtotalf, $_SESSION['config_imp'])), 10));
$printer -> text($this->DosCol("Sub Total  " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format($subtotalf), 10));



// $printer -> text($this->DosCol("IVA " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format(Helpers::Impuesto(Helpers::STotal($subtotalf, $_SESSION['config_imp']), $_SESSION['config_imp'])), 10));


$printer -> text($this->DosCol("TOTAL " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format($subtotalf), 10));



$printer -> text("_______________________________________________________");
$printer->feed();


//efectivo
if($efectivo == NULL){
  $efectivo = $xtotal;
}



$printer -> text($this->DosCol("Efectivo " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format($efectivo), 10));

//cambio
$cambios = $efectivo - $subtotalf;
$printer -> text($this->DosCol("Cambio " . $_SESSION['config_moneda_simbolo'] . ":", 40, Helpers::Format($cambios), 10));


$printer -> text("_______________________________________________________");
$printer->feed();




if ($x = $db->select("fecha, hora", "ticket", "WHERE num_fac = '".$numero."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."  and tipo = ".$_SESSION["tipoticket"]."" )) {
$fechaf=$x["fecha"];
$horaf=$x["hora"];
} unset($x);


$printer->feed();
$printer -> text($this->DosCol("Fecha: ".$fechaf, 30, "Hora: ".$horaf, 20));


// $printer->feed();
// $printer->text("SERIE: 2UA329130D");

$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer->feed();
$printer -> text("Cajero: " . $_SESSION['nombre']);

$printer->feed();
/*$printer->text("SERIE N°: 19NA00000001");
$printer->feed();
$printer->text("Resolución N°: 30109-RES-CR-72782-2019");
$printer->feed();
$printer->text("RANGO AUTORIZADO DEL 1 AL 100000");
$printer->feed();
$printer->text("FECHA DE AUTORIZACION: 19/12/2019");*/


$printer->feed();
$printer->feed();
$printer -> text("GRACIAS POR SU PREFERENCIA...");
$printer->feed();





$printer->feed();
$printer->cut();
$printer->pulse();
$printer->close();

}  /// termina /.;ninguno










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
  $db = new dbConn();
  $nombre_impresora = "TICKET";


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

public function CorteX($hash){

  $this->CorteX2($hash);
  $this->CorteNinguno($hash);
}

 public function CorteX2($hash){ // imprime el resumen del ultimo corte
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
$printer -> text("_______________________________________________________");
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer->feed();
/* Items */


$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer->text("MINI SUPER 24/7 EL DIVINO NIÑO");
$printer->feed();
$printer->text("JAYUMI S.A. DE C.V.");
$printer->feed();
$printer->text("4 calle ote. local c-1, San Martin de Porres");
$printer->feed();
$printer->text("San Francisco Menendez");
$printer->feed();
$printer->text("NRC: 285464-2 NIT: 0108-091019-101-0");
$printer->feed();
$printer->text("Giro:Otros servicios relacionados con la salud NCP");
$printer->text("CAJA: 1.");



// $printer->feed();
// $printer->text("NIT: 1010-291061-002-4   NRC: 33274-7");

// $printer->feed();
// $printer->text("GIRO: Clinica Veterinaria y venta de productos Agropecuarios");


// $printer->feed();




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

$dateA = date('d-m-Y H:i:s', $aperturaF);
$dateC = date('d-m-Y H:i:s', $cierreF);

$printer->feed();
$printer->text("APERTURA: " .$dateA);
$printer->feed();
$printer->text("CIERRE: " .$dateC);
$printer->feed();


$printer->text("GASTOS: " .$gastos. "  ABONOS: " . $abonos);
$printer->feed();


$printer->feed();
$printer -> text("VENTAS");
$printer->feed();
$printer -> text("_______________________________________________________");
$printer->feed();


if ($r = $db->select("sum(stotal)", "ticket", "WHERE edo = 1 and tipo = 1 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."'")) {
    $t_ticket = $r["sum(stotal)"];
} unset($r);

if ($r = $db->select("sum(stotal)", "ticket", "WHERE edo = 1 and tipo = 2 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."'")) {
    $t_factura = $r["sum(stotal)"];
} unset($r);

if ($r = $db->select("sum(stotal)", "ticket", "WHERE edo = 1 and tipo = 3 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."'")) {
    $t_credito = $r["sum(stotal)"];
} unset($r);

if ($r = $db->select("sum(imp)", "ticket", "WHERE edo = 1 and tipo !=0 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."'")) {
    $t_imp = $r["sum(imp)"];
} unset($r);

if ($r = $db->select("sum(total)", "ticket", "WHERE edo = 1 and tipo = 0 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."'")) {
  $t_ticketN = $r["sum(total)"];
} unset($r);

$printer -> text($this->DosCol("TICKET $: ", 40, Helpers::Format($t_ticket), 10));
$printer -> text($this->DosCol("FACTURA $: ", 40, Helpers::Format($t_factura), 10));
$printer -> text($this->DosCol("CREDITO FISCAL $: ", 40, Helpers::Format($t_credito), 10));
$printer -> text($this->DosCol("IMPUESTO $: ", 40, Helpers::Format($t_imp), 10));
$printer -> text($this->DosCol("TOTAL $: ", 40, Helpers::Format($total-$t_ticketN), 10));




$printer->feed();
$printer -> text("PAGOS");
$printer->feed();
$printer -> text("_______________________________________________________");
$printer->feed();


$printer -> text($this->DosCol("EFECTIVO $: ", 40, Helpers::Format($t_efectivo-$t_ticketN), 10));
$printer -> text($this->DosCol("TARJETA DE CREDITO $: ", 40, Helpers::Format($t_tarjeta), 10));
$printer -> text($this->DosCol("TOTAL $: ", 40, Helpers::Format($total-$t_ticketN), 10));
$printer -> text($this->DosCol("APERTURA $: ", 40, Helpers::Format($caja_chica), 10));
$printer -> text($this->DosCol("EFECTIVO INGRESADO $: ", 40, Helpers::Format($efectivo), 10));
$printer -> text($this->DosCol("DIFERENCIA $: ", 40, Helpers::Format($diferencia), 10));


$printer->feed();
$printer -> text("CORRELATIVOS");
$printer->feed();
$printer -> text("_______________________________________________________");
$printer->feed();

// TICKET - subtotal, iva, total, hora
if($t_ticket >= 0){

  $printer -> text("TICKETS");
  $printer->feed();

  $a = $db->query("SELECT num_fac, hora FROM ticket_num WHERE edo = 1 and tipo = 1 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."' order by num_fac asc LIMIT 1");
  $pri = mysqli_fetch_array($a); 
  $c = $db->query("SELECT num_fac, hora FROM ticket_num WHERE edo = 1 and tipo = 1 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."' order by num_fac desc LIMIT 1");
  $seg = mysqli_fetch_array($c);     
  $cant_t = $a->num_rows;
  $primero = $pri["num_fac"];
  $ultimo = $seg["num_fac"];
      
  $printer -> text("Del : " .$primero. " al " .$ultimo);
  $printer->feed();
  }  $a->close();


// FACTURA - subtotal, iva, total, hora
if($t_factura >= 0){

  $printer -> text("FACTURAS");
  $printer->feed();


  $a = $db->query("SELECT num_fac, hora FROM ticket_num WHERE edo = 1 and tipo = 2 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."' order by num_fac asc LIMIT 1");
  $pri = mysqli_fetch_array($a); 
  $c = $db->query("SELECT num_fac, hora FROM ticket_num WHERE edo = 1 and tipo = 2 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."' order by num_fac desc LIMIT 1");
  $seg = mysqli_fetch_array($c);  
      $cant_f = $a->num_rows;
  $primero = $pri["num_fac"];
  $ultimo = $seg["num_fac"];
      
  $printer -> text("Del : " .$primero. " al " .$ultimo);
  $printer->feed();
     

  }  $a->close();


// CCF - subtotal, iva, total, hora
if($t_credito >= 0){

  $printer -> text("CREDITO FISCAL");
  $printer->feed();

  $a = $db->query("SELECT num_fac, hora FROM ticket_num WHERE edo = 1 and tipo = 2 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."' order by num_fac asc LIMIT 1");
  $pri = mysqli_fetch_array($a); 
  $c = $db->query("SELECT num_fac, hora FROM ticket_num WHERE edo = 1 and tipo = 2 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."' order by num_fac desc LIMIT 1");
  $seg = mysqli_fetch_array($c); 
    $cant_c = $a->num_rows;
  $primero = $pri["num_fac"];
  $ultimo = $seg["num_fac"];
        
  $printer -> text("Del : " .$primero. " al " .$ultimo);
  $printer->feed();
     

  }  $a->close();





$printer -> text("_______________________________________________________");
$printer->feed();
// VENTA TOTAL - subtotal, iva, total
  if ($r = $db->select("sum(stotal), sum(imp), sum(total)", "ticket", "WHERE edo = 1 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."'")) {
      $st = $r["sum(stotal)"];
      $im = $r["sum(imp)"];
      $to = $r["sum(total)"];
  } unset($r);

  $printer -> text($this->Col4("VENTA TOTAL",0 ,  "SUBTOTAL", 15,  "IVA", 10, "TOTAL", 10));

  $printer -> text($this->Col4("TOTAL GRAVADO",0 ,  $st, 15,  $im, 10, $to, 10));
  $printer -> text($this->Col4("TOTAL EXENTO",0 ,  Helpers::Format(0), 15,  Helpers::Format(0), 10, Helpers::Format(0), 10));
  $printer -> text($this->Col4("TOTAL NO SUJETO",0 ,  Helpers::Format(0), 12,  Helpers::Format(0), 10, Helpers::Format(0), 10));


$printer->feed();
/*$printer -> text("DETALLES");
$printer->feed();
$printer -> text("_______________________________________________________");
$printer->feed();



$printer -> text($this->Col4("DOCUMENTO",0 ,  "", 0,  "CANTIDAD", 30, "TOTAL", 15));
$printer -> text($this->Col4("TICKETS",0 ,  "", 0,  Helpers::Entero($cant_t), 28, Helpers::Format($t_ticket), 15));
$printer -> text($this->Col4("FACTURAS",0 ,  "", 0,  Helpers::Entero($cant_f), 27, Helpers::Format($t_factura), 15));
$printer -> text($this->Col4("CREDITO FISCAL",0 ,  "", 0,  Helpers::Entero($cant_c), 21, Helpers::Format($t_credito), 15));











$printer -> text("DETALLE DE GASTOS REGISTRADOS: ");
$printer->feed();

$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
$printer -> text($this->Item("Descripcion", '', '', 'Total'));
$printer -> setEmphasis(false);

$printer -> text("_______________________________________________________");
$printer->feed();

$ax = $db->query("select nombre, cantidad FROM gastos WHERE time BETWEEN '".$aperturaF."' and '".$cierreF."' and td = ".$_SESSION["td"]." and edo = 1");

foreach ($ax as $bx) {
$printer -> text($this->Item($bx["nombre"], NULL, NULL ,$bx["cantidad"]));
}   $ax->close();

///////////////



  } unset($r); */
  if ($r = $db->select("nombre", "login_userdata", "WHERE user = '".$user."' and td = ".$_SESSION["td"]."")) {
    $cajero = $r["nombre"];}

$printer->feed();
$printer->text("CAJERO: " . $cajero);


$printer->feed();
$printer->cut();
$printer->close();


}

public function CorteNinguno($hash){ // imprime el resumen de las ventas con ticket ninguno
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
$printer -> text("_______________________________________________________");
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer->feed();
/* Items */


$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer->text("MINI SUPER 24/7 EL DIVINO NIÑO");
$printer->feed();
$printer->text("CAJA: 2.");

//// obtener lor datos del corte
if ($r = $db->select("*", "corte_diario", "WHERE hash = '$hash'")) {
  $aperturaF = $r["aperturaF"];
  $cierreF = $r["cierreF"];
  $apertura = $r["apertura"];
  $cierre = $r["cierre"];
  $fecha = $r["fecha"];
  $caja_chica = $r["caja_chica"];
  $efectivo = $r["efectivo"];
  $total = $r["total"];
  $t_efectivo = $r["t_efectivo"];
  $t_tarjeta = $r["t_tarjeta"];
  $t_credito = $r["t_credito"];
  $gastos = $r["gastos"];
  $abonos = $r["abonos"];
  $diferencia = $r["diferencia"];
  $user = $r["user"];

} unset($r);

$dateA = date('d-m-Y H:i:s', $aperturaF);
$dateC = date('d-m-Y H:i:s', $cierreF);

$printer->feed();
$printer->text("APERTURA: " .$dateA);
$printer->feed();
$printer->text("CIERRE: " .$dateC);
$printer->feed();

$printer -> text("VENTAS");
$printer->feed();
$printer -> text("_______________________________________________________");
$printer->feed();


if ($r = $db->select("sum(total)", "ticket", "WHERE edo = 1 and tipo = 0 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."'")) {
    $t_ticket = $r["sum(total)"];
} unset($r);

$printer -> text($this->DosCol("TICKET CAJA 2 $: ", 40, Helpers::Format($t_ticket), 10));

$printer->feed();
$printer -> text("CORRELATIVOS");
$printer->feed();
$printer -> text("_______________________________________________________");
$printer->feed();

// TICKET - subtotal, iva, total, hora
if($t_ticket >= 0){

  $printer -> text("TICKETS CAJA 2");
  $printer->feed();

  $a = $db->query("SELECT num_fac, hora FROM ticket_num WHERE edo = 1 and tipo = 0 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."' order by num_fac asc LIMIT 1");
  $pri = mysqli_fetch_array($a); 
  $c = $db->query("SELECT num_fac, hora FROM ticket_num WHERE edo = 1 and tipo = 0 and td = ".$_SESSION["td"]." and time BETWEEN '".$aperturaF."' and '".$cierreF."' order by num_fac desc LIMIT 1");
  $seg = mysqli_fetch_array($c);     
  $cant_t = $a->num_rows;
  $primero = $pri["num_fac"];
  $ultimo = $seg["num_fac"];
      
  $printer -> text("Del : " .$primero. " al " .$ultimo);
  $printer->feed();
  }  $a->close();



$printer -> text("_______________________________________________________");
$printer->feed();

  if ($r = $db->select("nombre", "login_userdata", "WHERE user = '".$user."' and td = ".$_SESSION["td"]."")) {
    $cajero = $r["nombre"];}

$printer->feed();
$printer->text("CAJERO: " . $cajero);


$printer->feed();
$printer->cut();
$printer->close();


}











 public function CorteZ($fechax){ // imprime el resumen del ultimo corte
  $db = new dbConn();


  $nombre_impresora = "TICKET";


$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer -> initialize();

$printer -> setFont(Printer::FONT_B);

$printer -> setTextSize(1, 2);
$printer -> setLineSpacing(80);

$printer -> setJustification(Printer::JUSTIFY_LEFT);

$printer -> text("CORTE Z");


/* Stuff around with left margin */
$printer->feed();
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("_______________________________________________________");
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer->feed();
/* Items */

$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer->text("MINI SUPER 24/7 EL DIVINO NIÑO");
$printer->feed();
$printer->text("JAYUMI S.A. DE C.V.");
$printer->feed();
$printer->text("4 calle ote. local c-1, San Martin de Porres");
$printer->feed();
$printer->text("San Francisco Menendez");
$printer->feed();
$printer->text("NRC: 285464-2 NIT: 0108-091019-101-0");
$printer->feed();
$printer->text("Giro:Otros servicios relacionados con la salud NCP");
$printer->feed();
$printer->text("CAJA: 1.");

// $printer->feed();
// $printer->text("NIT: 1010-291061-002-4   NRC: 33274-7");

// $printer->feed();
// $printer->text("GIRO: Clinica Veterinaria y venta de productos Agropecuarios");


$printer->feed();
$printer->text("FECHA: " .  Fechas::FechaEscrita($fechax));


$printer->feed();
$printer -> text("VENTAS");
$printer->feed();
$printer -> text("_______________________________________________________");
$printer->feed();


if ($r = $db->select("sum(stotal)", "ticket", "WHERE edo = 1 and tipo = 1 and td = ".$_SESSION["td"]." and fecha = '$fechax'")) {
    $t_ticket = $r["sum(stotal)"];
} unset($r);

if ($r = $db->select("sum(stotal)", "ticket", "WHERE edo = 1 and tipo = 2 and td = ".$_SESSION["td"]." and fecha = '$fechax'")) {
    $t_factura = $r["sum(stotal)"];
} unset($r);

if ($r = $db->select("sum(stotal)", "ticket", "WHERE edo = 1 and tipo = 3 and td = ".$_SESSION["td"]." and fecha = '$fechax'")) {
    $t_credito = $r["sum(stotal)"];
} unset($r);

if ($r = $db->select("sum(imp), sum(total)", "ticket", "WHERE edo = 1 and td = ".$_SESSION["td"]." and fecha = '$fechax'")) {
    $t_imp = $r["sum(imp)"];
    $total = $r["sum(total)"];
} unset($r);


$printer -> text($this->DosCol("TICKET $: ", 40, Helpers::Format($t_ticket), 10));
$printer -> text($this->DosCol("FACTURA $: ", 40, Helpers::Format($t_factura), 10));
$printer -> text($this->DosCol("CREDITO FISCAL $: ", 40, Helpers::Format($t_credito), 10));
$printer -> text($this->DosCol("IMPUESTO $: ", 40, Helpers::Format($t_imp), 10));
$printer -> text($this->DosCol("TOTAL $: ", 40, Helpers::Format($total), 10));


if($a = $db->query("SELECT sum(abono) FROM creditos_abonos WHERE fecha = '$fechax' and td = ".$_SESSION["td"]." and edo = 1")){
    $abono = mysqli_fetch_array($a); 
    $abonos = $abono["sum(abono)"];
}$a->close();

$printer -> text($this->DosCol("ABONOS $: ", 40, Helpers::Format($abonos), 10));

$printer->feed();
$printer -> text("PAGOS");
$printer->feed();
$printer -> text("_______________________________________________________");
$printer->feed();


if ($r = $db->select("sum(total)", "ticket", "WHERE edo = 1 and tipo_pago = 1 and td = ".$_SESSION["td"]." and fecha = '$fechax'")) {
    $t_efectivo = $r["sum(total)"];
} unset($r);

if ($r = $db->select("sum(total)", "ticket", "WHERE edo = 1 and tipo_pago = 2 and td = ".$_SESSION["td"]." and fecha = '$fechax'")) {
    $t_tarjeta = $r["sum(total)"];
} unset($r);


$printer -> text($this->DosCol("EFECTIVO $: ", 40, Helpers::Format($t_efectivo), 10));
$printer -> text($this->DosCol("TARJETA DE CREDITO $: ", 40, Helpers::Format($t_tarjeta), 10));
$printer -> text($this->DosCol("TOTAL $: ", 40, Helpers::Format($total), 10));


$printer->feed();
$printer -> text("CORRELATIVOS");
$printer->feed();
$printer -> text("_______________________________________________________");
$printer->feed();

// TICKET - subtotal, iva, total, hora
if($t_ticket > 0){

  $printer -> text("TICKETS");
  $printer->feed();

  $a = $db->query("SELECT num_fac, hora FROM ticket_num WHERE edo = 1 and tipo = 1 and td = ".$_SESSION["td"]." and fecha = '$fechax' order by num_fac asc limit 1");
  $pri = mysqli_fetch_array($a); 
  $c = $db->query("SELECT num_fac, hora FROM ticket_num WHERE edo = 1 and tipo = 1 and td = ".$_SESSION["td"]." and fecha = '$fechax' order by num_fac desc limit 1");
  $seg = mysqli_fetch_array($c);   
  $cant_t = $a->num_rows;

  $primero = $pri["num_fac"];
  $ultimo = $seg["num_fac"];

  $printer -> text("Del : " .$primero. " al " .$ultimo);
  $printer->feed();
  $a->close();  
  $c->close(); } 


// FACTURA - subtotal, iva, total, hora
if($t_factura > 0){

  $printer -> text("FACTURAS");
  $printer->feed();


  $a = $db->query("SELECT num_fac, hora FROM ticket_num WHERE edo = 1 and tipo = 2 and td = ".$_SESSION["td"]." and fecha = '$fechax'order by num_fac asc limit 1");
  $pri = mysqli_fetch_array($a); 
  $c = $db->query("SELECT num_fac, hora FROM ticket_num WHERE edo = 1 and tipo = 2 and td = ".$_SESSION["td"]." and fecha = '$fechax'order by num_fac desc limit 1");
  $seg = mysqli_fetch_array($c); 
  $cant_f = $a->num_rows;
  
  $primero = $pri["num_fac"];
  $ultimo = $seg["num_fac"];

  $printer -> text("Del : " .$primero. " al " .$ultimo);
  $printer->feed();

   $a->close();
   $c->close();} 


// CCF - subtotal, iva, total, hora
if($t_credito > 0){

  $printer -> text("CREDITO FISCAL");
  $printer->feed();

  $a = $db->query("SELECT num_fac, hora FROM ticket_num WHERE edo = 1 and tipo = 3 and td = ".$_SESSION["td"]." and fecha = '$fechax' order by num_fact asc limit 1");
  $pri = mysqli_fetch_array($a); 
  $c = $db->query("SELECT num_fac, hora FROM ticket_num WHERE edo = 1 and tipo = 3 and td = ".$_SESSION["td"]." and fecha = '$fechax' order by num_fact asc limit 1");
  $seg = mysqli_fetch_array($c); 

  $cant_c = $a->num_rows;
  $primero = $pri["num_fac"];
  $ultimo = $seg["num_fac"];

  $printer -> text("Del : " .$primero. " al " .$ultimo);
  $printer->feed();
     
  $a->close(); 
  $c->close(); } 





$printer -> text("_______________________________________________________");
$printer->feed();
// VENTA TOTAL - subtotal, iva, total
  if ($r = $db->select("sum(stotal), sum(imp), sum(total)", "ticket", "WHERE edo = 1 and td = ".$_SESSION["td"]." and fecha = '$fechax'")) {
      $st = $r["sum(stotal)"];
      $im = $r["sum(imp)"];
      $to = $r["sum(total)"];
  } unset($r);

  $printer -> text($this->Col4("VENTA TOTAL",0 ,  "SUBTOTAL", 15,  "IVA", 10, "TOTAL", 10));

  $printer -> text($this->Col4("TOTAL GRAVADO",0 ,  $st, 15,  $im, 10, $to, 10));
  $printer -> text($this->Col4("TOTAL EXENTO",0 ,  Helpers::Format(0), 15,  Helpers::Format(0), 10, Helpers::Format(0), 10));
  $printer -> text($this->Col4("TOTAL NO SUJETO",0 ,  Helpers::Format(0), 12,  Helpers::Format(0), 10, Helpers::Format(0), 10));


$printer->feed();
$printer -> text("DETALLES");
$printer->feed();
$printer -> text("_______________________________________________________");
$printer->feed();



$printer -> text($this->Col4("DOCUMENTO",0 ,  "", 0,  "CANTIDAD", 30, "TOTAL", 15));
$printer -> text($this->Col4("TICKETS",0 ,  "", 0,  Helpers::Entero($cant_t), 28, Helpers::Format($t_ticket), 20));
$printer -> text($this->Col4("FACTURAS",0 ,  "", 0,  Helpers::Entero($cant_f), 27, Helpers::Format($t_factura), 20));
$printer -> text($this->Col4("CREDITO FISCAL",0 ,  "", 0,  Helpers::Entero($cant_c), 21, Helpers::Format($t_credito), 20));





$printer->feed();
$printer->cut();
$printer->close();


}



















 public function Item($cant,  $name = '', $price = '', $total = '', $dollarSign = false){
        $rightCols = 8;
        $leftCols = 38;
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



 public function Col4($col1, $esp1,  $col2, $esp2, $col3, $esp3,  $col4,$esp4){
        $la1 = str_pad($col1, $esp1, ' ', STR_PAD_LEFT);
        $la2 = str_pad($col2, $esp2, ' ', STR_PAD_LEFT);
        $la3 = str_pad($col3, $esp3, ' ', STR_PAD_LEFT);
        $la4 = str_pad($col4, $esp4, ' ', STR_PAD_LEFT);
        return "$la1$la2$la3$la4\n";
    }








}// class
