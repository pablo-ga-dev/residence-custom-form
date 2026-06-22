<?php
namespace Crearco\Rcf\Routes;

use Crearco\Rcf\Services\MailSender;

class FormSubmitRoute {
	private MailSender $mailSender;

	public function __construct( MailSender $mailSender ) {
		$this->mailSender = $mailSender;
	}

	public function register(): void {
		add_action( 'wp_ajax_rcf_submit_order', [ $this->mailSender, 'submit' ] );
		add_action( 'wp_ajax_nopriv_rcf_submit_order', [ $this->mailSender, 'submit' ] );
	}
}
