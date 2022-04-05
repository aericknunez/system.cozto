<?php 
class Taller{

		public function __construct() { 
     	} 



  public function AddCliente($datos){
    $db = new dbConn();
      if($datos["cliente"] != NULL and $datos["telefono2"] != NULL){ // comprueba dtos
        
                $data["cliente"] = $datos["cliente"];
                $data["dui"] = $datos["dui"];
                $data["direccion"] =  $datos["direccion"];
                $data["departamento"] = $datos["departamento"];
                $data["municipio"] = $datos["municipio"];
                $data["email"] = $datos["email"];
                $data["giro"] = $datos["giro"];
                $data["registro"] = $datos["registro"];
                $data["nit"] = $datos["nit"];
                $data["telefono1"] = $datos["telefono1"];
                $data["telefono2"] = $datos["telefono2"];
                $data["comentarios"] = $datos["comentarios"];
                $data["edo"] = 1;
                $data["hash"] = Helpers::HashId();
                $data["time"] = Helpers::TimeId();
                $data["td"] = $_SESSION["td"];
                if ($db->insert("taller_cliente", $data)) {
                 Alerts::Alerta("success","Realizado!","Registro realizado correctamente!");  

                $datax = array();
                $datax["nombre"] = $data["cliente"];
                $datax["documento"] = $data["nit"];
                $datax["direccion"] = $data["direccion"];
                $datax["departamento"] = $data["departamento"];
                $datax["municipio"] = $data["municipio"];
                $datax["telefono"] = $data["telefono2"];
                $datax["email"] = $data["email"];
                $datax["comentarios"] = $data["comentarios"];
                  $this->AddClientex($datax);
                }
 
        } else {
          Alerts::Alerta("error","Error!","Faltan Datos!");
        }
      $this->VerClientes(1, "id", "desc");
  }




  public function AddClientex($datos){
    $db = new dbConn();

        $datos["nombre"] = strtoupper($datos["nombre"]);
        $datos["hash"] = Helpers::HashId();
        $datos["time"] = Helpers::TimeId();
        $datos["td"] = $_SESSION["td"];
        $db->insert("clientes", $datos);

  }
















