<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/autoparts/AutopartsOp.php';
$auto = new Autoparts(); 
?>


<!-- Classic tabs -->
<div class="classic-tabs">

  <ul class="nav tabs-cyan" id="myClassicTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link  waves-light active show" id="steps-tab-classic" data-toggle="tab" href="#steps-classic"
        role="tab" aria-controls="steps-classic" aria-selected="true">MARCAS</a>
    </li>
    <li class="nav-item">
      <a class="nav-link waves-light" id="unidades-tab-classic" data-toggle="tab" href="#unidades-classic" role="tab"
        aria-controls="unidades-classic" aria-selected="false">MODELOS</a>
    </li>
    <li class="nav-item">
      <a class="nav-link waves-light" id="caracteristicas-tab-classic" data-toggle="tab" href="#caracteristicas-classic" role="tab"
        aria-controls="caracteristicas-classic" aria-selected="false">MOTORES</a>
    </li>

  </ul>
  <div class="tab-content border-right border-bottom border-left rounded-bottom" id="myClassicTabContent">
    <div class="tab-pane fade active show" id="steps-classic" role="tabpanel" aria-labelledby="steps-tab-classic">

      <?php Alerts::Mensaje("Ingrese las marcas que desea regisrar","success",$boton,$boton2); ?>


		<div class="row">
		    <div class="col-md-6 btn-outline-info z-depth-2" id="zonamarca">
                
        <!-- Inicia Formulario -->
                <form id="form-addmarca">
  
                  <div class="form-row">
                    <div class="col-md-8 mb-2 md-form">
                      <label for="cod">Marca</label>
                      <input type="text" class="form-control" id="marca" name="marca" required>
                    </div>

                  <div class="col-md-4 mb-4 md-form">
                      <button class="btn-floating btn-sm btn-secondary" type="submit" id="btn-addmarca"><i class="fa fa-plus"></i></button>
                    </div>

                  </div>

              </form>
        <!-- Termina Formulario -->

		    </div>
		    
		    <div class="col-md-6 btn-outline-danger z-depth-2" id="destinomarca">
		        <?php 
		           $auto->VerMarca();        
		         ?>
		    </div>
		   
		</div>

    </div> <!-- termina tab -->


    <div class="tab-pane fade" id="unidades-classic" role="tabpanel" aria-labelledby="unidades-tab-classic">
      <?php Alerts::Mensaje("Modelos de sus vehiculos","success",$boton,$boton2); ?>
         
		<div class="row">
		    <div class="col-md-6 btn-outline-info z-depth-2" id="zonamodelo">
                
                  <!-- Inicia Formulario -->
                <form id="form-addmodelos">
  
                    <div class="col-md-12 mb-2 md-form">
                      <label for="cod">Modelo</label>
                      <input type="text" class="form-control" id="modelo" name="modelo" required>
                    </div>

                  <div class="col-md-12 mb-2 md-form">
                    <select class="mdb-select md-form colorful-select dropdown-dark" id="marca-modelo" name="marca-modelo">
                      <?php echo Helpers::SelectData("Marca", "autoparts_marca", "hash", "marca"); ?>
                    </select>
                  </div>


                  <div class="col-md-12 text-center">
                           <button class="btn btn-info" type="submit" id="btn-addmodelos"><i class="fas fa-save mr-1"></i> Guardar</button>
                  </div>


              </form>
        <!-- Termina Formulario -->

		    </div>
		    
		    <div class="col-md-6 btn-outline-danger z-depth-2" id="destinomodelo">
		        <?php 
		            $auto->VerModelo();        
		         ?>
		    </div>
		   
		</div>

    </div> <!-- termina tab -->


    <div class="tab-pane fade" id="caracteristicas-classic" role="tabpanel" aria-labelledby="caracteristicas-tab-classic">
      <?php Alerts::Mensaje("Ingrese tipos de motores","success",$boton,$boton2); ?>

		<div class="row">
		    <div class="col-md-6 btn-outline-info z-depth-2" id="zonamotores">
                
                  <!-- Inicia Formulario -->
                <form id="form-addmotor">
  
                    <div class="col-md-12 mb-2 md-form">
                      <label for="cod">Motor</label>
                      <input type="text" class="form-control" id="motor" name="motor" required>
                    </div>

                  <div class="col-md-12 mb-2 md-form">
                    <select class="mdb-select md-form colorful-select dropdown-dark" id="marca-motor" name="marca-motor">
                      <?php echo Helpers::SelectData("Marca", "autoparts_marca", "hash", "marca"); ?>
                    </select>
                  </div>


                  <div class="col-md-12 text-center">
                           <button class="btn btn-info" type="submit" id="btn-addmotor"><i class="fas fa-save mr-1"></i> Guardar</button>
                  </div>


              </form>
        <!-- Termina Formulario -->

		    </div>
		    
		    <div class="col-md-6 btn-outline-danger z-depth-2" id="destinomotor">
		        <?php 
		            $auto->VerMotor();        
		         ?>
		    </div>
		   
		</div>

    </div> <!-- termina tab -->



  </div>

</div>
<!-- Classic tabs -->


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
        <a id="btn-modal" class="btn  btn-outline-danger">Eliminar</a>
        <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmDelete-->