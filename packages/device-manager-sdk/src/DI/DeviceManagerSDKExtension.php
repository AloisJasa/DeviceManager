<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManagerSDK\DI;

use AloisJasa\DeviceManagerSDK\Client\Config;
use AloisJasa\DeviceManagerSDK\Client\DeviceManagerClientFactory;
use AloisJasa\DeviceManagerSDK\Exception\MissingExtensionException;
use Contributte\Guzzlette\DI\GuzzleExtension;
use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Schema;

class DeviceManagerSDKExtension extends CompilerExtension
{
	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'baseUri' => Expect::string(),
			'timeout' => Expect::int(15),
		]);
	}


	public function loadConfiguration(): void
	{
		if ( ! $this->compiler->getExtensions(GuzzleExtension::class)) {
			throw new MissingExtensionException(GuzzleExtension::class);
		}

		$config = (array) $this->getConfig();
		$baseUri = $config['baseUri'];
		$timeout = $config['timeout'];

		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('deviceManagerClientFactory'))
			->setFactory(DeviceManagerClientFactory::class)
			->setArguments([new Config($baseUri, $timeout)])
		;

		$builder->addDefinition($this->prefix('deviceManagerClient'))
			->setFactory('@' . $this->prefix('deviceManagerClientFactory') . '::create')
		;
	}
}
