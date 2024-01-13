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
	$productos[$item]['montoDescu'] = floatval($z['descuento']);
	$productos[$item]['ventaNoSuj'] = floatval(0);
	$productos[$item]['ventaExenta'] = floatval(0);
	$productos[$item]['noGravado'] = floatval(0);
	$productos[$item]['psv'] = floatval(0);

	if($_SESSION["tipoticket"] == 3){
     $productos[$item]['tributos'][] = "20";
	 $productos[$item]['ventaGravada'] = floatval(($z['total'] - $z['imp']));
	 $productos[$item]['precioUni'] = floatval(($z['total'] - $z['imp']) / $z['cant']);
	}
	if($_SESSION["tipoticket"] == 2){
		$productos[$item]['tributos'] = null;
		$productos[$item]['ivaItem'] = floatval($z['imp']);
		$productos[$item]['ventaGravada'] = floatval($z['total']);
		$productos[$item]['precioUni'] = floatval($z['pv']);
	}
	$item = $item + 1;
} $x->close();

$datos = array();
$datos['nit'] = $cliente_nit;
$datos['activo'] = true;
$datos['passwordPri'] = $cliente_password;
$datos['id_sistema'] = $cliente_id_sistema;
$datos['idEnvio'] = $orden_num_fac; // numero de orden (string)

   if($_SESSION["tipoticket"] == 3){
	$version = 3;
	$tipoDte = "03";
   }
   if($_SESSION["tipoticket"] == 2){
	$version = 1;
	$tipoDte = "01";
   }

$datos['dteJson']['identificacion']['version'] = $version;
$datos['dteJson']['identificacion']['ambiente'] = $cliente_ambiente;
$datos['dteJson']['identificacion']['tipoDte'] = $tipoDte;
$datos['dteJson']['identificacion']['numeroControl'] = "DTE-".$tipoDte."-00000000-" . str_pad($orden_num_fac, 15, "0", STR_PAD_LEFT);
$datos['dteJson']['identificacion']['codigoGeneracion'] = $orden_codigo_generacion; // codigo de cada ticket_num
$datos['dteJson']['identificacion']['tipoDte'] = $tipoDte;
$datos['dteJson']['identificacion']['tipoModelo'] = 1;
$datos['dteJson']['identificacion']['tipoOperacion'] = 1;
$datos['dteJson']['identificacion']['tipoContingencia'] = null;
$datos['dteJson']['identificacion']['motivoContin'] = null;
$datos['dteJson']['identificacion']['fecEmi'] = date("Y-m-d");
$datos['dteJson']['identificacion']['horEmi'] = date("H:i:s");
$datos['dteJson']['identificacion']['tipoMoneda'] = "USD";

$datos['dteJson']['documentoRelacionado'] = null;
$datos['dteJson']['emisor'] = null;


