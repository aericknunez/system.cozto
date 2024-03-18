<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Encrypt.php';

?>

<h1>Configuraciones Raiz</h1>
Datos Generales del Sistema
    <table class="table table-sm table-striped">

   <thead>
     <tr>
       <th>Item</th>
       <th>Configuraci&oacuten</th>
     </tr>
   </thead>

   <tbody>
    <?
$r = $db->select("*", "config_root", "where td = ".$_SESSION['td']."");
?>
<tr>
       <td>Expiraci&oacuten</td>
       <td><? echo Encrypt::Decrypt($r["expira"],$_SESSION['secret_key']) . " :: " . Encrypt::Decrypt($r["expiracion"],$_SESSION['secret_key']); ?></td>
       
     </tr>
     <tr>
       <td>Servidor FTP</td>
       <td><? echo Encrypt::Decrypt($r["ftp_servidor"],$_SESSION['secret_key']); ?></td>
       
     </tr>
     <tr>
       <td>FTP Path</td>
       <td><? echo Encrypt::Decrypt($r["ftp_path"],$_SESSION['secret_key']); ?></td>
       
     </tr>
     <tr>
       <td>FTP Ruta</td>
       <td><? echo Encrypt::Decrypt($r["ftp_ruta"],$_SESSION['secret_key']); ?></td>
       
     </tr>
     <tr>
       <td>FTP User</td>
       <td><? echo Encrypt::Decrypt($r["ftp_user"],$_SESSION['secret_key']); ?></td>
       
     </tr>
     <tr>
       <td>FTP Password</td>
       <td><? echo Encrypt::Decrypt($r["ftp_password"],$_SESSION['secret_key']); ?></td>
       
     </tr>
     <tr>
       <td>Tipo Sistema</td>
       <td><? if(Encrypt::Decrypt($r["tipo_sistema"],$_SESSION['secret_key']) == 0) echo "Demo";
              if(Encrypt::Decrypt($r["tipo_sistema"],$_SESSION['secret_key']) == 1) echo "Basico";
              if(Encrypt::Decrypt($r["tipo_sistema"],$_SESSION['secret_key']) == 2) echo "Profesional";
              if(Encrypt::Decrypt($r["tipo_sistema"],$_SESSION['secret_key']) == 3) echo "Corporativo"; ?></td>
       
     </tr>
     <tr>
       <td>Plataforma</td>
       <td><? if(Encrypt::Decrypt($r["plataforma"],$_SESSION['secret_key']) == 1) echo "Web"; else echo "Local"; ?></td>
    
     </tr>

     <tr>
       <td>MultiUsuario</td>
       <td><? if(Encrypt::Decrypt($r["multiusuario"],$_SESSION['secret_key']) == "on") echo "Activado";
              if(Encrypt::Decrypt($r["multiusuario"],$_SESSION['secret_key']) == "") echo "Inactivo"; ?></td>
       
     </tr>

     <tr>
       <td>Ecommerce</td>
       <td><? if(Encrypt::Decrypt($r["ecommerce"],$_SESSION['secret_key']) == "on") echo "Activado";
              if(Encrypt::Decrypt($r["ecommerce"],$_SESSION['secret_key']) == "") echo "Inactivo"; ?></td>
       
     </tr>    
     <tr>
       <td>Activar Receta</td>
       <td><? if(Encrypt::Decrypt($r["receta"],$_SESSION['secret_key']) == "on") echo "Activado";
              if(Encrypt::Decrypt($r["receta"],$_SESSION['secret_key']) == "") echo "Inactivo"; ?></td>
     </tr> 
     <tr>
       <td>Activar AutoParts</td>
       <td><? if(Encrypt::Decrypt($r["autoparts"],$_SESSION['secret_key']) == "on") echo "Activado";
              if(Encrypt::Decrypt($r["autoparts"],$_SESSION['secret_key']) == "") echo "Inactivo"; ?></td>
     </tr> 

     <tr>
       <td>Activar Taller</td>
       <td><? if(Encrypt::Decrypt($r["taller"],$_SESSION['secret_key']) == "on") echo "Activado";
              if(Encrypt::Decrypt($r["taller"],$_SESSION['secret_key']) == "") echo "Inactivo"; ?></td>
     </tr> 

     <tr>
       <td>Activar Consignaciones</td>
       <td><? if(Encrypt::Decrypt($r["consignaciones"],$_SESSION['secret_key']) == "on") echo "Activado";
              if(Encrypt::Decrypt($r["consignaciones"],$_SESSION['secret_key']) == "") echo "Inactivo"; ?></td>
     </tr> 

     <tr>
       <td>Activar Transferencias</td>
       <td><? if(Encrypt::Decrypt($r["transferencias"],$_SESSION['secret_key']) == "on") echo "Activado";
              if(Encrypt::Decrypt($r["transferencias"],$_SESSION['secret_key']) == "") echo "Inactivo"; ?></td>
     </tr> 

     <tr>
       <td>Activar Tarjeta o Cheque</td>
       <td><? if(Encrypt::Decrypt($r["tarjeta"],$_SESSION['secret_key']) == "on") echo "Activado";
              if(Encrypt::Decrypt($r["tarjeta"],$_SESSION['secret_key']) == "") echo "Inactivo"; ?></td>
     </tr> 


     <tr>
       <td>Activar Campo Extra</td>
       <td><? if(Encrypt::Decrypt($r["comment_ticket"],$_SESSION['secret_key']) == "on") echo "Activado";
              if(Encrypt::Decrypt($r["comment_ticket"],$_SESSION['secret_key']) == "") echo "Inactivo"; ?></td>
     </tr> 

     <tr>
       <td>Nombre Campo Extra</td>
       <td><? echo Encrypt::Decrypt($r["extra"],$_SESSION['secret_key']); ?></td>
     </tr> 

     <tr>
       <td>Activar Repartidor</td>
       <td><? if(Encrypt::Decrypt($r["repartidor"],$_SESSION['secret_key']) == "on") echo "Activado";
              if(Encrypt::Decrypt($r["repartidor"],$_SESSION['secret_key']) == "") echo "Inactivo"; ?></td>
     </tr> 

     <tr>
       <td>Activar Precio por Lote</td>
       <td><? if(Encrypt::Decrypt($r["precio_lote"],$_SESSION['secret_key']) == "on") echo "Activado";
              if(Encrypt::Decrypt($r["precio_lote"],$_SESSION['secret_key']) == "") echo "Inactivo"; ?></td>
     </tr> 

     <tr>
       <td>Restringir ordenes de otro usuarios</td>
       <td><? if(Encrypt::Decrypt($r["restringir_ordenes"],$_SESSION['secret_key']) == "on") echo "Activado";
              if(Encrypt::Decrypt($r["restringir_ordenes"],$_SESSION['secret_key']) == "") echo "Inactivo"; ?></td>
     </tr> 

     <tr>
       <td>Activar cambiar empleado (debe estar activo Repartidor)</td>
       <td><? if(Encrypt::Decrypt($r["asignar_empleado"],$_SESSION['secret_key']) == "on") echo "Activado";
              if(Encrypt::Decrypt($r["asignar_empleado"],$_SESSION['secret_key']) == "") echo "Inactivo"; ?></td>
     </tr> 

     <tr>
       <td>Permitir dar creditos sin factura</td>
       <td><? if(Encrypt::Decrypt($r["credito_sin_factura"],$_SESSION['secret_key']) == "on") echo "Activado";
              if(Encrypt::Decrypt($r["credito_sin_factura"],$_SESSION['secret_key']) == "") echo "Inactivo"; ?></td>
     </tr> 

     <tr>
       <td>Permitir Cambio nombre y precio a producto </td>
       <td><? if(Encrypt::Decrypt($r["cambio_nombre_precio"],$_SESSION['secret_key']) == "on") echo "Activado";
              if(Encrypt::Decrypt($r["cambio_nombre_precio"],$_SESSION['secret_key']) == "") echo "Inactivo"; ?></td>
     </tr> 

<?
 unset($r);  
   ?>
   </tbody>
</table>
<a href="?modal=conf_root" class="btn btn-indigo">Cambiar configuraciones<i class="fa fa-cog ml-2"></i></a>