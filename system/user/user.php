<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/user/Usuarios.php';
?>
<h1>Usuarios </h1>

<div id="msj"></div>
<!-- informacion de eliminado -->
<div id="lista_usuarios">
  <?php 
   Usuarios::VerUsuarios($_SESSION["ver_avatar"]);
   ?>
</div> 


<?php 
if($_SESSION['tipo_cuenta'] == 1 or $_SESSION['tipo_cuenta'] == 2 or (Helpers::ServerDomain() == FALSE and $_SESSION['tipo_cuenta'] == 5)){
echo '<a id="u_registrar" class="btn-floating btn-sm blue-gradient"><i class="fa fa-user-plus"></i></a> AGREGAR';	
}
 ?>



<!-- Ver AGREGAR -->
<div class="modal" id="ModalAgregar" tabindex="-1" role="dialog" aria-labelledby="ModalAgregar" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         AGREGAR USUARIO</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div id="vista_agregar">
	
        
<form id="form-registrar" name="form-registrar">
<input type="text" name="nombre" id="nombre" class="my-2 form-control" placeholder="Nombre"/>
<input type="text" name="email" id="email" class="my-2 form-control" placeholder="email"/>
<input type="password" name="password" id="password" class="my-1 form-control" placeholder="Password"/>
<input type="password" name="confirmpwd" id="confirmpwd" class="my-1 form-control" placeholder="Confirmar Password"/>

<select id="tipo" name="tipo" class="browser-default form-control" required="yes">
<option value="" disabled selected>Elija una Opcion</option>
<option <? 
if($_SESSION['tipo_cuenta'] == 3 or $_SESSION['tipo_cuenta'] == 4 or (Helpers::ServerDomain() == TRUE and $_SESSION['tipo_cuenta'] == 5)) echo "disabled"; ?> value="2"><?php echo Helpers::UserName(2) ?></option>
<option <? 
if($_SESSION['tipo_cuenta'] == 3 or (Helpers::ServerDomain() == TRUE and $_SESSION['tipo_cuenta'] == 5)) echo "disabled"; ?> value="3"><?php echo Helpers::UserName(3) ?></option>
<option <? 
if($_SESSION['tipo_cuenta'] == 4 or (Helpers::ServerDomain() == TRUE and $_SESSION['tipo_cuenta'] == 5)) echo "disabled"; ?> value="4"><?php echo Helpers::UserName(4) ?></option>
<option <? 
if($_SESSION['tipo_cuenta'] != 1) echo "disabled"; ?> value="5"><?php echo Helpers::UserName(5) ?></option>
</select>

<input type="button" value="Registrar" class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" id="btn-registrar" name="btn-registrar"/> 
</form>


</div>

<!-- ./  content -->
      </div>
      <div class="modal-footer">

<a id="cerrarmodal" class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>
         
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->











<!-- MODAL PARA CONFIRMAR ELIMINACION -->

<div class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">Seguro que desea eliminar este elemento?</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="fas fa-times fa-4x animated rotateIn"></i>

      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <a id="deluser" class="btn  btn-outline-danger">Eliminar</a>
        <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmDelete-->







<!-- Ver AGREGAR -->
<div class="modal" id="ModalAvatar" tabindex="-1" role="dialog" aria-labelledby="ModalAvatar" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         CAMBIAR AVATAR</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div id="vista_avatar">
	

</div>

<!-- ./  content -->
      </div>
      <div class="modal-footer">

<a id="cerrarmodal" class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>
         
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->










<!-- Ver AGREGAR -->
<div class="modal" id="ModalPass" tabindex="-1" role="dialog" aria-labelledby="ModalPass" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         CAMBIAR PASSWORD</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<form name="form-changepass" method="post" id="form-changepass">
<div class="row justify-content-md-center">
    <div class="col-12 col-md-auto">
<div id="vista_password"></div>
<input name="btn-changepass" type="submit" id="btn-changepass" value="Cambiar" class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-1 waves-effect">

    </div>
  </div>
</form>
<!-- ./  content -->
      </div>
      <div class="modal-footer">

<a id="cerrarmodal" class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>
         
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->






<!-- Ver AGREGAR -->
<div class="modal" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="ModalUpdate" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         ACTUALIZAR USUARIO</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<form id="form-actualizar" name="form-actualizar">


<div id="vista_update"></div>


    <div class="text-center mt-2">
       <button class="btn btn-outline-warning" type="submit" id="btn-actualizar" name="btn-actualizar">Actualizar<i class="fa fa-paper-plane-o ml-2"></i></button>
    </div>
</form>
<!-- ./  content -->
      </div>
      <div class="modal-footer">

<a id="cerrarmodal" class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>
         
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->