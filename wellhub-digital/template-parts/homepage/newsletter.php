<?php
/**
 * Newsletter signup — a generic integration point. Paste the shortcode
 * from any WordPress-compatible email plugin (Mailchimp, ConvertKit,
 * Brevo, etc) into Customizer > Free Resource & Newsletter. No provider
 * is required or hard-coded.
 *
 * @package WellHub_Digital
 */

$shortcode = get_theme_mod( 'wellhub_newsletter_shortcode' );

if ( ! $shortcode ) {
	return;
}
?>
<section class="section-alt">
	<div class="container" style="max-width:640px; text-align:center;">
		<h2><?php esc_html_e( 'Stay in the Loop', 'wellhub-digital' ); ?></h2>
		<p><?php esc_html_e( 'Get new resources and helpful guides in your inbox.', 'wellhub-digital' ); ?></p>
		<?php echo do_shortcode( $shortcode ); ?>
	</div>
</section>
