<?php

namespace Crearco\Rcf\Includes;

use Crearco\Rcf\Model\ProductModel;
use Crearco\Rcf\Config;
use Crearco\Rcf\I18n\Translator;

class ClientForm {
	private ProductModel $productModel;
	private Config $config;
	public function __construct( ProductModel $productModel, Config $config ) {
		$this->productModel = $productModel;
		$this->config = $config;
	}

	private function get_template_path( string $template_name ): string {
		return $this->config->templates_path() . $template_name;
	}

	private function get_templates() {
		return [
			'product_list' => $this->get_template_path( 'partials/product-list.php' ),
			'residence_form' => $this->get_template_path( 'partials/residence-form.php' ),
			'summary' => $this->get_template_path( 'partials/summary.php' ),
		];
	}

	public function render() {
		$products = $this->productModel->get_products();
		$products_by_category = $this->group_products_by_category( $products );
		$templates = $this->get_templates();

		if ( ! file_exists( $templates['residence_form'] ) || ! file_exists( $templates['product_list'] ) || ! file_exists( $templates['summary'] ) ) {
			return '';
		}

		ob_start();
		?>
		<div id="rcf-wrapper" class="rcf-wrapper">
			<?php include $templates['product_list']; ?>
			<aside id="rcf-form-container" class="rcf-form-container">
				<form id="rcf-order-form" class="rcf-order-form" method="post" action="#">
					<?php include $templates['residence_form']; ?>
					<?php include $templates['summary']; ?>
				</form>
			</aside>
		</div>
		<?php
		return ob_get_clean();
	}

	private function group_products_by_category( array $products ): array {
		$grouped = [];

		foreach ( $products as $product ) {
			$categories = $product['categories'] ?? [];

			if ( empty( $categories ) ) {
				$key = 'uncategorized';
				if ( ! isset( $grouped[ $key ] ) ) {
					$grouped[ $key ] = [
						'id' => 0,
						'name' => Translator::translate( 'Sin categoría' ),
						'slug' => $key,
						'products' => [],
					];
				}

				$grouped[ $key ]['products'][] = $product;
				continue;
			}

			foreach ( $categories as $category ) {
				$key = 'term_' . (int) ( $category['id'] ?? 0 );
				if ( ! isset( $grouped[ $key ] ) ) {
					$grouped[ $key ] = [
						'id' => (int) ( $category['id'] ?? 0 ),
						'name' => $category['name'] ?? Translator::translate( 'Sin categoría' ),
						'slug' => $category['slug'] ?? '',
						'products' => [],
					];
				}

				$grouped[ $key ]['products'][] = $product;
			}
		}

		foreach ( $grouped as $group_key => $group ) {
			$regular_products = [];
			$pack_products = [];

			foreach ( $group['products'] as $product ) {
				$title = (string) ( $product['title'] ?? '' );

				if ( stripos( $title, 'pack' ) !== false ) {
					$pack_products[] = $product;
					continue;
				}

				$regular_products[] = $product;
			}

			usort( $regular_products, function ( array $a, array $b ) {
				return strcasecmp( (string) ( $a['title'] ?? '' ), (string) ( $b['title'] ?? '' ) );
			} );

			$grouped[ $group_key ]['products'] = array_merge( $regular_products, $pack_products );
		}

		$grouped_values = array_values( $grouped );

		usort( $grouped_values, function ( array $a, array $b ) {
			$count_a = count( $a['products'] ?? [] );
			$count_b = count( $b['products'] ?? [] );

			if ( $count_a !== $count_b ) {
				return $count_b <=> $count_a;
			}

			return strcasecmp( (string) ( $a['name'] ?? '' ), (string) ( $b['name'] ?? '' ) );
		} );

		return $grouped_values;
	}
}