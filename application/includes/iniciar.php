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
include_once '../../system/corte/CorteMultiple.php';

if($_SESSION['username'] == NULL){
header("location: logout.php");
exit();
}

// para eliminar las variables de login admin
unset($_SESSION["session_unluck"], $_SESSION["login_admin"]);


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

            if(VerificaDataInicial() == FALSE){
                    // inserto ubicacion predeterminada
                    AddDataInicial();
            }

            BuscaDatosSistema();

        $configuracion = new Config;
        $configuracion->CrearVariables(); // creo el resto de variables del sistema

        /// reviso si la caja esta aperturada en este usuario
        $corte = new Corte();
        if($corte->ComprobarApertura() == TRUE){
            $_SESSION["caja_apertura"] = $corte->ObtenerHash();
        }


// agrego el tipo de ticket predeterminado
if ($r = $db->select("predeterminado", "facturar_opciones", "WHERE td = ".$_SESSION["td"]."")) { 
    $_SESSION["tipoticket"] = $r["predeterminado"];
}  unset($r);  



if($_SESSION['root_plataforma'] == 0 and Helpers::ServerDomain() == TRUE){
 ImportFtp(); 
}
      

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


    function VerificaDataInicial(){
        $db = new dbConn();

        $a = $db->query("SELECT * FROM ubicacion WHERE td = " . $_SESSION['td']);
        $num = $a->num_rows;
        $a->close();
        if($num > 0){
            return TRUE;
        } else {
            return FALSE;
        }

    }


    function AddDataInicial(){ // ubicaion predeterminada para cuando no hay datos
        $db = new dbConn();

        $datos["ubicacion"] = "Principal";
        $datos["predeterminada"] = 1;
        $datos["hash"] = Helpers::HashId();
        $datos["time"] = Helpers::TimeId();
        $datos["td"] = $_SESSION["td"];
        $db->insert("ubicacion", $datos);

        $data_u["unidad"] = "Unidad";
        $data_u["abreviacion"] = "U";
        $data_u["hash"] = Helpers::HashId();
        $data_u["time"] = Helpers::TimeId();
        $data_u["td"] = $_SESSION["td"];
        $db->insert("producto_unidades", $data_u);

        $data_s["categoria"] = "GENERAL";
        $hash_cat = Helpers::HashId();
        $data_s["hash"] = $hash_cat;
        $data_s["time"] = Helpers::TimeId();
        $data_s["td"] = $_SESSION["td"];
        $db->insert("producto_categoria", $data_s);

        $data_su["categoria"] = $hash_cat;
        $data_su["subcategoria"] = "General";
        $data_su["hash"] = Helpers::HashId();
        $data_su["time"] = Helpers::TimeId();
        $data_su["td"] = $_SESSION["td"];
        $db->insert("producto_categoria_sub", $data_su);

        $data_p["nombre"] = "Proveedor";
        $data_p["direccion"] = "San Salvador";
        $data_p["telefono"] = "2400-0000";
        $data_p["tel_contacto"] = "2400-0000";
        $data_p["hash"] = Helpers::HashId();
        $data_p["time"] = Helpers::TimeId();
        $data_p["td"] = $_SESSION["td"];
        $db->insert("proveedores", $data_p);



    }



function ImportFtp(){
    $db = new dbConn();
// busca todos los archivos en el directorio
$archivos = glob("../../sync/database/*.sql");  
  foreach($archivos as $data){ 
    $data = str_replace("../../sync/database/", "", $data);
    $hash = str_replace(".sql", "", $data);
    $archx = "../../sync/database/" . $data;            
        // si no es sincronizacion lo ejecuto siempre
            if(file_exists($archx)) {
            $sql = explode(";",file_get_contents($archx));//
            foreach($sql as $query){
            @$db->query($query);
            } @unlink($archx);
        } 
    } // termina busqueda de archivos en la carpeta
} // termina Import





UserInicio($user);

} else {
   header("location: logout.php");
    exit(); 
}
?>