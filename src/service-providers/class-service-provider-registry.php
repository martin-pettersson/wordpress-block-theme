<?php
/**
 * WordPress Block Theme: Service provider registry class
 *
 * @since 0.1.0
 * @author Martin Pettersson
 * @license GPL-2.0
 * @package Moonwalking_Bits\WordPress_Block_Theme\Service_Providers
 */

declare( strict_types=1 );

namespace Moonwalking_Bits\WordPress_Block_Theme\Service_Providers;

use Moonwalking_Bits\Container\Container_Interface;
use RuntimeException;

/**
 * Class representing a collection of service providers.
 *
 * @since 0.1.0
 * @see \Moonwalking_Bits\WordPress_Block_Theme\Service_Providers\Service_Provider_Registry_Interface
 */
class Service_Provider_Registry implements Service_Provider_Registry_Interface {

	/**
	 * Registered service providers.
	 *
	 * @var \Moonwalking_Bits\WordPress_Block_Theme\Service_Providers\Service_Provider_Interface[]
	 */
	private array $service_providers;

	/**
	 * Whether the registered service providers has been loaded.
	 *
	 * @var bool
	 */
	private bool $has_been_loaded;

	/**
	 * Dependency injection container.
	 *
	 * @var \Moonwalking_Bits\Container\Container_Interface
	 */
	private Container_Interface $container;

	/**
	 * Creates a new service provider registry instance.
	 *
	 * @since 0.1.0
	 * @param \Moonwalking_Bits\Container\Container_Interface $container Dependency injection container.
	 */
	public function __construct( Container_Interface $container ) {
		$this->service_providers = array();
		$this->has_been_loaded   = false;
		$this->container         = $container;
	}

	// phpcs:ignore Squiz.Commenting.FunctionComment.Missing
	public function register_class( string $class_name ): void {
		if ( $this->has_been_loaded ) {
			throw new RuntimeException(
				'Registering service providers after the load phase is currently undefined behaviour'
			);
		}

		if ( ! in_array( Service_Provider_Interface::class, (array) class_implements( $class_name ), true ) ) {
			throw new RuntimeException(
				"Class {$class_name} either doesn't exist or doesn't implement " . Service_Provider_Interface::class
			);
		}

		/**
		 * Service provider instance.
		 *
		 * @var \Moonwalking_Bits\WordPress_Block_Theme\Service_Providers\Service_Provider_Interface $service_provider
		 */
		$service_provider = $this->container->resolve( $class_name );
		$service_provider->register( $this->container );

		$this->service_providers[] = $service_provider;
	}

	// phpcs:ignore Squiz.Commenting.FunctionComment.Missing
	public function load(): void {
		foreach ( $this->service_providers as $service_provider ) {
			if ( method_exists( $service_provider, 'load' ) ) {
				$this->container->invoke( array( $service_provider, 'load' ) );
			}
		}

		$this->has_been_loaded = true;
	}
}
