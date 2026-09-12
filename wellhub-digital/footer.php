<?php
/**
 * The footer for the WellHub Digital theme.
 *
 * @package WellHub_Digital
 */
?>
	<footer class="site-footer" id="colophon">
		<div class="container">
			<?php if ( is_active_sidebar( 'footer-widgets' ) ) : ?>
				<div class="footer-widgets">
					<?php dynamic_sidebar( 'footer-widgets' ); ?>
				</div>
			<?php endif; ?>

			<div class="footer-columns">
				<div class="footer-brand">
					<p class="site-title" style="color:#fff;">
						<?php
						if ( has_custom_logo() ) {
							the_custom_logo();
						} else {
							bloginfo( 'name' );
						}
						?>
					</p>
					<p><?php bloginfo( 'description' ); ?></p>
					<?php
					$socials = array(
						'wellhub_social_facebook'  => __( 'Facebook', 'wellhub-digital' ),
						'wellhub_social_instagram' => __( 'Instagram', 'wellhub-digital' ),
						'wellhub_social_pinterest' => __( 'Pinterest', 'wellhub-digital' ),
						'wellhub_social_youtube'   => __( 'YouTube', 'wellhub-digital' ),
						'wellhub_social_tiktok'    => __( 'TikTok', 'wellhub-digital' ),
					);
					$has_social = false;
					foreach ( $socials as $mod => $label ) {
						if ( get_theme_mod( $mod ) ) {
							$has_social = true;
							break;
						}
					}
					if ( $has_social || has_nav_menu( 'social' ) ) :
						?>
						<div class="footer-social">
							<?php
							foreach ( $socials as $mod => $label ) {
								$url = get_theme_mod( $mod );
								if ( $url ) {
									printf( '<a href="%s" aria-label="%s" target="_blank" rel="noopener noreferrer">%s</a>', esc_url( $url ), esc_attr( $label ), esc_html( mb_substr( $label, 0, 1 ) ) );
								}
							}
							?>
						</div>
					<?php endif; ?>
				</div>

				<div class="footer-nav-col">
					<h3><?php esc_html_e( 'Shop', 'wellhub-digital' ); ?></h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer-shop',
							'container'      => false,
							'fallback_cb'    => false,
							'items_wrap'     => '<ul>%3$s</ul>',
						)
					);
					?>
				</div>

				<div class="footer-nav-col">
					<h3><?php esc_html_e( 'Resources', 'wellhub-digital' ); ?></h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer-resources',
							'container'      => false,
							'fallback_cb'    => false,
							'items_wrap'     => '<ul>%3$s</ul>',
						)
					);
					?>
				</div>

				<div class="footer-nav-col">
					<h3><?php esc_html_e( 'Company', 'wellhub-digital' ); ?></h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer-company',
							'container'      => false,
							'fallback_cb'    => false,
							'items_wrap'     => '<ul>%3$s</ul>',
						)
					);
					?>
					<?php
					$phone = get_theme_mod( 'wellhub_contact_phone' );
					$email = get_theme_mod( 'wellhub_contact_email' );
					if ( $phone || $email ) :
						?>
						<ul style="margin-top:0.75rem;">
							<?php if ( $email ) : ?><li><a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( $email ); ?></a></li><?php endif; ?>
							<?php if ( $phone ) : ?><li><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></li><?php endif; ?>
						</ul>
					<?php endif; ?>
				</div>

				<div class="footer-nav-col">
					<h3><?php esc_html_e( 'Legal', 'wellhub-digital' ); ?></h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer-legal',
							'container'      => false,
							'fallback_cb'    => false,
							'items_wrap'     => '<ul>%3$s</ul>',
						)
					);
					?>
				</div>
			</div>

			<?php $disclaimer = get_theme_mod( 'wellhub_health_disclaimer' ); ?>
			<?php if ( $disclaimer ) : ?>
				<p class="footer-disclaimer"><?php echo esc_html( $disclaimer ); ?></p>
			<?php endif; ?>

			<div class="footer-bottom">
				<span><?php echo wp_kses_post( get_theme_mod( 'wellhub_footer_text', sprintf( '&copy; %s. All rights reserved.', gmdate( 'Y' ) ) ) ); ?></span>
				<span><?php bloginfo( 'name' ); ?></span>
			</div>
		</div>
	</footer>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
