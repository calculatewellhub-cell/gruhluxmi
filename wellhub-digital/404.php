<?php
/**
 * 404 template.
 *
 * @package WellHub_Digital
 */

get_header();
?>
<main id="primary" class="site-main container" style="text-align:center; padding-block:4rem;">
	<p class="hero-eyebrow" style="background:var(--surface-alt); color:var(--accent); border-color:var(--border);">404</p>
	<h1><?php esc_html_e( 'Page Not Found', 'wellhub-digital' ); ?></h1>
	<p><?php esc_html_e( "The page you're looking for doesn't exist or may have moved. Try searching, or head back to the shop.", 'wellhub-digital' ); ?></p>
	<div style="max-width:480px; margin:1.5rem auto;">
		<?php get_search_form(); ?>
	</div>
	<div class="hero-actions" style="justify-content:center;">
		<a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Home', 'wellhub-digital' ); ?></a>
		<?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
			<a class="btn btn-outline" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'Visit the Shop', 'wellhub-digital' ); ?></a>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
