<?php
/**
 * WordPress Block Theme: Functions file
 *
 * @since 0.1.0
 * @author Martin Pettersson
 * @license GPL-2.0
 * @package Moonwalking_Bits\WordPress_Block_Theme
 */

declare( strict_types=1 );

use Moonwalking_Bits\WordPress_Block_Theme\Theme;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

require_once get_template_directory() . '/vendor/autoload.php';

$theme = Theme::get_instance();

add_action( 'after_switch_theme', array( $theme, 'activate' ) );
add_action( 'switch_theme', array( $theme, 'deactivate' ) );
add_action( 'after_setup_theme', array( $theme, 'load' ) );
