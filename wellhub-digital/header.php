<?php
/**
 * The header for the WellHub Digital theme.
 *
 * @package WellHub_Digital
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wellhub-digital' ); ?></a>

<div id="page" class="site">

<header class="site-header" id="masthead">
	<div class="container header-inner">
		<div class="site-branding">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				$description = get_bloginfo( 'description', 'display' );
				if ( $description ) :
					?>
					<p class="site-description"><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>
				<?php
			}
			?>
		</div>

		<nav class="primary-navigation" id="site-navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'wellhub-digital' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>

		<div class="header-actions">
			<button class="header-icon-link" id="search-toggle" aria-expanded="false" aria-controls="header-search-form" aria-label="<?php esc_attr_e( 'Search', 'wellhub-digital' ); ?>">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="7"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
			</button>

			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<a class="header-icon-link" href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>" aria-label="<?php esc_attr_e( 'My Account', 'wellhub-digital' ); ?>">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
				</a>
				<a class="header-icon-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="<?php esc_attr_e( 'Cart', 'wellhub-digital' ); ?>">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
					<span class="cart-count wellhub-cart-count"><?php echo esc_html( WC()->cart ? WC()->cart->get_cart_contents_count() : 0 ); ?></span>
				</a>
			<?php endif; ?>

			<button class="menu-toggle" id="mobile-menu-toggle" aria-expanded="false" aria-controls="mobile-navigation" aria-label="<?php esc_attr_e( 'Menu', 'wellhub-digital' ); ?>">
				<svg class="icon-open" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
				<svg class="icon-close" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
			</button>
		</div>
	</div>

	<div class="header-search container" id="header-search-form">
		<?php get_search_form(); ?>
	</div>
</header>

<div class="mobile-navigation" id="mobile-navigation">
	<div class="mobile-nav-header">
		<span class="site-title"><?php bloginfo( 'name' ); ?></span>
		<button class="menu-toggle" id="mobile-menu-close" aria-label="<?php esc_attr_e( 'Close menu', 'wellhub-digital' ); ?>">
			<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
		</button>
	</div>
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'container'      => false,
			'fallback_cb'    => false,
		)
	);
	?>
</div>
