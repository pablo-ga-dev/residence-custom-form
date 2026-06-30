<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:20px;">
	<tr>
		<td align="center">

			<table width="600" cellpadding="0" cellspacing="0"
				style="background:#ffffff; border-radius:8px; overflow:hidden;">

				<tr>
					<td style="background:#222; color:#ffffff; padding:20px;">
						<h1 style="margin:0; font-size:22px;">Nuevo pedido para residencia</h1>
					</td>
				</tr>

				<tr>
					<td style="padding:20px;">
						<h2 style="font-size:18px;">Datos de la empresa</h2>

						<p><strong>Nombre empresa:</strong> <?php echo $data['nombre_empresa']; ?></p>
						<p><strong>CIF:</strong> <?php echo $data['cif']; ?></p>
						<p><strong>Email:</strong> <?php echo $data['email']; ?></p>
						<p><strong>Teléfono:</strong> <?php echo $data['phone']; ?></p>

						<h2 style="font-size:18px; margin-top:30px;">Direcciones</h2>

						<p>
							<strong>Dirección de envío:</strong><br>
							<?php echo $data['direccion_envio']; ?>
						</p>

						<p>
							<strong>Dirección de facturación:</strong><br>
							<?php echo $data['direccion_facturacion']; ?>
						</p>

						<h2 style="font-size:18px; margin-top:30px;">Productos</h2>

						<table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse;">
							<thead>
								<tr style="background:#eeeeee;">
									<th align="left">Producto</th>
									<th align="left">Referencia</th>
									<th align="center">Cantidad</th>
									<th align="right">Precio</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $data['productos'] as $producto ) : ?>
									<tr>
										<td style="border-bottom:1px solid #dddddd;"><?php echo $producto['nombre']; ?></td>
										<td style="border-bottom:1px solid #dddddd;">
											<?php echo ! empty( $producto['referencia'] ) ? $producto['referencia'] : '-'; ?>
										</td>
										<td align="center" style="border-bottom:1px solid #dddddd;">
											<?php echo $producto['cantidad']; ?></td>
										<td align="right" style="border-bottom:1px solid #dddddd;">
											<?php echo $producto['precio']; ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>

						<p style="font-size:20px; text-align:right; margin-top:30px;">
							<strong>Total del pedido: <?php echo $data['total_pedido']; ?></strong>
						</p>
					</td>
				</tr>

			</table>

		</td>
	</tr>
</table>