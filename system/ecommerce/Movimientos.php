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




/// agregar Delivery al finalizar compra
  public function AddDelivery($data, $td){
      $db = new dbConn();

  $this->AgregaDelivery($data, $td);

$salida = array();
$salida["usuario"] =  $data["usuario"];
$salida["orden"] =  $data["orden"];
$salida["mensaje"] =  "Agregado correctamente";
echo json_encode($salida);

}

  public function AgregaDelivery($datos, $td) { // agrega el producto
    $db = new dbConn();

  $sumas = $datos["precio"] * $datos["cantidad"];

    $stot=Helpers::STotal($sumas, $this->ObtenerImpuesto($td));
    $im=Helpers::Impuesto($stot, $this->ObtenerImpuesto($td));

if($datos["precio"] == 0){
  $pro = "RECOGER EN TIENDA";
} else {
  $pro = "DELIVERY";
}

    $datox = array();
      $datox["cod"] = 9999999;
      $datox["cant"] = $datos["cantidad"];
      $datox["producto"] = $pro;
      $datox["pv"] = $datos["precio"];            
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

if($cantidad != 0){
   echo '<tr>
          <td>'.$b["orden"].'</td>
          <td>'.$b["fecha"].' - '. $b["hora"] . '</td>
          <td id="'.$b["orden"].''.$b["usuario"].'">'.Helpers::Edoecommerce($b["edo"]).'</td>
          <td>'.Helpers::Entero($cantidad).'</td>
          <td>'.Helpers::Dinero($total).'</td>
          <td id="btn'.$b["orden"].''.$b["usuario"].'">
          <a id="xver" op="376" orden="'.$b["orden"].'"><i class="fas fa-search fa-lg green-text"></i></a>';

          if($b["edo"] == 2 or $b["edo"] == 3){

    echo '<a href="system/facturar/facturas/'.$_SESSION["td"].'/ticket_ecommerce.php?orden='.$b["orden"].'&usr='.$b["usuario"].'" target="_blank"><i class="fas fa-print fa-lg red-text"></i></a>
          <a id="facturar" op="381" orden="'.$b["orden"].'" user="'.$b["usuario"].'"><i class="fas fa-ad fa-lg green-text"></i></a>
          <a id="op-edo" orden="'.$b["orden"].'" user="'.$b["usuario"].'"><i class="fas fa-cogs fa-lg blue-text"></i></a>
          <a id="xdelete" op="386" hash="'.$b["hash"].'"><i class="fas fa-trash fa-lg red-text"></i></a>';
          }

          
   echo '</td>
        </tr>';
        } // foreach
} // // cantidad

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

    if ($r = $db->select("edo", "ecommerce_data", "WHERE orden = '".$b["orden"]."' and td = ".$_SESSION["td"]."")) { 
        $edo = $r["edo"];
    } unset($r);  

if($edo == 1){ $edo = "En pedido se encuentra en proceso de compra por el usuario"; }
if($edo == 2){ $edo = "El pedido está Activo, listo para enviarse"; }
if($edo == 3){ $edo = "Ha sido enviado el pedido y se encuenta en camino"; }
if($edo == 4){ $edo = "El pedido ha sido entregado correctamente"; }

Alerts::Mensajex($edo,"success");


$url = "https://justomarket.com/application/src/api.php?op=1&user=".$usuario;

  $this->DatosUsuario($url);

}





public function DetallesUsuario($usuario){
  $db = new dbConn();
$url = "https://justomarket.com/application/src/api.php?op=1&user=".$usuario;
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
// echo $url;
// print_r($datos);

if($datos["direccion"]["recibe_direccion"] != NULL and $datos["direccion"]["recibe_telefono"] != NULL){
echo '<hr><h4>Cliente: <strong>'.$datos["user"]["nombre"].'</strong></h4>';

echo '<div class="text-left">
<h4>Informaci&oacuten General</h4>
<ul class="pl-2">';

if($datos["direccion"]["f_nacimiento"] != NULL){
  echo '<li class="linopunto"><span><strong>Fecha de Nacimientos : </strong></span>'.Fechas::FechaEscrita($datos["direccion"]["f_nacimiento"]).'</li>';
}


echo '<li class="linopunto"><span><strong>Dirección : </strong></span>'.$datos["direccion"]["usr_direccion"].', '.$datos["direccion"]["usr_departamento"].', '.$datos["direccion"]["usr_municipio"].', '.$datos["direccion"]["usr_pais"].'</li>
<li class="linopunto"><span><strong>E-mail : </strong></span><a>'.$datos["user"]["email"].'</a></li>
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

  Alerts::Mensajex("No se encuentran datos del usuario","danger");
}



}








