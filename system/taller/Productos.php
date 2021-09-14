<?php 
class TallerProductos{

    public function __construct() { 
    } 


// agregar productos con marcas diferentes, anos diferentes, 
public function AddModelo($hash){
	$db = new dbConn();

	$this->GetModelos(Helpers::GetData("autoparts_modelo", "marca", "hash", $hash));

	$_SESSION["dataTaller"]["modelo"][] = $hash;

	$this->ModelosAgregados();
	// unset($_SESSION["dataTaller"]);
}




public function DelModelo($hash){

unset($_SESSION["dataTaller"]["modelo"][$hash]);
$this->ModelosAgregados();

// print_r($_SESSION["dataTaller"]["modelo"]);
}


public function ModelosAgregados(){
	$db = new dbConn();

	if (count($_SESSION["dataTaller"]["modelo"]) > 0) {
			$json = json_encode($_SESSION["dataTaller"]);

			echo '<hr class="border-2">';
			echo '<small>MODELOS AGREGADOS </small><br>';
			foreach ($_SESSION["dataTaller"]["modelo"] as $key => $producto) {

				$marca = Helpers::GetData("autoparts_modelo", "marca", "hash", $producto);

				echo '<div class="chip cyan lighten-4">';
				echo Helpers::GetData("autoparts_marca", "marca", "hash", $marca); 
				echo " - ";
				echo Helpers::GetData("autoparts_modelo", "modelo", "hash", $producto); 
				echo '<a id="select" hash="'.$key.'" op="625"> 
					   <i class="close fa fa-times"></i>
					   </a>
					 </div>';
			}
	}

}


public function ModelosAgregadosDB(){ /// ya en la base de datos
	$db = new dbConn();

    $a = $db->query("SELECT modelo FROM taller_modelos WHERE producto = '".$_SESSION["producto_mod"]."' and td = " . $_SESSION["td"]);
    foreach ($a as $b) {
        $_SESSION["dataTaller"]["modelo"][] = $b["modelo"];
    } $a->close();	

	if (count($_SESSION["dataTaller"]["modelo"]) > 0) {
			$json = json_encode($_SESSION["dataTaller"]);

			echo '<hr class="border-2">';
			echo '<small>MODELOS AGREGADOS </small><br>';
			foreach ($_SESSION["dataTaller"]["modelo"] as $key => $producto) {

				$marca = Helpers::GetData("autoparts_modelo", "marca", "hash", $producto);

				echo '<div class="chip cyan lighten-4">';
				echo Helpers::GetData("autoparts_marca", "marca", "hash", $marca); 
				echo " - ";
				echo Helpers::GetData("autoparts_modelo", "modelo", "hash", $producto); 
				echo '<a id="select" hash="'.$key.'" op="625"> 
					   <i class="close fa fa-times"></i>
					   </a>
					 </div>';
			}
	}

}






public function GetMarcas(){
	$db = new dbConn();

    $a = $db->query("SELECT marca, hash FROM autoparts_marca WHERE td = " . $_SESSION["td"]);
    foreach ($a as $b) {
        
    echo '<div class="chip red lighten-4">
    <a id="select" hash="'.$b["hash"].'" op="623">';
    echo $b["marca"];
   	echo '</a>
 	</div>';

    } $a->close();

    // $this->ModelosAgregados();
}


public function GetModelos($hash){
	$db = new dbConn();

   $a = $db->query("SELECT modelo, hash FROM autoparts_modelo WHERE marca = '".$hash."' and td = " . $_SESSION["td"]);
    
   if ($a->num_rows > 0) {
   	echo '<hr class="border-2">';
		foreach ($a as $b) {     
		echo '<a id="select" hash="'.$b["hash"].'" op="624">
		<div class="chip green lighten-2">';
		echo $b["modelo"];
		echo '</div>
			</a>';
		} 
   } else {
   	Alerts::Mensajex("No se encuentran modelos de esta marca", "info");
   }

   // $this->ModelosAgregados();
$a->close();
}





public function GetAnios(){

	echo '  <div class="btn-group" role="group">
	<button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle btn-rounded" data-toggle="dropdown"
	aria-haspopup="true" aria-expanded="false">
	Anteriores...
	</button>
	<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">';

	for ($i = 1950; $i <= 1964; $i++) {          
	echo '<a id="select" op="628" hash="'.$i.'"  class="dropdown-item">'.$i.'</a>';
	}

	echo '</div>
	</div>';

	for ($i = 1965; $i <= date("Y"); $i++) {          
	echo '<a id="select" op="628" hash="'.$i.'" type="button" class="btn btn-primary btn-rounded waves-effect">'.$i.'</a>';
	}

}


public function AddAnio($hash){
	$db = new dbConn();

	$_SESSION["dataTaller"]["anio"][] = $hash;

	$this->AniosAgregados();
	// unset($_SESSION["dataTaller"]);
}



public function AniosAgregados(){
	$db = new dbConn();

	if (count($_SESSION["dataTaller"]["anio"]) > 0) {
			$json = json_encode($_SESSION["dataTaller"]);

			echo '<hr class="border-2">';
			echo '<small>AÑOS AGREGADOS </small><br>';
			foreach ($_SESSION["dataTaller"]["anio"] as $key => $anio) {

				echo '<div class="chip blue lighten-2">';
				echo $anio; 
				echo '<a id="select" hash="'.$key.'" op="629"> 
					   <i class="close fa fa-times"></i>
					   </a>
					 </div>';
			}
	}

}


public function AniosAgregadosDB(){
	$db = new dbConn();

	$a = $db->query("SELECT anio FROM taller_anios WHERE producto = '".$_SESSION["producto_mod"]."' and td = " . $_SESSION["td"]);
    foreach ($a as $b) {
        $_SESSION["dataTaller"]["anio"][] = $b["anio"];
    } $a->close();

	if (count($_SESSION["dataTaller"]["anio"]) > 0) {
			$json = json_encode($_SESSION["dataTaller"]);

			echo '<hr class="border-2">';
			echo '<small>AÑOS AGREGADOS </small><br>';
			foreach ($_SESSION["dataTaller"]["anio"] as $key => $anio) {

				echo '<div class="chip blue lighten-2">';
				echo $anio; 
				echo '<a id="select" hash="'.$key.'" op="629"> 
					   <i class="close fa fa-times"></i>
					   </a>
					 </div>';
			}
	}

}




public function DelAnio($hash){

unset($_SESSION["dataTaller"]["anio"][$hash]);
$this->AniosAgregados();

// print_r($_SESSION["dataTaller"]["modelo"]);
}




public function InsertDataProduct($cod){ // esta funcion agrega los registros de anos y modelos a la DB

	foreach ($_SESSION["dataTaller"]["modelo"] as $key => $modelo) {
		$this->InsertData($cod, $modelo, "taller_modelos", "modelo");
	}

	foreach ($_SESSION["dataTaller"]["anio"] as $key => $anio) {
		$this->InsertData($cod, $anio, "taller_anios", "anio");
	}

	$this->DeleteData();
}


public function InsertData($cod, $tipo, $bd, $campo){ // inserta datos
$db = new dbConn();

    $datos = array();
    $datos[$campo] = $tipo;
    $datos["producto"] = $cod;
    $datos["hash"] = Helpers::HashId();
    $datos["time"] = Helpers::TimeId();
    $datos["td"] = $_SESSION["td"];
    $db->insert($bd, $datos);
}


public function DeleteDataDB($producto){ // Borra datos de la base de datos antes de actualizar
	$db = new dbConn();
		// anios
		Helpers::DeleteId("taller_anios", "producto='$producto' and td = '".$_SESSION["td"]."'");
		// modelos
		Helpers::DeleteId("taller_modelos", "producto='$producto' and td = '".$_SESSION["td"]."'");
		// Medida
		Helpers::DeleteId("taller_medida", "producto='$producto' and td = '".$_SESSION["td"]."'");

	}


public function DeleteData(){
	unset($_SESSION["dataTaller"]);
}



public function AddMedida($cod, $medida){ // inserta la medida del producto
$db = new dbConn();

    $datos = array();
    $datos["medida"] = $medida;
    $datos["producto"] = $cod;
    $datos["hash"] = Helpers::HashId();
    $datos["time"] = Helpers::TimeId();
    $datos["td"] = $_SESSION["td"];
    $db->insert("taller_medida", $datos);
}




public function Search(){ // busca el producto
$db = new dbConn();

if ($_SESSION["tallerSearch"]["medida"] == "") { unset($_SESSION["tallerSearch"]["medida"]); }
if ($_SESSION["tallerSearch"]["key"] == "") { unset($_SESSION["tallerSearch"]["key"]); }
if ($_SESSION["tallerSearch"]["modelo"] == "") { unset($_SESSION["tallerSearch"]["modelo"]); }


$anio = $_SESSION["tallerSearch"]["anio"];
$key = $_SESSION["tallerSearch"]["key"];
$medida = $_SESSION["tallerSearch"]["medida"];
$modelo = $_SESSION["tallerSearch"]["modelo"];


// print_r($_SESSION["tallerSearch"]);
if ($_SESSION["tallerSearch"] != NULL) {

if ($anio != NULL) {
	$join_anio = 'INNER JOIN taller_anios ON producto.cod = taller_anios.producto ';
	$key_anio = "and taller_anios.anio LIKE '%".$anio."%'";
} else { $join_anio = ''; $key_anio = NULL; }

if ($medida != NULL) {
	$join_medida = 'INNER JOIN taller_medida ON producto.cod = taller_medida.producto ';
	$key_medida = "and taller_medida.medida LIKE '%".$medida."%' ";
	$campo = ", taller_medida.medida";
} else { 
	$join_medida = 'INNER JOIN taller_medida ON producto.cod = taller_medida.producto '; 
	$key_medida = NULL; 
	$campo = ", taller_medida.medida"; 
}

if ($modelo != NULL) {
	$join_modelo = 'INNER JOIN taller_modelos ON producto.cod = taller_modelos.producto ';
	$key_modelo = "and taller_modelos.modelo LIKE '%".$modelo."%' ";
} else { $join_modelo = ''; $key_modelo = NULL; }

$queryx = "SELECT producto.cod, producto.descripcion, producto.cantidad ".$campo." FROM producto 
 	".$join_anio."
 	".$join_medida."
 	".$join_modelo."
 	WHERE 
 	producto.descripcion LIKE '%".$key."%' 
 	".$key_anio."
 	".$key_medida."
 	".$key_modelo."
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
            <th class="th-sm">Medida</th>
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
              <td>'.$b["medida"].'</td>
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