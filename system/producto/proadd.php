<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


    if ($r = $db->select("cod", "producto", "WHERE td = ".$_SESSION["td"]." ORDER BY id desc limit 1")) { 
        $codigox = $r["cod"] + 1;
    } unset($r);  

?>


<div id="msj"></div>

	<form id="form-proadd">
  
  <div class="form-row">
    <div class="col-md-4 mb-2 md-form">
      <label for="cod">* Codigo Producto</label>
      <input type="number" class="form-control" id="cod" name="cod" value="<?= $codigox ?>" required>
    </div>

  <div class="col-md-8 mb-2 md-form">
      <label for="descripcion">* Descripci&oacuten</label>
      <input type="text" class="form-control" id="descripcion" name="descripcion" required>
    </div>

  </div>


  <div class="form-row">


    <div class="col-md-4 mb-1 md-form">
      <select class="mdb-select md-form colorful-select dropdown-dark" id="proveedor" name="proveedor">
        <?php echo Helpers::SelectData("* Proveedor", "proveedores", "hash", "nombre"); ?>
      </select>
    </div>


    <div class="col-md-4 mb-1 md-form">
      <select class="mdb-select md-form colorful-select dropdown-dark" id="categoria" name="categoria">   
        <?php 
       echo Helpers::SelectDataMultiple("* Categoria", 
        "producto_categoria", "hash", "categoria", 
        "categoria",
        "producto_categoria_sub", "hash", "subcategoria", 
          NULL); 
        ?>

        <?php 
        // echo Helpers::SelectData("* Categoria", "producto_categoria_sub", "hash", "subcategoria"); 
        ?>
      </select>
    </div>

    <div class="col-md-4 mb-1 md-form">
        <select class="mdb-select md-form colorful-select dropdown-dark" id="medida" name="medida">
        <?php echo Helpers::SelectData("* Unidad de Medida", "producto_unidades", "hash", "nombre"); ?>
      </select>
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

  <div class="form-row">
  	
    <div class="col-md-12 mb-1 md-form mt-4">
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
  
  <div class="col-6 col-md-6 mb-1 md-form">
        <div class="switch">
            <label>
             Ver en Ecommerce ||  Off
              <input type="checkbox" id="verecommerce" name="verecommerce" checked="checked">
              <span class="lever"></span> On 
            </label>
          </div>
    </div>

  <div class="col-6 col-md-6 mb-1 md-form">
        <div class="switch">
            <label>
             Mostrar Promocion ||  Off
              <input type="checkbox" id="promocion" name="promocion">
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
