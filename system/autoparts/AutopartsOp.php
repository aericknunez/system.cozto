<?php 
class Autoparts {

		public function __construct() { 
     	} 



public function AddMarca($data){
     $db = new dbConn();

     if ($data["marca"] != NULL) {
        $datos = array();

  if ($r = $db->select("cod", "autoparts_marca", "WHERE td = ".$_SESSION["td"]." order by cod desc limit 1")) { 
        $cod = $r["cod"];
    } unset($r);

      $cod = $cod + 1;

        $datos["cod"] = $cod;
        $datos["marca"] = strtoupper($data["marca"]);
        $datos["hash"] = Helpers::HashId();
        $datos["time"] = Helpers::TimeId();
        $datos["td"] = $_SESSION["td"];
        if($db->insert("autoparts_marca", $datos)){
           Alerts::Alerta("success","Realizado!","Marca ingresada correctamente!");
        } 
     } else {
      Alerts::Alerta("error","Error!","Faltan Datos!");
     }

     $this->VerMarca();
  }




  public function VerMarca(){ // listado de marcas
    $db = new dbConn();

      $a = $db->query("SELECT * FROM autoparts_marca WHERE td = ".$_SESSION["td"]."");
      if($a->num_rows > 0){
    echo '<table class="table table-sm table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Marca</th>
          <th scope="col">Eliminar</th>
        </tr>
      </thead>
      <tbody>';
      $n = 1;
          foreach ($a as $b) { ;
            echo '<tr>
                  <th scope="row">'. $n ++ .'</th>
                  <td>'.$b["marca"].'</td>
                  <td><a id="xdelete" valor="1" hash="'.$b["hash"].'" op="531"><i class="fa fa-minus-circle fa-lg red-text"></i></a></td>
                </tr>';          
          }
    echo '</tbody>
    </table>';

      } $a->close();
  }



  public function DelMarca($hash){ // elimina caracteristica
    $db = new dbConn();
        if (Helpers::DeleteId("autoparts_marca", "hash='$hash'")) {
            Helpers::DeleteId("autoparts_modelo", "marca='$hash' and td = " . $_SESSION["td"]);
            Helpers::DeleteId("autoparts_motor", "marca='$hash' and td = " . $_SESSION["td"]);
           Alerts::Alerta("success","Eliminado!","Marca eliminada correctamente!");
        } else {
            Alerts::Alerta("error","Error!","Algo Ocurrio!");
        } 
      $this->VerMarca();
  }





public function AddModelo($data){
     $db = new dbConn();

     if ($data["modelo"] != NULL) {

  if ($r = $db->select("cod", "autoparts_modelo", "WHERE td = ".$_SESSION["td"]." order by cod desc limit 1")) { 
        $cod = $r["cod"];
    } unset($r);

      $cod = $cod + 1;

        $datos = array();
        $datos["marca"] = $data["marca-modelo"];
        $datos["cod"] = $cod;
        $datos["modelo"] = strtoupper($data["modelo"]);
        $datos["hash"] = Helpers::HashId();
        $datos["time"] = Helpers::TimeId();
        $datos["td"] = $_SESSION["td"];
        if($db->insert("autoparts_modelo", $datos)){
           Alerts::Alerta("success","Realizado!","Modelo ingresado correctamente!");
        } 
     } else {
      Alerts::Alerta("error","Error!","Faltan Datos!");
     }

     $this->VerModelo();
  }




