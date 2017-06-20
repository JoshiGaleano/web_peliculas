<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Películas</title>

		<link rel="stylesheet" type='text/css' href='<?= base_url() ?>dist/css/bootstrap.min.css'>
		<link rel="stylesheet" type='text/css' href='<?= base_url() ?>dist/css/style.css'>
	</head>
	<body>

		<div class="container">
			<section class="row">
				<h1 class="text-center">Películas</h1>
				<!--<pre><?= print_r($peliculas) ?></pre>-->
				<div class="row">
					<div class="col-md-12">
						<table class="table table-responsive">
						 	<thead>
						 		<tr>
						 			<th>Película</th> 
						 			<th>Categoría</th> 
						 			<th>Valoración cliente</th> 
						 			<th># Clientes</th>
						 			<th>Valoración media</th>
						 			<th>Opciones</th>
						 		</tr>
						 	</thead>
						 	<tbody>
						 		<?php foreach ($peliculas as $pelicula): ?>
							 		<tr>
							 			<td><?= $pelicula->nombre ?></td> 
							 			<td><?= $pelicula->categoria ?></td> 
							 			<td><?= $pelicula->calificacion ?></td> 
							 			<td><?= $pelicula->nclientes ?></td>
							 			<td><?= $pelicula->media ?></td>
							 			<td>
							 				<?php if ($pelicula->calificacion == ''): ?>
							 					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" data-id="<?= $pelicula->id ?>" data-pelicula="<?= $pelicula->nombre ?>" data-valoracion="">
												  Crear valoración
												</button>
							 				<?php else: ?>
							 					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-id="<?= $pelicula->id ?>" data-pelicula="<?= $pelicula->nombre ?>" data-valoracion="<?= $pelicula->calificacion ?>">
												  Editar valoración
												</button>
							 					<button type="button" class="btn btn-danger eliminar" data-id="<?= $pelicula->id ?>">Eliminar valoración</button>
							 				<?php endif; ?>		
							 			</td>
							 		</tr>
						 		<?php endforeach; ?>
						 	</tbody>
						</table>
					</div>
					<div class="col-md-12 text-center">
						<a href="<?= base_url(); ?>clientes" class="btn btn-primary m-20">Cambiar cliente</a>
					</div>
				</div>
			</section>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
				    <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
				    </div>
				    <div class="modal-body">
				        <div class="form-group">
						    <label for="exampleInputEmail1">Valoración de la película</label>
						    <select class="form-control" id="valoracion">
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
							</select>
						</div>
				    </div>
				    <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				        <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
				    </div>
			    </div>
			</div>
		</div>

		<script type="text/javascript" src="<?= base_url() ?>dist/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?= base_url() ?>dist/js/bootstrap.min.js"></script>

		<script type="text/javascript">
			base_url = '<?= base_url(); ?>';

			function ajax(url,data,done,error){
			    $.ajax({
			        url: base_url+url,
			        context : document.body,
			        dataType: "json",
			        type: "POST",
			        data: data,
			        success: done,
			        error: error
			    });
			}

		</script>

		<script type="text/javascript">
			id = "<?= $id ?>";
			pelicula = '';

			var _peliculas = (function(){
				var _init = function(){
				    setEvents();
				}

				var setEvents = function(){
					$('#myModal').on('show.bs.modal', function (event) {
						var button = $(event.relatedTarget);
						pelicula = button.data('id');
						var recipient = button.data('pelicula');
						var valoracion = button.data('valoracion');
						var modal = $(this);
						modal.find('.modal-title').text(recipient);
						modal.find('.modal-body input').val(recipient);

						if(valoracion != ""){
							$('#valoracion option:eq('+valoracion+')').prop('selected', true)
						}
					})

					$( "#guardar" ).bind( "click", function(e){
				        e.preventDefault();
				        guardar();
				    });

				    $(document).on("click", ".eliminar", function(e){
				        e.preventDefault();
				        var pelicula = $(this).attr("data-id");
				        eliminar(pelicula);
				    });
				}

				var guardar = function(){
					$('#myModal').modal('hide');

					ajax(
				        'valoraciones/guardar',
				        {   
				            valoracion : $("#valoracion").val(),
				            cliente : id,
				            pelicula : pelicula
				        },
				        function( response ){
				            alert(response.msj);

				            location.reload();
				        },function(){
				              alert('Ha ocurrido un error, verifica tu conexión e intenta nuevamente.');
				        }
				    );

				}

				var eliminar = function(idpeli){
					console.log(idpeli)
					var r = confirm("Estás seguro de eliminar la valoración de esta película!");

					if (r == true) {
					    ajax(
					        'valoraciones/eliminar',
					        {   
					            cliente : id,
					            pelicula : idpeli
					        },
					        function( response ){
					            alert(response.msj);

					            location.reload();
					        },function(){
					              alert('Ha ocurrido un error, verifica tu conexión e intenta nuevamente.');
					        }
					    );
					}

				}

				return {
			      	init : _init
			    }

			})();

			$(function () {
			    _peliculas.init();
			});
		</script>

	</body>
</html>