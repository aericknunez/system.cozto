<?php 
class Usuarios{
	public $password;
	public $pass1;
	public $pass2;


	function ActualizarUsuario($nombre,$tipo,$user){
	    $db = new dbConn();

	    	    $cambio = array();
			    $cambio["nombre"] = $nombre;
			    $cambio["tipo"] = $tipo;
			    if ($db->update("login_userdata", $cambio, "WHERE user='$user'")) {
			    	if($_SESSION["nombre"] != $cambio["nombre"]) { $_SESSION["nombre"] = $cambio["nombre"]; }
			    Alerts::Alerta("success","Actualizado","Usuario Actualizado");
			    } else {
			    Alerts::Alerta("error","Error!","Error al actualizar!");
			    }

	}





	function AvatarSelect($user){
	    $db = new dbConn();

	    $usuario = $user;

	if ($r = $db->select("avatar", "login_userdata", "WHERE user = '$usuario'")) { 
        $avat = $r["avatar"];
    } unset($r);

echo '<div id="avatar-select">
<img src="assets/img/avatar/'.$avat.'" class="img-fluid rounded-circle hoverable mx-auto d-block" alt="alt="avatar mx-auto white">
</div>
<br>';

	$images = glob("../../assets/img/avatar/*.*");  
      foreach($images as $image){ 
    $image = str_replace("../../assets/img/avatar/", "", $image);
    $opciones='id="cambiar-avatar" op="3" iden="'.$image.'" user="'.$usuario.'"';

    $output .= '<a ' . $opciones .'><img src="assets/img/avatar/' . $image .'" alt="thumbnail" class="img-thumbnail"
  style="width: 75px"></a>';
    
      }  
      echo $output;

	}


	function CambiarAvatar($avatar,$user){
	    $db = new dbConn();

	    	    $cambio = array();
			    $cambio["avatar"] = $avatar;
			    if ($db->update("login_userdata", $cambio, "WHERE user='$user'")) {
			    Alerts::Alerta("success","Actualizado","Usuario Actualizado");
			    echo '<img src="assets/img/avatar/'.$avatar.'" class="img-fluid rounded-circle hoverable mx-auto d-block" alt="alt="avatar mx-auto white">';
			     
			     if($_SESSION["user"] == $user) { $_SESSION["avatar"] = $avatar; }

			    } else {
			    Alerts::Alerta("error","Error!","Error al actualizar!");
			    }

	}



	public function ModalPass($user) {
	$usuario = $user;

		if($_SESSION["user"]==$usuario){

		echo 'Cambiar Password

		      <input type="password" class="my-1 form-control" id="pass1" name="pass1" placeholder="Nuevo Password" required autocomplete="off">
		      <input type="password" class="my-1 form-control" id="pass2" name="pass2" placeholder="Repetir Password" required autocomplete="off">'; 
		} else {
		  echo "No tiene permitido cambiar este password";
		}
	}



	public function ModalUpdate($user) {
		$db = new dbConn();

	$usuario = $user;

    if ($r = $db->select("nombre, tipo", "login_userdata", "WHERE user = '$usuario'")) { 
        $name = $r["nombre"]; $type = $r["tipo"];
    }  unset($r); 



		echo '<label for="nombre" class="grey-text">Nombre</label>
				<input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" value="'.$name.'" required="yes">
		 
		    <input type="hidden" id="user" name="user" value="'.$user.'">';


		    if($_SESSION['tipo_cuenta'] != 4){

echo '<label>Tipo de Cuenta</label>
<select id="tipo" name="tipo" class="browser-default form-control" required="yes">
    
    <option ';
    if($type == 2) echo "selected "; 
    if($_SESSION['tipo_cuenta'] == 3 or $_SESSION['tipo_cuenta'] == 4 or $_SESSION['tipo_cuenta'] == 5) echo "disabled "; echo 'value="2">'; echo Helpers::UserName(2) . '</option>
    
    <option '; 
    if($type == 3) echo "selected";
    if($_SESSION['tipo_cuenta'] == 3 or $_SESSION['tipo_cuenta'] == 5) echo 'disabled '; echo 'value="3">'; echo Helpers::UserName(3) . '</option>
   
    <option ';
    if($type == 4) echo "selected";
    if($_SESSION['tipo_cuenta'] == 4) echo 'disabled '; echo 'value="4">';echo Helpers::UserName(4) . '</option>
    
    <option '; 
    if($type == 5) echo "selected";
    if($_SESSION['tipo_cuenta'] == 5 or $_SESSION['tipo_cuenta'] != 1) echo 'disabled '; echo 'value="5">';echo Helpers::UserName(5) . '</option>

</select>';
}else {
	echo '<input type="hidden" id="tipo" name="tipo" value="'.$type.'">';
}



	}