  public function VerModelo(){ // listado de modelos
    $db = new dbConn();

      $a = $db->query("SELECT autoparts_modelo.hash as hash, autoparts_modelo.modelo as modelo, autoparts_marca.marca as marca FROM autoparts_modelo inner join autoparts_marca on autoparts_modelo.marca = autoparts_marca.hash WHERE autoparts_modelo.td = ".$_SESSION["td"]." order by autoparts_modelo.marca");
      if($a->num_rows > 0){
    echo '<table class="table table-sm table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Marca</th>
          <th scope="col">Modelo</th>
          <th scope="col">Eliminar</th>
        </tr>
      </thead>
      <tbody>';
      $n = 1;
          foreach ($a as $b) { ;
            echo '<tr>
                  <th scope="row">'. $n ++ .'</th>
                  <td>'.$b["marca"].'</td>
                  <td>'.$b["modelo"].'</td>
                  <td><a id="xdelete" valor="2" hash="'.$b["hash"].'" op="533"><i class="fa fa-minus-circle fa-lg red-text"></i></a></td>
                </tr>';          
          }
    echo '</tbody>
    </table>';

      } $a->close();
  }




  public function DelModelo($hash){ // elimina 
    $db = new dbConn();
        if (Helpers::DeleteId("autoparts_modelo", "hash='$hash'")) {
           Alerts::Alerta("success","Eliminado!","Modelo eliminada correctamente!");
        } else {
            Alerts::Alerta("error","Error!","Algo Ocurrio!");
        } 
      $this->VerModelo();
  }












public function AddItem($data){
     $db = new dbConn();

     if ($data["item"] != NULL) {

  if ($r = $db->select("cod", "autoparts_item", "WHERE td = ".$_SESSION["td"]." order by cod desc limit 1")) { 
        $cod = $r["cod"];
    } unset($r);

      $cod = $cod + 1;

        $datos = array();
        $datos["cod"] = $cod;
        $datos["categoria"] = $data["categoria"];
        $datos["item"] = strtoupper($data["item"]);
        $datos["hash"] = Helpers::HashId();
        $datos["time"] = Helpers::TimeId();
        $datos["td"] = $_SESSION["td"];
        if($db->insert("autoparts_item", $datos)){
           Alerts::Alerta("success","Realizado!","Modelo ingresado correctamente!");
        } 
     } else {
      Alerts::Alerta("error","Error!","Faltan Datos!");
     }

     $this->VerItem();
  }




  public function VerItem(){ // listado de modelos
    $db = new dbConn();

      $a = $db->query("SELECT * FROM autoparts_item WHERE td = ".$_SESSION["td"]."");
      if($a->num_rows > 0){
    echo '<table class="table table-sm table-hover">
      <thead>
        <tr>
          <th scope="col">Código</th>
          <th scope="col">Ítem Producto</th>
          <th scope="col">Eliminar</th>
        </tr>
      </thead>
      <tbody>';
          foreach ($a as $b) { ;
            echo '<tr>
                  <td>'.$b["cod"].'</td>
                  <td>'.$b["item"].'</td>
                  <td><a id="xdelete" valor="3" hash="'.$b["hash"].'" op="535"><i class="fa fa-minus-circle fa-lg red-text"></i></a></td>
                </tr>';          
          }
    echo '</tbody>
    </table>';

      } $a->close();
  }




  public function DelItem($hash){ // elimina 
    $db = new dbConn();
        if (Helpers::DeleteId("autoparts_item", "hash='$hash'")) {
           Alerts::Alerta("success","Eliminado!","Item eliminado correctamente!");
        } else {
            Alerts::Alerta("error","Error!","Algo Ocurrio!");
        } 
      $this->VerItem();
  }


















///// 
public function SelectStep(){

  if(!isset($_SESSION["detallesAtoparts"]["marca"])){
   $this->AddMarca();
  } 
  elseif(!isset($_SESSION["detallesAtoparts"]["modelo"])){
    $this->AddModelo();
  } 
  elseif(!isset($_SESSION["detallesAtoparts"]["anio"])){
    $this->AddAnio();
  }
    elseif(!isset($_SESSION["detallesAtoparts"]["anio2"])){
    $this->AddAnio2();
  } else {

    $this->DetallesSeleccion();
          echo '<div class="text-center"><a id="eliminardatos" op="525" class="btn btn-danger btn-rounded waves-effect">Eliminar Datos</a>
          <a id="cerrarDetallesProducto" class="btn btn-success btn-rounded">Continuar...</a>
          </div>';
  }

}

public function DetallesSeleccion(){
     $db = new dbConn();

  if($_SESSION["detallesAtoparts"] != NULL){

        if ($r = $db->select("marca", "autoparts_marca", "WHERE hash = '".$_SESSION["detallesAtoparts"]["marca"]."' and td = " . $_SESSION["td"])) { 
        $marca = $r["marca"];
    } unset($r);  

    if ($r = $db->select("modelo", "autoparts_modelo", "WHERE hash = '".$_SESSION["detallesAtoparts"]["modelo"]."' and td = " . $_SESSION["td"])) { 
        $modelo = $r["modelo"];
    } unset($r);  


  Alerts::Mensajex($marca . ' ' . $modelo . ' Desde  ' .$_SESSION["detallesAtoparts"]["anio"] . ' hasta ' .$_SESSION["detallesAtoparts"]["anio2"] , "success");
  }

}







