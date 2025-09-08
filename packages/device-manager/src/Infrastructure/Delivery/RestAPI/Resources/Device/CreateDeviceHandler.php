<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Resources\Device;

use AloisJasa\DeviceManager\Application\Device\CreateDeviceCase;
use AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Exception\ApplicationException;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

readonly class CreateDeviceHandler implements RequestHandlerInterface
{
	public function __construct(
		private CreateDeviceCase $createDeviceCase,
	)
	{
	}


	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		/** @var object|array<string, mixed>|null $body */
		$body = $request->getParsedBody();
		$body = is_object($body) ? get_object_vars($body) : $body;

		$response = $this->createDeviceCase->execute(
			$this->pickStringAttribute($body, 'owner'),
			$this->pickStringAttribute($body, 'hostname'),
			$this->pickStringAttribute($body, 'type'),
			$this->pickStringAttribute($body, 'os'),
		);

		return new JsonResponse($response);
	}


	/**
	 * @param array<string, mixed>|null $body
	 */
	private function pickStringAttribute(?array $body, string $key): string
	{
		if ($body !== null && array_key_exists($key, $body) && is_string($body[$key])) {
			return $body[$key];
		}

		throw new ApplicationException('Invalid request body. Missing attribute: ' . $key, 400);
	}
}
