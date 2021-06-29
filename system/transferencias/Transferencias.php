<?php 
class Transferencias{

    public function __construct() { 
    } 


// agregar productos con marcas diferentes, anos diferentes, 

public function ObtenerData($url){
	$db = new dbConn();

    $response = array();

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $response = curl_exec($ch);

    curl_close($ch);

    return $response;
}



public function OrdenesPendientes($url){
  $jsondata = $this->ObtenerData($url);

  $datos = json_decode($jsondata, true); 

if($datos["mensaje"] != "No se encontraron datos"){
  $this->Ordenes($datos);
} else {
	Alerts::Mensajex("No se encontraron ordenes pendientes de aceptar", "info");
}
  // print_r($jsondata);
}





public function Ordenes($data){

foreach ($data["ordenes"] as $key => $orden) {

echo '<div>

<div class="clearfix">
  <h2 class="h2-responsive float-left">'.$data["ordenes"][$key]["fecha"].' | '.$data["ordenes"][$key]["hora"].' | '.$data["ordenes"][$key]["nombre_o"].'</h2> 
  <h2 class="h2-responsive float-right"></h2>
</div>


<div class="table-responsive">
<table class="table table-striped table-sm">
<thead>

<tr>
     <th>Codigo</th>
     <th>Producto</th>
     <th>Cantidad</th>
     <th>Estado</th>
</tr>

</thead>

<tbody>';

$btn = $this->Productos($data["ordenes"][$key]["productos"]);

echo '</tbody>
</table>
</div>
</div>

<div class="clearfix">
  <h2 class="h2-responsive float-left"><a id="cancelar_orden" hash="'.$data["ordenes"][$key]["hash"].'" class="btn btn-danger  btn-sm mb-3">CANCELAR ORDEN</i></a></h2> 
  <h2 class="h2-responsive float-right">';
  if($btn == TRUE){
  	echo '<a id="order_acept" hash="'.$data["ordenes"][$key]["hash"].'" class="btn btn-info  btn-sm mb-3">ACEPTAR ORDEN</i></a>';
  } else {
  	echo '<a class="btn btn-grey  btn-sm mb-3 disabled">ACEPTAR ORDEN</i></a>';
  }
  echo '</h2>
  </div>';

if($btn != TRUE){
	Alerts::Mensajex("Esta orden contine productos con códigos no coincidentes en su inventario. agregue el registro antes de aceptar la orden", "danger");
}  

echo '<hr class="z-depth-1-half">';
}



}


public function Productos($data){
	$db = new dbConn();

	$conteo = count($data); // cuenta cuantos productos hay
	$conte = 0; //conteo de productos validos
	foreach ($data as $key => $producto) {

	$a = $db->query("SELECT cantidad FROM producto WHERE cod = '".$producto["cod"]."' and td = " . $_SESSION["td"]);
	$cantix = $a->num_rows;
	$a->close();	

	if($cantix > 0){
		$msj = "Existente";
		$conte ++;
	} else {
		$msj = "No existe"; 
	}

	echo '<tr>
	     <th scope="row">'.$producto["cod"].'</th>
	     <td>'.$producto["producto"].'</td>
	     <td>'.$producto["cantidad"].'</td>
	     <td>'.$msj.'</td>
	   	</tr>';
	unset($msj);
	}

if ($conte == $conteo) {
	return TRUE;
} else {
	return FALSE;
}

}






public function AceptarOrden($url, $hash){
	$db = new dbConn();

    $ch = curl_init($url);
     
    curl_setopt ($ch, CURLOPT_POST, 1);
    //le decimos qué paramáetros enviamos (pares nombre/valor, también acepta un array)
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);
    //le decimos que queremos recoger una respuesta (si no esperas respuesta, ponlo a false)
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    //recogemos la respuesta
    $respuesta = curl_exec($ch);
    $error = curl_error($ch);
    curl_close ($ch);

    $res = json_decode($respuesta, true);

