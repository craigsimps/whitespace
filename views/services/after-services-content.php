<?php
/**
 * View: After services loop content.
 *
 * @author  Craig Simpson <craig@craigsimpson.scot>
 * @package Whitespace\Theme
 * @since   1.0.0
 *
 * @param $after_services_title string Title for after content area.
 * @param $after_services_content string Content of the after services area.
 */

namespace Whitespace\Theme; ?>
<div class="entry-content" itemprop="text">
    <h4><?php echo esc_html( $after_services_title ); ?></h4>
    <?php echo wp_kses_post( wpautop( $after_services_content ) ); ?>
</div>
