<?php
/**
 * WooCommerce theme support declarations. Loaded only when WooCommerce
 * is active (see functions.php).
 *
 * @package WellHub_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wellhub_woocommerce_support() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 640,
			'single_image_width'    => 800,
			'product_grid'          => array(
				'default_rows'    => 4,
				'min_rows'        => 1,
				'default_columns' => 3,
				'min_columns'     => 1,
				'max_columns'     => 4,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'wellhub_woocommerce_support' );

/**
 * Register the WooCommerce-specific nav menu locations used inside the
 * flagship-category and shop sections.
 */
function wellhub_woocommerce_widgets_init() {
	if ( is_active_sidebar( 'sidebar-shop' ) ) {
		return;
	}
}
add_action( 'widgets_init', 'wellhub_woocommerce_widgets_init' );

/**
 * Declare the number of related products and cross-sells shown, using
 * WooCommerce's own filters instead of a template override.
 */
function wellhub_related_products_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns']        = 4;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'wellhub_related_products_args' );

function wellhub_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'wellhub_loop_columns' );

function wellhub_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'wellhub_products_per_page', 20 );
