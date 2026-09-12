<?php
/**
 * Standard WordPress Page content.
 *
 * @package WellHub_Digital
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<h1 class="entry-title"><?php the_title(); ?></h1>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="page-thumb" style="margin-bottom:1.5rem;">
			<?php the_post_thumbnail( 'large' ); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content();
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wellhub-digital' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>
</article>
