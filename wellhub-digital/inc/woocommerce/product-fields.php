<?php
/**
 * Custom WooCommerce Product Data tab: digital product info, preview,
 * "what's included" and merchandising badges. All fields are optional
 * so existing/imported products keep working without them.
 *
 * @package WellHub_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wellhub_add_product_data_tab( $tabs ) {
	$tabs['wellhub_digital'] = array(
		'label'    => __( 'Digital Details', 'wellhub-digital' ),
		'target'   => 'wellhub_product_data',
		'class'    => array(),
		'priority' => 21,
	);
	return $tabs;
}
add_filter( 'woocommerce_product_data_tabs', 'wellhub_add_product_data_tab' );

function wellhub_render_product_data_panel() {
	global $post;
	?>
	<div id="wellhub_product_data" class="panel woocommerce_options_panel">
		<div class="options_group">
			<?php
			woocommerce_wp_text_input(
				array(
					'id'          => '_wellhub_format',
					'label'       => __( 'Format', 'wellhub-digital' ),
					'placeholder' => __( 'e.g. PDF, EPUB, ZIP', 'wellhub-digital' ),
					'desc_tip'    => true,
					'description' => __( 'File format shown on the product page.', 'wellhub-digital' ),
				)
			);
			woocommerce_wp_text_input(
				array(
					'id'                => '_wellhub_pages',
					'label'             => __( 'Pages', 'wellhub-digital' ),
					'type'              => 'number',
					'custom_attributes' => array( 'min' => '0', 'step' => '1' ),
					'desc_tip'          => true,
					'description'       => __( 'Leave empty if not applicable (e.g. a template pack).', 'wellhub-digital' ),
				)
			);
			woocommerce_wp_text_input(
				array(
					'id'          => '_wellhub_access',
					'label'       => __( 'Access', 'wellhub-digital' ),
					'placeholder' => __( 'Digital Download', 'wellhub-digital' ),
				)
			);
			woocommerce_wp_text_input(
				array(
					'id'          => '_wellhub_delivery',
					'label'       => __( 'Delivery', 'wellhub-digital' ),
					'placeholder' => __( 'Instant Digital Access', 'wellhub-digital' ),
				)
			);
			woocommerce_wp_text_input(
				array(
					'id'          => '_wellhub_preview_url',
					'label'       => __( 'Preview / Sample URL', 'wellhub-digital' ),
					'type'        => 'url',
					'desc_tip'    => true,
					'description' => __( 'Link to a sample image/PDF in the Media Library. Never use the full paid file here.', 'wellhub-digital' ),
				)
			);
			woocommerce_wp_textarea_input(
				array(
					'id'          => '_wellhub_whats_included',
					'label'       => __( "What's Included", 'wellhub-digital' ),
					'desc_tip'    => true,
					'description' => __( 'One item per line, e.g. one line per file included in the bundle.', 'wellhub-digital' ),
				)
			);
			woocommerce_wp_checkbox(
				array(
					'id'          => '_wellhub_buy_now',
					'label'       => __( 'Buy Now', 'wellhub-digital' ),
					'description' => __( 'Skip the cart and send customers straight to checkout after adding this product.', 'wellhub-digital' ),
				)
			);
			woocommerce_wp_textarea_input(
				array(
					'id'          => '_wellhub_faq',
					'label'       => __( 'Product FAQ', 'wellhub-digital' ),
					'desc_tip'    => true,
					'description' => __( 'One question per line, formatted as: Question | Answer', 'wellhub-digital' ),
				)
			);
			?>
		</div>
		<div class="options_group">
			<p class="form-field"><label><?php esc_html_e( 'Merchandising Badges', 'wellhub-digital' ); ?></label></p>
			<?php
			woocommerce_wp_checkbox( array( 'id' => '_wellhub_badge_new', 'label' => __( 'New', 'wellhub-digital' ) ) );
			woocommerce_wp_checkbox( array( 'id' => '_wellhub_badge_bestseller', 'label' => __( 'Bestseller', 'wellhub-digital' ) ) );
			woocommerce_wp_checkbox( array( 'id' => '_wellhub_badge_featured', 'label' => __( 'Featured', 'wellhub-digital' ) ) );
			woocommerce_wp_checkbox( array( 'id' => '_wellhub_badge_popular', 'label' => __( 'Popular', 'wellhub-digital' ) ) );
			woocommerce_wp_checkbox( array( 'id' => '_wellhub_badge_bundle', 'label' => __( 'Bundle', 'wellhub-digital' ) ) );
			?>
			<p class="description" style="padding-left:0;"><?php esc_html_e( 'The Sale badge is automatic based on the product\'s sale price and never needs to be set manually.', 'wellhub-digital' ); ?></p>
		</div>
	</div>
	<?php
}
add_action( 'woocommerce_product_data_panels', 'wellhub_render_product_data_panel' );

function wellhub_save_product_data_fields( $post_id ) {
	$text_fields = array( '_wellhub_format', '_wellhub_pages', '_wellhub_access', '_wellhub_delivery' );
	foreach ( $text_fields as $field ) {
		if ( isset( $_POST[ $field ] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_post_meta( $post_id, $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
		}
	}

	if ( isset( $_POST['_wellhub_preview_url'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
		update_post_meta( $post_id, '_wellhub_preview_url', esc_url_raw( wp_unslash( $_POST['_wellhub_preview_url'] ) ) );
	}

	if ( isset( $_POST['_wellhub_whats_included'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
		update_post_meta( $post_id, '_wellhub_whats_included', sanitize_textarea_field( wp_unslash( $_POST['_wellhub_whats_included'] ) ) );
	}

	if ( isset( $_POST['_wellhub_faq'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
		update_post_meta( $post_id, '_wellhub_faq', sanitize_textarea_field( wp_unslash( $_POST['_wellhub_faq'] ) ) );
	}

	$checkboxes = array( '_wellhub_buy_now', '_wellhub_badge_new', '_wellhub_badge_bestseller', '_wellhub_badge_featured', '_wellhub_badge_popular', '_wellhub_badge_bundle' );
	foreach ( $checkboxes as $field ) {
		update_post_meta( $post_id, $field, isset( $_POST[ $field ] ) ? 'yes' : 'no' ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
	}
}
add_action( 'woocommerce_process_product_meta', 'wellhub_save_product_data_fields' );
