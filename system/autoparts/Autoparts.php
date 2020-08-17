<?php 
class Autoparts {

		public function __construct() { 
     	} 


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
          
          <a id="cerrarDetalles" class="btn btn-success btn-rounded">Continuar...</a>
          </div>';
  }

}

  public function AddMarca(){
    $db = new dbConn();

     echo '<blockquote class="blockquote bq-primary">
      <p class="bq-title">Seleccione una marca</p>
    </blockquote>';

    $a = $db->query("SELECT * FROM autoparts_marca WHERE td = " . $_SESSION["td"]);
    foreach ($a as $b) {
      
      echo '<a id="selectmarca" op="521" marca="'.$b["hash"].'" class="btn btn-info btn-rounded waves-effect">'.$b["marca"].'</a>';

    } $a->close();

  }




public function SelectMarca($marca){
  $_SESSION["detallesAtoparts"]["marca"] = $marca;

  $this->SelectStep();
}



  public function AddModelo(){
    $db = new dbConn();

     echo '<blockquote class="blockquote bq-primary">
      <p class="bq-title">Seleccione un Modelo</p>
    </blockquote>';

    $a = $db->query("SELECT * FROM autoparts_modelo WHERE marca = '".$_SESSION["detallesAtoparts"]["marca"]."' and td = " . $_SESSION["td"]);
    foreach ($a as $b) {
      
      echo '<a id="selectmodelo" op="522" modelo="'.$b["hash"].'" type="button" class="btn btn-secondary btn-rounded waves-effect">'.$b["modelo"].'</a>';

    } $a->close();

  }




public function SelectModelo($modelo){
  $_SESSION["detallesAtoparts"]["modelo"] = $modelo;

  $this->SelectStep();
}




  public function AddAnio(){
    $db = new dbConn();

     echo '<blockquote class="blockquote bq-primary">
      <p class="bq-title">Seleccione un Año</p>
    </blockquote>';

        for ($i = 2000; $i <= date("Y"); $i++) {
        echo '<a id="selectanio" op="523" anio="'.$i.'" type="button" class="btn btn-primary btn-rounded waves-effect">'.$i.'</a>';
        }
  }


public function SelectAnio($anio){
  $_SESSION["detallesAtoparts"]["anio"] = $anio;

  $this->SelectStep();
}


  public function AddMotor(){
    $db = new dbConn();

     echo '<blockquote class="blockquote bq-primary">
      <p class="bq-title">Seleccione un Motor</p>
    </blockquote>';

      
    $a = $db->query("SELECT * FROM autoparts_motor WHERE marca = '".$_SESSION["detallesAtoparts"]["marca"]."' and td = " . $_SESSION["td"]);
    foreach ($a as $b) {
      
      echo '<a id="selectmotor" op="526" motor="'.$b["hash"].'" type="button" class="btn btn-secondary btn-rounded waves-effect">'.$b["motor"].'</a>';

    } $a->close();
      echo '<a id="selectmotor" op="526" motor="" type="button" class="btn btn-warning btn-rounded waves-effect">Ninguno</a>';        
  }

public function SelectMotor($motor){
  $_SESSION["detallesAtoparts"]["motor"] = $motor;

  $this->SelectStep();
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

  Alerts::Mensajey($marca . ", " . $modelo . ", " . $motor . ", " .$_SESSION["detallesAtoparts"]["anio"], "success", "verModal");
  }

}


public function EliminarDatos(){
  
  unset($_SESSION["detallesAtoparts"]); 

  $this->SelectStep();
}







/// va en producto y se insertan los datos para el producto en funcion
public function InsertDataProduct($producto){
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

    $anio = $_SESSION["detallesAtoparts"]["anio"];

    $datos = array();
    $datos["producto"] = $producto;
    $datos["marca"] = $marca;
    $datos["modelo"] = $modelo;
    $datos["motor"] = $motor;
    $datos["anio"] = $anio;
    $datos["hash"] = Helpers::HashId();
    $datos["time"] = Helpers::TimeId();
    $datos["td"] = $_SESSION["td"];
    if($db->insert("autoparts_busqueda_producto", $datos)){
      unset($_SESSION["detallesAtoparts"]);
    }



  }

}





} // Termina la lcase
?>