<?php 
class Gastos {

	public function __construct(){

	}

	public function AddGasto($data){
	    $db = new dbConn();

	    if($data["gasto"] != NULL and $data["cantidad"] != NULL){
	         $datos = array();

	         	if($data["tipo"] == 1){ $data["nofactura"] = NULL; $data["tipo_comprobante"] = NULL;}
	         	if($data["pago"] == 1){ $data["banco"] = NULL; }

			    $datos["tipo"] = $data["tipo"];
			    $datos["nombre"] = $data["gasto"];
			    $datos["descripcion"] = $data["descripcion"];
			    $datos["cantidad"] = $data["cantidad"];
			    $datos["fecha"] = date("d-m-Y");
			    $datos["fechaF"] = Fechas::Format(date("d-m-Y"));
			    $datos["hora"] = date("H:i:s");
			    $datos["user"] = $_SESSION["user"];
			    $datos["edo"] = 1;
			    $datos["tipo_comprobante"] = $data["tipo_comprobante"];
			    $datos["no_factura"] = $data["nofactura"];
			    $datos["tipo_pago"] = $data["pago"];
			    $datos["cuenta_banco"] = $data["banco"];
			    $datos["categoria"] = $data["categoria"];
			    $datos["hash"] = Helpers::HashId();
				$datos["time"] = Helpers::TimeId();
			    $datos["td"] = $_SESSION["td"];
			    if ($db->insert("gastos", $datos)) {
			        Alerts::Alerta("success","Agregado Correctamente","Gasto Agregado corectamente!");
			    } else {
			    	Alerts::Alerta("error","Error","Error desconocido, no se agrego el registro!");
			    }
		} else {
			Alerts::Alerta("error","Error","Faltan Datos!");
		}
			$this->VerGastos();

	}




	public function VerGastos($g = NULL){
	    $db = new dbConn();
	    $fecha = date("d-m-Y");
	        $a = $db->query("SELECT * FROM gastos WHERE fecha = '$fecha' and td = ". $_SESSION["td"] ." order by id desc");
	        	$total=0;
	        	if($a->num_rows > 0){
	        echo ' <h3>Detalle de Gastos</h3>

				<table class="table table-sm table-striped">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Tipo</th>
			      <th scope="col">Gasto</th>
			      <th scope="col">Descripci&oacuten</th>
			      <th scope="col">Cantidad</th>';
			      if($g == NULL){
			      	echo '<th>Modificar</th>';
			      }
			      
			    echo '</tr>
			  </thead>
			  <tbody>';
			  $n = 0;
		    foreach ($a as $b) {
		    	$n++;
		    	if($b["edo"] != 0){
				$total = $total + $b["cantidad"];
				$colores='class="text-black"';
				} else {
				$colores='class="text-danger"';	
				} 

		    	echo '<tr '.$colores.'>
		    	  <td>'. $n .'</td>
			      <th scope="row">'. Helpers::Gasto($b["tipo"]) .'</th>
			      <td>'. $b["nombre"] .'</td>
			      <td>'. $b["descripcion"] .'</td>
			      <td>'. Helpers::Dinero($b["cantidad"]) .'</td>
			      <td>';
			      if($b["edo"] == 1 and $g == NULL){

			      	echo '<a id="xver" iden="'. $b["id"] .'">
				      <span class="badge green"><i class="fas fa-image" aria-hidden="true"></i></span>
				      </a>

			      <a id="xdelete" op="171" iden="'. $b["id"] .'">
				      <span class="badge red"><i class="fas fa-trash-alt" aria-hidden="true"></i></span>
				      </a>';
			      } if($b["edo"] == 2){
			      	echo '<span class="badge red"><i class="fas fa-ban" aria-hidden="true"></i></span>';
			      }
			      echo '</td>
			    </tr>';
			    
		    }

		    if($_SESSION["tipo_cuenta"] == 1 or $_SESSION["tipo_cuenta"] == 5){
		    echo '<tr>
		    	  <th scope="col"></th>
			      <th scope="col"></th>
			      <th scope="col"></th>
			      <th scope="col">Total</th>
			      <th scope="col">'. Helpers::Dinero($total) .'</th>
			      <td></td>
			    </tr>';
			    }
			
			echo '</tbody>
		    </table>';
			}
  			$a->close();
	}

	

