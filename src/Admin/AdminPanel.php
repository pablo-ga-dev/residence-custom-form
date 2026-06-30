<?php

namespace Crearco\Rcf\Admin;

class AdminPanel {

	public function init() {
		add_action( 'add_meta_boxes', [ $this, 'add_meta_boxes' ] );
		add_action( 'save_post_producto', [ $this, 'save_post' ] );
	}

	public function add_meta_boxes() {
		add_meta_box(
			'producto_precio',
			'Precio',
			[ $this, 'get_precio_html' ],
			'producto',
			'normal'
		);

		add_meta_box(
			'producto_referencia',
			'Referencia',
			[ $this, 'get_referencia_html' ],
			'producto',
			'normal'
		);
	}

	public function get_precio_html( \WP_Post $post ) {
		$precio = get_post_meta( $post->ID, '_producto_precio', true );
		wp_nonce_field( 'guardar_producto_precio', 'producto_precio_nonce' );
		?>
		<p>
			<label for="producto_precio">Precio</label>
			<input type="number" step="0.01" min="0" name="producto_precio" id="producto_precio"
				value="<?php echo esc_attr( $precio ); ?>" style="width:100%;">
		</p>
		<?php
	}

	public function get_referencia_html( \WP_Post $post ) {
		$referencia = get_post_meta( $post->ID, '_producto_referencia', true );
		wp_nonce_field( 'guardar_producto_referencia', 'producto_referencia_nonce' );
		?>
		<p>
			<label for="producto_referencia">Referencia</label>
			<input type="text" name="producto_referencia" id="producto_referencia"
				value="<?php echo esc_attr( $referencia ); ?>" style="width:100%;">
		</p>
		<?php
	}

	public function save_post( int $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if ( ! current_user_can( 'edit_post', $post_id ) )
			return;

		if (
			isset( $_POST['producto_precio_nonce'] ) &&
			wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['producto_precio_nonce'] ) ), 'guardar_producto_precio' ) &&
			isset( $_POST['producto_precio'] )
		) {
			update_post_meta(
				$post_id,
				'_producto_precio',
				sanitize_text_field( wp_unslash( $_POST['producto_precio'] ) )
			);
		}

		if (
			isset( $_POST['producto_referencia_nonce'] ) &&
			wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['producto_referencia_nonce'] ) ), 'guardar_producto_referencia' ) &&
			isset( $_POST['producto_referencia'] )
		) {
			update_post_meta(
				$post_id,
				'_producto_referencia',
				sanitize_text_field( wp_unslash( $_POST['producto_referencia'] ) )
			);
		}
	}
}