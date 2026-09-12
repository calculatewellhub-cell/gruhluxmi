<?php
/**
 * Blog post card / single content template part.
 *
 * @package WellHub_Digital
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( is_singular() ? 'entry' : 'article-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="article-thumb">
			<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="<?php echo is_singular() ? 'false' : 'true'; ?>">
				<?php the_post_thumbnail( is_singular() ? 'large' : 'wellhub-article' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="<?php echo is_singular() ? 'entry-content container' : 'article-body'; ?>">
		<p class="article-meta">
			<?php
			echo esc_html( get_the_date() );
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				echo ' &middot; ' . esc_html( $categories[0]->name );
			}
			echo ' &middot; ' . esc_html( wellhub_reading_time() );
			?>
		</p>

		<?php if ( is_singular() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php the_content(); ?>
			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wellhub-digital' ),
					'after'  => '</div>',
				)
			);
			?>
		<?php else : ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
			<a class="btn-ghost btn" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'wellhub-digital' ); ?> &rarr;</a>
		<?php endif; ?>
	</div>
</article>
