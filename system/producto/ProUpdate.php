<?php 
class ProUpdate{

		public function __construct() { 
     	} 


  public function UpProducto($datos){ // lo que viede del formulario principal
    $db = new dbConn();
      if($this->CompruebaForm($datos) == TRUE){ // comprueba si todos los datos requeridos estan llenos

        $dotox["xmedida"] = $datos["xmedida"]; unset($datos["xmedida"]);

                if($datos["gravado"] == NULL) $datos["gravado"] = 0;
                if($datos["receta"] == NULL) $datos["receta"] = 0;
                if($datos["servicio"] == NULL) $datos["servicio"] = 0;
                if($datos["compuesto"] == NULL) $datos["compuesto"] = 0;
                if($datos["caduca"] == NULL) $datos["caduca"] = 0;
                if($datos["dependiente"] == NULL) $datos["dependiente"] = 0;
                if($datos["promocion"] == NULL) $datos["promocion"] = 0;
                if($datos["verecommerce"] == NULL) $datos["verecommerce"] = 0;
                $datos["descripcion"] = strtoupper($datos["descripcion"]);
                $datos["time"] = Helpers::TimeId();
              if (Helpers::UpdateId("producto", $datos, "cod = '".$datos["cod"]."' and td = ".$_SESSION["td"]."")) {

                if($_SESSION["root_taller"] == "on"){ // si es taller agrego datos
                  $taller = new TallerProductos(); 
                  $taller->DeleteDataDB($datos["cod"]); // elimina los datos para meterlos de nuevo
                  $taller->InsertDataProduct($datos["cod"]);
                  $taller->AddMedida($datos["cod"], $dotox["xmedida"]);  
                }

                  unset($_SESSION["producto_mod"]);
                  $this->Redirect($datos);
              }           

      } else {
        Alerts::Alerta("error","Error!","Faltan Datos!");
      }

  }

  public function CompruebaForm($datos){
        if($datos["cod"] == NULL or
          $datos["descripcion"] == NULL or
          $datos["cantidad"] == NULL or
          $datos["existencia_minima"] == NULL or
          $datos["categoria"] == NULL or
          $datos["medida"] == NULL){
          return FALSE;
        } elseif($_SESSION["root_autoparts"] != "on" and $datos["proveedor"] == NULL){  
         return FALSE;
        } else {
         return TRUE;
        }
  }

  public function Redirect($datos){
    if($datos["compuesto"] === "on" || $datos["servicio"] === "on" || $datos["dependiente"] === "on" ){
      $step = 1;
    }else{
      $step = 2;
    }
        echo '<script>
        window.location.href="?modal=proadd&key='. $datos["cod"] .'&step='.$step.'&cad='. $datos["caduca"] .'&com='. $datos["compuesto"] .'&dep='. $datos["dependiente"] .'";
        </script>';
  }



  public function UrlNext($cod, $step,$cad,$com,$dep){
    if($step == "1"){
      header("location: ../../?modal=proadd&key=$cod&step=2&cad=$cad&com=$com&dep=$dep");
    }
      if($step == "2"){
        $db = new dbConn();

        $a = $db->query("SELECT * FROM producto_precio WHERE producto = '$cod' and td = ".$_SESSION["td"]."");
        $precios = $a->num_rows;
        $a->close();
        if($precios == 0){
            header("location: ../../?modal=proadd&key=$cod&step=2&cad=$cad&com=$com&dep=$dep&msj");
        }
        elseif($com == "on"){
           header("location: ../../?modal=proadd&key=$cod&step=3&cad=$cad&com=$com&dep=$dep");
        } 
        elseif($dep == "on"){
           header("location: ../../?modal=proadd&key=$cod&step=4&cad=$cad&com=$com&dep=$dep");
        } else {
          header("location: ../../?modal=proadd&key=$cod&step=5&cad=$cad&com=$com&dep=$dep");
        }  
      }
      if($step == "3"){
        if($dep == "on"){
           header("location: ../../?modal=proadd&key=$cod&step=4&cad=$cad&com=$com&dep=$dep");
        } else {
          header("location: ../../?modal=proadd&key=$cod&step=5&cad=$cad&com=$com&dep=$dep");
       }  
      }
     if($step == "4"){
        header("location: ../../?modal=proadd&key=$cod&step=5&cad=$cad&com=$com&dep=$dep"); 
      }

  }


