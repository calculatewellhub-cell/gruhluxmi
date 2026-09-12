<?php
/**
 * Theme support, navigation menus, sidebars and image sizes.
 *
 * @package WellHub_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wellhub_setup() {
	load_theme_textdomain( 'wellhub-digital', WELLHUB_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_theme_support(
		'html5',
		array( 'gallery', 'caption' )
	);

	set_post_thumbnail_size( 800, 800, true );
	add_image_size( 'wellhub-card', 640, 800, true );
	add_image_size( 'wellhub-category-tile', 640, 480, true );
	add_image_size( 'wellhub-article', 640, 400, true );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'wellhub-digital' ),
			'footer-shop'      => __( 'Footer: Shop', 'wellhub-digital' ),
			'footer-resources' => __( 'Footer: Resources', 'wellhub-digital' ),
			'footer-company'   => __( 'Footer: Company', 'wellhub-digital' ),
			'footer-legal'     => __( 'Footer: Legal', 'wellhub-digital' ),
			'social'           => __( 'Social Links Menu', 'wellhub-digital' ),
		)
	);
}
add_action( 'after_setup_theme', 'wellhub_setup' );

/**
 * WooCommerce support is declared separately in inc/woocommerce/woocommerce-setup.php
 * so it only loads when WooCommerce is active.
 */

function wellhub_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wellhub_content_width', 800 );
}
add_action( 'after_setup_theme', 'wellhub_content_width', 0 );

function wellhub_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'wellhub-digital' ),
			'id'            => 'sidebar-blog',
			'description'   => __( 'Displayed alongside blog posts and the resources archive.', 'wellhub-digital' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s shop-filter-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Shop Sidebar', 'wellhub-digital' ),
			'id'            => 'sidebar-shop',
			'description'   => __( 'Displayed on the shop and product category pages.', 'wellhub-digital' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s shop-filter-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Widget Area', 'wellhub-digital' ),
			'id'            => 'footer-widgets',
			'description'   => __( 'Optional widgets shown above the footer menus.', 'wellhub-digital' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'wellhub_widgets_init' );

/**
 * Add the current product category slug(s) to body_class so CSS can scope
 * an accent color per category without touching global tokens.
 */
function wellhub_body_classes( $classes ) {
	if ( function_exists( 'is_product' ) && ( is_product() || is_product_category() ) ) {
		$terms = array();

		if ( is_product() ) {
			$terms = get_the_terms( get_the_ID(), 'product_cat' );
		} elseif ( is_product_category() ) {
			$queried = get_queried_object();
			if ( $queried ) {
				$terms = array( $queried );
			}
		}

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$classes[] = 'term-' . sanitize_html_class( $term->slug );
			}
		}
	}

	return $classes;
}
add_filter( 'body_class', 'wellhub_body_classes' );
