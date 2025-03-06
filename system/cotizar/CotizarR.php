<?php 
class Cotizar{

	public function __construct() { 
 	} 



   public function SumaVenta($datos){ // Rapida
	
	
  		if($this->ObtenerCantidad($datos["cod"]) <= 0 || $this->ObtenerCantidad($datos["cod"]) < $this->ObtenerCantidadTicket($datos["cod"]) + 1 || $this->ObtenerCantidad($datos["cod"]) < $datos["cantidad"]){
			if ($_SESSION["config_agotado"] == "on"){
				Alerts::Alerta("error","Error!","No dispone de suficiente Existencia del producto!");
			} else{
				if($_SESSION["cotizacion"] == NULL){ $this->AddOrden(); }
				
					/// aqui determino si agrego o actualizo
				if($datos["cantidad"] == NULL or $datos["cantidad"] == 0) $datos["cantidad"] = 1;
				$product = $this->ObtenerCantidadTicket($datos["cod"]);
				if($datos["cantidad"] == 1){
						$datos["cantidad"] = $product + 1;
				}
	
				if($product > 0){  			
						$this->Actualiza($datos, null); // null es resta
				} else {
						$this->Agregar($datos);
				}
			}
  		} else {
			if($_SESSION["cotizacion"] == NULL){ $this->AddOrden(); }
  			
				/// aqui determino si agrego o actualizo
				if($datos["cantidad"] == NULL or $datos["cantidad"] == 0) $datos["cantidad"] = 1;
				$product = $this->ObtenerCantidadTicket($datos["cod"]);
				if($datos["cantidad"] == 1){
					$datos["cantidad"] = $product + 1;
				}
  
				if($product > 0){  			
					$this->Actualiza($datos, null); // null es resta
				} else {
					$this->Agregar($datos);
				}
  		}

		$this->VerProducto();
		if ($this->cuentaMateriales() > 0) {
			echo '<hr>'; 
			echo '<hr>'; 
			echo '<h4>Materiales</h4>'; 
			$this->VerMateriales();
		}
   }



   public function RestaVenta($datos){ // Rapida

  		if($this->ObtenerCantidad($datos["cod"]) >= 0){
  			if($_SESSION["cotizacion"] == NULL){ $this->AddOrden(); }
  			
  			/// aqui determino si agrego o actualizo
	  		if($datos["cantidad"] == NULL or $datos["cantidad"] == 0) $datos["cantidad"] = 1;
	  		$product = $this->ObtenerCantidadTicket($datos["cod"]);
  			if($datos["cantidad"] == 1){
	  			$datos["cantidad"] = $product - 1;
  			}
  			
  			if($product > 1){  				
  				$this->Actualiza($datos, 1); // uno suma
  			} 
  		} else {
  			 Alerts::Alerta("error","Error!","No se encontro el producto!");
  		}
  	$this->VerProducto();
	  if ($this->cuentaMateriales() > 0) {
		echo '<hr>'; 
		echo '<hr>'; 
		echo '<h4>Materiales</h4>'; 
		$this->VerMateriales();

	  }
   }



