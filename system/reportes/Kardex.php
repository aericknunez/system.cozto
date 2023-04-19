<?php  

class Kardex{

	public function __construct(){

	}


// codigo, detalle, iden, valor_unitario, cantidad, total
// public function InsertKardex($cod, $detalle, $iden, $valor, $cantidad, $total) {
    public function InsertVenta($factura, $tipo) {
        $db = new dbConn();
        $a = $db->query("SELECT * FROM ticket WHERE num_fac = '$factura' and tipo = '$tipo' and td = ".$_SESSION["td"]."");

        if($a->num_rows > 0){
            foreach ($a as $b) {
                $tcantidad = Helpers::GetData('producto','cantidad','cod', $b['cod']);
                $cantInitial = $tcantidad + $b['cant'];
                $this->comprobarInicial($b['cod'], null, "Inventario Inicial", $this->precioUnitario($b['cod']), $cantInitial, $this->precioUnitario($b['cod']) * $cantInitial, null, null, $cantInitial);
                $this->InsertarDatos($b['cod'], $b['hash'], "Venta", $this->precioUnitario($b['cod']), null, null, $b['cant'], $b['total'], $tcantidad);   
            }
        } 
        
        $a->close();


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


  public function IngresarProductoKardex($cod, $cantidad, $hash, $valor){
    $tcantidad = Helpers::GetData('producto','cantidad','cod', $cod);
    $this->comprobarInicial($cod, null, "Inventario Inicial", $this->precioUnitario($cod), null, null, null, null, null);
    $this->InsertarDatos($cod, $hash, "Ingreso de Producto", $this->precioUnitario($cod), $cantidad, $cantidad * $this->precioUnitario($cod), 0, 0, $tcantidad);   

  }

  public function EliminaProductoKardex($hash){
    Helpers::DeleteId("kardex", "iden = '$hash' and td = ".$_SESSION["td"]."");
  }


  public function EliminaFacturaKardex($cod, $cantidad, $hash, $valor){
    $tcantidad = Helpers::GetData('producto','cantidad','cod', $cod);
    $this->InsertarDatos($cod, $hash, "Devolución de producto", $this->precioUnitario($cod), $cantidad, $cantidad * $this->precioUnitario($cod), 0, 0, $tcantidad);   
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


  public function precioUnitario($cod){
    $db = new dbConn();
    if ($r = $db->select("precio", "producto_precio", "WHERE cant = 1 and producto = '$cod' and td = ".$_SESSION["td"]."")) { 
        $precio = $r["precio"];
    } unset($r);
    return $precio;
  }


  public function verDatos($cod, $fecha){
    $db = new dbConn();

    $a = $db->query("SELECT * FROM kardex WHERE cod = '$cod' and fecha like '%$fecha' and td = ". $_SESSION["td"] ." order by fechaF desc");
    if($a->num_rows > 0){

    echo ' <h3 class="h3-responsive">'.Helpers::GetData('producto', 'descripcion', 'cod', $cod).'</h3>
        <div class="table-responsive">
        <table class="table table-sm table-striped">
    <thead>
        <tr>
        <th scope="col">Fecha</th>
        <th scope="col">Detalle</th>
        <th scope="col">Precio Unitario</th>
        <th scope="col">Entrada Cantidad</th>
        <th scope="col">Entrada Total</th>
        <th scope="col">Salida Cantidad</th>
        <th scope="col">Salida Total</th>
        <th scope="col">Saldo Cantidad</th>
        <th scope="col">Saldo Total</th>

        </tr>
    </thead>
    <tbody>';

    foreach ($a as $b) {
    
    echo '<tr>
      <th scope="row">'. $b["fecha"] .'</th>
      <td>'. $b["detalle"] .'</td>
      <td>'. Helpers::Dinero($b["valor_unitario"]) .'</td>
      <td>'. Helpers::Entero($b["entrada_cantidad"]) .'</td>
      <td>'. Helpers::Dinero($b["entrada_total"]) .'</td>
      <td>'. Helpers::Entero($b["salida_cantidad"]) .'</td>
      <td>'. Helpers::Dinero($b["salida_total"]) .'</td>
      <td>'. Helpers::Entero($b["saldo_cantidad"]) .'</td>
      <td><strong>'. Helpers::Dinero($b["saldo_total"]) .'</strong></td>
    </tr>';
    }
echo '

    </tbody>
</table></div>';


 echo '<div class="text-right"><a href="">Descargar Excel</a></div>';

} else {
Alerts::Mensajex("No se encontraron registros","danger",null, null);
}
  $a->close();



  }
















// termina la clase
 }


?>