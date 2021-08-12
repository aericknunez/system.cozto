<?php 
class Cuentas{

		public function __construct() { 
     	} 



  public function AddCuenta($datos){
    $db = new dbConn();
      if($datos["cuenta"] != NULL and $datos["total"] != NULL){ // comprueba dtos
        
                $data["hash_proveedor"] = $datos["proveedor"];
                $data["nombre"] = strtoupper($datos["cuenta"]);
                $data["detalles"] = $datos["detalles"];
                $data["factura"] = $datos["factura"];
                $data["total"] = $datos["total"];
                $data["fecha"] = date("d-m-Y");
                $data["fechaF"] = Fechas::Format(date("d-m-Y"));
                $data["hora"] = date("H:i:s");
                $data["fecha_limite"] = $datos["fecha_limite_submit"];
                $data["fecha_limiteF"] = Fechas::Format($datos["fecha_limite_submit"]);
                $data["edo"] = 1;
                $data["hash"] = Helpers::HashId();
                $data["time"] = Helpers::TimeId();
                $data["td"] = $_SESSION["td"];
                if ($db->insert("cuentas", $data)) {

                 Alerts::Alerta("success","Realizado!","Registro realizado correctamente!");  

                }
 
        } else {
          Alerts::Alerta("error","Error!","Faltan Datos!");
        }
      $this->VerCuentas(1, "id", "desc");
  }







