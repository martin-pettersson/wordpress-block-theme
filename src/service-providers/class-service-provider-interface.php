<?php
/**
 * WordPress Block Theme: Service provider interface
 *
 * @since 0.1.0
 * @author Martin Pettersson
 * @license GPL-2.0
 * @package Moonwalking_Bits\WordPress_Block_Theme\Service_Providers
 */

declare( strict_types=1 );

namespace Moonwalking_Bits\WordPress_Block_Theme\Service_Providers;

use Moonwalking_Bits\Container\Container_Interface;

/**
 * Has the ability to provide a service to the theme.
 *
 * To provide maximum flexibility the definition for the "load" method is
 * omitted so that each service provider can provide their own. If a "load"
 * method is defined it will be called during the "load" phase, and the
 * parameters will be injected from the container.
 *
 * @since 0.1.0
 */
interface Service_Provider_Interface {

	/**
	 * Registers any required bindings to the container.
	 *
	 * This makes the bindings available to other service providers during the
	 * "register" phase.
	 *
	 * @since 0.1.0
	 * @param \Moonwalking_Bits\Container\Container_Interface $container Dependency injection container.
	 */
	public function register( Container_Interface $container ): void;
}
