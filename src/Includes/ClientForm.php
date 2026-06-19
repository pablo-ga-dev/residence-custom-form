<?php

namespace Crearco\Rcf\Includes;

use Crearco\Rcf\Model\ProductModel;
use Crearco\Rcf\Config;

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
		$templates = $this->get_templates();

		if ( ! file_exists( $templates['residence_form'] ) || ! file_exists( $templates['product_list'] ) || ! file_exists( $templates['summary'] ) ) {
			return '';
		}

		ob_start();
		?>
		<div id="rcf-wrapper" class="rcf-wrapper">
			<?php include $templates['product_list']; ?>
			<aside id="rcf-form-container" class="rcf-form-container">
				<?php include $templates['residence_form']; ?>
				<?php include $templates['summary']; ?>
			</aside>
		</div>
		<?php
		return ob_get_clean();
	}
}