<?php
/**
 * Services page template.
 *
 * @author  Craig Simpson <craig@craigsimpson.scot>
 * @package Whitespace\Theme
 * @since   1.0.0
 */

declare( strict_types=1 );

namespace Whitespace\Theme;

defined( 'ABSPATH' ) || exit;

add_action('genesis_after_entry_content', __NAMESPACE__ . '\services_output_blocks');
/**
 * Output the large service block section after page content.
 *
 * @return void
 */
function services_output_blocks(): void {

    $post_id = get_the_ID();
    $field_name = 'cs_services_rows';
    $services_rows = get_post_meta( $post_id, $field_name, true );

    if ( ! $services_rows ) {
        return;
    }

    include locate_template( 'views/services-loop-open.php' );

    for ( $i = 0; $i < $services_rows; $i++ ) {
        $icon_id      = get_post_meta($post_id, $field_name . '_' . $i . '_icon', true);
        $icon         = wp_get_attachment_image($icon_id, 'full');
        $title        = get_post_meta($post_id, $field_name . '_' . $i . '_title', true);
        $introduction = get_post_meta($post_id, $field_name . '_' . $i . '_introduction', true);

	    include locate_template( 'views/services-loop-single.php' );
    }

    include locate_template( 'views/services-loop-close.php' );

    $after_services_title   = get_post_meta($post_id, 'cs_after_services_title', true);
    $after_services_content = get_post_meta($post_id, 'cs_after_services_content', true);

    if ( ! $after_services_content ) {
        return;
    }

    include locate_template( 'views/services/after-services-content.php' );
}

genesis();
