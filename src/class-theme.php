<?php
/**
 * WordPress Block Theme: Theme class
 *
 * @since 0.1.0
 * @author Martin Pettersson
 * @license GPL-2.0
 * @package Moonwalking_Bits\WordPress_Block_Theme
 */

declare( strict_types=1 );

namespace Moonwalking_Bits\WordPress_Block_Theme;

use Moonwalking_Bits\Configuration\Configuration_Builder;
use Moonwalking_Bits\Configuration\Configuration_Interface;
use Moonwalking_Bits\Configuration\Configuration_Source\JSON_Configuration_Source;
use Moonwalking_Bits\Container\Container;
use Moonwalking_Bits\Container\Container_Interface;
use Moonwalking_Bits\WordPress_Block_Theme\Service_Providers\Service_Provider_Registry;
use Moonwalking_Bits\WordPress_Block_Theme\Service_Providers\Service_Provider_Registry_Interface;

/**
 * Class representing the theme.
 *
 * @since 0.1.0
 */
final class Theme extends Container {

	/**
	 * Theme version.
	 *
	 * @since 0.1.0
	 */
	public const VERSION = '%VERSION%';

	/**
	 * Single instance of this class.
	 *
	 * @var \Moonwalking_Bits\WordPress_Block_Theme\Theme
	 */
	private static Theme $instance;

	/**
	 * Creates a new theme instance.
	 */
	private function __construct() {
		$this->bind_instance( Container_Interface::class, $this );
		$this->bind_instance(
			Configuration_Interface::class,
			( new Configuration_Builder() )
				->add_configuration_source(
					new JSON_Configuration_Source( get_template_directory() . '/configuration.json' )
				)
				->build()
		);
		$this->bind_instance( Service_Provider_Registry_Interface::class, new Service_Provider_Registry( $this ) );
		$this->alias( Container_Interface::class, 'container' );
		$this->alias( Configuration_Interface::class, 'configuration' );
	}

	/**
	 * Returns a single instance of this class.
	 *
	 * @since 0.1.0
	 * @return \Moonwalking_Bits\WordPress_Block_Theme\Theme Single theme instance.
	 */
	public static function get_instance(): Theme {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new Theme();
		}

		return self::$instance;
	}

	/**
	 * Runs the theme activation routine.
	 *
	 * @since 0.1.0
	 */
	public function activate(): void {}

	/**
	 * Runs the theme deactivation routine.
	 *
	 * @since 0.1.0
	 */
	public function deactivate(): void {}

	/**
	 * Runs the theme initialization routine.
	 *
	 * @since 0.1.0
	 */
	public function load(): void {
		load_theme_textdomain( 'wordpress-block-theme', get_template_directory() . '/languages' );

		/**
		 * Service provider registry.
		 *
		 * @var Service_Provider_Registry_Interface $service_providers
		 */
		$service_providers = $this->resolve( Service_Provider_Registry_Interface::class );

		/**
		 * Theme configuration.
		 *
		 * @var \Moonwalking_Bits\Configuration\Configuration_Interface $configuration
		 */
		$configuration = $this->resolve( Configuration_Interface::class );

		/**
		 * Service provider classes to register.
		 *
		 * @var string[] $service_provider_class_names
		 */
		$service_provider_class_names = $configuration->get( 'service_providers', array() );

		foreach ( $service_provider_class_names as $class_name ) {
			$service_providers->register_class( $class_name );
		}

		$service_providers->load();
	}
}
