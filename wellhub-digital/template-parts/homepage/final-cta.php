<?php
/**
 * Final call-to-action, reusing the hero's primary button so the CTA
 * text stays consistent and remains editable in one place.
 *
 * @package WellHub_Digital
 */

$cta_text = get_theme_mod( 'wellhub_hero_cta_text' );
$cta_url  = get_theme_mod( 'wellhub_hero_cta_url' );

if ( ! $cta_url && function_exists( 'wc_get_page_permalink' ) ) {
	$cta_url = wc_get_page_permalink( 'shop' );
}

if ( ! $cta_url ) {
	return;
}
?>
<section>
	<div class="container">
		<div class="final-cta">
			<h2><?php esc_html_e( 'Ready to feel more prepared?', 'wellhub-digital' ); ?></h2>
			<p><?php esc_html_e( 'Explore the full library of digital guides, planners and workbooks.', 'wellhub-digital' ); ?></p>
			<a class="btn btn-accent" href="<?php echo esc_url( $cta_url ); ?>"><?php echo esc_html( $cta_text ? $cta_text : __( 'Shop Digital Products', 'wellhub-digital' ) ); ?></a>
		</div>
	</div>
</section>
