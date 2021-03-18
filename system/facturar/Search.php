<?php 
class Search{






  public function DestalleFactura($factura){
      $db = new dbConn();


// para poner que ha sido eliminada la factura
    if ($r = $db->select("edo", "ticket_num", "WHERE num_fac = '$factura' and tipo = '".$_SESSION["tipoticket"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."")) { 
        $edox = $r["edo"];
    } unset($r);  


if($edox == 2){
  Alerts::Mensajex("La factura " .$factura . " ha sido anulada", "danger");
}


$a = $db->query("SELECT * FROM ticket WHERE num_fac = '$factura' and tipo = '".$_SESSION["tipoticket"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." order by id desc");
          if($a->num_rows > 0){
        echo '<table id="dtMaterialDesignExample" class="table table-striped" table-sm cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Cant</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>SubTotal</th>
                    <th>Imp</th>
                    <th>Descuento</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>';
                $pv = 0; $st = 0; $im = 0; $de = 0; $to = 0;
              foreach ($a as $b) { 
                $pv = $pv + $b["pv"]; $st = $st+$b["stotal"]; 
                $im = $im+$b["imp"]; $de = $de+$b["descuento"]; $to = $to+$b["total"];
                echo '<tr>
                      <td>'.$b["cant"]. '</td>
                      <td>'.$b["producto"].'</td>
                      <td>'.$b["pv"].'</td>
                      <td>'.$b["stotal"].'</td>
                      <td>'.$b["imp"].'</td>
                      <td>'.$b["descuento"].'</td>
                      <td>'.$b["total"].'</td>
                    </tr>';          
              }
        echo '</tbody>
                <tfoot>
                  <tr>
                    <th></th>
                    <th>Total: </th>
                    <th>' . $pv . '</th>
                    <th>' . $st . '</th>
                    <th>' . $im . '</th>
                    <th>' . $de . '</th>
                    <th>' . $to . '</th>
                  </tr>
                </tfoot>
              </table>';

          } else {
          	echo '<div align="center"><img src="assets/img/imagenes/error4.png" alt="Error" class="fluid-img"></div>';
          } $a->close();  


echo '<div class="text-center">';
echo "SE ENCUENTRA ACTIVA LA OPCION: ";

echo '<div id="vticket">';
  if($_SESSION["tipoticket"] == 1){ echo '<a id="mticket">TICKET</a>'; }
  elseif($_SESSION["tipoticket"] == 2){ echo '<a id="mticket">FACTURA</a>'; }
  elseif($_SESSION["tipoticket"] == 3){ echo '<a id="mticket">CREDITO FISCAL</a>'; }
  elseif($_SESSION["tipoticket"] == 4){ echo '<a id="mticket">NOTA DE CREDITO</a>'; }
  else { echo '<a id="mticket">N/A</a>'; }
echo "</div>";
echo "</div>";
  }






  public function BotonesFactura($factura){
      $db = new dbConn();

// para poner que ha sido eliminada la factura
    if ($r = $db->select("edo", "ticket_num", "WHERE num_fac = '$factura' and tipo = '".$_SESSION["tipoticket"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."")) { 
        $edox = $r["edo"];
    } unset($r);  




$a = $db->query("SELECT * FROM ticket_num WHERE num_fac = '$factura' and tipo = '".$_SESSION["tipoticket"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." order by id desc");
$cantidad = $a->num_rows;
$a->close();  

		if($cantidad > 0){
		Alerts::Mensajex("Factura No. " . $factura, "info");

		echo '<div align="center">';

		// echo '<a href="system/facturar/facturas/'.$_SESSION["td"].'/ticket_web.php?factura='.$factura.'" class="btn-floating btn-lg btn-mdb-color waves-effect waves-light" title="Imprimir Factura" target="_blank"><i class="fas fa-print"></i></a>';

if($edox == 2){
    
    echo '<a class="btn-floating btn-lg grey darken-1 waves-effect waves-light" title="Imprimir Factura"><i class="fas fa-print"></i></a>';


    echo '<a class="btn-floating btn-lg grey darken-1 waves-effect waves-light" title="Elimiar Factura"><i class="fas fa-trash-alt"></i></a>';
} else {
    echo '<a id="imprimir" class="btn-floating btn-lg btn-mdb-color waves-effect waves-light" title="Imprimir Factura"><i class="fas fa-print"></i></a>';

    echo '<a id="xdelete" class="btn-floating btn-lg btn-danger waves-effect waves-light" title="Elimiar Factura"><i class="fas fa-trash-alt"></i></a>';
}




		echo '</div>';



		} else {
		Alerts::Mensajex("La factura " .$factura . " no ha sido encontrada", "danger");

		}

}






public function BorrarFactura($factura){
    $db = new dbConn();

    $cambio = array();
    $cambio["edo"] = 2;
    Helpers::UpdateId("ticket", $cambio, "num_fac = '$factura' and tipo = '".$_SESSION["tipoticket"]."' and td = ".$_SESSION["td"]."");      
    
    $cambio2 = array();
    $cambio2["edo"] = 2;
    Helpers::UpdateId("ticket_num", $cambio2, "num_fac = '$factura' and tipo = '".$_SESSION["tipoticket"]."' and td = ".$_SESSION["td"]."");      
 



/// solo regresar la cantidad al inventario // esto deberia cambiar y llevarse todo lo necesario
  $a = $db->query("SELECT cant, cod FROM ticket WHERE num_fac = '$factura' and tipo = '".$_SESSION["tipoticket"]."' and td = ".$_SESSION["td"]."");
  foreach ($a as $b) {

// obtener cant de producto
if ($r = $db->select("cantidad", "producto", "WHERE cod = '".$b["cod"]."' and td = ".$_SESSION["td"]."")) { 
    $cantidad = $r["cantidad"];
} unset($r);  


    $cambiox = array();
    $cambiox["cantidad"] = $cantidad + $b["cant"];
    Helpers::UpdateId("producto", $cambiox, "cod = '".$b["cod"]."' and td = ".$_SESSION["td"]."");     

  } $a->close();
/////////////




}









} // fin de la clase

 ?>