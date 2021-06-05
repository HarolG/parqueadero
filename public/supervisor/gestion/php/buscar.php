<h2 class="titulo_informe"><b>GESTION DE USUARIOS</b></h2>
		<table class="celadores_login">
			<thead>
				<tr>
					<td class="head_table">DOCUMENTO</td>
					<td class="head_table">NOMBRE</td>
					<td class="head_table">APELLIDO</td>
					<td class="head_table">TIPO DE USUARIO</td>
					<td class="head_table">ESTADO</td>
					<td class="head_table">OPERACIONES</td>
				</tr>
			</thead>
			<tbody>
				<?php
				$query = "SELECT * FROM usuario, estado_usuario, tipo_usuario 
                            WHERE usuario.id_tip_usu = tipo_usuario.id_tip_usu AND usuario.id_estado_usu = estado_usuario.id_estado_usu AND usuario.id_tip_usu = 2";
				$result_tasks = mysqli_query($mysqli, $query);

				while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
					<tr>
						<td class="body_table"><?php echo $row['documento'] ?></td>
						<td class="body_table"><?php echo $row['nombre'] ?></td>
						<td class="body_table"><?php echo $row['apellido'] ?></td>
						<td class="body_table"><?php echo $row['nom_tip_usu'] ?></td>
						<?php
						if ($row['id_estado_usu'] == 1) {
						?>
							<td class="body_table2" id="estado"><b><?php echo $row['nom_estado_usu'] ?></b></td>
						<?php
						} else if ($row['id_estado_usu'] == 2) {
						?>
							<td class="body_table3" id="estado"><b><?php echo $row['nom_estado_usu'] ?></b></td>
						<?php
						} else {
						?>
							<td class="body_table4" id="estado"><b><?php echo $row['nom_estado_usu'] ?></b></td>
						<?php
						}
						?>

						<td class="body_table">
							<a href="php/habilitar.php?documento=<?php echo $row['documento'] ?>" title="Habilitar" class="eliminarlink">
								<!-- HABILITAR -->
								<i class="fas fa-user-check"></i>
							</a>
							<a href="php/inhabilitar.php?documento=<?php echo $row['documento'] ?>" title="Inhabilitar" class="eliminarlink2">
								<!-- INHABILITAR -->
								<i class="fas fa-user-times"></i>
							</a>
							<a href="php/incapacidad.php?documento=<?php echo $row['documento'] ?>" title="Incapacidad" class="eliminarlink3">
								<i class="fas fa-hand-holding-medical"></i>
							</a>
						</td>
					</tr>
				<?php } ?>
				
			</tbody>