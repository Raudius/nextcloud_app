<?php
namespace OCA\{{ namespace }}\AppInfo;

use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;


class Application extends App implements IBootstrap {
	public const APP_ID = '{{ app_id }}';

	public function __construct(array $urlParams = array()) {
		parent::__construct(self::APP_ID, $urlParams);
	}

	/**
	 * Register event listeners, handlers and other service registrations.
	 *
	 * e.g.
	 * ```php
	 * $context->registerEventListener(LoadAdditionalScriptsEvent::class, LoadAdditionalListener::class);
	 * $context->registerMiddleware(MyAppMiddleware::class);
	 * ```
	 */
	public function register(IRegistrationContext $context): void {
	}

	/**
	 * Called when the application is booted (after registration).
	 *
	 * @param IBootContext $context
	 * @return void
	 */
	public function boot(IBootContext $context): void {
	}
}
