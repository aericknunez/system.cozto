<?php 
class Config{

	public function __construct() { 
     } 


	public function Configuraciones($data){
		$db = new dbConn();

	if($data["pais"] == 1){
		$moneda = "Dolares"; $simbolo = "$"; $imp = "IVA"; $doc = "NIT";
	}if($data["pais"] == 2){
		$moneda = "Lempiras"; $simbolo = "L"; $imp = "ISV"; $doc = "RTN";
	}if($data["pais"] == 3){
		$moneda = "Quetzales"; $simbolo = "Q"; $imp = "IVA"; $doc = "NIT";
	}

		$cambio = array();
	    $cambio["sistema"] = $data["sistema"];
	    $cambio["cliente"] =  $data["cliente"];
	    $cambio["slogan"] = $data["slogan"];
	    $cambio["propietario"] = $data["propietario"];
	    $cambio["telefono"] = $data["telefono"];
	    $cambio["direccion"] = $data["direccion"];
	    $cambio["email"] = $data["email"];
	    $cambio["pais"] = $data["pais"];
	    $cambio["giro"] =$data["giro"];
	    $cambio["nit"] = $data["nit"];
	    $cambio["imp"] = $data["imp"];
	    $cambio["nombre_impuesto"] = $imp;
	    $cambio["nombre_documento"] = $doc;
	    $cambio["moneda"] = $moneda;
	    $cambio["moneda_simbolo"] = $simbolo;
	    $cambio["tipo_inicio"] = $data["tipo_inicio"];
	    $cambio["skin"] = $data["skin"];
	    $cambio["inicio_tx"] = $data["inicio_tx"];
	    $cambio["otras_ventas"] = $data["otras_ventas"];
	    $cambio["cambio_tx"] = $data["cambio_tx"];
	    $cambio["dias_vencimiento"] = $data["dias_vencimiento"];
	    $cambio["dias_cotizacion"] = $data["dias_cotizacion"];
		$cambio["lineasf"] = $data["lineasf"];
	    $cambio["lineascf"] = $data["lineascf"];
	    $cambio["multicaja"] = $data["multicaja"];
	    $cambio["mayorista"] = $data["mayorista"];
	    $cambio["descuento"] = $data["descuento"];
	    $cambio["restringir_descuento"] = $data["restringir_descuento"];
	    $cambio["sonido"] = $data["sonido"];
	    $cambio["pesaje"] = $data["pesaje"];
	    $cambio["agotado"] = $data["agotado"];
	    $cambio["enviar_email"] = $data["enviar_email"];
	    $cambio["time"] = Helpers::TimeId();
	    if (Helpers::UpdateId("config_master", $cambio, "td = ".$_SESSION["td"]."")) {
	    	$this->CrearVariables();
	        Alerts::Alerta("success","Realizado!","Registros actualizados correctamente");
	    } else {
	       Alerts::Alerta("error","Error!","Ocurrio un error desconocido!");   
	    }


	}