	public function CambiarPass($password) {
			$db = new dbConn();

			$password = hash('sha512', $password);

			$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
        	$password = hash('sha512', $password . $random_salt);

        	if (strlen($password) == 128) {
	        	$cambio = array();
			    $cambio["password"] = $password;
			    $cambio["salt"] = $random_salt;
			    if ($db->update("login_members", $cambio, "WHERE username = '".$_SESSION["username"]."'")) {

			    	Alerts::Alerta("success","Password Cambiado","Pasword cambiado correctamente!");
			    }
			    else {
			    	Alerts::Alerta("error","Error!","Error! no se ha podido cambiar");
			    }
        	}
        	else{
        		Alerts::Alerta("error","Error!","Error desconocido!");
        	}

	}


	public function CompararPass($pass1, $pass2) {
		if($pass1 == $pass2){
			if(strlen($pass1) > 6){
				if($this->MayusCount($pass1) > 0) {
					if($this->NumCount($pass1) > 0) {
						$this->CambiarPass($pass1);
					} else { echo "Debe contener al menos un numero"; } 
					
				} else {
					Alerts::Alerta("error","Error!","Debe tener al manos una Mayuscula");
				}

				
			}
			else { 
				Alerts::Alerta("error","Error!","El password debe tener mas de 6 Caracteres");
			}
			
		} else {
			Alerts::Alerta("error","Error!","Los password no son iguales");
		}

	}

	function MayusCount($string){
	    $string = preg_match_all('/([A-Z]{1})/',$string,$foo);
	    return $string;
	}


	function NumCount($string){
	    $string = preg_match_all('/([0-9]{1})/',$string,$foo);
	    return $string;
	}



	public function EliminarUsuario($iden, $username) {
			$db = new dbConn();
			
			if ( $db->delete("login_members", "WHERE id='$iden'")) {
        	
        		if ( $db->delete("login_userdata", "WHERE user='$username'")) {
	     		Alerts::Alerta("success","Usuario Eliminado","Usuario eliminado correctamente! Inicie nuevamente");
	    		} 
    		} 
	}




	public function VerUsuarios($avatar = NULL){
	$db = new dbConn();

	if($_SESSION["tipo_cuenta"] != 1){
		$a = $db->query("SELECT * FROM login_members INNER JOIN login_userdata ON login_members.username = login_userdata.user WHERE login_userdata.id != 1 and login_userdata.td = ". $_SESSION["td"]. "");
	} else {
		$a = $db->query("SELECT * FROM login_members INNER JOIN login_userdata ON login_members.username = login_userdata.user WHERE login_userdata.id != 1");
	}

	if($a->num_rows > 0){
		echo '<table class="table table-sm">
			  <thead>
			    <tr>
			      <th scope="col">Nombre </th>
			      <th scope="col" class="d-none d-md-block">Email</th>
			      <th scope="col">Cuenta</th>
			      <th scope="col">Eliminar</th>
			      <th scope="col">Editar</th>';
			      if($avatar == NULL){
			 echo '<th scope="col">Avatar</th>';     	
			      }
			      
			 echo '</tr>
			  </thead>
			  <tbody>';
	}
    foreach ($a as $b) {

    	if(($_SESSION["user"] == $user) or ($_SESSION["tipo_cuenta"]!= 5)){

    	echo '<tr>';
		
		echo '<th scope="row">'.$b["nombre"].'</th>
		      <td class="d-none d-md-block">'.$b["email"].'</td>
		      <td>'.Helpers::UserName($b["tipo"]).'</td>';

			if($_SESSION["user"] == $b["username"] or $_SESSION["tipo_cuenta"] == 1  or $_SESSION["tipo_cuenta"] == 2){
				echo '<td><a id="xdelete" op="7" iden="'.$b["id"].'" username="'.$b["username"].'" ><i class="fa fa-trash red-text fa-lg"></i></a></td>';
			} else {
				echo '<td><a><i class="fa fa-trash grey-text  fa-lg"></i></a></td>';
			}

			if($_SESSION["user"] == $b["username"] or $_SESSION["tipo_cuenta"] == 1  or $_SESSION["tipo_cuenta"] == 2){
				echo '<td><a id="u_pass" username="'.$b["username"].'" op="9"><i class="fa fa-unlock-alt red-text fa-lg"></i></a>
					<a id="u_update" username="'.$b["username"].'" op="10"><i class="fa fa-edit red-text fa-lg"></i></a></td>';
			} else {
				echo '<td><a ><i class="fa fa-unlock-alt grey-text fa-lg"></i></a>
				<a ><i class="fa fa-edit grey-text fa-lg"></i></a></td>';
			}

		if($avatar == NULL){
			
			if($_SESSION["user"] == $b["username"] or $_SESSION["tipo_cuenta"] == 1  or $_SESSION["tipo_cuenta"] == 2){
				echo '<td><a id="ver_avatar" op="6" username = "'.$b["username"].'"><i class="fa fa-user red-text fa-lg"></i></a></td>';
			} else {
				echo '<td><a ><i class="fa fa-user grey-text fa-lg"></i></a></td>';
			}
		}
		echo '</tr>';  
	}


    } $a->close();
    echo '</tbody>
		</table>';


	}





