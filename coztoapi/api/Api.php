<?php 
class Api{

	public function __construct(){

	}


public function ObtenerOrdenes($destino){
    $db = new dbConn();

$data = array();


 $n = 0; 
    $a = $db->query("SELECT * FROM ordenes WHERE destino = '$destino' and edo = 1");
    foreach ($a as $b) {

        $productos = array();
        $x = $db->query("SELECT * FROM productos WHERE orden = '".$b["hash"]."'");
            foreach ($x as $z) {
                 $productos[] = $z;
            } $x->close();


        $data["ordenes"][] = $b;
        $data["ordenes"][$n]["productos"] =  $productos;




    $n++;


} $a->close();

    if ($data == NULL) {
        $data["mensaje"] = "No se encontraron datos";
    }

    $data = json_encode($data);

    echo $data;
}






  public function AddOrden($data) { //agrega una nueva orden
    $db = new dbConn();

    $data = json_decode($data, true);

    $datos = array();
    $datos["hash"] = $data["ordenes"]["hash"];
    $datos["usuario_o"] = $data["ordenes"]["usuario_o"];
    $datos["nombre_o"] = $data["ordenes"]["nombre_o"];
    $datos["origen"] = $data["ordenes"]["origen"];
    $datos["destino"] = $data["ordenes"]["destino"];
    $datos["usuario_d"] = $data["ordenes"]["usuario_d"];
    $datos["nombre_d"] = $data["ordenes"]["nombre_d"];
    $datos["fecha"] = $data["ordenes"]["fecha"];
    $datos["hora"] = $data["ordenes"]["hora"];
    $datos["fechaF"] = $data["ordenes"]["fechaF"];
    $datos["edo"] = 1;
    $db->insert("ordenes", $datos); 

foreach ($data["ordenes"]["productos"] as $key => $producto) {

            $datai = array();
            $datai["orden"] = $producto["orden"];
            $datai["cod"] = $producto["cod"];
            $datai["producto"] = $producto["producto"];
            $datai["cantidad"] = $producto["cantidad"];
            $datai["comentario_o"] = $producto["comentario_o"];
            $datai["comentario_d"] = $producto["comentario_d"];
            $datai["edo"] = 1;
            $db->insert("productos", $datai); 

}

    $datax = array();
    $datax["mensaje"] = "Registro Realizado";
    echo json_encode($datax);

  }








  public function AceptarOrden($hash) { //aceptar orden
    $db = new dbConn();

    $cambio = array();
    $cambio["edo"] = "2";
    $db->update("ordenes", $cambio, "WHERE hash='$hash'");
    $db->update("productos", $cambio, "WHERE orden='$hash'");

    $datax = array();
    $datax["mensaje"] = "Realizado";
    echo json_encode($datax);
  }






  public function AceptarProducto($data) { //orden(hash) e identificador(id) orden
    $db = new dbConn();

    $cambio = array();
    $cambio["edo"] = "2";
    $db->update("productos", $cambio, "WHERE orden='".$data["hash"]."' and id = '".$data["identificador"]."'");

    $datax = array();
    $datax["mensaje"] = "Producto Aceptado";
    echo json_encode($datax);
  }






  public function RechazarProducto($data) { //orden(hash) e identificador(id) orden
    $db = new dbConn();

    $cambio = array();
    $cambio["edo"] = "3";
    $db->update("productos", $cambio, "WHERE orden='".$data["hash"]."' and id = '".$data["identificador"]."'");

    $datax = array();
    $datax["mensaje"] = "Producto Rechazado";
    echo json_encode($datax);
  }







  public function RechazarOrden($hash) { //aceptar orden
    $db = new dbConn();

    $cambio = array();
    $cambio["edo"] = "3";
    $db->update("ordenes", $cambio, "WHERE hash='$hash'");
    $db->update("productos", $cambio, "WHERE orden='$hash'");

    $datax = array();
    $datax["mensaje"] = "Orden Rechazada";
    echo json_encode($datax);
  }





  public function EliminarOrden($hash) { //eliminar orden (solo puede hacerlo el que creo la orden)
    $db = new dbConn();

    $cambio = array();
    $cambio["edo"] = "0";
    $db->update("ordenes", $cambio, "WHERE hash='$hash' and edo = 1");
    $db->update("productos", $cambio, "WHERE orden='$hash' and edo = 1");

    $datax = array();
    $datax["mensaje"] = "Orden Eliminada";
    echo json_encode($datax);
  }






