<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'application/common/Alerts.php';

    if ($r = $db->select("cod", "producto", "WHERE td = ".$_SESSION["td"]." ORDER BY id desc limit 1")) { 
        $codigox = $r["cod"] + 1;
    } unset($r);  

?>


<div id="msj"></div>

	<form id="form-proadd">
  
  <div class="form-row">
    <div class="col-md-4 mb-2 md-form">
      <label for="cod">* Codigo Producto</label>
      <input type="text" class="form-control" id="cod" name="cod" value="<?= $codigox ?>" required>
    </div>

  <div class="col-md-8 mb-2 md-form">
      <label for="descripcion">* Descripci&oacuten</label>
      <input type="text" class="form-control" id="descripcion" name="descripcion" required>
    </div>

  </div>


  <div class="form-row">


    <div class="col-md-4 mb-1 md-form">
      <div class="row">
        <div class="col-10">
          <select class="mdb-select md-form colorful-select dropdown-dark" id="proveedor" name="proveedor">
        <?php echo Helpers::SelectData("* Proveedor", "proveedores", "hash", "nombre"); ?>
      </select>
        </div>
        <div class="col-2 mt-4">
          <i class="fas fa-plus-circle fa-2x green-text"></i>
        </div>
      </div>       
    </div>


    <div class="col-md-4 mb-1 md-form">
      <div class="row">
        <div class="col-10">
          <select class="mdb-select md-form colorful-select dropdown-dark" id="categoria" name="categoria">   
        <?php 
       echo Helpers::SelectDataMultiple("* Categoria", 
        "producto_categoria", "hash", "categoria", 
        "categoria",
        "producto_categoria_sub", "hash", "subcategoria", 
          NULL); 
        ?>

        </select>
        </div>
        <div class="col-2 mt-4">
          <i class="fas fa-plus-circle fa-2x green-text"></i>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-1 md-form">
      <div class="row">
        <div class="col-10">
      <select class="mdb-select md-form colorful-select dropdown-dark" id="medida" name="medida">
        <?php echo Helpers::SelectData("* Unidad de Medida", "producto_unidades", "hash", "nombre"); ?>
      </select>
        </div>
        <div class="col-2 mt-4">
          <i class="fas fa-plus-circle fa-2x green-text"></i>
        </div>
      </div>
  </div>


  </div>

  <div class="form-row">
  	
    <div class="col-6 col-md-4 mb-1 md-form">
      <label for="cantidad">* Cantidad</label>
      <input type="number" step="any" class="form-control" id="cantidad" name="cantidad" required>
    </div>

    <div class="col-6 col-md-4 mb-1 md-form">
      <label for="existencia_minima">* Existencia Minima</label>
      <input type="number" class="form-control" id="existencia_minima" name="existencia_minima" required>
    </div>
	
	<div class="col-6 col-md-2 mb-1 md-form">
      	<div class="switch">
            <label>
            * Gravado
              <input type="checkbox" id="gravado" name="gravado" checked="checked">
              <span class="lever"></span>
            </label>
          </div>
    </div>
<?php if($_SESSION["root_receta"] == "on"){ // si esta activada la opcion en root ?>
  <div class="col-6 col-md-2 mb-1 md-form">
        <div class="switch">
            <label>
            * Receta
              <input type="checkbox" id="receta" name="receta">
              <span class="lever"></span>
            </label>
          </div>
    </div>
<?php } ?>
  </div>

  <div class="form-row mt-4">
  	
    <div class="col-md-12 mb-1 md-form">
      <textarea id="informacion" name="informacion" class="md-textarea form-control" rows="3"></textarea>
  		<label for="informacion">Informaci&oacuten adicional</label>
    </div>

  </div>


  <div class="form-row">
	
	<div class="col-6 col-md-3 mb-1 md-form">
      	<div class="switch">
            <label>
             Servicio ||  Off
              <input type="checkbox" id="servicio" name="servicio">
              <span class="lever"></span> On 
            </label>
          </div>
    </div>

	<div class="col-6 col-md-3 mb-1 md-form">
      	<div class="switch">
            <label>
             Compuesto ||  Off
              <input type="checkbox" id="compuesto" name="compuesto">
              <span class="lever"></span> On 
            </label>
          </div>
    </div>

   <div class="col-6 col-md-3 mb-1 md-form">
      	<div class="switch">
            <label>
             Caduca ||  Off
              <input type="checkbox" id="caduca" name="caduca">
              <span class="lever"></span> On 
            </label>
          </div>
    </div>

    <div class="col-6 col-md-3 mb-1 md-form">
      	<div class="switch">
            <label>
             Dependiente ||  Off
              <input type="checkbox" id="dependiente" name="dependiente">
              <span class="lever"></span> On 
            </label>
          </div>
    </div>

  </div>



<!-- solo si tiene activo la opcion de ecommerce se mostrara esta parte -->
<?php 

if($_SESSION['root_ecommerce'] == "on"){
?>
  <div class="form-row mt-5">
  
  <div class="col-4 col-md-4 mb-1 md-form">
        <div class="switch">
            <label>
             Ver en Ecommerce ||  Off
              <input type="checkbox" id="verecommerce" name="verecommerce" checked="checked">
              <span class="lever"></span> On 
            </label>
          </div>
    </div>

  <div class="col-4 col-md-4 mb-1 md-form">
        <div class="switch">
            <label>
             Mostrar Promoción ||  Off
              <input type="checkbox" id="promocion" name="promocion">
              <span class="lever"></span> On 
            </label>
          </div>
    </div>


  <div class="col-4 col-md-4 mb-1 md-form">
        <div class="switch">
            <label>
             Mostrar Ilimitado ||  Off
              <input type="checkbox" id="ilimitado" name="ilimitado">
              <span class="lever"></span> On 
            </label>
          </div>
    </div>


  </div>

<?php }

 ?>










  <div class="form-row mt-5">
  	<div class="col-md-12 md-form text-center">
  	 <button class="btn btn-info" type="submit" id="btn-proadd"><i class="fas fa-save mr-1"></i> Guardar y continuar</button>

  	</div>
  </div>

</form>

<!-- TERMINA FORMULARIO PRINCIPAL -->





<?php 
if($_SESSION["root_autoparts"] == "on"){
 ?>
<!-- para agregar los detalles de autoparts -->
<!-- modal para ver el credito -->
<div class="modal" id="AddAutoParts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-lg z-depth-5" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         AGREGAR DETALLES</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div id="vista"></div>

<!-- ./  content -->
      </div>
      <div class="modal-footer">

        <a id="eliminardatos" op="525" class="btn-floating btn-sm btn-secondary"><i class="fas fa-trash"></i></a>
        <a id="cerrarDetalles" class="btn btn-danger btn-rounded">Omitir Estos Datos</a>
 
   
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->
<?php 
}
 ?>