<?php 
class CambioDatosCliente{


    
    public function VerClientes($npagina, $orden, $dir){
        $db = new dbConn();
  
    $limit = 35;
    $adjacents = 2;
    if($npagina == NULL) $npagina = 1;
    $a = $db->query("SELECT * FROM facturar_documento WHERE td = ". $_SESSION['td'] ."");
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
  
   $a = $db->query("SELECT * FROM facturar_documento WHERE td = ".$_SESSION["td"]." order by ".$orden." ".$dir." limit $offset, $limit");
        
        if($a->num_rows > 0){
            echo '<div class="table table-responsive">
            <table class="table table-sm table-striped">
          <thead>
            <tr>
              <th class="th-sm"><a id="paginador" op="320" iden="1" orden="cliente" dir="'.$dir2.'">CLIENTE</a></th>
              <th class="th-sm"><a id="paginador" op="320" iden="1" orden="documento" dir="'.$dir2.'">DOCUMENTO</a></th>
              <th class="th-sm">GIRO</th>
              <th class="th-sm">REGISTRO</th>
              <th class="th-sm">DIRECCION</th>
              <th class="th-xs">Ver</th>
              <th class="th-xs">Eliminar</th>
            </tr>
          </thead>
          <tbody>';
          foreach ($a as $b) {

            echo '<tr>
                        <td>'.$b["cliente"].'</td>
                        <td>'.$b["documento"].'</td>
                        <td>'.$b["giro"].'</td>
                        <td>'.$b["registro"].'</td>
                        <td>'.$b["direccion"].', '.$b["departamento"].'</td>
                        <td><a id="xver" op="68-CF" key="'.$b["documento"].'"><i class="fas fa-search fa-lg green-text"></i></a></td>

                        <td><a id="xdelete"  iden="'. $b["hash"] .'" op="321"><i class="fas fa-trash fa-lg red-text ml-2"></i></a>';
  
                        
                        echo '</td>
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
          <a class="page-link" id="paginador" op="320" iden="1" orden="'.$orden.'" dir="'.$dir.'">&lt;&lt;</a>
        </li>';
      
      $page>1 ? $pagina = $page-1 : $pagina = 1;
      echo '<li class="page-item '.$enable.'">
          <a class="page-link" id="paginador" op="320" iden="'.$pagina.'" orden="'.$orden.'" dir="'.$dir.'">&lt;</a>
        </li>';
  
      for($i=$start; $i<=$end; $i++) {
        $i == $page ? $pagina =  'active' : $pagina = '';
        echo '<li class="page-item '.$pagina.'">
          <a class="page-link" id="paginador" op="320" iden="'.$i.'" orden="'.$orden.'" dir="'.$dir.'">'.$i.'</a>
        </li>';
      }
  
      $page >= $total_pages ? $enable = 'disabled' : $enable = '';
      $page < $total_pages ? $pagina = ($page+1) : $pagina = $total_pages;
      echo '<li class="page-item '.$enable.'">
          <a class="page-link" id="paginador" op="320" iden="'.$pagina.'" orden="'.$orden.'" dir="'.$dir.'">&gt;</a>
        </li>';
  
      echo '<li class="page-item '.$enable.'">
          <a class="page-link" id="paginador" op="320" iden="'.$total_pages.'" orden="'.$orden.'" dir="'.$dir.'">&gt;&gt;</a>
        </li>
  
        </ul>';
       }  // end pagination 

       echo '</div>';
    } // termina productos


        
    public function EliminarCliente($hash){
        $db = new dbConn();

        if (Helpers::DeleteId("facturar_documento", "hash='$hash'")) {
          Alerts::Alerta("success","Eliminado!","Cliente eliminado correctamente!");
       } else {
           Alerts::Alerta("error","Error!","Algo Ocurrio!");
       } 
      $this->VerClientes(1, "id", "asc");

    }


    public function VistaClienteCF($data){
      $db = new dbConn();
     if ($r = $db->select("*", "facturar_documento", "WHERE documento = '".$data["key"]."' and td = ".$_SESSION["td"]."")) { 
  
  
  echo '<blockquote class="blockquote bq-primary">
  <p class="bq-title" mb-0>'.$r["cliente"].'</p>
  </blockquote>';
  
  echo '  <p  class="mt-1">Documento: <strong>'.$r["documento"].'</strong> </p>';
  echo '  <p  class="mt-1">Giro: <strong>'.$r["giro"].'</strong> </p>';
  echo '  <p  class="mt-1">Dirección: <strong>'.$r["direccion"].'</strong> </p>';
  echo '  <p  class="mt-1">Departamento: <strong>'.$r["departamento"].', '.$r["municipio"].'</strong> </p>';
  echo '  <p  class="mt-1">Email: <strong>'.$r["email"].'</strong> </p>';
  
        }  unset($r); 
  
  
  
   $a = $db->query("SELECT * FROM facturar_documento_factura WHERE documento = '".$data["key"]."' and td = ".$_SESSION["td"]."");
    $cf = $a->num_rows;  // numero de facturas
    $total = 0;
  
  echo '<div class="card-group">
    <!--Panel-->
    <div class="card ml-3 mr-2">
        <div class="card-body text-center">
            <h5 class="card-title">Credito Fiscal Registrados</h5>
            <h1 class="display-1">'. $cf .'</h1>
        </div>
        <div class="card-footer">
            <small class="text-muted"><a href="?cliente_facturas&tipo=3&key='.$data["key"].'">Ver Creditos Fiscales</a></small>
        </div>
    </div>
    <!--/.Panel-->
  
    <!--Panel
    <div class="card ml-2 mr-3">
        <div class="card-body text-center">
            <h5 class="card-title">Total</h5>
            <h1 class="display-5">'. Helpers::Dinero($total) .'</h1>
        </div>
        <div class="card-footer">
            <small class="text-muted"><a href="?creditosvercliente&key='.$data["key"].'"></a></small>
        </div>
    </div>
 Panel-->
  
  </div>';
  
  
  
  
  }
  
  



















} // fin de la clase

 ?>


 