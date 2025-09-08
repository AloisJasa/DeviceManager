<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager;

use Nette\Bootstrap\Configurator;

use function getenv;

require __DIR__ . '/../../../vendor/autoload.php';

class Bootstrap
{
	public static function boot(): Configurator
	{
		$configurator = new Configurator();
		$appDir = dirname(__DIR__);

		$configurator->setDebugMode(getenv('DEBUG_MODE') === 'true' || getenv('DEBUG_MODE') === '1');
		$configurator->enableTracy($appDir . '/log');

		$configurator->setTimeZone('Europe/Prague');
		$configurator->setTempDirectory($appDir . '/temp');

		$configurator->addStaticParameters([
			'srcDir' => __DIR__,
			'packageRoot' => __DIR__ . '/..',
		]);

		$configurator->addConfig($appDir . '/config/config.neon');

		return $configurator;
	}
}
