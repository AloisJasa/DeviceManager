<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManagerSDK\Client;

use AloisJasa\DeviceManagerSDK\Model\Device\DeviceCollection;
use AloisJasa\DeviceManagerSDK\Resources\ListDevicesRequest;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

readonly class DeviceManagerClient
{
	public function __construct(
		private ClientInterface $httpClient,
	)
	{
	}


	public function sendRequest(RequestInterface $request): ResponseInterface
	{
		return $this->httpClient->sendRequest($request);
	}


	public function listDevices(
		?int $limit = null,
		?int $offset = null,
	): DeviceCollection
	{
		$response = $this->sendRequest(
			new ListDevicesRequest($limit, $offset),
		);

		return DeviceCollection::create($response);
	}
}
