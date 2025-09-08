<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManagerSDK\Client;

readonly class Config
{
	public function __construct(
		public string $baseUri,
		public int $timeout,
	)
	{
	}
}
