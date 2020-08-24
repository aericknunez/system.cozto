<?php 
class Pesaje{

		public function __construct() { 
     	} 


public function BusquedaProducto($key){
    $db = new dbConn();

    if ($r = $db->select("descripcion, cantidad, medida", "producto", "WHERE cod = '".$key."' and td = ".$_SESSION["td"]."")) { 
        $descripcion = $r["descripcion"];
        $cantidad = $r["cantidad"];
        $medida = $r["medida"];
    } unset($r);  


if ($r = $db->select("nombre", "producto_unidades", "WHERE hash = '".$medida."' and td = ".$_SESSION["td"]."")) { $umedida = $r["nombre"]; } unset($r);  

echo '<h4>'.$descripcion.'</h4>';


        $ap = $db->query("SELECT * FROM producto_precio WHERE producto = '".$key."' AND td = ".$_SESSION["td"]." order by cant asc");
        if($ap->num_rows > 0){
        echo '<table class="table table-sm table-hover table-striped">
              <thead>
                <tr>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Precio</th>
                </tr>
              </thead>
              <tbody>';
        foreach ($ap as $bp) {
           echo '<tr>
                  <td>'.$bp["cant"].'</td>
                  <td><strong>'.Helpers::Dinero($bp["precio"]).'</strong></td>';
        } $ap->close();
        echo '</tbody>
            </table>';
        } else {
          Alerts::Mensajex("No se he establecido un precio",'danger',$boton,$boton2);
        }

echo '<h4>Cantidad Disponible: '.$cantidad.'. |  Medida: '.$umedida.'</h4>';



echo '<div class="row z-depth-2 d-flex justify-content-center mt-4 mb-3">
<input type="hidden" name="producto" id="producto" value="'.$key.'">
<input type="number" step="any" name="peso" id="peso" placeholder="Agregar peso" class="form-control">
</div>';


}






public function AddProducto($datos){
    $db = new dbConn();


  $pv = $this->ObtenerPrecio($datos["producto"], $datos["peso"]);
  $sumas = $pv * $datos["peso"];

    $stot=Helpers::STotal($sumas, $_SESSION["config_imp"]);
    $im=Helpers::Impuesto($stot, $_SESSION["config_imp"]);

    $datox = array();
      $datox["cod"] = $datos["producto"];
      $datox["cant"] = $datos["peso"];
      $product = $this->ObtenerNombre($datos["producto"], $td);
      $datox["producto"] = $product;
      $datox["pv"] = $pv;            
      $datox["stotal"] = $stot;                
      $datox["imp"] = $im;
      $total = $stot + $im;
      $datox["total"] = $total;
      $datox["descuento"] = NULL;
      $datox["usuario"] = $_SESSION["user"];
      $datox["fecha"] = date("d-m-Y");
      $datox["hora"] = date("H:i:s");
      $datox["fechaF"] = Fechas::Format(date("d-m-Y"));
      $datox["edo"] = 1;
      $hash = Helpers::HashId();
      $datox["hash"] = $hash;
      $datox["time"] = Helpers::TimeId();
      $datox["td"] = $_SESSION["td"];
      if($db->insert("pesaje", $datox)){

          Alerts::Alerta("succcess","Realizaro!","Producto Ingresado!");

         $this->VerPesos(1, "id", "desc");
      } else {
         Alerts::Alerta("error","Error!","Ocurrió un error al ingresar el producto!");
      }

}








  public function ObtenerPrecio($cod, $cant){ // obtiene el precio independientemente la cantidad
    $db = new dbConn();
    // cuento si hay varias fechas
  $a = $db->query("SELECT * FROM producto_precio WHERE producto = '$cod' and td = ".$_SESSION["td"]."");
    $precios = $a->num_rows; $a->close();

      if($precios > 1){ // si hay mas de un precio
          
          if ($r = $db->select("precio", "producto_precio", "WHERE cant <= '$cant' and producto = '$cod' and td = ".$_SESSION["td"]." order by cant desc limit 1")) { 
                $precio = $r["precio"];
            } unset($r);

      } else { // si solo hay un precio
           
            if ($r = $db->select("precio", "producto_precio", "WHERE producto = '$cod' and td = ".$_SESSION["td"]."")) { 
                $precio = $r["precio"];
            } unset($r);  
      }
        return $precio;
  }


  public function ObtenerNombre($cod){
    $db = new dbConn();

      if ($r = $db->select("descripcion", "producto", "WHERE cod = '$cod' and td = ".$_SESSION["td"]."")){ 
        return $r["descripcion"];
      } unset($r); 
    }
















public function VerPesos($npagina, $orden, $dir){
  $db = new dbConn();


  $limit = 12;
  $adjacents = 2;
  if($npagina == NULL) $npagina = 1;
  $a = $db->query("SELECT * FROM pesaje WHERE td = ". $_SESSION['td'] ."");
  $total_rows = $a->num_rows;
  $a->close();

  $total_pages = ceil($total_rows / $limit);
  
  if(isset($npagina) && $npagina != NULL) {
    $page = $npagina;
    $offset = $limit * ($page-1);
  } else {
    $page = 1;
    $offset = 0;
  }

if($dir == "desc") $dir2 = "asc";
if($dir == "asc") $dir2 = "desc";

$op = "427";

 $a = $db->query("SELECT * FROM pesaje WHERE td = ".$_SESSION["td"]." order by ".$orden." ".$dir." limit $offset, $limit");
      
      if($a->num_rows > 0){
          echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
<tr>
<th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="time" dir="'.$dir2.'">Fecha</a></th>
<th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="cant" dir="'.$dir2.'">Medida</a></th>
<th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="producto" dir="'.$dir2.'">Producto</a></th>
<th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="pv" dir="'.$dir2.'">Precio</a></th>
<th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="total" dir="'.$dir2.'">Total</a></th>
<th class="th-sm">Print</th>
</tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
          echo '<tr>
                      <td>'.$b["fecha"].' - '. $b["hora"] . '</td>
                      <td>'.$b["cant"].'</td>
                      <td>'.$b["producto"].'</td>
                      <td>'.$b["pv"].'</td>
                      <td>'.$b["total"].'</td>
                      <td><a id="xprint" op="55" key="'.$b["cod"].'"><i class="fas fa-print fa-lg green-text"></i></a></td>
                    </tr>';
        }
        echo '</tbody>
        </table>
        </div>';
      }
        $a->close();

