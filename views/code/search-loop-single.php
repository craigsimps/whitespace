<?php
/**
 * View: Code snippet single list item.
 *
 * @author  Craig Simpson <craig@craigsimpson.scot>
 * @package Whitespace\Theme
 * @since   1.0.0
 *
 * @param $id int Code snippet post ID.
 * $param $terms object WordPress term.
 */

namespace Whitespace\Theme; ?>
<li>
	<a href="<?php echo esc_url( get_the_permalink( $id ) ); ?>" class="title">
		<?php echo esc_html( get_the_title( $id ) ); ?>
	</a>
	<span class="tag tag--<?php echo esc_attr( $terms->slug ); ?>"><?php echo esc_html( $terms->name ); ?></span>
</li>