  public function VerCuentas($npagina, $orden, $dir){
      $db = new dbConn();

  $limit = 12;
  $adjacents = 2;
  if($npagina == NULL) $npagina = 1;
  $a = $db->query("SELECT * FROM cuentas WHERE td = ". $_SESSION['td'] ."");
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

$op="401";

 $a = $db->query("SELECT * FROM cuentas WHERE td = ".$_SESSION["td"]." order by ".$orden." ".$dir." limit $offset, $limit");
      
      if($a->num_rows > 0){
          echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="hash_proveedor" dir="'.$dir2.'">Proveedor</a></th>
            <th class="th-sm d-none d-md-block"><a id="paginador" op="'.$op.'" iden="1" orden="nombre" dir="'.$dir2.'">Nombre</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="fecha_limite" dir="'.$dir2.'">Fecha Limite</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="total" dir="'.$dir2.'">Total</a></th>
            <th class="th-sm">Abonado</th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="edo" dir="'.$dir2.'">Estado</a></th>
            <th class="th-sm">Ver</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
if ($r = $db->select("nombre", "proveedores", "WHERE hash = '".$b["hash_proveedor"]."' and td = ". $_SESSION["td"] ."")) {   $proveedor = $r["nombre"]; } unset($r); 

$abonototal = $this->TotalAbono($b["hash"]);
          echo '<tr>
                      <td>'.$proveedor.'</td>
                      <td class="d-none d-md-block">'.$b["nombre"].'</td>
                      <td>'.$b["fecha_limite"]. '</td>
                      <td>'. Helpers::Dinero($b["total"]).'</td>
                      <td>'. Helpers::Dinero($abonototal) .'</td>
                      <td>'.Helpers::EstadoCredito($b["edo"]) . '</td>
                      <td>';

                      if($b["edo"] != 0){
                        echo '<a id="xver" op="402" cuenta="'. $b["hash"] .'"><i class="fas fa-search fa-lg green-text"></i></a>';
                      } else {
                      echo ' <i class="fa fa-ban fa-lg red-text"></i>';
                      }
                     

                      if($abonototal == 0 and $b["edo"] != 0){
                      echo ' <a id="xdelete" iden="'.$b["hash"].'" op="408"><i class="fa fa-minus-circle fa-lg red-text"></i></a>';
                    } 

                    echo '</td>
                    </tr>';
        }
        echo '</tbody>
        </table>
        </div>';
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

  echo '<div class="font-weight-bold">Total Pendiente : ' . Helpers::Dinero($this->ObtenerTotalTodo() - $this->TotalAbonoTodo()) . '</div><br>';


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




  public function DelCuenta($iden){ // eliminar cuenta
    $db = new dbConn();
          $cambios = array();
          $cambios["edo"] = 0;
      if(Helpers::UpdateId("cuentas", $cambios, "hash='$iden' and td = ".$_SESSION["td"]."")){    
           Alerts::Alerta("success","Eliminado!","Cuenta Eliminado correctamente!");
        } else {
            Alerts::Alerta("error","Error!","Algo Ocurrio!");
        } 
      $this->VerCuentas(1, "id", "desc");
  }









  public function VistaCuenta($hash){
      $db = new dbConn();
      $this->VerCuenta($hash);
 
      $creditos = $this->ObtenerTotal($hash);
      $abonos = $this->TotalAbono($hash);

      echo '<div class="form-group row justify-content-center align-items-center">
        <div class="text-center border border-light mr-5">
         Total Abonado:
          <h1>'.Helpers::Dinero($abonos).'</h1>
        </div>
        <div class="text-center border border-light text-danger mr-5">
         Total Pendiente:
          <h1>'.Helpers::Dinero($creditos - $abonos).'</h1>
        </div>
    </div>';
    
  }


  public function NombreCuenta($hash){ // total del credito
    $db = new dbConn();

        if ($r = $db->select("nombre", "cuentas", "WHERE hash = '".$hash."' and td = ".$_SESSION["td"]."")) { 
            return $r["nombre"];
        }  unset($r);  
    
  }




 
  public function ObtenerTotal($hash){ // total del credito
    $db = new dbConn();

        if ($r = $db->select("total", "cuentas", "WHERE hash = '".$hash."' and td = ".$_SESSION["td"]."")) { 
            return $r["total"];
        }  unset($r);  
    
  }


  public function TotalAbono($hash){ // total abonos
    $db = new dbConn();

    if ($r = $db->select("sum(abono)", "cuentas_abonos", "WHERE cuenta = '$hash' and edo = 1 and td = ".$_SESSION["td"]."")) { 
            return $r["sum(abono)"];
        }  unset($r);  
    
  }




  public function VerCuenta($hash) { //muestra la cuenta
    $db = new dbConn();
        
        $a = $db->query("SELECT * FROM cuentas WHERE hash = '".$hash."' and td = ".$_SESSION["td"]."");

        if($a->num_rows > 0){
            echo '<table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">Cuenta</th>
                <th scope="col">Detalles</th>
                <th scope="col">Factura</th>
                <th scope="col">Total</th>
                <th scope="col">Fecha</th>
                <th scope="col">Ultimo Fecha</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($a as $b) {
            echo '<tr>
                  <td>'.$b["nombre"].'</td>
                  <td>'.$b["detalles"].'</td>
                  <td>'.$b["factura"].'</td>
                  <td>'.$b["total"].'</td>
                  <td>'.$b["fecha"].'</td>
                  <td>'.$b["fecha_limite"].'</td>
                </tr>';
            }
            echo '</tbody>
              </table>';
        } $a->close();

   
  }




public function VerAbonos($cuenta) { //leva el control del autoincremento de los clientes
    $db = new dbConn();
        
        $a = $db->query("SELECT * FROM cuentas_abonos WHERE cuenta = '$cuenta' and edo = 1 and td = ".$_SESSION["td"]." order by id desc");

        if($a->num_rows > 0){

            echo '<table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">Abono</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col">Eliminar</th>
              </tr>
            </thead>
            <tbody>';
            $n = 1;
            foreach ($a as $b) {
            echo '<tr>
                  <td>'.Helpers::Dinero($b["abono"]).'</td>
                  <td>'.$b["fecha"].'</td>
                  <td>'.$b["hora"].'</td>';

                      if($n == 1 and $b["fecha"] == date("d-m-Y")){
                      echo '<td><a id="delabono" hash="'.$b["hash"].'" op="406" cuenta="'.$b["cuenta"].'"><i class="fa fa-minus-circle fa-lg red-text"></i></a></td>';
                    } else {
                      echo '<td><i class="fa fa-ban fa-lg green-text"></i></td>';
                    }
              echo '</tr>';
            $n ++;
            }
              echo '</tbody>
              </table>';
        } else{
          Alerts::Mensajex("A&uacuten no se ha realizado ningun abono","danger",$boton,$boton2);
        } $a->close();

   
  }




  public function AddAbono($datos){
    $db = new dbConn();
      if($datos["cuenta"] != NULL and $datos["abono"] != NULL){ // comprueba dtos
        
        $tot = $this->ObtenerTotal($datos["cuenta"]);
        $abo = $this->TotalAbono($datos["cuenta"]);
        $resultado = Helpers::Format($tot - $abo);
        $abono = Helpers::Format($datos["abono"]);

          if($abono <= $resultado){
                $data["cuenta"] = $datos["cuenta"];
                $data["abono"] = $datos["abono"];
                $data["user"] = $_SESSION["user"];
                $data["fecha"] = date("d-m-Y");
                $data["hora"] = date("H:i:s");
                $data["edo"] = 1;
                $hashabono = Helpers::HashId();
                $data["hash"] = $hashabono;
                $data["time"] = Helpers::TimeId();
                $data["td"] = $_SESSION["td"];
                if ($db->insert("cuentas_abonos", $data)) {

                       Alerts::Alerta("success","Realizado!","Registro realizado correctamente!");  
                      $abo2 = $this->TotalAbono($datos["cuenta"]);
                      $resultado2 = $tot - $abo2;
                     if($resultado2 == 0){
                          $cambio = array();
                          $cambio["edo"] = 2;
                          Helpers::UpdateId("cuentas", $cambio, "hash='".$datos["cuenta"]."' and td = ".$_SESSION["td"].""); 
                     }
                     /////////// agrego a gastos
                     
                $gastox["tipo"] = 2; 
                $gastox["nombre"] = "Abono a cuenta por pagar";
                $gastox["descripcion"] = "ABONO A: " . $this->NombreCuenta($datos["cuenta"]);
                $gastox["cantidad"] = $datos["abono"];
                $gastox["tipo_comprobante"] = 2;
                $gastox["no_factura"] = Helpers::GetData("cuentas","factura","hash",$datos["cuenta"]);
                $gastox["tipo_pago"] = $datos["pago"];
                $gastox["cuenta_banco"] = $datos["banco"];
                $gastox["fecha"] = date("d-m-Y");
                $gastox["fechaF"] = Fechas::Format(date("d-m-Y"));
                $gastox["hora"] = date("H:i:s");
                $gastox["user"] = $_SESSION["user"];
                $gastox["edo"] = 2;
                $gastox["hash"] = Helpers::HashId();
                $gastox["time"] = Helpers::TimeId();
                $gastox["td"] = $_SESSION["td"];
                $db->insert("gastos", $gastox);
               
                $this->UpdateCuentaBancos($datos["abono"], 0, $datos["banco"]);

                     ///


                }
          } else {
            Alerts::Alerta("error","Error!","La cantidad ingresada es mayor al credito!");
          }
        } else {
          Alerts::Alerta("error","Error!","Faltan Datos!");
        }
      $this->VerAbonos($datos["cuenta"]);
  }






  public function DelAbono($hash, $cuenta){ // elimina abono
    $db = new dbConn();
          $cambios = array();
          $cambios["edo"] = 2;
          $cambios["user_del"] = $_SESSION["user"];
          $cambios["hora_del"] = date("H:i:s");
      if(Helpers::UpdateId("cuentas_abonos", $cambios, "hash='$hash' and td = ".$_SESSION["td"]."")){
        
          Alerts::Alerta("success","Eliminado!","Abono Eliminado correctamente!");
          
          $cambio = array();
          $cambio["edo"] = 1;
          Helpers::UpdateId("cuentas", $cambio, "hash='$cuenta' and td = ".$_SESSION["td"].""); 

//// gastos
 
if ($r = $db->select("fecha, abono", "cuentas_abonos", "WHERE hash = '".$hash."' and td = ".$_SESSION["td"]."")) { 
    $fechax = $r["fecha"];
    $abonox = $r["abono"];
}

if ($r = $db->select("hash, cuenta_banco", "gastos", "WHERE edo = 2 and fecha='".$fechax."' and cantidad='".$abonox."' and td = ".$_SESSION["td"]."")) { 
    $gasto_hash = $r["hash"];
    $gasto_cuenta = $r["cuenta_banco"];
}

  $cambio = array();
  $cambio["edo"] = 0;               
  Helpers::UpdateId("gastos", $cambio, "hash='".$gasto_hash."' and td = ".$_SESSION["td"]."");
///
 
 $this->UpdateCuentaBancos($abonox, 1, $gasto_cuenta);

        } else {
            Alerts::Alerta("error","Error!","Algo Ocurrio!");
        } 
      $this->VerAbonos($cuenta);
  }



public function UpdateCuentaBancos($cantidad, $tipo, $cuenta) { // cantidad, tipo descuenta o suma, y a cuenta 
$db = new dbConn();

  $saldo = Helpers::GetData("gastos_cuentas", "saldo", "hash", $cuenta);

    if ($tipo == 1) { // 1 suma, 0 resta
      $cantidadUp = $cantidad + $saldo;
    } else {
      $cantidadUp = $saldo - $cantidad;
    }

      $cambio = array();
      $cambio["saldo"] = $cantidadUp;    
      Helpers::UpdateId("gastos_cuentas", $cambio, "hash='".$cuenta."' and td = ".$_SESSION["td"]."");  
}







public function ObtenerTotalTodo(){ // total del credito
  $db = new dbConn();

      if ($r = $db->select("total", "cuentas", "WHERE edo in (1,2) and td = ".$_SESSION["td"]."")) { 
          return $r["total"];
      }  unset($r);  
  
}


public function TotalAbonoTodo(){ // total abonos
  $db = new dbConn();

  if ($r = $db->select("sum(abono)", "cuentas_abonos", "WHERE edo = 1 and td = ".$_SESSION["td"]."")) { 
          return $r["sum(abono)"];
      }  unset($r);  
  
}










} // Termina la lcase
?>