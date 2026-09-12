<?php
/**
 * Homepage template. Every section is an independent template part and
 * fails gracefully (renders nothing) when there is no matching content,
 * per the "no broken empty cards" requirement.
 *
 * @package WellHub_Digital
 */

get_header();
?>
<main id="primary" class="site-main">
	<?php get_template_part( 'template-parts/homepage/hero' ); ?>

	<?php if ( class_exists( 'WooCommerce' ) ) : ?>
		<?php get_template_part( 'template-parts/homepage/featured-category' ); ?>
		<?php get_template_part( 'template-parts/homepage/featured-products' ); ?>
		<?php get_template_part( 'template-parts/homepage/best-sellers' ); ?>
	<?php endif; ?>

	<?php get_template_part( 'template-parts/homepage/benefits' ); ?>
	<?php get_template_part( 'template-parts/homepage/how-it-works' ); ?>

	<?php if ( class_exists( 'WooCommerce' ) ) : ?>
		<?php get_template_part( 'template-parts/homepage/category-grid' ); ?>
		<?php get_template_part( 'template-parts/homepage/bundles' ); ?>
	<?php endif; ?>

	<?php get_template_part( 'template-parts/homepage/free-resource' ); ?>
	<?php get_template_part( 'template-parts/homepage/testimonials' ); ?>
	<?php get_template_part( 'template-parts/homepage/resources' ); ?>
	<?php get_template_part( 'template-parts/homepage/newsletter' ); ?>
	<?php get_template_part( 'template-parts/homepage/final-cta' ); ?>
</main>
<?php
get_footer();
