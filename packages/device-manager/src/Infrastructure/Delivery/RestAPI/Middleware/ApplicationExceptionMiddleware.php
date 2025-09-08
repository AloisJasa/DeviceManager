<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Middleware;

use AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Exception\ApplicationException;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ApplicationExceptionMiddleware implements MiddlewareInterface
{
	public function process(
		ServerRequestInterface $request,
		RequestHandlerInterface $handler,
	): ResponseInterface
	{
		try {
			return $handler->handle($request);
		} catch (ApplicationException $exception) {
			return new JsonResponse(
				[
					'error' => [
						'message' => $exception->getMessage(),
					],
				],
				$exception->getHttpCode(),
			);
		}
	}
}
