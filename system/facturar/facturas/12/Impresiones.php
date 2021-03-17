 <?php  

class Impresiones{
    public function __construct() { 
     } 


  public function Ticket($efectivo, $numero){

}







 public function Factura($efectivo, $numero){

}   /// termina FACTURA





 public function CreditoFiscal($data){

}



 public function Ninguno(){

}   /// termina /.;ninguno








 public function ImprimirAntes($efectivo, $numero, $cancelar){

} /// TERMINA IMPRIMIR ANTES







 public function Comanda(){


 }














 public function ReporteDiario($fecha){


}   // termina reporte diario








 public function AbrirCaja(){

}




 public function CorteX($hash){ // imprime el resumen del ultimo corte
  $db = new dbConn();
}


 public function CorteZ($fechax){ // imprime el resumen del ultimo corte
  $db = new dbConn();
}


 public function Col4($col1, $esp1,  $col2, $esp2, $col3, $esp3,  $col4,$esp4){
        $la1 = str_pad($col1, $esp1, ' ', STR_PAD_LEFT);
        $la2 = str_pad($col2, $esp2, ' ', STR_PAD_LEFT);
        $la3 = str_pad($col3, $esp3, ' ', STR_PAD_LEFT);
        $la4 = str_pad($col4, $esp4, ' ', STR_PAD_LEFT);
        return "$la1$la2$la3$la4\n";
    }







}// class