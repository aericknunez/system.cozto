<?php 
class Corte{

	public function __construct() { 
     } 


public function Apertura($efectivo){
	$db = new dbConn();

	if($efectivo != NULL){
		$datos = array();
	    $datos["apertura"] = date("H:i:s");
	    $datos["aperturaF"] = Helpers::TimeId();
	    $datos["fecha"] = date("d-m-Y");
	    $datos["fecha_format"] = Fechas::Format(date("d-m-Y"));
	    $datos["caja_chica"] = $efectivo;
	    $datos["user"] = $_SESSION["user"];
	    $datos["edo"] = 1;
	    $hash = Helpers::HashId();
	    $datos["hash"] = $hash;
	    $datos["time"] = Helpers::TimeId();
	    $datos["td"] = $_SESSION["td"];
	    if ($db->insert("corte_diario", $datos)) {
	    	$_SESSION["caja_apertura"] = $hash;
	    	echo "realizado";
	    } else{
	    	Alerts::Alerta("error","Error!","Ocurrió un error inesperado!");
	    }
	} else {
		Alerts::Alerta("error","Error!","Introduzca la cantidad de apertura de caja!");
	}

$pro = new ProductoOtros();
$pro->EmparejaExistencias();

}


public function Cierre($efectivo){
	$db = new dbConn();


  if($efectivo != NULL){ 
		
		$datos = array();
	    $datos["cierre"] = date("H:i:s");
	    $datos["cierreF"] = Helpers::TimeId();
        $datos["productos"] = $this->Productos();
        $datos["clientes"] = $this->Clientes();
        $datos["efectivo_ingresado"] = $efectivo;
        $datos["tx"] = $this->Tx;
        $datos["no_tx"] = $this->NoTx();
        $datos["total"] = $this->Total();
        $datos["t_efectivo"] = $this->TotalTipo(1);
        $datos["t_tarjeta"] = $this->TotalTipo(2);
        $datos["t_credito"] = $this->TotalTipo(3);
        $datos["gastos"] = $this->Gastos();
        $datos["abonos"] = $this->Abonos();
        $datos["diferencia"] = $this->Diferencia($efectivo);
        $datos["edo"] = 2;
      if (Helpers::UpdateId("corte_diario", $datos, "hash = '".$_SESSION["caja_apertura"]."' and user = '".$_SESSION["user"]."' and td = ".$_SESSION["td"]."")) {

      		unset($_SESSION["caja_apertura"]);
          
          Alerts::Alerta("success","Realizado!","Corte Realizado correctamente!");
      } else {
      	Alerts::Alerta("error","Error!","Algo Ocurrió!");
      }          

$pro = new ProductoOtros();
$pro->EmparejaExistencias();

  } else {
    Alerts::Alerta("error","Error!","Faltan Datos!");
  }

}




 	public function ComprobarApertura(){
		$db = new dbConn();

		$a = $db->query("SELECT * FROM corte_diario WHERE edo = 1 and user = '".$_SESSION["user"]."' and td = ".$_SESSION["td"]."");
		$cant = $a->num_rows;
		$a->close();

		if($cant > 0){
			return TRUE;
		} else {
			return FALSE;
		}

	}


	public function CajaChica(){ // obtiene la caja chica de la apertura
		$db = new dbConn();
	    if ($r = $db->select("caja_chica", "corte_diario", "WHERE hash = '".$_SESSION["caja_apertura"]."' and user = '".$_SESSION["user"]."' and td = ".$_SESSION["td"]."")) {  return $r["caja_chica"];
	    } unset($r); 
	}


	public function ObtenerHash(){ // obtiene la variable de seesion para indicar la apertura
		$db = new dbConn();
	    if ($r = $db->select("hash", "corte_diario", "WHERE edo = 1 and user = '".$_SESSION["user"]."' and td = ".$_SESSION["td"]."")) {  return $r["hash"];
	    } unset($r); 
	}


	public function GetInicio(){ // obtiene el tiempo de inicio de la aparteura
		$db = new dbConn();
	    if ($r = $db->select("aperturaF", "corte_diario", "WHERE user = '".$_SESSION["user"]."' and hash = '".$_SESSION["caja_apertura"]."' and td = ".$_SESSION["td"]."")) { 
	        $aperturaF = $r["aperturaF"];
	    } 
	    unset($r); 
		return $aperturaF;
	}


	public function Productos(){
		$db = new dbConn();
	    $a = $db->query("SELECT sum(cant) FROM ticket WHERE cajero = '".$_SESSION["user"]."' and edo = 1 and td = ".$_SESSION["td"]." and time BETWEEN '".$this->GetInicio()."' and '".Helpers::TimeId()."'");
		    foreach ($a as $b) {
		     return $b["sum(cant)"];
		    } $a->close();
	}



