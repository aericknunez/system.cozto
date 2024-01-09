<?php

class Success {
   // Llaves   
   public function __construct(){
      
   }
   


////////////////// imagen cotizacion ////////////////////////////
   public function SaveImg($cotizacion, $img, $descripcion){ // guarda imagen del producto
   $db = new dbConn();
      
          $datos = array();
          $datos["cotizacion"] = $cotizacion;
          $datos["imagen"] = $img;
          $datos["descripcion"] = $descripcion;
          $datos["fecha"] = date("d-m-Y");
          $datos["fechaF"] = Fechas::Format(date("d-m-Y"));
          $datos["hora"] = date("H:i:s");
          $datos["hash"] = Helpers::HashId();
          $datos["time"] = Helpers::TimeId();
          $datos["td"] = $_SESSION["td"];
          $db->insert("cotizaciones_images", $datos);    

          $this->VerImagenCotizacion($cotizacion);
          $this->ImagenesCotizacion($cotizacion);
   }


    public function VerImagenCotizacion($cotizacion, $iden  = NULL) {
        $db = new dbConn();

            if($iden == NULL){
              $r = $db->select("imagen, descripcion", "cotizaciones_images", "WHERE cotizacion = '$cotizacion' and td = ".$_SESSION["td"]." order by id desc limit 1");
            } else {
              $r = $db->select("imagen, descripcion", "cotizaciones_images", "WHERE cotizacion = '$cotizacion' and id = '$iden' and td = ".$_SESSION["td"]."");
            }
             
            if($r["imagen"] != NULL){
              $img = 'assets/img/cotizacionesimg/'  . $_SESSION["td"] . '/' .$r["imagen"];
            } else {
              $img = 'assets/img/gastosimg/default.jpg';
            }
            echo '<div id="mostrarimagen"><img src="'.$img.'" class="img-fluid" alt="Imagen de gasto"> <br>' .$r["descripcion"] . '</div>';
            unset($r);  
    }



    public function ImagenesCotizacion($iden) {
        $db = new dbConn();

        $a = $db->query("SELECT * FROM cotizaciones_images WHERE cotizacion = '$iden' and td = ".$_SESSION["td"]."");
        echo '<div class="row" id="mostrarimagenes">';
            foreach ($a as $b) {
              echo '<div class="col-md-2"><a id="verimagen" iden="'.$b["id"].'" cotizacion="'.$iden.'"><img src="assets/img/cotizacionesimg/' . $_SESSION["td"] . '/' .$b["imagen"].'" alt="thumbnail" class="img-thumbnail z-depth-3 ml-1 mr-1"
          style="width: 100px; height: 75px"></a>
          <a id="borrar-img" op="17-1" hash="'.$b["imagen"].'" cotizacion="'.$iden.'"><span class="badge badge-danger">Eliminar</span></a></div>';

            }; echo '</div>';
            $a->close();
    }

    public function BorrarImagen($img, $src, $cotizacion){ // borrar imagenes del producto
      
          if (Helpers::DeleteId("cotizaciones_images", "imagen='$img' and td=".$_SESSION["td"]."")) {
               if (file_exists($src. $img)) {
                   unlink($src . $img);
                Alerts::Alerta("success","Eliminado!","Imagen Eliminada!");   
               }
               Alerts::Alerta("danger","Advertencia!","Eliminada del registro!");
          } else {
            Alerts::Alerta("error","Error!","Ocurrio algo Inesperado!");
          }
          $this->VerImagenCotizacion($cotizacion);
          $this->ImagenesCotizacion($cotizacion);
      }
   

}
?>

