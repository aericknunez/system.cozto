<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/reportes/Kardex.php';
?>

  <div class="row justify-content-md-center">
    <div class="col-md-4 col-md-auto">
        <form name="form-mensual" method="post" id="form-mensual">

        	<select name="mes" id="mes" class="browser-default form-control my-2">
    <option value="01" <? if ($fecha=date("m")=="01") echo "selected='selected'"; ?>>Enero</option>
    <option value="02" <? if ($fecha=date("m")=="02") echo "selected='selected'"; ?>>Febrero</option>
    <option value="03" <? if ($fecha=date("m")=="03") echo "selected='selected'"; ?>>Marzo</option>
    <option value="04" <? if ($fecha=date("m")=="04") echo "selected='selected'"; ?>>Abril</option>
    <option value="05" <? if ($fecha=date("m")=="05") echo "selected='selected'"; ?>>Mayo</option>
    <option value="06" <? if ($fecha=date("m")=="06") echo "selected='selected'"; ?>>Junio</option>
    <option value="07" <? if ($fecha=date("m")=="07") echo "selected='selected'"; ?>>Julio</option>
    <option value="08" <? if ($fecha=date("m")=="08") echo "selected='selected'"; ?>>Agosto</option>
    <option value="09" <? if ($fecha=date("m")=="09") echo "selected='selected'"; ?>>Septiembre</option>
    <option value="10" <? if ($fecha=date("m")=="10") echo "selected='selected'"; ?>>Octubre</option>
    <option value="11" <? if ($fecha=date("m")=="11") echo "selected='selected'"; ?>>Noviembre</option>
    <option value="12" <? if ($fecha=date("m")=="12") echo "selected='selected'"; ?>>Diciembre</option>
  </select>
    <select name="ano" id="ano" class="browser-default form-control my-2">
    <option value="2018" <? if ($fecha=date("Y")=="2018") echo "selected='selected'"; ?>>2018</option>
    <option value="2019" <? if ($fecha=date("Y")=="2019") echo "selected='selected'"; ?>>2019</option>
    <option value="2020" <? if ($fecha=date("Y")=="2020") echo "selected='selected'"; ?>>2020</option>
    <option value="2021" <? if ($fecha=date("Y")=="2021") echo "selected='selected'"; ?>>2021</option>
    <option value="2022" <? if ($fecha=date("Y")=="2022") echo "selected='selected'"; ?>>2022</option>
    <option value="2023" <? if ($fecha=date("Y")=="2023") echo "selected='selected'"; ?>>2023</option>
    <option value="2024" <? if ($fecha=date("Y")=="2024") echo "selected='selected'"; ?>>2024</option>
    <option value="2025" <? if ($fecha=date("Y")=="2025") echo "selected='selected'"; ?>>2025</option>
  </select>

    </div>
  </div>

 <input type="hidden" id="cod" name="cod" value="<? echo $_REQUEST["key"] ?>" />
  <div class="row justify-content-center">
    <button class="btn btn-info my-2 btn-rounded btn-sm waves-effect" type="submit" id="btn-mensual" name="btn-mensual">Mostrar Datos</button>

      </form> 
  </div>



<div id="contenido" class="mt-5">
<?php 
// Alerts::Mensajex("Seleccione un mes para mostrar los registros","info",$boton,$boton2);
$kardex = new Kardex();
$kardex->verDatos($_REQUEST["key"], date("m-Y"));
 ?>
</div>