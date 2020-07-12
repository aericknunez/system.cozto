<?php 
class EcommerceData{

		public function __construct() { 
     	} 






  public function Destacados($limit, $td, $orderby){
      $db = new dbConn();

 $a = $db->query("SELECT producto.cod, producto.descripcion, producto.informacion, producto.cantidad, producto.existencia_minima, producto_categoria_sub.subcategoria, producto_unidades.nombre as medida FROM producto INNER JOIN producto_categoria_sub ON producto.categoria = producto_categoria_sub.hash INNER JOIN producto_unidades ON producto.medida = producto_unidades.hash and producto.td = ". $td ." order by '$orderby' ". $limit ."");
      
      if($a->num_rows > 0){

      $data = array();
      $n= 0;
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
        if ($r = $db->select("precio", "producto_precio", "WHERE producto = ".$b["cod"]." and td = ". $td ." order by id desc limit 1")) { 
            $precio = $r["precio"]; } unset($r); 

            // obtener las imagenes
          $imagenes = array();
         
          $x = $db->query("SELECT imagen FROM producto_imagenes WHERE producto = '".$b["cod"]."' and td = ". $td ."");
            foreach ($x as $z) {
                 $imagenes[] = $z["imagen"];
            } $x->close();



        $data["productos"][] = $b;
        $data["productos"][$n]["imagenes"] =  $imagenes;
        $data["productos"][$n]["precio"] =  $precio;

$n++;

        }

echo json_encode($data);

  }


  $a->close();


  } // termina productos









  public function Categorias($limit, $td, $orderby, $categoria){
      $db = new dbConn();

$catx = strtoupper($categoria);
        // obtener el detalle de la categoria
if ($r = $db->select("hash", "producto_categoria_sub", "WHERE subcategoria = '".$catx."' and td = ". $td ."")) { $categoria = $r["hash"]; } unset($r); 

 $a = $db->query("SELECT producto.cod, producto.descripcion, producto.informacion, producto.cantidad, producto.existencia_minima, producto_categoria_sub.subcategoria, producto_unidades.nombre as medida FROM producto INNER JOIN producto_categoria_sub ON producto.categoria = producto_categoria_sub.hash INNER JOIN producto_unidades ON producto.medida = producto_unidades.hash and producto.categoria = '". $categoria ."' and producto.td = ". $td ." order by '$orderby' ". $limit ."");
      
      if($a->num_rows > 0){

      $data = array();
      $n= 0;
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
        if ($r = $db->select("precio", "producto_precio", "WHERE producto = ".$b["cod"]." and td = ". $td ." order by id desc limit 1")) { 
            $precio = $r["precio"]; } unset($r); 

            // obtener las imagenes
          $imagenes = array();
         
          $x = $db->query("SELECT imagen FROM producto_imagenes WHERE producto = '".$b["cod"]."' and td = ". $td ."");
            foreach ($x as $z) {
                 $imagenes[] = $z["imagen"];
            } $x->close();



        $data["productos"][] = $b;
        $data["productos"][$n]["imagenes"] =  $imagenes;
        $data["productos"][$n]["precio"] =  $precio;

$n++;

        }

echo json_encode($data);

  }


  $a->close();


  } // termina categorias










  public function Promociones($limit, $td, $orderby){
      $db = new dbConn();


 $a = $db->query("SELECT producto.cod, producto.descripcion, producto.informacion, producto.cantidad, producto.existencia_minima, producto_categoria_sub.subcategoria, producto_unidades.nombre as medida FROM producto INNER JOIN producto_categoria_sub ON producto.categoria = producto_categoria_sub.hash INNER JOIN producto_unidades ON producto.medida = producto_unidades.hash and producto.promocion = 'on' and producto.td = ". $td ." order by '$orderby' ". $limit ."");
      
      if($a->num_rows > 0){

      $data = array();
      $n= 0;
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
        if ($r = $db->select("precio", "producto_precio", "WHERE producto = ".$b["cod"]." and td = ". $td ." order by id desc limit 1")) { 
            $precio = $r["precio"]; } unset($r); 

            // obtener las imagenes
          $imagenes = array();
         
          $x = $db->query("SELECT imagen FROM producto_imagenes WHERE producto = '".$b["cod"]."' and td = ". $td ."");
            foreach ($x as $z) {
                 $imagenes[] = $z["imagen"];
            } $x->close();



        $data["productos"][] = $b;
        $data["productos"][$n]["imagenes"] =  $imagenes;
        $data["productos"][$n]["precio"] =  $precio;

$n++;

        }

echo json_encode($data);

  }


  $a->close();


  } // termina productos









  public function Producto($cod, $td){
      $db = new dbConn();


 $a = $db->query("SELECT producto.cod, producto.descripcion, producto.informacion, producto.cantidad, producto.existencia_minima, producto_categoria_sub.subcategoria, producto_unidades.nombre as medida FROM producto INNER JOIN producto_categoria_sub ON producto.categoria = producto_categoria_sub.hash INNER JOIN producto_unidades ON producto.medida = producto_unidades.hash and producto.cod = '".$cod."' and producto.td = ". $td ."");
      
      if($a->num_rows > 0){

      $data = array();
      $n= 0;
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
        if ($r = $db->select("precio", "producto_precio", "WHERE producto = ".$b["cod"]." and td = ". $td ." order by id desc limit 1")) { 
            $precio = $r["precio"]; } unset($r); 

            // obtener las imagenes
          $imagenes = array();
         
          $x = $db->query("SELECT imagen FROM producto_imagenes WHERE producto = '".$b["cod"]."' and td = ". $td ."");
            foreach ($x as $z) {
                 $imagenes[] = $z["imagen"];
            } $x->close();



        $data = $b;
        $data["imagenes"] =  $imagenes;
        $data["precio"] =  $precio;

$n++;

        }

echo json_encode($data);

  }


  $a->close();


  } // termina productos

















} // Termina la lcase
?>