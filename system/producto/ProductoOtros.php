<?php 
class ProductoOtros{

		public function __construct() { 
     	} 


  public function EmparejaExistencias(){
      $db = new dbConn();

$x = $db->query("SELECT producto, hash, existencia FROM producto_ingresado WHERE existencia != 0  and td = ".$_SESSION["td"]."");
foreach ($x as $y) {

// cantidad total de los productos que hay
    if ($r = $db->select("sum(cantidad)", "producto", "WHERE cod = ".$y["producto"]." and td = ".$_SESSION["td"]."")) { $cantidad = $r["sum(cantidad)"]; } unset($r); 

// cantidad total de las existencia
    if ($r = $db->select("sum(existencia)", "producto_ingresado", "WHERE producto = ".$y["producto"]." and td = ".$_SESSION["td"]."")) { $canti = $r["sum(existencia)"]; } unset($r); 

// existencia actual del registro
$existencia = $y["existencia"];

      if($cantidad < $canti){

        $xcant = $canti - $cantidad;
        // evito los numeros negativos
        if($xcant > $existencia){
          $xcant = 0;
        } else {
          $xcant = $existencia - $xcant;
        }

 // echo "<br> Producto: ". $y["producto"] ." cantidad: " .  $xcant . " || Canti: " . $canti. " || cantidad: " . $cantidad. " || existencia: " . $existencia;
          $cambio = array();
          $cambio["existencia"] = $xcant;
          Helpers::UpdateId("producto_ingresado", $cambio, "hash = '".$y["hash"]."' and td = ".$_SESSION["td"]."");
      }

  } $x->close();
    


    }








  public function Caducidades(){
      $db = new dbConn();

$dias = 86400 * 30;
$fechasx = Fechas::Format(date("d-m-Y")) + $dias;

$this->EmparejaExistencias();   

$contador = 0;

$a = $db->query("SELECT * FROM producto WHERE caduca = 'on' and td = ".$_SESSION["td"]."");
  
  if($a->num_rows  > 0){
       echo '<table class="table table-sm table-striped">
    <thead>
      <tr>
        <th class="th-sm">Cod</th>
        <th class="th-sm">Producto</th>
        <th class="th-sm">Existencia</th>
        <th class="th-sm">Vencimiento</th>
        <th class="th-sm">Ver</th>
      </tr>
    </thead>
    <tbody>';   
    foreach ($a as $b) {

              /// aqui obtenemos todos los productos con fechas a vencer dentro de un mes
            $x = $db->query("SELECT * FROM producto_ingresado WHERE caducaF < '".$fechasx."' and producto = '".$b["cod"]."' and existencia > 0 and td = ".$_SESSION["td"]."");
           if($x->num_rows > 0){

            foreach ($x as $y) {

              $contador = $contador + 1;

                echo '<tr>
                            <td>'.$y["producto"].'</td>
                            <td>'.$b["descripcion"].'</td>
                            <td>'.$y["existencia"].'</td>
                            <td>'.$y["caduca"].'</td>
                            <td><a id="xver" op="55" key="'.$b["cod"].'"><i class="fas fa-search fa-lg green-text"></i></a></td>
                          </tr>';
              }

            } $x->close();
             /// termina la busqueda de productos 
   }// foreach
      echo '</tbody>
    </table>';
  } else{
    Alerts::Mensajex("No existen productos que contengan fecha de vencimiento en el sistema","info");
  }  $a->close();
  

      if($contador == 0){
        Alerts::Mensajex("No se encontraron registros con vencimiento pr&oacuteximo","info");
      }

  } // termina la funcion






} // Termina la lcase

?>