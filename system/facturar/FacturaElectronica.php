<?php 
class FacturaElectronica{




public function DTE(){
		$db = new dbConn();

if ($r = $db->select("*", "ticket_num", "WHERE orden = '".$_SESSION["orden_print"]."' and tx = ".$_SESSION["tx"]." and td = " .  $_SESSION["td"])) { 
    $orden_codigo_generacion = $r["codigo_generacion"];
    $orden_fecha = $r["fecha"];
    $orden_hora = $r["hora"];
    $orden_num_fac = $r["num_fac"];
} unset($r);  

if ($r = $db->select("*", "factura_electronica", "WHERE td = " .  $_SESSION["td"])) { 
    $cliente_nit = $r["nit"];
    $cliente_password = $r["password"];
    $cliente_id_sistema = $r["id_sistema"];
    $cliente_ambiente = $r["ambiente"];
} unset($r);  

$productos = array();
$x = $db->query("SELECT * FROM ticket WHERE num_fac = '".$orden_num_fac."' and orden = '".$_SESSION["orden_print"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
$item = 0;
foreach ($x as $z) {

	$productos[$item]['numeroDocumento'] = null;
	$productos[$item]['numItem'] = $item + 1; // correlativo
	$productos[$item]['tipoItem'] = 1; // 1 Bienes, 2 Servicios
	$productos[$item]['cantidad'] = floatval($z['cant']);
	$productos[$item]['codigo'] = $z['cod'];
	$productos[$item]['codTributo'] = null;
	$productos[$item]['uniMedida'] = 59;
	$productos[$item]['descripcion'] = $z['producto'];
	$productos[$item]['precioUni'] = floatval($z['pv']);
	$productos[$item]['montoDescu'] = floatval($z['descuento']);
	$productos[$item]['ventaNoSuj'] = floatval(0);
	$productos[$item]['ventaExenta'] = floatval(0);
	$productos[$item]['ventaGravada'] = floatval($z['total']);
	$productos[$item]['noGravado'] = floatval(0);
	$productos[$item]['psv'] = floatval(0);

	if($_SESSION["tipoticket"] == 3){
     $productos[$item]['tributos'][] = "20";
	}
	if($_SESSION["tipoticket"] == 1){
		$productos[$item]['tributos'] = null;
		$productos[$item]['ivaItem'] = floatval($z['imp']);
	}
	$item = $item + 1;
} $x->close();

$datos = array();
$datos['nit'] = $cliente_nit;
$datos['activo'] = true;
$datos['passwordPri'] = $cliente_password;
$datos['id_sistema'] = $cliente_id_sistema;
$datos['idEnvio'] = $orden_num_fac; // numero de orden (string)

$datos['dteJson']['identificacion']['version'] = 3;
$datos['dteJson']['identificacion']['ambiente'] = $cliente_ambiente;
$datos['dteJson']['identificacion']['tipoDte'] = "03";
$datos['dteJson']['identificacion']['numeroControl'] = "DTE-03-00000000-" . Helpers::NFactura($orden_num_fac, 15);
$datos['dteJson']['identificacion']['codigoGeneracion'] = $orden_codigo_generacion; // codigo de cada ticket_num
$datos['dteJson']['identificacion']['tipoDte'] = "03";
$datos['dteJson']['identificacion']['tipoModelo'] = 1;
$datos['dteJson']['identificacion']['tipoOperacion'] = 1;
$datos['dteJson']['identificacion']['tipoContingencia'] = null;
$datos['dteJson']['identificacion']['motivoContin'] = null;
$datos['dteJson']['identificacion']['fecEmi'] = date("Y-m-d");
$datos['dteJson']['identificacion']['horEmi'] = date("H:i:s");
$datos['dteJson']['identificacion']['tipoMoneda'] = "USD";

$datos['dteJson']['documentoRelacionado'] = null;
$datos['dteJson']['emisor'] = null;

$datos['dteJson']['receptor']['nit'] = "05110402951018";
$datos['dteJson']['receptor']['nrc'] = "830860";
$datos['dteJson']['receptor']['nombre'] = "BANCO PROMERICA, S.A.";
$datos['dteJson']['receptor']['codActividad'] = "64190";
$datos['dteJson']['receptor']['descActividad'] = "BANCOS";
$datos['dteJson']['receptor']['nombreComercial'] = "BANCO PROMERICA, S.A.";
$datos['dteJson']['receptor']['direccion']['departamento'] = "05";
$datos['dteJson']['receptor']['direccion']['municipio'] = "01";
$datos['dteJson']['receptor']['direccion']['complemento'] = "Edificio Promerica,La Gran Via";
$datos['dteJson']['receptor']['telefono'] = "60623821";
$datos['dteJson']['receptor']['correo'] = "juanperez@gmail.com";

$datos['dteJson']['otrosDocumentos'] = null;
$datos['dteJson']['ventaTercero'] = null;

$datos['dteJson']['cuerpoDocumento'] = $productos;

if ($sx = $db->select("sum(stotal), sum(imp), sum(retencion), sum(total)", "ticket", 
"WHERE num_fac = '".$orden_num_fac."' 
and orden = '".$_SESSION["orden_print"]."' 
and tx = ".$_SESSION["tx"]." 
and td = ".$_SESSION["td"]." 
")) { 
	$stotal = $sx["sum(stotal)"];
	$imp = $sx["sum(imp)"];
	$totalRetencion = $sx["sum(retencion)"];
	$total = $sx["sum(total)"];
 } unset($sx); 

 $datos['dteJson']['resumen']['totalNoSuj'] = floatval(0);
 $datos['dteJson']['resumen']['totalExenta'] = floatval(0);
 $datos['dteJson']['resumen']['totalGravada'] = floatval($stotal);
 $datos['dteJson']['resumen']['subTotalVentas'] = floatval($stotal);
 $datos['dteJson']['resumen']['descuNoSuj'] = floatval(0);
 $datos['dteJson']['resumen']['descuExenta'] = floatval(0);
 $datos['dteJson']['resumen']['descuGravada'] = floatval(0);
 $datos['dteJson']['resumen']['porcentajeDescuento'] = floatval(0);
 $datos['dteJson']['resumen']['totalDescu'] = floatval(0);
 $datos['dteJson']['resumen']['tributos'][0]['codigo'] = "20";
 $datos['dteJson']['resumen']['tributos'][0]['descripcion'] = "IMPUESTO AL VALOR AGREGADO 13%";
 $datos['dteJson']['resumen']['tributos'][0]['valor'] = floatval($imp);
 $datos['dteJson']['resumen']['subTotal'] = floatval($stotal);
 $datos['dteJson']['resumen']['ivaPerci1'] = null;
 $datos['dteJson']['resumen']['ivaRete1'] = null;
 $datos['dteJson']['resumen']['reteRenta'] = null;
 $datos['dteJson']['resumen']['montoTotalOperacion'] = floatval($total);
 $datos['dteJson']['resumen']['totalNoGravado'] = null;
 $datos['dteJson']['resumen']['totalPagar'] = floatval($total);
 $datos['dteJson']['resumen']['totalLetras'] = Dinero::DineroEscrito(floatval($total));
 $datos['dteJson']['resumen']['saldoFavor'] = floatval(0);
 $datos['dteJson']['resumen']['condicionOperacion'] = 1;

 $datos['dteJson']['resumen']['pagos']['codigo'] = "01";
 $datos['dteJson']['resumen']['pagos']['montoPago'] = floatval($total);
 $datos['dteJson']['resumen']['pagos']['referencia'] = null;
 $datos['dteJson']['resumen']['pagos']['plazo'] = null;
 $datos['dteJson']['resumen']['pagos']['periodo'] = null;
 $datos['dteJson']['resumen']['numPagoElectronico'] = null;


  if($_SESSION["tipoticket"] == 3){
	$datos['dteJson']['resumen']['tributos'][0]['codigo'] = "20";
	$datos['dteJson']['resumen']['tributos'][0]['descripcion'] = "IMPUESTO AL VALOR AGREGADO 13%";
	$datos['dteJson']['resumen']['tributos'][0]['valor'] = floatval($imp);
   }
   if($_SESSION["tipoticket"] == 2){
	$datos['dteJson']['resumen']['tributos'] = [];
	$datos['dteJson']['resumen']['totalIva'] =  floatval($imp);
   }
   
$datos['dteJson']['extension']['nombEntrega'] = null;
$datos['dteJson']['extension']['docuEntrega'] = null;
$datos['dteJson']['extension']['nombRecibe'] = null;
$datos['dteJson']['extension']['observaciones'] = null;
$datos['dteJson']['extension']['placaVehiculo'] = null;

$datos['dteJson']['apendice'] = null;


echo json_encode($datos);
		

}// termina le funcion









} // fin de la clase

 ?>


 