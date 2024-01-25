<?php 
class Clientes {

		public function __construct() { 
     	} 



  public function AddCliente($datos){
    $db = new dbConn();
      if($this->CompruebaForm($datos) == TRUE){ // comprueba si todos los datos requeridos estan llenos

                $datos["nombre"] = strtoupper($datos["nombre"]);
                $datos["codigo"] = strtoupper($datos["codigo"]);
                $datos["hash"] = Helpers::HashId();
                $datos["time"] = Helpers::TimeId();
                $datos["td"] = $_SESSION["td"];
                if ($db->insert("clientes", $datos)) {

                    Alerts::Alerta("success","Realizado!","Registro realizado correctamente!");  
                }

        } else {
          Alerts::Alerta("error","Error!","Faltan Datos!");
        }
      $this->VerClientes();
  }


  public function CompruebaForm($datos){
        if($datos["nombre"] == NULL or
          $datos["direccion"] == NULL or
          $datos["telefono"] == NULL){
          return FALSE;
        } else {
         return TRUE;
        }
  }

  public function UpCliente($datos){ // lo que viede del formulario principal
    $db = new dbConn();
      if($this->CompruebaForm($datos) == TRUE){ // comprueba si todos los datos requeridos estan llenos

              $datos["nombre"] = strtoupper($datos["nombre"]);
              $datos["time"] = Helpers::TimeId();
              $hash = $datos["hash"];
              if (Helpers::UpdateId("clientes", $datos, "hash = '$hash' and td = ".$_SESSION["td"]."")) {
                  Alerts::Alerta("success","Realizado!","Cambio realizado exitosamente!");
                  echo '<script>
                        window.location.href="?clientever"
                      </script>';
              }           

      } else {
        Alerts::Alerta("error","Error!","Faltan Datos!");
      }
  }



  public function VerClientes(){
      $db = new dbConn();
          $a = $db->query("SELECT * FROM clientes WHERE td = ".$_SESSION["td"]." order by id desc limit 10");
          if($a->num_rows > 0){
        echo '<table class="table table-sm table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Documento</th>
              <th scope="col">Direccion</th>
              <th scope="col">Telefono</th>
              <th scope="col">Eliminar</th>
            </tr>
          </thead>
          <tbody>';
          $n = 1;
              foreach ($a as $b) { ;
                echo '<tr>
                      <th scope="row">'. $n ++ .'</th>
                      <td>'.$b["nombre"].'</td>
                      <td>'.$b["documento"].'</td>
                      <td>'.$b["direccion"].'</td>
                      <td>'.$b["telefono"].'</td>
                      <td><a id="xdelete" hash="'.$b["hash"].'" op="65"><i class="fa fa-minus-circle fa-lg red-text"></i></a></td>
                    </tr>';          
              }
        echo '</tbody>
        </table>';
            echo '<div class="text-center"><a href="?clientever" class="btn btn-outline-info btn-rounded waves-effect btn-sm">Ver Todos</a></div>';
          } $a->close();  
      
  }


  public function DelCliente($hash){ // elimina precio
    $db = new dbConn();
        if (Helpers::DeleteId("clientes", "hash='$hash'")) {
           Alerts::Alerta("success","Eliminado!","Cliente eliminado correctamente!");
        } else {
            Alerts::Alerta("error","Error!","Algo Ocurrio!");
        } 
      $this->VerClientes();
  }

  public function DelClientex($hash){ // elimina precio
    $db = new dbConn();
        if (Helpers::DeleteId("clientes", "hash='$hash'")) {
           Alerts::Alerta("success","Eliminado!","Cliente eliminado correctamente!");
        } else {
            Alerts::Alerta("error","Error!","Algo Ocurrio!");
        } 
      $this->VerTodosClientes();
  }


