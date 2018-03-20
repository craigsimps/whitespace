<?php
/**
 * Theme functions file.
 *
 * @author  Craig Simpson <craig@craigsimpson.scot>
 * @package Whitespace\Theme
 * @since   1.0.0
 */

declare( strict_types=1 );

namespace Whitespace\Theme;

use BrightNucleus\Config\ConfigFactory;
use Gamajo\GenesisThemeToolkit\FooterCreds;
use Gamajo\GenesisThemeToolkit\Layouts;
use Gamajo\GenesisThemeToolkit\Templates;
use Gamajo\GenesisThemeToolkit\ThemeSettings;
use Gamajo\GenesisThemeToolkit\WidgetAreas;
use Gamajo\ThemeToolkit\Dependencies;
use Gamajo\ThemeToolkit\GoogleFonts;
use Gamajo\ThemeToolkit\ImageSizes;
use Gamajo\ThemeToolkit\ThemeSupport;
use Gamajo\ThemeToolkit\ThemeToolkit;

defined( 'ABSPATH' ) || exit;

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}

add_action( 'genesis_setup', __NAMESPACE__ . '\setup', 15 );
/**
 * Build our theme brick by brick.
 *
 * @since 2.0.0
 *
 * @return void
 */
function setup(): void {

	/**
	 * Initialize Child Theme Constants.
	 *
	 * @since 1.0.0
	 */
	$child_theme = wp_get_theme();

	define( 'CHILD_THEME_NAME', $child_theme->get( 'Name' ) );
	define( 'CHILD_THEME_URL', $child_theme->get( 'ThemeURI' ) );
	define( 'CHILD_THEME_VERSION', $child_theme->get( 'Version' ) );

	// Set localization.
	load_child_theme_textdomain( $child_theme->get( 'TextDomain' ), get_stylesheet_directory() . '/languages' );

	$config_file = __DIR__ . '/config/defaults.php';
	$config      = ConfigFactory::createSubConfig( $config_file, 'Whitespace\Theme' );

	$bricks = [
		ThemeSupport::class,
		Dependencies::class,
		ImageSizes::class,
		GoogleFonts::class,
		Templates::class,
		Layouts::class,
		WidgetAreas::class,
		FooterCreds::class,
		Customizations::class,
	];

	// Apply logic in bricks.
	ThemeToolkit::applyBricks( $config, ...$bricks );
}
