<?php
/**
 * View: Services loop single.
 *
 * @author  Craig Simpson <craig@craigsimpson.scot>
 * @package Whitespace\Theme
 * @since   1.0.0
 *
 * @param $icon string Image tag for service icon.
 * @param $title string Service title.
 * @param $introduction string Service introduction.
 */

namespace Whitespace\Theme; ?>
<li class="services__block">
    <?php echo wp_kses_post( $icon ); ?>
    <h2><?php echo esc_html( $title ); ?></h2>
    <p><?php echo esc_html( $introduction ); ?></p>
</li>
