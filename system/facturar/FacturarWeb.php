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

echo json_encode($parametros);
		

}// termina le funcion









} // fin de la clase

 ?>


 