  public function ProAgrega($datox, $cargaPro = NULL){ // lo que viede del formulario principal
    $db = new dbConn();
    $kardex = new Kardex();

  if($datox["iva"] == 1){
    $costo = $datox["precio"] * 1.13;
  }else{
    $costo = $datox["precio"];
  }
          if($datox["precio"] != NULL and $datox["cantidad"] != NULL and $datox["cantidad"] != 0){
              $datos = array();
              $hashin = Helpers::HashId();
              $datos["producto"] = $datox["cod"];
              $datos["cant"] = $datox["cantidad"];
              $datos["existencia"] = $datox["cantidad"];
              $datos["precio_costo"] = $costo;
              $datos["caduca"] = $datox["caduca_submit"];
              $datos["caducaF"] = Fechas::Format($datox["caduca_submit"]);
              $datos["comentarios"] = $datox["comentarios"];
              $datos["proveedor"] = $datox["proveedor"];
              $datos["documento"] = $datox["documento"];
              $datos["precio_venta"] = $datox["precio_venta"];
              $datos["user"] = $_SESSION["user"];
              $datos["fechaF"] = Fechas::Format(date("d-m-Y"));
              $datos["fecha_ingreso"] = Fechas::Format(date("d-m-Y"));
              $datos["fecha"] = date("d-m-Y");
              $datos["hora"] = date("H:i:s");
              $datos["td"] = $_SESSION["td"];
              $datos["hash"] = $hashin;
              $datos["time"] = Helpers::TimeId();
              if ($db->insert("producto_ingresado", $datos)) {
                // debo actualizar el total (cantidad) de producto
                    if ($r = $db->select("cantidad", "producto", "WHERE cod = '".$datox["cod"]."' and td = ".$_SESSION["td"]."")) { 
                        $canti = $r["cantidad"];
                    } unset($r); 
                        
                        $cambio = array();
                        $cambio["cantidad"] = $datox["cantidad"] + $canti;
                        Helpers::UpdateId("producto", $cambio, "cod = '".$datox["cod"]."' and td = ".$_SESSION["td"].""); 

  // ubicacion predeterminada
// if ($r = $db->select("hash", "ubicacion", "WHERE predeterminada = '1' and td = ".$_SESSION["td"]."")) { 
// $predet = $r["hash"];
// } unset($r); 

$predet = $datox["ubicacion"];

$cantu = 0;
if ($r = $db->select("cant", "ubicacion_asig", "WHERE ubicacion = '".$predet."' and producto = '".$datox["cod"]."' and td = ".$_SESSION["td"]."")) { 
$cantu = $r["cant"];
} unset($r);   

$cambiox = array();
$cambiox["cant"] = $datox["cantidad"] + $cantu;
Helpers::UpdateId("ubicacion_asig", $cambiox, "ubicacion = '".$predet."' and producto = '".$datox["cod"]."' and td = ".$_SESSION["td"]."");   

// para agregarlo en el registro de en que ubicacion se metio
  $this->InsertaRegistroDescuenta($datox["cod"], $predet, 2, $hashin, $datox["cantidad"]);
//

$this->CaracteristicaAgrega($datox["cod"], $datox["caracteristica"], $hashin);
$kardex->IngresarProductoKardex($datox["cod"], $datox["cantidad"], $hashin, $datox["precio"]);

                    //////////// 
                Alerts::Alerta("success","Realizado!","Registro creado exitosamente!");
                }
          } else {
              Alerts::Alerta("error","Error!","Faltan Datos!");
          }

        if ($cargaPro == NULL) {
          $this->VerAgrega($datox["cod"]);
        }
       
  }





 public function ListarUbicaciones(){
  $db = new dbConn();

  $a = $db->query("SELECT * FROM ubicacion WHERE td = ".$_SESSION["td"]."");

    if($a->num_rows > 0){
        echo 'Ubicaci&oacuten del producto
        <div class="form-row">';

      foreach ($a as $b) {

        if($b["predeterminada"] == 1){ $check = "checked"; } else { $check = ""; }

      echo '<div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" id="'. $b["hash"] .'" name="ubicacion" value="'. $b["hash"] .'" '.$check.'>
            <label class="form-check-label" for="'. $b["hash"] .'">'. $b["ubicacion"] .'</label>
          </div>';

    } 
      echo '</div>';

    }  $a->close();

 }