  if($res["mensaje"] == "Realizado"){

  	$productosx = $this->ObtenerData('http://localhost/coztoapi/?op=18&hash=' . $hash);
  	$productos = json_decode($productosx, true);

	$agrega = new ProUpdate;
  	foreach ($productos as $key => $producto) {
  		// echo $producto["cod"] . "  ||  " . $producto["cantidad"] . "<br>";

		if ($r = $db->select("hash", "ubicacion", "WHERE predeterminada = '1' and td = ".$_SESSION["td"]."")) { 
		$ubic = $r["hash"];
		} unset($r);

		if ($r = $db->select("precio_costo", "producto_ingresado", "WHERE producto = '".$producto["cod"]."' and td = ".$_SESSION["td"]." order by id desc limit 1")) { 
		$costo = $r["precio_costo"];
		} unset($r);


  		$xdato = array();
  		$xdato["cod"] = $producto["cod"];
  		$xdato["descripcion"] = Helpers::GetData("producto", "descripcion", "cod", $producto["cod"]);
  		$xdato["precio"] = $costo;
  		$xdato["cantidad"] = $producto["cantidad"];
  		$xdato["ubicacion"] = $ubic;
  		$xdato["comentarios"] = "Agregado desde tranferencias";

  		$agrega->ProAgrega($xdato, TRUE); // aqui deberia ir todo para agregarlo
  	}

  	// cod, descripcion, precio = costo, cantidad, ubicacion, cometarios
  }

$this->OrdenesPendientes(URL_TRANSFERENCIA . '?op=10&iden=' . $_SESSION["td"]);
 
}












public function RechazarOrden($url, $hash){

    $ch = curl_init($url);
     
    curl_setopt ($ch, CURLOPT_POST, 1);
    //le decimos qué paramáetros enviamos (pares nombre/valor, también acepta un array)
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);
    //le decimos que queremos recoger una respuesta (si no esperas respuesta, ponlo a false)
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    //recogemos la respuesta
    $respuesta = curl_exec($ch);
    $error = curl_error($ch);
    curl_close ($ch);

    $res = json_decode($respuesta, true);

  if($res["mensaje"] == "Orden Rechazada"){
  	// print_r($productos);
  }

// echo $respuesta;
 
}







public function CuentasVinculadas($url){
  $jsondata = $this->ObtenerData($url);

  $datos = json_decode($jsondata, true); 

if($datos["mensaje"] != "No se encontraron datos"){
  foreach ($datos as $key => $destino) {
  	echo '<a id="select_destino" destino="'.$destino["destino"] .'" class="btn btn-info btn-rounded">'.$destino["destino"] .'</a>';
  }
} else {
	Alerts::Mensajex("No se encontraron ordenes pendientes de aceptar", "info");
}
  // print_r($jsondata);
}






public function CreaVariables($destino){

	$fecha = date("d-m-Y");
	$orden = Helpers::HashId();
	$_SESSION["ordenes"] = array();
	$_SESSION["ordenes"]["ordenes"]["hash"] = $orden;
	$_SESSION["ordenes"]["ordenes"]["usuario_o"] = $_SESSION["user"];
	$_SESSION["ordenes"]["ordenes"]["nombre_o"] = $_SESSION["nombre"];
	$_SESSION["ordenes"]["ordenes"]["origen"] = $_SESSION["td"];
	$_SESSION["ordenes"]["ordenes"]["destino"] = $destino;
	$_SESSION["ordenes"]["ordenes"]["usuario_d"] = NULL;
	$_SESSION["ordenes"]["ordenes"]["nombre_d"] = NULL;
	$_SESSION["ordenes"]["ordenes"]["fecha"] = $fecha;
	$_SESSION["ordenes"]["ordenes"]["hora"] = date("H:i:s");
	$_SESSION["ordenes"]["ordenes"]["fechaF"] = Fechas::Format($fecha);
	$_SESSION["ordenes"]["ordenes"]["edo"] = 1;
	

// print_r($_SESSION["ordenes"]);

}



public function DestruyeVariables(){
 unset($_SESSION["ordenes"]);
}




public function SelectProduct($key){
	$db = new dbConn();

	$producto = Helpers::GetData("producto", "descripcion", "cod", $key);

	echo '<div class="h2-responsive mb-3">'.$producto.'</div>';

	echo '<input type="hidden" id="cod" name="cod" value="'.$key.'">';
	echo '<input type="hidden" id="producto" name="producto" value="'.$producto.'">';

}




