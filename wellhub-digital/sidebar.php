<?php
/**
 * The sidebar: Shop Sidebar on WooCommerce pages, Blog Sidebar elsewhere.
 *
 * @package WellHub_Digital
 */

$sidebar_id = ( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() ) ) ? 'sidebar-shop' : 'sidebar-blog';

if ( ! is_active_sidebar( $sidebar_id ) ) {
	return;
}
?>
<aside id="secondary" class="widget-area" aria-label="<?php esc_attr_e( 'Sidebar', 'wellhub-digital' ); ?>">
	<?php dynamic_sidebar( $sidebar_id ); ?>
</aside>
