<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Resources\User;

use AloisJasa\DeviceManager\Application\User\GetUserCase;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

readonly class GetUserHandler implements RequestHandlerInterface
{
	public function __construct(
		private GetUserCase $getUserCase,
	)
	{
	}


	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		/** @var string $userId */
		$userId = $request->getAttribute('userId');

		$response = $this->getUserCase->execute(
			$userId,
		);

		return new JsonResponse($response);
	}
}