		public function BorrarGasto($iden) {
		$db = new dbConn();

			    $cambio = array();
			    $cambio["edo"] = 0;
			    
			    if (Helpers::UpdateId("gastos", $cambio, "id='$iden' and td = ".$_SESSION["td"]."")) {
						$this->BorrarImagenesGasto($iden);
			        Alerts::Alerta("success","Eliminado","Se ha eliminado el registo correctamente!");
			    } else {
			        Alerts::Alerta("error","Error","No se pudo eliminar!"); 
			    }
					    
		    
		    $this->VerGastos();

   		}

	public function BorrarImagenesGasto($gasto) {
		$db = new dbConn();

	$a = $db->query("SELECT id, imagen FROM gastos_images WHERE gasto='$gasto' and td = ".$_SESSION["td"]."");
	    foreach ($a as $b) {
	       
	   if(Helpers::DeleteId("gastos_images", "id = '".$b["id"]."' and td = ".$_SESSION["td"]."")){
			   if (file_exists("../../assets/img/gastosimg/" . $b["imagen"])) {
                unlink("../../assets/img/gastosimg/" . $b["imagen"]);
            	}
		}

	}
	    $a->close();


	}




//////// entradas

	public function VerEntradas($g = NULL) {
		$db = new dbConn();
	        $a = $db->query("SELECT * FROM entradas_efectivo WHERE td = ". $_SESSION["td"] ." order by id desc limit 10");
	        	$total=0;
	        	if($a->num_rows > 0){
	        echo ' <h3>Ultimas entradas</h3>

				<table class="table table-sm table-striped">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Descripci&oacuten</th>
			      <th scope="col">Fecha</th>
			      <th scope="col">Cantidad</th>';
			      if($g == NULL){
			      	echo '<th>Eliminar</th>';
			      }
			      
			    echo '			      
			    </tr>
			  </thead>
			  <tbody>';
			  $n = 0;
		    foreach ($a as $b) {
		    	$n++;
		    	if($b["edo"] == 1){
				$total = $total + $b["cantidad"];
				$colores='class="text-black"';
				} else {
				$colores='class="text-danger"';	
				} 

		    	echo '<tr '.$colores.'>
		    	  <td>'. $n .'</td>
			      <td>'. $b["descripcion"] .'</td>
			      <td>'. $b["fecha"] .' | '. $b["hora"] .'</td>
			      <td>'. Helpers::Dinero($b["cantidad"]) .'</td>
			      <td>';
			      if(($b["edo"] == 1 and $b["fecha"] == date("d-m-Y")) and $g == NULL){
			      	echo '<a id="xdelete" op="173" iden="'. $b["id"] .'">
				      <span class="badge red"><i class="fas fa-trash-alt" aria-hidden="true"></i></span>
				      </a>';
			      } else {
			      	echo '<span class="badge black"><i class="fas fa-ban" aria-hidden="true"></i></span>';
			      }
			      echo '</td>
			    </tr>';
			    
		    }

		    if($_SESSION["tipo_cuenta"] == 1 or $_SESSION["tipo_cuenta"] == 5){
		    echo '<tr>
			      <th scope="col"></th>
			      <th scope="col"></th>
			      <th scope="col">Total</th>
			      <th scope="col">'. Helpers::Dinero($total) .'</th>
			      <td></td>
			    </tr>';
			    }
			
			echo '</tbody>
		    </table>';
			}
  			$a->close();

   	}




	public function AddEfectivo($data){
	    $db = new dbConn();

	    if($data["descripcion"] != NULL and $data["cantidad"] != NULL){
	         $datos = array();
			    $datos["descripcion"] = $data["descripcion"];
			    $datos["cantidad"] = $data["cantidad"];
			    $datos["fecha"] = date("d-m-Y");
			    $datos["fechaF"] = Fechas::Format(date("d-m-Y"));
			    $datos["hora"] = date("H:i:s");
			    $datos["user"] = $_SESSION["user"];
			    $datos["edo"] = 1;
			    $datos["hash"] = Helpers::HashId();
				$datos["time"] = Helpers::TimeId();
			    $datos["td"] = $_SESSION["td"];
			    if ($db->insert("entradas_efectivo", $datos)) {
			        Alerts::Alerta("success","Agregado Correctamente","Efectivo Agregado corectamente!");
			    } else {
			    	Alerts::Alerta("error","Error","Error desconocido, no se agrego el registro!");
			    }
		} else {
			Alerts::Alerta("error","Error","Faltan Datos!");
		}
			$this->VerEntradas();

	}