 public function CompruebaCaracteristicas($cod){
  $db = new dbConn();

  $a = $db->query("SELECT * FROM caracteristicas_asig WHERE producto = '$cod' and td = ".$_SESSION["td"]."");

    if($a->num_rows > 0){
        echo 'Caracteristicas del producto
        <div class="form-row">';
      foreach ($a as $b) {

              if ($r = $db->select("caracteristica", "caracteristicas", "WHERE hash = '". $b["caracteristica"] ."' and td = ".$_SESSION["td"]."")) { 
                  $carac = $r["caracteristica"];
              } unset($r); 

        echo '<div class="col-md-2 mb-1 md-form">
              <label for="caracteristica">'. $carac .'</label>
              <input type="number" step="any" class="form-control form-control-sm" id="caracteristica['. $b["caracteristica"] .']" name="caracteristica['. $b["caracteristica"] .']">
            </div>';
    } 
      echo '</div>';

    }  $a->close();
    
 }




public function CaracteristicaAgrega($cod, $caracteristicas, $hash){
      $db = new dbConn();

  $a = $db->query("SELECT * FROM caracteristicas_asig WHERE producto = '$cod' and td = ".$_SESSION["td"]."");

    if($a->num_rows > 0){
      foreach ($a as $b) {

    // cuento el producto tiene varias caracteristicas
        if ($r = $db->select("cant", "caracteristicas_asig", "WHERE caracteristica = '".$b["caracteristica"]."' and producto = '".$cod."' and td = ".$_SESSION["td"]."")) { 
          $canti = $r["cant"];
        }  unset($r);  

        // descuento
        $cambio = array();
        $cambio["cant"] = $canti + $caracteristicas[$b["caracteristica"]];
        Helpers::UpdateId("caracteristicas_asig", $cambio, "caracteristica = '".$b["caracteristica"]."' and producto = '".$cod."' and td = ".$_SESSION["td"]."");

        $this->InsertaRegistroDescuenta($cod, $b["caracteristica"], 1, $hash, $caracteristicas[$b["caracteristica"]]);
    } 
  }  $a->close();

}






public function DevuelveCaracteristica($codigo, $paraverias = NULL){
      $db = new dbConn();

  $a = $db->query("SELECT * FROM ticket_descuenta WHERE descuenta = '1' and orden = '0' and codigo = '$codigo' and td = ".$_SESSION["td"]."");

    if($a->num_rows > 0){
      foreach ($a as $b) {

    // cuento el producto tiene varias caracteristicas
        if ($r = $db->select("cant", "caracteristicas_asig", "WHERE caracteristica = '".$b["producto_hash"]."' and producto = '".$b["producto"]."' and td = ".$_SESSION["td"]."")) { 
          $canti = $r["cant"];
        }  unset($r);  

        // descuento
        $cambio = array();

        if($paraverias == NULL){
          $cambio["cant"] = $canti - $b["cant"];
        } else {
          $cambio["cant"] = $canti + $b["cant"];
        }
        
        Helpers::UpdateId("caracteristicas_asig", $cambio, "caracteristica = '".$b["producto_hash"]."' and producto = '".$b["producto"]."' and td = ".$_SESSION["td"]."");
    } 
  }  $a->close();

}







public function InsertaRegistroDescuenta($cod, $hashx, $descuenta, $codigo, $cant){
      $db = new dbConn();

    $datos = array();
    $datos["orden"] = 0; // si es cero es para averias o inserta
    $datos["producto"] = $cod; // codigo del producto
    $datos["producto_hash"] = $hashx; // hash de la ubicacion o averia
    $datos["descuenta"] = $descuenta; // 1 caracteritica. 2 ubicacion
    $datos["codigo"] = $codigo; // hash del inserta o el averia
    $datos["cant"] = $cant; // cantidad
    $datos["tx"] = NULL;
    $datos["td"] = $_SESSION["td"];
    $datos["hash"] = Helpers::HashId();
    $datos["time"] = Helpers::TimeId();
    $db->insert("ticket_descuenta", $datos);

}





public function CaracteristicaAveria($cod, $caracteristicas, $hashin){
      $db = new dbConn();

  $a = $db->query("SELECT * FROM caracteristicas_asig WHERE producto = '$cod' and td = ".$_SESSION["td"]."");

    if($a->num_rows > 0){
      foreach ($a as $b) {

    // cuento el producto tiene varias caracteristicas
        $canti = 0;
        if ($r = $db->select("cant", "caracteristicas_asig", "WHERE caracteristica = '".$b["caracteristica"]."' and producto = '".$cod."' and td = ".$_SESSION["td"]."")) { 
          $canti = $r["cant"];
        }  unset($r);  

        // descuento
        $cambio = array();
        $cambio["cant"] = $canti - $caracteristicas[$b["caracteristica"]];
        Helpers::UpdateId("caracteristicas_asig", $cambio, "caracteristica = '".$b["caracteristica"]."' and producto = '".$cod."' and td = ".$_SESSION["td"]."");

// para agregarlo en el registro de en que ubicacion se metio
  $this->InsertaRegistroDescuenta($cod, $b["caracteristica"], 1, $hashin, $caracteristicas[$b["caracteristica"]]);
//
 
    } 
  }  $a->close();


}




