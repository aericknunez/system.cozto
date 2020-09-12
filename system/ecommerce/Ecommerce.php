<?php 
class EcommerceData{

		public function __construct() { 
     	} 




  public function Destacados($limit, $td, $orderby){
      $db = new dbConn();

 $a = $db->query("SELECT producto.cod, producto.descripcion, producto.informacion, producto.cantidad, producto.existencia_minima, producto_categoria_sub.subcategoria, producto.promocion, producto_unidades.nombre as medida FROM producto INNER JOIN producto_categoria_sub ON producto.categoria = producto_categoria_sub.hash INNER JOIN producto_unidades ON producto.medida = producto_unidades.hash and producto.td = ". $td ." and producto.verecommerce = 'on' order by ".$orderby." ". $limit ."");
      
      if($a->num_rows > 0){

      $data = array();
      $n= 0;
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
        if ($r = $db->select("precio", "producto_precio", "WHERE producto = ".$b["cod"]." and td = ". $td ." order by id desc limit 1")) { 
            $precio = $r["precio"]; } unset($r); 


        if ($r = $db->select("precio", "producto_precio_promo", "WHERE producto = ".$b["cod"]." and td = ". $td ."")) { 
            $promo = $r["precio"]; } unset($r); 


            // obtener las imagenes
          $imagenes = array();
         
          $x = $db->query("SELECT imagen FROM producto_imagenes WHERE producto = '".$b["cod"]."' and td = ". $td ."");
            foreach ($x as $z) {
                 $imagenes[] = $z["imagen"];
            } $x->close();



        $data["productos"][] = $b;
        $data["productos"][$n]["imagenes"] =  $imagenes;
        if($data["productos"][$n]["imagenes"] == NULL){
          $data["productos"][$n]["imagenes"] = ["default.png"];
        }
        $data["productos"][$n]["precio"] =  $precio;
        $data["productos"][$n]["promo"] =  $promo;

        unset($promo);

$n++;

        }

echo json_encode($data);

  }


