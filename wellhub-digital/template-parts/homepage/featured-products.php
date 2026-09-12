<?php
/**
 * Featured Products — pulls WooCommerce's native "Featured" flag.
 * Renders nothing if no product has been marked featured yet.
 *
 * @package WellHub_Digital
 */

$featured_ids = wc_get_featured_product_ids();

if ( empty( $featured_ids ) ) {
	return;
}

$products = wc_get_products(
	array(
		'include' => array_slice( $featured_ids, 0, 8 ),
		'status'  => 'publish',
	)
);

if ( empty( $products ) ) {
	return;
}
?>
<section>
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'Handpicked', 'wellhub-digital' ); ?></span>
				<h2><?php esc_html_e( 'Featured Products', 'wellhub-digital' ); ?></h2>
			</div>
			<a class="section-link" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'Shop All', 'wellhub-digital' ); ?> &rarr;</a>
		</div>
		<?php wellhub_render_product_cards( $products ); ?>
	</div>
</section>
