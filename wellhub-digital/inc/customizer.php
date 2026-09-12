<?php
/**
 * Theme Customizer: brand colors, hero content, featured category,
 * contact/social details, footer text and the free-resource / newsletter
 * section. Everything here is optional and falls back to sensible,
 * business-neutral defaults so the theme never ships with hard-coded
 * marketing copy baked into templates.
 *
 * @package WellHub_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wellhub_customize_register( $wp_customize ) {

	/* ---------------------------------------------------------------
	 * Brand Colors
	 * ------------------------------------------------------------- */
	$wp_customize->add_section(
		'wellhub_brand',
		array(
			'title'    => __( 'Brand Colors', 'wellhub-digital' ),
			'priority' => 25,
		)
	);

	$wp_customize->add_setting(
		'wellhub_color_primary',
		array(
			'default'           => '#12332e',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'wellhub_color_primary',
			array(
				'label'   => __( 'Primary Color', 'wellhub-digital' ),
				'section' => 'wellhub_brand',
			)
		)
	);

	$wp_customize->add_setting(
		'wellhub_color_accent',
		array(
			'default'           => '#b6714f',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'wellhub_color_accent',
			array(
				'label'       => __( 'Accent Color', 'wellhub-digital' ),
				'description' => __( 'Used for the current flagship category. Each future category can define its own accent via a body-class CSS override — see README.', 'wellhub-digital' ),
				'section'     => 'wellhub_brand',
			)
		)
	);

	/* ---------------------------------------------------------------
	 * Hero Section
	 * ------------------------------------------------------------- */
	$wp_customize->add_section(
		'wellhub_hero',
		array(
			'title'    => __( 'Homepage Hero', 'wellhub-digital' ),
			'priority' => 30,
		)
	);

	$hero_fields = array(
		'wellhub_hero_eyebrow'     => array( 'label' => __( 'Eyebrow Text', 'wellhub-digital' ), 'default' => __( 'Digital Resources for Every Stage of Life', 'wellhub-digital' ), 'type' => 'text' ),
		'wellhub_hero_headline'    => array( 'label' => __( 'Headline', 'wellhub-digital' ), 'default' => __( 'Helpful Digital Resources, Designed for Real Life.', 'wellhub-digital' ), 'type' => 'text' ),
		'wellhub_hero_subheading'  => array( 'label' => __( 'Supporting Text', 'wellhub-digital' ), 'default' => __( 'Explore thoughtfully created guides, planners, workbooks and digital resources designed to help you learn, prepare and feel more confident.', 'wellhub-digital' ), 'type' => 'textarea' ),
		'wellhub_hero_cta_text'    => array( 'label' => __( 'Primary Button Text', 'wellhub-digital' ), 'default' => __( "Explore Women's Health", 'wellhub-digital' ), 'type' => 'text' ),
		'wellhub_hero_cta_url'     => array( 'label' => __( 'Primary Button Link', 'wellhub-digital' ), 'default' => '', 'type' => 'url' ),
		'wellhub_hero_cta2_text'   => array( 'label' => __( 'Secondary Button Text', 'wellhub-digital' ), 'default' => __( 'Shop Digital Products', 'wellhub-digital' ), 'type' => 'text' ),
		'wellhub_hero_cta2_url'    => array( 'label' => __( 'Secondary Button Link', 'wellhub-digital' ), 'default' => '', 'type' => 'url' ),
	);

	foreach ( $hero_fields as $id => $field ) {
		$sanitize = 'sanitize_text_field';
		if ( 'url' === $field['type'] ) {
			$sanitize = 'esc_url_raw';
		} elseif ( 'textarea' === $field['type'] ) {
			$sanitize = 'sanitize_textarea_field';
		}

		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $field['default'],
				'sanitize_callback' => $sanitize,
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $field['label'],
				'section' => 'wellhub_hero',
				'type'    => 'textarea' === $field['type'] ? 'textarea' : ( 'url' === $field['type'] ? 'url' : 'text' ),
			)
		);
	}

	$wp_customize->add_setting(
		'wellhub_hero_image',
		array(
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'wellhub_hero_image',
			array(
				'label'   => __( 'Hero Image', 'wellhub-digital' ),
				'section' => 'wellhub_hero',
				'mime_type' => 'image',
			)
		)
	);

	/* ---------------------------------------------------------------
	 * Featured Category (drives the flagship homepage section)
	 * ------------------------------------------------------------- */
	$wp_customize->add_section(
		'wellhub_featured',
		array(
			'title'    => __( 'Featured Category', 'wellhub-digital' ),
			'priority' => 35,
		)
	);

	$wp_customize->add_setting(
		'wellhub_featured_category',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'wellhub_featured_category',
		array(
			'label'       => __( 'Flagship Product Category', 'wellhub-digital' ),
			'description' => __( 'Select the WooCommerce category to feature on the homepage (e.g. Women\'s Health). Leave empty and this section is hidden automatically.', 'wellhub-digital' ),
			'section'     => 'wellhub_featured',
			'type'        => 'select',
			'choices'     => wellhub_get_product_category_choices(),
		)
	);

	$wp_customize->add_setting(
		'wellhub_featured_subcategories',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'wellhub_featured_subcategories',
		array(
			'label'       => __( 'Subcategory Slugs to Display', 'wellhub-digital' ),
			'description' => __( 'Comma-separated product category slugs, e.g. pregnancy, postpartum, womens-wellness', 'wellhub-digital' ),
			'section'     => 'wellhub_featured',
			'type'        => 'text',
		)
	);

	/* ---------------------------------------------------------------
	 * Contact & Social
	 * ------------------------------------------------------------- */
	$wp_customize->add_section(
		'wellhub_contact',
		array(
			'title'    => __( 'Contact & Social', 'wellhub-digital' ),
			'priority' => 40,
		)
	);

	$contact_fields = array(
		'wellhub_contact_email' => __( 'Contact Email', 'wellhub-digital' ),
		'wellhub_contact_phone' => __( 'Contact Phone', 'wellhub-digital' ),
	);
	foreach ( $contact_fields as $id => $label ) {
		$wp_customize->add_setting( $id, array( 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( $id, array( 'label' => $label, 'section' => 'wellhub_contact' ) );
	}

	$social_fields = array(
		'wellhub_social_facebook'  => 'Facebook',
		'wellhub_social_instagram' => 'Instagram',
		'wellhub_social_pinterest' => 'Pinterest',
		'wellhub_social_youtube'   => 'YouTube',
		'wellhub_social_tiktok'    => 'TikTok',
	);
	foreach ( $social_fields as $id => $label ) {
		$wp_customize->add_setting( $id, array( 'sanitize_callback' => 'esc_url_raw' ) );
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $label . ' ' . __( 'URL', 'wellhub-digital' ),
				'section' => 'wellhub_contact',
				'type'    => 'url',
			)
		);
	}

	/* ---------------------------------------------------------------
	 * Footer & Legal
	 * ------------------------------------------------------------- */
	$wp_customize->add_section(
		'wellhub_footer',
		array(
			'title'    => __( 'Footer & Disclaimer', 'wellhub-digital' ),
			'priority' => 45,
		)
	);

	$wp_customize->add_setting(
		'wellhub_footer_text',
		array(
			'default'           => sprintf( __( '&copy; %s. All rights reserved.', 'wellhub-digital' ), gmdate( 'Y' ) ),
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		'wellhub_footer_text',
		array(
			'label'   => __( 'Footer Copyright Text', 'wellhub-digital' ),
			'section' => 'wellhub_footer',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'wellhub_health_disclaimer',
		array(
			'default'           => __( 'Health-related resources are provided for general educational and informational purposes and are not a substitute for professional medical advice, diagnosis or treatment.', 'wellhub-digital' ),
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);
	$wp_customize->add_control(
		'wellhub_health_disclaimer',
		array(
			'label'       => __( 'Health Disclaimer Text', 'wellhub-digital' ),
			'description' => __( 'Shown on products belonging to the health category slugs below, and in the footer.', 'wellhub-digital' ),
			'section'     => 'wellhub_footer',
			'type'        => 'textarea',
		)
	);

	$wp_customize->add_setting(
		'wellhub_disclaimer_categories',
		array(
			'default'           => 'womens-health,pregnancy,postpartum,womens-wellness,motherhood',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'wellhub_disclaimer_categories',
		array(
			'label'       => __( 'Category Slugs Requiring the Disclaimer', 'wellhub-digital' ),
			'description' => __( 'Comma-separated product category slugs.', 'wellhub-digital' ),
			'section'     => 'wellhub_footer',
			'type'        => 'text',
		)
	);

	/* ---------------------------------------------------------------
	 * Free Resource / Lead Magnet + Newsletter
	 * ------------------------------------------------------------- */
	$wp_customize->add_section(
		'wellhub_lead_magnet',
		array(
			'title'    => __( 'Free Resource & Newsletter', 'wellhub-digital' ),
			'priority' => 50,
		)
	);

	$lead_fields = array(
		'wellhub_lead_heading'     => array( __( 'Free Resource Heading', 'wellhub-digital' ), __( 'Get a Free Resource', 'wellhub-digital' ) ),
		'wellhub_lead_description' => array( __( 'Free Resource Description', 'wellhub-digital' ), __( 'Download a free guide to get started right away.', 'wellhub-digital' ) ),
		'wellhub_lead_button_text' => array( __( 'Free Resource Button Text', 'wellhub-digital' ), __( 'Get the Free Guide', 'wellhub-digital' ) ),
		'wellhub_lead_button_url'  => array( __( 'Free Resource Button Link', 'wellhub-digital' ), '' ),
	);
	foreach ( $lead_fields as $id => $data ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $data[1],
				'sanitize_callback' => false !== strpos( $id, 'url' ) ? 'esc_url_raw' : 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $data[0],
				'section' => 'wellhub_lead_magnet',
				'type'    => false !== strpos( $id, 'url' ) ? 'url' : 'text',
			)
		);
	}

	$wp_customize->add_setting(
		'wellhub_newsletter_shortcode',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'wellhub_newsletter_shortcode',
		array(
			'label'       => __( 'Newsletter Shortcode', 'wellhub-digital' ),
			'description' => __( 'Paste the shortcode provided by your email marketing plugin (Mailchimp, ConvertKit, Brevo, etc). Leave empty to hide the newsletter form.', 'wellhub-digital' ),
			'section'     => 'wellhub_lead_magnet',
			'type'        => 'text',
		)
	);
}
add_action( 'customize_register', 'wellhub_customize_register' );

/**
 * Build a Customizer <select> choices array from live WooCommerce
 * product categories, so nothing is hard-coded.
 */
function wellhub_get_product_category_choices() {
	$choices = array( '' => __( '— Select a category —', 'wellhub-digital' ) );

	if ( ! taxonomy_exists( 'product_cat' ) ) {
		return $choices;
	}

	$terms = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => false,
		)
	);

	if ( ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			$choices[ $term->slug ] = $term->name;
		}
	}

	return $choices;
}

/**
 * Output brand color CSS variables inline so Customizer changes apply
 * without a build step.
 */
function wellhub_customizer_css() {
	$primary = get_theme_mod( 'wellhub_color_primary', '#12332e' );
	$accent  = get_theme_mod( 'wellhub_color_accent', '#b6714f' );
	?>
	<style id="wellhub-customizer-css">
		:root {
			--primary: <?php echo esc_html( $primary ); ?>;
			--accent: <?php echo esc_html( $accent ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'wellhub_customizer_css' );
