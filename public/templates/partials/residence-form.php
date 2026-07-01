<?php

use Crearco\Rcf\I18n\Translator;

?>
<div class="rcf-customer-form" id="rcf-customer-form">
	<h3 class="rcf-section-title"><?php echo esc_html( Translator::translate( 'Información de entrega' ) ); ?></h3>
	<div class="rcf-form-fields">
		<div class="rcf-form-field">
			<label class="rcf-field-label rcf-sr-only"
				for="rcf-customer-name"><?php echo esc_html( Translator::translate( 'Nombre empresa' ) ); ?></label>
			<input type="text" name="nombre" id="rcf-customer-name" class="rcf-form-input" required
				placeholder="<?php echo esc_attr( Translator::translate( 'Nombre empresa *' ) ); ?>">
		</div>
		<div class="rcf-form-field">
			<label class="rcf-field-label rcf-sr-only"
				for="rcf-customer-cif"><?php echo esc_html( Translator::translate( 'CIF' ) ); ?></label>
			<input type="text" name="cif" id="rcf-customer-cif" class="rcf-form-input" required
				placeholder="<?php echo esc_attr( Translator::translate( 'CIF *' ) ); ?>">
		</div>
		<div class="rcf-form-field">
			<label class="rcf-field-label rcf-sr-only"
				for="rcf-customer-phone"><?php echo esc_html( Translator::translate( 'Teléfono de contacto' ) ); ?></label>
			<input type="tel" name="telefono" id="rcf-customer-phone" class="rcf-form-input" required
				placeholder="<?php echo esc_attr( Translator::translate( 'Teléfono de Contacto *' ) ); ?>">
		</div>
		<div class="rcf-form-field">
			<label class="rcf-field-label rcf-sr-only"
				for="rcf-customer-email"><?php echo esc_html( Translator::translate( 'Correo electrónico' ) ); ?></label>
			<input type="email" name="email" id="rcf-customer-email" class="rcf-form-input" required
				placeholder="<?php echo esc_attr( Translator::translate( 'Correo electrónico *' ) ); ?>">
		</div>
		<div class="rcf-form-field">
			<label class="rcf-field-label rcf-sr-only"
				for="rcf-customer-shipping-address"><?php echo esc_html( Translator::translate( 'Dirección de envío' ) ); ?></label>
			<input type="text" name="direccion_envio" id="rcf-customer-shipping-address" class="rcf-form-input"
				placeholder="<?php echo esc_attr( Translator::translate( 'Dirección de envío' ) ); ?>">
		</div>
		<div class="rcf-form-field">
			<label class="rcf-field-label rcf-sr-only"
				for="rcf-customer-billing-address"><?php echo esc_html( Translator::translate( 'Dirección de facturación' ) ); ?></label>
			<input type="text" name="direccion_facturacion" id="rcf-customer-billing-address" class="rcf-form-input"
				placeholder="<?php echo esc_attr( Translator::translate( 'Dirección de facturación' ) ); ?>">
		</div>
	</div>
</div>