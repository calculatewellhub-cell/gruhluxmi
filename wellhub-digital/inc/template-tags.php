<?php
/**
 * Reusable template helpers: breadcrumbs, reading time, related posts,
 * excerpt trimming and small utility getters.
 *
 * @package WellHub_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Lightweight breadcrumb trail. Steps aside automatically if an SEO
 * plugin (Yoast, RankMath, AIOSEO) already prints its own, to avoid
 * duplicate/conflicting markup.
 */
function wellhub_breadcrumbs() {
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		yoast_breadcrumb( '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'wellhub-digital' ) . '">', '</nav>' );
		return;
	}
	if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
		rank_math_the_breadcrumbs();
		return;
	}
	if ( is_front_page() ) {
		return;
	}

	$crumbs = array(
		'<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'wellhub-digital' ) . '</a>',
	);

	if ( function_exists( 'is_shop' ) && is_shop() ) {
		$crumbs[] = esc_html( wc_get_page_permalink( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : __( 'Shop', 'wellhub-digital' ) );
	} elseif ( function_exists( 'is_product_category' ) && is_product_category() ) {
		$crumbs[] = '<a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '">' . esc_html__( 'Shop', 'wellhub-digital' ) . '</a>';
		$crumbs[] = esc_html( single_term_title( '', false ) );
	} elseif ( function_exists( 'is_product' ) && is_product() ) {
		$crumbs[] = '<a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '">' . esc_html__( 'Shop', 'wellhub-digital' ) . '</a>';
		$terms = get_the_terms( get_the_ID(), 'product_cat' );
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			$term       = array_shift( $terms );
			$crumbs[]   = '<a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
		}
		$crumbs[] = esc_html( get_the_title() );
	} elseif ( is_singular( 'post' ) ) {
		$crumbs[] = '<a href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '">' . esc_html__( 'Resources', 'wellhub-digital' ) . '</a>';
		$crumbs[] = esc_html( get_the_title() );
	} elseif ( is_category() || is_tag() ) {
		$crumbs[] = esc_html( single_term_title( '', false ) );
	} elseif ( is_search() ) {
		$crumbs[] = esc_html__( 'Search Results', 'wellhub-digital' );
	} elseif ( is_404() ) {
		$crumbs[] = esc_html__( 'Page Not Found', 'wellhub-digital' );
	} elseif ( is_page() ) {
		$crumbs[] = esc_html( get_the_title() );
	}

	if ( count( $crumbs ) < 2 ) {
		return;
	}

	echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'wellhub-digital' ) . '">' .
		wp_kses_post( implode( ' &rsaquo; ', $crumbs ) ) .
		'</nav>';
}

/**
 * Estimated reading time for a post, ~200 words per minute.
 */
function wellhub_reading_time( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$content = get_post_field( 'post_content', $post_id );
	$word_count = str_word_count( wp_strip_all_tags( $content ) );
	$minutes    = max( 1, (int) ceil( $word_count / 200 ) );

	/* translators: %d: number of minutes */
	return sprintf( _n( '%d min read', '%d min read', $minutes, 'wellhub-digital' ), $minutes );
}

/**
 * Related posts by shared category, excluding the current post.
 */
function wellhub_related_posts( $post_id, $number = 3 ) {
	$categories = wp_get_post_categories( $post_id );

	if ( empty( $categories ) ) {
		return new WP_Query( array( 'post__not_in' => array( $post_id ), 'posts_per_page' => 0 ) );
	}

	return new WP_Query(
		array(
			'category__in'   => $categories,
			'post__not_in'   => array( $post_id ),
			'posts_per_page' => $number,
			'ignore_sticky_posts' => true,
		)
	);
}

/**
 * Comma-separated theme-mod string to a clean array of slugs.
 */
function wellhub_mod_to_slug_array( $mod_name, $default = '' ) {
	$raw   = get_theme_mod( $mod_name, $default );
	$slugs = array_filter( array_map( 'trim', explode( ',', (string) $raw ) ) );
	return array_map( 'sanitize_title', $slugs );
}

function wellhub_pagination() {
	the_posts_pagination(
		array(
			'mid_size'  => 1,
			'prev_text' => __( '&larr; Previous', 'wellhub-digital' ),
			'next_text' => __( 'Next &rarr;', 'wellhub-digital' ),
		)
	);
}