public function AgregaProducto($data){
	$db = new dbConn();

	

	if($_SESSION["ordenes"]["ordenes"]["contador"] == NULL){
		$_SESSION["ordenes"]["ordenes"]["contador"] = 1;
		$_SESSION["ordenes"]["ordenes"]["productos"] = array();
	} else {
		$_SESSION["ordenes"]["ordenes"]["contador"] = $_SESSION["ordenes"]["ordenes"]["contador"] + 1;
	}
	$contador = $_SESSION["ordenes"]["ordenes"]["contador"] - 1;


	$_SESSION["ordenes"]["ordenes"]["productos"][$contador]["orden"] = $_SESSION["ordenes"]["ordenes"]["hash"];
	$_SESSION["ordenes"]["ordenes"]["productos"][$contador]["cod"] = $data["cod"];
	$_SESSION["ordenes"]["ordenes"]["productos"][$contador]["producto"] = $data["producto"];
	$_SESSION["ordenes"]["ordenes"]["productos"][$contador]["cantidad"] = $data["cantidad"];
	$_SESSION["ordenes"]["ordenes"]["productos"][$contador]["comentario_o"] = NULL;
	$_SESSION["ordenes"]["ordenes"]["productos"][$contador]["comentario_d"] = NULL;
	$_SESSION["ordenes"]["ordenes"]["productos"][$contador]["edo"] = 1;


	$json = json_encode($_SESSION["ordenes"]);
	// print_r($json);

	echo '<div class="table-responsive">
	<table class="table table-striped table-sm">
	<thead>
	<tr>
	     <th>Codigo</th>
	     <th>Producto</th>
	     <th>Cantidad</th>
	</tr>
	</thead>
	<tbody>';
	
	foreach ($_SESSION["ordenes"]["ordenes"]["productos"] as $key => $producto) {

	echo '<tr>
	     <th scope="row">'.$producto["cod"].'</th>
	     <td>'.$producto["producto"].'</td>
	     <td>'.$producto["cantidad"].'</td>
	   	</tr>';

	}
	echo '</tbody>
	</table>
	</div>';

if (count($_SESSION["ordenes"]["ordenes"]["productos"]) > 0) {
	echo '<div class="clearfix">
  			<h2 class="h2-responsive float-left"><a id="enviar_orden" class="btn btn-indigo  btn-sm mb-3">ENVIAR ORDEN</i></a></h2> 
  		 </div>';
}

}







public function EnviarOrden($url){

	$data = json_encode($_SESSION["ordenes"]);
    $ch = curl_init($url);
     
    curl_setopt ($ch, CURLOPT_POST, 1);
    //le decimos qué paramáetros enviamos (pares nombre/valor, también acepta un array)
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);
    //le decimos que queremos recoger una respuesta (si no esperas respuesta, ponlo a false)
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    //recogemos la respuesta
    $respuesta = curl_exec($ch);
    $error = curl_error($ch);
    curl_close ($ch);

    $respuesta = json_decode($respuesta, true);//

    // print_r($respuesta);
    if ($respuesta["mensaje"] == "Registro Realizado") {
    	echo "Se realizo el registro con todo";
    }
}








public function OrdenesEnviadas($url){
  $jsondata = $this->ObtenerData($url);

  $datos = json_decode($jsondata, true); 

if($datos["mensaje"] != "No se encontraron datos"){
  $this->OrdenesE($datos);
} else {
	Alerts::Mensajex("No se encontraron ordenes pendientes de aceptar", "info");
}
  // print_r($jsondata);
}



public function OrdenesE($data){

foreach ($data["ordenes"] as $key => $orden) {


switch ($data["ordenes"][$key]["edo"]) {
	case '1':
		$edo = "Pendiente";
	break;
	case '2':
		$edo = "Aceptado";
	break;
	case '3':
		$edo = "Rechazado";
	break;
	
}

echo '<div>

<div class="clearfix">
  <h2 class="h2-responsive float-left">'.$data["ordenes"][$key]["fecha"].' | '.$data["ordenes"][$key]["hora"].' | '.$data["ordenes"][$key]["nombre_o"].'</h2> 
  <h2 class="h2-responsive float-right"><a class="bnt btn-indigo btn-sm btn-rounded text-white">'.$edo.'</a></h2>
</div>


<div class="table-responsive">
<table class="table table-striped table-sm">
<thead>

<tr>
     <th>Codigo</th>
     <th>Producto</th>
     <th>Cantidad</th>
</tr>

</thead>

<tbody>';

$btn = $this->ProductosE($data["ordenes"][$key]["productos"]);

echo '</tbody>
</table>
</div>
</div>


<hr class="z-depth-1-half">';
}



}





public function ProductosE($data){
	$db = new dbConn();

	$conteo = count($data); // cuenta cuantos productos hay
	$conte = 0; //conteo de productos validos
	foreach ($data as $key => $producto) {

	echo '<tr>
	     <th scope="row">'.$producto["cod"].'</th>
	     <td>'.$producto["producto"].'</td>
	     <td>'.$producto["cantidad"].'</td>
	   	</tr>';
	unset($msj);
	}


}


















} // Termina la clase
?>