public function EdoOrden($data){
  $db = new dbConn();

    if ($r = $db->select("edo", "ecommerce_data", "WHERE orden = '".$data["orden"]."' and usuario = '".$data["user"]."' and td = ".$_SESSION["td"]."")) { 
        $edo = $r["edo"];
    } unset($r);  

if($edo != 4){
echo '
<input type="hidden" name="user" value="'.$data["user"].'">
<input type="hidden" name="orden" value="'.$data["orden"].'">

  <select class="browser-default custom-select" id="edocambiar" name="edocambiar" aria-label="Cambiar el estado">';

if($edo == 2){
  echo '<option value="3"'; if($edo == 3) echo "selected"; echo '>Enviado</option>
        <option value="4"'; if($edo == 4) echo "selected"; echo '>Entregado</option>';
}
if($edo == 3){
  echo '<option value="4"'; if($edo == 4) echo "selected"; echo '>Entregado</option>';
}
 echo '</select>';

} else {
  Alerts::Mensajex("Orden entregada satisfactoriamente","info");

}

}




public function EdoCambia($data){
  $db = new dbConn();

    $cambio = array();
    $cambio["edo"] = $data["edocambiar"];
    if(Helpers::UpdateId("ecommerce_data", $cambio, "usuario='".$data["user"]."' and orden = ".$data["orden"]." and td = ".$_SESSION["td"]."")){
        Alerts::Alerta("success","Realizado!","Cambio Realizado correctamente");

        Email::EnviarEmail("aerick.nunez@gmail.com", "Erick Nunez", "aerick.nunez@gmail.com", "Justo Market", "Esta es una prueba de envio de email", $plantilla);
    } else {
        Alerts::Alerta("error","Error!!","No se realizo el cambio");
    }

}



public function DelOrden($hash){
  $db = new dbConn();

    $cambio = array();
    $cambio["edo"] = 0;
    if(Helpers::UpdateId("ecommerce_data", $cambio, "hash = '".$hash."' and td = ".$_SESSION["td"]."")){
        Alerts::Alerta("success","Realizado!","Orden Eliminada correctamente");
    } else {
        Alerts::Alerta("error","Error!!","No se realizo el cambio");
    }

    $this->VerTodosLosPedidos(1, "id", "desc");
}



public function MuestraEdo($data){
  $db = new dbConn();

    if ($r = $db->select("edo", "ecommerce_data", "WHERE orden = '".$data["orden"]."' and usuario = '".$data["user"]."' and td = ".$_SESSION["td"]."")) { 
        $edo = $r["edo"];
    } unset($r);  


   echo Helpers::Edoecommerce($edo);
}


public function MuestraEdoBotones($data){
  $db = new dbConn();

    if ($r = $db->select("edo", "ecommerce_data", "WHERE orden = '".$data["orden"]."' and usuario = '".$data["user"]."' and td = ".$_SESSION["td"]."")) { 
        $edo = $r["edo"];
    } unset($r);  

  echo '<a id="xver" op="376" orden="'.$data["orden"].'"><i class="fas fa-search fa-lg green-text"></i></a>';

          if($edo == 2 or $edo == 3){

    echo '<a href="system/facturar/ticket_ecommerce.php?orden='.$data["orden"].'&usr='.$data["user"].'" target="_blank"><i class="fas fa-print fa-lg red-text"></i></a>
          <a id="facturar" op="381" orden="'.$data["orden"].'" user="'.$data["user"].'"><i class="fas fa-ad fa-lg green-text"></i></a>
          <a id="op-edo" orden="'.$data["orden"].'" user="'.$data["user"].'"><i class="fas fa-cogs fa-lg blue-text"></i></a>';
    }

}






  public function Facturar($orden, $user){
       $db = new dbConn();
       $venta = new Ventas();

      $a = $db->query("SELECT * FROM ecommerce WHERE orden = '".$orden."' and usuario = '".$user."' and td = ".$_SESSION["td"]."");
      foreach ($a as $b) {
        $b["cantidad"] = $b["cant"];
          

      $venta->AgregarDesdeEcommerce($b);
      } $a->close();


   }






