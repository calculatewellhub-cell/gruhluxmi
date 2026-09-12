<?php
/**
 * Shown when no posts/products match a query.
 *
 * @package WellHub_Digital
 */
?>
<section class="no-results">
	<h2><?php esc_html_e( 'Nothing found', 'wellhub-digital' ); ?></h2>
	<?php if ( is_search() ) : ?>
		<p><?php esc_html_e( 'Your search did not match anything. Try a different keyword.', 'wellhub-digital' ); ?></p>
		<?php get_search_form(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'It looks like there is nothing here yet. Check back soon.', 'wellhub-digital' ); ?></p>
	<?php endif; ?>
</section>