	public function Clientes(){
		$db = new dbConn();
		$a = $db->query("SELECT * FROM ticket_orden WHERE cajero = '".$_SESSION["user"]."' and td = ".$_SESSION["td"]." and time BETWEEN '".$this->GetInicio()."' and '".Helpers::TimeId()."'");
		return $a->num_rows;
		$a->close();

	}


	public function Tx(){
		$db = new dbConn();
	    $a = $db->query("SELECT sum(total) FROM ticket WHERE cajero = '".$_SESSION["user"]."' and edo = 1 and td = ".$_SESSION["td"]." and time BETWEEN '".$this->GetInicio()."' and '".Helpers::TimeId()."' and tx = 1");
		    foreach ($a as $b) {
		     $total=$b["sum(total)"];
		    } $a->close();
		    return $total;
	}



	public function NoTx(){
		$db = new dbConn();
	    $a = $db->query("SELECT sum(total) FROM ticket WHERE cajero = '".$_SESSION["user"]."' and edo = 1 and td = ".$_SESSION["td"]." and time BETWEEN '".$this->GetInicio()."' and '".Helpers::TimeId()."' and tx = 0");
		    foreach ($a as $b) {
		     $total=$b["sum(total)"];
		    } $a->close();
		    return $total;
	}



	public function Total(){
		$db = new dbConn();
	    $a = $db->query("SELECT sum(total) FROM ticket WHERE cajero = '".$_SESSION["user"]."' and edo = 1 and td = ".$_SESSION["td"]." and time BETWEEN '".$this->GetInicio()."' and '".Helpers::TimeId()."'");
		    foreach ($a as $b) {
		     return $b["sum(total)"];
		    } $a->close();
	}



