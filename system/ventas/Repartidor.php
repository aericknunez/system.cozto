<?php 
class Repartidor{

	public function __construct() { 
 	} 


     public function RepartidorBusqueda($dato){ // Busqueda para cliente
        $db = new dbConn();
    
              $a = $db->query("SELECT * FROM planilla_empleados WHERE (nombre like '%".$dato["keyword"]."%' or documento like '%".$dato["keyword"]."%') and td = ".$_SESSION["td"]." limit 10");
               if($a->num_rows > 0){
                echo '<table class="table table-sm table-hover">';
                    foreach ($a as $b) {
                            echo '<tr>
                                    <td scope="row"><a id="select-rep" hash="'. $b["hash"] .'" nombre="'. $b["nombre"] .'"><div>'. $b["nombre"] .'   ||   '. $b["documento"].'</div></a></td>
                                    </tr>'; 
                    }  $a->close();
    
            echo '
            </table>';
              } else {
                echo "El criterio de busqueda no corresponde a un cliente";
              }
      }


      public function AgregaRepartidor($dato){ // agrega  cliente
    
            $_SESSION["repartidor_cli"] = $dato["hash"];
            $_SESSION["repartidor_asig"] = $dato["nombre"];
     
            $texto = 'Repartidor asignado para la Orden: ' . $_SESSION['repartidor_asig']. ".";
            Alerts::Mensajex($texto,"danger",'<a id="quitar-repartidorA" op="707" class="btn btn-danger btn-rounded">Quitar Repartidor</a>', null);
    
    
            $cambio = array();
            $cambio["repartidor"] = $_SESSION["repartidor_cli"];
            Helpers::UpdateId("ticket_orden", $cambio, "correlativo = '".$_SESSION["orden"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");   
            Helpers::UpdateId("ticket", $cambio, "orden = '".$_SESSION["orden"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");   
    
      }


      public function DeleteRepartidor(){ // agrega  cliente
    
            $cambio = array();
            $cambio["repartidor"] = NULL;
            Helpers::UpdateId("ticket_orden", $cambio, "correlativo = '".$_SESSION["orden"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");   
            Helpers::UpdateId("ticket", $cambio, "orden = '".$_SESSION["orden"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");   
            
            unset($_SESSION["repartidor_cli"]);
            unset($_SESSION["repartidor_asig"]);
      }

      /// obtener los registros de la tabla planilla_empleados para el select
      public function RepartidorLista(){
        $db = new dbConn();
    
        $a = $db->query("SELECT * FROM planilla_empleados WHERE td = ".$_SESSION["td"]."");
      echo '<select class="browser-default form-control my-2" id="repartidor" name="repartidor">';
      echo '<option value="" disabled selected>Seleccione un Repartidor</option>';
        foreach ($a as $b) {
            echo '<option value="'. $b["hash"] .'">'. $b["nombre"] .'</option>';
        } $a->close();
      echo '</select>';
      }

      public function UserLista(){
            $db = new dbConn();
        
            $a = $db->query("SELECT * FROM login_userdata WHERE tipo!=1 and td = ".$_SESSION["td"]."");
          echo '<select class="browser-default form-control my-2" id="vendedor" name="vendedor">';
          echo '<option value="" disabled selected>Seleccione un usuario</option>';
            foreach ($a as $b) {
                echo '<option value="'. $b["hash"] .'">'. $b["nombre"] .'</option>';
            } $a->close();
          echo '</select>';
          }


      public function VerRepartidores($rep, $date, $imp = false, $type){
		$db = new dbConn();

            if($rep){
                  if ($type == 1) {
                        $repart = "repartidor = '".$rep."' and";
                        $nombre_repartidor = 'REPARTIDOR: '. Helpers::GetData("planilla_empleados", "nombre", "hash", $rep) .' | ';
                  } else {
                        $repart = "user = '".$rep."' and";
                        $nombre_repartidor = 'VENDEDOR: '. Helpers::GetData("login_userdata", "nombre", "hash", $rep) .' | ';
                  }
                  
            } else {
               $repart = null;
               $nombre_repartidor = null;
            }

            if ($date == NULL or $rep == null) {
                  echo '<div class="alert alert-danger" role="alert"> <h4 class="alert-heading">Error!</h4>';
                  if($_POST["fecha_submit"] == NULL){
                    echo '<p>Debe seleccionar una fecha</p>';
                  }
                  if($rep == NULL){
                    echo '<p>Debe seleccionar un repartidor</p>';
                  }
                  echo '</div>';
            }

            $a = $db->query("select cod, cant, total, producto, pv 
            from ticket 
            where $repart cod = '9999999' and edo = 1 and fecha = '".$date."' and td = ".$_SESSION['td']." order by cant desc");
            $especial = NULL;
            if($a->num_rows > 0){
            foreach ($a as $b) {
            $especial .= '<tr>
                  <th scope="row">'. $b["cant"] . '</th>
                  <td>'. $b["producto"] . '</td>
                  <td>'. Helpers::Dinero($b["pv"]) . '</td>
                  <td>'. Helpers::Dinero($b["total"]) . '</td>
            </tr>';
            } 
            } $a->close();

			$a = $db->query("select cod, sum(cant), sum(total), producto, pv 
          from ticket 
          where $repart cod != 8888 and cod != 9999999 and edo = 1 and fecha = '".$date."' and td = ".$_SESSION['td']." GROUP BY cod order by sum(cant) desc");

			if($a->num_rows > 0 or $especial){
				
			      echo '<h3 class="h5">'.$nombre_repartidor.'FECHA : '.$date.'</h3>';
				    
				echo '<div class="table-responsive">
				<table class="table table-striped table-sm">
						<thead>
					     <tr>
					       <th>Cant</th>
					       <th>Producto</th>
					       <th>Precio</th>
					       <th>Total</th>
					     </tr>
					   </thead>

						<tbody>';

			    foreach ($a as $b) {
		    
			   echo '<tr>
			       <th scope="row">'. $b["sum(cant)"] . '</th>
			       <td>'. $b["producto"] . '</td>
			       <td>'. Helpers::Dinero($b["pv"]) . '</td>
			       <td>'. Helpers::Dinero($b["sum(total)"]) . '</td>
			     </tr>';
			    } 

			    $a->close();
                  echo $especial;

			echo '</tbody>
				</table></div>';
			
			$ar = $db->query("SELECT sum(cant) FROM ticket where $repart edo = 1 and fecha = '".$date."' and td = ".$_SESSION['td']."");
		    foreach ($ar as $br) {
		     echo "Cantidad de Productos: ". $br["sum(cant)"] . "<br>";
		    } $ar->close();

                if ($imp == TRUE) {
                  echo '<div class="text-right"><a href="system/facturar/facturas/'.$_SESSION["td"].'/impresion_repartidor.php?fecha='.$date.'&repartidor='.$rep.'&type='.$type.'" target="blank" >Imprimir</a></div>';
                }
		     

			} else {
				Alerts::Mensajex("No se encontraron productos para este dia","danger");
			}
				
      }


      public function UnsetRepartidor(){
            if(isset($_SESSION["repartidor_cli"])) unset($_SESSION["repartidor_cli"]);
            if(isset($_SESSION["repartidor_asig"])) unset($_SESSION["repartidor_asig"]);		
      }


      public function VarRepartidor(){
            $db = new dbConn();

            if ($r = $db->select("repartidor", "ticket_orden", "WHERE orden = ".$_SESSION["orden"]." and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."")) { 
                  if($r["repartidor"] != NULL){
                        $_SESSION["repartidor_cli"] =  $r["repartidor"];
                  }	    	
            } unset($r);  
            if($_SESSION["repartidor_cli"]){
                  $_SESSION["repartidor_asig"] = Helpers::GetData("planilla_empleados", "nombre", "hash", $_SESSION["repartidor_cli"]);
            } else {
                  $this->UnsetRepartidor();
            }

      }


} // Termina la lcase
?>