<?php
/**
 * Comments template.
 *
 * @package WellHub_Digital
 */

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area container">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			if ( 1 === (int) $comment_count ) {
				esc_html_e( 'One comment', 'wellhub-digital' );
			} else {
				printf(
					/* translators: %s: comment count */
					esc_html( _n( '%s comment', '%s comments', $comment_count, 'wellhub-digital' ) ),
					esc_html( number_format_i18n( $comment_count ) )
				);
			}
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol>

		<?php the_comments_pagination(); ?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'wellhub-digital' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>
</div>
