<?php
/**
 * One-click DEMO content installer (Appearance > Demo Content).
 *
 * This is a theme convenience utility, not core business logic: it only
 * creates ordinary WordPress pages, WooCommerce product categories and a
 * handful of sample WooCommerce products so the theme is easy to preview
 * on a fresh Hostinger install. Everything it creates is standard
 * WordPress/WooCommerce content — nothing is stored in a theme-only
 * structure, so none of it is lost if the theme is ever changed later.
 *
 * All sample products are clearly demo content. Replace them before
 * launching a real store — see README.md.
 *
 * @package WellHub_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wellhub_demo_content_menu() {
	add_theme_page(
		__( 'Demo Content', 'wellhub-digital' ),
		__( 'Demo Content', 'wellhub-digital' ),
		'manage_options',
		'wellhub-demo-content',
		'wellhub_demo_content_page'
	);
}
add_action( 'admin_menu', 'wellhub_demo_content_menu' );

function wellhub_demo_content_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$installed = false;

	if ( isset( $_POST['wellhub_install_demo'] ) && check_admin_referer( 'wellhub_install_demo_action', 'wellhub_install_demo_nonce' ) ) {
		wellhub_install_demo_content();
		$installed = true;
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'WellHub Digital — Demo Content', 'wellhub-digital' ); ?></h1>
		<p><?php esc_html_e( 'Installs sample pages, WooCommerce product categories and a handful of demo digital products so you can preview the theme immediately. Safe to run more than once — existing items with matching titles are skipped.', 'wellhub-digital' ); ?></p>
		<p><strong><?php esc_html_e( 'Important: sample products use placeholder text and prices. Replace or delete them before launching your real store.', 'wellhub-digital' ); ?></strong></p>
		<?php if ( $installed ) : ?>
			<div class="notice notice-success"><p><?php esc_html_e( 'Demo content installed.', 'wellhub-digital' ); ?></p></div>
		<?php endif; ?>
		<?php if ( ! class_exists( 'WooCommerce' ) ) : ?>
			<div class="notice notice-warning"><p><?php esc_html_e( 'WooCommerce is not active — pages will still be created, but demo product categories and products will be skipped until WooCommerce is installed.', 'wellhub-digital' ); ?></p></div>
		<?php endif; ?>
		<form method="post">
			<?php wp_nonce_field( 'wellhub_install_demo_action', 'wellhub_install_demo_nonce' ); ?>
			<p><button type="submit" name="wellhub_install_demo" value="1" class="button button-primary"><?php esc_html_e( 'Install Demo Content', 'wellhub-digital' ); ?></button></p>
		</form>
	</div>
	<?php
}

function wellhub_find_post_by_title( $title, $post_type ) {
	$query = new WP_Query(
		array(
			'post_type'              => $post_type,
			'title'                  => $title,
			'post_status'            => 'any',
			'posts_per_page'         => 1,
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		)
	);

	return $query->have_posts() ? $query->posts[0]->ID : 0;
}

function wellhub_install_demo_content() {
	// ---- Pages -------------------------------------------------------
	$pages = array(
		'About'          => __( 'Tell your story here: who you are, why you created these resources, and why customers can trust you.', 'wellhub-digital' ),
		'Contact'        => __( 'Add your contact form, email address and support hours here.', 'wellhub-digital' ),
		'Refund Policy'  => __( 'Describe your refund policy for digital products here.', 'wellhub-digital' ),
		'Disclaimer'     => get_theme_mod( 'wellhub_health_disclaimer', __( 'Health-related resources are provided for general educational and informational purposes and are not a substitute for professional medical advice, diagnosis or treatment.', 'wellhub-digital' ) ),
	);

	foreach ( $pages as $title => $content ) {
		if ( wellhub_find_post_by_title( $title, 'page' ) ) {
			continue;
		}
		wp_insert_post(
			array(
				'post_title'   => $title,
				'post_content' => wp_kses_post( $content ),
				'post_status'  => 'publish',
				'post_type'    => 'page',
			)
		);
	}

	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	// ---- Product categories -------------------------------------------
	$parent_id = wellhub_get_or_create_term( "Women's Health", 'product_cat' );
	$children  = array( 'Pregnancy', 'Postpartum', "Women's Wellness", 'Motherhood' );
	$child_ids = array();
	foreach ( $children as $child ) {
		$child_ids[ $child ] = wellhub_get_or_create_term( $child, 'product_cat', $parent_id );
	}

	// ---- Sample products -----------------------------------------------
	$products = array(
		array( 'title' => 'Pregnancy Planning Workbook', 'price' => 12, 'cat' => 'Pregnancy', 'featured' => true, 'format' => 'PDF', 'pages' => 48 ),
		array( 'title' => 'First Trimester Guide', 'price' => 9, 'cat' => 'Pregnancy', 'bestseller' => true, 'format' => 'PDF', 'pages' => 32 ),
		array( 'title' => 'Pregnancy Checklist', 'price' => 6, 'cat' => 'Pregnancy', 'new' => true, 'format' => 'PDF', 'pages' => 12 ),
		array( 'title' => 'Hospital Bag Checklist', 'price' => 5, 'cat' => 'Pregnancy', 'format' => 'PDF', 'pages' => 8 ),
		array( 'title' => 'New Mom Planner', 'price' => 14, 'cat' => 'Postpartum', 'bestseller' => true, 'format' => 'PDF', 'pages' => 60 ),
		array( 'title' => 'Prenatal Wellness Journal', 'price' => 11, 'cat' => "Women's Wellness", 'format' => 'PDF', 'pages' => 40 ),
		array( 'title' => 'Pregnancy Starter Bundle', 'price' => 29, 'sale' => 22, 'cat' => 'Pregnancy', 'bundle' => true, 'format' => 'ZIP (4 PDFs)', 'pages' => '' ),
	);

	foreach ( $products as $data ) {
		if ( wellhub_find_post_by_title( $data['title'], 'product' ) ) {
			continue;
		}

		$product = new WC_Product_Simple();
		$product->set_name( $data['title'] );
		$product->set_status( 'publish' );
		$product->set_catalog_visibility( 'visible' );
		$product->set_description( __( 'Demo product description. Replace with real product copy before launch.', 'wellhub-digital' ) );
		$product->set_short_description( __( 'Demo short description for the product card and top of the product page.', 'wellhub-digital' ) );
		$product->set_regular_price( (string) $data['price'] );
		if ( ! empty( $data['sale'] ) ) {
			$product->set_sale_price( (string) $data['sale'] );
		}
		$product->set_virtual( true );
		$product->set_downloadable( true );

		$product_id = $product->save();

		if ( ! empty( $data['cat'] ) && isset( $child_ids[ $data['cat'] ] ) ) {
			wp_set_object_terms( $product_id, array( $child_ids[ $data['cat'] ], $parent_id ), 'product_cat' );
		}

		update_post_meta( $product_id, '_wellhub_access', __( 'Digital Download', 'wellhub-digital' ) );
		update_post_meta( $product_id, '_wellhub_delivery', __( 'Instant Digital Access', 'wellhub-digital' ) );
		if ( ! empty( $data['format'] ) ) {
			update_post_meta( $product_id, '_wellhub_format', $data['format'] );
		}
		if ( ! empty( $data['pages'] ) ) {
			update_post_meta( $product_id, '_wellhub_pages', $data['pages'] );
		}
		update_post_meta( $product_id, '_wellhub_badge_new', ! empty( $data['new'] ) ? 'yes' : 'no' );
		update_post_meta( $product_id, '_wellhub_badge_bestseller', ! empty( $data['bestseller'] ) ? 'yes' : 'no' );
		update_post_meta( $product_id, '_wellhub_badge_featured', ! empty( $data['featured'] ) ? 'yes' : 'no' );
		update_post_meta( $product_id, '_wellhub_badge_bundle', ! empty( $data['bundle'] ) ? 'yes' : 'no' );
	}

	set_theme_mod( 'wellhub_featured_category', "womens-health" );
}

function wellhub_get_or_create_term( $name, $taxonomy, $parent = 0 ) {
	$existing = get_term_by( 'name', $name, $taxonomy );
	if ( $existing ) {
		return (int) $existing->term_id;
	}

	$result = wp_insert_term( $name, $taxonomy, array( 'parent' => $parent ) );
	return is_wp_error( $result ) ? 0 : (int) $result['term_id'];
}
