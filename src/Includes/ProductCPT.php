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
			'taxonomies' => [ 'producto_categoria' ],
			'show_in_rest' => true,
		] );

		register_taxonomy( 'producto_categoria', [ 'producto' ], [
			'labels' => [
				'name' => 'Categorias de producto',
				'singular_name' => 'Categoria de producto',
				'search_items' => 'Buscar categorias',
				'all_items' => 'Todas las categorias',
				'edit_item' => 'Editar categoria',
				'update_item' => 'Actualizar categoria',
				'add_new_item' => 'Anadir nueva categoria',
				'new_item_name' => 'Nombre de la categoria',
				'menu_name' => 'Categorias',
			],
			'hierarchical' => true,
			'show_admin_column' => true,
			'show_in_rest' => true,
		] );
	}
}