<?php 
class Herramientas {

// herramientas a contener
// Eliminar producto la durante el dia de ingreso y si no ha vendido
// Opciones de cambio rapido para los productos
// agredado rapido de productos





  public function AddProducto($datos){ // lo que viede del formulario principal
    $db = new dbConn();
    if($this->CompCod($datos["cod"]) == TRUE){
      if($this->CompruebaForm($datos) == TRUE){ // comprueba si todos los datos requeridos estan llenos
// categoria
 if ($r = $db->select("hash", "producto_categoria_sub", "WHERE td = ". $_SESSION["td"] ." order by id desc limit 1")) { 
        $categoria = $r["hash"]; } unset($r); 

// unidad de medida
 if ($r = $db->select("hash", "producto_unidades", "WHERE td = ". $_SESSION["td"] ." order by id desc limit 1")) { 
        $medida = $r["hash"]; } unset($r); 
// proveedor
 if ($r = $db->select("hash", "proveedores", "WHERE td = ". $_SESSION["td"] ." order by id desc limit 1")) { 
        $proveedor = $r["hash"]; } unset($r); 



                
                if($datos["caduca_submit"] != NULL){ $data["caduca"] = "on"; } else { $data["caduca"] = 0;}

                $data["cod"] = $datos["cod"];
                $data["categoria"] = $categoria;
                $data["medida"] = $medida;
                $data["proveedor"] = $proveedor;
                $data["cantidad"] = $datos["cantidad"];
                $data["gravado"] = "on";
                $data["receta"] = 0;
                $data["servicio"] = 0;
                $data["compuesto"] = 0;
                $data["dependiente"] = 0;
                $data["promocion"] = 0;
                $data["verecommerce"] = 0;
                $data["descripcion"] = strtoupper($datos["descripcion"]);
                $data["hash"] = Helpers::HashId();
                $data["time"] = Helpers::TimeId();
                $data["td"] = $_SESSION["td"];
              if ($db->insert("producto", $data)) {


                $insert["producto"] = $datos["cod"];
                $insert["cant"] = 1;
                $insert["precio"] = $datos["precio"];
                $insert["hash"] = Helpers::HashId();
                $insert["time"] = Helpers::TimeId();
                $insert["td"] = $_SESSION["td"];
                $db->insert("producto_precio", $insert);

                
                if($datos["cantidad"] > 0){
                  $datox["producto"] = $datos["cod"];
                  $datox["cantidad"] = $datos["cantidad"];
                  $datox["precio_costo"] = $datos["precio_costo"];
                  $datox["caduca_submit"] = $datos["caduca_submit"];
                  $this->IngresarProducto($datox);
                }
                
                  
               

              } else {
                Alerts::Alerta("error","Error!","No se agrego el producto!");
              }          
      } else {
        Alerts::Alerta("error","Error!","Faltan Datos!");
      }

    } else {
      Alerts::Alerta("error","Error!","El codigo del producto ya existe!");
    }

   $this->UltimosProductos();

  }






 public function CompCod($codigo){
$db = new dbConn();

$a = $db->query("SELECT * FROM producto WHERE cod = '".$codigo."' and td = ".$_SESSION["td"]."");
$cantcod = $a->num_rows;
$a->close();

    if($cantcod > 0){
       return FALSE;
    } else {
      return TRUE;
    }
 }



  public function CompruebaForm($datos){

        if($datos["cod"] == NULL or
          $datos["descripcion"] == NULL or
          $datos["precio"] == NULL){
          return FALSE;
        } else {
         return TRUE;
        }
  }








