<?php
include_once '../common/Helpers.php';
include_once '../common/Mysqli.php';
include_once '../common/Alerts.php';
include_once 'variables_db.php';
include_once 'DataLogin.php';
$seslog = new Login();

$seslog->sec_session_start(); // Our custom secure way of starting a PHP session.

//////////////////// QUITAR ESTE CODIGO ///////////////
 $db = new dbConn();     
    $a = $db->query("SELECT username FROM login_members");
    foreach ($a as $b) {
            
            $userx = sha1($b["username"]);
            $cambio = array();
            $cambio["user"] = $b["username"];
            $db->update("login_userdata", $cambio, "WHERE user='$userx'");
    
    } $a->close();

////////////////////////////////////////////////////

if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $seslog->ValidaPass($_POST['password']); // The hashed password.
    
    if ($seslog->LogOn($email, $password) == true) {
        // Login success 
         echo '<div class="inline-ul text-center d-flex justify-content-center"><img src="assets/img/loading (1).gif"></div>';
         echo '<script>
            window.location.href="application/includes/iniciar.php"
        </script>';
        exit();
    } else {
        // Login failed 
        Alerts::Alerta("error","Error!","Error al iniciar");
        exit();
    }
} else {
        echo '<script>
            window.location.href="error.php?err=No se puede iniciar"
        </script>';
    // The correct POST variables were not sent to this page. 
    exit();
}
?>