<?php 
class Search{






  public function DestalleFactura($factura){
      $db = new dbConn();

$a = $db->query("SELECT * FROM ticket WHERE num_fac = '$factura' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." order by id desc");
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


  }






  public function BotonesFactura($factura){
      $db = new dbConn();

$a = $db->query("SELECT * FROM ticket WHERE num_fac = '$factura' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." order by id desc");
$cantidad = $a->num_rows;
$a->close();  

		if($cantidad > 0){
		Alerts::Mensajex("Factura No. " . $factura, "info");

		echo '<div align="center">';

		echo'<a href="system/facturar/ticket_web.php?factura='.$factura.'" class="btn-floating btn-lg btn-mdb-color waves-effect waves-light" title="Imprimir Factura" target="_blank"><i class="fas fa-print"></i></a>';

		echo '<a id="xdelete" class="btn-floating btn-lg btn-danger waves-effect waves-light" title="Elimiar Factura"><i class="fas fa-trash-alt"></i></a>';

		echo '</div>';

		} else {
		Alerts::Mensajex("La factura " .$factura . " no ha sido encontrada", "danger");

		}


}
















} // fin de la clase

 ?>