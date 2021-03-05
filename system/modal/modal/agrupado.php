<div class="modal" id="<? echo $_GET["modal"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          VENTA AGRUPADA</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->
<div class="row d-flex justify-content-center">
  <div class="col-md-12">
<form class="text-center border border-light p-3" id="form-agrupado" name="form-agrupado">

<input type="text" name="producto" id="producto" class="form-control mb-3" placeholder="Nombre del producto">
<input type="hidden" name="agrupado" id="agrupado" value="agrupado">

<input type="number" step="any" id="precio" name="precio" class="form-control mb-3" placeholder="Precio">
<button class="btn btn-info my-4" type="submit" id="btn-agrupado" name="btn-agrupado">Agregar Producto</button>
 </form>

  </div>
</div>

PRODUCTOS AGREGADOS:


<div id="msj"></div>
<!-- ./  content -->
      </div>
      <div class="modal-footer">

          <a href="?" class="btn btn-primary btn-rounded">Regresar</a>
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->