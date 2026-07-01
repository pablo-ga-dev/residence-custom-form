<?php

namespace Crearco\Rcf\Services;

use Crearco\Rcf\Config;
use Crearco\Rcf\I18n\Translator;

class MailSender {
	private static Config $config;

	public function __construct( Config $config ) {
		self::$config = $config;
	}

	private function getTemplatePath( string $templateName ): string {
		return self::$config->templates_path() . $templateName;
	}

	public function submit(): void {
		if ( ! check_ajax_referer( 'rcf_submit_order', '_ajax_nonce', false ) ) {
			wp_send_json_error( [ 'message' => Translator::translate( 'Nonce invalido.' ) ], 403 );
		}

		try {
			$to = 'pablo.ga@benowu.com';
			$subject = Translator::translate( 'Nuevo pedido de residencia' );
			$raw_post = wp_unslash( $_POST );
			$data = $this->prepareData( $raw_post );

			if ( empty( $data['email'] ) || empty( $data['nombre_empresa'] ) ) {
				wp_send_json_error( [ 'message' => Translator::translate( 'Faltan datos obligatorios del cliente.' ) ], 422 );
			}

			if ( empty( $data['productos'] ) ) {
				wp_send_json_error( [ 'message' => Translator::translate( 'No hay productos seleccionados.' ) ], 422 );
			}

			$body = $this->generateEmailContent( $data );
			$headers = array( 'Content-Type: text/html; charset=UTF-8' );

			$sent = wp_mail( $to, $subject, $body, $headers );
			if ( ! $sent ) {
				wp_send_json_error( [ 'message' => Translator::translate( 'No se pudo enviar el email.' ) ], 500 );
			}

			wp_send_json_success();
		} catch (\Throwable $exception) {
			error_log( 'RCF submit error: ' . $exception->getMessage() );
			wp_send_json_error( [ 'message' => Translator::translate( 'Error interno al procesar el pedido.' ) ], 500 );
		}
	}

	private function prepareData( array $data ): array {
		$products_raw = $data['products'] ?? array();

		if ( is_string( $products_raw ) ) {
			$decoded_products = json_decode( $products_raw, true );
			$products_raw = is_array( $decoded_products ) ? $decoded_products : array();
		}

		if ( ! is_array( $products_raw ) ) {
			$products_raw = array();
		}

		$products = array_map( function ( $product ) {
			$product_id = absint( $product['id'] ?? 0 );
			$product_reference = $this->getProductReference( $product_id );

			return array(
				'id' => $product_id,
				'nombre' => sanitize_text_field( $product['name'] ?? '' ),
				'referencia' => $product_reference,
				'cantidad' => intval( $product['quantity'] ?? 0 ),
				'precio' => floatval( $product['price'] ?? 0 ),
			);
		}, $products_raw );

		$total = 0.0;
		foreach ( $products as $product ) {
			$total += $product['cantidad'] * $product['precio'];
		}

		return [
			'nombre_empresa' => sanitize_text_field( $data['name'] ?? '' ),
			'cif' => sanitize_text_field( $data['cif'] ?? '' ),
			'email' => sanitize_email( $data['email'] ?? '' ),
			'phone' => sanitize_text_field( $data['phone'] ?? '' ),
			'direccion_envio' => sanitize_textarea_field( $data['shippingAddress'] ?? '' ),
			'direccion_facturacion' => sanitize_textarea_field( $data['billingAddress'] ?? '' ),
			'productos' => $products,
			'total_pedido' => $total,
		];
	}

	private function generateEmailContent( array $data ): string {
		ob_start();
		include $this->getTemplatePath( 'emails/admin-product-demand.php' );
		return ob_get_clean();
	}

	private function getProductReference( int $product_id ): string {
		if ( $product_id <= 0 || get_post_type( $product_id ) !== 'producto' ) {
			return '';
		}

		return sanitize_text_field( (string) get_post_meta( $product_id, '_producto_referencia', true ) );
	}
}