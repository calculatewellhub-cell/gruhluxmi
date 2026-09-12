<?php
/**
 * WooCommerce layout hooks: content wrapper, breadcrumbs, badges,
 * digital product info box, health disclaimer, and small cart/checkout/
 * account refinements. Everything here uses WooCommerce's own action
 * hooks rather than full template overrides.
 *
 * @package WellHub_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ---------------------------------------------------------------------
 * Content wrapper (replaces WooCommerce's default unstyled wrapper)
 * ------------------------------------------------------------------- */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

function wellhub_wc_wrapper_start() {
	echo '<main id="primary" class="site-main woocommerce-wrapper"><div class="container">';
	wellhub_breadcrumbs();
}
add_action( 'woocommerce_before_main_content', 'wellhub_wc_wrapper_start', 10 );

function wellhub_wc_wrapper_end() {
	echo '</div></main>';
}
add_action( 'woocommerce_after_main_content', 'wellhub_wc_wrapper_end', 10 );

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/* ---------------------------------------------------------------------
 * Shop toolbar: wrap the native result-count + ordering dropdown so they
 * sit on one styled row, without overriding archive-product.php.
 * ------------------------------------------------------------------- */
function wellhub_shop_toolbar_open() {
	echo '<div class="shop-toolbar">';
}
add_action( 'woocommerce_before_shop_loop', 'wellhub_shop_toolbar_open', 5 );

function wellhub_shop_toolbar_close() {
	echo '</div>';
}
add_action( 'woocommerce_before_shop_loop', 'wellhub_shop_toolbar_close', 31 );

/* ---------------------------------------------------------------------
 * Badges — unify Sale + admin-selected badges into one component and
 * remove WooCommerce's default "Sale!" flash so they never duplicate.
 * ------------------------------------------------------------------- */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

/**
 * The card renders price in its own markup (see woocommerce/content-product.php)
 * so the default price hook is removed to avoid printing it twice; the
 * rating hook on the same action is left untouched.
 */
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

function wellhub_get_product_badges( $product ) {
	if ( ! $product instanceof WC_Product ) {
		return array();
	}

	$badges = array();

	if ( $product->is_on_sale() ) {
		$badges[] = array( 'label' => __( 'Sale', 'wellhub-digital' ), 'class' => 'badge-sale' );
	}

	$flags = array(
		'_wellhub_badge_new'        => array( __( 'New', 'wellhub-digital' ), 'badge-new' ),
		'_wellhub_badge_bestseller' => array( __( 'Bestseller', 'wellhub-digital' ), 'badge-bestseller' ),
		'_wellhub_badge_featured'   => array( __( 'Featured', 'wellhub-digital' ), 'badge-featured' ),
		'_wellhub_badge_popular'    => array( __( 'Popular', 'wellhub-digital' ), 'badge-popular' ),
		'_wellhub_badge_bundle'     => array( __( 'Bundle', 'wellhub-digital' ), 'badge-bundle' ),
	);

	foreach ( $flags as $meta_key => $data ) {
		if ( 'yes' === $product->get_meta( $meta_key ) ) {
			$badges[] = array( 'label' => $data[0], 'class' => $data[1] );
		}
	}

	if ( $product->is_virtual() || $product->is_downloadable() ) {
		$badges[] = array( 'label' => __( 'Digital Download', 'wellhub-digital' ), 'class' => 'badge-digital' );
	}

	return $badges;
}

function wellhub_render_product_badges( $product ) {
	$badges = wellhub_get_product_badges( $product );

	if ( empty( $badges ) ) {
		return;
	}

	echo '<div class="product-badges">';
	foreach ( $badges as $badge ) {
		echo '<span class="badge ' . esc_attr( $badge['class'] ) . '">' . esc_html( $badge['label'] ) . '</span>';
	}
	echo '</div>';
}

function wellhub_single_product_badges() {
	global $product;
	wellhub_render_product_badges( $product );
}
add_action( 'woocommerce_single_product_summary', 'wellhub_single_product_badges', 4 );

/* ---------------------------------------------------------------------
 * Digital product info box: Format / Pages / Access / Delivery
 * ------------------------------------------------------------------- */
