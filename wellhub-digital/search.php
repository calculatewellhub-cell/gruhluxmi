<?php
/**
 * Search results template.
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
			/* translators: %s: search query */
			printf( esc_html__( 'Search Results for: %s', 'wellhub-digital' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
			?>
		</h1>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="grid grid-3">
			<?php
			while ( have_posts() ) :
				the_post();
				if ( class_exists( 'WooCommerce' ) && 'product' === get_post_type() ) {
					wc_get_template_part( 'content', 'product' );
				} else {
					get_template_part( 'template-parts/content' );
				}
			endwhile;
			?>
		</div>
		<?php wellhub_pagination(); ?>
	<?php else : ?>
		<?php get_template_part( 'template-parts/content', 'none' ); ?>
	<?php endif; ?>
</main>
<?php
get_footer();
