<?php
/**
 * Blog / Resources index (used when a static front page and a separate
 * "posts page" are both configured in Settings > Reading).
 *
 * @package WellHub_Digital
 */

get_header();
?>
<main id="primary" class="site-main container">
	<?php wellhub_breadcrumbs(); ?>

	<header class="section-head">
		<h1>
			<?php
			$posts_page_id = (int) get_option( 'page_for_posts' );
			echo esc_html( $posts_page_id ? get_the_title( $posts_page_id ) : __( 'Resources', 'wellhub-digital' ) );
			?>
		</h1>
	</header>

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
