<?php 
class VerCotizaciones{


    public function VerCotizacion($cot){
        if ($_SESSION['td'] == 17) {
            $this->IndustriasFF($cot);
        } else {
            $this->general($cot);
        }
    }

    
  public function IndustriasFF($cotizacion){
    $db = new dbConn();

    if ($r = $db->select("cliente, fecha, correlativo, caduca", "cotizaciones_data", "WHERE id = '".$cotizacion."' and td = ". $_SESSION["td"] ."")) { 
        $cliente = $r["cliente"]; 
        $fecha = $r["fecha"]; 
        $correlativo = $r["correlativo"]; 
        $caduca = $r["caduca"]; 
    } unset($r); 
    
    if ($r = $db->select("*", "clientes", "WHERE hash = '".$cliente."' and td = ". $_SESSION["td"] ."")) { 
        $nombre = $r["nombre"];
        $documento = $r["documento"];
        $direccion = $r["direccion"];
        $municipio = $r["municipio"];
        $departamento = $r["departamento"];
         } unset($r); 


   echo '<div class="container-fluid">
   <!-- Encabezado -->
 <div class="row">
   <div class="col-3 text-center"><img src="'.XSERV.'assets/img/logo/FYF.png" width="200px" alt=""></div>
   <div class="col-6 text-center">
       <div class="font-weight-bold mt-3">INDUSTRIAS F & F</div>
       <div class="font-weight-bold"> Servicio de torno</div>
       <div>
       Final E. Mancía, Lote # 35, Bo. Las
       Flores,
       Metapán, Santa Ana
       </div>
       <div>
       TELS.: 7498-5138 / 7866-6426
       </div>
   </div>
   <div class="col-3 text-center">
     <div class="bordeado-x1 border" style="height: 100%;">
       <div class="font-weight-bold mt-3">COTIZACION</div>
       <div>NO. '. str_pad($correlativo, 8, "0", STR_PAD_LEFT) .'</div>
     </div>
   </div>
 </div>
 <!-- Datos generales  -->
 <div class="bordeado-x1 border mt-2">
   <div class="ml-3">
         <div class="row">
           <div class="col-8">
               CLIENTE: '. $nombre .'
           </div>
           <div class="col-4 text-center">
               <div class="font-weight-bold">FECHA</div>';
            //    <div class="row">
            //      <div class="col">DIA</div>
            //      <div class="col">MES</div>
            //      <div class="col">AÑo</div>
            //    </div>
               echo '<div>'.Fechas::FechaEscrita($fecha) .'</div>
           </div>
         </div>
   </div>
   <div class="ml-3">
       DIRECCION: '. $direccion .' '.$municipio.' '.$departamento.'
   </div>
 </div>
 <!-- Contenido de productos  -->
 <table class="table table-sm table-round mt-2">
   <thead>
     <th>CANTIDAD</th>
     <th>DESCRIPCION</th>
     <th>PRECIO</th>
     <th>VENTAS</th>
   </thead>
   <tbody>';

/// productos 10 por todo
$a = $db->query("SELECT * FROM cotizaciones WHERE cotizacion = '".$correlativo."' and td = ".$_SESSION["td"]."");
$cantidadP = $a->num_rows;

$pv = 0; $st=0; $im=0; $to=0;
foreach ($a as $b) {
$pv = $pv + $b["pv"]; 
$st = $st + $b["stotal"]; 
$im = $im + $b["imp"]; 
$to = $to + $b["total"];

echo '<tr>
       <td>'.$b["cant"].'</td>
       <td>'.$b["producto"].'</td>
       <td></td>';
       if ($b["stotal"] == 0) {
        echo '<td></td>';
       } else {
        echo '<td>'.$b["stotal"].'</td>';
       }
echo '</tr>';
    }  
$a->close();

$nNum = 10 - $cantidadP;
for ($i=0; $i < $nNum; $i++) { 
    echo '<tr>
            <td>&nbsp</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>';
}


// Materiales fila
    echo '<tr>
       <td colspan="2" class="text-center font-weight-bold">MATERIALES</td>
       <td></td>
       <td></td>
     </tr>';

// lista de materiales 6 por todo
$a = $db->query("SELECT * FROM cotizaciones_materiales WHERE cotizacion = '".$correlativo."' and td = ".$_SESSION["td"]."");
$cantidadM = $a->num_rows;
foreach ($a as $b) {
     echo '<tr>
       <td></td>
       <td>'.$b["material"].'</td>
       <td></td>
       <td></td>
     </tr>';
    }  
$a->close();


$nNum2 = 6 - $cantidadM;
for ($i=0; $i < $nNum2; $i++) { 
    echo '<tr>
            <td>&nbsp</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>';
}

echo '<tr>
       <td colspan="2" rowspan="5" class="font-weight-bold">SON: '.Dinero::DineroEscrito($to).' </td>
       <td>SUMAS</td>
       <td>'.Helpers::Dinero($st).'</td>
     </tr>
     <tr>
       <td>13% IVA</td>
       <td>'.Helpers::Dinero($im).'</td>
     </tr>
     <tr>
       <td>SUBTOTAL</td>
       <td>'.Helpers::Dinero($to).'</td>
     </tr>
     <tr>
       <td>(-) IVA RET.</td>
       <td></td>
     </tr>
     <tr>
       <td>TOTAL</td>
       <td>'.Helpers::Dinero($to).'</td>
     </tr>
 
 
   </tbody>
 </table>
 
 <!-- // datos finales -->
   <div class="row">
     <div class="col text-center">
       <div class="mt-3">Nombre: ____________________________________</div>
       <div class="mt-3">Firma: _______________________________________</div>
       <div class="text-center">Persona que Recibe</div>
     </div>
     <div class="col text-center">
       <div class="mt-3">Nombre: ____________________________________</div>
       <div class="mt-3">Firma: _______________________________________</div>
       <div class="text-center">Persona que Entrega</div>
     </div>
   </div>
   
 
   
 </div>';
}





    


