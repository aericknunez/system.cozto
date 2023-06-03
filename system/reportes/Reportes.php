<?php  

class Reportes{

	public function __construct(){

	}



public function VentasDetallado($inicio, $fin, $type = NULL) {
		$db = new dbConn();
		$primero = Fechas::Format($inicio);
		$segundo = Fechas::Format($fin);

if($primero == $segundo){
	$a = $db->query("SELECT * FROM ticket WHERE fechaF = '$segundo' and edo = 1 and tipo_pago != 8 and td = ".$_SESSION['td']." order by time desc");
} else {
	$a = $db->query("SELECT * FROM ticket WHERE time BETWEEN '$primero' AND '$segundo' and edo = 1 and tipo_pago != 8 and td = ".$_SESSION['td']." order by time desc");
}

   if ($a->num_rows > 0) {

	  echo '<h3 class="h3-responsive">REPORTE DE VENTAS DETALLADO</h3>
	  <div class="table-responsive text-nowrap">
	  <table class="table table-striped table-sm table-bordered">

		<thead>
	     <tr>
	       <th>Fecha</th>					       
	       <th>No Documento</th>
	       <th>Codigo</th>
	       <th>Cantidad</th>
	       <th>Producto</th>
	       <th>Costo U.</th>
	       <th>Costo T.</th>
	       <th>Precio U.</th>
	       <th>Precio T.</th>
	       <th>Descuento</th>
	       <th>Monto Total</th>
	       <th>Margen $</th>
	       <th>Margen %</th>
	     </tr>
	   </thead>
	   <tbody>';

    foreach ($a as $b) {
    	$totalcosto = $b["pc"] * $b["cant"];
    	$total = $b["pv"] * $b["cant"];
    	$ganancia = $b["total"] - $totalcosto;
    	@$porcentaje = ($ganancia / $b["total"])*100;
	echo '<tr>
		   <th>'.$b["fecha"].'</th>					       
		   <th class="text-center">'.$b["num_fac"].'</th>
		   <th>'.$b["cod"].'</th>
		   <th>'.$b["cant"].'</th>
		   <th>'.$b["producto"].'</th>
		   <th>'.$b["pc"].'</th>
		   <th>'.Helpers::Format4D($totalcosto).'</th>
		   <th>'.$b["pv"].'</th>
		   <th>'.$total.'</th>
		   <th>'.$b["descuento"].'</th>
		   <th>'.$b["total"].'</th>
		   <th>'.$ganancia.'</th>
		   <th>'.Helpers::Format($porcentaje).' %</th>
		 </tr>';
    }    

	echo '<tr>
	       <th>Fecha</th>					       
	       <th>No Documento</th>
	       <th>Codigo</th>
	       <th>Cantidad</th>
	       <th>Producto</th>
	       <th>Costo U.</th>
	       <th>Costo T.</th>
	       <th>Precio U.</th>
	       <th>Precio T.</th>
	       <th>Descuento</th>
	       <th>Monto Total</th>
	       <th>Margen $</th>
	       <th>Margen %</th>
		  </tr>';


echo '</tbody>
	</table></div>';


		echo '<div class="text-right"><a href="system/documentos/reporte_detalleventas.php?inicio='.$inicio.'&fin='.$fin.'" >Descargar Excel</a></div>';



  } $a->close();
		

} // termina la funcion









public function VentasAgrupado($inicio, $fin, $type = NULL) {
		$db = new dbConn();
		$primero = Fechas::Format($inicio);
		$segundo = Fechas::Format($fin);


if($primero == $segundo){
$a = $db->query("select cod, sum(cant), sum(total), producto, pv, pc, sum(descuento) FROM ticket WHERE 
	fechaF = '$segundo' and edo = 1 and tipo_pago != 8 and td = ".$_SESSION['td']." 
	GROUP BY cod order by sum(cant) desc");
} else {
$a = $db->query("select cod, sum(cant), sum(total), producto, pv, pc, sum(descuento) FROM ticket WHERE 
	time BETWEEN '$primero' AND '$segundo' and edo = 1 and tipo_pago != 8 and td = ".$_SESSION['td']." 
	GROUP BY cod order by sum(cant) desc");
}


	if($a->num_rows > 0){
		
	echo '<h3 class="h3-responsive">PRODUCTOS VENDIDOS AGRUPADO</h3>';

echo '<div class="table-responsive text-nowrap">
<table class="table table-striped table-sm table-bordered">
		<thead>
	     <tr>
	       <th>Codigo</th>
	       <th>Cantidad</th>
	       <th>Producto</th>
	       <th>Precio U.</th>
	       <th>Precio T.</th>
	       <th>Descuento</th>
	       <th>Total</th>
	     </tr>
	   </thead>

		<tbody>';

	    foreach ($a as $b) {

        $totalcosto = $b["pc"] * $b["cant"];
    	$total = $b["pv"] * $b["sum(cant)"];
    	$ganancia = $b["total"] - $totalcosto;
    	@$porcentaje = ($ganancia / $b["total"])*100;

   echo '<tr>
       <td>'. $b["cod"] . '</td>
       <td class="text-right">'. $b["sum(cant)"] . '</td>
       <td>'. $b["producto"] . '</td>
       <td class="text-right">'. Helpers::Dinero($b["pv"]) . '</td>
       <td class="text-right">'. Helpers::Dinero($total) . '</td>
       <td class="text-right">'. Helpers::Dinero($b["sum(descuento)"]) . '</td>
       <td class="text-right">'. Helpers::Dinero($b["sum(total)"]) . '</td>
     </tr>';
    } 

    $a->close();

		echo '<tr>
		       <th>Codigo</th>
		       <th>Cantidad</th>
		       <th>Producto</th>
		       <th>Precio U.</th>
		       <th>Precio T.</th>
		       <th>Descuento</th>
		       <th>Total</th>
		     </tr>';

	echo '</tbody>
		</table></div>';


		echo '<div class="text-right"><a href="system/documentos/reporte_ventaagrupada.php?inicio='.$inicio.'&fin='.$fin.'" >Descargar Excel</a></div>';
	

	} else {
		Alerts::Mensajex("No se encontraron productos en este rango de fechas","danger",$boton,$boton2);
	}
		

} // termina la funcion















public function GastosDetallado($inicio, $fin, $type = NULL) {
		$db = new dbConn();
		$primero = Fechas::Format($inicio);
		$segundo = Fechas::Format($fin);

if($primero == $segundo){
  $a = $db->query("SELECT * FROM gastos WHERE edo = 1 and fechaF = '$segundo' and td = ".$_SESSION['td']." order by time desc");
} else {
  $a = $db->query("SELECT * FROM gastos WHERE edo = 1 and time BETWEEN '$primero' AND '$segundo' and td = ".$_SESSION['td']." order by time desc");
}


   if ($a->num_rows > 0) {

	  echo '<h3 class="h3-responsive">REPORTE DETALLES DE GASTOS</h3>
	  <div class="table-responsive text-nowrap">
	  <table class="table table-striped table-sm table-bordered">

		<thead>
	     <tr>
	       <th>Fecha</th>
	       <th>Tipo</th>					       
	       <th>No Documento</th>
	       <th>Documento</th>
	       <th>Grupo Gasto</th>
	       <th>Gasto</th>
	       <th>Descripcion</th>
	       <th>Tipo Pago</th>
	       <th>Cuenta</th>
	       <th>Monto</th>
	     </tr>
	   </thead>
	   <tbody>';

    foreach ($a as $b) {
if($b["edo"] != 0){ $total = $total + $b["cantidad"]; $colores='class="text-black font-weight-bold"'; } 
else { $colores='class="text-danger font-weight-light"';}

	echo '<tr '.$colores.'>
		   <th>'.$b["fecha"].'</th>					       
		   <th>'.Helpers::Gasto($b["tipo"]).'</th>
		   <th>'.$b["no_factura"].'</th>
		   <th>'.Helpers::DocumentoPago($b["tipo_comprobante"]).'</th>
		   <th>'.$this->CategoriaGastos($b["categoria"]).'</th>
		   <th>'.$b["nombre"].'</th>
		   <th>'.$b["descripcion"].'</th>
		   <th>'.Helpers::TipoPagoGasto($b["tipo_pago"]).'</th>
		   <th>'.$this->CuentaGastos($b["cuenta_banco"]).'</th>
		   <th>'.Helpers::Dinero($b["cantidad"]).'</th>		  
		 </tr>';
    }    

	echo '<tr>
	       <th>Fecha</th>
	       <th>Tipo</th>					       
	       <th>No Documento</th>
	       <th>Documento</th>
	       <th>Grupo Gasto</th>
	       <th>Gasto</th>
	       <th>Descripcion</th>
	       <th>Tipo Pago</th>
	       <th>Cuenta</th>
	       <th>Monto</th>
		  </tr>';


echo '</tbody>
	</table></div>';


		echo '<div class="text-right"><a href="system/documentos/reporte_detallegastos.php?inicio='.$inicio.'&fin='.$fin.'" >Descargar Excel</a></div>';


  } $a->close();
		

} // termina la funcion






public function CuentaGastos($cuenta) {
		$db = new dbConn();

	if ($r = $db->select("cuenta", "gastos_cuentas", 
		"WHERE hash = '$cuenta' and td = ".$_SESSION['td']."")) { 
	return $r["cuenta"];
	} unset($r);  

}





public function CategoriaGastos($categoria) {
		$db = new dbConn();

	if ($r = $db->select("categoria", "gastos_categorias", 
		"WHERE hash = '$categoria' and td = ".$_SESSION['td']."")) { 
	return $r["categoria"];
	} unset($r);  

}



public function CategoriaProducto($cod) {
		$db = new dbConn();

	if ($r = $db->select("categoria", "producto", 
		"WHERE cod = '$cod' and td = ".$_SESSION['td']."")) { 
	$cat = $r["categoria"];
	} unset($r);  

	if ($r = $db->select("subcategoria", "producto_categoria_sub", 
		"WHERE hash = '$cat' and td = ".$_SESSION['td']."")) { 
	return $r["subcategoria"];
	} unset($r);  

}




public function ClienteProducto($orden) {
		$db = new dbConn();

	if ($r = $db->select("cliente", "ticket_cliente", 
		"WHERE orden = '$orden' and td = ".$_SESSION['td']."")) { 
	$cliente = $r["cliente"];
	} unset($r);  

	if ($r = $db->select("nombre", "clientes", 
		"WHERE hash = '$cliente' and td = ".$_SESSION['td']."")) { 
	return $r["nombre"];
	} unset($r);  

}





public function ProductoIngresado($inicio, $fin, $type = NULL) {
		$db = new dbConn();
		$primero = Fechas::Format($inicio);
		$segundo = Fechas::Format($fin);

if($primero == $segundo){
  $a = $db->query("SELECT * FROM producto_ingresado WHERE fecha_ingreso = '$segundo' and td = ".$_SESSION['td']." order by fecha_ingreso ASC");
} else {
  $a = $db->query("SELECT * FROM producto_ingresado WHERE fecha_ingreso BETWEEN '$primero' AND '$segundo' and td = ".$_SESSION['td']." order by fecha_ingreso ASC");
}


   if ($a->num_rows > 0) {

	  echo '<h3 class="h3-responsive">REPORTE INGRESO DE PRODUCTOS</h3>
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
	       <th>Comentario</th>
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
		   <th>'.$b["comentarios"].'</th>
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
	       <th>Comentario</th>
	       <th>Caduca</th>
	       <th>Usuario</th>
		  </tr>';


echo '</tbody>
	</table></div>';


		echo '<div class="text-right"><a href="system/documentos/reporte_ingresoproductos.php?inicio='.$inicio.'&fin='.$fin.'" >Descargar Excel</a></div>';

  } $a->close();
		

} // termina la funcion




















public function ProductoAveriado($inicio, $fin, $type = NULL) {
	$db = new dbConn();
	$primero = Fechas::Format($inicio);
	$segundo = Fechas::Format($fin);

if($primero == $segundo){
$a = $db->query("SELECT * FROM producto_averias WHERE time = '$segundo' and td = ".$_SESSION['td']." order by time ASC");
} else {
$a = $db->query("SELECT * FROM producto_averias WHERE time BETWEEN '$primero' AND '$segundo' and td = ".$_SESSION['td']." order by time ASC");
}


if ($a->num_rows > 0) {

  echo '<h3 class="h3-responsive">REPORTE DE PRODUCTOS AVERIADOS</h3>
  <div class="table-responsive text-nowrap">
  <table class="table table-striped table-sm table-bordered">

	<thead>
	 <tr>
	   <th>Fecha</th>
	   <th>Producto</th>					       
	   <th>Cantidad</th>
	   <th>Comentario</th>
	   <th>Usuario</th>
	 </tr>
   </thead>
   <tbody>';

foreach ($a as $b) {

echo '<tr class="text-black font-weight-bold">
	   <th>'.$b["fecha"].' - '.$b["hora"].'</th>					       
	   <th>'.$b["producto"]. ' - ' .Helpers::GetData("producto", "descripcion", "cod", $b["producto"]).'</th>
	   <th>'.$b["cant"].'</th>
	   <th>'.$b["comentarios"].'</th>
	   <th>'.Helpers::GetData("login_userdata", "nombre", "user", $b["usuario"]).'</th>  
	 </tr>';
}    

echo '<tr>
		<th>Fecha</th>
		<th>Producto</th>					       
		<th>Cantidad</th>
		<th>Comentario</th>
		<th>Usuario</th>
	  </tr>';


echo '</tbody>
</table></div>';


	echo '<div class="text-right"><a href="system/documentos/reporte_averias.php?inicio='.$inicio.'&fin='.$fin.'" >Descargar Excel</a></div>';

} $a->close();
	

} // termina la funcion



private function CalcularUtilidad($cantidad, $precio_costo, $precio_venta) {
	$utilidad = $precio_venta - $precio_costo;
	$utilidad = $utilidad * $cantidad;
	return $utilidad;

} // termina la funcion

private function ObtenerPrecioVenta($precio_actual, $cod){
	$db = new dbConn();

	if($precio_actual == NULL or $precio_actual == 0){
		if ($r = $db->select("precio", "producto_precio", 
			"WHERE producto = '$cod' and cant = 1 and td = ".$_SESSION['td']."")) { 
		$precio = $r["precio"];
		} unset($r);  
		return $precio;
	}
	return $precio_actual;
}


public function EstadisticaCostos($cod) {
 	$db = new dbConn();
	$a = $db->query("SELECT * FROM producto_ingresado WHERE producto = '$cod' and td = ".$_SESSION['td']." order by time desc");
	if ($a->num_rows > 0) {
	echo '
	<h3 class="h3-responsive">' .Helpers::GetData("producto", "descripcion", "cod", $cod).'</h3>
	<div class="table-responsive text-nowrap">
	<table class="table table-striped table-sm table-bordered">
	  <thead>
	   <tr>
		 <th>Fecha</th>			       
		 <th>Cantidad</th>
		 <th>Existencia</th>
		 <th>Precio Costo</th>
		 <th>Precio Venta</th>
		 <th>Utilidad Unit</th>
		 <th>Porcentaje</th>
		 <th>Usuario</th>
	   </tr>
	 </thead>
	 <tbody>';
  
  foreach ($a as $b) {
  $getPrecioVenta = $this->ObtenerPrecioVenta($b["precio_venta"], $cod);
  $utilidad = $this->CalcularUtilidad($b["cant"], $b["precio_costo"], $getPrecioVenta);
  echo '<tr class="text-black font-weight-bold">
		 <th>'.$b["fecha"].' - '.$b["hora"].'</th>					       
		 <th>'.$b["cant"].'</th>
		 <th>'.$b["existencia"].'</th>
		 <th>'.Helpers::Dinero($b["precio_costo"]).'</th>
		 <th>'.Helpers::Dinero($getPrecioVenta).'</th>
		 <th>'.Helpers::Dinero($getPrecioVenta - $b["precio_costo"]).'</th>
		 <th>'.Helpers::porcentaje($b["precio_costo"], $getPrecioVenta).' %</th>
		 <th>'.Helpers::GetData("login_userdata", "nombre", "user", $b["user"]).'</th>  
	   </tr>';
  }    
  
  echo '<tr>
			<th>Fecha</th>			       
			<th>Cantidad</th>
			<th>Existencia</th>
			<th>Precio Costo</th>
			<th>Precio Venta</th>
			<th>Utilidad Unit</th>
			<th>Porcentaje</th>
			<th>Usuario</th>
		</tr>';
  
  
  echo '</tbody>
  </table></div>';

	} else {
		Alerts::Alerta("error","Error!","No hay datos para mostrar!");
	} $a->close();
}







// termina la clase
 }


?>