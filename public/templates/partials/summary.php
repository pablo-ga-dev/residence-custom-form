<?php

use Crearco\Rcf\I18n\Translator;

?>
<div class="rcf-summary-panel" id="rcf-summary-panel">
	<h3 class="rcf-summary-title"><?php echo esc_html( Translator::translate( 'Tu Configuración' ) ); ?></h3>
	<div class="rcf-summary-items" id="rcf-summary-items" aria-live="polite">
		<p class="rcf-summary-empty"><?php echo esc_html( Translator::translate( 'No has seleccionado ningún pack todavía.' ) ); ?></p>
	</div>
	<div class="rcf-summary-total-row">
		<span class="rcf-summary-total-label"><?php echo esc_html( Translator::translate( 'Total:' ) ); ?></span>
		<span class="rcf-summary-total-value" id="rcf-summary-total">0.00€</span>
	</div>
	<div class="rcf-summary-info-row">
		<span class="rcf-summary-info-label"><?php echo esc_html( Translator::translate( 'Impuestos a determinar' ) ); ?></span>
	</div>
	<button type="submit" name="enviar_pedido_menaki" class="rcf-submit-button"><?php echo esc_html( Translator::translate( 'Solicitar presupuesto' ) ); ?></button>
</div>