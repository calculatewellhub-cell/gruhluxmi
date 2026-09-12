<?php
/**
 * WellHub Digital theme bootstrap.
 *
 * @package WellHub_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WELLHUB_VERSION', '1.0.0' );
define( 'WELLHUB_DIR', get_template_directory() );
define( 'WELLHUB_URI', get_template_directory_uri() );

/**
 * Core theme setup: supports, menus, sidebars, image sizes.
 */
require WELLHUB_DIR . '/inc/setup.php';
require WELLHUB_DIR . '/inc/enqueue.php';
require WELLHUB_DIR . '/inc/customizer.php';
require WELLHUB_DIR . '/inc/template-tags.php';
require WELLHUB_DIR . '/inc/demo-content.php';

/**
 * WooCommerce integration lives in its own folder so the theme keeps
 * working (minus shop features) if WooCommerce is ever deactivated.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require WELLHUB_DIR . '/inc/woocommerce/woocommerce-setup.php';
	require WELLHUB_DIR . '/inc/woocommerce/woocommerce-hooks.php';
	require WELLHUB_DIR . '/inc/woocommerce/product-fields.php';
	require WELLHUB_DIR . '/inc/real-products/products-data.php';
	require WELLHUB_DIR . '/inc/real-products/import.php';
} else {
	add_action( 'admin_notices', 'wellhub_woocommerce_missing_notice' );
}

/**
 * Friendly admin notice when WooCommerce is not active. The theme does not
 * force-install plugins; it only informs the administrator.
 */
function wellhub_woocommerce_missing_notice() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	echo '<div class="notice notice-warning"><p>' .
		esc_html__( 'WellHub Digital is designed for WooCommerce. Please install and activate WooCommerce to unlock the shop, cart, checkout and digital downloads.', 'wellhub-digital' ) .
		'</p></div>';
}
