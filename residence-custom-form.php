<?php
/*
Plugin Name: Formulario de Pedido Único - Menaki Style
Description: Listado de packs por categoría con foto, selector de cantidad, formulario y resumen flotante con la identidad corporativa de Menaki. Correo HTML premium incluido.
Version: 1.2
Author: Crear & Co
*/

if ( !defined( 'ABSPATH' ) ) {
	die( 'Kangaroos cant jump here.' );
}

require __DIR__ . '/vendor/autoload.php';

use Crearco\Rcf\Plugin;
use DI\ContainerBuilder;

function rcf_plugin(): Plugin {
	static $plugin = null;

	if ( null === $plugin ) {
		$builder = new ContainerBuilder();
		$builder->useAutowiring( true );
		$container = $builder->build();
		$plugin = $container->get( Plugin::class);
	}

	return $plugin;
}

rcf_plugin()->boot();
