<?php 
class Imprime {

		public function __construct() { 
     	} 




  public function TodosProductos(){
      $db = new dbConn();

 $a = $db->query("SELECT producto.cod, producto.descripcion, producto.cantidad, producto.existencia_minima, producto_categoria_sub.subcategoria FROM producto INNER JOIN producto_categoria_sub ON producto.categoria = producto_categoria_sub.hash and producto.td = ".$_SESSION["td"]."");
      
      if($a->num_rows > 0){
          echo '<table class="table table-sm table-striped">
        <thead>
          <tr>
            <th class="th-sm"></th>
            <th class="th-sm">Producto</th>
            <th class="th-sm">Cantidad</th>
            <th class="th-sm">Categoria</th>
            <th class="th-sm d-none d-md-block">Minimo</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
    if ($r = $db->select("*", "pro_dependiente", "WHERE iden = ".$b["producto"]." and td = ". $_SESSION["td"] ."")) { 
        $producto = $r["nombre"]; } unset($r); 

          echo '<tr>
                      <td>'.$b["cod"].'</td>
                      <td>'.$b["descripcion"].'</td>
                      <td>'.$b["cantidad"].'</td>
                      <td>'.$b["subcategoria"].'</td>
                      <td class="d-none d-md-block">'.$b["existencia_minima"].'</td>
                    </tr>';
        }
        echo '</tbody>
        </table>';
      }
        $a->close();
  } // termina productos












  public function BajasExistencias(){
      $db = new dbConn();

 $a = $db->query("SELECT producto.cod, producto.descripcion, producto.cantidad, producto.existencia_minima, producto_categoria_sub.subcategoria FROM producto INNER JOIN producto_categoria_sub ON producto.categoria = producto_categoria_sub.hash and producto.cantidad <= producto.existencia_minima and producto.td = ".$_SESSION["td"]."");
      
      if($a->num_rows > 0){
          echo '<table class="table table-sm table-striped">
        <thead>
          <tr>
            <th class="th-sm"></th>
            <th class="th-sm">Producto</th>
            <th class="th-sm">Cantidad</th>
            <th class="th-sm">Categoria</th>
            <th class="th-sm d-none d-md-block">Minimo</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
    if ($r = $db->select("*", "pro_dependiente", "WHERE iden = ".$b["producto"]." and td = ". $_SESSION["td"] ."")) { 
        $producto = $r["nombre"]; } unset($r); 

          echo '<tr>
                      <td>'.$b["cod"].'</td>
                      <td>'.$b["descripcion"].'</td>
                      <td>'.$b["cantidad"].'</td>
                      <td>'.$b["subcategoria"].'</td>
                      <td class="d-none d-md-block">'.$b["existencia_minima"].'</td>
                    </tr>';
        }
        echo '</tbody>
        </table>';
      }
        $a->close();
  } // termina productos







  public function ProductosResumen(){
      $db = new dbConn();


 $a = $db->query("SELECT producto.cod, producto.descripcion, producto.cantidad, producto.existencia_minima, producto_categoria_sub.subcategoria FROM producto INNER JOIN producto_categoria_sub ON producto.categoria = producto_categoria_sub.hash and producto.td = ".$_SESSION["td"]."");
      
      if($a->num_rows > 0){
          echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th>Producto</th>
            <th class="th-sm">Producto</th>
            <th class="th-sm">Cantidad</th>
            <th class="th-sm">Precio Venta</th>
            <th class="th-sm ">Vendidos</th>
          </tr>
        </thead>
        <tbody>';
        $n = 0;
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
    if ($r = $db->select("precio", "producto_precio", "WHERE producto = ".$b["cod"]." and td = ". $_SESSION["td"] ." order by id desc limit 1")) { 
        $precio = $r["precio"]; } unset($r); 

    $ax = $db->query("SELECT count(cant) FROM ticket WHERE cod = '".$b["cod"]."' and td = ". $_SESSION["td"] ."");
    foreach ($ax as $bx) {
        $vendidos=$bx["count(cant)"];
    } $ax->close();

          echo '<tr>
                      <td>'.$n++.'</td>
                      <td>'.$b["descripcion"].'</td>
                      <td>'.$b["cantidad"].'</td>
                      <td>'.Helpers::Dinero($precio).'</td>
                      <td>'.$vendidos.'</td>
                    </tr>';
        }
        echo '</tbody>
        </table>
        </div>';
      }
        $a->close();


  } // termina productos




} // Termina la clase
?>