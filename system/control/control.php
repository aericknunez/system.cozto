<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/control/Controles.php';
include_once 'system/corte/Corte.php';
include_once 'application/common/Fechas.php';
require_once 'system/credito/Creditos.php';

$cut = new Corte();

$control = new Controles();
$credito = new Creditos(); 
?>



<div class="container">
    
    <div class="row">

    <div class="col-xl-3 col-md-6 mb-4  col-sm-6 col-6">
      <div class="card-counter light">
        <i class="fas fa-barcode"></i>
        <span class="count-numbers"><h5 class="font-weight-bold"><?php echo $control->Clave(); ?></h5></span>
        <span class="count-name">
          <?php if($_SESSION["user"] == "Erick"){
            echo Helpers::CodigoValidacionHora(); 
          } else {
            echo "Codigo";
          } ?>
        </span>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4  col-sm-6 col-6">
      <div class="card-counter light">
        <i class="fas fa-home"></i>
        <span class="count-numbers"><h5 class="font-weight-bold"><?php echo Helpers::Dinero($cut->GastoHoy(date("d-m-Y"))); ?></h5></span>
        <span class="count-name">Gastos Hoy</span>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4  col-sm-6 col-6">
      <div class="card-counter light">
        <i class="fas fa-dollar-sign"></i>
        <span class="count-numbers"><h5 class="font-weight-bold"><?php echo Helpers::Dinero($cut->VentaHoy(date("d-m-Y"))); ?></h5></span>
        <span class="count-name">Ventas Hoy</span>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4  col-sm-6 col-6">
      <div class="card-counter light">
        <i class="fa fa-users"></i>
        <span class="count-numbers"><h5 class="font-weight-bold"><?php echo Helpers::Dinero($cut->EfectivoDebido(date("d-m-Y"))); ?></h5></span>
        <span class="count-name">Flujo de caja</span>
      </div>
    </div>


  </div>


<!-- Division -->


  <div class="row">

    <div class="col-xl-3 col-md-6 mb-4  col-sm-6 col-6">
      <div class="card-counter info">
        <i class="fas fa-barcode"></i>
        <span class="count-numbers"><h5 class="font-weight-bold"><?php echo Helpers::Dinero($credito->CreditoPendiente()); ?></h5></span>
        <span class="count-name">Creditos Por Cobrar</span>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4  col-sm-6 col-6">
      <div class="card-counter info">
        <i class="fas fa-home"></i>
        <span class="count-numbers"><h5 class="font-weight-bold"><?php echo Helpers::Dinero($cut->TotalAbonos(date("d-m-Y"))); ?></h5></span>
        <span class="count-name">Abonos de Créditos</span>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4  col-sm-6 col-6">
      <div class="card-counter info">
        <i class="fas fa-dollar-sign"></i>
        <span class="count-numbers"><h5 class="font-weight-bold"><?php echo Helpers::Dinero($control->CuentasPendientes()); ?></h5></span>
        <span class="count-name">Cuentas por Pagar</span>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4  col-sm-6 col-6">
      <div class="card-counter info">
        <i class="fa fa-users"></i>
        <span class="count-numbers"><h5 class="font-weight-bold"><?php echo Helpers::Dinero($control->TotalAbonosCuentas(date("d-m-Y"))); ?></h5></span>
        <span class="count-name">Abonos a Cuentas</span>
      </div>
    </div>


  </div>


<!-- Division -->

  <div class="row">

    <div class="col-xl-3 col-md-6 mb-4  col-sm-6 col-6">
      <div class="card-counter primary">
        <i class="fas fa-barcode"></i>
        <span class="count-numbers"><h5 class="font-weight-bold"><?php echo Helpers::Entero($cut->ProductosHoy(date("d-m-Y"))); ?></h5></span>
        <span class="count-name">Productos vendidos hoy</span>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4  col-sm-6 col-6">
      <div class="card-counter danger">
        <i class="fas fa-home"></i>
        <span class="count-numbers"><h5 class="font-weight-bold"><?php echo $cut->ClientesHoy(date("d-m-Y")); ?></h5></span>
        <span class="count-name">Clientes Atendidos Hoy</span>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4  col-sm-6 col-6">
      <div class="card-counter success">
        <i class="fas fa-dollar-sign"></i>
        <span class="count-numbers"><h5 class="font-weight-bold"><?php echo Helpers::Entero($control->TotalProductos()); ?></h5></span>
        <span class="count-name">Productos Existentes</span>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4  col-sm-6 col-6">
      <div class="card-counter success">
        <i class="fas fa-dollar-sign"></i>
        <span class="count-numbers"><h5 class="font-weight-bold"><?php echo Helpers::Dinero($control->ValorInventario()); ?></h5></span>
        <span class="count-name">Valor Inventario</span>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4  col-sm-6 col-6">
      <div class="card-counter info">
        <i class="fa fa-users"></i>
        <span class="count-numbers"><h5 class="font-weight-bold"><?php echo Helpers::Dinero($control->DescuentosHoy(date("d-m-Y"))); ?></h5></span>
        <span class="count-name">Descuentos Otorgados Hoy</span>
      </div>
    </div>

    <?php if(($_SESSION['config_restringir_descuento'])): ?>

<div class="col-xl-3 col-md-6 mb-4  col-sm-6 col-6">
  <div class="card-counter light">
    <i class="fas fa-barcode"></i>
    <span class="count-numbers"><h5 class="font-weight-bold"><?php echo Helpers::CodigoValidacionDescuento(); ?></h5></span>
    <span class="count-name">Codigo Descuentos</span>
  </div>
</div>
<?php endif ;?>

  </div>
</div>

<canvas id="barChart" class="mb-4"></canvas>