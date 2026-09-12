<?php
/**
 * The theme-level WooCommerce wrapper template. WooCommerce loads this
 * file for shop/product/cart/checkout/account pages when no more
 * specific template exists. Layout wrapping happens via the
 * woocommerce_before_main_content / woocommerce_after_main_content
 * hooks in inc/woocommerce/woocommerce-hooks.php, following WooCommerce's
 * own recommended integration pattern.
 *
 * @package WellHub_Digital
 */

get_header( 'shop' );

/**
 * woocommerce_before_main_content hook (wrapper + breadcrumbs open here).
 */
do_action( 'woocommerce_before_main_content' );

if ( is_shop() || is_product_taxonomy() ) {
	?>
	<div class="shop-layout <?php echo is_active_sidebar( 'sidebar-shop' ) ? 'has-sidebar' : ''; ?>">
		<div>
			<?php woocommerce_content(); ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
	<?php
} else {
	woocommerce_content();
}

/**
 * woocommerce_after_main_content hook (wrapper closes here).
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
