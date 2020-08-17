<?php 
class Autoparts {

		public function __construct() { 
     	} 



public function AddMarca($data){
     $db = new dbConn();

     if ($data["marca"] != NULL) {
        $datos = array();
        $datos["marca"] = $data["marca"];
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
        $datos = array();
        $datos["marca"] = $data["marca-modelo"];
        $datos["modelo"] = $data["modelo"];
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










public function AddMotor($data){
     $db = new dbConn();

     if ($data["motor"] != NULL) {
        $datos = array();
        $datos["marca"] = $data["marca-motor"];
        $datos["motor"] = $data["motor"];
        $datos["hash"] = Helpers::HashId();
        $datos["time"] = Helpers::TimeId();
        $datos["td"] = $_SESSION["td"];
        if($db->insert("autoparts_motor", $datos)){
           Alerts::Alerta("success","Realizado!","Modelo ingresado correctamente!");
        } 
     } else {
      Alerts::Alerta("error","Error!","Faltan Datos!");
     }

     $this->VerMotor();
  }




  public function VerMotor(){ // listado de motores
    $db = new dbConn();

      $a = $db->query("SELECT autoparts_motor.hash as hash, autoparts_motor.motor as motor, autoparts_marca.marca as marca FROM autoparts_motor inner join autoparts_marca on autoparts_motor.marca = autoparts_marca.hash WHERE autoparts_motor.td = ".$_SESSION["td"]." order by autoparts_motor.marca");
      if($a->num_rows > 0){
    echo '<table class="table table-sm table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Marca</th>
          <th scope="col">Motor</th>
          <th scope="col">Eliminar</th>
        </tr>
      </thead>
      <tbody>';
      $n = 1;
          foreach ($a as $b) { ;
            echo '<tr>
                  <th scope="row">'. $n ++ .'</th>
                  <td>'.$b["marca"].'</td>
                  <td>'.$b["motor"].'</td>
                  <td><a id="xdelete" valor="3" hash="'.$b["hash"].'" op="535"><i class="fa fa-minus-circle fa-lg red-text"></i></a></td>
                </tr>';          
          }
    echo '</tbody>
    </table>';

      } $a->close();
  }




  public function DelMotor($hash){ // elimina 
    $db = new dbConn();
        if (Helpers::DeleteId("autoparts_motor", "hash='$hash'")) {
           Alerts::Alerta("success","Eliminado!","Motor eliminada correctamente!");
        } else {
            Alerts::Alerta("error","Error!","Algo Ocurrio!");
        } 
      $this->VerMotor();
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
    elseif(!isset($_SESSION["detallesAtoparts"]["motor"])){
    $this->AddMotor();
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

    if ($r = $db->select("motor", "autoparts_motor", "WHERE hash = '".$_SESSION["detallesAtoparts"]["motor"]."' and td = " . $_SESSION["td"])) { 
        $motor = $r["motor"];
    } unset($r);  

  Alerts::Mensajex($marca . ", " . $modelo . ", " . $motor . ", " .$_SESSION["detallesAtoparts"]["anio"], "success");
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

    if ($r = $db->select("motor", "autoparts_motor", "WHERE hash = '".$_SESSION["detallesAtoparts"]["motor"]."' and td = " . $_SESSION["td"])) { 
        $motor = $r["motor"];
    } unset($r);  

 $a = $db->query("SELECT * FROM autoparts_busqueda_producto WHERE 
  marca = '".$marca."' and
  modelo = '".$modelo."' and
  motor like '%".$motor."%' and 
  anio = '".$_SESSION["detallesAtoparts"]["anio"]."' and   
  td = ".$_SESSION["td"]);
      
      if($a->num_rows > 0){
          echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th class="th-sm">Cod</th>
            <th class="th-sm">Producto</th>
            <th class="th-sm">Cantidad</th>
            <th class="th-sm">Categoria</th>
            <th class="th-sm">Minimo</th>
            <th class="th-sm">Ver</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
    if ($r = $db->select("*", "producto", "WHERE cod = ".$b["producto"]." and td = ". $_SESSION["td"] ."")) { 
        $nombre = $r["descripcion"]; } unset($r); 

          echo '<tr>
                      <td>'.$b["producto"].'</td>
                      <td>'.$nombre.'</td>
                      <td>'.$b["marca"].'</td>
                      <td>'.$b["modelo"].'</td>
                      <td>'.$b["motor"].'</td>
                      <td><a id="xver" op="55" key="'.$b["producto"].'"><i class="fas fa-search fa-lg green-text"></i></a></td>
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













} // Termina la lcase
?>