  public function IngresarProducto($datox){ // ingresa un nuevo lote de productos
      $db = new dbConn();
            // debo actualizar el total (cantidad) de producto
                                
          $datos = array();
          $datos["producto"] = $datox["producto"];
          $datos["cant"] = $datox["cantidad"];
          $datos["existencia"] = $datox["cantidad"];
          $datos["precio_costo"] = $datox["precio_costo"];
          $datos["caduca"] = $datox["caduca_submit"];
          $datos["caducaF"] = Fechas::Format($datox["caduca_submit"]);
          $datos["comentarios"] = "Producto de inicio de inventario";
          $datos["fecha"] = date("d-m-Y");
          $datos["hora"] = date("H:i:s");
          $datos["td"] = $_SESSION["td"];
          $datos["hash"] = Helpers::HashId();
          $datos["time"] = Helpers::TimeId();
          $db->insert("producto_ingresado", $datos);


 if ($r = $db->select("hash", "ubicacion", "WHERE predeterminada = 1 and td = ". $_SESSION["td"] ."")) { 
        $hash = $r["hash"]; } unset($r); 

          $data = array();
          $data["ubucacion"] =  $hash;
          $data["producto"] = $datox["producto"];
          $data["cant"] = $datox["cantidad"];
          $data["td"] = $_SESSION["td"];
          $data["hash"] = Helpers::HashId();
          $data["time"] = Helpers::TimeId();
          $db->insert("ubicacion_asig", $data);


  }








