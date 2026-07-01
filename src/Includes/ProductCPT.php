<?php

namespace Crearco\Rcf\Includes;

use Crearco\Rcf\I18n\Translator;

class ProductCPT {
	public function init() {
		add_action( 'init', [ $this, 'register' ] );
	}

	public function register() {
		register_post_type( 'producto', [
			'labels' => [
				'name' => Translator::translate( 'Productos Formulario' ),
				'singular_name' => Translator::translate( 'Producto Formulario' ),
				'add_new_item' => Translator::translate( 'Añadir producto formulario' ),
				'edit_item' => Translator::translate( 'Editar producto formulario' ),
			],
			// This CPT is only used as an internal catalog for the shortcode form.
			'public' => false,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'has_archive' => false,
			'rewrite' => false,
			'query_var' => false,
			'menu_icon' => 'dashicons-products',
			'supports' => [ 'title', 'thumbnail' ],
			'taxonomies' => [ 'producto_categoria' ],
			'show_in_rest' => true,
		] );

		register_taxonomy( 'producto_categoria', [ 'producto' ], [
			'labels' => [
				'name' => Translator::translate( 'Categorias de producto' ),
				'singular_name' => Translator::translate( 'Categoria de producto' ),
				'search_items' => Translator::translate( 'Buscar categorias' ),
				'all_items' => Translator::translate( 'Todas las categorias' ),
				'edit_item' => Translator::translate( 'Editar categoria' ),
				'update_item' => Translator::translate( 'Actualizar categoria' ),
				'add_new_item' => Translator::translate( 'Anadir nueva categoria' ),
				'new_item_name' => Translator::translate( 'Nombre de la categoria' ),
				'menu_name' => Translator::translate( 'Categorias' ),
			],
			'public' => false,
			'publicly_queryable' => false,
			'show_ui' => true,
			'show_in_menu' => true,
			'hierarchical' => true,
			'show_admin_column' => true,
			'show_in_quick_edit' => true,
			'rewrite' => false,
			'show_in_rest' => true,
		] );
	}
}