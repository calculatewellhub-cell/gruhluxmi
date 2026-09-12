<?php
/**
 * Flagship category spotlight (e.g. Women's Health & Pregnancy). Reads
 * entirely from the Customizer + live WooCommerce taxonomy — no
 * hard-coded category IDs, so a future flagship category is a
 * Customizer change, not a template edit.
 *
 * @package WellHub_Digital
 */

$slug = get_theme_mod( 'wellhub_featured_category' );

if ( ! $slug ) {
	return;
}

$term = get_term_by( 'slug', $slug, 'product_cat' );

if ( ! $term || is_wp_error( $term ) ) {
	return;
}

$subcats = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'parent'     => $term->term_id,
		'hide_empty' => false,
	)
);

if ( is_wp_error( $subcats ) ) {
	$subcats = array();
}
?>
<section class="section-featured-category">
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'Flagship Category', 'wellhub-digital' ); ?></span>
				<h2><?php echo esc_html( $term->name ); ?></h2>
			</div>
			<a class="section-link" href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php esc_html_e( 'Shop All', 'wellhub-digital' ); ?> &rarr;</a>
		</div>

		<?php if ( ! empty( $subcats ) ) : ?>
			<div class="grid grid-4">
				<?php foreach ( $subcats as $subcat ) : ?>
					<a class="category-tile" href="<?php echo esc_url( get_term_link( $subcat ) ); ?>">
						<?php
						$thumbnail_id = get_term_meta( $subcat->term_id, 'thumbnail_id', true );
						if ( $thumbnail_id ) {
							echo wp_get_attachment_image( $thumbnail_id, 'wellhub-category-tile', false, array( 'alt' => esc_attr( $subcat->name ) ) );
						}
						?>
						<span class="category-tile-label"><?php echo esc_html( $subcat->name ); ?></span>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
