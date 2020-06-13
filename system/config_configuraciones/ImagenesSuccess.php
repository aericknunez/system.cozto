<?php

class Success {
   // Llaves   
   public function __construct(){
      
   }
   


////////// imagen negocio (logo)
    public function VerImgNegocio($src){
          $db = new dbConn();

        if ($r = $db->select("imagen", "config_master", "WHERE td = ".$_SESSION["td"]."")) { 
          echo '<img src="'.$src.$r["imagen"].'" class="img-fluid z-depth-1">';
         } unset($r); 
    }


   public function SaveImagen($img, $ancho, $alto){
          $db = new dbConn();

          if ($r = $db->select("imagen", "config_master", "WHERE td = ".$_SESSION["td"]."")) { 
            $imgx = "../../assets/img/logo/" . $r["imagen"];
            @unlink($imgx);
           } unset($r); 

            $cambio = array();
            $cambio["imagen"] = $img;
            Helpers::UpdateId("config_master", $cambio, "td = ".$_SESSION["td"]."");

        $this->VerImgNegocio("assets/img/logo/");
    }


///////









}
?>