	public function AplicarDescuento() { //Aplica el descuento a los productos
		$db = new dbConn();
				    
		    $a = $db->query("SELECT * FROM cotizaciones WHERE cotizacion = '".$_SESSION["cotizacion"]."' and td = ".$_SESSION["td"]."");

		    if($a->num_rows > 0){
		    	foreach ($a as $b) {
		    		$datos["cantidad"] = $b["cant"];
		    		$datos["cod"] = $b["cod"];
		    		$this->Actualiza($datos, 1);
		    	}
		    } $a->close();

		    if($_SESSION['descuento_cot'] != NULL){
		 $lateral = new Laterales(); 
   		 $precio = $lateral->ObtenerTotal($_SESSION["cotizacion"]);
		  $texto = 'El total en esta venta es de: ' . $precio;
		  Alerts::Mensajex($texto,"success",$boton,$boton2);



		  $texto = 'Esta venta posee un descuento de : ' . $_SESSION['descuento_cot']. " %";
		  Alerts::Mensajex($texto,"danger",'<a id="quitar-descuento" op="156" class="btn btn-danger btn-rounded">Quitar Descuento</a>',$boton2);
		} else {
			$lateral = new Laterales();
			    $precio = $lateral->ObtenerTotal($_SESSION["cotizacion"]);
			  $texto = 'El total en esta venta sin descuento es de: ' . $precio;
			  Alerts::Mensajex($texto,"success",$boton,$boton2);
			} 

	}

	
	public function Agregar($datos) { // agrega el producto
		$db = new dbConn();

	$pv = $this->ObtenerPrecio($datos["cod"], $datos["cantidad"]);
	$sumas = $pv * $datos["cantidad"];

	if($_SESSION['descuento_cot'] != NULL){
		$sumas = Helpers::DescuentoTotalCot($sumas);
		$pv = Helpers::DescuentoTotalCot($pv);
	}

    $stot=Helpers::STotal($sumas, $_SESSION['config_imp']);
    $im=Helpers::Impuesto($stot, $_SESSION['config_imp']);

		$datox = array();
	    $datox["cod"] = $datos["cod"];
	    $datox["cant"] = $datos["cantidad"];
	    $datox["producto"] = $this->ObtenerNombre($datos["cod"]);
	    $datox["pv"] = $pv;  				   
	    $datox["stotal"] = $stot;	    				   
	    $datox["imp"] = $im;
	    $datox["total"] = $stot + $im;
	    $datox["cotizacion"] = $_SESSION["cotizacion"];
	    $datox["user"] = $_SESSION['user'];
	    $datox["edo"] = 1;
	    $hash = Helpers::HashId();
	    $datox["hash"] = $hash;
		$datox["time"] = Helpers::TimeId();
	    $datox["td"] = $_SESSION["td"];
	    $db->insert("cotizaciones", $datox);

	}




	public function Actualiza($datos,$func) { // agrega el producto suma de uno n uno
		$db = new dbConn();

	$pv = $this->ObtenerPrecio($datos["cod"], $datos["cantidad"]);
	$sumas = $pv * $datos["cantidad"];
	$descuento = NULL;

		if($_SESSION['descuento_cot'] != NULL){
		$sumasx = $sumas;
		$sumas = Helpers::DescuentoTotalCot($sumas);
		$pv = Helpers::DescuentoTotalCot($pv);
		$descuento = $sumasx - $sumas;
	}

    $stot=Helpers::STotal($sumas, $_SESSION['config_imp']);
    $im=Helpers::Impuesto($stot, $_SESSION['config_imp']);

	    $cambio = array();
	    $cambio["cant"] = $datos["cantidad"];
	    $cambio["pv"] = $pv;
	    $cambio["stotal"] = $stot;
	    $cambio["imp"] = $im;
	    $cambio["total"] = $stot + $im;
	    $cambio["descuento"] = $descuento;
	    Helpers::UpdateId("cotizaciones", $cambio, "cod='".$datos["cod"]."' and cotizacion = ".$_SESSION["cotizacion"]." and td = ".$_SESSION["td"]."");

	}


	public function ObtenerNombre($cod){
		$db = new dbConn();

	if ($r = $db->select("descripcion", "producto", "WHERE cod = '$cod' and td = ".$_SESSION["td"]."")){ 
        return $r["descripcion"];
    	} unset($r); 
    }


	public function ObtenerPrecio($cod, $cant){ // obtiene el precio independientemente la cantidad
		$db = new dbConn();
		// cuento si hay varias fechas
	$a = $db->query("SELECT * FROM producto_precio WHERE producto = '$cod' and td = ".$_SESSION["td"]."");
		$precios = $a->num_rows; $a->close();

			if($precios > 1){ // si hay mas de un precio
					
					if ($r = $db->select("precio", "producto_precio", "WHERE cant <= '$cant' and producto = '$cod' and td = ".$_SESSION["td"]." order by cant desc limit 1")) { 
				        $precio = $r["precio"];
				    } unset($r);

			} else { // si solo hay un precio
				   
				    if ($r = $db->select("precio", "producto_precio", "WHERE producto = '$cod' and td = ".$_SESSION["td"]."")) { 
				        $precio = $r["precio"];
				    } unset($r); 	
			}
				return $precio;
	}




	public function ObtenerCantidad($cod) { // obtine cantiad de productos
		$db = new dbConn();

	if ($r = $db->select("cantidad", "producto", "WHERE cod = '$cod' and td = ".$_SESSION["td"]."")){ 
        return $r["cantidad"];
    	} unset($r); 
    }


