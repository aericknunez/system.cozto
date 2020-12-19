<?php 
class Rapido{

		public function __construct() { 
     	} 




  public function AddProducto($datos){ // lo que viede del formulario principal
    $db = new dbConn();
    if($this->CompCod($datos["cod"]) == TRUE){
      if($this->CompruebaForm($datos) == TRUE){ // comprueba si todos los datos requeridos estan llenos
// categoria
 if ($r = $db->select("hash", "producto_categoria_sub", "WHERE td = ". $_SESSION["td"] ." order by id desc limit 1")) { 
        $categoria = $r["hash"]; } unset($r); 

// unidad de medida
 if ($r = $db->select("hash", "producto_unidades", "WHERE td = ". $_SESSION["td"] ." order by id desc limit 1")) { 
        $medida = $r["hash"]; } unset($r); 
// proveedor
 if ($r = $db->select("hash", "proveedores", "WHERE td = ". $_SESSION["td"] ." order by id desc limit 1")) { 
        $proveedor = $r["hash"]; } unset($r); 



                
                if($datos["caduca_submit"] != NULL){ $data["caduca"] = "on"; } else { $data["caduca"] = 0;}

                $data["cod"] = $datos["cod"];
                $data["categoria"] = $categoria;
                $data["medida"] = $medida;
                $data["proveedor"] = $proveedor;
                $data["cantidad"] = $datos["cantidad"];
                $data["gravado"] = "on";
                $data["receta"] = 0;
                $data["servicio"] = 0;
                $data["compuesto"] = 0;
                $data["dependiente"] = 0;
                $data["promocion"] = 0;
                $data["verecommerce"] = 0;
                $data["descripcion"] = strtoupper($datos["descripcion"]);
                $data["hash"] = Helpers::HashId();
                $data["time"] = Helpers::TimeId();
                $data["td"] = $_SESSION["td"];
              if ($db->insert("producto", $data)) {


                $insert["producto"] = $datos["cod"];
                $insert["cant"] = 1;
                $insert["precio"] = $datos["precio"];
                $insert["hash"] = Helpers::HashId();
                $insert["time"] = Helpers::TimeId();
                $insert["td"] = $_SESSION["td"];
                $db->insert("producto_precio", $insert);

                
                if($datos["cantidad"] > 0){
                  $datox["producto"] = $datos["cod"];
                  $datox["cantidad"] = $datos["cantidad"];
                  $datox["precio_costo"] = $datos["precio_costo"];
                  $datox["caduca_submit"] = $datos["caduca_submit"];
                  $this->IngresarProducto($datox);
                }
                
                  
                $this->UltimosProductos();

              } else {
                Alerts::Alerta("error","Error!","No se agrego el producto!");
              }          
      } else {
        Alerts::Alerta("error","Error!","Faltan Datos!");
      }

    } else {
      Alerts::Alerta("error","Error!","El codigo del producto ya existe!");
    }
  print_r($datos);
  }






 public function CompCod($codigo){
$db = new dbConn();

$a = $db->query("SELECT * FROM producto WHERE cod = '".$codigo."' and td = ".$_SESSION["td"]."");
$cantcod = $a->num_rows;
$a->close();

    if($cantcod > 0){
       return FALSE;
    } else {
      return TRUE;
    }
 }



  public function CompruebaForm($datos){

        if($datos["cod"] == NULL or
          $datos["descripcion"] == NULL or
          $datos["precio"] == NULL){
          return FALSE;
        } else {
         return TRUE;
        }
  }








  public function IngresarProducto($datox){ // ingresa un nuevo lote de productos
      $db = new dbConn();
            // debo actualizar el total (cantidad) de producto
                                
          $datos = array();
          $datos["producto"] = $datox["producto"];
          $datos["cant"] = $datox["cantidad"];
          $datos["existencia"] = $datox["cantidad"];
          $datos["precio_costo"] = $datox["precio_costo"];
          $datos["caduca"] = $datox["caduca_submit"];
          $datos["caducaF"] = Fechas::Format($datox["caduca_submit"]);
          $datos["comentarios"] = "Producto de inicio de inventario";
          $datos["fecha"] = date("d-m-Y");
          $datos["hora"] = date("H:i:s");
          $datos["td"] = $_SESSION["td"];
          $datos["hash"] = Helpers::HashId();
          $datos["time"] = Helpers::TimeId();
          $db->insert("producto_ingresado", $datos);


 if ($r = $db->select("hash", "ubicacion", "WHERE predeterminada = 1 and td = ". $_SESSION["td"] ."")) { 
        $hash = $r["hash"]; } unset($r); 

          $data = array();
          $data["ubucacion"] =  $hash;
          $data["producto"] = $datox["producto"];
          $data["cant"] = $datox["cantidad"];
          $data["td"] = $_SESSION["td"];
          $data["hash"] = Helpers::HashId();
          $data["time"] = Helpers::TimeId();
          $db->insert("ubicacion_asig", $data);


  }








  public function UltimosProductos(){
      $db = new dbConn();


 $a = $db->query("SELECT * FROM producto WHERE td = ".$_SESSION["td"]." order by id DESC limit 10");
      
      if($a->num_rows > 0){
          echo '<div class="table-responsive">
          <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th>Cod</a></th>
            <th>Descripcion</a></th>
            <th>Cantidad</a></th>
            <th>Precio Costo</a></th>
            <th>Precio Venta</th>
            <th>Caducidad</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($a as $b) {
        // obtener el nombre y detalles del producto
 if ($r = $db->select("precio", "producto_precio", "WHERE producto = ".$b["cod"]." and td = ". $_SESSION["td"] ."")) { 
        $precio = $r["precio"]; } unset($r); 

 if ($r = $db->select("precio_costo, caduca", "producto_ingresado", "WHERE producto = ".$b["cod"]." and td = ". $_SESSION["td"] ."")) { 
        $precio_costo = $r["precio_costo"]; 
        $caduca = $r["caduca"];} unset($r); 

          echo '<tr>
                      <td>'.$b["cod"].'</td>
                      <td>'.$b["descripcion"].'</td>
                      <td>'.$b["cantidad"].'</td>
                      <td>'.$precio_costo.'</td>
                      <td>'.$precio.'</td>
                      <td>'.$caduca.'</td>
                    </tr>';
        }
        echo '</tbody>
        </table>
        </div>';


      }
        $a->close();


  } // termina productos











} // Termina la lcase

?>