  public function VerTodosClientes(){
      $db = new dbConn();
          $a = $db->query("SELECT * FROM clientes WHERE td = ".$_SESSION["td"]." order by id desc");
          if($a->num_rows > 0){
        echo '<table id="dtMaterialDesignExample" class="table table-striped" table-sm cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm">#</th>
                    <th class="th-sm">Cod</th>
                    <th class="th-sm">Nombre</th>
                    <th class="th-sm">Documento</th>
                    <th class="th-sm">Telefono</th>
                    <th class="th-sm">Ver</th>
                    <th class="th-sm">Eliminar</th>
                  </tr>
                </thead>
                <tbody>';
          $n = 1;
              foreach ($a as $b) { ;
                echo '<tr>
                      <td>'. $n ++ .'</td>
                      <td>'.$b["codigo"].'</td>
                      <td>'.$b["nombre"].'</td>
                      <td>'.$b["documento"].'</td>
                      <td>'.$b["telefono"].'</td>
                      <td><a id="xver" op="68" key="'.$b["hash"].'"><i class="fas fa-search fa-lg green-text"></i></a></td>
                      <td><a id="xdelete" hash="'.$b["hash"].'" op="66"><i class="fa fa-minus-circle fa-lg red-text"></i></a></td>
                    </tr>';          
              }
        echo '</tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Documento</th>
                    <th>Telefono</th>
                    <th>Ver</th>
                    <th>Eliminar</th>
                  </tr>
                </tfoot>
              </table>';

          } $a->close();  

  }




////////////nuevo documento factura
  public function NuevoDocumento($datos){
    $db = new dbConn();
    if($this->VerificaDocumento($datos["documento"]) > 0){
        Alerts::Alerta("error","Error!","Ya se encuentra registro de este documento!");
    } else {
      if($datos["documento"] != NULL or $datos["cliente"] != NULL){ // comprueba datos

        $datos["cliente"] = strtoupper($datos["cliente"]); // paso a mayusculas

        $datos["giro"] = $datos["giro"];
        $datos["registro"] = $datos["registro"];
        $datos["hash"] = Helpers::HashId();
        $datos["time"] = Helpers::TimeId();
        $datos["td"] = $_SESSION["td"];
        if ($db->insert("facturar_documento", $datos)) {

            Alerts::Alerta("success","Realizado!","Registro realizado correctamente!");  

                    $_SESSION["factura_cliente"] = $datos["cliente"];
                    $_SESSION["factura_documento"] = $datos["documento"];
                      
                      $texto = $_SESSION['config_nombre_documento']. ": " . $_SESSION["factura_documento"] . "<br> Cliente: " . $_SESSION["factura_cliente"];
                    Alerts::Mensajex($texto,"danger",'<a id="quitar-documento" op="102" class="btn btn-danger btn-rounded">Quitar '.$_SESSION["config_nombre_documento"].'</a>',$boton2);
        }

        } else {
          Alerts::Alerta("error","Error!","Faltan Datos!");
        }
  }

  }
//Editar Cliente de Credito Fiscal
  public function EditarClientecf($datos){ 
    $db = new dbConn();

    if($datos["documento"] != NULL && $datos["cliente"] != NULL){ // comprueba datos
      $datos["cliente"] = strtoupper($datos["cliente"]); // paso a mayusculas
      $hash = $datos["hash"];
      $datos["time"] = Helpers::TimeId();
      $datos["td"] = $_SESSION["td"];
      if ($datos["tipo_contribuyente"] == 1){
          $datos["tipo_contribuyente"] = 1;
      }else{
          $datos["tipo_contribuyente"] = 0;
      }
          if (Helpers::UpdateId("facturar_documento", $datos, "hash = '$hash' and td = ".$_SESSION["td"]."")) {
              Alerts::Alerta("success","Realizado!","Cambio realizado exitosamente!");
              echo '<script> window.location.href="?mod_nit"</script>';
          }           
          } else {
        Alerts::Alerta("error","Error!","Faltan Datos!");
      }
}

/// verifica que no exista el numero de documento
  public function VerificaDocumento($documento){ // productde  de la tabla ticket
    $db = new dbConn();

    $a = $db->query("SELECT * FROM facturar_documento WHERE documento = '$documento' and td = ".$_SESSION["td"]."");      
        return $a->num_rows;
        $a->close();
    }