	public function ObtenerCantidadTicket($cod) { // obtine cantiad de productos
		$db = new dbConn();

	if ($r = $db->select("cant", "cotizaciones", "WHERE cod = '$cod' and cotizacion = ".$_SESSION["cotizacion"]." and td = ".$_SESSION["td"]."")){ 
        return $r["cant"];
    	} unset($r); 
    }




	public function AddOrden() { //leva el control del autoincremento de las cotizaciones
		$db = new dbConn();

	    if ($r = $db->select("correlativo", "cotizaciones_data", "WHERE td = ".$_SESSION["td"]." order by correlativo desc limit 1")) { 
	        $ultimoorden = $r["correlativo"];
	    } unset($r);  

	    	if($ultimoorden == NULL){ $ultimoorden = 0; }
			$datos = array();
		    $datos["cliente"] = $_SESSION["cliente_cot"];
		    $datos["correlativo"] = $ultimoorden + 1;
		    $datos["fecha"] = date("d-m-Y");
		    $datos["hora"] = date("H:i:s");
		    $datos["fechaF"] = Fechas::Format(date("d-m-Y"));
		    $datos["caduca"] = Fechas::DiaSuma(date("d-m-Y"), $_SESSION['config_dias_cotizacion']);
		    $datos["caducaF"] = Fechas::Format(Fechas::DiaSuma(date("d-m-Y"), $_SESSION['config_dias_cotizacion']));
		    $datos["edo"] = 1;
		    $datos["hash"] = Helpers::HashId();
		    $datos["time"] = Helpers::TimeId();
		    $datos["td"] = $_SESSION["td"];
		    $db->insert("cotizaciones_data", $datos); 
		
		$_SESSION["cotizacion"] = $ultimoorden + 1;    
	}



	
public function AgregarProductoEspecial($datos) { // agrega el producto Especial
	$db = new dbConn();
	
	if($_SESSION["cotizacion"] == NULL){ $this->AddOrden(); }

if($datos["precio"] != NULL and $datos["producto"] != NULL){

$stot=Helpers::STotal($datos["precio"], $_SESSION['config_imp']) * $datos["cantidad"]; 
$im=Helpers::Impuesto($stot, $_SESSION['config_imp']);

if($datos["agrupado"] == NULL){
$codigog = 9999999;
} else {
$codigog = 8888888;
$_SESSION["venta_agrupado"] = TRUE;
}

	$datox = array();
	$datox["cod"] = $codigog;
	$datox["cant"] = $datos["cantidad"];
	$datox["producto"] = strtoupper($datos["producto"]);
	$datox["pv"] = $datos["precio"];  				   
	$datox["stotal"] = $stot;	    				   
	$datox["imp"] = $im;
	$datox["total"] = $stot + $im;
	$datox["cotizacion"] = $_SESSION["cotizacion"];
	$datox["user"] = $_SESSION['user'];
	$datox["edo"] = 1;
	$hash = Helpers::HashId();
	$datox["hash"] = $hash;
	$datox["time"] = Helpers::TimeId();
	$datox["td"] = $_SESSION["td"];
	if($db->insert("cotizaciones", $datox)){
		echo '<script>
			window.location.href="?cotizar"
		</script>';
	}
} else {
	Alerts::Alerta("error","Error!","Los campos no pueden estar vacios!");
}   	

}


/////////// mostrar los productos agregados



