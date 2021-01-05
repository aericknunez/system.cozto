<?php
include_once '../../../../application/common/Helpers.php'; // [Para todo]
include_once '../../../../application/includes/variables_db.php';
include_once '../../../../application/common/Mysqli.php';
$db = new dbConn();
include_once '../../../../application/includes/DataLogin.php';
$seslog = new Login();
$seslog->sec_session_start();

include_once '../../../producto/Pesaje.php';
$peso = new Pesaje();


if ($seslog->login_check() == TRUE) {

  ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $_SESSION['config_sistema']; ?></title>


   <!--  <link rel="stylesheet" href="assets/css/font-awesome.css"> -->
    <link rel="stylesheet" href="../../../../assets/css/font-awesome-582.css">
    <link href="../../../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../../assets/css/mdb.min.css" rel="stylesheet">
        <style>
        a:active {
             position: relative;
             top: 5px;
        }
    </style>
    <link href="../../../../assets/css/galeria.css" rel="stylesheet">


       <style type="text/css" media="all">
            @media print {
                .no-print { display: none; }
                #wrapper { max-width: 480px; width: 100%; min-width: 250px; margin: 0 auto; }
            }
        </style>

</head>
<body>
    

<?php 


    if ($r = $db->select("*", "producto", "WHERE cod = '".$_REQUEST["cod"]."' and td = ".$_SESSION["td"]."")) { 
        $producto = $r["producto"];
        $pv = $r["pv"];
    } unset($r);  

?>
<div class="container-fluid">


<div class="row">

    <div class="text-center">

    <?php 
    echo '<img src="../../../../application/common/Barcode.php?text='.$_REQUEST["cod"].'&size=30" alt="'.$producto.'" />';
     ?>
    <br>
    <div style="margin-top: -2px; font-size: 12px;"><?php echo $producto ?></div>
    <div class="font-weight-bold" style="margin-top: -7px">Total: <?php echo Helpers::Dinero($total) ?></div>
        <div style="margin-top: -6px">Precio: <?php echo $pv ?> Peso: <?php echo $cant ?>
        </div>
        <!-- <div style="margin-top: -8px; font-size: 11px;">098908</div> -->
    </div>
</div>
 
</div>

</body>







    <script type="text/javascript" src="../../../../assets/js/jquery-3.4.1.min.js"></script>

    <script type="text/javascript" src="../../../../assets/js/popper.min.js"></script>

    <script type="text/javascript" src="../../../../assets/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../../../../assets/js/mdb.min.js"></script>
    
    <script type="text/javascript" src="../../../../assets/js/scrollbar.js"></script>

    <script>
        // SideNav Initialization
        $(".button-collapse").sideNav();
            var el =  document.getElementById('menuconscroll')
            var ps = new PerfectScrollbar(el);
        
        new WOW().init();
       </script>

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

} else {    
    header("location: ../../../../");
}
 ?>
