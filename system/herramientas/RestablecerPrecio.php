<?php 
class RestablecerPrecio {



    public function DetallesProducto($key){
      $db = new dbConn();

      $a = $db->query("SELECT * FROM producto_ingresado WHERE producto = '".$key."' and td = " . $_SESSION["td"] . " order by id desc");
      if ($a->num_rows > 0) {

        echo '<div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm ">
          <thead>
            <tr>
              <th scope="col">Codigo</th>
              <th scope="col">Producto</th>
              <th scope="col">Fecha</th>
              <th scope="col">Cantidad In</th>
              <th scope="col">Existencia</th>
              <th scope="col">Costo</th>
              <th scope="col">Precio Est</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>';
      foreach ($a as $b) {
          echo '<tr>
                <th scope="row">' . $b["producto"] .'</th>
                <td>' . Helpers::GetData("producto", "descripcion", "cod", $b["producto"]) .'</td>
                <td>' . $b["fecha"] .'  ' . $b["hora"] .'</td>
                <td>' . $b["cant"] .'</td>
                <td>' . $b["existencia"] .'</td>
                <td>' . Helpers::Dinero($b["precio_costo"]) .'</td>
                <td id="precio_est_'.$b["id"].'">' . Helpers::Dinero($b["precio_venta"]) .'</td>
                <td><a id="cambiarprecio" key="'.$b["id"].'"><i class="fas fa-exchange-alt fa-2x green-text"></i></a></td>
                </tr>';
      }
      echo '</tbody>
        </table>
        </div>';
     } $a->close(); // num rows
  


        
    }

    


    public function CambiarPrecio($data){
      $db = new dbConn();

        $cambio = array();
        $cambio["precio_venta"] = $data["cantidad"];
        Helpers::UpdateId("producto_ingresado", $cambio, "id='".$data["iden"]."' and td = ".$_SESSION["td"]."");

        echo Helpers::Dinero($data["cantidad"]);
    }















} // Termina la clase
?>