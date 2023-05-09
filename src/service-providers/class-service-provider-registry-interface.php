<?php
/**
 * WordPress Block Theme: Service provider registry interface
 *
 * @since 0.1.0
 * @author Martin Pettersson
 * @license GPL-2.0
 * @package Moonwalking_Bits\WordPress_Block_Theme\Service_Providers
 */

declare( strict_types=1 );

namespace Moonwalking_Bits\WordPress_Block_Theme\Service_Providers;

/**
 * Represents a collection of service providers.
 *
 * @since 0.1.0
 */
interface Service_Provider_Registry_Interface {

	/**
	 * Registers the given service provider class.
	 *
	 * @since 0.1.0
	 * @param string $class_name Service provider fully qualified class name.
	 * @throws \RuntimeException If called after service providers has been loaded.
	 * @throws \RuntimeException If service provider class cannot be loaded.
	 */
	public function register_class( string $class_name ): void;

	/**
	 * Loads all registered service providers.
	 *
	 * @since 0.1.0
	 */
	public function load(): void;
}
