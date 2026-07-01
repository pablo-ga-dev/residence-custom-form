<?php

use Crearco\Rcf\I18n\Translator;

?>
<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:20px;">
	<tr>
		<td align="center">

			<table width="600" cellpadding="0" cellspacing="0"
				style="background:#ffffff; border-radius:8px; overflow:hidden;">

				<tr>
					<td style="background:#222; color:#ffffff; padding:20px;">
						<h1 style="margin:0; font-size:22px;">
							<?php echo esc_html( Translator::translate( 'Nuevo pedido para residencia' ) ); ?></h1>
					</td>
				</tr>

				<tr>
					<td style="padding:20px;">
						<h2 style="font-size:18px;">
							<?php echo esc_html( Translator::translate( 'Datos de la empresa' ) ); ?></h2>

						<p><strong><?php echo esc_html( Translator::translate( 'Nombre empresa' ) ); ?>:</strong>
							<?php echo esc_html( $data['nombre_empresa'] ); ?></p>
						<p><strong><?php echo esc_html( Translator::translate( 'CIF' ) ); ?>:</strong>
							<?php echo esc_html( $data['cif'] ); ?></p>
						<p><strong><?php echo esc_html( Translator::translate( 'Email:' ) ); ?></strong>
							<?php echo esc_html( $data['email'] ); ?></p>
						<p><strong><?php echo esc_html( Translator::translate( 'Teléfono:' ) ); ?></strong>
							<?php echo esc_html( $data['phone'] ); ?></p>

						<h2 style="font-size:18px; margin-top:30px;">
							<?php echo esc_html( Translator::translate( 'Direcciones' ) ); ?></h2>

						<p>
							<strong><?php echo esc_html( Translator::translate( 'Dirección de envío:' ) ); ?></strong><br>
							<?php echo nl2br( esc_html( $data['direccion_envio'] ) ); ?>
						</p>

						<p>
							<strong><?php echo esc_html( Translator::translate( 'Dirección de facturación:' ) ); ?></strong><br>
							<?php echo nl2br( esc_html( $data['direccion_facturacion'] ) ); ?>
						</p>

						<h2 style="font-size:18px; margin-top:30px;">
							<?php echo esc_html( Translator::translate( 'Productos' ) ); ?></h2>

						<table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse;">
							<thead>
								<tr style="background:#eeeeee;">
									<th align="left"><?php echo esc_html( Translator::translate( 'Producto' ) ); ?></th>
									<th align="left"><?php echo esc_html( Translator::translate( 'Referencia' ) ); ?>
									</th>
									<th align="center"><?php echo esc_html( Translator::translate( 'Cantidad' ) ); ?>
									</th>
									<th align="right"><?php echo esc_html( Translator::translate( 'Precio' ) ); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $data['productos'] as $producto ) : ?>
									<tr>
										<td style="border-bottom:1px solid #dddddd;">
											<?php echo esc_html( $producto['nombre'] ); ?></td>
										<td style="border-bottom:1px solid #dddddd;">
											<?php echo esc_html( ! empty( $producto['referencia'] ) ? $producto['referencia'] : '-' ); ?>
										</td>
										<td align="center" style="border-bottom:1px solid #dddddd;">
											<?php echo esc_html( (string) $producto['cantidad'] ); ?>
										</td>
										<td align="right" style="border-bottom:1px solid #dddddd;">
											<?php echo esc_html( number_format( (float) $producto['precio'], 2 ) . ' EUR' ); ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>

						<p style="font-size:20px; text-align:right; margin-top:30px;">
							<strong><?php echo esc_html( Translator::translate( 'Total del pedido: %s', [ number_format( (float) $data['total_pedido'], 2 ) . ' EUR' ] ) ); ?></strong>
						</p>
					</td>
				</tr>

			</table>

		</td>
	</tr>
</table>