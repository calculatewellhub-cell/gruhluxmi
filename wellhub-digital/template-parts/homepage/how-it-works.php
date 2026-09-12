<?php
/**
 * How It Works — three-step purchase flow.
 *
 * @package WellHub_Digital
 */

$steps = apply_filters(
	'wellhub_how_it_works_steps',
	array(
		array(
			'title' => __( 'Choose Your Resource', 'wellhub-digital' ),
			'text'  => __( 'Browse by category and find the guide, planner or workbook that fits your stage of life.', 'wellhub-digital' ),
		),
		array(
			'title' => __( 'Checkout Securely', 'wellhub-digital' ),
			'text'  => __( 'Complete your order through our secure, WooCommerce-powered checkout.', 'wellhub-digital' ),
		),
		array(
			'title' => __( 'Download Instantly', 'wellhub-digital' ),
			'text'  => __( 'Access your files immediately from your order confirmation or My Account.', 'wellhub-digital' ),
		),
	)
);
?>
<section class="section-alt">
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'Simple & Fast', 'wellhub-digital' ); ?></span>
				<h2><?php esc_html_e( 'How It Works', 'wellhub-digital' ); ?></h2>
			</div>
		</div>
		<div class="grid grid-3 steps-grid">
			<?php foreach ( $steps as $step ) : ?>
				<div class="step">
					<h3><?php echo esc_html( $step['title'] ); ?></h3>
					<p><?php echo esc_html( $step['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