  if($total_pages <= (1+($adjacents * 2))) {
    $start = 1;
    $end   = $total_pages;
  } else {
    if(($page - $adjacents) > 1) {  
      if(($page + $adjacents) < $total_pages) {  
        $start = ($page - $adjacents); 
        $end   = ($page + $adjacents); 
      } else {              
        $start = ($total_pages - (1+($adjacents*2))); 
        $end   = $total_pages; 
      }
    } else {
      $start = 1; 
      $end   = (1+($adjacents * 2));
    }
  }
echo $total_rows . " Registros encontrados";
   if($total_pages > 1) { 

$page <= 1 ? $enable = 'disabled' : $enable = '';
    echo '<ul class="pagination pagination-sm justify-content-center">
    <li class="page-item '.$enable.'">
        <a class="page-link" id="paginador" op="'.$op.'" iden="1" orden="'.$orden.'" dir="'.$dir.'">&lt;&lt;</a>
      </li>';
    
    $page>1 ? $pagina = $page-1 : $pagina = 1;
    echo '<li class="page-item '.$enable.'">
        <a class="page-link" id="paginador" op="'.$op.'" iden="'.$pagina.'" orden="'.$orden.'" dir="'.$dir.'">&lt;</a>
      </li>';

    for($i=$start; $i<=$end; $i++) {
      $i == $page ? $pagina =  'active' : $pagina = '';
      echo '<li class="page-item '.$pagina.'">
        <a class="page-link" id="paginador" op="'.$op.'" iden="'.$i.'" orden="'.$orden.'" dir="'.$dir.'">'.$i.'</a>
      </li>';
    }

    $page >= $total_pages ? $enable = 'disabled' : $enable = '';
    $page < $total_pages ? $pagina = ($page+1) : $pagina = $total_pages;
    echo '<li class="page-item '.$enable.'">
        <a class="page-link" id="paginador" op="'.$op.'" iden="'.$pagina.'" orden="'.$orden.'" dir="'.$dir.'">&gt;</a>
      </li>';

    echo '<li class="page-item '.$enable.'">
        <a class="page-link" id="paginador" op="'.$op.'" iden="'.$total_pages.'" orden="'.$orden.'" dir="'.$dir.'">&gt;&gt;</a>
      </li>

      </ul>';
     }  // end pagination 


}















public function GenerarBarcode($code){
    $db = new dbConn();


    if ($r = $db->select("*", "pesaje", "WHERE hash = '".$code."' and td = ".$_SESSION["td"]."")) { 
        $producto = $r["producto"];
        $cant = $r["cant"];
        $pv = $r["pv"];
        $total = $r["total"];
    } unset($r);  



echo '<div class="row" align="center">';

echo '<div class="justify-content-center border border-dark">';

echo '<img src="application/common/barcode.php?text='.$code.'&size=50" alt="'.$producto.'" />
<br>
'.$producto.' <br>
<h4 class="font-weight-bold">Total: ' . Helpers::Dinero($total) .'</h4>
Precio: '.$pv.' Peso: '.$cant.'
';

echo '</div>';
echo '</div>';
}



public function ObtenerCantidad($code){
    $db = new dbConn();

    if ($r = $db->select("*", "pesaje", "WHERE hash = '".$code."' and td = ".$_SESSION["td"]."")) { 
        return $r["cant"];
    } unset($r);  

}

public function ObtenerCod($code){
    $db = new dbConn();

    if ($r = $db->select("*", "pesaje", "WHERE hash = '".$code."' and td = ".$_SESSION["td"]."")) { 
        return $r["cod"];
    } unset($r);  

}





public function Facturar($code){
    $db = new dbConn();

      $cambio = array();
      $cambio["edo"] = 2;
      if(Helpers::UpdateId("pesaje", $cambio, "hash='".$code."' and td = ".$_SESSION["td"]."")){
        return TRUE;
      } else {
        return FALSE;
      }

}









public function MostrarPesos(){
  $db = new dbConn();


 $a = $db->query("SELECT * FROM pesaje WHERE td = ".$_SESSION["td"]." and edo =  1 limit 8");

      if($a->num_rows > 0){
          echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
<tr>

<th class="th-sm">Medida</th>
<th class="th-sm">Producto</th>
<th class="th-sm">Total</th>
<th class="th-sm">Facturar</th>
</tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
          echo '<tr>
                      <td>'.$b["cant"].'</td>
                      <td>'.$b["producto"].'</td>
                      <td>'.$b["pv"].'</td>
                      <td><a id="xfacturar" probal="'.$b["hash"].'"><i class="fas fa-dollar-sign fa-lg green-text"></i>Facturar</a></td>
                    </tr>';
        }
        echo '</tbody>
        </table>
        </div>';
      } else {
        Alerts::Mensajex("No se detectaron productos previamente pesados sin pasar por caja","info");
      }
        $a->close();
      


}




















} // Termina la clase

?>