function wellhub_render_digital_info_box( $product ) {
	if ( ! $product instanceof WC_Product ) {
		return;
	}

	$format   = $product->get_meta( '_wellhub_format' );
	$pages    = $product->get_meta( '_wellhub_pages' );
	$access   = $product->get_meta( '_wellhub_access' );
	$delivery = $product->get_meta( '_wellhub_delivery' );

	if ( ! $access ) {
		$access = __( 'Digital Download', 'wellhub-digital' );
	}
	if ( ! $delivery ) {
		$delivery = __( 'Instant Digital Access', 'wellhub-digital' );
	}

	echo '<div class="digital-info-box">';

	if ( $format ) {
		echo '<div class="info-item"><span class="label">' . esc_html__( 'Format', 'wellhub-digital' ) . '</span><span class="value">' . esc_html( $format ) . '</span></div>';
	}
	if ( $pages ) {
		/* translators: %s: number of pages */
		echo '<div class="info-item"><span class="label">' . esc_html__( 'Pages', 'wellhub-digital' ) . '</span><span class="value">' . esc_html( sprintf( __( '%s pages', 'wellhub-digital' ), $pages ) ) . '</span></div>';
	}
	echo '<div class="info-item"><span class="label">' . esc_html__( 'Access', 'wellhub-digital' ) . '</span><span class="value">' . esc_html( $access ) . '</span></div>';
	echo '<div class="info-item"><span class="label">' . esc_html__( 'Delivery', 'wellhub-digital' ) . '</span><span class="value">' . esc_html( $delivery ) . '</span></div>';

	echo '</div>';
}

function wellhub_single_digital_info() {
	global $product;
	wellhub_render_digital_info_box( $product );
}
add_action( 'woocommerce_single_product_summary', 'wellhub_single_digital_info', 25 );

/* ---------------------------------------------------------------------
 * What's Included + Preview Sample, shown before the tabs/reviews.
 * ------------------------------------------------------------------- */
