<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Códigos de barras con JavaScript</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
	 crossorigin="anonymous">

</head>

<body>

	<main role="main" class="container">
		<div class="row">
			<div class="col-4" id="app">
				<!-- <svg data-value="7847854544454" data-text="Soy el texto" class="codigo"/></svg> -->
				<div class="text-center">
					<canvas data-value="7847854544454" data-text="Tomate Grande" class="codigo"></canvas>
					<div style="  
					  height: 300px;
					  width: 100%;
					  margin: auto;
					  position: absolute;
					  top: 93%; "	><strong>$1.25</strong></div>
				</div>
			</div>
		</div>
	</main>
	<script src="../../../../assets/js/JsBarcode.all.min.js"></script>
	<script>
		JsBarcode(".codigo")
			.options({
				format: "CODE128",// El formato
				width: 2, // La anchura de cada barra
				height: 100, // La altura del código
				displayValue: true, // ¿Mostrar el valor (como texto) del código de barras?
				text: "Hola", // Texto (no código) que acompaña al barcode
				fontOptions: "bold", // Opciones de la fuente del texto del barcode
				textAlign: "center", // En dónde poner el texto. center, left o right
				textPosition: "bottom", // Poner el texto arriba (top) o abajo (bottom)
				textMargin: 10, // Margen entre el texto y el código de barras
				fontSize: 14, // Tamaño de la fuente
				// background: "#8bc34a", // Color de fondo
				// lineColor: "#FF0000", // Color de cada barra
				marginTop: 10, // Margen superior
				marginRight: 10, // Margen derecho
				marginBottom: 5, // Margen inferior
				marginLeft: 35, // Margen izquierdo
			})
	.init();
	</script>
</body>