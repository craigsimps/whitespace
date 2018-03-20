<?php
/**
 * Code Archive
 *
 * @author  Craig Simpson <craig@craigsimpson.scot>
 * @package Whitespace\Theme
 * @since   1.0.0
 */

declare( strict_types=1 );

namespace Whitespace\Theme;

defined( 'ABSPATH' ) || exit;

add_action( 'genesis_meta', __NAMESPACE__ . '\\setup_code_archive' );
/**
 * Set up the code snippets archive.
 *
 * @return void
 */
function setup_code_archive(): void {

	add_filter( 'body_class', function ( $classes ) {
		return array_merge( $classes, [ 'code-snippets' ] );
	});

	add_filter( 'genesis_attr_content', __NAMESPACE__ . '\\add_id_to_content' );
	add_action( 'genesis_after_header', __NAMESPACE__ . '\code_search_area' );
	remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );
	remove_action( 'genesis_loop', 'genesis_do_loop' );
	add_action( 'genesis_loop', __NAMESPACE__ . '\\code_search_loop' );
}

/**
 * Add an ID to the content div for search purposes.
 *
 * @param $attributes
 *
 * @return array
 */
function add_id_to_content( $attributes ): array {
	$attributes['id'] = 'snippet-search';

	return $attributes;
}


/**
 * Load the code snippets header.
 *
 * @return void
 */
function code_search_area(): void {
	include locate_template( 'views/code/search-header.php' );
}

/**
 * Output the code snippet list.
 *
 * @return void
 */
function code_search_loop(): void {
	$args = [
		'post_type'              => 'code',
		'posts_per_page'         => 100,
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
		'fields'                 => 'ids',
	];

	$all_code_snippets = new \WP_Query( $args );
	$code_snippet_ids  = $all_code_snippets->posts;

	// Output search.
	include locate_template( 'views/code/search-input.php' );

	// Output code snippet list.
	include locate_template( 'views/code/search-loop-open.php' );

	foreach ( $code_snippet_ids as $id ) {
		$terms = wp_get_post_terms( $id, 'snippet' )[0];
		include locate_template( 'views/code/search-loop-single.php' );
	}

	include locate_template( 'views/code/search-loop-close.php' );
}

genesis();