  public function VerAgrega($producto){
      $db = new dbConn();
          $a = $db->query("SELECT * FROM producto_ingresado WHERE producto = '$producto' and td = ".$_SESSION["td"]." order by id desc limit 8");
          if($a->num_rows > 0){
        echo '<table class="table table-sm table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Precio de Costo</th>
               <th scope="col">Cantidad</th>
              <th scope="col">Caduca</th>
               <th scope="col">Fecha y Hora</th>
              <th scope="col">Eliminar</th>
            </tr>
          </thead>
          <tbody>';
          $n = 1;
              foreach ($a as $b) { 
                if($b["caduca"] == NULL) $cad = "N/A"; else $cad = $b["caduca"];
                echo '<tr>
                      <th scope="row">'. $n .'</th>
                      <td>'.$b["precio_costo"].'</td>
                       <td>'.$b["cant"].'</td>
                      <td>'.$cad.'</td>
                      <td>'.$b["fecha"]. ' | ' .$b["hora"] .'</td>';
                if($n == 1 and $b["fecha"] == date("d-m-Y")){
                  echo '<td><a id="delproagrega" hash="'.$b["hash"].'" op="49" producto="'.$producto.'"><i class="fa fa-minus-circle fa-lg red-text"></i></a></td>';
                } else {
                  echo '<td><a><i class="fa fa-ban fa-lg gren-text"></i></a></td>';
                }
                echo '</tr>'; 
                $n ++ ;        
              }
        echo '</tbody>
        </table>';

          } $a->close(); 

      if ($r = $db->select("cantidad", "producto", "WHERE cod = '$producto' and td = ".$_SESSION["td"]."")) { 
       Alerts::Mensajex("La cantidad actual de productos es: " . Helpers::Format($r["cantidad"]),'success',$boton,$boton2);
      }  unset($r);

      if ($r = $db->select("precio", "producto_precio", "WHERE producto = '$producto' and td = ".$_SESSION["td"]." limit 1")) { 
        Alerts::Mensajex("El precio de venta es: " . Helpers::Dinero($r["precio"]),'success',$boton,$boton2);
       }  unset($r);
        
  }












