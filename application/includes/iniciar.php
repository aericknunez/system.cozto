<?php
include_once '../common/Helpers.php'; // [Para todo]
include_once '../includes/variables_db.php';
include_once '../common/Mysqli.php';
$db = new dbConn();
include_once '../includes/DataLogin.php';
$seslog = new Login();
$seslog->sec_session_start();

include_once '../common/Encrypt.php';
include_once '../common/Alerts.php';
include_once '../common/Fechas.php';
include_once '../../system/index/Inicio.php';
include_once '../../system/config_configuraciones/Config.php';


if($_SESSION['username'] == NULL){
header("location: logout.php");
exit();
}

if ($seslog->login_check() == TRUE) {

$user=$_SESSION['username'];
$_SESSION["ver_avatar"] = NULL;

	function UserInicio($user){
        $db = new dbConn();
            if ($r = $db->select("*", "login_userdata", "WHERE user = '$user' limit 1")) { 
            $_SESSION['nombre'] = $r["nombre"];
            $_SESSION['tipo_cuenta'] = $r["tipo"];
            $_SESSION['tkn'] = $r["tkn"];
            $_SESSION['avatar'] = $r["avatar"];
            $_SESSION['user'] = $user;
            $_SESSION['td'] = $r["td"];
            $_SESSION['secret_key'] = md5($r["td"]);

            } unset($r);

            BuscaDatosSistema();

        $configuracion = new Config;
        $configuracion->CrearVariables(); // creo el resto de variables del sistema

        $inicia = new Inicio;
        $inicia->Caduca(); // revisa si ha caducado

        header("location: ../../");
    }


    function BuscaDatosSistema(){
        $db = new dbConn();

            if ($r = $db->select("*", "config_master", "WHERE td = " . $_SESSION['td'])) { 
                if($r["cliente"] == NULL or $r["moneda"] == NULL){
                        $_SESSION['nodatainicial'] = md5($_SESSION['td']); // es para los que no llena datos 
                      header("location: ../../?modal=conf_config&inicio");
                       exit();
                }  
            } unset($r); 
    }


UserInicio($user);

} else {
   header("location: logout.php");
    exit(); 
}
?>