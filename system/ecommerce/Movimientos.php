<?php 
class Movimientos{

		public function __construct() { 
     	} 




/// agregar Item
  public function AddItem($data, $td){
      $db = new dbConn();

  if($data["usuario"] == NULL){ // si no existe numero de orden agregar uno    
       $data["usuario"] = Helpers::HashId();
  }


  if($data["orden"] == NULL){ // si no existe numero de orden agregar uno    
       $data["orden"] = $this->AddOrden($data["usuario"], $td);
  }

if($this->ObtenerCantidadTicket($data["cod"], $data["orden"], $td) == 0){ // agregar
  $this->Agregar($data, $td);
} else { // Actualizar
  $this->Actualiza($data, $td);
}

$salida = array();
$salida["usuario"] =  $data["usuario"];
$salida["orden"] =  $data["orden"];
$salida["mensaje"] =  "Agregado correctamente";
echo json_encode($salida);

}




  public function AddOrden($usuario, $td) { //leva el control del autoincremento de las cotizaciones
    $db = new dbConn();
       
        if ($r = $db->select("orden", "ecommerce_data", "WHERE td = ".$td." order by orden desc limit 1")) { 
            $ultimoorden = $r["orden"];
        } unset($r);   

        if($ultimoorden == NULL){ $ultimoorden = 0; }
        $datos = array();
        $datos["usuario"] = $usuario;
        $datos["orden"] = $ultimoorden + 1;
        $datos["fecha"] = date("d-m-Y");
        $datos["hora"] = date("H:i:s");
        $datos["fechaF"] = Fechas::Format(date("d-m-Y"));
        $datos["edo"] = 1;
        $datos["hash"] = Helpers::HashId();
        $datos["time"] = Helpers::TimeId();
        $datos["td"] = $td;
        $db->insert("ecommerce_data", $datos); 
    
    return $ultimoorden + 1;    
  }



  public function ObtenerCantidadTicket($cod, $orden, $td) { // obtine cantiad de productos
    $db = new dbConn();

  if ($r = $db->select("cant", "ecommerce", "WHERE cod = '$cod' and orden = ".$orden." and td = ".$td."")){ 
        return $r["cant"];
      } unset($r); 
    }


  public function Agregar($datos, $td) { // agrega el producto
    $db = new dbConn();

  $pv = $this->ObtenerPrecio($datos["cod"], $datos["cantidad"], $td);
  $sumas = $pv * $datos["cantidad"];

    $stot=Helpers::STotal($sumas, $this->ObtenerImpuesto($td));
    $im=Helpers::Impuesto($stot, $this->ObtenerImpuesto($td));

    $datox = array();
      $datox["cod"] = $datos["cod"];
      $datox["cant"] = $datos["cantidad"];
      $datox["producto"] = $this->ObtenerNombre($datos["cod"], $td);
      $datox["pv"] = $pv;            
      $datox["stotal"] = $stot;                
      $datox["imp"] = $im;
      $datox["total"] = $stot + $im;
      $datox["descuento"] = NULL;
      $datox["orden"] = $datos["orden"];
      $datox["usuario"] = $datos["usuario"];
      $hash = Helpers::HashId();
      $datox["hash"] = $hash;
      $datox["time"] = Helpers::TimeId();
      $datox["td"] = $td;
      $db->insert("ecommerce", $datox);

  }


  public function Actualiza($datos, $td) { // agrega el producto suma de uno n uno
    $db = new dbConn();

  $pv = $this->ObtenerPrecio($datos["cod"], $datos["cantidad"], $td);
  $sumas = $pv * $datos["cantidad"];
  $descuento = NULL;


    $stot=Helpers::STotal($sumas, $this->ObtenerImpuesto($td));
    $im=Helpers::Impuesto($stot, $this->ObtenerImpuesto($td));

      $cambio = array();
    $cambio["cant"] = $datos["cantidad"];
    $cambio["pv"] = $pv;
    $cambio["stotal"] = $stot;
    $cambio["imp"] = $im;
    $cambio["total"] = $stot + $im;
    $cambio["descuento"] = $descuento;
    Helpers::UpdateId("ecommerce", $cambio, "cod='".$datos["cod"]."' and orden = ".$datos["orden"]." and td = ".$td."");

  }



  public function ObtenerPrecio($cod, $cant, $td){ // obtiene el precio independientemente la cantidad
    $db = new dbConn();
    // cuento si hay varias fechas
  $a = $db->query("SELECT * FROM producto_precio WHERE producto = '$cod' and td = ".$td."");
    $precios = $a->num_rows; $a->close();

      if($precios > 1){ // si hay mas de un precio
          
          if ($r = $db->select("precio", "producto_precio", "WHERE cant <= '$cant' and producto = '$cod' and td = ".$td." order by cant desc limit 1")) { 
                $precio = $r["precio"];
            } unset($r);

      } else { // si solo hay un precio
           
            if ($r = $db->select("precio", "producto_precio", "WHERE producto = '$cod' and td = ".$td."")) { 
                $precio = $r["precio"];
            } unset($r);  
      }
        return $precio;
  }


  public function ObtenerNombre($cod, $td){
    $db = new dbConn();

      if ($r = $db->select("descripcion", "producto", "WHERE cod = '$cod' and td = ".$td."")){ 
        return $r["descripcion"];
      } unset($r); 
    }



  public function ObtenerImpuesto($td){
    $db = new dbConn();

  if ($r = $db->select("imp", "config_master", "WHERE td = ".$td."")){ 
        return $r["imp"];
      } unset($r); 
    }








} // Termina la lcase
?>