<?php 
class Movimientos{

		public function __construct() { 
     	} 




/// agregar Item
  public function AddItem($data, $td){
      $db = new dbConn();

  if($data["usuario"] == NULL){ // si no existe numero de orden agregar uno    
       $data["usuario"] = Helpers::HashId();
  }


  if($data["orden"] == NULL){ // si no existe numero de orden agregar uno    
       $data["orden"] = $this->AddOrden($data["usuario"], $td);
  }

if($this->ObtenerCantidadTicket($data["cod"], $data["orden"], $td) == 0){ // agregar
  $this->Agregar($data, $td);
} else { // Actualizar
  $this->Actualiza($data, $td);
}

$salida = array();
$salida["usuario"] =  $data["usuario"];
$salida["orden"] =  $data["orden"];
$salida["mensaje"] =  "Agregado correctamente";
echo json_encode($salida);

}




  public function AddOrden($usuario, $td) { //leva el control del autoincremento de las cotizaciones
    $db = new dbConn();
       
        if ($r = $db->select("orden", "ecommerce_data", "WHERE td = ".$td." order by orden desc limit 1")) { 
            $ultimoorden = $r["orden"];
        } unset($r);   

        if($ultimoorden == NULL){ $ultimoorden = 0; }
        $datos = array();
        $datos["usuario"] = $usuario;
        $datos["orden"] = $ultimoorden + 1;
        $datos["fecha"] = date("d-m-Y");
        $datos["hora"] = date("H:i:s");
        $datos["fechaF"] = Fechas::Format(date("d-m-Y"));
        $datos["edo"] = 1;
        $datos["hash"] = Helpers::HashId();
        $datos["time"] = Helpers::TimeId();
        $datos["td"] = $td;
        $db->insert("ecommerce_data", $datos); 
    
    return $ultimoorden + 1;    
  }



  public function ObtenerCantidadTicket($cod, $orden, $td) { // obtine cantiad de productos
    $db = new dbConn();

  if ($r = $db->select("cant", "ecommerce", "WHERE cod = '$cod' and orden = ".$orden." and td = ".$td."")){ 
        return $r["cant"];
      } unset($r); 
    }


  public function Agregar($datos, $td) { // agrega el producto
    $db = new dbConn();

  $pv = $this->ObtenerPrecio($datos["cod"], $datos["cantidad"], $td);
  $sumas = $pv * $datos["cantidad"];

    $stot=Helpers::STotal($sumas, $this->ObtenerImpuesto($td));
    $im=Helpers::Impuesto($stot, $this->ObtenerImpuesto($td));

    $datox = array();
      $datox["cod"] = $datos["cod"];
      $datox["cant"] = $datos["cantidad"];
      $datox["producto"] = $this->ObtenerNombre($datos["cod"], $td);
      $datox["pv"] = $pv;            
      $datox["stotal"] = $stot;                
      $datox["imp"] = $im;
      $datox["total"] = $stot + $im;
      $datox["descuento"] = NULL;
      $datox["orden"] = $datos["orden"];
      $datox["usuario"] = $datos["usuario"];
      $hash = Helpers::HashId();
      $datox["hash"] = $hash;
      $datox["time"] = Helpers::TimeId();
      $datox["td"] = $td;
      $db->insert("ecommerce", $datox);

  }


  public function Actualiza($datos, $td) { // agrega el producto suma de uno n uno
    $db = new dbConn();

  $pv = $this->ObtenerPrecio($datos["cod"], $datos["cantidad"], $td);
  $sumas = $pv * $datos["cantidad"];
  $descuento = NULL;


    $stot=Helpers::STotal($sumas, $this->ObtenerImpuesto($td));
    $im=Helpers::Impuesto($stot, $this->ObtenerImpuesto($td));

      $cambio = array();
    $cambio["cant"] = $datos["cantidad"];
    $cambio["pv"] = $pv;
    $cambio["stotal"] = $stot;
    $cambio["imp"] = $im;
    $cambio["total"] = $stot + $im;
    $cambio["descuento"] = $descuento;
    Helpers::UpdateId("ecommerce", $cambio, "cod='".$datos["cod"]."' and orden = ".$datos["orden"]." and td = ".$td."");

  }



  public function ObtenerPrecio($cod, $cant, $td){ // obtiene el precio independientemente la cantidad
    $db = new dbConn();
    // cuento si hay varias fechas
  $a = $db->query("SELECT * FROM producto_precio WHERE producto = '$cod' and td = ".$td."");
    $precios = $a->num_rows; $a->close();

      if($precios > 1){ // si hay mas de un precio
          
          if ($r = $db->select("precio", "producto_precio", "WHERE cant <= '$cant' and producto = '$cod' and td = ".$td." order by cant desc limit 1")) { 
                $precio = $r["precio"];
            } unset($r);

      } else { // si solo hay un precio
           
            if ($r = $db->select("precio", "producto_precio", "WHERE producto = '$cod' and td = ".$td."")) { 
                $precio = $r["precio"];
            } unset($r);  
      }
        return $precio;
  }


  public function ObtenerNombre($cod, $td){
    $db = new dbConn();

      if ($r = $db->select("descripcion", "producto", "WHERE cod = '$cod' and td = ".$td."")){ 
        return $r["descripcion"];
      } unset($r); 
    }



