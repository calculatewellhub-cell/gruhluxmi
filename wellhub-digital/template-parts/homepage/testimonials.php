<?php
/**
 * Customer reviews. Pulls real WooCommerce product reviews (comments)
 * when available; otherwise renders nothing rather than fabricating
 * quotes.
 *
 * @package WellHub_Digital
 */

$reviews = get_comments(
	array(
		'status'  => 'approve',
		'number'  => 6,
		'post_type' => 'product',
	)
);

if ( empty( $reviews ) ) {
	return;
}
?>
<section class="section-alt">
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'Loved by Customers', 'wellhub-digital' ); ?></span>
				<h2><?php esc_html_e( 'What Customers Say', 'wellhub-digital' ); ?></h2>
			</div>
		</div>
		<div class="grid grid-3">
			<?php foreach ( array_slice( $reviews, 0, 3 ) as $review ) : ?>
				<div class="testimonial-card">
					<?php
					$rating = get_comment_meta( $review->comment_ID, 'rating', true );
					if ( $rating ) {
						echo '<div class="stars">' . str_repeat( '&#9733;', (int) $rating ) . str_repeat( '&#9734;', 5 - (int) $rating ) . '</div>';
					}
					?>
					<p>&ldquo;<?php echo esc_html( wp_trim_words( $review->comment_content, 28 ) ); ?>&rdquo;</p>
					<cite><?php echo esc_html( $review->comment_author ); ?></cite>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
