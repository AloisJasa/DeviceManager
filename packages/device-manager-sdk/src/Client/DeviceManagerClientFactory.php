<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManagerSDK\Client;

use Contributte\Guzzlette\ClientFactory;

readonly class DeviceManagerClientFactory
{
	public function __construct(
		private Config $config,
		private ClientFactory $clientFactory,
	)
	{
	}


	public function create(): DeviceManagerClient
	{
		return new DeviceManagerClient(
			$this->clientFactory->createClient(
				[
					'base_uri' => $this->config->baseUri,
					'defaults' => [
						'headers' => [
							'Content-Type' => 'application/json',
						],
					],
					'timeout' => $this->config->timeout,
				],
			),
		);
	}
}