  public function VistaCliente($data){
      $db = new dbConn();
     if ($r = $db->select("*", "clientes", "WHERE hash = '".$data["key"]."' and td = ".$_SESSION["td"]."")) { 


echo '<blockquote class="blockquote bq-primary">
  <p class="bq-title" mb-0>'.$r["codigo"].' | '.$r["nombre"].'</p>
</blockquote>';

echo '  <p  class="mt-1">Documento: <strong>'.$r["documento"].'</strong> </p>';
echo '  <p  class="mt-1">Tel&eacutefono: <strong>'.$r["telefono"].'</strong> </p>';
echo '  <p  class="mt-1">Fecha de Nacimiento: <strong>'.Fechas::FechaEscrita($r["nacimiento"]).'</strong> </p>';

              echo '<table class="table table-hover">
                <tbody>
                  <tr>
                    <th colspan="2">Direcci&oacuten: '.$r["direccion"].'</th>
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





  public function ClienteFacturas($cliente){
      $db = new dbConn();

$a = $db->query("SELECT * FROM ticket_cliente WHERE cliente = '$cliente' and td = ".$_SESSION["td"]." order by id desc");
          if($a->num_rows > 0){
        echo '<table id="dtMaterialDesignExample" class="table table-striped" table-sm cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm">#</th>
                    <th class="th-sm">Factura</th>
                    <th class="th-sm">Fecha</th>
                    <th class="th-sm">Hora</th>
                    <th class="th-sm">Cajero</th>
                    <th class="th-sm">Ver</th>
                  </tr>
                </thead>
                <tbody>';
          $n = 1;
              foreach ($a as $b) { 

                    if ($r = $db->select("cajero, tipo_pago", "ticket", "WHERE num_fac = '".$b["factura"]."' and tx = '".$b["tx"]."' and td = ".$_SESSION["td"]."")) { 
                        $cajero = $r["cajero"];
                    } unset($r); 

                echo '<tr>
                      <td>'. $n ++ .'</td>
                      <td>'.$b["factura"].'</td>
                      <td>'.$b["fecha"].'</td>
                      <td>'.$b["hora"].'</td>
                      <td>'.Helpers::GetData("login_userdata", "nombre", "user", $cajero).'</td>
                      <td><a id="xverfactura" op="68-1" factura="'.$b["factura"].'"  tx="'.$b["tx"].'"><i class="fas fa-search fa-lg green-text"></i></a></td>
                    </tr>';          
              }
        echo '</tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Factura</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Cajero</th>
                    <th>Ver</th>
                  </tr>
                </tfoot>
              </table>';

          } else {
            Alerts::Mensajex("No se encontraron facturas registradas en este usuario","danger");
          }$a->close();  

  }





  public function VerFacturaCliente($factura, $tx){
      $db = new dbConn();

$a = $db->query("SELECT * FROM ticket WHERE num_fac = '$factura' and tx = '$tx' and td = ".$_SESSION["td"]." order by id desc");
          if($a->num_rows > 0){
        echo '<table id="dtMaterialDesignExample" class="table table-striped" table-sm cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Cant</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>SubTotal</th>
                    <th>Imp</th>
                    <th>Descuento</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>';
                $pv = 0; $st = 0; $im = 0; $de = 0; $to = 0;
              foreach ($a as $b) { 
                $pv = $pv + $b["pv"]; $st = $st+$b["stotal"]; 
                $im = $im+$b["imp"]; $de = $de+$b["descuento"]; $to = $to+$b["total"];
                echo '<tr>
                      <td>'.$b["cant"]. '</td>
                      <td>'.$b["producto"].'</td>
                      <td>'.$b["pv"].'</td>
                      <td>'.$b["stotal"].'</td>
                      <td>'.$b["imp"].'</td>
                      <td>'.$b["descuento"].'</td>
                      <td>'.$b["total"].'</td>
                    </tr>';          
              }
        echo '</tbody>
                <tfoot>
                  <tr>
                    <th></th>
                    <th>Total: </th>
                    <th>' . $pv . '</th>
                    <th>' . $st . '</th>
                    <th>' . $im . '</th>
                    <th>' . $de . '</th>
                    <th>' . $to . '</th>
                  </tr>
                </tfoot>
              </table>';

          } $a->close();  

  }

  public function ClienteFacturascf($cliente){ //Cliente credito Fiscal
    $db = new dbConn();

$a = $db->query("SELECT * FROM facturar_documento_factura WHERE documento = '$cliente' and td = ".$_SESSION["td"]." order by id desc");
        if($a->num_rows > 0){
      echo '<table id="dtMaterialDesignExample" class="table table-striped" table-sm cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="th-sm">#</th>
                  <th class="th-sm">Credito Fiscal</th>
                  <th class="th-sm">Fecha</th>
                  <th class="th-sm">Cajero</th>
                  <th class="th-sm">Ver</th>
                </tr>
              </thead>
              <tbody>';
        $n = 1;
            foreach ($a as $b) { 

                  if ($r = $db->select("cajero, tipo_pago", "ticket", "WHERE num_fac = '".$b["factura"]."' and tx = '".$b["tx"]."' and td = ".$_SESSION["td"]."")) { 
                      $cajero = $r["cajero"];
                      $fecha = date('d-m-Y H:i:s', $b["time"]);
                  } unset($r); 

              echo '<tr>
                    <td>'. $n ++ .'</td>
                    <td>'.$b["factura"].'</td>
                    <td>'.$fecha.'</td>
                    <td>'.Helpers::GetData("login_userdata", "nombre", "user", $cajero).'</td>
                    <td><a id="xverfactura" op="68-2" factura="'.$b["factura"].'"  tx="'.$b["tx"].'"><i class="fas fa-search fa-lg green-text"></i></a></td>
                  </tr>';          
            }
      echo '</tbody>
              <tfoot>
                <tr>
                  <th>#</th>
                  <th>Credito Fiscal</th>
                  <th>Fecha</th>
                  <th>Cajero</th>
                  <th>Ver</th>
                </tr>
              </tfoot>
            </table>';

        } else {
          Alerts::Mensajex("No se encontraron facturas registradas en este usuario","danger");
        }$a->close();  

}

public function VerFacturaClientecf($factura, $tx){
  $db = new dbConn();

$a = $db->query("SELECT * FROM ticket WHERE num_fac = '$factura' and tx = '$tx' and tipo = '3' and td = ".$_SESSION["td"]." order by id desc");
      if($a->num_rows > 0){
    echo '<table id="dtMaterialDesignExample" class="table table-striped" table-sm cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Cant</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>SubTotal</th>
                <th>Imp</th>
                <th>Descuento</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>';
            $pv = 0; $st = 0; $im = 0; $de = 0; $to = 0;
          foreach ($a as $b) { 
            $pv = $pv + $b["pv"]; $st = $st+$b["stotal"]; 
            $im = $im+$b["imp"]; $de = $de+$b["descuento"]; $to = $to+$b["total"];
            echo '<tr>
                  <td>'.$b["cant"]. '</td>
                  <td>'.$b["producto"].'</td>
                  <td>'.$b["pv"].'</td>
                  <td>'.$b["stotal"].'</td>
                  <td>'.$b["imp"].'</td>
                  <td>'.$b["descuento"].'</td>
                  <td>'.$b["total"].'</td>
                </tr>';          
          }
    echo '</tbody>
            <tfoot>
              <tr>
                <th></th>
                <th>Total: </th>
                <th>' . $pv . '</th>
                <th>' . $st . '</th>
                <th>' . $im . '</th>
                <th>' . $de . '</th>
                <th>' . $to . '</th>
              </tr>
            </tfoot>
          </table>';

      } $a->close();  

}















} // Termina la lcase
?>