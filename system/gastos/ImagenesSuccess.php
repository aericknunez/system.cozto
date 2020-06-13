<?php

class Success {
   // Llaves   
   public function __construct(){
      
   }
   


////////////////// imagen gasto ////////////////////////////
   public function SaveGasto($gasto, $img, $descripcion){ // guarda imagen del producto
   $db = new dbConn();
      
          $datos = array();
          $datos["gasto"] = $gasto;
          $datos["imagen"] = $img;
          $datos["descripcion"] = $descripcion;
          $datos["fecha"] = date("d-m-Y");
          $datos["fechaF"] = Fechas::Format(date("d-m-Y"));
          $datos["hora"] = date("H:i:s");
          $datos["hash"] = Helpers::HashId();
          $datos["time"] = Helpers::TimeId();
          $datos["td"] = $_SESSION["td"];
          $db->insert("gastos_images", $datos);    

          $this->VerImagenGasto($gasto);
          $this->ImagenesGasto($gasto);
   }


    public function VerImagenGasto($gasto, $iden  = NULL) {
        $db = new dbConn();

            if($iden == NULL){
              $r = $db->select("imagen, descripcion", "gastos_images", "WHERE gasto = '$gasto' and td = ".$_SESSION["td"]." order by id desc limit 1");
            } else {
              $r = $db->select("imagen, descripcion", "gastos_images", "WHERE gasto = '$gasto' and id = '$iden' and td = ".$_SESSION["td"]."");
            }
             
            if($r["imagen"] != NULL){
              $img = 'assets/img/gastosimg/'  . $_SESSION["td"] . '/' .$r["imagen"];
            } else {
              $img = 'assets/img/gastosimg/default.jpg';
            }
            echo '<div id="mostrarimagen"><img src="'.$img.'" class="img-fluid" alt="Imagen de gasto"> <br>' .$r["descripcion"] . '</div>';
            unset($r);  
    }



    public function ImagenesGasto($iden) {
        $db = new dbConn();

        $a = $db->query("SELECT * FROM gastos_images WHERE gasto = '$iden' and td = ".$_SESSION["td"]."");
        echo '<div id="mostrarimagenes">';
            foreach ($a as $b) {
              echo '<a id="verimagen" iden="'.$b["id"].'" gasto="'.$iden.'"><img src="assets/img/gastosimg/' . $_SESSION["td"] . '/' .$b["imagen"].'" alt="thumbnail" class="img-thumbnail z-depth-3 ml-1 mr-1"
          style="width: 100px; height: 75px"></a>';

            } echo '</div>';
            $a->close();
    }









}
?>