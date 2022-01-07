<?php 
class ModificaTags {

    public function verificaCambio(){
        $db = new dbConn();
        
        $a = $db->query("SELECT * FROM system_modify WHERE td = " . $_SESSION['td']);
        $num =  $a->num_rows;
        $a->close();

        if ($num > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function EjecutarCambios(){
        $db = new dbConn();

        if ($this->verificaCambio() == false) {
           
            $a = $db->query("SELECT cod FROM producto WHERE td = " . $_SESSION['td']);
            foreach ($a as $b) {

                // obtener los tags de cada producto
            if ($y = $db->query("SELECT * FROM producto_tags WHERE producto = '" . $b['cod'] . "' and td = " . $_SESSION['td'])) {

                if ($y->num_rows > 0) {
                    $tags = array();
                    $iden = 0;

                    foreach ($y as $z) {
                        $tags[$iden] = $z['tag'];
                        $iden ++;
                    }
                // eliminar los tags del producto
                    $db->delete("producto_tags", "WHERE producto='" . $b['cod'] . "' and td = " . $_SESSION['td']);
                // obtener las palabras en una sola cadena
                $cadena = NULL;
                // foreach ($tags as $tag) {
                //     $cadena .= $tag . ',';
                // }


                $i = 0;
                $cadena = null;
                foreach ($tags as $tag) {
                    if ($i == 0) {
                        $cadena .= trim($tag);
                      } else {
                        $cadena .= "," . trim($tag);
                      }
                      $i++;
                }

                //insertar los nuevos tags ordenadamente 

                $datos = array();
                $datos["producto"] = $b['cod'];              
                $datos["tag"] = $cadena;
                $datos["td"] = $_SESSION["td"];
                $datos["hash"] = Helpers::HashId();
                $datos["time"] = Helpers::TimeId();
                $db->insert("producto_tags", $datos);


                unset($datos);
                unset($cadena);

                } 
                $y->close();
            } 
           
            } $a->close();


            $data = array();
            $data["tags"] = 1;
            $data["td"] = $_SESSION["td"];
            $data["hash"] = Helpers::HashId();
            $data["time"] = Helpers::TimeId();
            $db->insert("system_modify", $data);


        }
    }






} // Termina la lcase

?>