function wellhub_whats_included_and_preview() {
	global $product;

	if ( ! $product instanceof WC_Product ) {
		return;
	}

	$included = $product->get_meta( '_wellhub_whats_included' );
	$preview  = $product->get_meta( '_wellhub_preview_url' );

	if ( $included ) {
		$items = array_filter( array_map( 'trim', explode( "\n", $included ) ) );
		if ( $items ) {
			echo '<div class="whats-included container"><h3>' . esc_html__( "What's Included", 'wellhub-digital' ) . '</h3><ul>';
			foreach ( $items as $item ) {
				echo '<li>' . esc_html( $item ) . '</li>';
			}
			echo '</ul></div>';
		}
	}

	if ( $preview ) {
		echo '<div class="container" style="margin-bottom:1.5rem;"><a class="btn btn-outline" href="' . esc_url( $preview ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Preview Sample', 'wellhub-digital' ) . '</a></div>';
	}
}
add_action( 'woocommerce_after_single_product_summary', 'wellhub_whats_included_and_preview', 4 );

/* ---------------------------------------------------------------------
 * Product FAQ — added as its own tab only when a product has FAQ
 * content, using WooCommerce's own tabs filter (no template override).
 * ------------------------------------------------------------------- */
function wellhub_add_faq_tab( $tabs ) {
	global $product;

	if ( ! $product instanceof WC_Product || ! $product->get_meta( '_wellhub_faq' ) ) {
		return $tabs;
	}

	$tabs['wellhub_faq'] = array(
		'title'    => __( 'FAQ', 'wellhub-digital' ),
		'priority' => 25,
		'callback' => 'wellhub_render_faq_tab',
	);

	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'wellhub_add_faq_tab' );

function wellhub_render_faq_tab() {
	global $product;

	$raw   = $product->get_meta( '_wellhub_faq' );
	$lines = array_filter( array_map( 'trim', explode( "\n", $raw ) ) );

	if ( empty( $lines ) ) {
		return;
	}

	echo '<div class="product-accordion">';
	foreach ( $lines as $line ) {
		$parts = array_map( 'trim', explode( '|', $line, 2 ) );
		if ( count( $parts ) < 2 ) {
			continue;
		}
		echo '<details><summary>' . esc_html( $parts[0] ) . '</summary><p>' . esc_html( $parts[1] ) . '</p></details>';
	}
	echo '</div>';
}

/* ---------------------------------------------------------------------
 * Health disclaimer — shown on products in configured category slugs,
 * never as a medical claim, purely informational per project policy.
 * ------------------------------------------------------------------- */
function wellhub_maybe_show_health_disclaimer() {
	global $product;

	if ( ! $product instanceof WC_Product ) {
		return;
	}

	$flagged_slugs = wellhub_mod_to_slug_array( 'wellhub_disclaimer_categories', 'womens-health,pregnancy,postpartum,womens-wellness,motherhood' );

	if ( empty( $flagged_slugs ) || ! has_term( $flagged_slugs, 'product_cat', $product->get_id() ) ) {
		return;
	}

	$text = get_theme_mod( 'wellhub_health_disclaimer' );
	if ( ! $text ) {
		return;
	}

	echo '<div class="health-disclaimer">' . esc_html( $text ) . '</div>';
}
add_action( 'woocommerce_single_product_summary', 'wellhub_maybe_show_health_disclaimer', 36 );

/* ---------------------------------------------------------------------
 * Cart & Checkout: clarify there is no physical shipping.
 * ------------------------------------------------------------------- */
function wellhub_no_shipping_notice() {
	if ( ! WC()->cart || WC()->cart->needs_shipping() ) {
		return;
	}
	echo '<p class="no-shipping-note">' . esc_html__( 'No physical shipping required — every item in your cart is a digital product.', 'wellhub-digital' ) . '</p>';
}
add_action( 'woocommerce_before_cart_table', 'wellhub_no_shipping_notice' );
add_action( 'woocommerce_review_order_before_payment', 'wellhub_no_shipping_notice' );

/* ---------------------------------------------------------------------
 * Optional per-product "Buy Now" — safely redirects to checkout using
 * WooCommerce's own redirect filter, no custom payment logic involved.
 * ------------------------------------------------------------------- */
function wellhub_maybe_redirect_to_checkout( $url ) {
	if ( isset( $_REQUEST['add-to-cart'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$product_id = absint( $_REQUEST['add-to-cart'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$product    = wc_get_product( $product_id );

		if ( $product && 'yes' === $product->get_meta( '_wellhub_buy_now' ) ) {
			return wc_get_checkout_url();
		}
	}

	return $url;
}
add_filter( 'woocommerce_add_to_cart_redirect', 'wellhub_maybe_redirect_to_checkout' );

/* ---------------------------------------------------------------------
 * My Account: keep the native downloads/orders experience, just make
 * sure the navigation groups nicely (styling only, no logic changes).
 * ------------------------------------------------------------------- */
function wellhub_account_menu_items( $items ) {
	return $items;
}
add_filter( 'woocommerce_account_menu_items', 'wellhub_account_menu_items' );

/**
 * Number of columns used by the [products] / [related_products] /
 * cross-sell shortcodes rendered through template-parts.
 */
function wellhub_get_products_grid( $args = array() ) {
	$defaults = array(
		'status'   => 'publish',
		'limit'    => 8,
		'orderby'  => 'date',
		'order'    => 'DESC',
		'category' => array(),
	);

	return wc_get_products( wp_parse_args( $args, $defaults ) );
}

/**
 * Render an array of WC_Product objects using the theme's
 * woocommerce/content-product.php override, inside WooCommerce's own
 * "products" list markup so core styles/AJAX add-to-cart still apply.
 * Used by homepage sections instead of hand-written product cards.
 */
function wellhub_render_product_cards( $products, $grid_class = 'grid-4' ) {
	if ( empty( $products ) ) {
		return;
	}

	echo '<ul class="products ' . esc_attr( $grid_class ) . '">';

	foreach ( $products as $product_item ) {
		$product_obj = is_a( $product_item, 'WC_Product' ) ? $product_item : wc_get_product( $product_item );

		if ( ! $product_obj ) {
			continue;
		}

		$post_object = get_post( $product_obj->get_id() );
		if ( ! $post_object ) {
			continue;
		}

		global $product;
		$product = $product_obj; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		setup_postdata( $GLOBALS['post'] = $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

		wc_get_template_part( 'content', 'product' );
	}

	wp_reset_postdata();
	echo '</ul>';
}
