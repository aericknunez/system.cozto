<?php
class Controles{

	public function __construct() {
	}


	public function Clave(){
		$numero = sha1(Fechas::Format(date("d-m-Y")));
		$num = substr("$numero", 0, 6);
		return $num;
	}

	public function TotalProductos(){
		$db = new dbConn();
		$a = $db->query("SELECT sum(cantidad) FROM producto WHERE td = ".$_SESSION["td"]."");
		foreach ($a as $b) {
		return $b["sum(cantidad)"];
		} $a->close();
	}


	public function CuentasPendientes(){ /// total de productos registrados
		$db = new dbConn();

		$a = $db->query("SELECT sum(abono) FROM cuentas_abonos WHERE edo = 1 and td = ".$_SESSION["td"]."");
			foreach ($a as $b) {
			$abonos = $b["sum(abono)"];
		} $a->close();

		$a = $db->query("SELECT sum(total) FROM cuentas WHERE edo != 0 and td = ".$_SESSION["td"]."");
			foreach ($a as $b) {
			$creditos = $b["sum(total)"];
		} $a->close();

		return 	$creditos - $abonos;
	}


	public function TotalAbonosCuentas($fecha){
		$db = new dbConn();
		$a = $db->query("SELECT sum(abono) FROM cuentas_abonos WHERE td = ".$_SESSION["td"]." and edo = 1 and fecha = '$fecha'");
			foreach ($a as $b) {
			$abono=$b["sum(abono)"];
		} $a->close();
		return  $abono;
	}



	public function DescuentosHoy($fecha){ /// total de descuentos hoy
		$db = new dbConn();

		$a = $db->query("SELECT sum(descuento) FROM ticket WHERE edo = 1 and fecha = '$fecha' and td = ".$_SESSION["td"]."");
			foreach ($a as $b) {
			$descuento = $b["sum(descuento)"];
		} $a->close();

		return 	$descuento;
	}

	public function ValorInventario(){
		$db = new dbConn();
			$a = $db->query("SELECT sum(saldo_total) FROM kardex WHERE (cod, time) IN (SELECT cod, MAX(time) FROM kardex GROUP BY cod) AND td = ".$_SESSION["td"]."");
			foreach($a as $b){
				$ValorInventario = $b["sum(saldo_total)"];
			}$a->close();
			return $ValorInventario;
			}


} // Termina la lcase
?>