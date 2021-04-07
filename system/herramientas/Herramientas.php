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
          Helpers::DeleteId("marca_asig", "producto='$cod' and td = ". $_SESSION["td"] ."");


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
      $producto = new Productos(); 

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
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="producto.cod" dir="'.$dir2.'">Cod</a></th>';

            if($producto->CompruebaSiMarca() == TRUE){
              echo '<th class="th-sm"><a >Marca</a></th>';
            }

          echo '<th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="producto.descripcion" dir="'.$dir2.'">Producto</a></th>
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
                      <td>'.$b["cod"].'</td>';

                if($producto->CompruebaSiMarca() == TRUE){
                  echo '<th class="th-sm"><a >'.$producto->MostrarMarca($b["cod"]).'</a></th>';
                }

                echo '<td>'.$b["descripcion"].'</td>
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






















  public function AjustedeInventario($npagina, $orden, $dir){
      $db = new dbConn();
      $producto = new Productos(); 

  $limit = 25;
  $adjacents = 2;
  if($npagina == NULL) $npagina = 1;
  $a = $db->query("SELECT * FROM producto WHERE 
  producto.cod not in (select ajuste_inventario.cod from ajuste_inventario) and td = ".$_SESSION["td"]."");
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

$op="567";

 $a = $db->query("SELECT cod as codigo, descripcion, cantidad FROM producto WHERE 
  producto.cod not in (select ajuste_inventario.cod from ajuste_inventario) and td = ".$_SESSION["td"]." order by ".$orden." ".$dir." limit $offset, $limit");
      
      if($a->num_rows > 0){
          echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="cod" dir="'.$dir2.'">Cod</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="descripcion" dir="'.$dir2.'">Producto</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="cantidad" dir="'.$dir2.'">Cantidad</a></th>
            <th class="th-sm">Ver</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto

 if ($r = $db->select("precio", "producto_precio", "WHERE producto = ".$b["cod"]." and td = ". $_SESSION["td"] ."")) { 
        $precio = $r["precio"]; } unset($r); 


          echo '<tr>
                      <td>'.$b["codigo"].'</td>
                      <td>'.$b["descripcion"].'</td>
                      <td>'.$b["cantidad"].'</td>
                      <td><a id="modificarcantidad" op="569" key="'.$b["codigo"].'"><i class="fas fa-pen fa-lg red-text"></i></a>

                      | <a id="establecercantidad" op="571" key="'.$b["codigo"].'"><i class="fas fa-thumbs-up fa-lg blue-text"></i></a>';
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
echo $total_rows . " Registros faltantes";
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





 public function ComprobarAjuste(){
$db = new dbConn();

$a = $db->query("SELECT * FROM ajuste_inventario_activate WHERE edo = 1 and td = ".$_SESSION["td"]."");
$cantcod = $a->num_rows;
$a->close();

    if($cantcod > 0){
       return TRUE; // si encuetra valor es true
    } else {
      return FALSE;
    }
 }




  public function IniciarAjuste(){ // ingresa un nuevo lote de productos
      $db = new dbConn();
                 
        $datos = array();
        $datos["edo"] = 1;
        $datos["inicio"] = Helpers::TimeId();
        $datos["td"] = $_SESSION["td"];
        $datos["hash"] = Helpers::HashId();
        $datos["time"] = Helpers::TimeId();
        if($db->insert("ajuste_inventario_activate", $datos)){
          Alerts::Alerta("success","Realizado!","Iniciado correctamente!");
          $this->AjustedeInventario(1, "id", "asc");
        } else {
          Alerts::Alerta("error","Error!","Algo Ocurrio!");
        }

  }


 public function ObtenerCantidad($cod){
$db = new dbConn();

    if ($r = $db->select("cantidad", "producto", "WHERE cod = '$cod' and td = ".$_SESSION["td"]."")) { 
        return $r["cantidad"];
    } unset($r);  

 }


  public function CambiarCantidad($data){ // ingresa un nuevo lote de productos
      $db = new dbConn();
                 
        $datos = array();
        $datos["cod"] = $data["cod"];
        $datos["cantidad"] = $this->ObtenerCantidad($data["cod"]); // cantidad actual
        $datos["establecido"] = $data["cantidad"];
        $datos["td"] = $_SESSION["td"];
        $datos["hash"] = Helpers::HashId();
        $datos["time"] = Helpers::TimeId();
        if($db->insert("ajuste_inventario", $datos)){

           
          if($datos["cantidad"] > $datos["establecido"]){ // averias

            $this->Averias($datos);

          } else { // agrega producto

            $this->Agrega($datos);

          }


          Alerts::Alerta("success","Realizado!","Iniciado correctamente!");
          $this->AjustedeInventario(1, "id", "asc");
        } else {
          Alerts::Alerta("error","Error!","Algo Ocurrio!");
        }

  }


  public function EstablecerCantidad($data){ // ingresa un nuevo lote de productos
      $db = new dbConn();
                 
        $datos = array();
        $datos["cod"] = $data["key"];
        $datos["cantidad"] = $this->ObtenerCantidad($data["key"]);
        $datos["establecido"] = $this->ObtenerCantidad($data["key"]);
        $datos["td"] = $_SESSION["td"];
        $datos["hash"] = Helpers::HashId();
        $datos["time"] = Helpers::TimeId();
        if($db->insert("ajuste_inventario", $datos)){
          Alerts::Alerta("success","Realizado!","Iniciado correctamente!");
          $this->AjustedeInventario(1, "id", "asc");
        } else {
          Alerts::Alerta("error","Error!","Algo Ocurrio!");
        }

  }





public function Averias($datos){
      $db = new dbConn();

    $cantidad = $datos["cantidad"] - $datos["establecido"];

    $data = array();
    $data["producto"] = $datos["cod"];
    $data["cant"] = $cantidad;
    $data["comentarios"] = "Ajuste de inventario";
    $data["fecha"] = date("d-m-Y");
    $data["hora"] = date("H:i:s");
    $data["usuario"] = $_SESSION["user"];
    $data["td"] = $_SESSION["td"];
    $data["hash"] = Helpers::HashId();
    $data["time"] = Helpers::TimeId();
    if ($db->insert("producto_averias", $data)) {

// se actualiza la cantidad de los productos
$cambio = array();
$cambio["cantidad"] = $datos["establecido"];
Helpers::UpdateId("producto", $cambio, "cod='".$datos["cod"]."' and td = ".$_SESSION["td"]."");        


  // ubicacion predeterminada
if ($r = $db->select("hash", "ubicacion", "WHERE predeterminada = '1' and td = ".$_SESSION["td"]."")) { 
$predet = $r["hash"];
} unset($r);  

$asig = array();
$asig["cant"] = $datos["establecido"];
Helpers::UpdateId("ubicacion_asig", $asig, "ubicacion = '$predet' and producto='".$datos["cod"]."' and td = ".$_SESSION["td"]."");        
///
}


}






public function Agrega($datos){
      $db = new dbConn();

    $cantidad = $datos["establecido"] - $datos["cantidad"];

    
    $data = array();
    $data["producto"] = $datos["cod"];
    $data["cant"] = $cantidad;
    $data["existencia"] = $cantidad;
    $data["precio_costo"] = $this->ObtenerPrecioCosto($datos["cod"]); // buscar precio costo
    $data["caduca"] = $this->Caduca($datos["cod"]); // buscar la ultima caducidad
    $data["caducaF"] = Fechas::Format($this->Caduca($datos["cod"]));
    $data["comentarios"] = "Ajuste de inventario";
    $data["fecha"] = date("d-m-Y");
    $data["hora"] = date("H:i:s");
    $data["td"] = $_SESSION["td"];
    $data["hash"] = Helpers::HashId();
    $data["time"] = Helpers::TimeId();
    if ($db->insert("producto_ingresado", $data)) {

// se actualiza la cantidad de los productos
$cambio = array();
$cambio["cantidad"] = $datos["establecido"];
Helpers::UpdateId("producto", $cambio, "cod='".$datos["cod"]."' and td = ".$_SESSION["td"]."");        


  // ubicacion predeterminada
if ($r = $db->select("hash", "ubicacion", "WHERE predeterminada = '1' and td = ".$_SESSION["td"]."")) { 
$predet = $r["hash"];
} unset($r);  

$asig = array();
$asig["cant"] = $datos["establecido"];
Helpers::UpdateId("ubicacion_asig", $asig, "ubicacion = '$predet' and producto='".$datos["cod"]."' and td = ".$_SESSION["td"]."");        
///
}


}



public function ObtenerPrecioCosto($cod) { // obtine cantiad de productos
  $db = new dbConn();

$precio = 0;
// cantidad de productos ingresados y precio costo
$a = $db->query("SELECT existencia, precio_costo FROM producto_ingresado WHERE existencia > 0 and producto = '".$cod."' and td = ". $_SESSION["td"] ."");
foreach ($a as $b) {
    $tot = $b["existencia"] * $b["precio_costo"];
    $precio = $precio + $tot;
    unset($tot);
} $a->close();

 

if ($r = $db->select("sum(existencia)", "producto_ingresado", "WHERE existencia > 0 and producto = '".$cod."' and td = ". $_SESSION["td"] ."")) { 
    $productos = $r["sum(existencia)"];
} unset($r);  

@$pc = $precio / $productos;

    return $pc;
}




 public function Caduca($cod){
$db = new dbConn();

    if ($r = $db->select("caduca", "producto_ingresado", "WHERE producto = '$cod' and td = ".$_SESSION["td"]." order by time desc limit 1")) { 
        return $r["caduca"];
    } unset($r);  

 }








} // Termina la clase
?>