	public function VerProducto() { //leva el control del autoincremento de los clientes
		$db = new dbConn();
		    
		if($_SESSION["cotizacion"] != NULL){
		    
		    $a = $db->query("SELECT * FROM cotizaciones WHERE cotizacion = ".$_SESSION["cotizacion"]." and td = ".$_SESSION["td"]."");

		    if($a->num_rows > 0){
				
		    		echo '<table class="table table-striped table-sm">
					  <thead>
					    <tr>
					      <th scope="col">Cant</th>
					      <th scope="col">Producto</th>
					      <th scope="col">Precio</th>
					      <th scope="col">Subtotal</th>
					      <th scope="col">Impuesto</th>
					      <th scope="col">Total</th>
					      <th scope="col">OP</th><th scope="col">Borrar</th>
					    </tr>
					  </thead>
					  <tbody>';
		    		foreach ($a as $b) {
						@$porcentaje = (($b["descuento"] * 100) / ($b["total"] + $b["descuento"]));
		    		   echo '<tr>
						      <th scope="row"><a href="?modal=cantidadc&cant='.$b["cant"].'&cod='.$b["cod"].'">'.$b["cant"].'</a></th>
						      <td>'.$b["producto"].'</td>
						      <td>'.$b["pv"].'</td>
						      <td>'.Helpers::Format($b["stotal"]).'</td>
						      <td>'.Helpers::Format($b["imp"]).'</td>
							  <td>
							  <a id="xdescuento" dcodigo="'.$b["cod"].'" dcantidad="'.$b["cant"].'" ddescuento="'.$b["descuento"].'" dporcentaje="'.$porcentaje.'">'.$b["total"].'</a>
						      </td>
			    			<td><a id="modcant" op="151" cod="'.$b["cod"].'"><i class="fas fa-minus-circle red-text fa-lg"></i></a>  <a id="modcant" op="150" cod="'.$b["cod"].'"><i class="fas fa-plus-circle green-text fa-lg"></i></a></td>
			    			<td><a id="borrar-ticket" op="152" hash="'.$b["hash"].'"><i class="fas fa-times-circle red-text fa-lg"></i></a></td>
					</tr>';
				    }
				    	echo '</tbody>
							</table>';
		    } $a->close();

		    $this->Sonar();
		} 
		  
	}



//// borrar
	
	public function CuentaProductos($orden){ // productde  de la tabla ticket
		$db = new dbConn();

		$a = $db->query("SELECT * FROM cotizaciones WHERE cotizacion = '$orden' and td = ".$_SESSION["td"]."");
		    
		    return $a->num_rows;
		    $a->close();
    }


	public function DelOrden($cotizacion){ // elimina el registro de la orden
		$db = new dbConn();

		Helpers::DeleteId("cotizaciones_data", "correlativo = '$cotizacion' and td = ".$_SESSION["td"]."");
		$this->DelMateriales();

		$imagenesCot = $db->query("SELECT imagen FROM cotizaciones_images WHERE cotizacion = '$cotizacion' and td = ".$_SESSION["td"]."");
			if($imagenesCot->num_rows > 0){
            foreach ($imagenesCot as $imagenCot) {
				$this->BorrarImagen($imagenCot["imagen"], '../../assets/img/cotizacionesimg/' . $_SESSION["td"] . '/', $cotizacion);
            	}
			}; 
        $imagenesCot->close();
		
		if(isset($_SESSION["cotizacion"])) unset($_SESSION["cotizacion"]);
		if(isset($_SESSION["descuento_cot"])) unset($_SESSION["descuento_cot"]);

		if(isset($_SESSION["cliente_cot"])) unset($_SESSION["cliente_cot"]);
		if(isset($_SESSION["cliente_nombre"])) unset($_SESSION["cliente_credito"]);		
		echo '<script>
			window.location.href="?cotizar"
		</script>';

    }


   public function DelVenta($hash, $ver){
	$db = new dbConn();

  	// borro el registro de ticket
  	Helpers::DeleteId("cotizaciones", "hash = '$hash' and td = ".$_SESSION["td"]."");
  	// compruebo si hay mas productos sino elimino orden
	  	
	  	if($this->CuentaProductos($_SESSION["cotizacion"]) == 0){
	  		$this->DelOrden($_SESSION["cotizacion"]);
			$this->DelMateriales();
	  	}

	  	if($ver == NULL){
	  		$this->VerProducto();
			  	  if ($this->cuentaMateriales() > 0) {
						echo '<hr>'; 
						echo '<hr>'; 
						echo '<h4>Materiales</h4>'; 
						$this->VerMateriales();

					}
	  	}
	  	if($ver == 1 and $this->CuentaProductos($_SESSION["cotizacion"]) == 0){
	  		$this->VerProducto();
			  	  if ($this->cuentaMateriales() > 0) {
					echo '<hr>'; 
					echo '<hr>'; 
					echo '<h4>Materiales</h4>'; 
					$this->VerMateriales();

				}
	  	}
   }



   	public function Cancelar() { //cancela toda la orden
		$db = new dbConn();

			$can = $db->query("SELECT * FROM cotizaciones WHERE cotizacion = ".$_SESSION["cotizacion"]." and td = ".$_SESSION["td"]."");
		    
		    foreach ($can as $cancel) {
		    	$hash = $cancel["hash"];	    
		    	$this->DelVenta($hash, 1);
		    }

		    if($can->num_rows == 0){
		    	$this->DelOrden($_SESSION["cotizacion"]);
		    }
		 
		 $can->close();

		unset($_SESSION["cliente_nombre"]);

		echo '<script>
			window.location.href="?cotizar"
		</script>';	
	}