  public function VerTodosProductos(){
      $db = new dbConn();

    if ($r = $db->select("marca", "autoparts_marca", "WHERE hash = '".$_SESSION["detallesAtoparts"]["marca"]."' and td = " . $_SESSION["td"])) { 
        $marca = $r["marca"];
    } unset($r);  

    if ($r = $db->select("modelo", "autoparts_modelo", "WHERE hash = '".$_SESSION["detallesAtoparts"]["modelo"]."' and td = " . $_SESSION["td"])) { 
        $modelo = $r["modelo"];
    } unset($r);  
 

 $a = $db->query("SELECT * FROM autoparts_busqueda_producto WHERE 
  marca = '".$marca."' and
  modelo = '".$modelo."' and
  (anio BETWEEN '".$_SESSION["detallesAtoparts"]["anio"]."' and '".$_SESSION["detallesAtoparts"]["anio2"]."') and
  (anio2 BETWEEN '".$_SESSION["detallesAtoparts"]["anio"]."' and '".$_SESSION["detallesAtoparts"]["anio2"]."') and   
  td = ".$_SESSION["td"]);
      
      if($a->num_rows > 0){
          echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th class="th-sm">Cod</th>
            <th class="th-sm">Producto</th>
            <th class="th-sm">Cantidad</th>
            <th class="th-sm">Precio</th>
            <th class="th-sm">Opciones</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
if ($r = $db->select("*", "producto", "WHERE cod = '".$b["producto"]."' and td = ". $_SESSION["td"] ."")) { 
        $nombre = $r["descripcion"];
        $cantidad = $r["cantidad"];  } unset($r); 


if ($r = $db->select("precio", "producto_precio", "WHERE producto = '".$b["producto"]."' and td = ". $_SESSION["td"] ." order by id asc limit 1")) { $precio = $r["precio"]; } unset($r); 
          echo '<tr>
                      <td>'.$b["producto"].'</td>
                      <td>'.$nombre.'</td>
                      <td><div id="cant-'.$b["producto"].'">'.$cantidad.'</div></td>
                      <td><div id="precio-'.$b["producto"].'">'.Helpers::Dinero($precio).'</div></td>
                      <td><a id="xver" op="55" key="'.$b["producto"].'" title="Ver Detalles"><i class="fas fa-search fa-lg green-text"></i></a>

                      <a id="addproducto" op="538" key="'.$b["producto"].'" title="Agregar mas producto"><i class="fas fa-plus-circle fa-lg blue-text"></i></a>

                      <a id="cambiarprecio" op="541" key="'.$b["producto"].'" title="Cambiar Precio"><i class="fas fa-money-bill-alt fa-lg black-text"></i></a>

                      </td>
                    </tr>';
        }
        echo '</tbody>
        </table>
        </div>';
      } else {
        Alerts::Mensajey("No se encontraron registros con estas especificaciones","danger", "verModal");
      }
        $a->close();
      


  } // termina productos