  public function DelProAgrega($hash, $producto){ // elimina precio
    $db = new dbConn();
    $kardex = new Kardex();

    // debo actualizar el total (cantidad) de producto
      if ($r = $db->select("cantidad", "producto", "WHERE cod = '".$producto."' and td = ".$_SESSION["td"]."")) { 
          $canti = $r["cantidad"];
      } unset($r); 
      if ($r = $db->select("cant, fecha", "producto_ingresado", "WHERE hash = '$hash' and td = ".$_SESSION["td"]."")) { 
          $cantix = $r["cant"];
          $fechai = $r["fecha"];
      } unset($r);


  // ubicacion del que hay que descontar
$cantu = 0;
if ($r = $db->select("producto_hash, cant", "ticket_descuenta", "WHERE descuenta = 2 and codigo = '$hash' and td = ".$_SESSION["td"]."")) { 
$predet = $r["producto_hash"];
$cantu = $r["cant"];
} unset($r);  


$cantubi = 0;
if ($r = $db->select("cant", "ubicacion_asig", "WHERE ubicacion = '".$predet."' and producto = '".$producto."' and td = ".$_SESSION["td"]."")) { 
$cantubi = $r["cant"];
} unset($r);   


                    //////////// 
      if($fechai == date("d-m-Y")){
        if (Helpers::DeleteId("producto_ingresado", "hash='$hash'")) {
          //
                $cambio = array();
                $cambio["cantidad"] = $canti - $cantix;
                Helpers::UpdateId("producto", $cambio, "cod = '".$producto."' and td = ".$_SESSION["td"].""); 

              $cambiox = array();
              $cambiox["cant"] = $cantubi - $cantu;
              Helpers::UpdateId("ubicacion_asig", $cambiox, "ubicacion = '".$predet."' and producto = '".$producto."' and td = ".$_SESSION["td"].""); 

          // // regresa las caracteristicas
        $this->DevuelveCaracteristica($hash);

          //
           Alerts::Alerta("success","Eliminado!","Productos eliminados correctamente!");
        } else {
            Alerts::Alerta("error","Error!","Algo Ocurrio!");
        } 
      } else {
        Alerts::Alerta("error","Error!","La fecha del los producto que quiere borrar no coincide!");
      }
      $kardex->EliminaProductoKardex($hash);
      $this->VerAgrega($producto);
  }



public function AgregaBusqueda($dato){ // Busqueda para compuestos
  $db = new dbConn();

        $a = $db->query("SELECT * FROM producto WHERE (cod like '%".$dato["keyword"]."%' or descripcion like '%".$dato["keyword"]."%') and td = ".$_SESSION["td"]." limit 10");
         if($a->num_rows > 0){
          echo '<table class="table table-sm table-hover">';
  foreach ($a as $b) {
             echo '<tr>
                    <td scope="row"><a id="select-agrega" cod="'. $b["cod"] .'" descripcion="'. $b["descripcion"] .'"><div>
                    '. $b["cod"] .'  || '. $b["descripcion"] .'</div></a></td>
                  </tr>'; 
  }  $a->close();

      echo '
      </table>';
        } else {
          echo "El criterio de busqueda no corresponde a un producto";
        }
}


//////////////// averias
  public function AddAveria($datox, $cargaPro = NULL){ // lo que viede del formulario principal
    $db = new dbConn();
    $kardex = new Kardex();

          if($datox["cantidad"] != NULL){
              $datos = array();
              $hashin = Helpers::HashId();
              $datos["producto"] = $datox["cod"];
              $datos["cant"] = $datox["cantidad"];
              $datos["comentarios"] = $datox["comentarios"];
              $datos["fecha"] = date("d-m-Y");
              $datos["hora"] = date("H:i:s");
              $datos["usuario"] = $_SESSION["user"];
              $datos["td"] = $_SESSION["td"];
              $datos["hash"] = $hashin;
              $datos["time"] = Helpers::TimeId();
              if ($db->insert("producto_averias", $datos)) {
                  $kardex->IngresarProductoAveriaKardex($datox["cod"], $datos["cant"], $hashin);
                // debo actualizar el total (cantidad) de producto
                    if ($r = $db->select("cantidad", "producto", "WHERE cod = '".$datox["cod"]."' and td = ".$_SESSION["td"]."")) { 
                        $canti = $r["cantidad"];
                    } unset($r); 
                        $cambio = array();
                        $cambio["cantidad"] = $canti - $datox["cantidad"];
                        Helpers::UpdateId("producto", $cambio, "cod = '".$datox["cod"]."' and td = ".$_SESSION["td"].""); 

  // ubicacion predeterminada
// if ($r = $db->select("hash", "ubicacion", "WHERE predeterminada = '1' and td = ".$_SESSION["td"]."")) { 
// $predet = $r["hash"];
// } unset($r);  

$predet = $datox["ubicacion"];

$cantu = 0;
if ($r = $db->select("cant", "ubicacion_asig", "WHERE ubicacion = '".$predet."' and producto = '".$datox["cod"]."' and td = ".$_SESSION["td"]."")) { 
$cantu = $r["cant"];
} unset($r);   

$cambiox = array();
$cambiox["cant"] = $cantu - $datox["cantidad"];
Helpers::UpdateId("ubicacion_asig", $cambiox, "ubicacion = '".$predet."' and producto = '".$datox["cod"]."' and td = ".$_SESSION["td"].""); 
                    //////////// 

// para agregarlo en el registro de en que ubicacion se metio
  $this->InsertaRegistroDescuenta($datox["cod"], $predet, 2, $hashin, $datox["cantidad"]);
//


$this->CaracteristicaAveria($datox["cod"], $datox["caracteristica"], $hashin);

                Alerts::Alerta("success","Realizado!","Registro creado exitosamente!");
                }
          } else {
              Alerts::Alerta("error","Error!","Faltan Datos!");
          }

      if ($cargaPro == NULL) {
        $this->VerAveria($datox["cod"]);
      }

  }






