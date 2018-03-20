<?php
/**
 * Theme config.
 *
 * @author  Craig Simpson <craig@craigsimpson.scot>
 * @package Whitespace\Theme
 * @since   1.0.0
 */

declare ( strict_types=1 );

namespace Whitespace\Theme;

use Gamajo\GenesisThemeToolkit\FooterCreds;
use Gamajo\GenesisThemeToolkit\Layouts;
use Gamajo\GenesisThemeToolkit\Templates;
use Gamajo\GenesisThemeToolkit\WidgetAreas;
use Gamajo\GenesisThemeToolkit\GenesisThemeToolkit;
use Gamajo\ThemeToolkit\GoogleFonts;
use Gamajo\ThemeToolkit\ImageSizes;
use Gamajo\ThemeToolkit\ThemeSupport;
use Gamajo\ThemeToolkit\ThemeToolkit;

$whitespace_theme_support = [
	ThemeSupport::ADD => [
		'html5'                           => [
			'caption',
			'comment-form',
			'comment-list',
			'gallery',
			'search-form',
		],
		'genesis-accessibility'           => [
			'404-page',
			'headings',
			'rems',
			'search-form',
		],
		'genesis-responsive-viewport'     => '',
		'genesis-menus'                   => [
			'primary'   => __( 'Header Menu', 'whitespace' ),
		],
		'genesis-after-entry-widget-area' => '',
		'soil-clean-up'                   => '',
		'soil-disable-trackbacks'         => '',
		'soil-nav-walker'                 => '',
	],
];

$whitespace_dependencies = [
	'scripts' => [
		[
			'handle'    => 'whitespace',
			'src'       => get_stylesheet_directory_uri() . '/assets/js/whitespace' . ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' ) . '.js',
			'deps'      => [ 'jquery' ],
			'ver'       => CHILD_THEME_VERSION,
			'in_footer' => true,
			'localize'  => [
				'name' => 'genesis_responsive_menu',
				'data' => function ( $context ) {
					return [
						'mainMenu'         => '',
						'menuIconClass'    => 'dashicons-before dashicons-menu',
						'subMenu'          => __( 'Submenu', 'delaware' ),
						'subMenuIconClass' => 'dashicons-before dashicons-arrow-down-alt2',
						'menuClasses'      => [
							'combine' => [
								'.nav-primary',
								'.nav-header',
							],
							'others'  => [],
						],
						'context'          => $context,
					];
				},
			],
		],
	],
];

$whitespace_image_sizes = [
	ImageSizes::ADD => [
		'entry-image' => [ 1200, 600, true ],
	]
];

$whitespace_google_fonts = [
	// Translators: If there are characters in your language that are not supported by this font, translate this to
	// 'off'. Do not translate into your own language.
	'Raleway:400,700' => _x( 'on', 'Raleway font: on or off', 'whitespace' ),
];

$whitespace_templates = [
	Templates::UNREGISTER => [
		Templates::ARCHIVE,
		Templates::BLOG,
	],
];

$whitespace_genesis_layouts = [
	Layouts::UNREGISTER    => [
		Layouts::CONTENT_SIDEBAR,
		Layouts::SIDEBAR_CONTENT,
		Layouts::CONTENT_SIDEBAR_SIDEBAR,
		Layouts::SIDEBAR_CONTENT_SIDEBAR,
		Layouts::SIDEBAR_SIDEBAR_CONTENT,
	],
	Layouts::DEFAULTLAYOUT => __genesis_return_full_width_content()
];

$whitespace_genesis_widget_areas = [
	WidgetAreas::UNREGISTER => [
		WidgetAreas::HEADER_RIGHT,
		WidgetAreas::SIDEBAR,
		WidgetAreas::SIDEBAR_ALT,
	],
];

$whitespace_footer_credits = [
	FooterCreds::CREDS => __( 'Copyright [footer_copyright first="2015"] <a href="https://craigsimpson.scot">Craig Simpson</a> &bull; Built on the <a href="https://www.studiopress.com/themes/genesis" title="Genesis Framework">Genesis Framework</a>', 'whitespace' ),
];

return [
	'Whitespace' => [
		'Theme' => [
			ThemeToolkit::THEMESUPPORT       => $whitespace_theme_support,
			ThemeToolkit::DEPENDENCIES       => $whitespace_dependencies,
			ThemeToolkit::IMAGESIZES         => $whitespace_image_sizes,
			ThemeToolkit::GOOGLEFONTS        => $whitespace_google_fonts,
			GenesisThemeToolkit::TEMPLATES   => $whitespace_templates,
			GenesisThemeToolkit::LAYOUTS     => $whitespace_genesis_layouts,
			GenesisThemeToolkit::WIDGETAREAS => $whitespace_genesis_widget_areas,
			GenesisThemeToolkit::FOOTERCREDS => $whitespace_footer_credits,
			Whitespace::CUSTOMIZATIONS       => [],
		],
	],
];
