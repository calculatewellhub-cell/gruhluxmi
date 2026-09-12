<?php
/**
 * Latest blog / resources posts.
 *
 * @package WellHub_Digital
 */

$query = new WP_Query(
	array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'ignore_sticky_posts' => true,
	)
);

if ( ! $query->have_posts() ) {
	wp_reset_postdata();
	return;
}
?>
<section>
	<div class="container">
		<div class="section-head">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'Learn More', 'wellhub-digital' ); ?></span>
				<h2><?php esc_html_e( 'From the Resources Library', 'wellhub-digital' ); ?></h2>
			</div>
			<?php $posts_page_id = (int) get_option( 'page_for_posts' ); ?>
			<a class="section-link" href="<?php echo esc_url( $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/' ) ); ?>"><?php esc_html_e( 'View All', 'wellhub-digital' ); ?> &rarr;</a>
		</div>
		<div class="grid grid-3">
			<?php
			while ( $query->have_posts() ) :
				$query->the_post();
				get_template_part( 'template-parts/content' );
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