	public function Root($data){
		$db = new dbConn();

		$cambio = array();
	    $cambio["expira"] = Encrypt::Encrypt($data["expira"],$_SESSION['secret_key']);
	    $cambio["expiracion"] = Encrypt::Encrypt(Fechas::Format($data["expira"]),$_SESSION['secret_key']);
	    $cambio["ftp_servidor"] = Encrypt::Encrypt($data["ftp_servidor"],$_SESSION['secret_key']);
	    $cambio["ftp_path"] = Encrypt::Encrypt($data["ftp_path"],$_SESSION['secret_key']);
	    $cambio["ftp_ruta"] = Encrypt::Encrypt($data["ftp_ruta"],$_SESSION['secret_key']);
	    $cambio["ftp_user"] = Encrypt::Encrypt($data["ftp_user"],$_SESSION['secret_key']);
	    $cambio["ftp_password"] = Encrypt::Encrypt($data["ftp_password"],$_SESSION['secret_key']);
	    $cambio["tipo_sistema"] = Encrypt::Encrypt($data["tipo_sistema"],$_SESSION['secret_key']);
	    $cambio["plataforma"] = Encrypt::Encrypt($data["plataforma"],$_SESSION['secret_key']);
	    $cambio["multiusuario"] = Encrypt::Encrypt($data["multiusuario"],$_SESSION['secret_key']);
	    $cambio["ecommerce"] = Encrypt::Encrypt($data["ecommerce"],$_SESSION['secret_key']);
	    $cambio["receta"] = Encrypt::Encrypt($data["receta"],$_SESSION['secret_key']);
	    $cambio["autoparts"] = Encrypt::Encrypt($data["autoparts"],$_SESSION['secret_key']);
	    $cambio["taller"] = Encrypt::Encrypt($data["taller"],$_SESSION['secret_key']);
	    $cambio["consignaciones"] = Encrypt::Encrypt($data["consignaciones"],$_SESSION['secret_key']);
	    $cambio["transferencias"] = Encrypt::Encrypt($data["transferencias"],$_SESSION['secret_key']);
	    $cambio["tarjeta"] = Encrypt::Encrypt($data["tarjeta"],$_SESSION['secret_key']);
	    $cambio["comment_ticket"] = Encrypt::Encrypt($data["comment_ticket"],$_SESSION['secret_key']);
	    $cambio["extra"] = Encrypt::Encrypt($data["extra"],$_SESSION['secret_key']);
	    $cambio["repartidor"] = Encrypt::Encrypt($data["repartidor"],$_SESSION['secret_key']);
	    $cambio["precio_lote"] = Encrypt::Encrypt($data["precio_lote"],$_SESSION['secret_key']);
	    $cambio["restringir_ordenes"] = Encrypt::Encrypt($data["restringir_ordenes"],$_SESSION['secret_key']);
	    $cambio["asignar_empleado"] = Encrypt::Encrypt($data["asignar_empleado"],$_SESSION['secret_key']);
	    $cambio["credito_sin_factura"] = Encrypt::Encrypt($data["credito_sin_factura"],$_SESSION['secret_key']);
	    $cambio["time"] = Helpers::TimeId();
	    if (Helpers::UpdateId("config_root", $cambio, "td = ".$_SESSION["td"]."")) {
	    	$this->CrearVariables();
	        Alerts::Alerta("success","Realizado!","Registros actualizados correctamente");
	    } else {
	       Alerts::Alerta("error","Error!","Ocurrio un error desconocido!");   
	    }

	
	}
	


	



