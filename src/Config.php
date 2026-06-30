<?php

namespace Crearco\Rcf;

class Config {
	public const VERSION = '1.2.3';
	public const SLUG = 'residence-custom-form';
	public const TEXT_DOMAIN = 'residence-custom-form';

	public static function path(): string {
		return trailingslashit( dirname( __DIR__ ) );
	}

	public static function url(): string {
		return plugin_dir_url( dirname( __DIR__ ) . '/residence-custom-form.php' );
	}

	public static function assets_path(): string {
		return self::path() . 'public/assets/';
	}

	public static function assets_url(): string {
		return self::url() . 'public/assets/';
	}

	public static function templates_path(): string {
		return self::path() . 'public/templates/';
	}
}