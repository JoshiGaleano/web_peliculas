<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Clientes</title>

		<link rel="stylesheet" type='text/css' href='<?= base_url() ?>dist/css/bootstrap.min.css'>
		<link rel="stylesheet" type='text/css' href='<?= base_url() ?>dist/css/style.css'>
	</head>
	<body>

		<div class="container">
			<section class="row centered">
				<h1 class="text-center">Clientes</h1>
				<div class="row">
					<div class="col-md-12">
						<select class="form-control" id="clientes">
							<option value="">Seleccione un cliente</option>
							<?php foreach ($clientes as $cliente): ?>
								<option value="<?= $cliente->id ?>"><?= $cliente->nombre ?> <?= $cliente->apellidos ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-12 text-center">
						<button type="button" class="btn btn-primary m-20" id="continuar">Continuar</button>
					</div>
				</div>
			</section>
		</div>

		<script type="text/javascript" src="<?= base_url() ?>dist/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?= base_url() ?>dist/js/bootstrap.min.js"></script>

		<script type="text/javascript">
		base_url = "<?= base_url() ?>";

			(function(){
				var init = function(){
				    setEvents();
				}

				var setEvents = function(){
					$( "#continuar" ).bind( "click", function(e){
				        e.preventDefault();
				        continuar();
				    });
				}

				var continuar = function(){
					var cliente = $("#clientes").val();
					if(cliente != ""){
						window.location = base_url+'peliculas/'+cliente;
					}
					else{
						alert("Debes escoger un cliente");
					}
				}

				$(document).ready(function(){

		        init();
				})
			})();
		</script>

	</body>
</html>