	public function CrearVariables(){
		$db = new dbConn();
		$encrypt = new Encrypt;

		if ($r = $db->select("*", "config_master", "WHERE td = ".$_SESSION['td']."")) { 

			$_SESSION['config_sistema'] = $r["sistema"];
			$_SESSION['config_cliente'] = $r["cliente"];
			$_SESSION['config_slogan'] = $r["slogan"];
			$_SESSION['config_propietario'] = $r["propietario"];
			$_SESSION['config_telefono'] = $r["telefono"];
			$_SESSION['config_giro'] = $r["giro"];
			$_SESSION['config_nit'] = $r["nit"];
			$_SESSION['config_imp'] = $r["imp"];
			$_SESSION['config_direccion'] = $r["direccion"];
			$_SESSION['config_email'] = $r["email"];
			$_SESSION['config_imagen'] = $r["imagen"]; // de la empresa
			$_SESSION['config_logo'] = $r["logo"]; // el de pizto
			$_SESSION['config_skin'] = $r["skin"];
			$_SESSION['tipo_inicio'] = $r["tipo_inicio"];

			$_SESSION['config_pais'] = $r["pais"];
			$_SESSION['config_moneda'] = $r["moneda"];
			$_SESSION['config_moneda_simbolo'] = $r["moneda_simbolo"];
			$_SESSION['config_nombre_impuesto'] = $r["nombre_impuesto"];
			$_SESSION['config_nombre_documento'] = $r["nombre_documento"];
			$_SESSION['tx'] = $r["inicio_tx"];
			$_SESSION['config_otras_ventas'] = $r["otras_ventas"];
			$_SESSION['config_cambio_tx'] = $r["cambio_tx"];
			$_SESSION['config_dias_vencimiento'] = $r["dias_vencimiento"];
			$_SESSION['config_dias_cotizacion'] = $r["dias_cotizacion"];
			$_SESSION['lineasf'] = $r["lineasf"];
			$_SESSION['lineascf'] = $r["lineascf"];
			$_SESSION['config_multicaja'] = $r["multicaja"];
			$_SESSION['config_mayorista'] = $r["mayorista"];
			$_SESSION['config_descuento'] = $r["descuento"];
			$_SESSION['config_restringir_descuento'] = $r["restringir_descuento"];
			$_SESSION['config_sonido'] = $r["sonido"];
			$_SESSION['config_pesaje'] = $r["pesaje"];
			$_SESSION['config_agotado'] = $r["agotado"];
			$_SESSION['config_enviar_email'] = $r["enviar_email"];

			if($_SESSION['config_skin'] == NULL) $_SESSION['config_skin'] = "mdb-skin";
			// white-skin , mdb-skin , grey-skin , pink-skin ,  light-blue-skin , black-skin  cyan-skin, navy-blue-skin

			// fixed-sn , hidden-sn
			} unset($r);

			    // para root pero sin descifrar
			if ($root = $db->select("*", "config_root", "WHERE td = ".$_SESSION['td']."")) {

			$_SESSION['root_expira'] = $root["expira"];
			$_SESSION['root_expiracion'] = $root["expiracion"];
			$_SESSION['root_tipo_sistema'] = $root["tipo_sistema"];
			$_SESSION['root_plataforma'] = $root["plataforma"];
			$_SESSION['root_multiusuario'] = $root["multiusuario"];
			$_SESSION['root_ecommerce'] = $root["ecommerce"];
			$_SESSION['root_receta'] = $root["receta"];
			$_SESSION['root_autoparts'] = $root["autoparts"];
			$_SESSION['root_taller'] = $root["taller"];
			$_SESSION['root_consignaciones'] = $root["consignaciones"];
			$_SESSION['root_transferencias'] = $root["transferencias"];
			$_SESSION['root_tarjeta'] = $root["tarjeta"];
			$_SESSION['root_comment_ticket'] = $root["comment_ticket"];
			$_SESSION['root_extra'] = $root["extra"];
			$_SESSION['root_repartidor'] = $root["repartidor"];
			$_SESSION['root_precio_lote'] = $root["precio_lote"];
			$_SESSION['root_restringir_ordenes'] = $root["restringir_ordenes"];
			$_SESSION['root_asignar_empleado'] = $root["asignar_empleado"];
			$_SESSION['credito_sin_factura'] = $root["credito_sin_factura"];
     
			} unset($root);
			$_SESSION['root_tipo_sistema'] = $encrypt->Decrypt(
  			$_SESSION['root_tipo_sistema'],$_SESSION['secret_key']);

			$_SESSION['root_plataforma'] = $encrypt->Decrypt(
			$_SESSION['root_plataforma'],$_SESSION['secret_key']);

			$_SESSION['root_multiusuario'] = $encrypt->Decrypt(
			$_SESSION['root_multiusuario'],$_SESSION['secret_key']);

			$_SESSION['root_ecommerce'] = $encrypt->Decrypt(
			$_SESSION['root_ecommerce'],$_SESSION['secret_key']);

			$_SESSION['root_receta'] = $encrypt->Decrypt(
			$_SESSION['root_receta'],$_SESSION['secret_key']);

			$_SESSION['root_autoparts'] = $encrypt->Decrypt(
			$_SESSION['root_autoparts'],$_SESSION['secret_key']);

			$_SESSION['root_taller'] = $encrypt->Decrypt(
			$_SESSION['root_taller'],$_SESSION['secret_key']);

			$_SESSION['root_consignaciones'] = $encrypt->Decrypt(
			$_SESSION['root_consignaciones'],$_SESSION['secret_key']);

			$_SESSION['root_transferencias'] = $encrypt->Decrypt(
			$_SESSION['root_transferencias'],$_SESSION['secret_key']);

			$_SESSION['root_tarjeta'] = $encrypt->Decrypt(
			$_SESSION['root_tarjeta'],$_SESSION['secret_key']);

			$_SESSION['root_comment_ticket'] = $encrypt->Decrypt(
			$_SESSION['root_comment_ticket'],$_SESSION['secret_key']);

			$_SESSION['root_extra'] = $encrypt->Decrypt(
			$_SESSION['root_extra'],$_SESSION['secret_key']);

			$_SESSION['root_repartidor'] = $encrypt->Decrypt(
			$_SESSION['root_repartidor'],$_SESSION['secret_key']);

			$_SESSION['root_precio_lote'] = $encrypt->Decrypt(
			$_SESSION['root_precio_lote'],$_SESSION['secret_key']);

			$_SESSION['root_restringir_ordenes'] = $encrypt->Decrypt(
			$_SESSION['root_restringir_ordenes'],$_SESSION['secret_key']);

			$_SESSION['root_asignar_empleado'] = $encrypt->Decrypt(
			$_SESSION['root_asignar_empleado'],$_SESSION['secret_key']);

			$_SESSION['credito_sin_factura'] = $encrypt->Decrypt(
			$_SESSION['credito_sin_factura'],$_SESSION['secret_key']);

			if ($encrypt->Decrypt($_SESSION['root_tarjeta'],$_SESSION['secret_key'])) {
				$_SESSION['root_tarjeta'] = 'Cheque';
			} else {
				$_SESSION['root_tarjeta'] = 'Tarjeta';
			}
			

	}