  public function general($cotizacion){
       $db = new dbConn();
       

if ($r = $db->select("cliente, fecha, correlativo, caduca", "cotizaciones_data", "WHERE id = '".$cotizacion."' and td = ". $_SESSION["td"] ."")) { 
    $cliente = $r["cliente"]; 
    $fecha = $r["fecha"]; 
    $correlativo = $r["correlativo"]; 
    $caduca = $r["caduca"]; 
} unset($r); 

if ($r = $db->select("*", "clientes", "WHERE hash = '".$cliente."' and td = ". $_SESSION["td"] ."")) { 
    $nombre = $r["nombre"];
    $documento = $r["documento"];
    $direccion = $r["direccion"];
    $municipio = $r["municipio"];
    $departamento = $r["departamento"];
     } unset($r); 

echo '<div class="row">
      <div class="col-8">
              <div class="text-center">
              <h3>'. $_SESSION['config_cliente'] .'</h3>
              </div>
              <div><h3>
              Dirección: '. $_SESSION['config_direccion'] .'
              </h3></div>
              <div><h3>
              Teléfono: '. $_SESSION['config_telefono'] .'
              </h3></div>

      </div>

        <div class="col-4 text-right">
        <img alt="" src="'.XSERV.'assets/img/logo/'.$_SESSION['config_imagen'].'" height="200" id="logo-neg" class="img-fluid" />
        </div>
</div>

<hr />';

echo '<div class="row">
      <div class="col-8">
              <div>
              <h4>Cliente: '. $nombre .'</h4>
              </div>
              <div><h4>
              Dirección: '. $direccion .' '.$municipio.' '.$departamento.'
              </h4></div>

      </div>
        <div class="col-4 text-right">
       
       		<div>
              <h4>Creada : '. $fecha .'</h4>
             </div>
			<div>
              <h4>Cotización : '. $correlativo .'</h4>
             </div>
        </div>
	</div>


	<pre>Detalles de la cotización</pre>';

$a = $db->query("SELECT * FROM cotizaciones WHERE cotizacion = '".$correlativo."' and td = ".$_SESSION["td"]."");

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
              </tr>
            </thead>
            <tbody>';
            $pv = 0; $st=0; $im=0; $to=0;
            foreach ($a as $b) {
            $pv = $pv + $b["pv"]; 
            $st = $st + $b["stotal"]; 
            $im = $im + $b["imp"]; 
            $to = $to + $b["total"];
            echo '<tr>
                  <th scope="row">'.$b["cant"].'</th>
                  <td>'.$b["producto"].'</td>
                  <td>'.$b["pv"].'</td>
                  <td>'.$b["stotal"].'</td>
                  <td>'.$b["imp"].'</td>
                  <td>'.$b["total"].'</td>
                </tr>';
            }
            echo '<tr>
                  <td></td>
                  <td>Total</td>
                  <th>'.Helpers::Dinero($pv).'</th>
                  <th>'.Helpers::Dinero($st).'</th>
                  <th>'.Helpers::Dinero($im).'</th>
                  <th>'.Helpers::Dinero($to).'</th>
                </tr>';

            echo '</tbody>
              </table>';
        }  $a->close();
  
echo '<div class="row mt-4">
      <div class="col-12">
              <div>
              <h3> Cotización válida hasta el: '. Fechas::FechaEscrita($caduca) .'</h3>
              </div>
      </div>
</div>';


  }







} // Termina la lcase

?>