<?php 
class ProductoOtros{

		public function __construct() { 
     	} 


  public function EmparejaExistencias(){
      $db = new dbConn();

$x = $db->query("SELECT producto, hash, existencia FROM producto_ingresado WHERE existencia != 0  and td = ".$_SESSION["td"]."");
foreach ($x as $y) {

// cantidad total de los productos que hay
    if ($r = $db->select("sum(cantidad)", "producto", "WHERE cod = ".$y["producto"]." and td = ".$_SESSION["td"]."")) { $cantidad = $r["sum(cantidad)"]; } unset($r); 

// cantidad total de las existencia
    if ($r = $db->select("sum(existencia)", "producto_ingresado", "WHERE producto = ".$y["producto"]." and td = ".$_SESSION["td"]."")) { $canti = $r["sum(existencia)"]; } unset($r); 

// existencia actual del registro
$existencia = $y["existencia"];

      if($cantidad < $canti){

        $xcant = $canti - $cantidad;
        // evito los numeros negativos
        if($xcant > $existencia){
          $xcant = 0;
        } else {
          $xcant = $existencia - $xcant;
        }

 // echo "<br> Producto: ". $y["producto"] ." cantidad: " .  $xcant . " || Canti: " . $canti. " || cantidad: " . $cantidad. " || existencia: " . $existencia;
          $cambio = array();
          $cambio["existencia"] = $xcant;
          Helpers::UpdateId("producto_ingresado", $cambio, "hash = '".$y["hash"]."' and td = ".$_SESSION["td"]."");
      }

  } $x->close();
    


    }








  public function Caducidades(){
      $db = new dbConn();

$dias = 86400 * $_SESSION['config_dias_vencimiento'];
$fechasx = Fechas::Format(date("d-m-Y")) + $dias;

$this->EmparejaExistencias();   


$a = $db->query("SELECT * FROM producto WHERE caduca = 'on' and td = ".$_SESSION["td"]."");
  
  if($a->num_rows  > 0){
       echo '<div class="table-responsive">
       <table class="table table-sm table-striped">
    <thead>
      <tr>
        <th class="th-sm">Cod</th>
        <th class="th-sm">Producto</th>
        <th class="th-sm">Existencia</th>
        <th class="th-sm">Vencimiento</th>
        <th class="th-sm">Edo</th>
        <th class="th-sm">Ver</th>
      </tr>
    </thead>
    <tbody>';   
    $contador = 1;
    foreach ($a as $b) {

              /// aqui obtenemos todos los productos con fechas a vencer dentro de un mes
            $x = $db->query("SELECT * FROM producto_ingresado WHERE caducaF < '".$fechasx."' and producto = '".$b["cod"]."' and existencia > 0 and td = ".$_SESSION["td"]."");
           if($x->num_rows > 0){

            foreach ($x as $y) {

              $contador = $contador + 1;

              /// color del caduca
              if(Fechas::Format(date("d-m-Y")) > $y["caducaF"]){ // cadicados
                $edo = Helpers::EdoCaduca(2, $y["caduca"]); 
              } elseif(Fechas::Format(date("d-m-Y")) < $fechasx){
                $edo = Helpers::EdoCaduca(1, $y["caduca"]); 
              } else {
                $edo = Helpers::EdoCaduca(0, $y["caduca"]); 
              }

                echo '<tr>
                            <td>'.$y["producto"].'</td>
                            <td>'.$b["descripcion"].'</td>
                            <td>'.$y["existencia"].'</td>
                            <td>'.$y["caduca"].'</td>
                            <td>'.$edo.'</td>
                            <td><a id="xver" op="55" key="'.$b["cod"].'"><i class="fas fa-search fa-lg green-text"></i></a></td>
                          </tr>';
              // unset($caduca);
              }

            } $x->close();
             /// termina la busqueda de productos 
   }// foreach
      echo '</tbody>
    </table>
    </div>';
  } else{
    Alerts::Mensajex("No existen productos que contengan fecha de vencimiento en el sistema","info");
  }  $a->close();
  

      if($contador == 1){
        Alerts::Mensajex("No se encontraron registros con vencimiento pr&oacuteximo","info");
      }

  } // termina la funcion








  public function ProductosCompuestos($npagina, $orden, $dir){
      $db = new dbConn();

  $limit = 12;
  $adjacents = 2;
  if($npagina == NULL) $npagina = 1;
  $a = $db->query("SELECT * FROM producto WHERE compuesto = 'on' and td = ". $_SESSION['td'] ."");
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

$op = "69";

 $a = $db->query("SELECT producto.cod, producto.descripcion, producto.cantidad, producto.hash, producto.existencia_minima, producto_categoria_sub.subcategoria FROM producto INNER JOIN producto_categoria_sub ON producto.categoria = producto_categoria_sub.hash and producto.td = ".$_SESSION["td"]." WHERE producto.compuesto = 'on' order by ".$orden." ".$dir." limit $offset, $limit");
      
      if($a->num_rows > 0){
          echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="producto.cod" dir="'.$dir2.'">Cod</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="producto.descripcion" dir="'.$dir2.'">Producto</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="producto.cantidad" dir="'.$dir2.'">Cantidad</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="producto.subcategoria" dir="'.$dir2.'">Categoria</a></th>
            <th class="th-sm d-none d-md-block"><a id="paginador" op="'.$op.'" iden="1" orden="producto.existencia_minima" dir="'.$dir2.'">Minimo</a></th>
            <th class="th-sm">Ver</th>
            <th class="th-sm">Eliminar</th>
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
                      <td><a id="xver" op="55" key="'.$b["cod"].'"><i class="fas fa-search fa-lg green-text"></i></a></td>
                      <td><a id="xdelete" hash="'.$b["hash"].'" cod="'.$b["cod"].'" op="71"><i class="fa fa-minus-circle fa-lg red-text"></i></a></td>
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





  public function EliminarCompuestos($cod, $hash){
      $db = new dbConn();

        if (Helpers::DeleteId("producto", "hash='$hash' and td = ". $_SESSION["td"] ."")) {

            Helpers::DeleteId("producto_precio", "producto='$cod' and td = ". $_SESSION["td"] ."");
            Helpers::DeleteId("producto_compuestos", "producto='$cod' and td = ". $_SESSION["td"] ."");
            Helpers::DeleteId("producto_tags", "producto='$cod' and td = ". $_SESSION["td"] ."");   


                $a = $db->query("SELECT imagen FROM producto_imagenes WHERE producto='$cod' and td = ". $_SESSION["td"] ."");
                foreach ($a as $b) {
               
                    if(Helpers::DeleteId("producto_imagenes", "producto='$cod' and td = ". $_SESSION["td"] ."")){
                        if (file_exists("../../assets/img/productos/" . $_SESSION["td"] . "/" . $b["imagen"])) { unlink("../../assets/img/productos/" . $_SESSION["td"] . "/" . $b["imagen"]); }
                    }

                } $a->close();

           Alerts::Alerta("success","Eliminado!","Elemento eliminado correctamente!");
        } else {
            Alerts::Alerta("error","Error!","Algo Ocurrio!");
        } 
  
      $this->ProductosCompuestos(1, "producto.id", "asc");
  }













} // Termina la lcase

?>