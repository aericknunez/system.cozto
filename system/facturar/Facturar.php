<?php 
class Facturar{



	public function ModFactura($data){ /// cambiar estado de factura
		$db = new dbConn();

		$cambio = array();	

		switch ($data["iden"]) {
			case "ax0":
				$cambio["ax0"] = $data["edo"];
				break;
			case "ax1":
				$cambio["ax1"] = $data["edo"];
				break;
			case "bx0":
				$cambio["bx0"] = $data["edo"];
				break;
			case "bx1":
				$cambio["bx1"] = $data["edo"];
				break;
			case "cx0":
				$cambio["cx0"] = $data["edo"];
				break;
			case "cx1":
				$cambio["cx1"] = $data["edo"];
				break;
			case "dx0":
				$cambio["dx0"] = $data["edo"];
				break;
			case "dx1":
				$cambio["dx1"] = $data["edo"];
				break;

		}


		$a = $db->query("SELECT * FROM facturar_opciones WHERE td = ".$_SESSION["td"]."");
		if($a->num_rows > 0){    
		    if (Helpers::UpdateId("facturar_opciones", $cambio, "td = ".$_SESSION["td"]."")) {
		        Alerts::Alerta("success","Realizado!","Registros actualizados correctamente");
		    }		
		} else {
		    $cambio["td"] = $_SESSION["td"];
			$cambio["hash"] = Helpers::HashId();
			$cambio["time"] = Helpers::TimeId();
		    if ($db->insert("facturar_opciones", $cambio)) {
		    	Alerts::Alerta("success","Realizado!","Registros actualizados correctamente");
		    } 			
		}

		$a->close();     
	}




public function ObtenerEstadoFactura($efectivo, $factura){ // esta funcion obtiene el estado de la factura, el tx o si es local o web para decidir cual factura mostrar
		$db = new dbConn();
		$imprimir = new Impresiones(); 

	if($_SESSION["tipoticket"] == 1){
		$imprimir->Ticket($efectivo, $factura);
	}
	if($_SESSION["tipoticket"] == 2){
		$imprimir->Factura($efectivo, $factura);
	}
	if($_SESSION["tipoticket"] == 3){
		$imprimir->CreditoFiscal($efectivo, $factura);
	}

}// termina le funcion









public function TiposTicketActivos(){ // esta funcion obtiene los ticket activos para mostrarlos como oopciones
		$db = new dbConn();
// a =  ticket. b =  factura, e = Credito fiscal

if($_SESSION["tx"] == 0){

    if ($r = $db->select("ax0, bx0, ex0", "facturar_opciones", "WHERE td = ".$_SESSION["td"]."")) { 
        $ax = $r["ax0"]; $bx = $r["bx0"]; $ex = $r["bx0"];
    } unset($r);  

} else {
    
    if ($r = $db->select("ax1, bx1, ex1", "facturar_opciones", "WHERE td = ".$_SESSION["td"]."")) { 
        $ax = $r["ax1"]; $bx = $r["bx1"]; $ex = $r["ex1"];
    } unset($r);  
}

if($ax == 1){
echo '<a id="opticket" tipo="1" class="btn btn-cyan">Ticket</a>';
}
if($ex == 1){
echo '<a id="opticket" tipo="3" class="btn btn-brown">Credito Fiscal</a>';
}
if($bx == 1){
echo '<a id="opticket" tipo="2" class="btn btn-indigo">Factura</a>';
}
echo '<a id="opticket" tipo="0" class="btn btn-elegant">Ninguno</a>';



}// termina le funcion









public function ObtenerDatosfacturaWeb(){ /// obtiene el json que se envia a la impresora local
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


 