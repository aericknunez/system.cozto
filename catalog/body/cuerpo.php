<div class="container-fluid">

	<div class="row">

		<div id="container" class="col-xs-8 col-sm-12 col-md-8">
			<?php 
				include_once 'application/src/redirect.php';
			?>
		</div>

		<div id="lateral" class="col-xs-4 col-sm-12 col-md-4 <?php if($datalive != TRUE) echo 'd-none d-md-block'; ?>">
			<?php 
			   include_once 'system/ventas/lateral.php';	
			?>
		</div>

	</div>


</div>

<!-- d-none d-md-block || para desaparecer en pantalla pequena -->