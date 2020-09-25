<?php
include_once '../../../../application/common/Helpers.php'; // [Para todo]
include_once '../../../../application/includes/variables_db.php';
include_once '../../../../application/common/Mysqli.php';
$db = new dbConn();
include_once '../../../../application/includes/DataLogin.php';
$seslog = new Login();
$seslog->sec_session_start();

include_once '../../../../application/common/Alerts.php';


if ($seslog->login_check() == TRUE) {


   $a = $db->query("SELECT * FROM ticket WHERE orden = '".$_REQUEST["orden"]."' and tx = '".$_SESSION["tx"]."' and td = ".$_SESSION["td"]."");

        $totalregistros =$a->num_rows;
        $datos = "";
   
    foreach ($a as $b) { 

if ($r = $db->select("medida", "producto", "WHERE cod = '".$b["cod"]."' and td = ".$_SESSION["td"]."")) { 
    $medida = $r["medida"];
} unset($r);  

    if ($r = $db->select("abreviacion", "producto_unidades", "WHERE hash = '".$medida."' and td = ".$_SESSION["td"]."")) { 
        $unidad = $r["abreviacion"];
    } unset($r);  



 $datos .= '<tr>
                <td class="text-left">'. Helpers::Entero($b["cant"]) .' '.$unidad.'</td>
                <td>'. $b["producto"] .'</td>                                
                <td class="text-right">'. $b["pv"] .'</td>
                <td class="text-right">'. $b["total"] .'</td>
            </tr>';
    } $a->close();

// datos generales de la factura
    if ($r = $db->select("sum(stotal) as stotal, sum(descuento) as descuento, sum(imp) as imp, sum(total) as total", "ticket", "WHERE orden = '".$_REQUEST["orden"]."' and tx = '".$_SESSION["tx"]."' and td = ".$_SESSION["td"]."")) { 
        $stotal = $r["stotal"];
        $total = $r["total"];
        $imp = $r["imp"];
        $descuento = $r["descuento"];
    } unset($r);  



if($totalregistros > 0){
?>
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <title>Imprimir Orden de Compra</title>
        <meta http-equiv="cache-control" content="no-cache">
        <meta http-equiv="expires" content="0">
        <meta http-equiv="pragma" content="no-cache">
        <link href="../../../../assets/factura_web/styles.css" rel="stylesheet" type="text/css">
        <style type="text/css" media="all">
            body { color: #000; }
            #wrapper { max-width: 520px; margin: 0 auto; padding-top: 20px; }
            .btn { margin-bottom: 2px; }
            .table { border-radius: 3px; }
            .table th { background: #f5f5f5; }
            .table th, .table td { vertical-align: middle !important; padding-bottom: 2px; padding-top: 2px;}
            h3 { margin: 2px 0; }
            .table { font-size: 9px; }

            @media print {
                .no-print { display: none; }
                #wrapper { max-width: 480px; width: 100%; min-width: 250px; margin: 0 auto; }
            }
            tfoot tr th:first-child { text-align: right; }
        </style>
    </head>
    <body>
      <div id="wrapper">
        <div id="receiptData" style="width: auto; max-width: 580px; min-width: 250px; margin: 0 auto;">

            <div id="receipt-data">
                <div>


<?php //datos del cliente 
    if ($r = $db->select("cliente", "ticket_cliente", "WHERE orden = '".$_REQUEST["orden"]."' and tx = '".$_SESSION["tx"]."' and td = ".$_SESSION["td"]."")) { 
        $cliente = $r["cliente"];
    } unset($r);  

    if ($r = $db->select("nombre, direccion, municipio, telefono, comentarios", "clientes", "WHERE hash = '".$cliente."' and td = ".$_SESSION["td"]."")) { 
            $nombre = $r["nombre"];
            $direccion = $r["direccion"];
            $municipio = $r["municipio"];
            $telefono = $r["telefono"];
            $comentarios = $r["comentarios"];
    } unset($r);  
?>

                    <strong><?php echo $nombre; ?></strong><br>

                    <?php echo $direccion; ?>
                    <?php echo $municipio; ?><br>
                    
                    <?php echo $comentarios; ?><br>
                    <strong><?php echo $telefono; ?></strong>

                    
                    <p style="padding-top: -20px;">Orden: <strong><?php echo str_pad($_REQUEST["orden"], 8, "0", STR_PAD_LEFT); ?></strong></p>
                    <div style="clear:both;"></div>
                    <table class="table table-striped table-condensed" style="padding-top: -10px;">
                        <thead>
                            <tr>
                                <th class="text-center">Cant</th>
                                <th class="text-center">Descripción</th>
                                
                                <th class="text-center">Precio</th>
                                <th class="text-center">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php 

                         echo $datos;

                         ?>
                                  
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">SubTotal</th>
                                <th colspan="2" class="text-right"><?php echo Helpers::Dinero($stotal) ?></th>
                            </tr>
<!--                             <tr>
                                <th colspan="2">IVA</th>
                                <th colspan="2" class="text-right"><?php echo Helpers::Dinero($imp) ?></th>
                            </tr>   -->                                        
                                <tr>
                                    <th colspan="2">Total</th>
                                    <th colspan="2" class="text-right"><?php echo Helpers::Dinero($total) ?></th>
                                </tr>
                        </tfoot>
                    </table>
                    
                    <table class="table table-striped table-condensed" style="margin-top:10px;">
                        <tbody>
                            <tr>
                                <td class="text-right">Tipo Pago :</td>
                                <td>Pago contra entrega</td>
                            </tr>
                        </tbody>
                    </table>



<div style="text-align: right; margin-top: -20px;">
    Fecha: <?php echo date("d-m-Y") . " | " . date("H:i:s") ?></div>

            
         </div>
                <div style="clear:both;"></div>
            </div>

            <!-- start -->
<div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
<hr>
<span class="pull-right col-xs-12">
<button onclick="window.print();" class="btn btn-block btn-primary">Imprimir</button></span>
<div style="clear:both;"></div>
</div>
            <!-- end -->
        </div>
    </div>


<script type="text/javascript" src="../../../../assets/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../../../../assets/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function () {
            $('#print').click(function (e) {
                e.preventDefault();
                var link = $(this).attr('href');
                $.get(link);
                return false;
            });

            window.print();
            // window.close();

        });
    </script>
                    



</body></html>

<?php 
} else{
    header("location: ../../../../error.php");
}

} else {    
    header("location: ../../../../");
}
 ?>
