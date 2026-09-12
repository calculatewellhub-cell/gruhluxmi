<?php
/**
 * Standard Page template.
 *
 * @package WellHub_Digital
 */

get_header();
?>
<main id="primary" class="site-main container">
	<?php wellhub_breadcrumbs(); ?>

	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content', 'page' );

		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	endwhile;
	?>
</main>
<?php
get_footer();
