<?php
/**
 * View: Home page welcome area.
 *
 * @author  Craig Simpson <craig@craigsimpson.scot>
 * @package Whitespace\Theme
 * @since   1.0.0
 *
 * @param $title string Title for welcome area.
 * @param $introduction string Wysiwyg content for welcome introduction.
 */

namespace Whitespace\Theme; ?>
<section class="welcome">
	<div class="welcome__inner">
		<h2 class="welcome__title"><?php echo esc_html( $title ); ?></h2>
		<?php echo wp_kses_post( wpautop( $introduction ) ); ?>
	</div>
</section>
