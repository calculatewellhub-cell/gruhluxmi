<?php
/**
 * CalculateWellHub Products — one-click importer for the business's real
 * digital planners (Appearance > CalculateWellHub Products).
 *
 * Unlike inc/demo-content.php (generic placeholder content for anyone
 * using this theme), this imports the actual product catalog: real
 * titles, descriptions, "what's included" lists, FAQ content and the
 * bundled PDF files, each set up as a virtual + downloadable WooCommerce
 * product. Safe to run more than once — a product already imported
 * (matched by title) is skipped, never duplicated.
 *
 * Requires WooCommerce to be active. This tool only touches standard
 * WordPress/WooCommerce data (posts, product meta, media library,
 * product_cat terms) — nothing is stored in a theme-only structure, so
 * products remain intact even if the theme changes later.
 *
 * @package WellHub_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wellhub_real_products_menu() {
	add_theme_page(
		__( 'CalculateWellHub Products', 'wellhub-digital' ),
		__( 'CalculateWellHub Products', 'wellhub-digital' ),
		'manage_options',
		'wellhub-real-products',
		'wellhub_real_products_page'
	);
}
add_action( 'admin_menu', 'wellhub_real_products_menu' );

function wellhub_real_products_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$results = null;

	if ( isset( $_POST['wellhub_import_real_products'] ) && check_admin_referer( 'wellhub_import_real_products_action', 'wellhub_import_real_products_nonce' ) ) {
		$results = wellhub_import_real_products();
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'CalculateWellHub Products', 'wellhub-digital' ); ?></h1>
		<p><?php esc_html_e( 'Imports the real Women\'s Health & Pregnancy digital planners (PDFs bundled with this theme) as WooCommerce products, with titles, descriptions, "what\'s included" lists, FAQ content and SEO meta already filled in.', 'wellhub-digital' ); ?></p>

		<?php if ( ! class_exists( 'WooCommerce' ) ) : ?>
			<div class="notice notice-error"><p><?php esc_html_e( 'WooCommerce must be installed and active before these products can be created.', 'wellhub-digital' ); ?></p></div>
		<?php else : ?>
			<?php if ( is_array( $results ) ) : ?>
				<div class="notice notice-success">
					<p>
						<?php
						printf(
							/* translators: 1: number created, 2: number skipped */
							esc_html__( 'Done — %1$d product(s) created, %2$d already existed and were skipped.', 'wellhub-digital' ),
							(int) $results['created'],
							(int) $results['skipped']
						);
						?>
					</p>
					<?php if ( ! empty( $results['links'] ) ) : ?>
						<ul>
							<?php foreach ( $results['links'] as $title => $link ) : ?>
								<li><a href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $title ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<form method="post">
				<?php wp_nonce_field( 'wellhub_import_real_products_action', 'wellhub_import_real_products_nonce' ); ?>
				<p><button type="submit" name="wellhub_import_real_products" value="1" class="button button-primary"><?php esc_html_e( 'Import CalculateWellHub Products', 'wellhub-digital' ); ?></button></p>
			</form>

			<h2><?php esc_html_e( 'What this creates', 'wellhub-digital' ); ?></h2>
			<ul style="list-style:disc; padding-left:1.5em;">
				<?php foreach ( wellhub_real_products_data() as $product ) : ?>
					<li><?php echo esc_html( $product['title'] ); ?> — <?php echo esc_html( $product['pages'] ); ?> <?php esc_html_e( 'pages', 'wellhub-digital' ); ?>, $<?php echo esc_html( $product['price'] ); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Uploads a bundled PDF into the media library (skips if a file with the
 * same name already exists there) and returns the attachment ID.
 */
