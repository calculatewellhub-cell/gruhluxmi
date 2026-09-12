<?php
/**
 * Bundle products — any WooCommerce product marked with the "Bundle"
 * badge in Product Data > Digital Details. Works with plain WooCommerce
 * products today; if a dedicated bundle plugin is installed later, its
 * products will simply appear here too once flagged.
 *
 * @package WellHub_Digital
 */

$query = new WP_Query(
	array(
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => 3,
		'meta_key'       => '_wellhub_badge_bundle', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
		'meta_value'     => 'yes', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
	)
);

if ( ! $query->have_posts() ) {
	wp_reset_postdata();
	return;
}
?>
<section class="section-alt">
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'Save More', 'wellhub-digital' ); ?></span>
				<h2><?php esc_html_e( 'Bundles', 'wellhub-digital' ); ?></h2>
			</div>
		</div>
		<div class="grid grid-3">
			<?php
			while ( $query->have_posts() ) :
				$query->the_post();
				$product = wc_get_product( get_the_ID() );
				if ( ! $product ) {
					continue;
				}
				$included = $product->get_meta( '_wellhub_whats_included' );
				$items    = $included ? array_filter( array_map( 'trim', explode( "\n", $included ) ) ) : array();
				?>
				<div class="bundle-card">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php if ( ! empty( $items ) ) : ?>
						<ul>
							<?php foreach ( array_slice( $items, 0, 5 ) as $item ) : ?>
								<li><?php echo esc_html( $item ); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<div class="bundle-price-row"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
					<a class="btn" href="<?php the_permalink(); ?>"><?php esc_html_e( 'View Bundle', 'wellhub-digital' ); ?></a>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
</section>
<?php
wp_reset_postdata();
