<?php 
class FacturarWeb{




public function TicketWeb(){ /// obtiene el json que se envia a la impresora local
		$db = new dbConn();

$parametros = array();
$a = $db->query("SELECT * FROM ticket_num WHERE orden = '".$_SESSION["orden_print"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
foreach ($a as $b) {
        $parametros = $b;
} $a->close();
     
$productos = array();
$x = $db->query("SELECT * FROM ticket WHERE num_fac = '".$b["num_fac"]."' and orden = '".$b["orden"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
foreach ($x as $z) {
     $productos[] = $z;
} $x->close();


$parametros["productos"] = $productos;
$parametros["tipoticket"] = $_SESSION["tipoticket"];
$parametros["identidad"] = $_SESSION["td"];
$parametros["config_imp"] = $_SESSION['config_imp'];



if($_SESSION["tipoticket"] == 2){

if ($r = $db->select("cliente", "ticket_cliente", "WHERE factura = '$numero' and tx = " . $_SESSION["tx"] . " and td = " .  $_SESSION["td"])) { 
$hashcliente = $r["cliente"];
} unset($r);  



if ($r = $db->select("nombre, documento, direccion", "clientes", "WHERE hash = '$hashcliente' and td = " .  $_SESSION["td"])) { 
$parametros["nombre"] = $r["nombre"];
$parametros["documento"] = $r["documento"];
$parametros["direccion"] = $r["direccion"];
} unset($r);  



if ($sx = $db->select("sum(stotal), sum(imp), sum(total)", "ticket", "WHERE num_fac = '".$parametros["num_fac"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." and tipo = ".$_SESSION["tipoticket"]."")) { 
       $parametros["stotal"]=$sx["sum(stotal)"];
       $parametros["imp"]=$sx["sum(imp)"];
       $parametros["total"]=$sx["sum(total)"];
    } unset($sx); 
 

}



if($_SESSION["tipoticket"] == 3){

    if ($r = $db->select("documento", "facturar_documento_factura", "WHERE factura = '$numero' and tx = " . $_SESSION["tx"] . " and td = " .  $_SESSION["td"])) { 
        $documento = $r["documento"];
    } unset($r);  

    if ($r = $db->select("cliente, giro, registro, direccion, departamento", "facturar_documento", "WHERE documento = '$documento' and td = " .  $_SESSION["td"])) { 
        $parametros["cliente"] = $r["cliente"];
        $parametros["giro"] = $r["giro"];
        $parametros["registro"] = $r["registro"];
        $parametros["direccion"] = $r["direccion"];
        $parametros["departamento"] = $r["departamento"];
    } unset($r);  

if ($sx = $db->select("sum(stotal), sum(imp), sum(total)", "ticket", "WHERE num_fac = '".$parametros["num_fac"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." and tipo = ".$_SESSION["tipoticket"]."")) { 
       $parametros["stotal"]=$sx["sum(stotal)"];
       $parametros["imp"]=$sx["sum(imp)"];
       $parametros["total"]=$sx["sum(total)"];
    } unset($sx); 
 
}





echo json_encode($parametros);
		

}// termina le funcion









} // fin de la clase

 ?>


 