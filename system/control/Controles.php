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

	public function CreditoPendiente(){ /// total de productos registrados
		$db = new dbConn();
		$a = $db->query("SELECT sum(abono) FROM creditos_abonos WHERE edo = 1 and td = ".$_SESSION["td"]."");
			foreach ($a as $b) {
			$abonos = $b["sum(abono)"];
		} $a->close();

		$a = $db->query("SELECT sum(total) FROM ticket WHERE edo = 1 and tipo_pago = 3 and td = ".$_SESSION["td"]."");
			foreach ($a as $b) {
			$creditos = $b["sum(total)"];
		} $a->close();

		return 	$creditos - $abonos;
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
		$ValorInventario = 0;
		$a = $db->query("SELECT cod, cantidad FROM producto WHERE td = ".$_SESSION["td"]."");
		foreach ($a as $b) {
			$cod = $b["cod"];
			$cantidad = $b["cantidad"];
			if ($r = $db->query("SELECT existencia, precio_costo FROM producto_ingresado WHERE existencia > 0 and producto = '$cod' and td = ".$_SESSION["td"]."")) {
				if ($r->num_rows > 0) {
						$valorTotal = 0;
						$cantidadTotal = 0;
						foreach ($r as $s) {
							$valorTotal = $valorTotal + ($s["existencia"] * $s["precio_costo"]);
							$cantidadTotal = $cantidadTotal + $s["existencia"];
						}
						$costoPromedio = $valorTotal / $cantidadTotal;
				}else {
						$costoPromedio = 0 ; 
					  }
				unset($r);

			}
			$ValorInventario = $ValorInventario + ($cantidad * $costoPromedio);
		}$a->close();
		return $ValorInventario;
	}

} // Termina la lcase
?>