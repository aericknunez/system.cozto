<?php 
class ImprimirAbonosWeb{




public function AbonosWeb($credito){ /// obtiene el json que se envia a la impresora local
		$db = new dbConn();

$parametros = array();


if ($r = $db->select("*", "creditos", "WHERE hash = '".$credito."' and td= " . $_SESSION["td"])) { 
    $parametros["nombre"] = $r["nombre"];
    $parametros["factura"] = $r["factura"];
    $parametros["orden"] = $r["orden"];
    $parametros["tx"] = $r["tx"];
    $parametros["fecha"] = $r["fecha"];
}  unset($r);  


$parametros["tipoticket"] = 99;
$parametros["identidad"] = $_SESSION["td"];
$parametros["config_imp"] = $_SESSION['config_imp'];
$parametros["cajero"] = $_SESSION['nombre'];

$saldo = 0;
$totalx = 0;
if ($r = $db->select("sum(total)", "ticket", "WHERE num_fac = '".$parametros["factura"]."' and orden = '".$parametros["orden"]."' and tx = '".$parametros["tx"]."' and td= " . $_SESSION["td"])) { 
    $total = $r["sum(total)"];
    }  unset($r); 

$a = $db->query("SELECT * FROM creditos_abonos WHERE edo = 1 and credito = '$credito' and td= " . $_SESSION["td"]);
foreach ($a as $b) {
   $totalx = $totalx + $b["abono"];
   $saldo = $total - $totalx;
   $user = $b["user"];
   $abonos[] = $b;
} $a->close();

$parametros["totalx"] = $totalx;
$parametros["abonos"] = $abonos;
$parametros["saldo"] = $saldo;
$parametros["total"] = $total;
$parametros["user"] = $user;


if ($r = $db->select("nombre", "login_userdata", "WHERE user = '$user'")) { 
    $parametros["usuario"] = $r["nombre"];
}  unset($r); 



echo json_encode($parametros);
		

}// termina le funcion









} // fin de la clase

 ?>


 