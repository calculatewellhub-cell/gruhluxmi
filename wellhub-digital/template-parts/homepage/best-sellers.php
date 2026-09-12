<?php
/**
 * Best Sellers — ordered by WooCommerce's own sales-popularity metric.
 * Avoids fake urgency language per project policy; badges are optional
 * and administrator-controlled (Product > Digital Details).
 *
 * @package WellHub_Digital
 */

$products = wc_get_products(
	array(
		'status'  => 'publish',
		'orderby' => 'popularity',
		'limit'   => 8,
	)
);

if ( empty( $products ) ) {
	return;
}
?>
<section class="section-alt">
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'Customer Favorites', 'wellhub-digital' ); ?></span>
				<h2><?php esc_html_e( 'Best Sellers', 'wellhub-digital' ); ?></h2>
			</div>
			<a class="section-link" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'Shop All', 'wellhub-digital' ); ?> &rarr;</a>
		</div>
		<?php wellhub_render_product_cards( $products ); ?>
	</div>
</section>
