<?php 
class Cuentas {

	public function __construct(){

	}



   static public function MostrarBancos() { 
    $db = new dbConn();

      $a = $db->query("SELECT * FROM gastos_cuentas WHERE td = ".$_SESSION["td"]."");

      echo '<table class="table table-sm table-striped">
  <thead>
    <tr>
      <th scope="col">Tipo</th>
      <th scope="col">Cuenta</th>
      <th scope="col">Banco</th>
      <th scope="col">Saldo</th>
      <th scope="col">Ver</th>
    </tr>
  </thead>
  <tbody>';
      foreach ($a as $b) {  

    echo '<tr>
      <th scope="row">'. Helpers::TipoCuentaBanco($b["tipo"]) .'</th>
      <td>'. $b["cuenta"] .'</td>
      <td>'. $b["banco"] .'</td>
      <td>'. Helpers::Dinero($b["saldo"]) .'</td>
      <td><a id="verdetallesbanco" hash="'.$b["hash"].'"><i class="fas fa-eye fa-lg green-text"></i></a></td>
    </tr>';
      } $a->close(); 
      
      echo '</tbody>
		</table>';
    }



    static public function TransaccionesBanco($banco) { 
        $db = new dbConn();

   
          $a = $db->query("SELECT * FROM gastos WHERE cuenta_banco = '$banco' and  td = ".$_SESSION["td"]."");
    
          if ($a->num_rows > 0) {

            echo '<hr class="mt-4" style="height:3px; border:none; color:#333; background-color:#333;">';

            if ($r = $db->select("*", "gastos_cuentas", "WHERE hash = '$banco' and  td = ".$_SESSION["td"]."")) { 
                $cuentax = $r["cuenta"]; $bancox = $r["banco"]; $saldox = $r["saldo"];
            } unset($r);  

                echo '<h3><span class="font-weight-bold">Cuenta: </span> '.$cuentax.'</h3>';
                echo '<h3><span class="font-weight-bold">Banco: </span> '.$bancox.'</h3>';
                echo '<h3><span class="font-weight-bold">Saldo: </span> '.Helpers::Dinero($saldox).'</h3>';


          echo '<table class="table table-sm table-striped">
      <thead>
        <tr>
          <th scope="col">Tipo</th>
          <th scope="col">Tipo Movimiento</th>
          <th scope="col">Nombre</th>
          <th scope="col">Descripci&oacuten</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Fecha</th>
        </tr>
      </thead>
      <tbody>';
          foreach ($a as $b) {  
        ($b["tipo"] == 3) ? $cuenta = "Entrada" : $cuenta = "Salida";
        echo '<tr>
          <th scope="row">'. $cuenta .'</th>
          <th scope="row">'. Helpers::Gasto($b["tipo"]) .'</th>
          <td>'. $b["nombre"] .'</td>
          <td>'. $b["descripcion"] .'</td>
          <td>'. Helpers::Dinero($b["cantidad"]) .'</td>
          <td>'. $b["fecha"] .'</td>
        </tr>';
          } 
          echo '</tbody>
            </table>';

        } else {
            Alerts::Mensajex("No se encontraron movimientos","success");
        }
        
        $a->close(); 
         
        }








} // termina la clase
?>