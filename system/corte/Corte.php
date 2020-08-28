<?php 
class Corte{

	public function __construct() { 
     } 




	public function VentaHoy($fecha){
		$db = new dbConn();
	    $a = $db->query("SELECT sum(total) FROM ticket WHERE edo = 1 and td = ".$_SESSION["td"]." and fecha = '$fecha'");
		    foreach ($a as $b) {
		     return $b["sum(total)"];
		    } $a->close();
	}

 /// para ver las ventas de un mes especifico // eje feha 05-2019
 	public function VentaMes($fecha){
		$db = new dbConn();
	    $a = $db->query("SELECT sum(total) FROM ticket WHERE edo = 1 and td = ".$_SESSION["td"]." and fecha like '%-$fecha'");
		    foreach ($a as $b) {
		     return $b["sum(total)"];
		    } $a->close();
	}


	public function ProductosHoy($fecha){
		$db = new dbConn();
	    $a = $db->query("SELECT sum(cant) FROM ticket WHERE edo = 1 and td = ".$_SESSION["td"]." and fecha = '$fecha'");
		    foreach ($a as $b) {
		     return $b["sum(cant)"];
		    } $a->close();
	}


	public function GastoHoy($fecha){
		$db = new dbConn();
	    $a = $db->query("SELECT sum(cantidad) FROM gastos WHERE edo != 0 and tipo != 5 and td = ".$_SESSION["td"]." and fecha = '$fecha'");
		    foreach ($a as $b) {
		     $total=$b["sum(cantidad)"];
		    } $a->close();
		    return $total;
	}



	public function GastoMes($fecha){ /// para ver los gastos de un mes especifico // eje feha 05-2019
		$db = new dbConn();
	    $a = $db->query("SELECT sum(cantidad) FROM gastos WHERE edo != 0 and tipo != 5 and td = ".$_SESSION["td"]." and fecha like '%-$fecha'");
		    foreach ($a as $b) {
		     $total=$b["sum(cantidad)"];
		    } $a->close();
		    return $total;
	}


	public function ClientesHoy($fecha){
		$db = new dbConn();
		$a = $db->query("SELECT * FROM ticket_orden WHERE td = ".$_SESSION["td"]." and fecha = '$fecha'");
		return $a->num_rows;
		$a->close();

	}


	public function TotalTx($fecha){
		$db = new dbConn();
	    $a = $db->query("SELECT sum(total) FROM ticket WHERE edo = 1 and td = ".$_SESSION["td"]." and fecha = '$fecha' and tx = 1");
		    foreach ($a as $b) {
		     $total=$b["sum(total)"];
		    } $a->close();
		    return $total;
	}


	public function TotalNoTx($fecha){
		$db = new dbConn();
	    $a = $db->query("SELECT sum(total) FROM ticket WHERE edo = 1 and td = ".$_SESSION["td"]." and fecha = '$fecha' and tx = 0");
		    foreach ($a as $b) {
		     $total=$b["sum(total)"];
		    } $a->close();
		    return $total;
	}



	public function TVentasX($fecha, $tipo){
		$db = new dbConn();
	    $a = $db->query("SELECT sum(total) FROM ticket 
	    	WHERE edo = 1 and td = ".$_SESSION["td"]." and tipo_pago = '$tipo' and fecha = '$fecha'");
		    foreach ($a as $b) {
		     return $b["sum(total)"];
		    } $a->close();
	}


	public function DiferenciaDinero($caja_chica, $efectivo, $fecha){
		/// conversiones para el dinero
		$total_cc = $this->TVentasX($fecha, 1)+$caja_chica+$this->TotalAbonos($fecha)+$this->EntradasEfectivo($fecha); //total ventas  mas caja chica de ayer
		$total_debido = $total_cc-$this->GastoHoy($fecha); //dinero que deberia haber ()
		$diferencia = $efectivo - $total_debido;
		return $diferencia;
	}


	public function EntradasEfectivo($fecha){
		$db = new dbConn();
	        $a = $db->query("SELECT sum(cantidad) FROM entradas_efectivo WHERE  edo = 1 and td = ".$_SESSION["td"]." and fecha = '$fecha'");
		    foreach ($a as $b) {
		        $efectivo=$b["sum(cantidad)"];
		    } $a->close();
		    return  $efectivo;

	}


	public function TotalAbonos($fecha){
		$db = new dbConn();
	       $a = $db->query("SELECT sum(abono) FROM creditos_abonos WHERE td = ".$_SESSION["td"]." and edo = 1 and fecha = '$fecha'");
		    foreach ($a as $b) {
		        $abono=$b["sum(abono)"];
		    } $a->close();
		    return  $abono;

	}





	public function GetEfectivo(){ // el ultimo efectivo
		$db = new dbConn();
	    if ($r = $db->select("efectivo_ingresado", "corte_diario", "where edo = 2 and td = ".$_SESSION["td"]." order by id DESC LIMIT 1")) {  return $r["efectivo_ingresado"];
	    } unset($r); 
	}



	public function GetDiferencia($fecha){ //para reporte nada mas
		$db = new dbConn();
	    if ($r = $db->select("diferencia", "corte_diario", "where edo = 2 and fecha = '$fecha' and td = ".$_SESSION["td"]." order by id DESC LIMIT 1")) { 
	        $diferencia=$r["diferencia"];
	    } 
	    unset($r); 
		return $diferencia;
	}



	public function EfectivoDebido($fecha){ //para reporte efectivo que debe haber
		$db = new dbConn();
	    $total_cc = $this->TVentasX($fecha, 1)+$this->GetEfectivo()+$this->TotalAbonos($fecha)+$this->EntradasEfectivo($fecha); //total ventas  mas caja chica de ayer
		$total_debido = $total_cc-$this->GastoHoy($fecha); //dinero que deberia haber ()
		return $total_debido;
	
	}











// public function Porcentaje(){
// 	$db = new dbConn();

// 	$cant_g = Corte::TotalTx(date("d-m-Y"));
// 	$cant_e = Corte::TotalNoTx(date("d-m-Y"));

// 	$topor=$cant_g+$cant_e;
// 	$por1=$cant_g*100;
// 	@$por1=$por1/$topor;

// 	$por2=$cant_e*100;
// 	@$por2=$por2/$topor;
// 	$por1=number_format($por1,0,'.','.');
// 	$por2=number_format($por2,0,'.','.');

// 	return "$por1/$por2";

// }







} // fin de la clase

 ?>