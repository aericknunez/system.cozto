<?php 
class Productos{

		public function __construct() { 
     	} 


  public function Busqueda($dato){ // Busqueda para busqueda lenta
    $db = new dbConn();
      if($dato["keyword"] != NULL){
             $a = $db->query("SELECT * FROM producto WHERE (cod like '%".$dato["keyword"]."%' or descripcion like '%".$dato["keyword"]."%') and td = ".$_SESSION["td"]." order by descripcion limit 10 " );
                if($a->num_rows > 0){
                    echo '<table class="table table-striped table-sm table-hover">';
            foreach ($a as $b) {
                       echo '<tr>
                              <td scope="row"><a id="select-p" cod="'. $b["cod"] .'" descripcion="'. $b["descripcion"] .'"><div>
                              '. $b["cod"] .'  || '. $b["descripcion"] .' || '.'Precio: '.Helpers::Dinero(Helpers::GetData("producto_precio","precio","producto", $b["cod"] )).'</div></a></td>
                            </tr>'; 
            }  
                        echo '<tr>
                              <td scope="row"><a id="cancel-p"><div>CANCELAR</div></a></td>
                            </tr>'; 
                $a->close();

                
              } else {
                 echo '<table class="table table-sm table-hover">';
                    echo '<tr>
                              <td scope="row">El criterio de busqueda no corresponde a un producto</td>
                            </tr>';
                    echo '<tr>
                              <td scope="row"><a id="cancel-p"><div>CANCELAR</div></a></td>
                            </tr>';
             }

          echo '</table>';
      }

  }



  public function TempProducto($dato){ // revisa las propuedades del producto para mostrarlos (lento)
    $db = new dbConn();

  if ($r = $db->select("*", "producto", "WHERE cod = '". $dato["cod"] ."' and td = ".$_SESSION["td"]."")) {  
    $cantidad = $r["cantidad"];
    $medida = $r["medida"];
    $servicio = $r["servicio"];
  } unset($r); 

  if ($s = $db->select("*", "producto_unidades", "WHERE hash = '$medida' and td = ".$_SESSION["td"]."")) { 
    $nombreU = $s["nombre"];
  } unset($s); 

if ($img = $db->select("imagen", "producto_imagenes", "WHERE producto = '". $dato["cod"] ."' and td = ".$_SESSION["td"]." limit 1")) { 
    $Imagen = $img["imagen"];
  } unset($img); 
// if($Imagen == NULL) { $Imagen = "assets/img/logo/" . $_SESSION["config_imagen"]; } else { $Imagen = "assets/img/productos/". $_SESSION["td"] . '/' . $Imagen; }


echo '<section class="my-2">
  <div class="row">
    <div class="col-lg-5 col-xl-4">';

    if($Imagen) {
      echo '<div class="view overlay rounded z-depth-1-half mb-lg-0 mb-1">
            <img class="img-fluid" src="' .$Imagen.'" alt="Titulo del producto">
            <a>
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>';
    }

    echo '</div>

    <div class="col-lg-7 col-xl-8">

      <h3 class="font-weight-bold mb-1"><strong>'.$dato["descripcion"].'</strong></h3>
      <p>Cantidad disponible: <a class="font-weight-bold">'.$cantidad.'</a> '.$nombreU.'</p>

      <p class="dark-grey-text">';
 
if($servicio == "on"){
Alerts::Mensajex("Puede agregar la cantidad que desee","success");

echo '<div class="md-form md-outline form-sm col-md-2">';
echo '<label for="cantidad">Cantidad</label>
  <input id="cantidad" name="cantidad" class="form-control form-control-sm" type="number" value="1" step="any" min="1">';  
echo '</div>';

// or 

} else {

  if($cantidad <= 0 && $_SESSION["config_agotado"] == ""){


        
        echo '<div class="md-form md-outline form-sm col-md-2">';
        
        ($cantidad <= 0) ? $value = 1 : $value = 0;

        echo '<label for="cantidad">Cantidad</label>
              <input id="cantidad" name="cantidad" class="form-control form-control-sm" type="number" value="'.$value.'" step="any" min="1">';
        echo '</div>';

        $this->CompruebaCaracteristicas($dato["cod"]);
        $this->CompruebaUbicaciones($dato["cod"]);
      }

  if($cantidad <= 0 && $_SESSION["config_agotado"] == "on"){
    
       Alerts::Mensajex("No hay productos disponibles en inventario","danger",$boton,$boton2);
     }

       ($cantidad > 0) ? $value = 1 : $value = 0;

       echo '<div class="md-form md-outline form-sm col-md-2">';


if($cantidad <= 0){


} else {
    echo '<label for="cantidad">Cantidad</label>
      <input id="cantidad" name="cantidad" class="form-control form-control-sm" type="number" value="'.$value.'" step="any" max="'. $cantidad .'" min="1">';
      
    echo '</div>';

    $this->CompruebaCaracteristicas($dato["cod"]);
    $this->CompruebaUbicaciones($dato["cod"]);
}   

}// sino es servicio

    echo '</p>
              <input id="cod" name="cod" type="hidden" value="'. $dato["cod"] .'">
              <input id="servicio" name="servicio" type="hidden" value="'. $servicio .'">
              <input id="unidades" name="unidades" type="hidden" value="'. $cantidad .'">
    </div>

  </div>

</section>';

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
              <input type="number" step="any" class="form-control form-control-sm" id="caracteristica['. $b["caracteristica"] .']" name="caracteristica['. $b["caracteristica"] .']" max="'. $b["cant"] .'">
            </div>';
    } 
      echo '</div>';

    }  $a->close();
    
 }

// Carmen de Cocina del abuelo

 public function CompruebaUbicaciones($cod){
  $db = new dbConn();

  $a = $db->query("SELECT * FROM ubicacion_asig WHERE producto = '$cod' and td = ".$_SESSION["td"]."");

    if($a->num_rows > 0){
        echo 'Ubicaci&oacuten del producto
        <div class="form-row">';

        $number = 0;
      foreach ($a as $b) {
        $number ++;

              if ($r = $db->select("ubicacion", "ubicacion", "WHERE hash = '". $b["ubicacion"] ."' and td = ".$_SESSION["td"]."")) { 
                  $ubi = $r["ubicacion"];
              } unset($r); 

        if($number == 1){ $check = "checked"; } else { $check = ""; }

        echo '<div class="form-check form-check-inline">
              <input type="radio" class="form-check-input" id="'. $b["ubicacion"] .'" name="ubicacion" value="'. $b["ubicacion"] .'" '.$check.'>
              <label class="form-check-label" for="'. $b["ubicacion"] .'">'. $ubi .'</label>
            </div>';


    } 
      echo '</div>';

    }  $a->close();

 }







} // Termina la lcase
?>