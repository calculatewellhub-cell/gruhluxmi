<?php
/**
 * Style & script loading. Assets are only enqueued where they are needed
 * so pages that do not use WooCommerce (a plain blog post, for example)
 * stay light.
 *
 * @package WellHub_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wellhub_is_shop_context() {
	return function_exists( 'is_woocommerce' ) &&
		( is_woocommerce() || is_cart() || is_checkout() || is_account_page() );
}

function wellhub_enqueue_assets() {
	wp_enqueue_style(
		'wellhub-fonts',
		'https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'wellhub-style', get_stylesheet_uri(), array(), WELLHUB_VERSION );

	if ( wellhub_is_shop_context() ) {
		wp_enqueue_style(
			'wellhub-woocommerce',
			WELLHUB_URI . '/assets/css/woocommerce.css',
			array( 'wellhub-style' ),
			WELLHUB_VERSION
		);
	}

	wp_enqueue_script(
		'wellhub-main',
		WELLHUB_URI . '/assets/js/main.js',
		array(),
		WELLHUB_VERSION,
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wellhub_enqueue_assets' );