///  formateando cliente
if($_SESSION["tipoticket"] == 3){

	if ($r = $db->select("documento", "facturar_documento_factura", "WHERE factura = '".$orden_num_fac."' and tx = " . $_SESSION["tx"] . " and td = " .  $_SESSION["td"]." order by id desc limit 1")) { 
        $documento = $r["documento"];
    } unset($r); 

	if($_SESSION["root_taller"] == "on") { 
        if ($r = $db->select("*", "taller_cliente", "WHERE nit = '$documento' and td = " .  $_SESSION["td"])) { 
			$cliente = $r; 
			$document = $r['nit']; 
		} unset($r);  
    } else {
        if ($r = $db->select("*", "facturar_documento", "WHERE documento = '$documento' and td = " .  $_SESSION["td"])) { 
			$cliente = $r; 
			$document = $r['documento']; 
		} unset($r);  
    }

	$datos['dteJson']['receptor']['nit'] = Helpers::FormatNIT($document);
	$datos['dteJson']['receptor']['nrc'] =  Helpers::FormatNIT($cliente['registro']);
	$datos['dteJson']['receptor']['nombre'] = $cliente['cliente'];
	$datos['dteJson']['receptor']['codActividad'] = "10005";
	// $datos['dteJson']['receptor']['codActividad'] = "64190";
	$datos['dteJson']['receptor']['descActividad'] = $cliente['giro'];
	// $datos['dteJson']['receptor']['descActividad'] = "BANCOS";
	$datos['dteJson']['receptor']['nombreComercial'] = $cliente['cliente'];
	$datos['dteJson']['receptor']['direccion']['departamento'] = $cliente['departamento'];
	$datos['dteJson']['receptor']['direccion']['municipio'] = $cliente['municipio'];
	$datos['dteJson']['receptor']['direccion']['complemento'] = $cliente['direccion'];
	$datos['dteJson']['receptor']['telefono'] = $cliente['telefono1'];;
	$datos['dteJson']['receptor']['correo'] = $cliente['email'];;

   }
   if($_SESSION["tipoticket"] == 2){
	if ($r = $db->select("cliente", "ticket_cliente", 
	"WHERE factura = '".$orden_num_fac."' and orden = '".$_SESSION["orden_print"]."' and tx = " . $_SESSION["tx"] . " and td = " .  $_SESSION["td"])) { 
		$hashcliente = $r["cliente"];
		} unset($r);  

	if ($r = $db->select("*", "clientes", 
	"WHERE hash = '".$hashcliente."' and td = " .  $_SESSION["td"])) { $cliente = $r; } unset($r); 
	//36:nit, 13:dui,03:pasaporte, 37:otro
	$datos['dteJson']['receptor']['tipoDocumento'] = (strlen(Helpers::FormatDui($cliente['documento'])) == 10) ? "13" : "36"; 
	$datos['dteJson']['receptor']['numDocumento'] = (strlen(Helpers::FormatDui($cliente['documento'])) == 10) ? Helpers::FormatDui($cliente['documento']) : Helpers::FormatNIT($cliente['documento']);
	$datos['dteJson']['receptor']['nrc'] = null;
	$datos['dteJson']['receptor']['nombre'] = $cliente['nombre'];
	$datos['dteJson']['receptor']['codActividad'] = null;
	$datos['dteJson']['receptor']['descActividad'] = null;
	$datos['dteJson']['receptor']['direccion']['departamento'] = $cliente['departamento'];
	$datos['dteJson']['receptor']['direccion']['municipio'] = $cliente['municipio'];
	$datos['dteJson']['receptor']['direccion']['complemento'] = $cliente['direccion'];
	$datos['dteJson']['receptor']['telefono'] = $cliente['telefono'];
	$datos['dteJson']['receptor']['correo'] = $cliente['email'];

   }


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
 $datos['dteJson']['resumen']['descuNoSuj'] = floatval(0);
 $datos['dteJson']['resumen']['descuExenta'] = floatval(0);
 $datos['dteJson']['resumen']['descuGravada'] = floatval(0);
 $datos['dteJson']['resumen']['porcentajeDescuento'] = floatval(0);
 $datos['dteJson']['resumen']['totalDescu'] = floatval(0);
 $datos['dteJson']['resumen']['tributos'][0]['codigo'] = "20";
 $datos['dteJson']['resumen']['tributos'][0]['descripcion'] = "IMPUESTO AL VALOR AGREGADO 13%";
 $datos['dteJson']['resumen']['tributos'][0]['valor'] = floatval($imp);
 $datos['dteJson']['resumen']['ivaRete1'] = floatval(0);
 $datos['dteJson']['resumen']['reteRenta'] = floatval(0);
 $datos['dteJson']['resumen']['montoTotalOperacion'] = floatval($total);
 $datos['dteJson']['resumen']['totalNoGravado'] = floatval(0);
 $datos['dteJson']['resumen']['totalPagar'] = floatval($total);
 $datos['dteJson']['resumen']['totalLetras'] = Dinero::DineroEscrito(floatval($total));
 $datos['dteJson']['resumen']['saldoFavor'] = floatval(0);
 $datos['dteJson']['resumen']['condicionOperacion'] = 1;

 $datos['dteJson']['resumen']['pagos'][0]['codigo'] = "01";
 $datos['dteJson']['resumen']['pagos'][0]['montoPago'] = floatval($total);
 $datos['dteJson']['resumen']['pagos'][0]['referencia'] = null;
 $datos['dteJson']['resumen']['pagos'][0]['plazo'] = null;
 $datos['dteJson']['resumen']['pagos'][0]['periodo'] = null;

 $datos['dteJson']['resumen']['numPagoElectronico'] = null;


  if($_SESSION["tipoticket"] == 3){
	$datos['dteJson']['resumen']['totalGravada'] = floatval($stotal);
	$datos['dteJson']['resumen']['subTotalVentas'] = floatval($stotal);
	$datos['dteJson']['resumen']['subTotal'] = floatval($stotal);
 	$datos['dteJson']['resumen']['ivaPerci1'] = floatval(0);
	$datos['dteJson']['resumen']['tributos'][0]['codigo'] = "20";
	$datos['dteJson']['resumen']['tributos'][0]['descripcion'] = "IMPUESTO AL VALOR AGREGADO 13%";
	$datos['dteJson']['resumen']['tributos'][0]['valor'] = floatval($imp);
   }
   if($_SESSION["tipoticket"] == 2){
	$datos['dteJson']['resumen']['totalGravada'] = floatval($total);
	$datos['dteJson']['resumen']['subTotalVentas'] = floatval($total);
 	$datos['dteJson']['resumen']['subTotal'] = floatval($total);
 	$datos['dteJson']['resumen']['tributos'] = [];
	$datos['dteJson']['resumen']['totalIva'] =  floatval($imp);
   }

$datos['dteJson']['extension']['nombEntrega'] = null;
$datos['dteJson']['extension']['docuEntrega'] = null;
$datos['dteJson']['extension']['nombRecibe'] = null;
$datos['dteJson']['extension']['docuRecibe'] = null;
$datos['dteJson']['extension']['observaciones'] = null;
$datos['dteJson']['extension']['placaVehiculo'] = null;

$datos['dteJson']['apendice'] = null;


echo json_encode($datos);
		

}// termina le funcion









} // fin de la clase

 ?>


 