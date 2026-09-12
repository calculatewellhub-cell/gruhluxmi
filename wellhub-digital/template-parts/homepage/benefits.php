<?php
/**
 * Benefits strip. Editable via a "Benefits" widget area would be
 * over-engineering for four static trust points, so this uses filterable
 * PHP data — override with the wellhub_benefits filter if needed.
 *
 * @package WellHub_Digital
 */

$benefits = apply_filters(
	'wellhub_benefits',
	array(
		array(
			'title' => __( 'Instant Access', 'wellhub-digital' ),
			'text'  => __( 'Download your resources the moment your order is complete — no waiting.', 'wellhub-digital' ),
			'icon'  => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3v12"/><path d="M7 10l5 5 5-5"/><path d="M4 20h16"/></svg>',
		),
		array(
			'title' => __( 'Thoughtfully Designed', 'wellhub-digital' ),
			'text'  => __( 'Every guide and planner is created with care, clarity and real-life use in mind.', 'wellhub-digital' ),
			'icon'  => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20l9-9-9-9-9 9 9 9z"/></svg>',
		),
		array(
			'title' => __( 'Lifetime Access', 'wellhub-digital' ),
			'text'  => __( 'Your downloads stay in your account, ready whenever you need them again.', 'wellhub-digital' ),
			'icon'  => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>',
		),
		array(
			'title' => __( 'Secure Checkout', 'wellhub-digital' ),
			'text'  => __( 'Pay safely with the payment methods your store owner has enabled.', 'wellhub-digital' ),
			'icon'  => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l8 4v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-4z"/></svg>',
		),
	)
);

if ( empty( $benefits ) ) {
	return;
}
?>
<section>
	<div class="container">
		<div class="grid grid-4 benefits-grid">
			<?php foreach ( $benefits as $benefit ) : ?>
				<div class="benefit">
					<div class="benefit-icon"><?php echo wp_kses( $benefit['icon'], array( 'svg' => array( 'width' => true, 'height' => true, 'viewbox' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true ), 'path' => array( 'd' => true ), 'rect' => array( 'x' => true, 'y' => true, 'width' => true, 'height' => true, 'rx' => true ) ) ); ?></div>
					<h3><?php echo esc_html( $benefit['title'] ); ?></h3>
					<p><?php echo esc_html( $benefit['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
