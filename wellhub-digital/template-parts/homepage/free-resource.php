<?php
/**
 * Free resource / lead magnet — category-neutral, fully editable via
 * Customizer > Free Resource & Newsletter.
 *
 * @package WellHub_Digital
 */

$heading     = get_theme_mod( 'wellhub_lead_heading' );
$description = get_theme_mod( 'wellhub_lead_description' );
$button_text = get_theme_mod( 'wellhub_lead_button_text' );
$button_url  = get_theme_mod( 'wellhub_lead_button_url' );

if ( ! $heading || ! $button_url ) {
	return;
}
?>
<section>
	<div class="container">
		<div class="lead-magnet">
			<div>
				<h2><?php echo esc_html( $heading ); ?></h2>
				<?php if ( $description ) : ?>
					<p><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>
			</div>
			<div>
				<a class="btn btn-accent" href="<?php echo esc_url( $button_url ); ?>"><?php echo esc_html( $button_text ? $button_text : __( 'Get the Free Guide', 'wellhub-digital' ) ); ?></a>
			</div>
		</div>
	</div>
</section>
