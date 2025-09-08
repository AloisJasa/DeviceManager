<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManagerSDK\Model;

use Nette\Utils\Json;
use Nette\Utils\JsonException;
use Psr\Http\Message\ResponseInterface;

trait ResponseTrait
{
	/**
	 * @throws JsonException
	 */
	public static function create(ResponseInterface $response): self
	{
		$body = $response->getBody()->getContents();

		$response->getBody()->rewind();

		/** @var array<mixed> $decodedData */
		$decodedData = Json::decode($body, true);

		return static::createFromArray($decodedData);
	}


	/**
	 * @param array<mixed> $data
	 */
	abstract public static function createFromArray(array $data): self;
}