	public function AddSucursal($user,$td){
		$db = new dbConn();

		    $datos = array();
		    $datos["user"] = $user;
		    $datos["sucursal"] = $td;
		    if ($db->insert("login_sucursales", $datos)) {
		    Alerts::Alerta("success","Agregado Correctamente","Usuario agregado correctamente a la sucursal");
		    } else {
		    Alerts::Alerta("danger","Error","Ocurrio un error inesperado");
		    }
		$this->CuentasSucursal($_SESSION['user']);
	}


	public function CuentasSucursal($user){
		$db = new dbConn();
	
	if($_SESSION["tipo_cuenta"] == 1 and $_SESSION["td"] != 0){ 
	 $a = $db->query("SELECT * FROM login_sucursales order by user desc");
	} else {
		$a = $db->query("SELECT * FROM login_sucursales WHERE user = '$user'");
	}

	if($a->num_rows > 0){
	 echo '<table class="table table-sm table-striped">
			  <thead>
			    <tr>
			    <th scope="col">Usuario</th>
			      <th scope="col">Nombre del Sistema</th>
			      <th scope="col">Pais</th>
			      <th scope="col">Cambiar</th>
			    </tr>
			  </thead>
			  <tbody>';
	    foreach ($a as $b) {  
		    $r = $db->select("cliente, pais, td", "config_master", "WHERE td = ".$b["sucursal"]."");



	    	$userx = $b["user"];
	    	$x = $db->select("nombre", "login_userdata", "WHERE user = '$userx'");
		    echo '<tr>
		    	  <th scope="col">'.$x["nombre"].'</th>
			      <th scope="col">'.$r["td"].' - '.$r["cliente"].'</th>
			      <th scope="col">'.Helpers::Pais($r["pais"]).'</th>			      
			      <th scope="col">';
				if($b["sucursal"] == $_SESSION['td']){
					echo '<a id="predeterminar" op="431" iden="'.$b["sucursal"].'" class="btn-sm">Predeterminar  <i class="fa fa-play red-text"></i></a>';
				} else {
					echo '<a id="irlocal" op="419" iden="'.$b["sucursal"].'" class="btn-sm">Seleccionar  <i class="fa fa-play blue-text"></i></a>';
				}
			echo '</th>
			    </tr>';
		unset($r);
		unset($x);
	    } 
	    echo '</tbody>
		    </table>';
		} else {
			Alerts::Mensajex("No tienes sucuarsales vinculadas a tu cuenta","danger");
		}
		$a->close();

	}





