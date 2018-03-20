<?php
/**
 * Whitespace Customizations.
 *
 * @author  Craig Simpson <craig@craigsimpson.scot>
 * @package Whitespace\Theme
 * @since   1.0.0
 */

declare( strict_types=1 );

namespace Whitespace\Theme;

use Gamajo\ThemeToolkit\Brick;

/**
 * Class Customizations
 * @package Whitespace\Theme
 */
class Customizations extends Brick {
	public function apply() {

		// Force full-width-content layout setting.
		add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

		// Remove header body classes.
		remove_filter( 'body_class', 'genesis_header_body_classes' );

		// Reposition the primary navigation menu.
		remove_action( 'genesis_after_header', 'genesis_do_nav' );
		add_action( 'genesis_header', 'genesis_do_nav', 12 );

		// Show author box on all posts.
		add_filter( 'get_the_author_genesis_author_box_single', '__return_true' );

		// Gravatar customizations.
		add_filter( 'genesis_author_box_gravatar_size', [ $this, 'author_box_gravatar' ] );
		add_filter( 'genesis_comment_list_args', [ $this, 'comments_gravatar' ] );

		// Set the pagination to arrows left and right.
		add_filter( 'genesis_next_link_text', [ $this, 'next_page_link' ] );
		add_filter( 'genesis_prev_link_text', [ $this, 'previous_page_link' ] );

		// Entry customizations.
		add_action( 'genesis_before_content', [ $this, 'output_featured_image' ], 5 );
		add_action( 'genesis_entry_header', [ $this, 'entry_wrap' ], 2 );
		add_action( 'genesis_entry_footer', [ $this, 'entry_wrap_close' ], 16 );
		add_filter( 'genesis_post_info', [ $this, 'entry_meta_header' ] );
		add_action( 'genesis_before_entry', [ $this, 'remove_entry_meta' ] );
		add_filter( 'get_the_content_more_link', [ $this, 'read_more_link' ] );

		// Relocate after entry widget.
		remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
		add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );
	}

	/**
	 * Set author box Gravatar size.
	 *
	 * @return int
	 */
	public function author_box_gravatar(): int {
		return 160;
	}

	/**
	 * Set avatar size for comments.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	function comments_gravatar( $args ): array {
		$args['avatar_size'] = 100;

		return $args;
	}

	/**
	 * Customize the next page link in the entry navigation.
	 *
	 * @return string
	 */
	public function next_page_link(): string {
		return __( '<span class="screen-reader-text">Next Page</span>&raquo;', 'whitespace' );
	}

	/**
	 * Customize the previous page link in the entry navigation.
	 *
	 * @return string
	 */
	public function previous_page_link(): string {
		return __( '<span class="screen-reader-text">Previous Page</span>&laquo;', 'whitespace' );
	}

	/**
	 * Output the featured image.
	 *
	 * @return void
	 */
	public function output_featured_image(): void {
		if ( is_singular() && has_post_thumbnail() ) {
			the_post_thumbnail();
		}
	}

	/**
	 * Open the entry wrap.
	 *
	 * @return void
	 */
	public function entry_wrap(): void {
		if ( ! is_singular() ) {
			echo '<div class="article-wrap">';
		}
	}

	/**
	 * Close the entry wrap.
	 *
	 * @return void
	 */
	public function entry_wrap_close(): void {
		if ( ! is_singular() ) {
			echo '</div>';
		}
	}

	/**
	 * Return custom entry meta.
	 *
	 * @return string
	 */
	function entry_meta_header(): string {
		if ( is_single() ) {
			return '[post_date] [post_author_posts_link] [post_comments] [post_edit]';
		}

		return '[post_date format="d M Y"]';
	}

	/**
	 * Remove entry footer everywhere but single post.
	 *
	 * @return void
	 */
	function remove_entry_meta(): void {
		if ( ! is_single() ) {
			remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
			remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
			remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
		}
	}

	/**
	 * Custom read more link.
	 *
	 * @return string
	 */
	public function read_more_link(): string {
		return '';
	}
}
