<?php 
class ReportesFacturas{



public function ReporteF($inicio, $fin, $type = NULL) {
		$db = new dbConn();
		$primero = Fechas::Format($inicio);
		$segundo = Fechas::Format($fin);
		$diaA = strtotime('+1 day', $segundo);
		$diaA = date('d-m-Y', $diaA);
		$tercero = Fechas::Format($diaA);

if($primero == $segundo){
	$sqlx = "fecha = '$inicio'";
} else {
	$sqlx = "time BETWEEN '$primero' AND '$tercero'";
}

if($type == NULL or $type == 0){
  $a = $db->query("SELECT * FROM ticket_num WHERE $sqlx and td = ".$_SESSION['td']." order by time desc");	
} else {
  $a = $db->query("SELECT * FROM ticket_num WHERE tipo = '$type' and $sqlx and td = ".$_SESSION['td']." order by time desc");
}

   if ($a->num_rows > 0) {

	  echo '<h3 class="h3-responsive">REPORTE DOCUMENTOS EMITIDOS</h3>
	  <div class="table-responsive text-nowrap">
	  <table class="table table-striped table-sm table-bordered">

		<thead>
	     <tr>
	       <th>Fecha</th>
	       <th>Tipo</th>					       
	       <th>Numero</th>
		   <th>Estado</th>
		   <th>Cliente</th>
	       <th>Tipo Pago</th>
	       <th>Cajero</th>
	       <th>Productos</th>
	       <th>Total</th>
	     </tr>
	   </thead>
	   <tbody>';

    foreach ($a as $b) {
	$numeroFactura = $b["num_fac"];
$ag = $db->query("SELECT sum(cant), sum(total), cajero, tipo_pago, orden, tipo FROM ticket where num_fac = '".$b["num_fac"]."' and orden = '".$b["orden"]."' and tipo = '".$b["tipo"]."' and td = ".$_SESSION['td']."");
foreach ($ag as $bg) { 
	$cant = $bg["sum(cant)"];
	$total = $bg["sum(total)"];
	$cajero = $bg["cajero"];
	$tipo_pago = $bg["tipo_pago"];
	$orden = $bg["orden"];
	$tipo = $bg["tipo"];
	if($b["edo"] == 1){
		$estado = "Activo";
		$class = "";
	}else{
		$estado = "Anulado";
		$class = "text-danger";
	}
	
} $ag->close();

	echo '<tr class = "'.$class.'" >
		   <th>'.$b["fecha"].' '.$b["hora"].'</th>					       
		   <th>'.Helpers::TipoFacturaVentas($b["tipo"]).'</th>
		   <th>'.$b["num_fac"].'</th>
		   <th>'.$estado.'</th>
		   <th>'.$this->ClienteProducto($orden, $tipo, $numeroFactura, $b["time"]).'</th>
		   <th>'.Helpers::TipoPago($tipo_pago).'</th>
		   <th>'.$this->CajeroVentas($cajero).'</th>
		   <th>'.$cant.'</th>
		   <th class="text-right">'.Helpers::Dinero($total).'</th>	  
		 </tr>';
    }    

	echo '<tr>
	       <th>Fecha</th>
	       <th>Tipo</th>					       
	       <th>Numero</th>
		   <th>Estado</th>
		   <th>Cliente</th>
	       <th>Tipo Pago</th>
	       <th>Cajero</th>
	       <th>Productos</th>
	       <th>Total</th>
		  </tr>';


echo '</tbody>
	</table></div>';
	echo '<div class="text-right"><a href="system/documentos/facturas_emitidas.php?inicio='.$inicio.'&fin='.$fin.'" >Descargar Excel</a></div>';

  } $a->close();
		

} // termina la funcion

public function ClienteProducto($orden, $tipo, $numeroFactura, $time) {
	$db = new dbConn();
$timemas = $time + 60;
if ($tipo == 1 || $tipo == 2 || $tipo == 12){
	if ($r = $db->select("cliente", "ticket_cliente", 
	"WHERE orden = '$orden' and td = ".$_SESSION['td']."")) { 
		$cliente = $r["cliente"];
	} unset($r);  

	if ($r = $db->select("nombre", "clientes", 
		"WHERE hash = '$cliente' and td = ".$_SESSION['td']."")) { 
	return $r["nombre"];
	} unset($r);  
}
 if ($tipo == 3 || $tipo == 13){
	if ($r = $db->select("cliente", "facturar_documento_factura", 
		"WHERE factura = '$numeroFactura' and tipo = ".$tipo." and td = ".$_SESSION['td']." and time BETWEEN ".$time." and ".$timemas."  order by id desc limit 1" )) { 
	return $r["cliente"];
		} unset($r);  
} 

}






public function TiposTicketActivos(){ // esta funcion obtiene los ticket activos para mostrarlos como oopciones
		$db = new dbConn();
// a =  ticket. b =  factura, e = Credito fiscal

if($_SESSION["tx"] == 0){

    if ($r = $db->select("ax0, bx0, dx0, ex0, fx0, gx0", "facturar_opciones", "WHERE td = ".$_SESSION["td"]."")) { 
        $ax = $r["ax0"]; $bx = $r["bx0"]; $dx = $r["dx0"]; $ex = $r["ex0"]; $fx = $r["fx0"]; $gx = $r["gx0"];
    } unset($r);  

} else {
    
    if ($r = $db->select("ax1, bx1, dx1, ex1, fx1, gx1", "facturar_opciones", "WHERE td = ".$_SESSION["td"]."")) { 
        $ax = $r["ax1"]; $bx = $r["bx1"]; $dx = $r["dx1"]; $ex = $r["ex1"]; $fx = $r["fx1"]; $gx = $r["gx1"];
    } unset($r);  
}


echo '<div class="custom-control custom-radio custom-control-inline">
	  <input type="radio" class="custom-control-input" id="0" name="tipo" value="0">
	  <label class="custom-control-label" for="0">Todos</label>
	</div>';

if($ax == 1){
echo '<div class="custom-control custom-radio custom-control-inline">
	  <input type="radio" class="custom-control-input" id="1" name="tipo" value="1">
	  <label class="custom-control-label" for="1">Ticket</label>
	</div>';
}
if($ex == 1){
echo '<div class="custom-control custom-radio custom-control-inline">
	  <input type="radio" class="custom-control-input" id="3" name="tipo" value="3">
	  <label class="custom-control-label" for="3">C. Fiscal</label>
	</div>';
}
if($gx == 1){
	echo '<div class="custom-control custom-radio custom-control-inline">
		  <input type="radio" class="custom-control-input" id="13" name="tipo" value="13">
		  <label class="custom-control-label" for="13">C. Fiscal 2</label>
		</div>';
	}
if($bx == 1){
echo '<div class="custom-control custom-radio custom-control-inline">
	  <input type="radio" class="custom-control-input" id="2" name="tipo" value="2">
	  <label class="custom-control-label" for="2">Factura</label>
	</div>';
}
if($fx == 1){
	echo '<div class="custom-control custom-radio custom-control-inline">
		  <input type="radio" class="custom-control-input" id="12" name="tipo" value="12">
		  <label class="custom-control-label" for="12">Factura 2</label>
		</div>';
	}
if($dx == 1){
echo '<div class="custom-control custom-radio custom-control-inline">
	  <input type="radio" class="custom-control-input" id="4" name="tipo" value="4">
	  <label class="custom-control-label" for="4">Exportación</label>
	</div>';
}


}// termina le funcion




public function CajeroVentas($user) {
		$db = new dbConn();

	if ($r = $db->select("nombre", "login_userdata", 
		"WHERE user = '$user' and td = ".$_SESSION['td']."")) { 
	return $r["nombre"];
	} unset($r);  

}

















} // fin de la clase

 ?>


 