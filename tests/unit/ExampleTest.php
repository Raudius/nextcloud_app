<?php
namespace OCA\{{ namespace }};

use OCA\{{ namespace }}\AppInfo\Application;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase {
	public function testAbort(): void {
		$this->assertEquals(Application::APP_ID, '{{ app_id }}');
	}
}
