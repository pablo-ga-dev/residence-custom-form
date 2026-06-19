<?php

namespace Crearco\Rcf;

use Crearco\Rcf\Includes\AssetsManager;
use Crearco\Rcf\Includes\ClientForm;
use Crearco\Rcf\Includes\ProductCPT;
use Crearco\Rcf\Admin\AdminPanel;

use DI\Container;

class Plugin {
	private Container $container;
	private AssetsManager $assetsManager;
    private ProductCPT $productCPT;
    private ClientForm $clientForm;
    private AdminPanel $adminPanel;

	public function __construct( Container $container, AssetsManager $assetsManager, ProductCPT $productCPT, ClientForm $clientForm, AdminPanel $adminPanel ) {
		$this->container = $container;
		$this->assetsManager = $assetsManager;
        $this->productCPT = $productCPT;
        $this->clientForm = $clientForm;
        $this->adminPanel = $adminPanel;
	}

	public function boot(): void {
		add_action( 'wp_enqueue_scripts', [ $this->assetsManager, 'enqueue_scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this->assetsManager, 'enqueue_styles' ] );
		add_shortcode( 'client_form', [ $this->clientForm, 'render' ] );
        $this->productCPT->init();
        $this->adminPanel->init();
	}
}