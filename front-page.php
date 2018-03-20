<?php
/**
 * Front page.
 *
 * @author  Craig Simpson <craig@craigsimpson.scot>
 * @package Whitespace\Theme
 * @since   1.0.0
 */

declare( strict_types=1 );

namespace Whitespace\Theme;

defined( 'ABSPATH' ) || exit;

add_action( 'genesis_meta', __NAMESPACE__ . '\\front_page_setup' );
/**
 * Output the welcome banner.
 *
 * @return void
 */
function front_page_setup(): void {

		// Add body class.
		add_filter( 'body_class',function($classes) {
			return array_merge( $classes, [ 'archive' ] );
		} );

		// Output welcome area.
		add_action( 'genesis_after_header', __NAMESPACE__ . '\\welcome_widget_area' );

}

/**
 * Hook welcome widget area after site header.
 *
 * @return void
 */
function welcome_widget_area(): void {

    $post_id      = get_the_ID();
    $title        = get_post_meta($post_id, 'cs_home_title', true);
    $introduction = get_post_meta($post_id, 'cs_home_introduction', true);

    include locate_template( 'views/home/welcome.php' );
}

genesis();
