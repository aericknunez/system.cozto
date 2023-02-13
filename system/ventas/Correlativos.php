<?php 
class Correlativos {



 public function setCorrelativo($correlativo){
  $db = new dbConn();

  if ($r = $db->select("num_fac", "ticket_num", "WHERE tipo = '".$_SESSION["tipoticket"]."' and td = ".$_SESSION["td"]." and tx = ".$_SESSION["tx"]." order by id desc limit 1")) { 
        $ultimoorden = $r["correlativo"];
    } unset($r);  

    if($correlativo > $ultimoorden){
        $_SESSION['newCorrelativo'] = $correlativo;
    }

    if($_SESSION['newCorrelativo']) {
		echo "Correlativo: " . $_SESSION['newCorrelativo'];
	} else {
        echo "Sin correlativo";
    }
 }



 





} // Termina la lcase
?>