	public function DefineSucursal($user,$td){
		$db = new dbConn();

		    $cambio = array();
		    $cambio["td"] = $td;
		    if ($db->update("login_userdata", $cambio, "WHERE user = '".$user."'")) {
			    
		   		$_SESSION['td'] = $td;
		      	$_SESSION['secret_key'] = md5($_SESSION['td']);
			  	$this->CrearVariables();
			  	echo '<script>
				window.location.href="?"
				</script>';

			    } 

		     
	}







/// para las tablas a sync


	public function VerTablas(){
		$db = new dbConn();

	$tables = $db->listTables();
    $arrlength = count($tables);

		echo '<table class="table table-sm table-striped">
	   <thead>
	     <tr>
	       <th>Nombre de la Tabla</th>
	       <th>Estado</th>
	       <th>Acci&oacuten</th>
	     </tr>
	   </thead>
	   <tbody>';
			for($x = 0; $x < $arrlength; $x++) {     
	
		echo '<tr>
		       <td>' . $tables[$x] . '</td>';
		       if($this->VerificaTabla($tables[$x]) != FALSE){
		       	if($this->VerificaTabla($tables[$x]) == 1){
		       		$color = 'fas fa-check blue-text';
		       	} else {
		       		$color = 'fas fa-ban red-text';
		       	}
		       	echo '<td>Existe</td>
		       	<td><a id="tablemod" op="13" tabla="'.$tables[$x].'" accion="2" edo="'. $this->VerificaTabla($tables[$x]). '" class="btn-floating btn-sm"><i class="'.$color.'"></i></a></td>';
		       } else {
		       	echo '<td>No existe</td>
		       	<td><a id="tablemod" op="13" tabla="'.$tables[$x].'" accion="1"  class="btn-floating btn-sm"><i class="fas fa-check-circle green-text"></i></a></td>';
		       }
		echo '</tr>';

		    } 
		echo '</tbody>
		</table>';
 
 }



	public function VerificaTabla($tabla){
		$db = new dbConn();

		$a = $db->query("SELECT edo FROM sync_tabla WHERE tabla = '$tabla' and td =  ".$_SESSION["td"]."");
		if($a->num_rows > 0){
			    foreach ($a as $b) {
		        return $b["edo"];
		    	}
		} else {
			return FALSE;
		} $a->close();
 }


	public function ModTabla($datos){
		$db = new dbConn();

		if($datos["accion"] == "1"){

			    $inserta = array();
			    $inserta["tabla"] = $datos["tabla"];
			    $inserta["edo"] = 1;
			    $inserta["hash"] = Helpers::HashId();
			    $inserta["time"] = Helpers::TimeId();
			    $inserta["td"] = $_SESSION["td"];
			    if ($db->insert("sync_tabla", $inserta)) {
			        Alerts::Alerta("success","Agregado Correctamente","Se Agrego esta tabla");
			    } 

		} else {

			if($datos["edo"] == "1"){
					    $cambio = array();
					    $cambio["edo"] = "2";
					    if (Helpers::UpdateId("sync_tabla", $cambio, "tabla='".$datos["tabla"]."'and td = ".$_SESSION["td"]."")) {
					     Alerts::Alerta("error","Cambiado Correctamente","Se Cambio el estado esta tabla a Inactivo");
					    }
			} else {
					    $cambio = array();
					    $cambio["edo"] = "1";
					    if (Helpers::UpdateId("sync_tabla", $cambio, "tabla='".$datos["tabla"]."'and td = ".$_SESSION["td"]."")) {
					     Alerts::Alerta("info","Cambiado Correctamente","Se Cambio el estado esta tabla a Activo");
					    }

			}
		}
	
	$this->VerTablas();

	}


















} // fin de la clase

 ?>