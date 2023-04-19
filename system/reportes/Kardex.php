<?php  

class Kardex{

	public function __construct(){

	}


// codigo, detalle, iden, valor_unitario, cantidad, total
// public function InsertKardex($cod, $detalle, $iden, $valor, $cantidad, $total) {
    public function InsertVenta($factura, $tipo) {
        $db = new dbConn();

        $a = $db->query("SELECT * FROM ticket WHERE fatura = ".$factura." and tipo = ".$tipo." and td = ".$_SESSION["td"]."");

        if($a->num_rows > 0){
            foreach ($a as $b) {
                $tcantidad = Helpers::GetData('producto','cantidad','cod', $b['cod']);
                $this->comprobarInicial($b['cod'], null, "Inventario Inicial", $b['pv'], $b['cant'], $b['total'], null, null, $tcantidad);
                $this->InsertarDatos($b['cod'], $b['hash'], "Venta", $b['pv'], $b['cant'], $b['total'], null, null, $tcantidad);   
            }
        } $a->close();


  }



  public function comprobarInicial($cod, $iden, $detalle, $valor, $ecantidad, $etotal, $scantidad, $stotal, $tcantidad){
	$db = new dbConn();
    $a = $db->query("SELECT 'cod' FROM kardex WHERE cod = ".$cod." and td = ".$_SESSION["td"]."");
    $cant = $a->num_rows;
    $a->close();

    if($cant < 1){
        $this->InsertarDatos($cod, $iden, $detalle, $valor, $ecantidad, $etotal, $scantidad, $stotal, $tcantidad);   
    } 

  }

  public function InsertarDatos($cod, $iden, $detalle, $valor, $ecantidad, $etotal, $scantidad, $stotal, $tcantidad){
	$db = new dbConn();

    $datos = array();
    $datos["cod"] = $cod;
    $datos["detalle"] = $detalle;
    $datos["iden"] = $iden;
    $datos["valor_unitario"] = $valor;

    $datos["entrada_cantidad"] = $ecantidad;
    $datos["entrada_total"] = $etotal;
    $datos["salida_cantidad"] = $scantidad;
    $datos["salida_total"] = $stotal;

    $datos["saldo_cantidad"] = $tcantidad;
    $datos["saldo_total"] = $valor * $tcantidad;


    $datos["fecha"] = date("d-m-Y");
    $datos["hora"] = date("H:i:s");
    $datos["fechaF"] = Fechas::Format(date("d-m-Y"));

    $datos["hash"] = Helpers::HashId();
    $datos["time"] = Helpers::TimeId();
    $datos["td"] = $_SESSION["td"];
    $db->insert("kardex", $datos); 
  }




// termina la clase
 }


?>