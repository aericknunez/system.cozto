<?php
include_once '../../../../application/common/Helpers.php'; // [Para todo]
include_once '../../../../application/common/Encrypt.php';
include_once '../../../../application/includes/variables_db.php';
include_once '../../../../application/common/Mysqli.php';
$db = new dbConn();
include_once '../../../../application/includes/DataLogin.php';
$seslog = new Login();
$seslog->sec_session_start();

include_once '../../../../application/common/Alerts.php';

if ($seslog->login_check() == TRUE) {
include_once '../../../ventas/Repartidor.php';
$repartidor = new Repartidor();
?>
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <title>Imprimir Factura</title>
        <meta http-equiv="cache-control" content="no-cache">
        <meta http-equiv="expires" content="0">
        <meta http-equiv="pragma" content="no-cache">
        <link href="../../../../assets/factura_web/styles.css" rel="stylesheet" type="text/css">
        <style type="text/css" media="all">
            body { color: #000; }
            #wrapper { max-width: 800px; margin: 0 auto; padding-top: 20px; }
            .btn { margin-bottom: 5px; }
            .table { border-radius: 3px; }
            .table th { background: #f5f5f5; }
            .table th, .table td { vertical-align: middle !important; }
            .table { font-size: 9px; }
            h3 { margin: 5px 0; }
            .letras { font-size: 11px; }

            @media print {
                .no-print { display: none; }
                #wrapper { width: 100%; min-width: 250px; margin: 0 auto; }
            }
            tfoot tr th:first-child { text-align: right; }
        </style>
    </head>
    <body>
      <div id="wrapper">
        <div id="receiptData" style="width: auto; margin: 0 auto;">

            <div id="receipt-data">

                <?php
                $repartidor->VerRepartidores($_GET["repartidor"], $_GET["fecha"]);
                ?>
                <div style="clear:both;"></div>
            </div>

            <!-- start -->
<div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
<hr>
<span class="pull-right col-xs-12">
<button onclick="window.print();" class="btn btn-block btn-primary">Imprimir</button></span>
<!-- <span class="pull-left col-xs-12"><a class="btn btn-block btn-success" href="#" id="email">Email</a></span> -->
<!-- <span class="col-xs-12">
<a class="btn btn-block btn-warning" href="../../?">Regresar</a>
</span> -->
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
 ?>
