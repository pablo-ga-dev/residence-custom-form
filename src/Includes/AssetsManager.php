<?php

namespace Crearco\Rcf\Includes;

use Crearco\Rcf\Config;

class AssetsManager {
    private static Config $config;

    public function __construct( Config $config ) {
        self::$config = $config;
    }

    private static function getUrl( string $path ) {
        return self::$config->assets_url() . $path;
    }

    public function enqueue_scripts() {
        wp_enqueue_script(
            'rcf-app',
            self::getUrl('js/app.js'),
            array(),
            Config::VERSION,
            true
        );

        // TODO: Localize script with necessary data for AJAX requests and security
    }

    public function enqueue_styles() {
        wp_enqueue_style(
            'rcf-style',
            self::getUrl('css/styles.css'),
            array(),
            Config::VERSION
        );
    }
}