	public function VerUser($avatar = NULL){ // ver solo mi usuario
	$db = new dbConn();

	$a = $db->query("SELECT * FROM login_members WHERE id != 1 and username = '".$_SESSION["username"]."'");
	if($a->num_rows > 0){
		echo '<table class="table table-sm">
			  <thead>
			    <tr>
			      <th scope="col">Nombre </th>
			      <th scope="col" class="d-none d-md-block">Email</th>
			      <th scope="col">Cuenta</th>
			      <th scope="col">Eliminar</th>
			      <th scope="col">Editar</th>';
			      if($avatar == NULL){
			 echo '<th scope="col">Avatar</th>';     	
			      }
			      
			 echo '</tr>
			  </thead>
			  <tbody>';
	}
    foreach ($a as $b) {
    	$user=$b["username"];
    	
    	if ($r = $db->select("*", "login_userdata", "WHERE user = '$user'")) { 
       	$nombre = $r["nombre"]; $tipo = $r["tipo"];
    	} unset($r); 




    	if(($_SESSION["user"] == $user) or ($_SESSION["tipo_cuenta"]!= 5)){

    	echo '<tr>';
		
		echo '<th scope="row">'.$nombre.'</th>
		      <td class="d-none d-md-block">'.$b["email"].'</td>
		      <td>'.Helpers::UserName($tipo).'</td>';

			if($_SESSION["user"] == $user or $_SESSION["tipo_cuenta"] == 1  or $_SESSION["tipo_cuenta"] == 2){
				echo '<td><a id="xdelete" op="7" iden="'.$b["id"].'" username="'.$user.'" ><i class="fa fa-trash red-text fa-lg"></i></a></td>';
			} else {
				echo '<td><a><i class="fa fa-trash grey-text  fa-lg"></i></a></td>';
			}

			if($_SESSION["user"] == $user or $_SESSION["tipo_cuenta"] == 1  or $_SESSION["tipo_cuenta"] == 2){
				echo '<td><a id="u_pass" username="'.$b["username"].'" op="9"><i class="fa fa-unlock-alt red-text fa-lg"></i></a>
					<a id="u_update" username="'.$b["username"].'" op="10"><i class="fa fa-edit red-text fa-lg"></i></a></td>';
			} else {
				echo '<td><a ><i class="fa fa-unlock-alt grey-text fa-lg"></i></a>
				<a ><i class="fa fa-edit grey-text fa-lg"></i></a></td>';
			}

		if($avatar == NULL){
			
			if($_SESSION["user"] == $user or $_SESSION["tipo_cuenta"] == 1  or $_SESSION["tipo_cuenta"] == 2){
				echo '<td><a id="ver_avatar" op="6" username = "'.$b["username"].'"><i class="fa fa-user red-text fa-lg"></i></a></td>';
			} else {
				echo '<td><a ><i class="fa fa-user grey-text fa-lg"></i></a></td>';
			}
		}
		echo '</tr>';  
	}


    } $a->close();
    echo '</tbody>
		</table>';


	}















}
?>