<?php
/**
 * Template for displaying search forms in NS Custom Theme
 *
 * @package WordPress
 * @subpackage NS_Custom_Theme
 * @since NS Custom Theme 1.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'ns_custom' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'ns_custom' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'ns_custom' ); ?></span></button>
</form>
