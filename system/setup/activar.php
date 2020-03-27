<?php 
include_once ("system/setup/class.php");
include_once 'application/common/Encrypt.php';
include_once 'application/common/Fechas.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Acivar el Sistema</title>

    <link rel="stylesheet" href="assets/css/font-awesome.css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/mdb.min.css" rel="stylesheet">
    <link href="assets/css/galeria.css" rel="stylesheet">

    <style>body { overflow-x: hidden; padding-left: 15px; }</style>
</head>

<body class="hidden-sn <?php echo SKIN; ?>">
<main>

<div id="mdb-preloader" class="flex-center">
    <div class="preloader-wrapper big active crazy">
        <div class="spinner-layer spinner-blue-only">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="gap-patch">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
</div>

<!-- <div class="container"> -->
<div class="row">

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


<!-- Section: Team v.1 -->
<section class="team-section text-center">
<?php 
// $reg = new Register();
// $clavex = "P001-SV-54051";
// $clave = $reg->SanarClave($clavex);
// $codigo = $reg->ObtenerCodigo($clave, md5($clave));
// echo $clavex . "<br>";
// echo $codigo;
 ?>
<h1>ACTIVACIÓN DEL SISTEMA</h1>


<div class="row md-4 lg-4 d-flex justify-content-center">
  <form class="text-center border border-light p-3" id="form-setup" name="form-setup">
    
<input type="text"  id="nombre" name="nombre" class="form-control mb-3" placeholder="Nombre">
<input type="text"  id="clave" name="clave" class="form-control mb-3" placeholder="Clave" >
<input type="text"  id="codigo" name="codigo" class="form-control mb-3" placeholder="Codigo" >

<button class="btn btn-info my-4" type="submit" id="btn-setup" name="btn-setup">Agregar Registro</button>
 <div id="contenido"></div>
 </form>

</div>


</section>
<!-- Section: Team v.1 -->


	</div>

</div>
<!-- </div> -->



</main>
 
    <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/mdb.min.js"></script>
 

<script>
  $(document).ready(function()
{



  $('#btn-setup').click(function(e){ /// agregar un producto 
  e.preventDefault();
  $.ajax({
      url: "system/setup/action.php",
      method: "POST",
      data: $("#form-setup").serialize(),
      beforeSend: function () {
        $('#btn-setup').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
             // $("#contenido").html('<div class="row justify-content-md-center" ><img src="assets/img/load.gif" alt=""></div>');
            },
      success: function(data){
        $('#btn-setup').html('Agregar Registro').removeClass('disabled');       
        $("#form-setup").trigger("reset");
        $("#contenido").html(data); 
      }
    })
  });
    



$("#form-setup").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
if (e.which == 13) {
return false;
}
});


});
</script> 
<script>
      $(window).on("load", function () {
        $('#mdb-preloader').fadeOut('fast');
    });
</script>

</body>
</html>