  public function UltimosProductos(){
      $db = new dbConn();


 $a = $db->query("SELECT * FROM producto WHERE td = ".$_SESSION["td"]." order by id DESC limit 10");
      
      if($a->num_rows > 0){
          echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th>Cod</a></th>
            <th>Descripcion</a></th>
            <th>Cantidad</a></th>
            <th>Precio Costo</a></th>
            <th>Precio Venta</th>
            <th>Caducidad</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
 if ($r = $db->select("precio", "producto_precio", "WHERE producto = ".$b["cod"]." and td = ". $_SESSION["td"] ."")) { 
        $precio = $r["precio"]; } unset($r); 

 if ($r = $db->select("precio_costo, caduca", "producto_ingresado", "WHERE producto = ".$b["cod"]." and td = ". $_SESSION["td"] ."")) { 
        $precio_costo = $r["precio_costo"]; 
        $caduca = $r["caduca"];} unset($r); 

          echo '<tr>
                      <td>'.$b["cod"].'</td>
                      <td>'.$b["descripcion"].'</td>
                      <td>'.$b["cantidad"].'</td>
                      <td>'.$precio_costo.'</td>
                      <td>'.$precio.'</td>
                      <td>'.$caduca.'</td>
                      <td><a id="delpro" op="561" iden="'.$b["cod"].'"> <i class="fas fa-trash fa-lg red-text ml-3"></i></a></td>
                    </tr>';
        }
        echo '</tbody>
        </table>
        </div>';


      }
        $a->close();


  } // termina productos
















  public function DelProducto($cod){ // esta funcion elimina permanentemente el producto
      $db = new dbConn();
        if (Helpers::DeleteId("producto", "cod='$cod'")) {

          Helpers::DeleteId("caracteristicas_asig", "producto='$cod' and td = ". $_SESSION["td"] ."");
          Helpers::DeleteId("producto_averias", "producto='$cod' and td = ". $_SESSION["td"] ."");
          Helpers::DeleteId("producto_compuestos", "producto='$cod' and td = ". $_SESSION["td"] ."");
          Helpers::DeleteId("producto_dependiente", "producto='$cod' and td = ". $_SESSION["td"] ."");
          Helpers::DeleteId("producto_ingresado", "producto='$cod' and td = ". $_SESSION["td"] ."");
          Helpers::DeleteId("producto_precio", "producto='$cod' and td = ". $_SESSION["td"] ."");
          Helpers::DeleteId("producto_precio_mayorista", "producto='$cod' and td = ". $_SESSION["td"] ."");
          Helpers::DeleteId("producto_precio_promo", "producto='$cod' and td = ". $_SESSION["td"] ."");
          Helpers::DeleteId("producto_tags", "producto='$cod' and td = ". $_SESSION["td"] ."");
          Helpers::DeleteId("ubicacion_asig", "producto='$cod' and td = ". $_SESSION["td"] ."");


      $a = $db->query("SELECT imagen FROM producto_imagenes WHERE producto='$cod' and td = ". $_SESSION["td"] ."");
      foreach ($a as $b) {
          if(Helpers::DeleteId("producto_imagenes", "producto='$cod' and td = ". $_SESSION["td"] ."")){
              if (file_exists("../../assets/img/productos/" . $_SESSION["td"] . "/" . $b["imagen"])) { unlink("../../assets/img/productos/" . $_SESSION["td"] . "/" . $b["imagen"]); }
          }
      } $a->close();

           Alerts::Alerta("success","Eliminado!","Precio eliminado correctamente!");
        } else {
            Alerts::Alerta("error","Error!","Algo Ocurrio!");
        } 

      $this->UltimosProductos();

  }
















  public function TodosProductosOpciones($npagina, $orden, $dir){
      $db = new dbConn();

  $limit = 25;
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

$op="562";

 $a = $db->query("SELECT producto.cod, producto.descripcion, producto.cantidad, producto.existencia_minima, producto_categoria_sub.subcategoria FROM producto INNER JOIN producto_categoria_sub ON producto.categoria = producto_categoria_sub.hash and producto.td = ".$_SESSION["td"]." order by ".$orden." ".$dir." limit $offset, $limit");
      
      if($a->num_rows > 0){
          echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="producto.cod" dir="'.$dir2.'">Cod</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="producto.descripcion" dir="'.$dir2.'">Producto</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="producto.cantidad" dir="'.$dir2.'">Cantidad</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="producto.categoria" dir="'.$dir2.'">Categoria</a></th>
            <th class="th-sm">Precio</th>
            <th class="th-sm">Ver</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
    if ($r = $db->select("*", "pro_dependiente", "WHERE iden = ".$b["producto"]." and td = ". $_SESSION["td"] ."")) { 
        $producto = $r["nombre"]; } unset($r); 


 if ($r = $db->select("precio", "producto_precio", "WHERE producto = ".$b["cod"]." and td = ". $_SESSION["td"] ."")) { 
        $precio = $r["precio"]; } unset($r); 


          echo '<tr>
                      <td>'.$b["cod"].'</td>
                      <td>'.$b["descripcion"].'</td>
                      <td>'.$b["cantidad"].'</td>
                      <td>'.$b["subcategoria"].'</td>
                      <td>'.$precio.'</td>
                      <td><a id="xver" op="55" key="'.$b["cod"].'"><i class="fas fa-search fa-lg green-text"></i></a>';

    echo '<a id="delpro" op="550" iden="'.$b["cod"].'"> <i class="fas fa-trash fa-lg red-text ml-3"></i></a>';
    echo '<a id="barcode" op="122" iden="'.$b["cod"].'"> <i class="fas fa-barcode fa-lg back-text ml-3"></i></a>';
    echo '<a id="modmarca" op="565" iden="'.$b["cod"].'"> <i class="fas fa-award fa-lg cyan-text ml-3"></i></a>';


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

  } // termina productos









public function CambiarMarca($data){
        $db = new dbConn();

  /// reviso si tiene marca el producto
$a = $db->query("SELECT * FROM marca_asig WHERE producto = '".$data["cod"]."' and td = ".$_SESSION["td"]."");
$registros = $a->num_rows;
$a->close();
      if($registros == 0){

              $datos = array();
              $datos["marca"] = $data["iden"];
              $datos["producto"] = $data["cod"];
              $datos["td"] = $_SESSION["td"];
              $datos["hash"] = Helpers::HashId();
              $datos["time"] = Helpers::TimeId();
              if ($db->insert("marca_asig", $datos)) {

                 Alerts::Alerta("success","Realizado!","Agregado correctamente!");
                
              }
        } else {

          $cambio = array();
          $cambio["marca"] = $data["iden"];
          if(Helpers::UpdateId("marca_asig", $cambio, "producto = '".$data["cod"]."' and td = ".$_SESSION["td"]."")){
            Alerts::Alerta("success","Realizado!","Agregado correctamente!");
          }

        }

      $this->VerMarca($data["cod"]);
}





public function VerMarca($cod){
        $db = new dbConn();

    if ($r = $db->select("marca", "marca_asig", "WHERE producto = '".$cod."' and td =".$_SESSION["td"]."")) { 
       $codigo = $r["marca"];
    } unset($r);  

    if($codigo != NULL){
      if ($r = $db->select("marca", "marcas", "WHERE hash = '".$codigo."' and td =".$_SESSION["td"]."")) { 
         echo '<div class="text-center text-info font-weight-bold h3">'.$r["marca"].'</div>';
      } unset($r);  
    } else {
        echo '<div class="text-center text-danger font-weight-bold">No se ecncuentra marca registrada</div>';
    }

}















} // Termina la clase
?>