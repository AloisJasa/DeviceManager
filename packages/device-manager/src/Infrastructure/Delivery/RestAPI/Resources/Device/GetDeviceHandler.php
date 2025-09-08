<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Resources\Device;

use AloisJasa\DeviceManager\Application\Device\GetDeviceUseCase;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

readonly class GetDeviceHandler implements RequestHandlerInterface
{
	public function __construct(
		private GetDeviceUseCase $getDeviceCase,
	)
	{
	}


	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		/** @var string $deviceId */
		$deviceId = $request->getAttribute('deviceId');

		$response = $this->getDeviceCase->execute(
			$deviceId,
		);

		return new JsonResponse($response);
	}
}
