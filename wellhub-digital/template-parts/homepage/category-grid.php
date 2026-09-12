<?php
/**
 * Full category grid — every top-level WooCommerce product category,
 * so new categories (Fitness, Finance, Education, …) appear automatically
 * with zero template changes.
 *
 * @package WellHub_Digital
 */

$categories = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'parent'     => 0,
		'hide_empty' => true,
		'exclude'    => array( get_option( 'default_product_cat', 0 ) ),
	)
);

if ( empty( $categories ) || is_wp_error( $categories ) ) {
	return;
}
?>
<section>
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'Browse', 'wellhub-digital' ); ?></span>
				<h2><?php esc_html_e( 'Shop by Category', 'wellhub-digital' ); ?></h2>
			</div>
		</div>
		<div class="grid grid-4">
			<?php foreach ( $categories as $category ) : ?>
				<a class="category-tile" href="<?php echo esc_url( get_term_link( $category ) ); ?>">
					<?php
					$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
					if ( $thumbnail_id ) {
						echo wp_get_attachment_image( $thumbnail_id, 'wellhub-category-tile', false, array( 'alt' => esc_attr( $category->name ) ) );
					}
					?>
					<span class="category-tile-label"><?php echo esc_html( $category->name ); ?></span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