public function ListarUsuarios(){

$url = "https://justomarket.com/application/src/api.php?op=2";

  $jsondata = $this->ObtenerData($url);
  $datos = json_decode($jsondata, true); 

echo '<h2 class="h2-responsive">LISTADO DE USUARIOS</h2>

<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
<tr>
<th>Nombre</th>
<th class="th-sm">Email</th>
<th class="th-sm">Dirección</th>
<th>Municipio</th>
<th>Telefono</th>
<th>Ver</th>
</tr>
        </thead>
        <tbody>';

for ($i=0; $i < count($datos); $i++) { 
   echo '<tr>
          <td>'.$datos[$i]["nombre"].'</td>
          <td>'.$datos[$i]["email"].'</td>
          <td>'.$datos[$i]["usr_direccion"].'</td>
          <td>'.$datos[$i]["usr_municipio"].'</td>
          <td>'.$datos[$i]["usr_telefono"].'</td>
          <td><a id="veruser" op="383" usuario="'.$datos[$i]["user"].'"><i class="fas fa-search fa-lg green-text"></i></a></td>
        </tr>';
        }
        echo '</tbody>
        </table>
        </div>';






}











  public function VerProductosEcommerce($npagina, $orden, $dir){
      $db = new dbConn();

  $limit = 12;
  $adjacents = 2;
  if($npagina == NULL) $npagina = 1;
  $a = $db->query("SELECT * FROM producto WHERE td = ". $_SESSION['td'] ."");
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

$opx = "384";

 $a = $db->query("SELECT producto.cod, producto.descripcion, producto.cantidad, producto.verecommerce FROM producto WHERE producto.td = ".$_SESSION["td"]." order by ".$orden." ".$dir." limit $offset, $limit");
      
      if($a->num_rows > 0){
          echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th class="th-sm"><a id="paginador" op="'.$opx.'" iden="1" orden="producto.cod" dir="'.$dir2.'">Cod</a></th>
            <th class="th-sm"><a id="paginador" op="'.$opx.'" iden="1" orden="producto.descripcion" dir="'.$dir2.'">Producto</a></th>
            <th class="th-sm"><a id="paginador" op="'.$opx.'" iden="1" orden="producto.cantidad" dir="'.$dir2.'">Cantidad</a></th>
            <th class="th-sm"><a id="paginador" op="'.$opx.'" iden="1" orden="producto.verecommerce" dir="'.$dir2.'">Ecommerce</a></th>
            <th class="th-sm"><a id="paginador" op="'.$opx.'" iden="1" orden="producto.existencia_minima" dir="'.$dir2.'">Imagenes</a></th>
            <th class="th-sm">Ver</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
    if ($r = $db->select("*", "pro_dependiente", "WHERE iden = ".$b["producto"]." and td = ". $_SESSION["td"] ."")) { 
        $producto = $r["nombre"]; } unset($r); 


$ax = $db->query("SELECT imagen FROM producto_imagenes 
  WHERE producto = '".$b["cod"]."' and td = ". $_SESSION["td"] ."");
$img = $ax->num_rows;
$ax->close();

if($b["verecommerce"] == "on"){ $ecoomerce = '<div class="text-success font-weight-bold">Activo</div>'; } else { $ecoomerce = '<div class="text-danger font-weight-bold">Inactivo</div>';}

if($img > 0){ $imgx = '<div class="text-success font-weight-bold">'.$img.' Imagenes</div>'; } else { $imgx = '<div class="text-danger font-weight-bold">Sin Imagenes</div>';}


          echo '<tr>
                      <td>'.$b["cod"].'</td>
                      <td>'.$b["descripcion"].'</td>
                      <td>'.$b["cantidad"].'</td>
                      <td>'.$ecoomerce.'</td>
                      <td>'.$imgx.'</td>
                      <td><a id="xverproducto" op="55" key="'.$b["cod"].'"><i class="fas fa-search fa-lg green-text"></i></a></td>
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
        <a class="page-link" id="paginador" op="'.$opx.'" iden="1" orden="'.$orden.'" dir="'.$dir.'">&lt;&lt;</a>
      </li>';
    
    $page>1 ? $pagina = $page-1 : $pagina = 1;
    echo '<li class="page-item '.$enable.'">
        <a class="page-link" id="paginador" op="'.$opx.'" iden="'.$pagina.'" orden="'.$orden.'" dir="'.$dir.'">&lt;</a>
      </li>';

    for($i=$start; $i<=$end; $i++) {
      $i == $page ? $pagina =  'active' : $pagina = '';
      echo '<li class="page-item '.$pagina.'">
        <a class="page-link" id="paginador" op="'.$opx.'" iden="'.$i.'" orden="'.$orden.'" dir="'.$dir.'">'.$i.'</a>
      </li>';
    }

    $page >= $total_pages ? $enable = 'disabled' : $enable = '';
    $page < $total_pages ? $pagina = ($page+1) : $pagina = $total_pages;
    echo '<li class="page-item '.$enable.'">
        <a class="page-link" id="paginador" op="'.$opx.'" iden="'.$pagina.'" orden="'.$orden.'" dir="'.$dir.'">&gt;</a>
      </li>';

    echo '<li class="page-item '.$enable.'">
        <a class="page-link" id="paginador" op="'.$opx.'" iden="'.$total_pages.'" orden="'.$orden.'" dir="'.$dir.'">&gt;&gt;</a>
      </li>

      </ul>';
     }  // end pagination 

  } // termina productos






public function CategoriasPronombre(){
  $db = new dbConn();

 $a = $db->query("SELECT * FROM producto_categoria_sub WHERE td = ".$_SESSION["td"]."");
      
      if($a->num_rows > 0){

echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
<tr>
<th>Categoria</th>
<th>Pronombre</th>
<th>Img</th>
<th>Ver</th>
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

if($b["img"] == NULL){
  $img = '<a id="addimg" hash="'.$b["hash"].'" op="387"><i class="fas fa-plus fa-lg blue-text"></i></a>';
} else {
    $img = '<a id="c_pronombre" hash="'.$b["hash"].'" cat="'.$b["subcategoria"].'"><i class="fas fa-refresh fa-lg green-text"></i></a>';
}


   echo '<tr>
          <td>'.$b["subcategoria"].'</td>
          <td>'.$b["pronombre"].'</td>
          <td>'.$img.'</td>
          <td><a id="c_pronombre" hash="'.$b["hash"].'" cat="'.$b["subcategoria"].'"><i class="fas fa-cogs fa-lg blue-text"></i></a></td>
        </tr>';
        }
        echo '</tbody>
        </table>
        </div>';
      }
        $a->close();

}





public function UpdateCat($data){
  $db = new dbConn();

  $cambio = array();
  $cambio["pronombre"] = $data["pronombre"];
  if(Helpers::UpdateId("producto_categoria_sub", 
    $cambio, "hash='".$data["hash"]."' and td = ".$_SESSION["td"]."")){
    Alerts::Alerta("success","Realizado","Cambio Realizado Correctamente");
  } else {
    Alerts::Alerta("error","Error!","Ocurrió un error!");
  }

  $this->CategoriasPronombre();

}



public function VerImagenCategoria($data){
  $db = new dbConn();

print_r($data);

}












} // Termina la clase
?>