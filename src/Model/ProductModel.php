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
			$thumbnail_id = get_post_thumbnail_id( $post->ID );
			$thumbnail_medium = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'medium' ) : '';
			$thumbnail_large = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'large' ) : '';
			$thumbnail_full = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'full' ) : '';

			$terms = get_the_terms( $post->ID, 'producto_categoria' );
			$categories = [];

			if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					$categories[] = [
						'id' => (int) $term->term_id,
						'name' => $term->name,
						'slug' => $term->slug,
					];
				}
			}

			$products[] = [
				'id' => $post->ID,
				'title' => get_the_title( $post->ID ),
				'price' => get_post_meta( $post->ID, '_producto_precio', true ),
				'image' => $thumbnail_medium ?: '',
				'image_large' => $thumbnail_large ?: ( $thumbnail_full ?: ( $thumbnail_medium ?: '' ) ),
				'categories' => $categories,
			];
		}

		return $products;
	}
}