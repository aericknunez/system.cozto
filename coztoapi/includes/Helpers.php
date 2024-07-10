<?php
class Helpers{

    public function __construct(){

    } 


    public static function ServerDomain(){
          if($_SERVER["SERVER_NAME"] == "hibridosv.com" 
          or $_SERVER["SERVER_NAME"] == "www.hibridosv.com"
          or $_SERVER["SERVER_NAME"] == "coztoapi.hibridosv.com"){
            return TRUE;
          } else {
            return FALSE;
          }
    }


    public static function CodigoValidacionHora(){ // codigo de 8 digitos qu cambia cada hora
        $id = date("d-m-Y-H");
        $iden = sha1($id); 
        $hash = strtoupper(substr($iden,0,8));  

        return $hash;
    }




///////////// para usos de control de usuario ////////
    static public function GetIp(){
        // Intentamos primero saber si se ha utilizado un proxy para acceder a la página,
            // y si éste ha indicado en alguna cabecera la IP real del usuario.
            if (getenv('HTTP_CLIENT_IP')) {
              $ip = getenv('HTTP_CLIENT_IP');
            } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
              $ip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_X_FORWARDED')) {
              $ip = getenv('HTTP_X_FORWARDED');
            } elseif (getenv('HTTP_FORWARDED_FOR')) {
              $ip = getenv('HTTP_FORWARDED_FOR');
            } elseif (getenv('HTTP_FORWARDED')) {
              $ip = getenv('HTTP_FORWARDED');
            } else {
              // Método por defecto de obtener la IP del usuario
              // Si se utiliza un proxy, esto nos daría la IP del proxy
              // y no la IP real del usuario.
              $ip = $_SERVER['REMOTE_ADDR'];
            }

            return $ip;
    }



    static public function ObtenerNavegador($user_agent) {
     $navegadores = array(
          'Opera' => 'Opera',
          'Mozilla Firefox'=> '(Firebird)|(Firefox)',
          'Galeon' => 'Galeon',
          'Google Chrome' => 'Chrome',
          'Mozilla'=>'Gecko',
          'MyIE'=>'MyIE',
          'Lynx' => 'Lynx',
          'Netscape' => '(Mozilla/4\.75)|(Netscape6)|(Mozilla/4\.08)|(Mozilla/4\.5)|(Mozilla/4\.6)|(Mozilla/4\.79)',
          'Konqueror'=>'Konqueror',
          'Internet Explorer 7' => '(MSIE 7\.[0-9]+)',
          'Internet Explorer 6' => '(MSIE 6\.[0-9]+)',
          'Internet Explorer 5' => '(MSIE 5\.[0-9]+)',
          'Internet Explorer 4' => '(MSIE 4\.[0-9]+)',
            );
            foreach($navegadores as $navegador=>$pattern){
                   if (eregi($pattern, $user_agent))
                   return $navegador;
                }
            return 'Desconocido';
            }


////////////////////////////// Nuevos Hash $id = base_convert(microtime(false), 10, 36);
public static function HashId(){
  $id = $_SESSION["td"] . "-" . date("d-m-Y-H:i:s") . rand(1,999999999);
  $iden = sha1($id);
  $hash = substr($iden,0,10);
  return $hash;
}


public static function TimeId(){
  $id = strtotime(date("H:i:s"));
  return $id;
}


public static function DeleteId($tabla, $condicion){
  $db = new dbConn();
      if($_SESSION["root_plataforma"] == 0 and $_SESSION['root_tipo_sistema'] != 0){
        $a = $db->query("SELECT hash FROM {$tabla} WHERE {$condicion}"); 
        foreach ($a as $b) {
              $datos = array();
              $datos["tabla"] = $tabla;
              $datos["hash"] = $b["hash"];
              $datos["time"] = self::TimeId();
              $datos["action"] = 1;
              $datos["td"] = $_SESSION["td"];
              $db->insert("sync_tables_updates", $datos);
              if($db->delete($tabla, "WHERE {$condicion}")){
                return TRUE;
              } else {
                return FALSE;
              }
          unset($datos);
        } $a->close();
      } else {
            if($db->delete($tabla, "WHERE {$condicion}")){
                return TRUE;
              } else {
                return FALSE;
              }
      }
}


public static function UpdateId($tabla, $dato, $condicion){
  $db = new dbConn(); // dato actualzar y datos insertar
      if($_SESSION["root_plataforma"] == 0 and $_SESSION['root_tipo_sistema'] != 0){
        $a = $db->query("SELECT hash FROM {$tabla} WHERE {$condicion}"); 
        foreach ($a as $b) {
              $datos = array();
              $datos["tabla"] = $tabla;
              $datos["hash"] = $b["hash"];
              $datos["time"] = self::TimeId();
              $datos["action"] = 2;
              $datos["td"] = $_SESSION["td"];

              /// verifico si hay registro, lo actualizao, sino  lo agrego
              $reg = $db->query("SELECT * FROM sync_tables_updates WHERE tabla = '$tabla' and hash = '".$b["hash"]."' and td = ".$_SESSION["td"]."");
              if($reg->num_rows == 0){
                $db->insert("sync_tables_updates", $datos);
              } else {
                $datopre["time"] = self::TimeId();
                $db->update("sync_tables_updates", $datopre, "WHERE tabla = '$tabla' and hash = '".$b["hash"]."' and td = ".$_SESSION["td"]."");
              } $reg->close();
               /// con esto nada mas se registra una vez           


              $dato["time"] = self::TimeId();
              if($db->update($tabla, $dato, "WHERE {$condicion}")){
                return TRUE;
              } else {
                return FALSE;
              }
          unset($datos);
        } $a->close(); // foreach

      } else { // si es web solo actualizo y ya
            $dato["time"] = self::TimeId();
            if($db->update($tabla, $dato, "WHERE {$condicion}")){
                return TRUE;
              } else {
                return FALSE;
              }
      }  
}



static public function GetData($tabla, $campo, $tabla_id, $hash) {
  // tabla a buscar
  // campo a retornar
  // nombre de la tabla a identificar
  // valor del campo
    $db = new dbConn();

  if($r = $db->select($campo, $tabla, "WHERE $tabla_id = '".$hash."'")) { 
    return $r[$campo]; 
  } unset($r); 

}







} // class
?>