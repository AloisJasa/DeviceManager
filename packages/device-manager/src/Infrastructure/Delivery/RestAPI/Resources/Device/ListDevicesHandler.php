<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Resources\Device;

use AloisJasa\DeviceManager\Application\Device\ListDevicesUseCase;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

readonly class ListDevicesHandler implements RequestHandlerInterface
{
	public function __construct(
		private ListDevicesUseCase $listDevicesUseCase,
	)
	{
	}


	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		$query = $request->getQueryParams();
		$offset = isset($query['offset']) && is_numeric($query['offset']) ? (int) $query['offset'] : null;
		$limit = isset($query['limit']) && is_numeric($query['limit']) ? (int) $query['limit'] : null;

		$response = $this->listDevicesUseCase->execute($limit, $offset);

		return new JsonResponse($response);
	}
}
