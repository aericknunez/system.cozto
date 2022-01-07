<?php 
class AdvancedSearch{

    public function __construct() { 
    } 


public function Search(){ // busca el producto
$db = new dbConn();

if ($_SESSION["advancedSearch"]["criterio1"] == "") { unset($_SESSION["advancedSearch"]["criterio1"]); }
if ($_SESSION["advancedSearch"]["criterio2"] == "") { unset($_SESSION["advancedSearch"]["criterio2"]); }
if ($_SESSION["advancedSearch"]["criterio3"] == "") { unset($_SESSION["advancedSearch"]["criterio3"]); }
if ($_SESSION["advancedSearch"]["key"] == "") { unset($_SESSION["advancedSearch"]["key"]); }


$criterio1 = $_SESSION["advancedSearch"]["criterio1"];
$criterio2 = $_SESSION["advancedSearch"]["criterio2"];
$criterio3 = $_SESSION["advancedSearch"]["criterio3"];
$key = $_SESSION["advancedSearch"]["key"];



// print_r($_SESSION["tallerSearch"]);
if ($_SESSION["advancedSearch"] != NULL) {

if ($criterio1 != NULL or $criterio2 != NULL or $criterio2 != NULL) {
    $join_criterio1 = 'INNER JOIN producto_tags ON producto.cod = producto_tags.producto ';
}
if ($criterio1 != NULL) {
	$key_criterio1 = "and producto_tags.tag LIKE '%".$criterio1."%'";
} else { $join_criterio1 = ''; $key_criterio1 = NULL; }

if ($criterio2 != NULL) {
	$key_criterio2 = "and producto_tags.tag LIKE '%".$criterio2."%'";
}


if ($criterio3 != NULL) {
	$key_criterio3 = "and producto_tags.tag LIKE '%".$criterio3."%'";
} else { $join_criterio3 = ''; $key_criterio3 = NULL; }


$queryx = "SELECT producto.cod, producto.descripcion, producto.cantidad FROM producto  
 	".$join_criterio1."
 	WHERE 
 	producto.descripcion LIKE '%".$key."%'  
 	".$key_criterio1."
 	".$key_criterio2."
 	".$key_criterio3."
 	and producto.td = ".$_SESSION["td"]." 
 	GROUP BY producto.cod limit 15";

// echo $queryx;

 $a = $db->query($queryx);
      
      if($a->num_rows > 0){
          echo '<table class="table table-sm table-striped">
        <thead>
          <tr>
            <th class="th-sm">Cod</th>
            <th class="th-sm">Producto</th>
            <th class="th-sm">Cantidad</th>
       		<th class="th-sm">Precio</th>
       		<th class="th-sm">Ver</th>
       		</tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {

$precio = Helpers::GetData("producto_precio", "precio", "producto", $b["cod"]);

        echo '<tr>
              <td>'.$b["cod"].'</td>
              <td>'.$b["descripcion"].'</td>
              <td>'.$b["cantidad"].'</td>
        	 <td>'.Helpers::Dinero($precio).'</td>
        	 <td><a id="xver" op="55" key="'.$b["cod"].'"><i class="fas fa-eye green-text"></i></a></td>
        </tr>';
        }
        echo '</tbody>
        </table>';
      }
        $a->close();

} else {
	Alerts::Mensajex("Seleccione los valores a buscar","success");
}


}



















} // Termina la clase
?>