  $a->close();


  } // termina productos









  public function Categorias($limit, $td, $orderby, $categoria){
      $db = new dbConn();

        // obtener el detalle de la categoria
if ($r = $db->select("hash", "producto_categoria_sub", "WHERE pronombre = '".$categoria."' and td = ". $td ."")) { $categoriax = $r["hash"]; } unset($r); 

 $a = $db->query("SELECT producto.cod, producto.descripcion, producto.informacion, producto.cantidad, producto.existencia_minima, producto_categoria_sub.subcategoria, producto.promocion, producto_unidades.nombre as medida FROM producto INNER JOIN producto_categoria_sub ON producto.categoria = producto_categoria_sub.hash INNER JOIN producto_unidades ON producto.medida = producto_unidades.hash and producto.categoria = '". $categoriax ."' and producto.verecommerce = 'on' and producto.td = ". $td ." order by ".$orderby." ". $limit ."");
      
      if($a->num_rows > 0){

      $data = array();
      $n= 0;
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
        if ($r = $db->select("precio", "producto_precio", "WHERE producto = ".$b["cod"]." and td = ". $td ." order by id asc limit 1")) { 
            $precio = $r["precio"]; } unset($r); 


/// precio promo
        if ($r = $db->select("precio", "producto_precio_promo", "WHERE producto = ".$b["cod"]." and td = ". $td ."")) { 
            $promo = $r["precio"]; } unset($r); 

            // obtener las imagenes
          $imagenes = array();
         
          $x = $db->query("SELECT imagen FROM producto_imagenes WHERE producto = '".$b["cod"]."' and td = ". $td ."");
            foreach ($x as $z) {
                 $imagenes[] = $z["imagen"];
            } $x->close();



        $data["productos"][] = $b;
        $data["productos"][$n]["imagenes"] =  $imagenes;
        if($data["productos"][$n]["imagenes"] == NULL){
          $data["productos"][$n]["imagenes"] = ["default.png"];
        }
        $data["productos"][$n]["precio"] =  $precio;
        $data["productos"][$n]["promo"] =  $promo;

        unset($promo);

$n++;

        }

echo json_encode($data);

  }


  $a->close();


  } // termina categorias










  public function Promociones($limit, $td, $orderby){
      $db = new dbConn();


 $a = $db->query("SELECT producto.cod, producto.descripcion, producto.informacion, producto.cantidad, producto.existencia_minima, producto_categoria_sub.subcategoria, producto.promocion, producto_unidades.nombre as medida FROM producto INNER JOIN producto_categoria_sub ON producto.categoria = producto_categoria_sub.hash INNER JOIN producto_unidades ON producto.medida = producto_unidades.hash and producto.promocion = 'on' and producto.verecommerce = 'on' and producto.td = ". $td ." order by ".$orderby." ". $limit ."");
      
      if($a->num_rows > 0){

      $data = array();
      $n= 0;
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
        if ($r = $db->select("precio", "producto_precio", "WHERE producto = ".$b["cod"]." and td = ". $td ." order by id asc limit 1")) { 
            $precio = $r["precio"]; } unset($r); 


       if ($r = $db->select("precio", "producto_precio_promo", "WHERE producto = ".$b["cod"]." and td = ". $td ."")) { 
            $promo = $r["precio"]; } unset($r); 


            // obtener las imagenes
          $imagenes = array();
         
          $x = $db->query("SELECT imagen FROM producto_imagenes WHERE producto = '".$b["cod"]."' and td = ". $td ."");
            foreach ($x as $z) {
                 $imagenes[] = $z["imagen"];
            } $x->close();



        $data["productos"][] = $b;
        $data["productos"][$n]["imagenes"] =  $imagenes;
        if($data["productos"][$n]["imagenes"] == NULL){
          $data["productos"][$n]["imagenes"] = ["default.png"];
        }
        $data["productos"][$n]["precio"] =  $precio;
        $data["productos"][$n]["promo"] =  $promo;

        unset($promo);

$n++;

        }

echo json_encode($data);

  }


  $a->close();


  } // termina productos









  public function Producto($cod, $td){
      $db = new dbConn();


 $a = $db->query("SELECT producto.cod, producto.descripcion, producto.informacion, producto.cantidad, producto.existencia_minima, producto_categoria_sub.subcategoria, producto.promocion, producto_unidades.nombre as medida FROM producto INNER JOIN producto_categoria_sub ON producto.categoria = producto_categoria_sub.hash INNER JOIN producto_unidades ON producto.medida = producto_unidades.hash and producto.verecommerce = 'on' and producto.cod = '".$cod."' and producto.td = ". $td ."");
      
      if($a->num_rows > 0){

      $data = array();
      $n= 0;
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
        if ($r = $db->select("precio", "producto_precio", "WHERE producto = ".$b["cod"]." and td = ". $td ." order by id asc limit 1")) { 
            $precio = $r["precio"]; } unset($r); 

        if ($r = $db->select("precio", "producto_precio_promo", "WHERE producto = ".$b["cod"]." and td = ". $td ."")) { 
            $promo = $r["precio"]; } unset($r); 


            // obtener las imagenes
          $imagenes = array();
         
          $x = $db->query("SELECT imagen FROM producto_imagenes WHERE producto = '".$b["cod"]."' and td = ". $td ."");
            foreach ($x as $z) {
                 $imagenes[] = $z["imagen"];
            } $x->close();



        $data = $b;
        $data["imagenes"] =  $imagenes;
        if($data["imagenes"] == NULL){
          $data["imagenes"] = ["default.png"];
        }
        $data["precio"] =  $precio;
        $data["promo"] =  $promo;

        unset($promo);
$n++;

        }

echo json_encode($data);

  }


  $a->close();


  } // termina productos















  public function Busqueda($limit, $td, $orderby, $search){
      $db = new dbConn();



 $a = $db->query("SELECT producto.cod, producto.descripcion, producto.informacion, producto.cantidad, producto.existencia_minima, producto.promocion, producto_unidades.nombre as medida FROM producto INNER JOIN producto_unidades ON producto.medida = producto_unidades.hash and (producto.descripcion like '%". $search ."%' or producto.informacion like '%". $search ."%') and producto.verecommerce = 'on' and producto.td = ". $td ." order by ".$orderby." ". $limit ."");
      
      if($a->num_rows > 0){

      $data = array();
      $n= 0;
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
        if ($r = $db->select("precio", "producto_precio", "WHERE producto = ".$b["cod"]." and td = ". $td ." order by id asc limit 1")) { 
            $precio = $r["precio"]; } unset($r); 


/// precio promo
        if ($r = $db->select("precio", "producto_precio_promo", "WHERE producto = ".$b["cod"]." and td = ". $td ."")) { 
            $promo = $r["precio"]; } unset($r); 

            // obtener las imagenes
          $imagenes = array();
         
          $x = $db->query("SELECT imagen FROM producto_imagenes WHERE producto = '".$b["cod"]."' and td = ". $td ."");
            foreach ($x as $z) {
                 $imagenes[] = $z["imagen"];
            } $x->close();



        $data["productos"][] = $b;
        $data["productos"][$n]["imagenes"] =  $imagenes;
        if($data["productos"][$n]["imagenes"] == NULL){
          $data["productos"][$n]["imagenes"] = ["default.png"];
        }
        $data["productos"][$n]["precio"] =  $precio;
        $data["productos"][$n]["promo"] =  $promo;

        unset($promo);

$n++;

        }

echo json_encode($data);

  }


  $a->close();


  } // termina categorias























  public function ObtenerTotal($data, $td){
      $db = new dbConn();

      $a = $db->query("SELECT sum(total) FROM ecommerce WHERE orden = '".$data["orden"]."' and usuario = '".$data["usuario"]."' and td = ".$td."");
        foreach ($a as $b) {
         $total = $b["sum(total)"];
        } $a->close();


    $datos = array();
    $datos["total"] =  $total;

  echo json_encode($datos);


  } // termina total






  public function ContenidoCarrito($data){
      $db = new dbConn();

$datos = array();
$n = 0;
    $a = $db->query("SELECT id, cod, cant, producto, pv, stotal, imp, total, descuento FROM ecommerce WHERE usuario = '".$data["usr"]."' and orden = '".$data["orden"]."' and td = '".$data["td"]."'");
    foreach ($a as $b) {
        $datos["productos"][] = $b;

        /// imagen
        if ($r = $db->select("imagen", "producto_imagenes", "WHERE producto = '".$b["cod"]."' and td = '".$data["td"]."' limit 1")) { 
              $imagen = $r["imagen"];
        } unset($r);  
        $datos["productos"][$n]["imagen"] =  $imagen;
        /// 

        /// promo??
        if ($r = $db->select("promocion", "producto", "WHERE cod = '".$b["cod"]."' and td = '".$data["td"]."' limit 1")) { 
              $promo = $r["promocion"];
        } unset($r);  
        $datos["productos"][$n]["promocion"] =  $promo;
        /// 

        $n++;
    }

    $a->close();

  echo json_encode($datos);


  } // termina total



  public function BorrarItem($data, $td, $iden){ // borro un item del carrito
      $db = new dbConn();

    Helpers::DeleteId("ecommerce", "usuario='".$data["usuario"]."' and orden='".$data["orden"]."' and td = ".$td." and id = '".$iden."'");

    if($this->CantidadProductos($data["orden"], $data["usuario"], $td) == 0){

      Helpers::DeleteId("ecommerce_data", "usuario='".$data["usuario"]."' and orden='".$data["orden"]."' and td = ".$td."");
    }
}


  public function CantidadProductos($orden, $usuario, $td) { // obtine cantiad de productos
    $db = new dbConn();

  if ($r = $db->select("COUNT(*)", "ecommerce", "WHERE usuario = ".$usuario." and orden = ".$orden." and td = ".$td."")){ 
        return $r["COUNT(*)"];
      } unset($r); 
}





  public function UserUpdate($data, $td){ // reemplazo el usuario temporal por el del  usuario registrado
      $db = new dbConn();
// debo comprobar si  hay alguna orden sin procesar
    if ($r = $db->select("orden", "ecommerce_data", "WHERE edo = 1 and usuario='".$data["usuario"]."' and td = ".$td."")) { 
        $orden = $r["orden"];
    } unset($r);  



if($orden != NULL){

$cambio = array();
$cambio["usuario"] = $data["user"];
Helpers::UpdateId("ecommerce", $cambio, "usuario='".$data["usuario"]."' and td = ".$td."");


$cambios = array();
$cambios["usuario"] = $data["user"];
Helpers::UpdateId("ecommerce_data", $cambios, "usuario='".$data["usuario"]."' and td = ".$td."");


/// obtener el ultimo numero de orden
// $a = $db->query("SELECT orden FROM ecommerce_data WHERE usuario='".$data["user"]."' and td = ".$td." order by id desc limit 1");
// foreach ($a as $b) {
// $orden = $b["orden"];
// } $a->close();

/// pasar a una sola orden todos los producto
$a = $db->query("SELECT hash FROM ecommerce_data WHERE usuario='".$data["user"]."' and td = ".$td." and edo = 1");
foreach ($a as $b) {

$cambios = array();
$cambios["orden"] = $orden;
Helpers::UpdateId("ecommerce_data", $cambios, "usuario='".$data["user"]."' and td = ".$td." and hash=".$b["hash"]."");

$cambio = array();
$cambio["orden"] = $orden;
Helpers::UpdateId("ecommerce", $cambio, "orden = '$orden' and usuario='".$data["user"]."' and td = ".$td."");


} $a->close();


    Helpers::DeleteId("ecommerce_data", "usuario='".$data["user"]."' and td = ".$td." and orden != '".$orden."' and edo = 1");

}// termina comprobacion si hay orden sin completar


    $datos = array();
    $datos["orden"] =  $orden;

  echo json_encode($datos);


  } // termina total











  public function FinalizarPedido($data, $td){
      $db = new dbConn();

    $datos = array();

    $cambio = array();
    $cambio["edo"] = 2;
    if(Helpers::UpdateId("ecommerce_data", $cambio, "usuario='".$data["usr"]."' and orden='".$data["orden"]."' and td = ".$td."")){
        $datos["mensaje"] =  "Realizado";
    } else {
        $datos["mensaje"] =  "Fallido";
    }

  echo json_encode($datos);

  } // termina total












  public function OrdenesCliente($usuario, $td){
      $db = new dbConn();

 $a = $db->query("SELECT usuario, orden, fecha, hora, fechaF, edo FROM ecommerce_data WHERE usuario = '$usuario' and td = '$td' order by id desc");
      
      if($a->num_rows > 0){

      $data = array();
      $n= 0;
        foreach ($a as $b) {

            // obtener los productos
          $producto = array();
         
          $x = $db->query("SELECT cod, cant, producto, pv, total, orden FROM ecommerce WHERE usuario = '$usuario' and orden = '".$b["orden"]."' and td = ". $td ."");
            foreach ($x as $z) {
                 $producto[] = $z;
            } $x->close();



        $data["ordenes"][] = $b;
        $data["ordenes"][$n]["producto"] =  $producto;


$n++;

        }

echo json_encode($data);

  }


  $a->close();


  } // termina productos




 public function TotalProductosCliente($usuario, $td){
      $db = new dbConn();

      $a = $db->query("SELECT sum(cant) FROM ecommerce WHERE usuario = '".$usuario."' and  td = ".$td."");
        foreach ($a as $b) {
         $total = $b["sum(cant)"];
        } $a->close();


    $datos = array();
    $datos["total"] =  $total;

  echo json_encode($datos);


  } // termina total





 public function TotalOrdenesCliente($usuario, $td){
      $db = new dbConn();

      $a = $db->query("SELECT * FROM ecommerce_data WHERE usuario = '".$usuario."' and  td = ".$td."");
         $total = $a->num_rows;
         $a->close();


    $datos = array();
    $datos["total"] =  $total;

  echo json_encode($datos);


  } // termina total






  public function ObtenerOrdenNo($user, $td){
      $db = new dbConn();

      $a = $db->query("SELECT orden FROM ecommerce_data WHERE edo = 1 and usuario = '".$user."' and td = ".$td."");
        foreach ($a as $b) {
         $orden = $b["orden"];
        } $a->close();


    $datos = array();
    $datos["orden"] =  $orden;

  echo json_encode($datos);


  } // termina total






} // Termina la lcase
?>