  public function TodosLosProductos(){
      $db = new dbConn();


 $a = $db->query("SELECT * FROM autoparts_busqueda_producto WHERE td = ".$_SESSION["td"]);
      
      if($a->num_rows > 0){
          echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th class="th-sm">Cod</th>
            <th class="th-sm">Producto</th>
            <th class="th-sm">Cantidad</th>
            <th class="th-sm">Precio</th>
            <th class="th-sm">Opciones</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
if ($r = $db->select("*", "producto", "WHERE cod = '".$b["producto"]."' and td = ". $_SESSION["td"] ."")) { 
        $nombre = $r["descripcion"];
        $cantidad = $r["cantidad"];  } unset($r); 


if ($r = $db->select("precio", "producto_precio", "WHERE producto = '".$b["producto"]."' and td = ". $_SESSION["td"] ." order by id asc limit 1")) { $precio = $r["precio"]; } unset($r); 
          echo '<tr>
                      <td>'.$b["producto"].'</td>
                      <td>'.$nombre.'</td>
                      <td><div id="cant-'.$b["producto"].'">'.$cantidad.'</div></td>
                      <td><div id="precio-'.$b["producto"].'">'.Helpers::Dinero($precio).'</div></td>
                      <td><a id="xver" op="55" key="'.$b["producto"].'" title="Ver Detalles"><i class="fas fa-search fa-lg green-text"></i></a>

                      <a id="addproducto" op="538" key="'.$b["producto"].'" title="Agregar mas producto"><i class="fas fa-plus-circle fa-lg blue-text"></i></a>

                      <a id="cambiarprecio" op="541" key="'.$b["producto"].'" title="Cambiar Precio"><i class="fas fa-money-bill-alt fa-lg black-text"></i></a>

                      </td>
                    </tr>';
        }
        echo '</tbody>
        </table>
        </div>';
      } else {
        Alerts::Mensajey("No se encontraron registros con estas especificaciones","danger", "verModal");
      }
        $a->close();
      


  } // termina productos












  public function AddProductos($data){
      $db = new dbConn();
// producto
// ingresado
// precio
// tags

if ($r = $db->select("hash", "producto_unidades", "WHERE td = ".$_SESSION["td"]." order by id asc limit 1")) { $medida = $r["hash"]; } unset($r);

if ($r = $db->select("hash", "proveedores", "WHERE td = ".$_SESSION["td"]." order by id asc limit 1")) { $proveedor = $r["hash"]; } unset($r);

if ($r = $db->select("hash", "ubicacion", "WHERE td = ".$_SESSION["td"]." and predeterminada = 1")) { $ubicacion = $r["hash"]; } unset($r);

  if($data["descripcion"] != NULL and $data["cantidad"] != NULL){ 

      $datos["cod"] = $data["cod"];
      $datos["descripcion"] = strtoupper($data["descripcion"]);
      $datos["categoria"] = $data["categoria"];
      $datos["cantidad"] = $data["cantidad"];
      $datos["medida"] = $medida;
      $datos["proveedor"] = $proveedor;
      $datos["existencia_minima"] = 1;
      $datos["gravado"] = "on";
      $datos["hash"] = Helpers::HashId();
      $datos["hash"] = Helpers::HashId();
      $datos["time"] = Helpers::TimeId();
      $datos["td"] = $_SESSION["td"];
    if ($db->insert("producto", $datos)) {
 

    $datax = array();
    $datax["ubicacion"] = $ubicacion;              
    $datax["producto"] = $data["cod"];
    $datax["cant"] = $data["cantidad"];
    $datax["td"] = $_SESSION["td"];
    $datax["hash"] = Helpers::HashId();
    $datax["time"] = Helpers::TimeId();
    $db->insert("ubicacion_asig", $datax);


    $data2 = array();
    $data2["producto"] = $data["cod"];
    $data2["marca"] = $_SESSION["detallesAtoparts"]["marcatxt"];
    $data2["modelo"] = $_SESSION["detallesAtoparts"]["modelotxt"];    
    $data2["anio"] = $_SESSION["detallesAtoparts"]["anio"];
    $data2["anio2"] = $_SESSION["detallesAtoparts"]["anio2"];
    $data2["hash"] = Helpers::HashId();
    $data2["time"] = Helpers::TimeId();
    $data2["td"] = $_SESSION["td"];
    $db->insert("autoparts_busqueda_producto", $data2);
        

        $ins = array();
        $ins["producto"] = $data["cod"];
        $ins["cant"] = $data["cantidad"];
        $ins["existencia"] = $data["cantidad"];
        $ins["precio_costo"] = $data["precio_costo"];
        $ins["fecha"] = date("d-m-Y");
        $ins["hora"] = date("H:i:s");
        $ins["td"] = $_SESSION["td"];
        $ins["hash"] = Helpers::HashId();
        $ins["time"] = Helpers::TimeId();
        $db->insert("producto_ingresado", $ins);      


        $doto1 = array();
        $doto1["producto"] = $data["cod"];
        $doto1["cant"] = 1;
        $doto1["precio"] = $data["precio"];
        $doto1["td"] = $_SESSION["td"];
        $doto1["hash"] = Helpers::HashId();
        $doto1["time"] = Helpers::TimeId();
        $db->insert("producto_precio", $doto1);  

        // tags
        $this->AddTag($data["cod"], $_SESSION["detallesAtoparts"]["marcatxt"]);
        $this->AddTag($data["cod"], $_SESSION["detallesAtoparts"]["modelotxt"]);

if($_SESSION["detallesAtoparts"]["anio"] < $_SESSION["detallesAtoparts"]["anio2"]){

    for ($i = $_SESSION["detallesAtoparts"]["anio"]; $i <= $_SESSION["detallesAtoparts"]["anio2"]; $i++) {
        $this->AddTag($data["cod"], $i);
    }

}elseif($_SESSION["detallesAtoparts"]["anio"] == $_SESSION["detallesAtoparts"]["anio2"]){

        $this->AddTag($data["cod"], $_SESSION["detallesAtoparts"]["anio"]);

} else {

    for ($i = $_SESSION["detallesAtoparts"]["anio2"]; $i <= $_SESSION["detallesAtoparts"]["anio"]; $i++) {
        $this->AddTag($data["cod"], $i);
    }

}
// termina tags
unset($_SESSION["detallesAtoparts"]);
Alerts::Alerta("success","Realizado!","Producto Guardado con éxito!");
Alerts::Mensajey("Seleccione Marca y Modelo para agregar un nuevo producto", "danger", "verModal");
  

}

  } else {
    Alerts::Alerta("error","Error!","Faltan Datos!");
    Alerts::Mensajey($_SESSION["detallesAtoparts"]["marcatxt"] . " - " . $_SESSION["detallesAtoparts"]["modelotxt"] . " Desde " .$_SESSION["detallesAtoparts"]["anio"] . " hasta " .$_SESSION["detallesAtoparts"]["anio2"] , "success", "verModal");
  }

    

}  // termina la fincion


    public function AddTag($producto, $tag){
      $db = new dbConn();
              $datos = array();
              $datos["producto"] = $producto;              
              $datos["tag"] = $tag;
              $datos["td"] = $_SESSION["td"];
              $datos["hash"] = Helpers::HashId();
              $datos["time"] = Helpers::TimeId();
             $db->insert("producto_tags", $datos);
    }



 public function BusquedaProductos($dato){
      $db = new dbConn();

      if($dato["keyword"] != NULL){
             $a = $db->query("SELECT * FROM autoparts_item WHERE (cod like '%".$dato["keyword"]."%' or item like '%".$dato["keyword"]."%') and td = ".$_SESSION["td"]." limit 10");
                if($a->num_rows > 0){
                    echo '<table class="table table-striped table-sm table-hover">';
            foreach ($a as $b) {
                       echo '<tr>
                              <td scope="row"><a id="select-p" 
                              cod="'. $b["cod"] . '-'.$_SESSION["detallesAtoparts"]["marcacod"].'-'.$_SESSION["detallesAtoparts"]["modelocod"].'-'.substr($_SESSION["detallesAtoparts"]["anio"], -2).''.substr($_SESSION["detallesAtoparts"]["anio2"], -2).'" 
                              categoria="'. $b["categoria"] .'" 
                              item="'. $b["item"] . ' - '. $_SESSION["detallesAtoparts"]["marcatxt"] .' '. $_SESSION["detallesAtoparts"]["modelotxt"] .', '. $_SESSION["detallesAtoparts"]["anio"] .' - '. $_SESSION["detallesAtoparts"]["anio2"] .'"
                              ><div>
                              '. $b["cod"] .'  || '. $b["item"] .'</div></a></td>
                            </tr>'; 
            }  
                        echo '<tr>
                              <td scope="row"><a id="cancel-p"><div>CANCELAR</div></a></td>
                            </tr>'; 
                $a->close();

                
              } else {
                 echo '<table class="table table-sm table-hover">';
                    echo '<tr>
                              <td scope="row">El criterio de busqueda no corresponde a nungun registro</td>
                            </tr>';
                    echo '<tr>
                              <td scope="row"><a id="cancel-p"><div>CANCELAR</div></a></td>
                            </tr>';
             }

          echo '</table>';
      }


}







    public function VerDatosProducto($key, $op = NULL){
      $db = new dbConn();

    if ($r = $db->select("descripcion", "producto", "WHERE cod = '$key' and td = ".$_SESSION["td"]."")) { 
        $descripcion = $r["descripcion"];
    } unset($r);  


if($op == NULL){
  echo '<input type="hidden" id="cod" name="cod" value="'.$key.'">
      <input type="hidden" id="descripcion" name="descripcion" value="'.$descripcion.'" >';
}


echo '<h4 class="h4-responsive">'.$key.' | '.$descripcion.'</h2>';

if($op == 1){

  echo '<h4 class="text-center"><strong>Precio Actual: '.Helpers::Dinero($this->VerPrecio($key)).'</strong></h4> 


  <div class="form-row d-flex justify-content-center mt-4">


<input type="hidden" id="producto" name="producto" value="'.$key.'"> <br>

    <div class="col-md-6 mb-1 md-form">
      <label for="cantidad">* Actualizar Precio</label>
      <input type="number" step="any" class="form-control" id="precio" name="precio" required>
    </div>

  </div>';

}



    }




    public function VerificarExistencia($key){
      $db = new dbConn();

  $a = $db->query("SELECT * FROM producto WHERE cod = '".$key."' and td = ".$_SESSION["td"]."");
  $cantidad = $a->num_rows;
  $a->close();

  if($cantidad > 0){
    echo "TRUE";
  } else {
    echo "FALSE";
  }
}






  public function VerCantidad($key){
      $db = new dbConn();
    if ($r = $db->select("cantidad", "producto", "WHERE cod = '$key' and td = ".$_SESSION["td"]."")) { 
        return $r["cantidad"];
    } unset($r);  
}




  public function VerPrecio($key){
     $db = new dbConn();
    if ($r = $db->select("precio", "producto_precio", "WHERE cant = 1 and producto = '$key' and td = ".$_SESSION["td"]."")) { 
        return $r["precio"];
    } unset($r); 
}


  public function CambiarPrecio($data){
     $db = new dbConn();
    
      $cambio = array();
      $cambio["precio"] = $data["precio"];
      if(Helpers::UpdateId("producto_precio", $cambio, "producto='".$data["producto"]."' and cant = 1 and td = ".$_SESSION["td"]."")){
        Alerts::Alerta("success","Realizado!","Cambio realizado exitosamente");
      }


}





} // Termina la lcase
?>