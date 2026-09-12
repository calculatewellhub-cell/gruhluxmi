<?php
/**
 * Single blog post template.
 *
 * @package WellHub_Digital
 */

get_header();
?>
<main id="primary" class="site-main container">
	<?php wellhub_breadcrumbs(); ?>

	<div class="shop-layout <?php echo is_active_sidebar( 'sidebar-blog' ) ? 'has-sidebar' : ''; ?>">
		<div>
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content' );

				$related = wellhub_related_posts( get_the_ID(), 3 );
				if ( $related->have_posts() ) :
					?>
					<div class="related-posts container">
						<h2><?php esc_html_e( 'Related Reading', 'wellhub-digital' ); ?></h2>
						<div class="grid grid-3">
							<?php
							while ( $related->have_posts() ) :
								$related->the_post();
								get_template_part( 'template-parts/content' );
							endwhile;
							wp_reset_postdata();
							?>
						</div>
					</div>
				<?php endif; ?>

				<div class="container">
					<?php
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					?>
				</div>
			<?php endwhile; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</main>
<?php
get_footer();
