<?php

namespace Crearco\Rcf\Includes;

class ProductCPT {
	public function init() {
		add_action( 'init', [ $this, 'register' ] );
	}

	public function register() {
		register_post_type( 'producto', [
			'labels' => [
				'name' => 'Productos Formulario',
				'singular_name' => 'Producto Formulario',
				'add_new_item' => 'Añadir producto formulario',
				'edit_item' => 'Editar producto formulario',
			],
			'public' => true,
			'menu_icon' => 'dashicons-products',
			'supports' => [ 'title', 'thumbnail' ],
			'show_in_rest' => true,
		] );
	}
}