	public function Sonar(){
		if($_SESSION["config_sonido"] == "on"){
			echo '<audio id="audioplayer" autoplay=true>
			<source src="assets/sound/bleep.mp3" type="audio/mpeg">
			<source src="assets/sound/bleep.ogg" type="audio/ogg">
		  </audio>';
		}
	}



///////////////////// agregar credito

  public function ClienteBusqueda($dato){ // Busqueda para cliente
    $db = new dbConn();

          //$a = $db->query("SELECT * FROM clientes WHERE (nombre like '%".$dato["keyword"]."%' or documento like '%".$dato["keyword"]."%') and td = ".$_SESSION["td"]." limit 10");
		  $a = $db->query("SELECT nombre, documento, hash FROM clientes
		  					WHERE nombre LIKE '%" . $dato["keyword"] . "%' AND td = " . $_SESSION["td"] . "
		  					UNION
		  					SELECT cliente AS nombre, documento, hash FROM facturar_documento
		  					WHERE cliente LIKE '%" . $dato["keyword"] . "%' AND td = " . $_SESSION["td"]." LIMIT 10");
           if($a->num_rows > 0){
            echo '<table class="table table-sm table-hover">';
    foreach ($a as $b) {
               echo '<tr>
                      <td scope="row"><a id="select-c" hash="'. $b["hash"] .'" nombre="'. $b["nombre"] .'"><div>'. $b["nombre"] .'   ||   '. $b["documento"].'</div></a></td>
                    </tr>'; 
    }  $a->close();

        echo '
        </table>';
          } else {
            echo "El criterio de busqueda no corresponde a un cliente";
          }
  }


  public function AgregaCliente($dato){ // Busqueda para cliente
    $db = new dbConn();

       	$_SESSION["cliente_cot"] = $dato["hash"]; // asigna el credito
		$_SESSION["cliente_nombre"] = $dato["nombre"];

		$this->AddOrden();

		echo '<script>
			window.location.href="?cotizar"
		</script>';
  }





	public function GuardarCotizacion() { //guarda la cotizacion
		$db = new dbConn();


			$can = $db->query("SELECT * FROM cotizaciones WHERE cotizacion = ".$_SESSION["cotizacion"]." and td = ".$_SESSION["td"]."");
		    
		    if($can->num_rows > 0){
		    	
		    			$cambios = array();
					   	$cambios["edo"] = 2;
					   	Helpers::UpdateId("cotizaciones_data", $cambios, "correlativo = ".$_SESSION["cotizacion"]." and td = ".$_SESSION["td"].""); 

						unset($_SESSION["cotizacion"]);
						unset($_SESSION["cliente_nombre"]);

		    } else {
		    	$this->DelOrden($_SESSION["cotizacion"]);
		    }
		 
		 $can->close();

		echo '<script>
			window.location.href="?cotizaciones"
		</script>';
	}
	

	public function SelectCotizacion($cotizacion) { //Seleccioa cotizacion
		$db = new dbConn();

		$cambios = array();
	   	$cambios["edo"] = 1;
	   	Helpers::UpdateId("cotizaciones_data", $cambios, "correlativo = '$cotizacion' and td = ".$_SESSION["td"].""); 

		$_SESSION["cotizacion"] = $orden;
	}





 public function TodasCotizaciones($npagina, $orden, $dir){
      $db = new dbConn();

  $limit = 12;
  $adjacents = 2;
  $op = 159;

  if($npagina == NULL) $npagina = 1;
  $a = $db->query("SELECT * FROM cotizaciones_data WHERE edo = 2 and td = ". $_SESSION['td'] ."");
  $total_rows = $a->num_rows;
  $a->close();

  $total_pages = ceil($total_rows / $limit);
  
  if(isset($npagina) && $npagina != NULL) {
    $page = $npagina;
    $offset = $limit * ($page-1);
  } else {
    $page = 1;
    $offset = 0;
  }

if($dir == "desc") $dir2 = "asc";
if($dir == "asc") $dir2 = "desc";


 $a = $db->query("SELECT * FROM cotizaciones_data WHERE edo = 2 and td = ". $_SESSION['td'] ." order by ".$orden." ".$dir." limit $offset, $limit");
      
      if($a->num_rows > 0){
          echo '<table class="table table-sm table-striped">
        <thead>
          <tr>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="cliente" dir="'.$dir2.'">Cliente</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="correlativo" dir="'.$dir2.'">Cotizaci&oacuten</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="fecha" dir="'.$dir2.'">Fecha</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="caduca" dir="'.$dir2.'">Caduca</a></th>
            <th class="th-sm">Estado</th>
			<th class="th-sm">Imagen</th>
            <th class="th-sm">Ver</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
    //if ($r = $db->select("nombre", "clientes", "WHERE hash = '".$b["cliente"]."' and td = ". $_SESSION["td"] ."")) { 
		if ($r = $db->query("SELECT nombre FROM clientes
		  					WHERE hash = '".$b["cliente"]."' AND td = " . $_SESSION["td"] . "
		  					UNION
		  					SELECT Cliente AS nombre FROM facturar_documento
		  					WHERE hash = '".$b["cliente"]."' AND td = " . $_SESSION["td"]."")){
		$nombre = mysqli_fetch_array($r); 
        $cliente = $nombre["nombre"]; } unset($r); 

       if($b["caducaF"] < Fechas::Format(date("d-m-Y"))){ 
       	$edo = '<div class="text-danger font-weight-bold">Caducada<div>'; 
       	} else { 
       $edo = '<div class="text-success font-weight-bold">Activa<div>'; 
   		}

          echo '<tr>
                      <td>'.$cliente.'</td>
                      <td>'.$b["correlativo"].'</td>
                      <td>'.$b["fecha"].'</td>
                      <td>'.$b["caduca"].'</td>
                      <td>'.$edo.'</td>
					  <td><a id="imagen" iden="'.$b["correlativo"].'">
				      <span class="badge green"><i class="fas fa-image" aria-hidden="true"></i></span>
				      </a></td>
                      <td><a id="xver" op="160" key="'.$b["id"].'" cotizacion="'.$b["correlativo"].'"><i class="fas fa-search fa-lg green-text"></i></a></td>
                    </tr>';
        }
        echo '</tbody>
        </table>';
      }
        $a->close();

  if($total_pages <= (1+($adjacents * 2))) {
    $start = 1;
    $end   = $total_pages;
  } else {
    if(($page - $adjacents) > 1) {  
      if(($page + $adjacents) < $total_pages) {  
        $start = ($page - $adjacents); 
        $end   = ($page + $adjacents); 
      } else {              
        $start = ($total_pages - (1+($adjacents*2))); 
        $end   = $total_pages; 
      }
    } else {
      $start = 1; 
      $end   = (1+($adjacents * 2));
    }
  }
echo $total_rows . " Registros encontrados";
   if($total_pages > 1) { 

$page <= 1 ? $enable = 'disabled' : $enable = '';
    echo '<ul class="pagination pagination-sm justify-content-center">
    <li class="page-item '.$enable.'">
        <a class="page-link" id="paginador" op="'.$op.'" iden="1" orden="'.$orden.'" dir="'.$dir.'">&lt;&lt;</a>
      </li>';
    
    $page>1 ? $pagina = $page-1 : $pagina = 1;
    echo '<li class="page-item '.$enable.'">
        <a class="page-link" id="paginador" op="'.$op.'" iden="'.$pagina.'" orden="'.$orden.'" dir="'.$dir.'">&lt;</a>
      </li>';

    for($i=$start; $i<=$end; $i++) {
      $i == $page ? $pagina =  'active' : $pagina = '';
      echo '<li class="page-item '.$pagina.'">
        <a class="page-link" id="paginador" op="'.$op.'" iden="'.$i.'" orden="'.$orden.'" dir="'.$dir.'">'.$i.'</a>
      </li>';
    }

    $page >= $total_pages ? $enable = 'disabled' : $enable = '';
    $page < $total_pages ? $pagina = ($page+1) : $pagina = $total_pages;
    echo '<li class="page-item '.$enable.'">
        <a class="page-link" id="paginador" op="'.$op.'" iden="'.$pagina.'" orden="'.$orden.'" dir="'.$dir.'">&gt;</a>
      </li>';

    echo '<li class="page-item '.$enable.'">
        <a class="page-link" id="paginador" op="'.$op.'" iden="'.$total_pages.'" orden="'.$orden.'" dir="'.$dir.'">&gt;&gt;</a>
      </li>

      </ul>';
     }  // end pagination 

  } // termina productos









  public function Facturar($cotizacion){
       $db = new dbConn();
       $venta = new Ventas();
       // obtener todo los datos de la cotizacion para pasarla a factura
	    $a = $db->query("SELECT * FROM cotizaciones WHERE cotizacion = '$cotizacion' and td = ".$_SESSION["td"]."");
	    foreach ($a as $b) {
	    	$b["cantidad"] = $b["cant"];
	        
	        $venta->AgregarDesdeCotizacion($b);
	    } $a->close();

   }






   public function addMateriales($data) { //agrega materiales a la cotizacion
	$db = new dbConn();


		if($data['material'] != NULL){
		$datos = array();
		$datos["material"] = $data["material"];
		$datos["precio"] = $data["precio"];
		$datos["cotizacion"] = $_SESSION["cotizacion"];
		$datos["hash"] = Helpers::HashId();
		$datos["time"] = Helpers::TimeId();
		$datos["td"] = $_SESSION["td"];
		$db->insert("cotizaciones_materiales", $datos); 
			$this->VerProducto();
			if ($this->cuentaMateriales() > 0) {
				echo '<hr>'; 
				echo '<hr>'; 
				echo '<h4>Materiales</h4>'; 
				$this->VerMateriales();
		
			  }
	} else {
		Alerts::Alerta("error","Error!","Los campos no pueden estar vacios!");
	}
	
}




public function VerMateriales() { //leva el control del autoincremento de los clientes
	$db = new dbConn();
		
	if($_SESSION["cotizacion"] != NULL){
		
		$a = $db->query("SELECT * FROM cotizaciones_materiales WHERE cotizacion = ".$_SESSION["cotizacion"]." and td = ".$_SESSION["td"]."");

		if($a->num_rows > 0){
				echo '<table class="table table-striped table-sm">
				  <thead>
					<tr>';
					//   echo '<th scope="col" style="width:10px;">Cant</th>';
					  echo '<th scope="col">Material</th>';
					  echo '<th scope="col">Precio</th>';
					  echo '<th scope="col" style="width:10px;">Borrar</th>
					</tr>
				  </thead>
				  <tbody>';
				foreach ($a as $b) {
				   echo '<tr>';
						//   echo '<th scope="row">'.$b["cant"].'</th>';
						  echo '<td>'.$b["material"].'</td>';
						  echo '<td>'.Helpers::Dinero($b["precio"]).'</td>';
						  echo '<td><a id="borrar-material" op="691" hash="'.$b["hash"].'"><i class="fas fa-times-circle red-text fa-lg"></i></a></td>
						</tr>';
				}
					echo '</tbody>
						</table>';
		} $a->close();

	} 
	  
}


public function DelMaterial($hash){
	$db = new dbConn();

  	// borro el registro de ticket
  	Helpers::DeleteId("cotizaciones_materiales", "hash = '$hash' and td = ".$_SESSION["td"]."");
  	// compruebo si hay mas productos sino elimino orden
	  $this->VerProducto();
	  if ($this->cuentaMateriales() > 0) {
		echo '<hr>'; 
		echo '<hr>'; 
		echo '<h4>Materiales</h4>'; 
		$this->VerMateriales();

	  }
   }


   public function DelMateriales(){
	$db = new dbConn();
  	Helpers::DeleteId("cotizaciones_materiales", "cotizacion = ".$_SESSION["cotizacion"]." and td = ".$_SESSION["td"]."");
   }


   public function cuentaMateriales(){
	$db = new dbConn();

	$a = $db->query("SELECT * FROM cotizaciones_materiales WHERE cotizacion = ".$_SESSION["cotizacion"]." and td = ".$_SESSION["td"]."");
	$num = $a->num_rows;
	$a->close();
	return $num;
	
   }

   public function BorrarImagen($img, $src, $cotizacion){ // borrar imagenes del producto
      
	if (Helpers::DeleteId("cotizaciones_images", "imagen='$img' and td=".$_SESSION["td"]."")) {
		 if (file_exists($src. $img)) {
			 unlink($src . $img);
		  Alerts::Alerta("success","Eliminado!","Imagen Eliminada!");   
		 }
		 Alerts::Alerta("danger","Advertencia!","Eliminada del registro!");
	} else {
	  Alerts::Alerta("error","Error!","Ocurrio algo Inesperado!");
	}
}











} // Termina la lcase

?>