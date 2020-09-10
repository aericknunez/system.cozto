<?php

class Success {
   // Llaves   
   public function __construct(){
      
   }
   

   public function SaveProducto($producto, $img, $descripcion, $ancho, $alto){ // guarda imagen del producto
   $db = new dbConn();
      
          $datos = array();
          $datos["producto"] = $producto;
          $datos["imagen"] = $img;
          $datos["descripcion"] = $descripcion;
          $datos["ancho"] = $ancho;
          $datos["alto"] = $alto;
          $datos["hash"] = Helpers::HashId();
          $datos["time"] = Helpers::TimeId();
          $datos["td"] = $_SESSION["td"];
          $db->insert("producto_imagenes", $datos);    

          $this->VerProducto($producto, "assets/img/productos/" . $_SESSION["td"] . "/");
   }

   public function VerProducto($producto, $src){ // ver imagenes del producto
   $db = new dbConn();

       $a = $db->query("SELECT * FROM producto_imagenes WHERE producto = '$producto' and td = ".$_SESSION["td"]."");
       echo '<div class="row">';
       foreach ($a as $b) {
         echo '<div class="col-md-2">';
          echo '<img src="'.$src.$b["imagen"].'" alt="thumbnail" class="img-thumbnail" style="width: 100px">
          <div align="center"><a id="borrar-img" op="17" hash="'.$b["imagen"].'" producto="'.$producto.'"><span class="badge badge-danger">Eliminar</span></a></div>
          </div>';
       } $a->close();
       echo '</div>';
   }




   public function VerImg($producto, $src){ // ver imagenes del producto
   $db = new dbConn();

          
       $a = $db->query("SELECT * FROM producto_imagenes WHERE producto = '$producto' and td = ".$_SESSION["td"]."");
             if($a->num_rows > 0){
             foreach ($a as $b) {
               echo '<figure class="col-md-3">
                      <a href="'.$src.$b["imagen"].'" data-size="'.$b["ancho"].'x'.$b["alto"].'">
                        <img src="'.$src.$b["imagen"].'" class="img-fluid z-depth-1">
                      </a>
                      <figcaption>'.$b["descripcion"].'</figcaption>
                    </figure>';
             } $a->close();
          } else {
            Alerts::Mensajex("No hay ninguna imagen que mostrar","danger",$boton,$boton2);
          }
   }





   public function BorrarImagen($img, $src, $producto){ // borrar imagenes del producto
   $db = new dbConn();

       if (Helpers::DeleteId("producto_imagenes", "imagen='$img' and td=".$_SESSION["td"]."")) {
            if (file_exists($src . $img)) {
                unlink($src . $img);
                unlink($src ."/tmb/tmb_". $img);
             Alerts::Alerta("success","Eliminado!","Imagen Eliminada!");   
            }
            Alerts::Alerta("danger","Advertencia!","Eliminada del registro!");
       } else {
         Alerts::Alerta("error","Error!","Ocurrio algo Inesperado!");
       }


        $this->VerProducto($producto, "assets/img/productos/" . $_SESSION["td"] . "/");
   }









}
?>