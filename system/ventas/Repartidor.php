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