  public function VerClientes($npagina, $orden, $dir){
      $db = new dbConn();

  $limit = 12;
  $adjacents = 2;
  if($npagina == NULL) $npagina = 1;
  $a = $db->query("SELECT * FROM taller_cliente WHERE td = ". $_SESSION['td'] ."");
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

$op="601";

 $a = $db->query("SELECT * FROM taller_cliente WHERE td = ".$_SESSION["td"]." order by ".$orden." ".$dir." limit $offset, $limit");
      
      if($a->num_rows > 0){
          echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="cliente" dir="'.$dir2.'">Cliente</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="direccion" dir="'.$dir2.'">Dirección</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="telefono" dir="'.$dir2.'">Teléfono</a></th>
            <th class="th-sm">Ver</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto


          echo '<tr>
                      <td >'.$b["cliente"].'</td>
                      <td>'.$b["direccion"]. '</td>
                      <td>'.$b["telefono1"]. '</td>
                      <td><a id="detalles" op="620" key="'.$b["hash"].'" ref="cliente"><i class="green-text fas fa-plus-circle fa-lg"></i></a></td>
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




  // public function DelCliente($iden){ // eliminar cuenta
  //   $db = new dbConn();
  //         $cambios = array();
  //         $cambios["edo"] = 0;
  //     if(Helpers::UpdateId("cuentas", $cambios, "hash='$iden' and td = ".$_SESSION["td"]."")){    
  //          Alerts::Alerta("success","Eliminado!","Cuenta Eliminado correctamente!");
  //       } else {
  //           Alerts::Alerta("error","Error!","Algo Ocurrio!");
  //       } 
  //     $this->VerCuentas(1, "id", "desc");
  // }












  public function AddVehiculo($datos){
    $db = new dbConn();
      if($datos["cliente"] != NULL and $datos["placa"] != NULL){ // comprueba dtos
        
                $data["cliente"] = $datos["cliente"];
                $data["placa"] =  $datos["placa"];
                $data["marca"] = $datos["marca"];
                $data["ano"] = $datos["ano"];
                $data["modelo"] = $datos["modelo"];
                $data["clase"] = $datos["clase"];
                $data["tipo"] = $datos["tipo"];
                $data["color"] = $datos["color"];
                $data["chasis_gravado"] = $datos["chasis_gravado"];
                $data["chasis_vin"] = $datos["chasis_vin"];
                $data["no_motor"] = $datos["no_motor"];
                $data["detalles"] = $datos["detalles"];
                $data["edo"] = 1;
                $data["hash"] = Helpers::HashId();
                $data["time"] = Helpers::TimeId();
                $data["td"] = $_SESSION["td"];
                if ($db->insert("taller_vehiculo", $data)) {

                 Alerts::Alerta("success","Realizado!","Registro realizado correctamente!");  

                }
 
        } else {
          Alerts::Alerta("error","Error!","Faltan Datos!");
        }
      $this->VerVehiculos(1, "id", "desc");
  }








  public function VerVehiculos($npagina, $orden, $dir){
      $db = new dbConn();

  $limit = 12;
  $adjacents = 2;
  if($npagina == NULL) $npagina = 1;
  $a = $db->query("SELECT * FROM taller_vehiculo WHERE td = ". $_SESSION['td'] ."");
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

$op="603";

 $a = $db->query("SELECT * FROM taller_vehiculo WHERE td = ".$_SESSION["td"]." order by ".$orden." ".$dir." limit $offset, $limit");
      
      if($a->num_rows > 0){
          echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="cliente" dir="'.$dir2.'">Cliente</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="placa" dir="'.$dir2.'">Placa</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="marca" dir="'.$dir2.'">Marca</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="ano" dir="'.$dir2.'">Año</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="color" dir="'.$dir2.'">Color</a></th>
            <th class="th-sm">Ver</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto


          echo '<tr>
                      <td >'.Helpers::GetData("taller_cliente", "cliente", "hash", $b["cliente"]).'</td>
                      <td>'.$b["placa"]. '</td>
                      <td>'.Helpers::GetData("autoparts_marca", "marca", "hash", $b["marca"]). '</td>
                      <td>'.$b["ano"]. '</td>
                      <td>'.$b["color"]. '</td>
                      <td><a id="detalles" op="621" key="'.$b["hash"].'" ref="vehiculo"><i class="green-text fas fa-plus-circle fa-lg"></i></a></td>
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



  public function DatosCliente($hash){
    $db = new dbConn();
    
    if ($r = $db->select("cliente, direccion, municipio, departamento, telefono1, telefono2", "taller_cliente", "WHERE hash = '$hash' and td = ". $_SESSION['td'] ."")) { 
        $cliente = $r["cliente"];
        $direccion = $r["direccion"];
        $municipio = $r["municipio"];
        $departamento = $r["departamento"];
        $telefono1 = $r["telefono1"];
        $telefono2 = $r["telefono2"];
    } unset($r);  

    echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">'.  $cliente .'</h4>
            <p>'. $direccion .', '. $municipio .', '. $departamento .' - '.$telefono1.' - '.$telefono2.'</p>
          </div>';  
  }






  public function ModeloVehiculo($hash){
    $db = new dbConn();

    $a = $db->query("SELECT modelo, hash FROM autoparts_modelo WHERE marca = '$hash' and td = ". $_SESSION['td'] ."");

echo '<option selected disabled>Modelo</option>'; 
    foreach ($a as $b) {
        echo '<option value="'. $b["hash"] .'">'. $b["modelo"] .'</option>'; 
    } $a->close();
 
  }









  public function AddMantenimiento($datos){
    $db = new dbConn();
      if($datos["vehiculo"] != NULL and $datos["millaje"] != NULL){ // comprueba dtos
        
                $data["vehiculo"] = $datos["vehiculo"];
                $data["millaje"] =  $datos["millaje"];
                $data["fecha_ingreso"] = date("d-m-Y");
                $data["fecha_ingresoF"] = Fechas::Format(date("d-m-Y"));
                $data["hora_ingreso"] = date("H:i:s");
                $data["motivo"] =  $datos["motivo"];
                $data["edo"] = 1;
                $data["hash"] = Helpers::HashId();
                $data["time"] = Helpers::TimeId();
                $data["td"] = $_SESSION["td"];
                if ($db->insert("taller_mantenimiento", $data)) {

                 Alerts::Alerta("success","Realizado!","Registro realizado correctamente!");  

                }
 
        } else {
          Alerts::Alerta("error","Error!","Faltan Datos!");
        }
      $this->VerMantenimiento(1, "id", "desc");
  }






  public function VerMantenimiento($npagina, $orden, $dir){
      $db = new dbConn();

  $limit = 12;
  $adjacents = 2;
  if($npagina == NULL) $npagina = 1;
  $a = $db->query("SELECT * FROM taller_mantenimiento WHERE td = ". $_SESSION['td'] ."");
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

$op="607";

 $a = $db->query("SELECT * FROM taller_mantenimiento WHERE td = ".$_SESSION["td"]." order by ".$orden." ".$dir." limit $offset, $limit");
      
      if($a->num_rows > 0){
          echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="cliente" dir="'.$dir2.'">Cliente</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="placa" dir="'.$dir2.'">Vehiculo</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="vehiculo" dir="'.$dir2.'">Placa</a></th>
            <th class="th-sm"><a id="paginador" op="'.$op.'" iden="1" orden="edo" dir="'.$dir2.'">Estado</a></th>
            <th class="th-sm">Ver</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto

    if ($r = $db->select("*", "taller_vehiculo", "WHERE hash = '".$b["vehiculo"]."' and td = ". $_SESSION['td'] ."")) { 
        $cliente = $r["cliente"];
        $marca = $r["marca"];
        $modelo = $r["modelo"];
        $color = $r["color"];
        $placa = $r["placa"];
    } unset($r); 

if($b["edo"] == 3){
  $edo = $this->EdoTaller($b["edo"]);
}
if($b["edo"] == 2){
   $edo = '<a id="cestado" hash="'.$b["hash"].'"> '. $this->EdoTaller($b["edo"]). ' </a>';
}
if($b["edo"] == 1){
  $edo = '<a id="estado" edo="'.$b["edo"].'" hash="'.$b["hash"].'"> '. $this->EdoTaller($b["edo"]). ' </a>';
}

          echo '<tr>
                      <td >'.Helpers::GetData("taller_cliente", "cliente", "hash", $cliente).'</td>
                      <td>'.Helpers::GetData("autoparts_marca", "marca", "hash", $marca) .' - '.  Helpers::GetData("autoparts_modelo", "modelo", "hash", $modelo). ' - '.$color. '</td>
                      <td>'.$placa. '</td>
                      <td>'.$edo.'</td>
                      <td><a id="xver" op="609" hash="'.$b["hash"].'"><i class="text-success fas fa-edit fa-lg"></i></a></td>
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





  public function DatosVehiculo($hash){
    $db = new dbConn();

    if ($r = $db->select("*", "taller_vehiculo", "WHERE hash = '$hash' and td = ". $_SESSION['td'] ."")) { 
        $cliente = $r["cliente"];
        $marca = $r["marca"];
        $modelo = $r["modelo"];
        $color = $r["color"];
        $ano = $r["ano"];
        $chasis_gravado = $r["chasis_gravado"];
        $chasis_vin = $r["chasis_vin"];
        $no_motor = $r["no_motor"];
    } unset($r); 


    if ($r = $db->select("cliente, direccion, municipio, departamento, telefono1, telefono2", "taller_cliente", "WHERE hash = '$cliente' and td = ". $_SESSION['td'] ."")) { 
        $cliente = $r["cliente"];
        $direccion = $r["direccion"];
        $municipio = $r["municipio"];
        $departamento = $r["departamento"];
        $telefono1 = $r["telefono1"];
        $telefono2 = $r["telefono2"];
    } unset($r);  

    echo '<div class="alert alert-info" role="alert">
            <h4 class="alert-heading">'.  $cliente .'</h4>
            <p>'. $direccion .', '. $municipio .', '. $departamento .' - '.$telefono1.' - '.$telefono2.'</p>
          </div>';  
 

     echo '<div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">'.  Helpers::GetData("autoparts_marca", "marca", "hash", $marca) .' -> '.  Helpers::GetData("autoparts_modelo", "modelo", "hash", $modelo) .' -> '.  $color .' -> '.  $ano .'</h4>
            <p>Chasis Gravado: <strong>'. $chasis_gravado .'</strong>, Chasis Vin: <strong>'. $chasis_vin .'</strong>, No. Motor: <strong>'. $no_motor .'</strong></p>
          </div>';  

  }






    public function EdoTaller($string) {
    if($string == "0") return '<div class="text-danger font-weight-bold">Suspendido</div>';
    if($string == "1") return '<div class="text-secondary font-weight-bold">Activo</div>';
    if($string == "2") return '<div class="text-success font-weight-bold">En Reparación</div>';
    if($string == "3") return '<div class="text-primary font-weight-bold">Terminado</div>';
    }



  public function DetallesMantenimiento($hash){
    $db = new dbConn();

    if ($r = $db->select("*", "taller_mantenimiento", "WHERE hash = '$hash' and td = ". $_SESSION['td'] ."")) { 
        $vehiculo = $r["vehiculo"];
        $millaje = $r["millaje"];
        $fecha_ingreso = $r["fecha_ingreso"];
        $hora_ingreso = $r["hora_ingreso"];
        $motivo = $r["motivo"];
        $diagnostico = $r["diagnostico"];
        $reparacion = $r["reparacion"];
        $fecha_salida = $r["fecha_salida"];
        $hora_salida = $r["hora_salida"];
        $edo = $r["edo"];
    } unset($r); 

    if ($r = $db->select("*", "taller_vehiculo", "WHERE hash = '$vehiculo' and td = ". $_SESSION['td'] ."")) { 
        $cliente = $r["cliente"];
        $marca = $r["marca"];
        $modelo = $r["modelo"];
        $color = $r["color"];
        $ano = $r["ano"];
        $chasis_gravado = $r["chasis_gravado"];
        $chasis_vin = $r["chasis_vin"];
        $no_motor = $r["no_motor"];
    } unset($r); 


    if ($r = $db->select("cliente, direccion, municipio, departamento, telefono1, telefono2", "taller_cliente", "WHERE hash = '$cliente' and td = ". $_SESSION['td'] ."")) { 
        $cliente = $r["cliente"];
        $direccion = $r["direccion"];
        $municipio = $r["municipio"];
        $departamento = $r["departamento"];
        $telefono1 = $r["telefono1"];
        $telefono2 = $r["telefono2"];
    } unset($r);  

    echo '<div class="alert alert-info" role="alert">
            <h4 class="alert-heading">'.  $cliente .'</h4>
            <p>'. $direccion .', '. $municipio .', '. $departamento .' - '.$telefono1.' - '.$telefono2.'</p>
          </div>';  
 

     echo '<div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">'.  Helpers::GetData("autoparts_marca", "marca", "hash", $marca) .' -> '.  Helpers::GetData("autoparts_modelo", "modelo", "hash", $modelo) .' -> '.  $color .' -> '.  $ano .'</h4>
            <p>Chasis Gravado: <strong>'. $chasis_gravado .'</strong>, Chasis Vin: <strong>'. $chasis_vin .'</strong>, No. Motor: <strong>'. $no_motor .'</strong></p>
          </div>';  
 
    echo '<div class="card border-info">
          <h5 class="card-title ml-2 mt-2">MILLAJE: '.$millaje.'</h5>
            <div class="mt-0 mb-2 ml-2 font-weight-bolder">
                Fecha de ingreso: '.Fechas::FechaEscrita($fecha_ingreso).' - '.$hora_ingreso.'
            </div>
        </div>';      

if($motivo != NULL){
    echo '<div class="card mt-3">
        <div class="row">
          <div class="col">
          <h5 class="card-title ml-2 mt-2">MOTIVO DE INGRESO</h5>
          <div class="card-text mt-0 mb-2 ml-2">'.$motivo.'</div>
          </div>

          <div class="col mr-2">';

          if ($edo != 3) {
           echo '<a id="edit" tipo="1" hash="'.$hash.'" class="close">
           <i class="fas fa-edit fa-sm"></i>
          </a>';
          }
          
          echo '</div>
        </div>

        </div>';  
} else {
  echo '<a id="edit" tipo="1" hash="'.$hash.'" class="btn btn-primary btn-rounded btn-sm">Agregar Motivo</a>';
}
 
   
if($diagnostico != NULL){
    echo '<div class="card mt-3">
        <div class="row">
          <div class="col">
          <h5 class="card-title ml-2 mt-2">DIAGNOSTICO</h5>
          <div class="card-text mt-0 mb-2 ml-2">'.$diagnostico.'</div>
          </div>

          <div class="col mr-2">';

          if ($edo != 3) {
           echo '<a id="edit" tipo="2" hash="'.$hash.'" class="close">
           <i class="fas fa-edit fa-sm"></i>
          </a>';
          }
          
          echo '</div>
        </div>

        </div>';   
} else {
   echo '<a id="edit" tipo="2" hash="'.$hash.'" class="btn btn-primary btn-rounded btn-sm">Agregar Diagnostico</a>';
}
 


if($reparacion != NULL){
    echo '<div class="card mt-3">
        <div class="row">
          <div class="col">
          <h5 class="card-title ml-2 mt-2">REPARACION</h5>
          <div class="card-text mt-0 mb-2 ml-2">'.$reparacion.'</div>
          </div>

          <div class="col mr-2">';

          if ($edo != 3) {
           echo '<a id="edit" tipo="3" hash="'.$hash.'"accordion class="close">
           <i class="fas fa-edit fa-sm"></i>
          </a>';
          }
          
          echo '</div>
        </div>

        </div>';   
} else {
   echo '<a id="edit" tipo="3" hash="'.$hash.'" class="btn btn-primary btn-rounded btn-sm">Agregar Reparación</a>';
}
 


echo  '<div class="mt-2">Estado: '.$this->EdoTaller($edo).'</div>';


  }





  public function EditarOp($datos){
    $db = new dbConn();
      if($datos["hash"] != NULL and $datos["texto"] != NULL){ // comprueba dtos
        
        if($datos["tipo"] == 1) $tipo = "motivo";
        if($datos["tipo"] == 2) $tipo = "diagnostico";
        if($datos["tipo"] == 3) $tipo = "reparacion";

        $cambio = array();
        $cambio[$tipo] = $datos["texto"];
          if (Helpers::UpdateId("taller_mantenimiento", $cambio, "hash = '".$datos["hash"]."' and td = ".$_SESSION["td"]."")) {

           Alerts::Alerta("success","Realizado!","Registro actualizado correctamente!");  

          }
 
        } else {
          Alerts::Alerta("error","Error!","Faltan Datos!");
        }
      $this->DetallesMantenimiento($datos["hash"]);
  }




  public function TextoOp($datos){
    $db = new dbConn();

        if($datos["tipo"] == 1) $tipo = "motivo";
        if($datos["tipo"] == 2) $tipo = "diagnostico";
        if($datos["tipo"] == 3) $tipo = "reparacion";

        echo Helpers::GetData("taller_mantenimiento", $tipo, "hash", $datos["hash"]);

  }


  public function CambiarEdo($datos){
    $db = new dbConn();

if($datos["edo"] == 0){
    Alerts::Alerta("error","Antención!","no se puede cambiar el estado!");
} else {
    $cambio = array();
    $cambio["edo"] = $datos["edo"] + 1;
      if(Helpers::UpdateId("taller_mantenimiento", $cambio, "hash = '".$datos["hash"]."' and td = ".$_SESSION["td"]."")) {
        Alerts::Alerta("success","Realizado!","Registro actualizado correctamente!");  
    }

}

    $this->VerMantenimiento(1, "id", "desc");
  }
















  public function ClienteBusqueda($dato){ // Busqueda para cliente
    $db = new dbConn();

          $a = $db->query("SELECT * FROM taller_cliente WHERE (cliente like '%".$dato["keyword"]."%' or nit like '%".$dato["keyword"]."%') and td = ".$_SESSION["td"]." limit 10");
           if($a->num_rows > 0){
            echo '<table class="table table-sm table-hover">';
    foreach ($a as $b) {
               echo '<tr>
                      <td scope="row"><a id="select-cli" hash="'. $b["hash"] .'" nombre="'. $b["cliente"] .'"><div>'. $b["cliente"] .'   ||   '. $b["nit"].'</div></a></td>
                    </tr>'; 
    }  $a->close();

        echo '
        </table>';
          } else {
            echo "El criterio de busqueda no corresponde a un cliente";
          }
  }



  public function AgregaCliente($dato){ // agrega  cliente
    $db = new dbConn();

    $_SESSION["cliente_cli"] = $dato["hash"];
    $_SESSION["cliente_asig"] = $dato["nombre"];
 
     $_SESSION["factura_cliente"] = $dato["nombre"];
     $_SESSION["factura_documento"] = Helpers::GetData("taller_cliente", "nit", "hash", $dato["hash"]);   

      $this->AddClienteFactura(); /// agrega el registro


      $texto = 'Cliente asignado para la Factura: ' . $_SESSION['cliente_asig']. ".";
    Alerts::Mensajex($texto,"danger",'<a id="quitar-clienteA" op="619" class="btn btn-danger btn-rounded">Quitar Cliente</a>',$boton2);


      $cambio = array();
      $cambio["nombre"] = $_SESSION["cliente_asig"];
      Helpers::UpdateId("ticket_orden", $cambio, "correlativo = '".$_SESSION["orden"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");   



/// si hay solo un vehiculo asignado a ese cliente se crea la variable automaticamente
/// sino se da a elegir a que vehiculo le asiganara la factura
$a = $db->query("SELECT * FROM taller_vehiculo WHERE cliente = '".$dato["hash"]."' and td = ".$_SESSION["td"]."");
$veh = $a->num_rows;
$a->close();

  if($veh == 0){
  unset($_SESSION["vehiculo_factura"]);
  } 
  elseif($veh == 1){
  $_SESSION["vehiculo_factura"] = Helpers::GetData("taller_vehiculo", "hash", "cliente", $dato["hash"]);
  }

  $this->VerVehiculoAsigando();

}

  public function VerVehiculoAsigando(){

    if ($_SESSION["cliente_cli"]) {

        if ($_SESSION["vehiculo_factura"]) {
          echo 'Se asigno el vehiculo: ' . $_SESSION["vehiculo_factura"];
          echo '<a id="select-vehiculo" hash="'.$_SESSION["cliente_cli"].'"> Cambiar</a>';

        } else {
          echo '<a id="select-vehiculo" hash="'.$_SESSION["cliente_cli"].'">Seleccione Un vehiculo</a>';
        }
    }
  }



  public function SelectVehiculo($data){
    $db = new dbConn();
    $a = $db->query("SELECT * FROM taller_vehiculo WHERE cliente = '".$data["hash"]."' and td = ".$_SESSION["td"]."");
      echo '<ul class="list-group">';
    foreach ($a as $b) {
        echo '<li class="list-group-item"><a id="add-vehiculo-client" hash="'.$b['placa'].'">Placa: '.$b['placa'].' - Tipo: '.$b['tipo'].'</a></li>';
        // print_r($b);
    }  

      echo '</ul>';
    $a->close();
  }




  public function SeleccionarVehiculo($data){
    unset($_SESSION["vehiculo_factura"]);
    $_SESSION["vehiculo_factura"] = $data["hash"];
    $this->VerVehiculoAsigando();
  }



  public function AddClienteFactura(){
    $db = new dbConn();

      $datos = array();
        $datos["factura"] = NULL;
        $datos["orden"] = $_SESSION["orden"];
        $datos["tx"] = $_SESSION["tx"];
        $datos["cliente"] = $_SESSION["cliente_cli"];
        $datos["fecha"] = date("d-m-Y");
        $datos["hora"] = date("H:i:s");
        $datos["hash"] = Helpers::HashId();
        $datos["time"] = Helpers::TimeId();
        $datos["td"] = $_SESSION["td"];
        $db->insert("ticket_cliente", $datos); 
  }


  public function DelClienteFactura(){
    $db = new dbConn();

    Helpers::DeleteId("ticket_cliente", "orden = ".$_SESSION["orden"]." and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
    $this->UnsetCliente();

      $cambio = array();
      $cambio["nombre"] = NULL;
      Helpers::UpdateId("ticket_orden", $cambio, "correlativo = '".$_SESSION["orden"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");  
  }

  public function UnsetCliente(){
      if(isset($_SESSION["cliente_cli"])) unset($_SESSION["cliente_cli"]);
      if(isset($_SESSION["cliente_asig"])) unset($_SESSION["cliente_asig"]);  

      unset($_SESSION["factura_cliente"]);
      unset($_SESSION["factura_documento"]); 

      unset($_SESSION["vehiculo_factura"]); 
  }










  public function VistaCliente($data){
      $db = new dbConn();
     if ($r = $db->select("*", "taller_cliente", "WHERE hash = '".$data["key"]."' and td = ".$_SESSION["td"]."")) { 


echo '<blockquote class="blockquote bq-primary">
  <p class="bq-title" mb-0>'.$r["cliente"].'</p>
</blockquote>';

echo '  <p  class="mt-1">NIT: <strong>'.$r["nit"].'</strong> </p>';
echo '  <p  class="mt-1">Tel&eacutefono: <strong>'.$r["telefono1"].'  |  '.$r["telefono2"].'</strong> </p>';
// echo '  <p  class="mt-1">Fecha de Nacimiento: <strong>'.Fechas::FechaEscrita($r["nacimiento"]).'</strong> </p>';

              echo '<table class="table table-hover">
                <tbody>
                  <tr>
                    <th colspan="2">Direcci&oacuten: '.$r["direccion"].'</th>
                  </tr>
                  <tr>
                    <td>Departamento: '.$r["departamento"].'</td>
                    <td>Municipio: '.$r["municipio"].'</td>
                  </tr>
                  <tr>
                    <td>Email: '.$r["email"].'</td>
                    <td>Comentarios: '.$r["comentarios"].'</td>
                  </tr>
                </tbody>
              </table>'; 

        }  unset($r); 



   $a = $db->query("SELECT * FROM ticket_cliente WHERE cliente = '".$data["key"]."' and td = ".$_SESSION["td"]."");
    $cf = $a->num_rows;  // numero de facturas
    $a->close();

   $a = $db->query("SELECT * FROM creditos WHERE hash_cliente = '".$data["key"]."' and td = ".$_SESSION["td"]."");
    $cas = $a->num_rows; // numero de creditos
    $a->close();




echo '<div class="card-group">
    <!--Panel-->
    <div class="card ml-3 mr-2">
        <div class="card-body text-center">
            <h5 class="card-title">Facturas Registradas</h5>
            <h1 class="display-1">'. $cf .'</h1>
        </div>
        <div class="card-footer">
            <small class="text-muted"><a href="?cliente_facturas&key='.$data["key"].'">Ver todas las facturas</a></small>
        </div>
    </div>
    <!--/.Panel-->

    <!--Panel-->
    <div class="card ml-2 mr-3">
        <div class="card-body text-center">
            <h5 class="card-title">Creditos Otorgados</h5>
            <h1 class="display-1">'. $cas .'</h1>
        </div>
        <div class="card-footer">
            <small class="text-muted"><a href="?creditosvercliente&key='.$data["key"].'">Ver los creditos</a></small>
        </div>
    </div>
    <!--/.Panel-->

</div>';




  }





  public function VistaVehiculo($data){
      $db = new dbConn();


if ($r = $db->select("*", "taller_vehiculo", "WHERE hash = '".$data["key"]."' and td = ". $_SESSION['td'] ."")) { 
$cliente = $r["cliente"];
$marca = $r["marca"];
$modelo = $r["modelo"];
$color = $r["color"];
$ano = $r["ano"];
$chasis_gravado = $r["chasis_gravado"];
$chasis_vin = $r["chasis_vin"];
$no_motor = $r["no_motor"];
$v_hash = $r["hash"];
} unset($r); 



$this->DatosCliente($cliente);



echo '<div class="alert alert-danger" role="alert">
<h4 class="alert-heading">'.  Helpers::GetData("autoparts_marca", "marca", "hash", $marca) .' | '.  Helpers::GetData("autoparts_modelo", "modelo", "hash", $modelo) .' | '.  $color .' | '.  $ano .'</h4>
<p>Chasis Gravado: <strong>'. $chasis_gravado .'</strong>, Chasis Vin: <strong>'. $chasis_vin .'</strong>, No. Motor: <strong>'. $no_motor .'</strong></p>
</div>';  


   $a = $db->query("SELECT * FROM taller_mantenimiento WHERE vehiculo = '".$v_hash."' and td = ".$_SESSION["td"]."");
    $cf = $a->num_rows;  // numero de facturas
    $a->close();

   $a = $db->query("SELECT * FROM taller_facturas WHERE vehiculo = '".$v_hash."' and td = ".$_SESSION["td"]."");
    $cas = $a->num_rows; // numero de creditos
    $a->close();




echo '<div class="card-group">
    <!--Panel-->
    <div class="card ml-3 mr-2">
        <div class="card-body text-center">
            <h5 class="card-title">Mantenimientos</h5>
            <h1 class="display-1">'. $cf .'</h1>
        </div>

    </div>
    <!--/.Panel-->

    <!--Panel-->
    <div class="card ml-2 mr-3">
        <div class="card-body text-center">
            <h5 class="card-title">Facturas Aplicadas</h5>
            <h1 class="display-1">'. $cas .'</h1>
        </div>

    </div>
    <!--/.Panel-->

</div>';




  }



























} // Termina la lcase
?>