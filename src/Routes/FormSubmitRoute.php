<?php
// TODO: Implement form submit route, delete old controller route
namespace Crearco\Rcf\Routes;

use Crearco\Rcf\Controllers\FormSubmitController;

class FormSubmitRoute {
	private FormSubmitController $formSubmitController;

	public function __construct( FormSubmitController $formSubmitController ) {
		$this->formSubmitController = $formSubmitController;
	}

	public function register(): void {
		add_action( 'wp_ajax_rcf_submit_order', [ $this->formSubmitController, 'submit' ] );
		add_action( 'wp_ajax_nopriv_rcf_submit_order', [ $this->formSubmitController, 'submit' ] );
	}
}