function wellhub_sideload_real_product_file( $filename ) {
	$path = WELLHUB_DIR . '/inc/real-products/files/' . $filename;

	if ( ! file_exists( $path ) ) {
		return 0;
	}

	$existing_id = wellhub_find_post_by_title( $filename, 'attachment' );
	if ( $existing_id ) {
		return $existing_id;
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$upload = wp_upload_bits( $filename, null, file_get_contents( $path ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents

	if ( ! empty( $upload['error'] ) ) {
		return 0;
	}

	$attachment = array(
		'post_mime_type' => 'application/pdf',
		'post_title'     => $filename,
		'post_status'    => 'inherit',
	);

	$attachment_id = wp_insert_attachment( $attachment, $upload['file'] );

	if ( ! is_wp_error( $attachment_id ) && $attachment_id ) {
		wp_update_attachment_metadata( $attachment_id, wp_generate_attachment_metadata( $attachment_id, $upload['file'] ) );
	}

	return $attachment_id;
}

function wellhub_import_real_products() {
	$created  = 0;
	$skipped  = 0;
	$links    = array();
	$parent   = wellhub_get_or_create_term( "Women's Health", 'product_cat' );
	$cat_ids  = array();

	foreach ( wellhub_real_products_data() as $key => $data ) {

		if ( wellhub_find_post_by_title( $data['title'], 'product' ) ) {
			$skipped++;
			continue;
		}

		if ( ! isset( $cat_ids[ $data['category'] ] ) ) {
			$cat_ids[ $data['category'] ] = wellhub_get_or_create_term( $data['category'], 'product_cat', $parent );
		}

		$product = new WC_Product_Simple();
		$product->set_name( $data['title'] );
		$product->set_status( 'publish' );
		$product->set_catalog_visibility( 'visible' );
		$product->set_description( $data['description'] );
		$product->set_short_description( $data['short_description'] );
		$product->set_regular_price( $data['price'] );
		if ( ! empty( $data['sale_price'] ) ) {
			$product->set_sale_price( $data['sale_price'] );
		}
		$product->set_virtual( true );
		$product->set_downloadable( true );

		$attachment_id = wellhub_sideload_real_product_file( $data['file'] );
		if ( $attachment_id ) {
			$download = new WC_Product_Download();
			$download->set_id( wp_generate_uuid4() );
			$download->set_name( $data['title'] );
			$download->set_file( wp_get_attachment_url( $attachment_id ) );
			$product->set_downloads( array( $download ) );
		}

		$product_id = $product->save();

		wp_set_object_terms( $product_id, array( $cat_ids[ $data['category'] ], $parent ), 'product_cat' );

		update_post_meta( $product_id, '_wellhub_format', $data['format'] );
		update_post_meta( $product_id, '_wellhub_pages', $data['pages'] );
		update_post_meta( $product_id, '_wellhub_access', __( 'Digital Download', 'wellhub-digital' ) );
		update_post_meta( $product_id, '_wellhub_delivery', __( 'Instant Digital Access', 'wellhub-digital' ) );
		update_post_meta( $product_id, '_wellhub_whats_included', implode( "\n", $data['whats_included'] ) );

		$faq_lines = array();
		foreach ( $data['faq'] as $pair ) {
			$faq_lines[] = $pair[0] . ' | ' . $pair[1];
		}
		update_post_meta( $product_id, '_wellhub_faq', implode( "\n", $faq_lines ) );

		foreach ( array( 'new', 'bestseller', 'featured', 'popular', 'bundle' ) as $badge ) {
			update_post_meta( $product_id, '_wellhub_badge_' . $badge, in_array( $badge, $data['badges'], true ) ? 'yes' : 'no' );
		}

		/*
		 * SEO meta: written for both Yoast SEO and Rank Math so whichever
		 * plugin gets installed later immediately picks up real content
		 * instead of falling back to an auto-generated title/description.
		 * Harmless no-ops until one of those plugins is active.
		 */
		update_post_meta( $product_id, '_yoast_wpseo_title', $data['meta_title'] );
		update_post_meta( $product_id, '_yoast_wpseo_metadesc', $data['meta_description'] );
		update_post_meta( $product_id, '_yoast_wpseo_focuskw', $data['focus_keyword'] );
		update_post_meta( $product_id, 'rank_math_title', $data['meta_title'] );
		update_post_meta( $product_id, 'rank_math_description', $data['meta_description'] );
		update_post_meta( $product_id, 'rank_math_focus_keyword', $data['focus_keyword'] );

		$created++;
		$links[ $data['title'] ] = get_edit_post_link( $product_id, 'raw' );
	}

	return array(
		'created' => $created,
		'skipped' => $skipped,
		'links'   => $links,
	);
}
