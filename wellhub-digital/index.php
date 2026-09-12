<?php
/**
 * Fallback template.
 *
 * @package WellHub_Digital
 */

get_header();
?>
<main id="primary" class="site-main container">
	<?php wellhub_breadcrumbs(); ?>

	<div class="shop-layout <?php echo is_active_sidebar( 'sidebar-blog' ) ? 'has-sidebar' : ''; ?>">
		<div>
			<?php if ( have_posts() ) : ?>
				<div class="grid grid-3">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content' );
					endwhile;
					?>
				</div>
				<?php wellhub_pagination(); ?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</main>
<?php
get_footer();