    public function VerAveria($producto){
      $db = new dbConn();
          $a = $db->query("SELECT * FROM producto_averias WHERE producto = '$producto' and td = ".$_SESSION["td"]." order by id desc limit 8");
          if($a->num_rows > 0){
        echo '<table class="table table-sm table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
               <th scope="col">Cantidad</th>
              <th scope="col">Comentarios</th>
               <th scope="col">Fecha y Hora</th>
              <th scope="col">Eliminar</th>
            </tr>
          </thead>
          <tbody>';
          $n = 1;
              foreach ($a as $b) { 
                echo '<tr>
                      <th scope="row">'. $n .'</th>
                       <td>'.$b["cant"].'</td>
                      <td>'.$b["comentarios"].'</td>
                      <td>'.$b["fecha"]. ' | ' .$b["hora"] .'</td>';
                if($n == 1 and $b["fecha"] == date("d-m-Y")){
                  echo '<td><a id="delaveria" hash="'.$b["hash"].'" op="52" producto="'.$producto.'"><i class="fa fa-minus-circle fa-lg red-text"></i></a></td>';
                } else {
                  echo '<td><a ><i class="fa fa-ban fa-lg green-text"></i></a></td>';
                }
                echo '</tr>'; 
                $n ++ ;        
              }
        echo '</tbody>
        </table>';

          } $a->close();  
     
           if ($r = $db->select("cantidad", "producto", "WHERE cod = '$producto' and td = ".$_SESSION["td"]."")) { 
       Alerts::Mensajex("La cantidad actual de productos es: " . Helpers::Format($r["cantidad"]),'success',$boton,$boton2);
      }  unset($r);
  }







  public function DelAveria($hash, $producto){ // elimina precio
    $db = new dbConn();
    $kardex = new Kardex();
    // debo actualizar el total (cantidad) de producto
        if ($r = $db->select("cantidad", "producto", "WHERE cod = '".$producto."' and td = ".$_SESSION["td"]."")) { 
            $canti = $r["cantidad"];
        } unset($r); 
        if ($r = $db->select("cant, fecha", "producto_averias", "WHERE hash = '$hash' and td = ".$_SESSION["td"]."")) { 
            $cantix = $r["cant"];
            $fechai = $r["fecha"];
        } unset($r);
  


  // ubicacion del que hay que descontar
$cantu = 0;
if ($r = $db->select("producto_hash, cant", "ticket_descuenta", "WHERE descuenta = 2 and codigo = '$hash' and td = ".$_SESSION["td"]."")) { 
$predet = $r["producto_hash"];
$cantu = $r["cant"];
} unset($r);  


$cantubi = 0;
if ($r = $db->select("cant", "ubicacion_asig", "WHERE ubicacion = '".$predet."' and producto = '".$producto."' and td = ".$_SESSION["td"]."")) { 
$cantubi = $r["cant"];
} unset($r);   



                    //////////// 
      if($fechai == date("d-m-Y")){
        if (Helpers::DeleteId("producto_averias", "hash='$hash'")) {
          //
              $cambio = array();
              $cambio["cantidad"] = $canti + $cantix;
              Helpers::UpdateId("producto", $cambio, "cod = '".$producto."' and td = ".$_SESSION["td"].""); 

              $cambiox = array();
              $cambiox["cant"] = $cantubi + $cantu;
              Helpers::UpdateId("ubicacion_asig", $cambiox, "ubicacion = '".$predet."' and producto = '".$producto."' and td = ".$_SESSION["td"].""); 

        // // regresa las caracteristicas
        $this->DevuelveCaracteristica($hash, TRUE);
          //
           Alerts::Alerta("success","Eliminado!","Averia eliminada correctamente!");
        } else {
            Alerts::Alerta("error","Error!","Algo Ocurrio!");
        } 
      } else {
        Alerts::Alerta("error","Error!","La fecha del los producto que quiere borrar no coincide!");
      }
      $kardex->EliminaProductoKardex($hash);
      $this->VerAveria($producto);
      
  }


public function AveriaBusqueda($dato){ // Busqueda para averia
  $db = new dbConn();

        $a = $db->query("SELECT * FROM producto WHERE (cod like '%".$dato["keyword"]."%' or descripcion like '%".$dato["keyword"]."%') and td = ".$_SESSION["td"]." limit 10");
         if($a->num_rows > 0){
          echo '<table class="table table-sm table-hover">';
  foreach ($a as $b) {
             echo '<tr>
                    <td scope="row"><a id="select-averia" cod="'. $b["cod"] .'" descripcion="'. $b["descripcion"] .'"><div>
                    '. $b["cod"] .'  || '. $b["descripcion"] .'</div></a></td>
                  </tr>'; 
  }  $a->close();

      echo '</table>';
        } else {
          echo "El criterio de busqueda no corresponde a un producto";
        }
}










} // Termina la lcase

?>