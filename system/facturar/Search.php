<?php 

class Search{






  public function DestalleFactura($factura){
      $db = new dbConn();

  $ordenes = $db->query("SELECT * FROM ticket_num WHERE num_fac = '$factura' and tipo = '".$_SESSION["tipoticket"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
          if($ordenes->num_rows > 0){

            foreach($ordenes as $orden)
            {
              if($orden['edo'] == 2){
                Alerts::Mensajex(Helpers::TipoFacturaVentas($_SESSION["tipoticket"])." N° " .$factura . " orden N° " .$orden['orden']." ha sido anulado/a", "danger");
              }else{
                Alerts::Mensajex(Helpers::TipoFacturaVentas($_SESSION["tipoticket"])." No. " . $factura." orden N° " .$orden['orden']  ,"info");
              } 
              echo '<table id="dtMaterialDesignExample" class="table table-striped" table-sm cellspacing="0" width="100%">
              
                <div class="card-body d-flex p-0 m-0">';
                if($orden['edo'] == 2){
                  echo '<a class="btn-floating btn-lg grey darken-1 waves-effect waves-light ml-auto" title="Imprimir Factura"><i class="fas fa-print"></i></a>';
                  echo '<a class="btn-floating btn-lg grey darken-1 waves-effect waves-light" title="Elimiar Factura"><i class="fas fa-trash-alt"></i></a>';
                } else {
                  echo '<a id="imprimir" class="btn-floating btn-lg btn-mdb-color waves-effect waves-light ml-auto" title="Imprimir Factura"><i class="fas fa-print"></i></a>';
                  echo '<a id="xdelete" orden="'.$orden['orden'].'" class="btn-floating btn-lg btn-danger waves-effect waves-light " title="Elimiar Factura"><i class="fas fa-trash-alt"></i></a>';
                };
               '</div>';
           echo '<thead>
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
              $productos = $db->query("SELECT * FROM ticket WHERE orden = ".$orden["orden"]." and tipo = '".$_SESSION["tipoticket"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
                    $pv = 0; 
                    $st = 0; 
                    $im = 0; 
                    $de = 0; 
                    $to = 0;
                    foreach($productos as $producto)
                    {
                        $pv = $pv + $producto["pv"]; 
                        $st = $st + $producto["stotal"]; 
                        $im = $im + $producto["imp"]; 
                        $de = $de + $producto["descuento"]; 
                        $to = $to + $producto["total"];
                        echo '<tr>
                              <td>'.$producto["cant"]. '</td>
                              <td>'.$producto["producto"].'</td>
                              <td>'.$producto["pv"].'</td>
                              <td>'.$producto["stotal"].'</td>
                              <td>'.$producto["imp"].'</td>
                              <td>'.$producto["descuento"].'</td>
                              <td>'.$producto["total"].'</td>
                            </tr>';      
                    }                                   
                  echo '</tbody>
                  <tfoot>
                    <tr>
                      <th></th>
                      <th>Total: </th>
                      <th>' .Helpers::Format($pv). '</th>
                      <th>' .Helpers::Format($st) . '</th>
                      <th>' .Helpers::Format($im) . '</th>
                      <th>' .Helpers::Format($de) . '</th>
                      <th>' .Helpers::Format($to) . '</th>
                    </tr>
                  </tfoot>
                </table>
                <hr class="bg-danger border-2 border-top border-danger">';
                
            }  $productos->close();  
          } else {
            Alerts::Mensajex(Helpers::TipoFacturaVentas($_SESSION["tipoticket"])." N° " .$factura . " no ha sido encontrado/a", "danger");
        
            } $ordenes->close();

echo '<div class="text-center">';
echo "SE ENCUENTRA ACTIVA LA OPCION: ";

echo '<div id="vticket">';
  if($_SESSION["tipoticket"] == 1){ echo '<a id="mticket">TICKET</a>'; }
  elseif($_SESSION["tipoticket"] == 2){ echo '<a id="mticket">FACTURA</a>'; }
  elseif($_SESSION["tipoticket"] == 12){ echo '<a id="mticket">FACTURA 2</a>'; }
  elseif($_SESSION["tipoticket"] == 3){ echo '<a id="mticket">CREDITO FISCAL</a>'; }
  elseif($_SESSION["tipoticket"] == 13){ echo '<a id="mticket">CREDITO FISCAL 2</a>'; }
  elseif($_SESSION["tipoticket"] == 4){ echo '<a id="mticket">NOTA DE CREDITO</a>'; }
  elseif($_SESSION["tipoticket"] == 8){ echo '<a id="mticket">NOTA DE ENVIO</a>'; }
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
		Alerts::Mensajex(Helpers::TipoFacturaVentas($_SESSION["tipoticket"])." No. " . $factura, "info");

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
		Alerts::Mensajex(Helpers::TipoFacturaVentas($_SESSION["tipoticket"])." N° " .$factura . " no ha sido encontrado/a", "danger");

		}

}






public function BorrarFactura($factura, $orden){
    $db = new dbConn();
    $kardex = new Kardex();

    $cambio = array();
    $cambio["edo"] = 2;
    Helpers::UpdateId("ticket", $cambio, "num_fac = '$factura' and orden = '$orden' and tipo = '".$_SESSION["tipoticket"]."' and td = ".$_SESSION["td"]."");      
    
    $cambio2 = array();
    $cambio2["edo"] = 2;
    Helpers::UpdateId("ticket_num", $cambio2, "num_fac = '$factura' and orden = '$orden' and tipo = '".$_SESSION["tipoticket"]."' and td = ".$_SESSION["td"]."");      
 



/// solo regresar la cantidad al inventario // esto deberia cambiar y llevarse todo lo necesario
  $a = $db->query("SELECT cant, cod, hash, pv FROM ticket WHERE num_fac = '$factura' and orden = '$orden' and tipo = '".$_SESSION["tipoticket"]."' and td = ".$_SESSION["td"]."");
  foreach ($a as $b) {

// obtener cant de producto
if ($r = $db->select("cantidad", "producto", "WHERE cod = '".$b["cod"]."' and td = ".$_SESSION["td"]."")) { 
    $cantidad = $r["cantidad"];
} unset($r);  


    $cambiox = array();
    $cambiox["cantidad"] = $cantidad + $b["cant"];
    Helpers::UpdateId("producto", $cambiox, "cod = '".$b["cod"]."' and td = ".$_SESSION["td"]."");


          //Actualizar Ubicaciones al eliminar una factura cuando tipo de venta es por codigo
          if($_SESSION ["tipo_inicio"]==1){

              if ($r = $db->select("hash", "ubicacion", "WHERE predeterminada = 1 and td = ".$_SESSION["td"]."")) { 
                $hashpredet = $r["hash"];
            } unset($r);  

            if ($r = $db->select("cant", "ubicacion_asig", "WHERE producto = '".$b["cod"]."' and ubicacion = '$hashpredet' and td = ".$_SESSION["td"]."")) { 
                $cantpredet = $r["cant"];
            } unset($r);  
            
            $cambio = array();
            $cambio["cant"] = $cantpredet + $b["cant"];
            Helpers::UpdateId("ubicacion_asig", $cambio, "producto = '".$b["cod"]."' and ubicacion = '".$hashpredet."' and td = ".$_SESSION["td"]."");   

          }


// pra actualizar las  caracteristicas y las ubicaciones
  $c = $db->query("SELECT cant, descuenta, producto, codigo FROM ticket_descuenta WHERE producto_hash = '".$b["hash"]."' and td = ".$_SESSION["td"]."");
  foreach ($c as $d) {

    if($d["descuenta"] == 1){ // caracteristica

      if ($r = $db->select("cant", "caracteristicas_asig", "WHERE caracteristica = '".$d["codigo"]."' and producto = '".$d["producto"]."' and td = ".$_SESSION["td"]."")) { 
          $cantc = $r["cant"];
      } unset($r);  

      $cambioy = array();
      $cambioy["cant"] = $d["cant"] + $cantc;
      Helpers::UpdateId("caracteristicas_asig", $cambioy, "caracteristica = '".$d["codigo"]."' and producto = '".$d["producto"]."' and td = ".$_SESSION["td"]."");

    } else { /// si es ubicacion

      if ($r = $db->select("cant", "ubicacion_asig", "WHERE ubicacion = '".$d["codigo"]."' and producto = '".$d["producto"]."' and td = ".$_SESSION["td"]."")) { 
          $cantu = $r["cant"];
      } unset($r);  

      $cambioz = array();
      $cambioz["cant"] = $d["cant"] + $cantu;
      Helpers::UpdateId("ubicacion_asig", $cambioz, "ubicacion = '".$d["codigo"]."' and producto = '".$d["producto"]."' and td = ".$_SESSION["td"]."");


    }


  } $c->close();


  $kardex->EliminaFacturaKardex($b["cod"], $b["cant"], $b["hash"], $b["pv"]);
  } $a->close();
/////////////
}
















public function BusquedaPorOpciones($comentario){
  $db = new dbConn();

$a = $db->query("SELECT * FROM ticket WHERE comentario like '%".$comentario."%' and tipo = '".$_SESSION["tipoticket"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." order by id desc");
      if($a->num_rows > 0){
    echo '<table id="dtMaterialDesignExample" class="table table-striped" table-sm cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>'.$_SESSION["root_extra"].'</th>
                <th>Fecha</th>
                <th>Cajero</th>
                <th>Cant</th>
                <th>Producto</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>';
          foreach ($a as $b) { 
            echo '<tr>
                  <td>'.$b["comentario"]. '</td>
                  <td>'.$b["fecha"]. ' '.$b["hora"]. '</td>
                  <td>'. Helpers::GetData("login_userdata", "nombre", "user", $b["cajero"]). '</td>
                  <td>'.$b["cant"]. '</td>
                  <td>'.$b["producto"].'</td>
                  <td>'.$b["total"].'</td>
                </tr>';          
          }
    echo '</table>';

      } else {
        echo '<div align="center"><img src="assets/img/imagenes/error4.png" alt="Error" class="fluid-img"></div>';
      } $a->close();  


echo '<div class="text-center">';
echo "SE ENCUENTRA ACTIVA LA OPCION: ";

echo '<div id="vticket">';
if($_SESSION["tipoticket"] == 1){ echo '<a id="mticket">TICKET</a>'; }
elseif($_SESSION["tipoticket"] == 2){ echo '<a id="mticket">FACTURA</a>'; }
elseif($_SESSION["tipoticket"] == 12){ echo '<a id="mticket">FACTURA 2</a>'; }
elseif($_SESSION["tipoticket"] == 3){ echo '<a id="mticket">CREDITO FISCAL</a>'; }
elseif($_SESSION["tipoticket"] == 13){ echo '<a id="mticket">CREDITO FISCAL 2</a>'; }
elseif($_SESSION["tipoticket"] == 4){ echo '<a id="mticket">NOTA DE CREDITO</a>'; }
elseif($_SESSION["tipoticket"] == 8){ echo '<a id="mticket">NOTA DE ENVIO</a>'; }
else { echo '<a id="mticket">N/A</a>'; }
echo "</div>";
echo "</div>";
}

} // fin de la clase

 ?>