<?php
/**
 * Homepage hero — fully editable via Customizer > Homepage Hero.
 *
 * @package WellHub_Digital
 */

$eyebrow    = get_theme_mod( 'wellhub_hero_eyebrow' );
$headline   = get_theme_mod( 'wellhub_hero_headline' );
$subheading = get_theme_mod( 'wellhub_hero_subheading' );
$cta_text   = get_theme_mod( 'wellhub_hero_cta_text' );
$cta_url    = get_theme_mod( 'wellhub_hero_cta_url' );
$cta2_text  = get_theme_mod( 'wellhub_hero_cta2_text' );
$cta2_url   = get_theme_mod( 'wellhub_hero_cta2_url' );
$image_id   = get_theme_mod( 'wellhub_hero_image' );

if ( ! $cta_url ) {
	$featured_slug = get_theme_mod( 'wellhub_featured_category' );
	$cta_url       = $featured_slug && function_exists( 'get_term_by' ) && ( $term = get_term_by( 'slug', $featured_slug, 'product_cat' ) ) ? get_term_link( $term ) : '';
}
if ( ! $cta2_url && function_exists( 'wc_get_page_permalink' ) ) {
	$cta2_url = wc_get_page_permalink( 'shop' );
}

if ( ! $headline ) {
	return;
}
?>
<section class="hero">
	<div class="container hero-inner">
		<div>
			<?php if ( $eyebrow ) : ?>
				<span class="hero-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
			<?php endif; ?>

			<h1><?php echo esc_html( $headline ); ?></h1>

			<?php if ( $subheading ) : ?>
				<p class="hero-sub"><?php echo esc_html( $subheading ); ?></p>
			<?php endif; ?>

			<div class="hero-actions">
				<?php if ( $cta_text && $cta_url ) : ?>
					<a class="btn btn-accent" href="<?php echo esc_url( $cta_url ); ?>"><?php echo esc_html( $cta_text ); ?></a>
				<?php endif; ?>
				<?php if ( $cta2_text && $cta2_url ) : ?>
					<a class="btn btn-outline" style="color:#fff !important; border-color:rgba(255,255,255,0.5);" href="<?php echo esc_url( $cta2_url ); ?>"><?php echo esc_html( $cta2_text ); ?></a>
				<?php endif; ?>
			</div>
		</div>

		<?php if ( $image_id ) : ?>
			<div class="hero-media">
				<?php echo wp_get_attachment_image( $image_id, 'large', false, array( 'alt' => esc_attr( $headline ) ) ); ?>
			</div>
		<?php endif; ?>
	</div>
</section>