		public function BorrarEfectivo($iden) {
		$db = new dbConn();

			    $cambio = array();
			    $cambio["edo"] = 0;
			    
			    if (Helpers::UpdateId("entradas_efectivo", $cambio, "id='$iden' and td = ".$_SESSION["td"]."")) {
			        Alerts::Alerta("success","Eliminado","Se ha eliminado el registo correctamente!");
			    } else {
			        Alerts::Alerta("error","Error","No se pudo eliminar!"); 
			    }
					    
		    
		    $this->VerEntradas();

   		}




   static public function MostarBancos($id) { 
    $db = new dbConn();

      $a = $db->query("SELECT * FROM gastos_cuentas WHERE tipo = '$id' and td = ".$_SESSION["td"]."");
      echo '<select class="browser-default custom-select mb-3" id="banco" name="banco">
      <option selected disabled>* Cuenta</option>';
      foreach ($a as $b) {  
              echo '<option value="'. $b["hash"] .'">'. $b["cuenta"] .' - '. $b["banco"] .' ('. Helpers::Dinero($b["saldo"]) .')</option>'; 
      } $a->close(); 
      echo '</select>';
    }





   static public function MostarListaCategorias() { 
    $db = new dbConn();

echo '<select class="browser-default custom-select mb-3" id="categoria" name="categoria">';
echo Helpers::SelectData("* Categoria", "gastos_categorias", "hash", "categoria");
echo '</select>';
    }





   static public function MostarTodosBancos() { 
    $db = new dbConn();

      $a = $db->query("SELECT * FROM gastos_cuentas WHERE td = ".$_SESSION["td"]."");

      echo '<table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">Tipo</th>
      <th scope="col">Cuenta</th>
      <th scope="col">Banco</th>
      <th scope="col">Saldo</th>
    </tr>
  </thead>
  <tbody>';
      foreach ($a as $b) {  

    echo '<tr>
      <th scope="row">'. Helpers::TipoCuentaBanco($b["tipo"]) .'</th>
      <td>'. $b["cuenta"] .'</td>
      <td>'. $b["banco"] .'</td>
      <td>'. Helpers::Dinero($b["saldo"]) .'</td>
    </tr>';
      } $a->close(); 
      
      echo '</tbody>
		</table>';
    }



	public function AddBanco($data){
	    $db = new dbConn();

	    if($data["tipo"] != NULL and $data["nocuenta"] != NULL){
	         $datos = array();
			    $datos["tipo"] = $data["tipo"];
			    $datos["cuenta"] = $data["nocuenta"];
			    $datos["banco"] = $data["banco"];
			    $datos["saldo"] = $data["saldo"];
			    $datos["edo"] = 1;
			    $datos["hash"] = Helpers::HashId();
				$datos["time"] = Helpers::TimeId();
			    $datos["td"] = $_SESSION["td"];
			    if ($db->insert("gastos_cuentas", $datos)) {
			        Alerts::Alerta("success","Agregado Correctamente","Banco Agregado corectamente!");
			    } else {
			    	Alerts::Alerta("error","Error","Error desconocido, no se agrego el registro!");
			    }
		} else {
			Alerts::Alerta("error","Error","Faltan Datos!");
		}
			$this->MostarTodosBancos();

	}






   static public function MostrarCategorias() { 
    $db = new dbConn();

      $a = $db->query("SELECT * FROM gastos_categorias WHERE edo = 1 and td = ".$_SESSION["td"]."");

echo '<table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">Categoria</th>
      <th scope="col">Eliminar</th>
    </tr>
  </thead>
  <tbody>';
      foreach ($a as $b) {  
    echo '<tr>
      <td>'. $b["categoria"] .'</td>
      <td><a><span class="badge red"><i class="fas fa-trash-alt" aria-hidden="true"></i></span></a></td>
    </tr>';
      } $a->close(); 
      
echo '</tbody>
</table>';
    }




	public function AddCategoria($data){
	    $db = new dbConn();

	    if($data["categoria"] != NULL){
	         $datos = array();
			    $datos["categoria"] = $data["categoria"];
			    $datos["edo"] = 1;
			    $datos["hash"] = Helpers::HashId();
				$datos["time"] = Helpers::TimeId();
			    $datos["td"] = $_SESSION["td"];
			    if ($db->insert("gastos_categorias", $datos)) {
			        Alerts::Alerta("success","Agregado Correctamente","Categoria Agregado corectamente!");
			    } else {
			    	Alerts::Alerta("error","Error","Error desconocido, no se agrego el registro!");
			    }
		} else {
			Alerts::Alerta("error","Error","Faltan Datos!");
		}
			$this->MostrarCategorias();

	}






} // termina la clase
?>