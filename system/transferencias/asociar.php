<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/transferencias/Transferencias.php';
$transferencias = new Transferencias(); 
?>

<div id="msj"></div>

<div class="clearfix">
  <h2 class="h2-responsive float-left">ASOCIAR CUENTAS || <?php echo $_SESSION["config_cliente"] ?></h2> 
  <h2 class="h2-responsive float-right"></h2>
</div>
<hr class="z-depth-1-half mb-3">

<div class="row">
    <div class="col-md-6 btn-outline-info z-depth-2">
         
        <form class="text-center border border-light p-3" id="form-asociar" name="form-asociar">

        <input type="hidden" name="s1" id="s1" value="<?php echo $_SESSION["td"]; ?>">
        <select class="browser-default custom-select mb-3" id="s2" name="s2">
                <?php 
                $transferencias->ClientesRegistrados(URL_TRANSFERENCIA .'?op=23');
                 ?>
        </select>

        <button class="btn btn-info my-4" type="submit" id="btn-asociar" name="btn-asociar">Agregar Sucursal</button>
         </form>


    </div>
    
    <div class="col-md-6 btn-outline-secondary z-depth-2" id="destinos">
        <?php 
        $transferencias->MisCuentas(URL_TRANSFERENCIA .'?op=19&origen=' . $_SESSION["td"]);
         ?>
    </div>
   
</div>