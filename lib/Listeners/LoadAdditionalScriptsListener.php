<?php
namespace OCA\{{ namespace }}\Listeners;

use OCA\{{ namespace }}\AppInfo\Application;
use OCP\Collaboration\Resources\LoadAdditionalScriptsEvent;
use OCP\EventDispatcher\IEventListener;

class LoadAdditionalScriptsListener implements IEventListener {

	public function handle(\OCP\EventDispatcher\Event $event): void {
		if (!($event instanceof LoadAdditionalScriptsEvent)) {
			return;
		}

		\OCP\Util::addScript(Application::APP_ID, '{{ app_id }}-main');
	}
}
