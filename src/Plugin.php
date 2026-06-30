<?php

namespace Crearco\Rcf;

use Crearco\Rcf\Includes\AssetsManager;
use Crearco\Rcf\Includes\ClientForm;
use Crearco\Rcf\Includes\ProductCPT;
use Crearco\Rcf\Admin\AdminPanel;
use Crearco\Rcf\Routes\FormSubmitRoute;

use DI\Container;

class Plugin {
	private const REWRITE_FLUSHED_OPTION = 'rcf_rewrite_flushed_version';

	private Container $container;
	private AssetsManager $assetsManager;
	private ProductCPT $productCPT;
	private ClientForm $clientForm;
	private AdminPanel $adminPanel;
	private FormSubmitRoute $formSubmitRoute;

	public function __construct( Container $container, AssetsManager $assetsManager, ProductCPT $productCPT, ClientForm $clientForm, AdminPanel $adminPanel, FormSubmitRoute $formSubmitRoute ) {
		$this->container = $container;
		$this->assetsManager = $assetsManager;
		$this->productCPT = $productCPT;
		$this->clientForm = $clientForm;
		$this->adminPanel = $adminPanel;
		$this->formSubmitRoute = $formSubmitRoute;
	}

	public function boot(): void {
		add_action( 'wp_enqueue_scripts', [ $this->assetsManager, 'enqueue_scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this->assetsManager, 'enqueue_styles' ] );
		add_shortcode( 'client_form', [ $this->clientForm, 'render' ] );
		add_action( 'init', [ $this, 'maybe_flush_rewrite_rules' ], 99 );
		$this->formSubmitRoute->register();
		$this->productCPT->init();
		$this->adminPanel->init();
	}

	public function maybe_flush_rewrite_rules(): void {
		$flushed_version = get_option( self::REWRITE_FLUSHED_OPTION, '' );

		if ( $flushed_version === Config::VERSION ) {
			return;
		}

		flush_rewrite_rules( false );
		update_option( self::REWRITE_FLUSHED_OPTION, Config::VERSION, false );
	}
}