<?php
/**
 * Search form template.
 *
 * @package WellHub_Digital
 */
$unique_id = wp_unique_id( 'search-form-' );
?>
<form role="search" method="get" class="search-form-wrap" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $unique_id ); ?>" class="visually-hidden"><?php esc_html_e( 'Search for products and resources', 'wellhub-digital' ); ?></label>
	<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-field" placeholder="<?php esc_attr_e( 'Search products, guides, resources…', 'wellhub-digital' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
	<button type="submit" class="btn">
		<span class="visually-hidden"><?php esc_html_e( 'Search', 'wellhub-digital' ); ?></span>
		<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="7"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
	</button>
</form>
