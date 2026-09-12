<?php
/**
 * OVERRIDDEN WOOCOMMERCE TEMPLATE: content-product.php
 * WooCommerce core version this was based on: 8.x / 9.x (only the
 * product-card markup is overridden — the loop's own <ul class="products">
 * wrapper and its start/end templates are left untouched).
 *
 * Why this file is overridden: WellHub Digital replaces the default
 * product card with a richer, badge-aware, brand-styled card (image,
 * category, title, excerpt, price, rating, and digital/bestseller/sale
 * badges) required by the design system. Every WooCommerce action hook
 * from core (woocommerce_before_shop_loop_item, _title,
 * woocommerce_after_shop_loop_item_title, woocommerce_after_shop_loop_item)
 * still fires in the same order, so plugins that hook into the product
 * loop keep working unmodified. Two default callbacks are unhooked in
 * inc/woocommerce/woocommerce-hooks.php: the sale flash (replaced by the
 * unified badge component) and the loop price (rendered manually below
 * so it can sit inside our own price row instead of the hook's markup).
 *
 * Update discipline: whenever WooCommerce ships a new
 * templates/content-product.php, diff it against this file and port any
 * new hooks forward. Do not remove this comment block.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WellHub_Digital
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( 'product-card', $product ); ?>>
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );
	?>

	<div class="product-thumb">
		<?php echo $product->get_image( 'wellhub-card' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php wellhub_render_product_badges( $product ); ?>
	</div>

	<div class="product-body">
		<?php
		$terms = get_the_terms( $product->get_id(), 'product_cat' );
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			echo '<span class="product-category">' . esc_html( $terms[0]->name ) . '</span>';
		}

		/**
		 * woocommerce_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );
		?>

		<?php if ( $product->get_short_description() ) : ?>
			<p class="product-excerpt"><?php echo esc_html( wp_trim_words( $product->get_short_description(), 14 ) ); ?></p>
		<?php endif; ?>

		<?php
		/**
		 * woocommerce_after_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * (the default price hook, 10, is unhooked in favor of the
		 * manual price row below — see file header)
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

		<div class="product-price-row"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
	</div>

	<?php
	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</li>