	public function TotalTipo($tipo){
		$db = new dbConn();
	    $a = $db->query("SELECT sum(total) FROM ticket 
	    	WHERE cajero = '".$_SESSION["user"]."' and edo = 1 and td = ".$_SESSION["td"]." and tipo_pago = '$tipo' and time BETWEEN '".$this->GetInicio()."' and '".Helpers::TimeId()."'");
		    foreach ($a as $b) {
		     return $b["sum(total)"];
		    } $a->close();
	}



	public function Gastos(){
		$db = new dbConn();
	    $a = $db->query("SELECT sum(cantidad) FROM gastos WHERE user = '".$_SESSION["user"]."' and edo != 0 and tipo_pago = 1 and td = ".$_SESSION["td"]." and time BETWEEN '".$this->GetInicio()."' and '".Helpers::TimeId()."'");
		    foreach ($a as $b) {
		     $total=$b["sum(cantidad)"];
		    } $a->close();
		    return $total;
	}


	public function Abonos(){
		$db = new dbConn();
	       $a = $db->query("SELECT sum(abono) FROM creditos_abonos WHERE user = '".$_SESSION["user"]."' and td = ".$_SESSION["td"]." and edo = 1 and time BETWEEN '".$this->GetInicio()."' and '".Helpers::TimeId()."'");
		    foreach ($a as $b) {
		        $abono=$b["sum(abono)"];
		    } $a->close();
		    return  $abono;

	}


	public function EntradasEfectivo(){
		$db = new dbConn();
	        $a = $db->query("SELECT sum(cantidad) FROM entradas_efectivo WHERE user = '".$_SESSION["user"]."' and  edo = 1 and td = ".$_SESSION["td"]." and time BETWEEN '".$this->GetInicio()."' and '".Helpers::TimeId()."'");
		    foreach ($a as $b) {
		        $efectivo=$b["sum(cantidad)"];
		    } $a->close();
		    return  $efectivo;

	}



	public function Diferencia($efectivo){
		/// conversiones para el dinero
		$total_cc = $this->TotalTipo(1)+$this->CajaChica()+$this->Abonos()+$this->EntradasEfectivo(); //total ventas  mas caja chica de ayer
		$total_debido = $total_cc-$this->Gastos(); //dinero que deberia haber ()
		$diferencia = $efectivo - $total_debido;
		return $diferencia;
	}








public function CancelarCorte($ramdom){
	$db = new dbConn();

$numero = sha1(Fechas::Format(date("d-m-Y")));
$num = substr($numero, 0, 6);

if($ramdom == $num){

// obtengo el hash del eliminado
    if ($r = $db->select("hash", "corte_diario", "WHERE edo = 2 and user = '".$_SESSION["user"]."' and td = ".$_SESSION["td"]." order by time desc limit 1")) {  $hash = $r["hash"];
    } unset($r); 

		$cambio = array();
	    $cambio["edo"] = "3";
	if (Helpers::UpdateId("corte_diario", $cambio, "hash = '$hash' and td = " . $_SESSION["td"])) {



// obtengo los datos necesarios de ese corte para generar uno nuevo
    if ($r = $db->select("apertura, aperturaF, fecha, fecha_format, caja_chica", "corte_diario", "WHERE hash = '$hash' and user = '".$_SESSION["user"]."' and td = ".$_SESSION["td"]."")) {  
    	$apertura = $r["apertura"];
    	$aperturaF = $r["aperturaF"];
    	$fecha = $r["fecha"];
    	$fecha_format = $r["fecha_format"];
    	$caja_chica = $r["caja_chica"];

    } unset($r); 

		$datos = array();
	    $datos["apertura"] = $apertura;
	    $datos["aperturaF"] = $aperturaF;
	    $datos["fecha"] = $fecha;
	    $datos["fecha_format"] = $fecha_format;
	    $datos["caja_chica"] = $caja_chica;
	    $datos["user"] = $_SESSION["user"];
	    $datos["edo"] = 1;
	    $hash = Helpers::HashId();
	    $datos["hash"] = $hash;
	    $datos["time"] = Helpers::TimeId();
	    $datos["td"] = $_SESSION["td"];
	    if ($db->insert("corte_diario", $datos)) {
	    	$_SESSION["caja_apertura"] = $hash;
	    	Alerts::Alerta("success","Exito!","Corte Anulado Correctamente");
	    }
	} else {
	Alerts::Alerta("error","Error!","Codigo Invalido!!");
	}
}

}







////////////////////////////////// contenido //////////////////////////
	public function Contenido(){
		if($_SESSION["caja_apertura"] == NULL){
				$this->Content($fecha);
			} else {
				$this->Form();
			}
	}
	

	public function ObtieneInfo($campo){ // obtiene la caja chica de la apertura
		$db = new dbConn();
	    if ($r = $db->select($campo, "corte_diario", "WHERE user = '".$_SESSION["user"]."' and td = ".$_SESSION["td"]." and edo = 2 order by time desc limit 1")) {  return $r[$campo];
	    } unset($r); 
	}


	public function Content($fecha){
		//$sync = new Sync;
		$db = new dbConn();

		 echo '<div class="row">

	<div class="col-xl-3 col-md-6 mb-4  col-sm-6 col-6">
      <div class="card-counter light">
        <i class="fas fa-barcode"></i>
        <span class="count-numbers"><h5 class="font-weight-bold">' . Helpers::Dinero($this->ObtieneInfo("efectivo_ingresado")) . '</h5></span>
        <span class="count-name">Efectivo</span>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4  col-sm-6 col-6">
      <div class="card-counter light">
        <i class="fas fa-home"></i>
        <span class="count-numbers"><h5 class="font-weight-bold">' . Helpers::Dinero($this->ObtieneInfo("total")) . '</h5></span>
        <span class="count-name">Total de Venta</span>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4  col-sm-6 col-6">
      <div class="card-counter light">
        <i class="fas fa-dollar-sign"></i>
        <span class="count-numbers"><h5 class="font-weight-bold">' . Helpers::Dinero($this->ObtieneInfo("diferencia")) . '</h5></span>
        <span class="count-name">Diferencia</span>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4  col-sm-6 col-6">
      <div class="card-counter light">
        <i class="fa fa-users"></i>
        <span class="count-numbers"><h5 class="font-weight-bold">' . Helpers::Dinero($this->ObtieneInfo("gastos")) . '</h5></span>
        <span class="count-name">Gastos</span>
      </div>
    </div>


  </div>


			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalConfirmDelete">Eliminar Corte</button>';


			echo '<a id="imprimir_corte" hash="'. $this->ObtieneInfo("hash") .'" class="btn-floating cyan" title="Imprimir Corte" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-print"></i></a>';


			echo '<div id="msjimprimir"></div>';
		
	}

	public function Form(){
		Alerts::Mensajex("Aun no se ha realizado el corte. <br />Ingrese la cantidad de efectivo para poder continuar",'danger',$boton,$boton2);
	echo '<form id="form-corte" name="form-corte">
		 
		 <div class="form-group row justify-content-center align-items-center">
		  <div class="col-xs-2">
		    <label for="ex1">Efectivo</label>
		    <input name="efectivo" type="number" id="efectivo" size="8" maxlength="8" class="form-control" placeholder="0.00" step="any" required autofocus />
		  </div>
		</div>
		<input type="image" src="assets/img/imagenes/print.png"  id="btn-corte" name="btn-corte" >
		</form>';
				
	}




} // fin de la clase

 ?>