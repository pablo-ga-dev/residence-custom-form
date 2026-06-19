<?php

namespace Crearco\Rcf\Model;

class ProductModel {
    public function get_products() {
		$args = [
			'post_type' => 'producto',
			'posts_per_page' => -1,
			'post_status' => 'publish',
		];

		$query = new \WP_Query( $args );
		$products = [];

		foreach ( $query->posts as $post ) {
			$products[] = [
				'id' => $post->ID,
				'title' => get_the_title( $post->ID ),
				'price' => get_post_meta( $post->ID, '_producto_precio', true ),
				'image' => get_the_post_thumbnail_url( $post->ID, 'medium' ) ?: '',
			];
		}

		return $products;
	}
}