  public function EmparejarSistemas($data) { //agrega una nueva orden
    $db = new dbConn();

    $data = json_decode($data, true);

    $a = $db->query("SELECT * FROM enlaces WHERE origen = '".$data["s1"]."' and destino = " . $data["s2"]);
    $cantix = $a->num_rows;
    $a->close();

if ($cantix == 0 and ($data["s1"] != $data["s2"])) {

    $n1 = Helpers::GetData("clientes", "cliente", "td", $data["s1"]);
    $n2 = Helpers::GetData("clientes", "cliente", "td", $data["s2"]);

    $datos = array();
    $datos["origen"] = $data["s1"];
    $datos["nombre_o"] = $n1;
    $datos["destino"] = $data["s2"];
    $datos["nombre_d"] = $n2;
    $datos["edo"] = 1;
    $db->insert("enlaces", $datos); 

    $datos2 = array();
    $datos2["origen"] = $data["s2"];
    $datos2["nombre_o"] = $n2;
    $datos2["destino"] = $data["s1"];
    $datos2["nombre_d"] = $n1;
    $datos2["edo"] = 1;
    $db->insert("enlaces", $datos2); 

}

    $datax = array();
    $datax["mensaje"] = "Agregado correctamente";
    echo json_encode($datax);

 
  }






//// obtener solo productos de una orden


public function CuentasVinculadas($origen){
    $db = new dbConn();

$data = array();

        $x = $db->query("SELECT destino, nombre_d FROM enlaces WHERE origen = '".$origen."'");
            foreach ($x as $z) {
                 $data[] = $z;
        } $x->close();

    $data = json_encode($data);

    echo $data;
}





public function ClientesRegistrados(){
    $db = new dbConn();

$data = array();

        $x = $db->query("SELECT cliente, plataforma, td FROM clientes");
            foreach ($x as $z) {
                 $data[] = $z;
        } $x->close();

    $data = json_encode($data);

    echo $data;
}











public function ObtenerOrdenesEnviadas($origen){
    $db = new dbConn();

$data = array();

 $n = 0; 
    $a = $db->query("SELECT * FROM ordenes WHERE origen = '$origen' order by id desc");
    foreach ($a as $b) {

        $productos = array();
        $x = $db->query("SELECT * FROM productos WHERE orden = '".$b["hash"]."'");
            foreach ($x as $z) {
                 $productos[] = $z;
            } $x->close();

        $data["ordenes"][] = $b;
        $data["ordenes"][$n]["productos"] =  $productos;
    $n++;

} $a->close();

    if ($data == NULL) {
        $data["mensaje"] = "No se encontraron datos";
    }

    $data = json_encode($data);
    echo $data;
}







public function ObtieneProductos($hash){
    $db = new dbConn();

$data = array();

        $x = $db->query("SELECT * FROM productos WHERE orden = '".$hash."'");
            foreach ($x as $z) {
                 $productos[] = $z;
            } $x->close();

        $data["productos"] =  $productos;

    if ($data == NULL) {
        $data["mensaje"] = "No se encontraron datos";
    }

    $data = json_encode($data);
    echo $data;
}







  public function AddCliente($data) { //agrega una nueva orden
    $db = new dbConn();

    $data = json_decode($data, true);

    $datos = array();
    $datos["cliente"] = $data["cliente"];
    $datos["direccion"] = $data["direccion"];
    $datos["encargado"] = $data["encargado"];
    $datos["telefono"] = $data["telefono"];
    $datos["tipo_sistema"] = $data["tipo_sistema"];
    $datos["plataforma"] = $data["plataforma"];
    $datos["td"] = $data["td"];
    $datos["edo"] = 1;
    $db->insert("clientes", $datos); 

    $datax = array();
    $datax["mensaje"] = "Registro Realizado";
    echo json_encode($datax);

  }





  public function DevolverProductos($hash) { //aceptar orden
    $db = new dbConn();

    $cambio = array();
    $cambio["edo"] = "4";
    $db->update("ordenes", $cambio, "WHERE hash='$hash'");
    $db->update("productos", $cambio, "WHERE orden='$hash'");

    $datax = array();
    $datax["mensaje"] = "Realizado";
    echo json_encode($datax);
  }











} // clase
?>