  public function ObtenerImpuesto($td){
    $db = new dbConn();

  if ($r = $db->select("imp", "config_master", "WHERE td = ".$td."")){ 
        return $r["imp"];
      } unset($r); 
    }










public function VerTodosLosPedidos($npagina, $orden, $dir){
  $db = new dbConn();


  $limit = 25;
  $adjacents = 2;
  if($npagina == NULL) $npagina = 1;
  $a = $db->query("SELECT * FROM ecommerce_data WHERE td = ". $_SESSION['td'] ."");
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

$op = "375";

 $a = $db->query("SELECT * FROM ecommerce_data WHERE td = ".$_SESSION["td"]." order by ".$orden." ".$dir." limit $offset, $limit");
      
      if($a->num_rows > 0){


echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
<tr>
<th><a id="paginador" op="'.$op.'" iden="1" orden="orden" dir="'.$dir2.'">Orden</a></th>
<th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="time" dir="'.$dir2.'">Fecha</a></th>
<th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="edo" dir="'.$dir2.'">Estado</a></th>
<th>Productos</th>
<th class="th-sm">Total</th>
<th class="th-sm">Print</th>
</tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto

  if ($r = $db->select("sum(cant) as cantidad, sum(total) as total", "ecommerce", "WHERE orden = '".$b["orden"]."' and td = ".$_SESSION["td"]."")){ 
        $cantidad = $r["cantidad"];
        $total = $r["total"];
      } unset($r); 

   echo '<tr>
          <td>'.$b["orden"].'</td>
          <td>'.$b["fecha"].' - '. $b["hora"] . '</td>
          <td>'.Helpers::Edoecommerce($b["edo"]).'</td>
          <td>'.Helpers::Entero($cantidad).'</td>
          <td>'.Helpers::Dinero($total).'</td>
          <td>
          <a id="xver" op="376" orden="'.$b["orden"].'"><i class="fas fa-search fa-lg green-text"></i></a>';

          if($b["edo"] == 2 or $b["edo"] == 3){

    echo '<a id="xprint" op="55" key="'.$b["hash"].'"><i class="fas fa-print fa-lg red-text"></i></a>
          <a id="xprint" op="55" key="'.$b["hash"].'"><i class="fas fa-ad fa-lg green-text"></i></a>
          <a id="xprint" op="55" key="'.$b["hash"].'"><i class="fas fa-cogs fa-lg blue-text"></i></a>';
          }

          
   echo '</td>
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











public function ProductosOrden($orden){
  $db = new dbConn();
  $encrypt = new Encrypt();

 $a = $db->query("SELECT * FROM ecommerce WHERE orden = '".$orden."' and td = ".$_SESSION["td"]."");
      
      if($a->num_rows > 0){


echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
<tr>
<th>Código</th>
<th>Cantidad</th>
<th>Producto</th>
<th>Precio</th>
<th>Impuesto</th>
<th>Total</th>
</tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
$usuario = $b["usuario"];

  if ($r = $db->select("sum(cant) as cantidad, sum(total) as total", "ecommerce", "WHERE orden = '".$b["orden"]."' and td = ".$_SESSION["td"]."")){ 
        $cantidad = $r["cantidad"];
        $total = $r["total"];
      } unset($r); 

   echo '<tr>
          <td>'.$b["cod"].'</td>
          <td><strong>'.$b["cant"].'</strong></td>
          <td>'.$b["producto"].'</td>
          <td>'.$b["pv"].'</td>
          <td>'.$b["imp"].'</td>
          <td>'.Helpers::Dinero($b["total"]).'</td>
        </tr>';
        }
        echo '</tbody>
        </table>
        </div>';
      }
        $a->close();


$url = "https://justomarket.com/application/src/api.php?op=1&user=".$usuario."&secret=" . 
Encrypt::Encrypt($_SESSION['td'],$_SESSION['secret_key']);

  $this->DatosUsuario($url);

}








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




public function DatosUsuario($url){
  $jsondata = $this->ObtenerData($url);
  $datos = json_decode($jsondata, true); 

// print_r($datos);

if($datos["user"]["nombre"] != NULL and $datos["direccion"]["user"] != NULL){
echo '<hr><h4>Cliente: <strong>'.$datos["user"]["nombre"].'</strong></h4>';



echo '<div class="text-left">
<h4>Informaci&oacuten General</h4>
<ul class="pl-2">
<li class="linopunto"><span><strong>Fecha de Nacimientos : </strong></span>'.Fechas::FechaEscrita($datos["direccion"]["f_nacimiento"]).'</li>
<li class="linopunto"><span><strong>Dirección : </strong></span>'.$datos["direccion"]["usr_direccion"].', '.$datos["direccion"]["usr_departamento"].', '.$datos["direccion"]["usr_municipio"].', '.$datos["direccion"]["usr_pais"].'</li>
<li class="linopunto"><span><strong>E-mail : </strong></span><a>'.$datos["email"]["email"].'</a></li>
<li class="linopunto"><span><strong>Teléfono : </strong></span>'.$datos["direccion"]["usr_telefono"].'</li>
</ul>
</div>

<hr>

<div class="text-left">
<h4>Informaci&oacuten de envío</h4>
<ul class="pl-2">
<li class="linopunto"><span><strong>Dirección : </strong></span>'.$datos["direccion"]["recibe_direccion"].', '.$datos["direccion"]["recibe_departamento"].', '.$datos["direccion"]["recibe_municipio"].', '.$datos["direccion"]["usr_pais"].'</li>
<li class="linopunto"><span><strong>Teléfono : </strong></span>'.$datos["direccion"]["recibe_telefono"].'</li>
</ul>
</div>';

if($datos["direccion"]["puntoreferencia"] != NULL){
    echo '<h4>Punto de referencia</h4>
          <p>'.$datos["direccion"]["puntoreferencia"].'</p>';
}



} else {
  Alerts::Mensajex("Éste usuario aún no está registrado","danger");
}



}









} // Termina la clase
?>