<?php  

class Historial{

	public function __construct(){

	}

	public function HistorialDiario($fecha, $type = NULL) {
		$db = new dbConn();

$a = $db->query("select cod, cant, total, producto, pv 
from ticket 
where cod = '9999999' and edo = 1 and fecha = '$fecha' and td = ".$_SESSION['td']." order by cant desc");
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
          where cod != 8888 and cod != 9999999 and edo = 1 and fecha = '$fecha' and td = ".$_SESSION['td']." GROUP BY cod order by sum(cant) desc");

			if($a->num_rows > 0 or $especial){
				
				if($type == NULL){
					echo '<h3 class="h3-responsive">PRODUCTOS VENDIDOS DEL DIA :: '.$fecha.'</h3>';
				} else {
					echo '<h3 class="h3-responsive">PRODUCTOS VENDIDOS</h3>';
				}
				    
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
			

			$ar = $db->query("SELECT sum(cant) FROM ticket where edo = 1 and fecha = '$fecha' and td = ".$_SESSION['td']."");
		    foreach ($ar as $br) {
		     echo "Cantidad de Productos: ". $br["sum(cant)"] . "<br>";
		    } $ar->close();

		    $ag = $db->query("SELECT sum(total) FROM ticket where edo = 1 and fecha = '$fecha' and td = ".$_SESSION['td']."");
		    foreach ($ag as $bg) { $tot = $bg["sum(total)"];
		        echo "Total Vendido: ". Helpers::Dinero($bg["sum(total)"]) . "<br>";
		    } $ag->close();


		     echo "Total Agrupado: ". Helpers::Dinero($tot) . "<br>";

		     echo '<div class="text-right"><a href="system/documentos/ventadiaria.php?fecha='.$fecha.'" >Descargar Excel</a></div>';

			} else {
				Alerts::Mensajex("No se encontraron productos para este dia","danger",$boton,$boton2);
			}
					    
					

	}



	public function HistorialMensual($fechax) {
		$db = new dbConn();

$a = $db->query("select cod, cant, total, producto, pv 
from ticket 
where cod = '9999999' and edo = 1 and fecha like '%$fechax' and td = ".$_SESSION['td']." order by cant desc");
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

$a = $db->query("select cod, sum(cant), sum(total), producto, pv, fecha 
                  from ticket 
                  where cod != 8888 and cod != 9999999 and edo = 1 and fecha like '%$fechax' and td = ".$_SESSION['td']." GROUP BY cod order by sum(cant) desc");
		if($a->num_rows > 0 or $especial){
						echo '<h3 class="h3-responsive">PRODUCTOS VENDIDOS</h3>
						<div class="table-responsive">
				    <table class="table table-striped">

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
			    } $a->close();

			    echo $especial;

			    echo '</tbody>
				</table></div>';

			$ar = $db->query("SELECT sum(cant) FROM ticket where cod != 8888 and edo = 1 and fecha like '%$fechax' and td = ".$_SESSION['td']."");
		    foreach ($ar as $br) {
		     echo "Cantidad de Productos: ". $br["sum(cant)"] . "<br>";
		    } $ar->close();


		    $ag = $db->query("SELECT sum(total) FROM ticket where cod != 8888 and edo = 1 and fecha like '%$fechax' and td = ".$_SESSION['td']."");
		    foreach ($ag as $bg) { $tot = $bg["sum(total)"];
		        echo "Total Vendido: ". Helpers::Dinero($bg["sum(total)"]) . "<br>";
		    } $ag->close();


		     echo '<div class="text-right"><a href="system/documentos/ventamensual.php?fecha='.$fechax.'">Descargar Excel</a></div>';

		} else {
			Alerts::Mensajex("No se encontraron registros de ventas en este mes","danger",$boton,$boton2);
		}		    


	}




	public function HistorialCortes($inicio, $fin, $type = NULL) {
		$db = new dbConn();
		$primero = Fechas::Format($inicio);
		$segundo = Fechas::Format($fin);
					$pro=0;
				//busqueda de usuarios
				$a = $db->query("select * from corte_diario where edo != 1 and fecha_format BETWEEN '$primero' AND '$segundo' and td = ".$_SESSION['td']." order by fecha_format, id asc");

				if($a->num_rows > 0){
					
					if($type == NULL){
					echo '<h3 class="h3-responsive">HISTORIAL DE CORTES</h3>';
					} else {
					echo '<h3 class="h3-responsive">CORTE REALIZADO</h3>';	
					}


				  echo '<div class="table-responsive">
				  <table class="table table-striped">

						<thead>
					     <tr>
					       <th>Fecha</th>
					       <th>Productos</th>					       
					       <th class="d-none d-md-block">Clientes</th>
					       <th>Apertura</th>
					       <th>Efectivo In.</th>
					       <th>V. Efectivo</th>
					       <th>V. '.$_SESSION['root_tarjeta'].'</th>
					       <th>V. Credito</th>
					        <th>Venta Total</th>
					        <th>Gastos</th>
					        <th>Diferencia</th>
					     </tr>
					   </thead>

					   <tbody>';
				$xproductos = 0;	   
				$xclientes = 0;
				$xpropina = 0;
				$xefectivo = 0;
				$xefectivo2 = 0;
				$xtarjeta = 0;
				$xcredito = 0;
				$xtotal = 0;
				$xgastos = 0; 
				$xdiferecia = 0;

				    foreach ($a as $b) {
				
				if($b["edo"] == 2){
				$xproductos=$xproductos+$b["productos"];
				$xclientes=$xclientes+$b["clientes"];
				$cajachica=$cajachica+$b["caja_chica"];
				$xefectivo=$xefectivo+$b["efectivo_ingresado"];
				$xt_efectivo=$xt_efectivo+$b["t_efectivo"];
				$xt_tarjeta=$xt_tarjeta+$b["t_tarjeta"];
				$xt_credito=$xt_credito+$b["t_credito"];
				$xtotal=$xtotal+$b["total"];
				$xgastos=$xgastos+$b["gastos"];
				$xdiferecia=$xdiferecia+$b["diferencia"];
				$colores='class="text-black"';
				} else {
				$colores='class="text-danger"';	
				} 
				  echo '<tr '.$colores.'>
				       <th scope="row"><a id="imprimir_corte" hash="'. $b["hash"] . '">'. $b["fecha"] . '</a></th>
				       <td>'. $b["productos"] . '</td>
				       <td class="d-none d-md-block">'. $b["clientes"] . '</td>
				       <td>'. Helpers::Dinero($b["caja_chica"]) . '</td>
				       <td>'. Helpers::Dinero($b["efectivo_ingresado"]) . '</td>
				       <td>'. Helpers::Dinero($b["t_efectivo"]) . '</td>
				       <td>'. Helpers::Dinero($b["t_tarjeta"]) . '</td>
				       <td>'. Helpers::Dinero($b["t_credito"]) . '</td>
				       <td>'. Helpers::Dinero($b["total"]) . '</td>
				       <td>'. Helpers::Dinero($b["gastos"]) . '</td>
				       <td>'. Helpers::Dinero($b["diferencia"]) . '</td>
				     </tr>';
				unset($colores);
				    }
				   $a->close();

			if($type == NULL){
			echo '<tr class="light-blue lighten-4">
			       <th scope="row">Totales</th>
			       <td>'. $xproductos . '</td>
			       <td class="d-none d-md-block">'. $xclientes . '</td>
			       <td>'. Helpers::Dinero($cajachica) . '</td>
			       <td>'. Helpers::Dinero($xefectivo) . '</td>
			       <td>'. Helpers::Dinero($xt_efectivo) . '</td>
			       <td>'. Helpers::Dinero($xt_tarjeta) . '</td>
			       <td>'. Helpers::Dinero($xcredito) . '</td>
			       <td>'. Helpers::Dinero($xtotal) . '</td>
			       <td>'. Helpers::Dinero($xgastos) . '</td>
			       <td>'. Helpers::Dinero($xdiferecia) . '</td>
			     </tr>';
			 	}

			echo '</tbody>
				</table></div>';
			if($type == NULL){
			echo "Fechas afectadas desde el: ". $inicio ." hasta el ". $fin ." <br>";
			}
			
			} else {
				Alerts::Mensajex("No se encontraron registros de cortes en estas fechas","danger",$boton,$boton2);
			}
					    
					

	}









public function HistorialCortesZ($fechax) {
		$db = new dbConn();

$a = $db->query("SELECT fecha, sum(stotal) as subtotal, sum(imp) as imp, sum(total) as total, count(num_fac) as cantidad FROM ticket WHERE fecha like '%$fechax' and td = ". $_SESSION["td"] ."  GROUP by fecha");

if($a->num_rows > 0){

echo '<h3 class="h3-responsive">RESUMEN MENSUAL</h3>';	

	  echo '<div class="table-responsive">
	  <table class="table table-striped">

			<thead>
		     <tr>
		       <th>Fecha</th>
		       <th>Documentos</th>
		       <th>Sub Total</th>					       
		       <th>Impuesto</th>
		       <th>Total</th>
		       <th>Imprimir</th>
		     </tr>
		   </thead>

		   <tbody>';
foreach ($a as $b) {	
  	echo '<tr>
	       <th scope="row">'. $b["fecha"] . '</th>
	       <td>'. $b["cantidad"] . '</td>
	       <td>'. Helpers::Dinero($b["subtotal"]) . '</td>
	       <td>'. Helpers::Dinero($b["imp"]) . '</td>
	       <td>'. Helpers::Dinero($b["total"]) . '</td>
	       <td><a id="imprimir_cortez" fecha="'. $b["fecha"] . '"><i class="fa fa-print blue-text fa-lg"></i></a></td>
	     </tr>';

}


echo '</tbody>
	</table></div>';

} $a->close();



}









	public function HistorialUtilidades($inicio, $fin, $type = NULL) {
		$db = new dbConn();
		$herramientas = new Herramientas();

		$primero = Fechas::Format($inicio);
		$segundo = Fechas::Format($fin);

    $d = $db->selectGroup("producto, cod", "ticket", "WHERE fechaF BETWEEN '$primero' and '$segundo' and td = ". $_SESSION["td"] ." GROUP BY cod");
    if ($d->num_rows > 0) {

	  echo '<div class="table-responsive">
	  <table class="table table-striped table-sm">

			<thead>
		     <tr>
		       <th>Producto</th>					       
		       <th>Cantidad A</th>
		       <th>Ingresados</th>
		       <th>P Compra</th>
		       <th>C Vendido</th>
		        <th>P Venta</th>
		        <th>V Total</th>
		        <th>Utilidad</th>
		     </tr>
		   </thead>

		   <tbody>';

	    $precioventax = 0;
	    $vtotalx = 0;
	    $utilidadx = 0;

        while($x = $d->fetch_assoc()) {

// cantidad de productos disponibles en este moento    
$cantidad = Helpers::GetData("producto", "cantidad", "cod", $x["cod"]);

// cantidad de productos ingresados y precio costo
if ($r = $db->select("sum(cant) as canti", "producto_ingresado", "WHERE producto = '".$x["cod"]."' and td = ". $_SESSION["td"] ."")) { 
        $ingreso = $r["canti"];
    } unset($r);    


$precio_costo = $herramientas->ObtenerPrecioCosto($x["cod"]);

// productos vendidos
    if ($r = $db->select("sum(cant) as cantid, sum(pv) as prev, sum(total) as tota", "ticket", "WHERE cod = '".$x["cod"]."' and td = ". $_SESSION["td"] ." and edo = 1 and fechaF BETWEEN '$primero' and '$segundo'")) { 
        $vcantidad = $r["cantid"];
        $vpv = $r["prev"];
        $vtotal = $r["tota"];
    } 
    unset($r);


// obtengo el numero de registros
$a = $db->query("SELECT pv FROM ticket WHERE cod = '".$x["cod"]."' and td = ". $_SESSION["td"] ." and fechaF BETWEEN '$primero' and '$segundo'");
$preg = $a->num_rows;
$a->close();
    @$precioventa = $vpv / $preg;

// utilidad
$ut = $precioventa - $precio_costo;
$utilidad = $ut * $vcantidad;


$precioventax = $precioventax + $precioventa;
$vtotalx = $vtotalx + $vtotal;
$utilidadx = $utilidadx + $utilidad;

echo '<tr>
	   <th>'.$x["producto"].'</th>					       
	   <th>'.$cantidad.'</th>
	   <th>'.$ingreso.'</th>
	   <th>'.Helpers::Dinero($precio_costo).'</th>
	   <th>'.$vcantidad.'</th>
	    <th>'.Helpers::Dinero($precioventa).'</th>
	    <th>'.Helpers::Dinero($vtotal).'</th>
	    <th>'.Helpers::Dinero($utilidad).'</th>
	 </tr>';

        }

echo '<tr>
	   <th colspan="5" class="text-right">TOTAL PRODUCTO</th>					       
	    <th>'.Helpers::Dinero($precioventax).'</th>
	    <th>'.Helpers::Dinero($vtotalx).'</th>
	    <th>'.Helpers::Dinero($utilidadx).'</th>
	 </tr>';


	echo '</tbody>
		</table></div>';

    } else {
        Alerts::Mensajex("No se encontraron registros de cortes en estas fechas","danger",$boton,$boton2);
    } $d->close();


	    
					

	}















	public function HistorialGDiario($fecha, $type = NULL) {
		$db = new dbConn();

		$a = $db->query("SELECT * FROM gastos WHERE fecha = '$fecha' and td = ". $_SESSION["td"] ." order by id desc");
	        	$total=0;
	        	if($a->num_rows > 0){

	        if($type == NULL){
	        echo ' <h3 class="h3-responsive">GASTOS DEL DIA : '.$fecha.'</h3>';
	        } else {
	        echo ' <h3 class="h3-responsive">GASTOS DEL DIA</h3>';
	        }

			echo '<div class="table-responsive">
			<table class="table table-sm table-striped">
			  <thead>
			    <tr>
			      <th scope="col">Tipo</th>
			      <th scope="col">Gasto</th>
			      <th scope="col">Descripci&oacuten</th>
			      <th scope="col">Cantidad</th>
			      <th scope="col">Imagen</th>
			    </tr>
			  </thead>
			  <tbody>';
		    foreach ($a as $b) {

		    	if($b["edo"] != 0){
				$total = $total + $b["cantidad"];
				$colores='class="text-black"';
				} else {
				$colores='class="text-danger"';	
				}
		    	echo '<tr '.$colores.'>
			      <th scope="row">'. Helpers::Gasto($b["tipo"]) .'</th>
			      <td>'. $b["nombre"] .'</td>
			      <td>'. $b["descripcion"] .'</td>
			      <td>'. Helpers::Dinero($b["cantidad"]) .'</td>
			      <td>'; 

			    $aw = $db->query("SELECT imagen FROM gastos_images WHERE gasto = ". $b["id"] ." and td = ".$_SESSION["td"]."");
				if($aw->num_rows > 0){
				echo '<a id="xver" iden="'. $b["id"] .'">
					<span class="badge green"><i class="fas fa-image" aria-hidden="true"></i></span>
					</a>';	
				} else {
				echo '<a>
					<span class="badge red"><i class="fas fa-ban" aria-hidden="true"></i></span>
					</a>';	
				}
				$aw->close();
  
			    echo '</td>
			    </tr>';
		    }
		    echo '<tr>
			      <th scope="col"></th>
			      <th scope="col"></th>
			      <th scope="col">Total</th>
			      <th scope="col">'. Helpers::Dinero($total) .'</th>
			      <td></td>
			    </tr>
			    </tbody>
		    </table></div>';
			echo "El numero de registros es: ". $a->num_rows . "<br>";

			$ag = $db->query("SELECT sum(cantidad) FROM gastos where tipo != 5 and edo != 0 and  fecha = '$fecha' and td = ".$_SESSION['td']."");
		    foreach ($ag as $bg) {
		        echo "Efectivo afectado: ". Helpers::Dinero($bg["sum(cantidad)"]) . "<br>";
		    } $ag->close();

		   $as = $db->query("SELECT sum(cantidad) FROM gastos where tipo = 5 and edo != 0 and  fecha = '$fecha' and td = ".$_SESSION['td']."");
		    foreach ($as as $bs) {
		        echo "Cheques y transferencias: ". Helpers::Dinero($bs["sum(cantidad)"]) . "<br>";
		    } $as->close();

		     echo '<div class="text-right"><a href="system/documentos/gastodiario.php?fecha='.$fecha.'">Descargar Excel</a></div>';

			} // num rows
			else {
				Alerts::Mensajex("No se encontraron gastos para este dia","danger",$boton,$boton2);
			}
			$a->close();

			

	}



	public function HistorialGMensual($fechax) {
		$db = new dbConn();

					$a = $db->query("SELECT * FROM gastos WHERE fecha like '%$fechax' and td = ". $_SESSION["td"] ." order by fechaF desc");
	        	$total=0;
	        	if($a->num_rows > 0){
	        echo ' <h3 class="h3-responsive">HISTORIAL DE GASTOS</h3>
				<div class="table-responsive">
				<table class="table table-sm table-striped">
			  <thead>
			    <tr>
			      <th scope="col">Tipo</th>
			      <th scope="col">Fecha</th>
			      <th scope="col">Gasto</th>
			      <th scope="col">Descripci&oacuten</th>
			      <th scope="col">Cantidad</th>
			      <th scope="col">Imagen</th>
			    </tr>
			  </thead>
			  <tbody>';
		    foreach ($a as $b) {
		    	
		    	if($b["edo"] != 0){
				$total = $total + $b["cantidad"];
				$colores='class="text-black"';
				} else {
				$colores='class="text-danger"';	
				}
		    	echo '<tr '.$colores.'>
			      <th scope="row">'. Helpers::Gasto($b["tipo"]) .'</th>
			      <td>'. $b["fecha"] .'</td>
			      <td>'. $b["nombre"] .'</td>
			      <td>'. $b["descripcion"] .'</td>
			      <td>'. Helpers::Dinero($b["cantidad"]) .'</td>
			      <td>'; 

			    $aw = $db->query("SELECT imagen FROM gastos_images WHERE gasto = ". $b["id"] ." and td = ".$_SESSION["td"]."");
				if($aw->num_rows > 0){
				echo '<a id="xver" iden="'. $b["id"] .'">
					<span class="badge green"><i class="fas fa-image" aria-hidden="true"></i></span>
					</a>';	
				} else {
				echo '<a>
					<span class="badge red"><i class="fas fa-ban" aria-hidden="true"></i></span>
					</a>';	
				}
				$aw->close();
					  
			    echo '</td>
			    </tr>';
		    }
		    echo '<tr>
			      <th scope="col"></th>
			      <th scope="col"></th>
			      <th scope="col"></th>
			      <th scope="col">Total</th>
			      <td>'. Helpers::Dinero($total) .'</td>
			    </tr>
			    </tbody>
		    </table></div>';
			echo "El numero de registros es: ". $a->num_rows . "<br>";
			
			$ag = $db->query("SELECT sum(cantidad) FROM gastos where tipo != 5 and edo != 0 and  fecha like '%$fechax' and td = ".$_SESSION['td']."");
		    foreach ($ag as $bg) {
		        echo "Efectivo afectado: ". Helpers::Dinero($bg["sum(cantidad)"]) . "<br>";
		    } $ag->close();

		   $as = $db->query("SELECT sum(cantidad) FROM gastos where tipo = 5 and edo != 0 and  fecha like '%$fechax' and td = ".$_SESSION['td']."");
		    foreach ($as as $bs) {
		        echo "Cheques y transferencias: ". Helpers::Dinero($bs["sum(cantidad)"]) . "<br>";
		    } $as->close();


		     echo '<div class="text-right"><a href="system/documentos/gastomensual.php?fecha='.$fechax.'">Descargar Excel</a></div>';

			} else {
			Alerts::Mensajex("No se encontraron registros de gastos en este mes","danger",$boton,$boton2);
			}
  			$a->close();


	}




//// ver abonos

public function VerAbonos($fecha) { //leva el control del autoincremento de los clientes
    $db = new dbConn();
        
        $a = $db->query("SELECT * FROM creditos_abonos WHERE fecha = '$fecha' and td = ".$_SESSION["td"]." order by id desc");

        if($a->num_rows > 0){
        	echo ' <h3 class="h3-responsive">ABONOS RECIBIDOS</h3>'; 

            echo '<div class="table-responsive">
            <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Abono</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
              </tr>
            </thead>
            <tbody>';
            $n = 1;
            foreach ($a as $b) {
            	if($b["edo"] == 1){
		            echo '<tr>
		                  <th scope="row">'.$b["nombre"].'</th>
		                  <td>'.Helpers::Dinero($b["abono"]).'</td>
		                  <td>'.$b["fecha"].'</td>
		                  <td>'.$b["hora"].'</td>';
		              echo '</tr>';
		            $n ++;
        		} else {
        			echo '<tr class="text-danger">
		                  <th scope="row">'.$b["nombre"].'</th>
		                  <td>'.Helpers::Dinero($b["abono"]).'</td>
		                  <td>'.$b["fecha"].'</td>
		                  <td>'.$b["hora"].'</td>
		                  </tr>';
		            $n ++;
		                
		                if($r = $db->select("nombre", "login_userdata", "WHERE user = '".$b["user_del"]."' and td = ".$_SESSION["td"]."")) { 
					        $nombre = $r["nombre"]; }  unset($r); 

		            echo '<tr class="text-info">
		                  <th colspan="4">Eliminado por: '.$nombre.'</th>
						</tr>';
        		}
            }
              echo '</tbody>
              </table></div>';

			echo "El numero de registros es: ". $a->num_rows . "<br>";
			$a->close();
			$ag = $db->query("SELECT sum(abono) FROM creditos_abonos where edo = 1 and fecha = '$fecha' and td = ".$_SESSION['td']."");
		    foreach ($ag as $bg) {
		        echo "Efectivo abonado: ". Helpers::Dinero($bg["sum(abono)"]) . "<br>";
		    } $ag->close();


        } else {
			Alerts::Mensajex("No se encontraron registros de abonos","danger",$boton,$boton2);
			}


   
  }





////////////////////// descuentos //////////////////////

	public function Descuentos($fecha, $type = NULL) {
		$db = new dbConn();

			$a = $db->query("select cod, cajero, num_fac, cant, total, descuento, producto, pv 
          from ticket 
          where cod != 8888 and edo = 1 and fecha = '$fecha' and descuento != 0 and td = ".$_SESSION['td']."  order by id desc");

			if($a->num_rows > 0){
				
				if($type == NULL){
					echo '<h3 class="h3-responsive">DESCUENTOS OTORGADOS DEL DIA :: '.$fecha.'</h3>';
				} else {
					echo '<h3 class="h3-responsive">DESCUENTOS OTORGADOS</h3>';
				}
				    
				echo '<div class="table-responsive">
				<table class="table table-striped table-sm">
						<thead>
					     <tr>
					       <th>Cant</th>
					       <th>Producto</th>
					       <th>Factura</th>
					       <th>Precio</th>
					       <th>Descuento</th>
					       <th>%</th>
					       <th>Total</th>
					     </tr>
					   </thead>

						<tbody>';

			    foreach ($a as $b) {
		    
		    	$porcentaje = (($b["descuento"] * 100) / ($b["total"] + $b["descuento"]));
			   
			   echo '<tr>
			       <th scope="row">'. $b["cant"] . '</th>
			       <td>'. $b["producto"] . '</td>
			       <td>'. $b["num_fac"] . '</td>
			       <td>'. Helpers::Dinero($b["pv"]) . '</td>
			       <td>'. Helpers::Dinero($b["descuento"]) . '</td>
			       <td>'. Helpers::Format($porcentaje) . '</td>
			       <td>'. Helpers::Dinero($b["total"]) . '</td>
			     </tr>';
			    } 

			    $a->close();

			echo '</tbody>
				</table></div>';
			

			$ar = $db->query("SELECT sum(cant) FROM ticket where edo = 1 and fecha = '$fecha' and descuento != 0 and td = ".$_SESSION['td']."");
		    foreach ($ar as $br) {
		    $cantidades = $br["sum(cant)"];
		     echo "Cantidad de Productos: ". $cantidades . "<br>";
		    } $ar->close();

		    $ag = $db->query("SELECT sum(descuento) FROM ticket where edo = 1 and fecha = '$fecha' and descuento != 0 and td = ".$_SESSION['td']."");
		    foreach ($ag as $bg) { $descuentos = $bg["sum(descuento)"];
		        echo "Total Descuento: ". Helpers::Dinero($descuentos) . "<br>";
		    } $ag->close();

		    $ag = $db->query("SELECT sum(total) FROM ticket where edo = 1 and fecha = '$fecha' and descuento != 0 and td = ".$_SESSION['td']."");
		    foreach ($ag as $bg) { $totales = $bg["sum(total)"];
		    } $ag->close();

		    echo "Total Producto con descuento: ". Helpers::Dinero($totales) . "<br>";

		    $porcentajes = (($descuentos * 100) / ($totales + $descuentos));

		     echo "Total descuento Aproximado: ". Helpers::Format($porcentajes) . " %<br>";
		     echo "NOTA: Estos productos es nada mas un detalle de los productos que tienen descuento, estos productos ya van incluidos en el reporte de productos vendidos<br>";
			} else {
				Alerts::Mensajex("No se encontraron productos para este dia","danger",$boton,$boton2);
			}
					    
					

	}




//// ver abonos de cuentas por pagar

public function VerAbonosCuentas($fecha) { //leva el control del autoincremento de los clientes
    $db = new dbConn();
        
        $a = $db->query("SELECT * FROM cuentas_abonos WHERE fecha = '$fecha' and td = ".$_SESSION["td"]." order by id desc");

        if($a->num_rows > 0){
        	echo ' <h3 class="h3-responsive">ABONOS REALIZADOS DE CUENTAS POR PAGAR</h3>'; 

            echo '<div class="table-responsive">
            <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">Cuenta</th>
                <th scope="col">Abono</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
              </tr>
            </thead>
            <tbody>';
            $n = 1;
            foreach ($a as $b) {

            	if ($r = $db->select("nombre", "cuentas", "WHERE hash = '".$b["cuenta"]."' and td = ". $_SESSION["td"] ."")) {   $nombre = $r["nombre"]; } unset($r); 

            	if($b["edo"] == 1){
		            echo '<tr>
		                  <th scope="row">'.$nombre.'</th>
		                  <td>'.Helpers::Dinero($b["abono"]).'</td>
		                  <td>'.$b["fecha"].'</td>
		                  <td>'.$b["hora"].'</td>';
		              echo '</tr>';
		            $n ++;
        		} else {
        			echo '<tr class="text-danger">
		                  <th scope="row">'.$nombre.'</th>
		                  <td>'.Helpers::Dinero($b["abono"]).'</td>
		                  <td>'.$b["fecha"].'</td>
		                  <td>'.$b["hora"].'</td>
		                  </tr>';
		            $n ++;
		                
		                if($r = $db->select("nombre", "login_userdata", "WHERE user = '".$b["user_del"]."' and td = ".$_SESSION["td"]."")) { 
					        $nombre = $r["nombre"]; }  unset($r); 

		            echo '<tr class="text-info">
		                  <th colspan="4">Eliminado por: '.$nombre.'</th>
						</tr>';
        		}
            }
              echo '</tbody>
              </table></div>';

			echo "El numero de registros es: ". $a->num_rows . "<br>";
			$a->close();
			$ag = $db->query("SELECT sum(abono) FROM cuentas_abonos where edo = 1 and fecha = '$fecha' and td = ".$_SESSION['td']."");
		    foreach ($ag as $bg) {
		        echo "Efectivo abonado: ". Helpers::Dinero($bg["sum(abono)"]) . "<br>";
		    } $ag->close();


        } else {
			Alerts::Mensajex("No se encontraron registros de abonos","danger",$boton,$boton2);
			}


   
  }







	public function ListaVenta($fecha, $type = NULL) {
		$db = new dbConn();

        $a = $db->query("SELECT * FROM ticket WHERE fecha = '$fecha' and td = ".$_SESSION["td"]." order by time desc");

			if($a->num_rows > 0){
				
				if($type == NULL){
					echo '<h3 class="h3-responsive">PRODUCTOS VENDIDOS DEL DIA :: '.$fecha.'</h3>';
				} else {
					echo '<h3 class="h3-responsive">PRODUCTOS VENDIDOS</h3>';
				}
				    
				echo '<div class="table-responsive">
				<table class="table table-striped table-sm">
						<thead>
					     <tr>
					       <th>Cant</th>
					       <th>Producto</th>
					       <th>Factura</th>
					       <th>Fecha</th>
					       <th>Pago</th>
					       <th>Precio</th>
					       <th>Total</th>
					     </tr>
					   </thead>

						<tbody>';

			    foreach ($a as $b) {
		    
			   echo '<tr>
			       <th scope="row">'. $b["cant"] . '</th>
			       <td>'. $b["producto"] . '</td>
			       <td>'. $b["num_fac"] . '</td>
			       <td>'. $b["fecha"] . ' - '. $b["hora"] . '</td>
			       <td>'. Helpers::TipoPago($b["tipo_pago"]) . '</td>
			       <td>'. Helpers::Dinero($b["pv"]) . '</td>
			       <td>'. Helpers::Dinero($b["total"]) . '</td>
			     </tr>';
			    } 

			    $a->close();

			echo '</tbody>
				</table></div>';
			

			$ar = $db->query("SELECT sum(cant) FROM ticket where edo = 1 and fecha = '$fecha' and td = ".$_SESSION['td']."");
		    foreach ($ar as $br) {
		     echo "Cantidad de Productos: ". $br["sum(cant)"] . "<br>";
		    } $ar->close();

		    $ag = $db->query("SELECT sum(total) FROM ticket where edo = 1 and fecha = '$fecha' and td = ".$_SESSION['td']."");
		    foreach ($ag as $bg) { $tot = $bg["sum(total)"];
		        echo "Total Vendido: ". Helpers::Dinero($bg["sum(total)"]) . "<br>";
		    } $ag->close();


		     echo "Total Agrupado: ". Helpers::Dinero($tot) . "<br>";

		     echo '<div class="text-right"><a href="system/documentos/listaventa.php?fecha='.$fecha.'" >Descargar Excel</a></div>';

			} else {
				Alerts::Mensajex("No se encontraron productos para este dia","danger",$boton,$boton2);
			}
					    
					

	}









////////////consolidado diario
	public function ConsolidadoDiario($fecha) {
		$db = new dbConn();

		$this->HistorialCortes($fecha, $fecha, 1);
		echo "<hr>";
		$this->VerAbonos($fecha);
		echo "<hr>";
		$this->VerAbonosCuentas($fecha);
		echo "<hr>";
		$this->HistorialGDiario($fecha, 1);
		echo "<hr>";
		$this->HistorialDiario($fecha, 1);
		echo "<hr>";
		$this->Descuentos($fecha, 1);
		echo "<hr>";
	}
















public function MovimientosProducto($inicio, $fin, $type = NULL) {
		$db = new dbConn();
		$primero = Fechas::Format($inicio);
		$segundo = Fechas::Format($fin);

if($primero == $segundo){
  $a = $db->query("SELECT * FROM producto_ingresado WHERE producto = '".$_SESSION["cod_search"]."' and fechaF = '$segundo' and td = ".$_SESSION['td']." order by time desc");
} else {
  $a = $db->query("SELECT * FROM producto_ingresado WHERE producto = '".$_SESSION["cod_search"]."' and time BETWEEN '$primero' AND '$segundo' and td = ".$_SESSION['td']." order by time desc");
}


   if ($a->num_rows > 0) {

	  echo '<h3 class="h3-responsive">PRODUCTOS INGRESADOS</h3>
	  <div class="table-responsive text-nowrap">
	  <table class="table table-striped table-sm table-bordered">

		<thead>
	     <tr>
	       <th>Fecha</th>
	       <th>Producto</th>					       
	       <th>No Documento</th>
	       <th>Cantidad</th>
	       <th>Precio de Costo</th>
	       <th>Proveedor</th>
	       <th>Caduca</th>
	       <th>Usuario</th>
	     </tr>
	   </thead>
	   <tbody>';

    foreach ($a as $b) {

	echo '<tr class="text-black font-weight-bold">
		   <th>'.$b["fecha"].' - '.$b["hora"].'</th>					       
		   <th>'.$b["producto"]. ' - ' .Helpers::GetData("producto", "descripcion", "cod", $b["producto"]).'</th>
		   <th>'.$b["documento"].'</th>
		   <th>'.$b["cant"].'</th>
		   <th>'.Helpers::Dinero($b["precio_costo"]).'</th>
		   <th>'.Helpers::GetData("proveedores", "nombre", "hash", $b["proveedor"]).'</th>
		   <th>'.$b["caduca"].'</th>
		   <th>'.Helpers::GetData("login_userdata", "nombre", "user", $b["user"]).'</th>  
		 </tr>';
    }    

	echo '<tr>
	       <th>Fecha</th>
	       <th>Producto</th>					       
	       <th>No Documento</th>
	       <th>Cantidad</th>
	       <th>Precio de Costo</th>
	       <th>Proveedor</th>
	       <th>Caduca</th>
	       <th>Usuario</th>
		  </tr>';


echo '</tbody>
	</table></div>';


  } $a->close();
		

} // termina la funcion










	public function ReporteMensual($inicio, $fin) {
		$db = new dbConn();

		$primero = Fechas::Format($inicio);
		$segundo = Fechas::Format($fin);

		Alerts::Mensajex("Imprimir reporte entre las fechas : <strong>" . $inicio . " - " . $fin . " </strong>","info", '<a href="system/documentos/reportemensual.php?inicio='.$inicio.'&fin='.$fin.'" class="btn btn-success btn-sm">Imprimir</a>');

	}




























// termina la clase
 }


?>