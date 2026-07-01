<?php

namespace Crearco\Rcf\Includes;

use Crearco\Rcf\Config;
use Crearco\Rcf\I18n\Translator;

class AssetsManager {
	private static Config $config;

	public function __construct( Config $config ) {
		self::$config = $config;
	}

	private static function getUrl( string $path ) {
		return self::$config->assets_url() . $path;
	}

	public function enqueue_scripts() {
		wp_enqueue_script(
			'rcf-app',
			self::getUrl( 'js/app.js' ),
			array(),
			Config::VERSION,
			true
		);

		wp_localize_script(
			'rcf-app',
			'rcfData',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'rcf_submit_order' ),
				'i18n' => array(
					'genericError' => Translator::translate( 'Error al enviar el pedido. Por favor, intentalo de nuevo o pongase en contacto con nosotros si el problema persiste.' ),
					'emptySelection' => Translator::translate( 'No has seleccionado ningún pack todavía.' ),
					'ajaxNotAvailable' => Translator::translate( 'Configuracion AJAX no disponible.' ),
					'minimumProduct' => Translator::translate( 'Debes seleccionar al menos un producto.' ),
					'successOrder' => Translator::translate( 'Tu pedido se ha enviado correctamente! En breve nos pondremos en contacto contigo para confirmar los detalles y el pago. ¡Gracias por confiar en nosotros!' ),
					'lightboxAlt' => Translator::translate( 'Vista ampliada de producto' ),
				),
			)
		);
	}

	public function enqueue_styles() {
		wp_enqueue_style(
			'rcf-style',
			self::getUrl( 'css/styles.css' ),
			array(),
			Config::VERSION
		);
	}
}