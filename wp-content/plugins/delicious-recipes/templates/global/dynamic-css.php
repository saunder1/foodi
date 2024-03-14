<?php
/**
 * Dynamic CSS for plugin
 *
 * @package Delicious_Recipes
 */
$global_settings     = delicious_recipes_get_global_settings();
$primary_color       = isset( $global_settings['primaryColor'] ) && ! empty( $global_settings['primaryColor'] ) ? $global_settings['primaryColor'] : '#2db68d';
$primary_color_rgb   = isset( $global_settings['primaryColorRGB'] ) && ! empty( $global_settings['primaryColorRGB'] ) ? $global_settings['primaryColorRGB'] : '45, 182, 141';
$secondary_color     = isset( $global_settings['secondaryColor'] ) && ! empty( $global_settings['secondaryColor'] ) ? $global_settings['secondaryColor'] : '#2db68d';
$secondary_color_rgb = isset( $global_settings['secondaryColorRGB'] ) && ! empty( $global_settings['secondaryColorRGB'] ) ? $global_settings['secondaryColorRGB'] : '232, 78, 59';

/* This field has been removed as per this issue: https://gitlab.com/wp-delicious/delicious-recipes/-/issues/69 */
?>
<style type='text/css' media='all'>
	:root {
		--primary-color: <?php echo delicious_recipes_sanitize_hex_color( $primary_color ); ?>;
		--primary-color-rgb: <?php echo esc_attr( $primary_color_rgb ); ?>;
		--secondary-color: <?php echo delicious_recipes_sanitize_hex_color( $secondary_color ); ?>;
		--secondary-color-rgb: <?php echo esc_attr( $secondary_color_rgb ); ?>;
	}

	.dr-categories select {
		background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='15' height='8' viewBox='0 0 15 8'%3E%3Cpath id='Polygon_25' data-name='Polygon 25' d='M7.5,0,15,8H0Z' transform='translate(15 8) rotate(180)' fill='<?php echo delicious_recipes_hash_to_percent23( delicious_recipes_sanitize_hex_color( $primary_color ) ); ?>'/%3E%3C/svg%3E");
	}

	.dr-aside-content .search-form .search-submit {
		background-image: url('data:image/svg+xml;utf-8, <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path d="M10.73,17.478a6.7,6.7,0,0,0,4.157-1.443L18.852,20,20,18.852l-3.965-3.965a6.729,6.729,0,1,0-5.3,2.591Zm0-11.878A5.139,5.139,0,1,1,5.6,10.73,5.14,5.14,0,0,1,10.73,5.6Z" transform="translate(-4 -4)" fill="<?php echo delicious_recipes_hash_to_percent23( delicious_recipes_sanitize_hex_color( $primary_color ) ); ?>"/></svg>');
	}

	.dr-aside-content .search-form .search-submit:hover {
		background-image: url('data:image/svg+xml;utf-8, <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path d="M10.73,17.478a6.7,6.7,0,0,0,4.157-1.443L18.852,20,20,18.852l-3.965-3.965a6.729,6.729,0,1,0-5.3,2.591Zm0-11.878A5.139,5.139,0,1,1,5.6,10.73,5.14,5.14,0,0,1,10.73,5.6Z" transform="translate(-4 -4)" fill="<?php echo delicious_recipes_hash_to_percent23( delicious_recipes_sanitize_hex_color( $primary_color ) ); ?>"/></svg>');
	}

	.dr-advance-search .page-header .search-form .search-submit {
		background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" width="21.863" height="22" viewBox="0 0 21.863 22"><path d="M24.863,1170.255l-2.045,2.045L18,1167.482v-1.091l-.409-.409a8.674,8.674,0,0,1-5.727,2.046,8.235,8.235,0,0,1-6.273-2.591A8.993,8.993,0,0,1,3,1159.164a8.235,8.235,0,0,1,2.591-6.273,8.993,8.993,0,0,1,6.273-2.591,8.441,8.441,0,0,1,6.273,2.591,8.993,8.993,0,0,1,2.591,6.273,8.675,8.675,0,0,1-2.045,5.727l.409.409h.955ZM7.5,1163.664a5.76,5.76,0,0,0,4.364,1.773,5.969,5.969,0,0,0,4.364-1.773,6.257,6.257,0,0,0,0-8.727,5.76,5.76,0,0,0-4.364-1.773,5.969,5.969,0,0,0-4.364,1.773,5.76,5.76,0,0,0-1.773,4.364A6.308,6.308,0,0,0,7.5,1163.664Z" transform="translate(-3 -1150.3)" fill="<?php echo delicious_recipes_hash_to_percent23( delicious_recipes_sanitize_hex_color( $primary_color ) ); ?>"/></svg>');
	}

	.single-recipe .comment-body .reply .comment-reply-link::after {
		background-image: url('data:image/svg+xml;utf-8, <svg xmlns="http://www.w3.org/2000/svg" width="14.796" height="10.354" viewBox="0 0 14.796 10.354"><g transform="translate(0.75 1.061)"><path d="M7820.11-1126.021l4.117,4.116-4.117,4.116" transform="translate(-7811.241 1126.021)" fill="none" stroke="<?php echo delicious_recipes_hash_to_percent23( delicious_recipes_sanitize_hex_color( $primary_color ) ); ?>" stroke-linecap="round" stroke-width="1.5"></path><path d="M6555.283-354.415h-12.624" transform="translate(-6542.659 358.532)" fill="none" stroke="<?php echo delicious_recipes_hash_to_percent23( delicious_recipes_sanitize_hex_color( $primary_color ) ); ?>" stroke-linecap="round" stroke-width="1.5"></path></g></svg>');
	}

	.advance-search-field .dropdown-wrapper {
		background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="<?php echo delicious_recipes_hash_to_percent23( delicious_recipes_sanitize_hex_color( $primary_color ) ); ?>" d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path></svg>');
	}

</style>
<?php

/**
 * Convert '#' to '%23'
 */
function delicious_recipes_hash_to_percent23( $color_code ) {
	$color_code = str_replace( '#', '%23', $color_code );
	return $color_code;
}

function delicious_recipes_fallback_svg_fill() {

	$global_settings = delicious_recipes_get_global_settings();
	$primary_color   = isset( $global_settings['primaryColor'] ) && ! empty( $global_settings['primaryColor'] ) ? $global_settings['primaryColor'] : '#2db68d';

	return 'fill:' . $primary_color . ';';
}

add_filter( 'delicious_recipes_fallback_svg_fill', 'delicious_recipes_fallback_svg_fill' );
